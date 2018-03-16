<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\Country;
use App\Currency;
use App\Item;
use App\Lotin;
use App\NricCode;
use App\NricTownship;
use App\Price;
use App\Receiver;
use App\Sender;
use App\State;
use App\Township;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use PDF;

class LotInController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		if ($request->date) {
			$date = date('Y-m-d', strtotime($request->date));
		} else {
			$date = date('Y-m-d');
		}

		if (Auth::user()->hasRole('administrator')) {
			$query = Lotin::where('date', $date);
		} elseif (Auth::user()->hasRole('owner')) {
			$query = Lotin::where('company_id', Auth::user()->company_id)
				->where('date', $date);
		} elseif (Auth::user()->hasRole('manager')) {
			$query = Lotin::where('company_id', Auth::user()->company_id)
				->where('from_state', Auth::user()->state_id)
				->where('date', $date);
		} else {
			$query = Lotin::where('company_id', Auth::user()->company_id)
				->where('from_state', Auth::user()->state_id)
				->where('created_by', Auth::user()->id)
				->where('date', $date);
		}

		if ($request->from_state) {
			$query = $query->where('from_state', $request->from_state);
		}
		if ($request->to_state) {
			$query = $query->where('to_state', $request->to_state);
		}

		$lotinData = $query->where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);

		$total       = $lotinData->total();
		$perPage     = $lotinData->perPage();
		$currentPage = $lotinData->currentPage();
		$lastPage    = $lotinData->lastPage();
		$lastItem    = $lotinData->lastItem();

		$senderList        = Sender::lists('name', 'id');
		$senderContactList = Sender::lists('contact_no', 'id');
		$memberList        = Sender::lists('member_no', 'id');

		$receiverList        = Receiver::lists('name', 'id');
		$receiverContactList = Receiver::lists('contact_no', 'id');

		$countryList = Country::orderBy('country_code', 'ASC')->lists('country_code', 'id');
		$stateList   = State::orderBy('state_code', 'ASC')->lists('state_code', 'id');

		$nricCodeList     = NricCode::orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		$receivers     = Receiver::where('company_id', Auth::user()->company_id)->get();
		$receiverCount = count($receivers);

		$companyList = Company::orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$userList    = User::lists('name', 'id');

		return view('lotins.index', ['lotinData' => $lotinData, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'senderList' => $senderList, 'memberList' => $memberList, 'senderContactList' => $senderContactList, 'receiverList' => $receiverList, 'receiverContactList' => $receiverContactList, 'countryList' => $countryList, 'stateList' => $stateList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList, 'receiverCount' => $receiverCount, 'companyList' => $companyList, 'userList' => $userList, 'date' => $date])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		if (Auth::user()->hasRole('administrator')) {
			$priceList          = Price::where('deleted', 'N')->lists('title_name', 'id');
			$receiveAddressList = Receiver::where('deleted', 'N')->lists('address', 'id');
			$receiverLastIds    = Receiver::select('id')->first();
			$receiver           = Receiver::get();
		} else {
			$priceList          = Price::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('title_name', 'id');
			$receiveAddressList = Receiver::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('address', 'id');
			$receiverLastIds    = Receiver::where('company_id', Auth::user()->company_id)->select('id')->first();
			$receiver           = Receiver::where('company_id', Auth::user()->company_id)->get();
		}

		$myCompany     = Company::find(Auth::user()->company_id);
		$countryIdList = array();
		$stateIdList   = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}
			$stateIds = $myCompany->state;
			foreach ($stateIds as $stateId) {
				$stateIdList[] = $stateId->id;
			}
		}

		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		foreach ($receiveAddressList as $key => $value) {
			$receiveAddressList[$key] = $value . " of " . count($receiveAddressList);
		}

		$nricCodeList     = NricCode::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::where('deleted', 'N')->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		$lastId = Lotin::where('company_id', Auth::user()->company_id)->where('date', date('Y-m-d'))->count();
		if ($lastId) {
			$lastId = $lastId;
		}
		$lastId += 1;
		$code  = Auth::user()->company->short_code;
		$logNo = date('Ymd') . $code . str_pad($lastId, 4, 0, STR_PAD_LEFT);

		// $receiverLastIds = Receiver::where('company_id', Auth::user()->company_id)->select('id')->first();

		$receiverLastId = 0;

		if ($receiverLastIds) {
			$receiverLastId = $receiverLastIds->id + 1;
		} else {
			$receiverLastId += 1;
		}

		// $receiver      = Receiver::where('company_id', Auth::user()->company_id)->get();
		$receiverCount = count($receiver);
		$receiverCount += 1;
		$receiverLastNo = $receiverCount . ' of ' . $receiverCount;

		return view('lotins.create', ['countryList' => $countryList, 'stateList' => $stateList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList, 'priceList' => $priceList, 'receiveAddressList' => $receiveAddressList, 'logNo' => $logNo, 'receiverLastNo' => $receiverLastNo, 'receiverLastId' => $receiverLastId, 'myCompany' => $myCompany, 'companyList' => $companyList]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$rules = [
			's_contact_no'       => 'required|numeric',
			// 'member_no'          => 'required|unique:senders,member_no',
			'sender_name'        => 'required',

			'r_contact_no'       => 'required|numeric',
			'receiver_name'      => 'required',

			'date'               => 'required|date|date_format:Y-m-d',
			'from_country'       => 'required',
			'from_state'         => 'required',
			'to_country'         => 'required',
			'to_state'           => 'required',
			'payment'            => 'required',

			'other_discount'     => 'numeric',
			'other_discount_amt' => 'numeric',
		];

		$count = count($request->check);

		for ($key = 0; $key < $count; $key++) {
			$rules['lots.' . $key . '.item_name']  = 'required';
			$rules['lots.' . $key . '.barcode']    = 'required|unique:items,barcode';
			$rules['lots.' . $key . '.price_id']   = 'required';
			$rules['lots.' . $key . '.unit_price'] = 'required';
			$rules['lots.' . $key . '.unit']       = 'required';
			$rules['lots.' . $key . '.quantity']   = 'required';
		}

		$messages = array(
			'lots.*.item_name.required'  => 'The item name field is required.',
			'lots.*.barcode.required'    => 'The barcode field is required.',
			'lots.*.barcode.unique'      => 'The barcode has already been taken.',
			'lots.*.price_id.required'   => 'The type field is required.',
			'lots.*.unit_price.required' => 'The unit price field is required.',
			'lots.*.unit.required'       => 'The unit field is required.',
			'lots.*.quantity.required'   => 'The quantity field is required.',
		);

		$this->validate($request, $rules, $messages);

		$size = count($request->item_count);

		$user_id    = Auth::user()->id;
		$company_id = $request->company_id;

		$senderId = 0;
		if ($request->s_contact_no || $request->member_no) {
			if ($request->member_no) {
				$senderIds = Sender::where('member_no', $request->member_no)->first();
			}

			if ($request->s_contact_no) {
				$senderIds = Sender::where('contact_no', $request->s_contact_no)->first();
			}
			if ($senderIds) {
				$senderId = $senderIds->id;
			}
		}

		if ($senderId == 0) {
			$this->validate($request, [
				's_contact_no' => 'required|numeric|unique:senders,contact_no',
				'member_no'    => 'exists:members,member_no',
			]);

			$senderData['company_id']       = $company_id;
			$senderData['name']             = $request->sender_name;
			$senderData['nric_no']          = ($request->nric_no) ? $request->nric_no : "";
			$senderData['nric_code_id']     = ($request->nric_code_id) ? $request->nric_code_id : 0;
			$senderData['nric_township_id'] = ($request->nric_township_id) ? $request->nric_township_id : 0;
			$senderData['contact_no']       = ($request->s_contact_no) ? $request->s_contact_no : "";
			$senderData['member_no']        = ($request->member_no) ? $request->member_no : "";
			$senderData['created_by']       = $user_id;
			// $senderData['state_id'] = $request->state_id;

			$sender   = Sender::create($senderData);
			$senderId = $sender->id;
		}

		$receiverId  = 0;
		$receiverIds = Receiver::where('contact_no', $request->r_contact_no)->where('sender_id', $senderId)->first();
		if ($receiverIds) {
			$receiverId = $receiverIds->id;
		}

		if ($receiverId == 0) {
			$this->validate($request, [
				'r_contact_no' => 'required|numeric|unique:receivers,contact_no',
			]);

			$receiverData['company_id']       = $company_id;
			$receiverData['sender_id']        = $senderId;
			$receiverData['name']             = $request->receiver_name;
			$receiverData['nric_no']          = ($request->r_nric_no) ? $request->r_nric_no : "";
			$receiverData['nric_code_id']     = ($request->r_nric_code_id) ? $request->r_nric_code_id : "";
			$receiverData['nric_township_id'] = ($request->r_nric_township_id) ? $request->r_nric_township_id : "";
			$receiverData['contact_no']       = ($request->r_contact_no) ? $request->r_contact_no : "";
			$receiverData['member_no']        = ($request->member_no) ? $request->member_no : "";
			$receiverData['created_by']       = $user_id;
			$receiverData['address']          = ($request->to_state_id_new) ? $request->to_state_id_new : "";
			// $receiverData['state_id'] = $request->to_state_id;

			$receiver   = Receiver::create($receiverData);
			$receiverId = $receiver->id;
		}

		$lotinDatas['company_id']          = $company_id;
		$lotinDatas['user_id']             = $user_id;
		$lotinDatas['sender_id']           = $senderId;
		$lotinDatas['receiver_id']         = $receiverId;
		$lotinDatas['lot_no']              = $request->lot_no;
		$lotinDatas['date']                = $request->date;
		$lotinDatas['from_country']        = ($request->from_country) ? (int) $request->from_country : "";
		$lotinDatas['from_state']          = ($request->from_state) ? (int) $request->from_state : "";
		$lotinDatas['to_country']          = ($request->to_country) ? (int) $request->to_country : "";
		$lotinDatas['to_state']            = ($request->to_state) ? (int) $request->to_state : "";
		$lotinDatas['member_discount']     = $request->member_discount;
		$lotinDatas['member_discount_amt'] = $request->member_discount_amt;
		$lotinDatas['other_discount_type'] = $request->other_discount_type;
		$lotinDatas['other_discount']      = $request->other_discount;
		$lotinDatas['other_discount_amt']  = $request->other_discount_amt;
		$lotinDatas['gov_tax']             = $request->gov_tax;
		$lotinDatas['gov_tax_amt']         = $request->gov_tax_amt;
		$lotinDatas['service_charge']      = $request->service_charge;
		$lotinDatas['service_charge_amt']  = $request->service_charge_amt;
		$lotinDatas['total_amt']           = $request->total_amt;
		$lotinDatas['net_amt']             = $request->net_amt;
		$lotinDatas['payment']             = $request->payment;
		$lotinDatas['remarks']             = $request->remarks;
		$lotinDatas['created_by']          = $user_id;
		$lotinDatas['status']              = 0;

		$lotin   = Lotin::create($lotinDatas);
		$lotinId = $lotin->id;

		$lots    = $request->lots;
		$noItems = 0;
		for ($i = 0; $i < $size; $i++) {
			if ($lots[$i]['item_name'] != "") {
				$itemData['lotin_id']    = $lotinId;
				$itemData['item_name']   = $lots[$i]['item_name'];
				$itemData['barcode']     = $lots[$i]['barcode'];
				$itemData['price_id']    = $lots[$i]['price_id'];
				$itemData['category_id'] = $lots[$i]['category_id'];
				$itemData['currency_id'] = $lots[$i]['currency_id'];
				$itemData['unit']        = $lots[$i]['unit'];
				$itemData['unit_price']  = $lots[$i]['unit_price'];
				$itemData['quantity']    = $lots[$i]['quantity'];
				$itemData['amount']      = $lots[$i]['amount'];
				$itemData['created_by']  = $user_id;

				Item::create($itemData);
			}

		}

		$noItems = Item::where('lotin_id', $lotinId)->count();

		$updLotin = Lotin::find($lotinId)->update(['total_items' => $noItems]);

		return redirect()->route('lotins.show', ['id' => $lotinId])
			->with('success', 'Lotin created successfully');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$lotinData = Lotin::find($id);

		$sender   = Sender::find($lotinData->sender_id);
		$receiver = Receiver::find($lotinData->receiver_id);

		$myCompany     = Company::find(Auth::user()->company_id);
		$countryIdList = array();
		$stateIdList   = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}
			$stateIds = $myCompany->state;
			foreach ($stateIds as $stateId) {
				$stateIdList[] = $stateId->id;
			}
		}

		$countryList = Country::whereIn('id', $countryIdList)->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::whereIn('id', $stateIdList)->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		$nricCodeList     = NricCode::orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$receivers = Receiver::get();
		} else {
			$receivers = Receiver::where('company_id', Auth::user()->company_id)->get();
		}
		$receiverCount = count($receivers);

		$itemList = Item::where('lotin_id', $id)->get();

		if (Auth::user()->hasRole('administrator')) {
			$priceList    = Price::lists('title_name', 'id');
			$currencyList = Currency::orderBy('id', 'ASC')->lists('type', 'id');
		} else {
			$priceList    = Price::where('company_id', Auth::user()->company_id)->lists('title_name', 'id');
			$currencyList = Currency::where('company_id', Auth::user()->company_id)->orderBy('id', 'ASC')->lists('type', 'id');
		}
		$categoryList = Category::orderBy('id', 'ASC')->lists('unit', 'id');

		return view('lotins.show', ['lotinData' => $lotinData, 'sender' => $sender, 'receiver' => $receiver, 'countryList' => $countryList, 'stateList' => $stateList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList, 'receiverCount' => $receiverCount, 'itemList' => $itemList, 'priceList' => $priceList, 'categoryList' => $categoryList, 'currencyList' => $currencyList]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$lotinData = DB::table('lotins as l')
			->leftJoin('senders as s', 's.id', '=', 'l.sender_id')
			->leftJoin('receivers as r', 'r.id', '=', 'l.receiver_id')
			->select('l.*', 's.member_no', 's.contact_no as s_contact_no', 's.name as sender_name', 's.nric_code_id', 's.nric_township_id', 's.nric_no', 'r.contact_no as r_contact_no', 'r.name as receiver_name', 'r.nric_code_id as r_nric_code_id', 'r.nric_township_id as r_nric_township_id', 'r.nric_no as r_nric_no', 'r.address')
			->where('l.id', $id)
			->where('l.deleted', 'N')
			->first();

		$itemList = Item::where('lotin_id', $id)->get();

		$categoryList = Category::orderBy('id', 'ASC')->lists('unit', 'id');
		if (Auth::user()->hasRole('administrator')) {
			$priceList          = Price::lists('title_name', 'id');
			$currencyList       = Currency::orderBy('id', 'ASC')->lists('type', 'id');
			$receiveAddressList = Receiver::where('deleted', 'N')->lists('address', 'id');
			$receiver           = Receiver::get();
		} else {
			$priceList          = Price::where('company_id', Auth::user()->company_id)->lists('title_name', 'id');
			$currencyList       = Currency::where('company_id', Auth::user()->company_id)->orderBy('id', 'ASC')->lists('type', 'id');
			$receiveAddressList = Receiver::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('address', 'id');
			$receiver           = Receiver::where('company_id', Auth::user()->company_id)->get();
		}

		$myCompany     = Company::find(Auth::user()->company_id);
		$countryIdList = array();
		$stateIdList   = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}
			$stateIds = $myCompany->state;
			foreach ($stateIds as $stateId) {
				$stateIdList[] = $stateId->id;
			}
		}
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');

		$countryList = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList   = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

		foreach ($receiveAddressList as $key => $value) {
			$receiveAddressList[$key] = $value . " of " . count($receiveAddressList);
		}

		$nricCodeList     = NricCode::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::where('deleted', 'N')->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		$receiverLastId = $lotinData->address;

		$receiverCount = count($receiver);
		// $receiverCount += 1;
		$receiverLastNo = $receiverLastId . ' of ' . $receiverCount;

		return view('lotins.edit', ['lotinData' => $lotinData, 'countryList' => $countryList, 'stateList' => $stateList, 'nricCodeList' => $nricCodeList, 'nricTownshipList' => $nricTownshipList, 'priceList' => $priceList, 'receiveAddressList' => $receiveAddressList, 'receiverLastNo' => $receiverLastNo, 'receiverLastId' => $receiverLastId, 'myCompany' => $myCompany, 'itemList' => $itemList, 'categoryList' => $categoryList, 'currencyList' => $currencyList, 'companyList' => $companyList]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$messages = array(
			's_contact_no.required'  => 'The Sender Contact Number  field is required.',
			'sender_name.required'   => 'The Sender Name  field is required.',

			'r_contact_no.required'  => 'The Receiver Contact Number  field is required.',
			'receiver_name.required' => 'The Receiver Name  field is required.',

			'from_country.required'  => 'The From Country  field is required.',
			'from_state.required'    => 'The From State  field is required.',

			'to_country.required'    => 'The To Country  field is required.',
			'to_state.required'      => 'The To State  field is required.',

		);

		$this->validate($request, [
			's_contact_no'  => 'required|numeric',
			'sender_name'   => 'required',

			'r_contact_no'  => 'required|numeric',
			'receiver_name' => 'required',

			'from_country'  => 'required',
			'from_state'    => 'required',
			'to_country'    => 'required',
			'to_state'      => 'required',
			'payment'       => 'required',
		], $messages);

		$user_id = Auth::user()->id;

		$lotinDatas['from_country'] = ($request->from_country) ? (int) $request->from_country : "";
		$lotinDatas['from_state']   = ($request->from_state) ? (int) $request->from_state : "";
		$lotinDatas['to_country']   = ($request->to_country) ? (int) $request->to_country : "";
		$lotinDatas['to_state']     = ($request->to_state) ? (int) $request->to_state : "";
		$lotinDatas['payment']      = $request->payment;
		$lotinDatas['remarks']      = $request->remarks;
		$lotinDatas['updated_by']   = $user_id;
		$lotin                      = Lotin::find($id);
		$lotin->update($lotinDatas);

		$senderData['name']             = $request->sender_name;
		$senderData['nric_no']          = ($request->nric_no) ? $request->nric_no : "";
		$senderData['nric_code_id']     = ($request->nric_code_id) ? $request->nric_code_id : 0;
		$senderData['nric_township_id'] = ($request->nric_township_id) ? $request->nric_township_id : 0;
		$senderData['contact_no']       = ($request->s_contact_no) ? $request->s_contact_no : "";
		$senderData['updated_by']       = $user_id;
		$sender                         = Sender::find($lotin->sender_id);
		$sender->update($senderData);

		$receiverData['sender_id']        = $sender->id;
		$receiverData['name']             = $request->receiver_name;
		$receiverData['nric_no']          = ($request->r_nric_no) ? $request->r_nric_no : "";
		$receiverData['nric_code_id']     = ($request->r_nric_code_id) ? $request->r_nric_code_id : "";
		$receiverData['nric_township_id'] = ($request->r_nric_township_id) ? $request->r_nric_township_id : "";
		$receiverData['contact_no']       = ($request->r_contact_no) ? $request->r_contact_no : "";
		$receiverData['updated_by']       = $user_id;

		$receiver = Receiver::find($lotin->receiver_id);
		$receiver->update($receiverData);

		return redirect()->route('lotins.show', ['id' => $id])
			->with('success', 'Lotin updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function searchAddressBySender(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$search    = $request->get('search');
		$contactNo = $request->get('contactNo');
		$memberNo  = $request->get('memberNo');

		if (Auth::user()->hasRole('administrator')) {
			if ($contactNo) {
				$items = DB::table('receivers as r')->leftJoin('senders as s', 's.id', '=', 'r.sender_id')->select(\DB::raw('r.address as id, r.address as text'))->where('s.contact_no', $contactNo)->where('r.address', 'like', "{$search}%")->orderBy('r.address', 'ASC')->where('r.deleted', 'N')->get();
			} else {
				$items = DB::table('receivers as r')->leftJoin('senders as s', 's.id', '=', 'r.sender_id')->select(\DB::raw('r.address as id, r.address as text'))->where('s.member_no', $memberNo)->where('r.address', 'like', "{$search}%")->orderBy('r.address', 'ASC')->where('r.deleted', 'N')->get();
			}
		} else {
			if ($contactNo) {
				$items = DB::table('receivers as r')->leftJoin('senders as s', 's.id', '=', 'r.sender_id')->select(\DB::raw('r.address as id, r.address as text'))->where('r.company_id', Auth::user()->company_id)->where('s.contact_no', $contactNo)->where('r.address', 'like', "{$search}%")->orderBy('r.address', 'ASC')->where('r.deleted', 'N')->get();
			} else {
				$items = DB::table('receivers as r')->leftJoin('senders as s', 's.id', '=', 'r.sender_id')->select(\DB::raw('r.address as id, r.address as text'))->where('r.company_id', Auth::user()->company_id)->where('s.member_no', $memberNo)->where('r.address', 'like', "{$search}%")->orderBy('r.address', 'ASC')->where('r.deleted', 'N')->get();
			}
		}

		foreach ($items as $item) {
			$item->text = $item->text . " of " . count($items);
		}

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);
		return response()->json(['items' => $items], 200, $header, JSON_UNESCAPED_UNICODE);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function searchAddressByMember(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$contactNo = $request->get('contactNo');
		$memberNo  = $request->get('memberNo');

		if (Auth::user()->hasRole('administrator')) {
			if ($contactNo) {
				$items = DB::table('receivers as r')
					->leftJoin('senders as s', 's.id', '=', 'r.sender_id')
					->leftJoin('nric_townships as snt', 'snt.id', '=', 's.nric_township_id')
					->leftJoin('nric_townships as rnt', 'rnt.id', '=', 'r.nric_township_id')
					->where('s.contact_no', $contactNo)
					->where('r.deleted', 'N')
					->select('r.*', 's.name as s_name', 's.contact_no as s_contact_no', 's.nric_no as s_nric_no', 's.nric_code_id as s_nric_code_id', 's.nric_township_id as s_nric_tp_id', 'snt.short_name as s_township', 'rnt.short_name as r_township')
					->first();
			} else {
				$items = DB::table('receivers as r')
					->leftJoin('senders as s', 's.id', '=', 'r.sender_id')
					->leftJoin('nric_townships as snt', 'snt.id', '=', 's.nric_township_id')
					->leftJoin('nric_townships as rnt', 'rnt.id', '=', 'r.nric_township_id')
					->where('s.member_no', $memberNo)
					->where('r.deleted', 'N')
					->select('r.*', 's.name as s_name', 's.contact_no as s_contact_no', 's.nric_no as s_nric_no', 's.nric_code_id as s_nric_code_id', 's.nric_township_id as s_nric_tp_id', 'snt.short_name as s_township', 'rnt.short_name as r_township')
					->first();
			}
		} else {
			if ($contactNo) {
				$items = DB::table('receivers as r')
					->leftJoin('senders as s', 's.id', '=', 'r.sender_id')
					->leftJoin('nric_townships as snt', 'snt.id', '=', 's.nric_township_id')
					->leftJoin('nric_townships as rnt', 'rnt.id', '=', 'r.nric_township_id')
					->where('s.company_id', Auth::user()->company_id)
					->where('s.contact_no', $contactNo)
					->where('r.deleted', 'N')
					->select('r.*', 's.name as s_name', 's.contact_no as s_contact_no', 's.nric_no as s_nric_no', 's.nric_code_id as s_nric_code_id', 's.nric_township_id as s_nric_tp_id', 'snt.short_name as s_township', 'rnt.short_name as r_township')
					->first();
			} else {
				$items = DB::table('receivers as r')
					->leftJoin('senders as s', 's.id', '=', 'r.sender_id')
					->leftJoin('nric_townships as snt', 'snt.id', '=', 's.nric_township_id')
					->leftJoin('nric_townships as rnt', 'rnt.id', '=', 'r.nric_township_id')
					->where('s.contact_no', Auth::user()->company_id)
					->where('s.company_id', $memberNo)
					->where('r.deleted', 'N')
					->select('r.*', 's.name as s_name', 's.contact_no as s_contact_no', 's.nric_no as s_nric_no', 's.nric_code_id as s_nric_code_id', 's.nric_township_id as s_nric_tp_id', 'snt.short_name as s_township', 'rnt.short_name as r_township')
					->first();
			}
		}

		return json_encode($items, JSON_UNESCAPED_UNICODE);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function searchMember(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$memberNo = $request->get('memberNo');

		if (Auth::user()->hasRole('administrator')) {
			$items = DB::table('members as m')
				->leftJoin('member_offers as mf', 'mf.id', '=', 'm.member_offers_id')
				->where('m.member_no', $memberNo)
				->where('m.deleted', 'N')
				->select('m.*', 'mf.rate')
				->first();
		} else {
			$items = DB::table('members as m')
				->leftJoin('member_offers as mf', 'mf.id', '=', 'm.member_offers_id')
				->where('m.member_no', $memberNo)
				->where('m.company_id', Auth::user()->company_id)
				->where('m.deleted', 'N')
				->select('m.*', 'mf.rate')
				->first();
		}

		return json_encode($items, JSON_UNESCAPED_UNICODE);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function searchUnitPrices(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$priceId = $request->get('priceId');

		if (Auth::user()->hasRole('administrator')) {
			$price = DB::table('prices as p')
				->leftJoin('categories as c', 'c.id', '=', 'p.category_id')
				->leftJoin('currencies as cr', 'cr.id', '=', 'p.currency_id')
				->select('p.*', 'c.unit', 'cr.type')
				->where('p.id', $priceId)
				->where('p.deleted', 'N')->first();
		} else {
			$price = DB::table('prices as p')
				->leftJoin('categories as c', 'c.id', '=', 'p.category_id')
				->leftJoin('currencies as cr', 'cr.id', '=', 'p.currency_id')
				->select('p.*', 'c.unit', 'cr.type')
				->where('p.id', $priceId)
				->where('p.company_id', Auth::user()->company_id)
				->where('p.deleted', 'N')->first();
		}

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);

		return json_encode($price, JSON_UNESCAPED_UNICODE);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function searchPriceList(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$search        = $request->get('search');
		$fromCountryId = $request->get('fromCountryId');
		$fromStateId   = $request->get('fromStateId');
		$toCountryId   = $request->get('toCountryId');
		$toStateId     = $request->get('toStateId');
		$companyId     = $request->get('companyId');

		if (Auth::user()->hasRole('administrator')) {
			$items = Price::select(\DB::raw('id as id, title_name as text'))->where('company_id', $companyId)->where('from_country', $fromCountryId)->where('from_state', $fromStateId)->where('to_country', $toCountryId)->where('to_state', $toStateId)->where('title_name', 'like', "{$search}%")->where('deleted', 'N')->orderBy('title_name', 'ASC')->get();

		} else {
			$items = Price::select(\DB::raw('id as id, title_name as text'))->where('company_id', $companyId)->where('from_country', $fromCountryId)->where('from_state', $fromStateId)->where('to_country', $toCountryId)->where('to_state', $toStateId)->where('title_name', 'like', "{$search}%")->where('deleted', 'N')->orderBy('title_name', 'ASC')->get();

		}

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);
		return response()->json(['items' => $items], 200, $header, JSON_UNESCAPED_UNICODE);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function searchReceiverByAddress(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$address = $request->get('address');

		if (Auth::user()->hasRole('administrator')) {
			$receiver = DB::table('receivers as r')
				->leftJoin('nric_townships as rnt', 'rnt.id', '=', 'r.nric_township_id')
				->select('r.*', 'rnt.short_name as r_township')
				->where('address', $address)
				->where('r.deleted', 'N')->first();
		} else {
			$receiver = DB::table('receivers as r')
				->leftJoin('nric_townships as rnt', 'rnt.id', '=', 'r.nric_township_id')
				->select('r.*', 'rnt.short_name as r_township')
				->where('address', $address)
				->where('r.company_id', Auth::user()->company_id)
				->where('r.deleted', 'N')->first();
		}

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);

		return json_encode($receiver, JSON_UNESCAPED_UNICODE);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function searchLastReceiverNo(Request $request) {
		$request->merge(array_map(function ($value) {
			if (!is_array($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));

		$companyId = $request->get('companyId');

		$receiver = Receiver::where('company_id', $companyId)->get();

		$receiverCount = count($receiver);
		$receiverCount += 1;
		$receiverLastNo = $receiverCount . ' of ' . $receiverCount;

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);

		return json_encode($receiverLastNo, JSON_UNESCAPED_UNICODE);
	}

	/*
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function printPdf($id) {
		$lotinData = Lotin::find($id);

		$sender   = Sender::find($lotinData->sender_id);
		$receiver = Receiver::find($lotinData->receiver_id);

		$myCompany      = Company::find(Auth::user()->company_id);
		$countryIdList  = array();
		$stateIdList    = array();
		$townshipIdList = array();
		if (count($myCompany) > 0) {
			$countryIds = $myCompany->country;
			foreach ($countryIds as $country) {
				$countryIdList[] = $country->id;
			}
			$stateIds = $myCompany->state;
			foreach ($stateIds as $stateId) {
				$stateIdList[] = $stateId->id;
			}
			$townshipIds = $myCompany->township;
			foreach ($townshipIds as $townshipId) {
				$townshipIdList[] = $townshipId->id;
			}
		}
		$companyList  = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$countryList  = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList    = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townshipList = Township::whereIn('id', $townshipIdList)->where('deleted', 'N')->orderBy('township_name', 'ASC')->lists('township_name', 'id');

		$nricCodeList     = NricCode::where('deleted', 'N')->orderBy('nric_code', 'ASC')->lists('nric_code', 'id');
		$nricTownshipList = NricTownship::where('deleted', 'N')->orderBy('id', 'ASC')->orderBy('serial_no', 'ASC')->lists('short_name', 'id');

		if (Auth::user()->hasRole('administrator')) {
			$receivers = Receiver::get();
		} else {
			$receivers = Receiver::where('company_id', Auth::user()->company_id)->get();
		}
		$receiverCount = count($receivers);

		$itemList = Item::where('lotin_id', $id)->get();

		if (Auth::user()->hasRole('administrator')) {
			$priceList    = Price::where('deleted', 'N')->lists('title_name', 'id');
			$currencyList = Currency::where('deleted', 'N')->orderBy('id', 'ASC')->lists('type', 'id');
		} else {
			$priceList    = Price::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('title_name', 'id');
			$currencyList = Currency::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->orderBy('id', 'ASC')->lists('type', 'id');
		}
		$categoryList = Category::where('deleted', 'N')->orderBy('id', 'ASC')->lists('unit', 'id');

		$pdf = PDF::loadView(
			'lotins.print-pdf',
			[
				'lotinData'        => $lotinData,
				'sender'           => $sender,
				'receiver'         => $receiver,
				'countryList'      => $countryList,
				'stateList'        => $stateList,
				'townshipList'     => $townshipList,
				'nricCodeList'     => $nricCodeList,
				'nricTownshipList' => $nricTownshipList,
				'receiverCount'    => $receiverCount,
				'itemList'         => $itemList,
				'priceList'        => $priceList,
				'categoryList'     => $categoryList,
				'currencyList'     => $currencyList,
				'myCompany'        => $myCompany,
			]
		)->setPaper('a6');

		return $pdf->stream('LotinPDF - ' . $lotinData->lot_no . '.pdf');

	}
}
