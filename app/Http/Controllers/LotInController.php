<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Lotin;
use App\NricCodes;
use App\NricTownships;
use App\Price;
use App\Receiver;
use App\Sender;
use App\States;
use Auth;
use DB;
use Illuminate\Http\Request;

class LotInController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		if (Auth::user()->hasRole('administrator')) {
			$countries = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')
				->lists('country_name', 'id');
			$states = States::where('deleted', 'N')->orderBy('state_name', 'ASC')
				->lists('state_name', 'id');
			$priceList      = Price::where('deleted', 'N')->lists('title_name', 'id');
			$receiveAddress = Receiver::where('deleted', 'N')->lists('address', 'id');
		} else {
			$countries = Countries::where('company_id', Auth::user()->company_id)
				->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
			$states = States::where('company_id', Auth::user()->company_id)
				->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
			$priceList      = Price::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('title_name', 'id');
			$receiveAddress = Receiver::where('company_id', Auth::user()->company_id)->where('deleted', 'N')->lists('address', 'id');
		}

		$nricCodes     = NricCodes::where('deleted', 'N')->orderBy('id', 'asc')->lists('nric_code', 'id');
		$nricTownships = NricTownships::where('deleted', 'N')->orderBy('serial_no', 'asc')->lists('short_name', 'id');

		$lastId = Lotin::where('company_id', Auth::user()->company_id)->latest('id')->first();
		if ($lastId) {
			$lastId = $lastId->id;
		}
		$lastId += 1;
		$code  = Auth::user()->company->short_code;
		$logNo = date('Ymd') . $code . str_pad($lastId, 4, 0, STR_PAD_LEFT);

		return view('lotins.index', ['countries' => $countries, 'states' => $states, 'nricCodes' => $nricCodes, 'nricTownships' => $nricTownships, 'priceList' => $priceList, 'receiveAddress' => $receiveAddress, 'logNo' => $logNo]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$messages = array(
			's_contact_no.required'       => 'The Sender Contact Number  field is required.',
			'member_no.required'          => 'The Member Number  field is required.',
			'sender_name.required'        => 'The Sender Name  field is required.',
			'nric_code_id.required'       => 'The NRIC Code  field is required.',
			'nric_township_id.required'   => 'The NRIC Township  field is required.',
			'nric_no.required'            => 'The NRIC Number  field is required.',

			'r_contact_no.required'       => 'The Receiver Contact Number  field is required.',
			'receiver_name.required'      => 'The Receiver Name  field is required.',
			'r_nric_code_id.required'     => 'The NRIC Code  field is required.',
			'r_nric_township_id.required' => 'The NRIC Township  field is required.',
			'r_nric_no.required'          => 'The NRIC Number  field is required.',

			'country_id.required'         => 'The From Country  field is required.',
			'state_id.required'           => 'The From State  field is required.',

			'lots.*.item_name.required'   => 'The Item Name  field is required.',
			'lots.*.barcode.required'     => 'The Barcode  field is required.',
			'lots.*.price_id.required'    => 'The Price Category  field is required.',
			'lots.*.unit.required'        => 'The Unit  field is required.',
			'lots.*.quantity.required'    => 'The Quantity  field is required.',
			'lots.*.amount.required'      => 'The Amount  field is required.',
		);

		$this->validate($request, [
			// 's_contact_no'       => 'required',
			// 'member_no'          => 'required',
			// 'sender_name'        => 'required',
			// 'nric_code_id'       => 'required',
			// 'nric_township_id'   => 'required',
			// 'nric_no'            => 'required',

			// 'r_contact_no'       => 'required',
			// 'receiver_name'      => 'required',
			// 'r_nric_code_id'     => 'required',
			// 'r_nric_township_id' => 'required',
			// 'r_nric_no'          => 'required',

			// 'date'               => 'required',
			// 'country_id'         => 'required',
			// 'state_id'           => 'required',
			// 'payment'            => 'required',

			// 'lots.*.item_name'   => 'required',
			// 'lots.*.barcode'     => 'required',
			// 'lots.*.price_id'    => 'required',
			// 'lots.*.unit_price'  => 'required',
			// 'lots.*.unit'        => 'required',
			// 'lots.*.quantity'    => 'required',
			// 'lots.*.amount'      => 'required',
		], $messages);

		$size = count($request->lots);
		// dd($request->all());

		$user_id    = Auth::user()->id;
		$company_id = Auth::user()->company_id;

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

		$receiverId = 0;
		if ($request->to_state_id_new == "") {
			$receiverIds = Receiver::where('address', $request->to_state_id)->where('sender_id', $senderId)->first();
			if ($receiverIds) {
				$receiverId = $receiverIds->id;
			}
		}

		if ($receiverId == 0) {
			$receiverData['company_id']       = $company_id;
			$receiverData['sender_id']        = $senderId;
			$receiverData['name']             = $request->receiver_name;
			$receiverData['nric_no']          = ($request->r_nric_no) ? $request->r_nric_no : "";
			$receiverData['nric_code_id']     = ($request->r_nric_code_id) ? $request->r_nric_code_id : "";
			$receiverData['nric_township_id'] = ($request->r_nric_township_id) ? $request->r_nric_township_id : "";
			$receiverData['contact_no']       = ($request->r_contact_no) ? $request->r_contact_no : "";
			$receiverData['member_no']        = ($request->member_no) ? $request->member_no : "";
			$receiverData['created_by']       = $user_id;
			$receiverData['address']          = ($request->to_state_id) ? $request->to_state_id : "";
			// $receiverData['state_id'] = $request->to_state_id;

			$reseiver   = Receiver::create($receiverData);
			$receiverId = $reseiver->id;
		}

		$lotData['company_id']  = $company_id;
		$lotData['user_id']     = $user_id;
		$lotData['sender_id']   = $senderId;
		$lotData['receiver_id'] = $receiverId;
		$LotData['lot_no']      = $request->lot_no;
		$lotData['date']        = $request->date;
		// $lotData['time']                = $request->time;
		$LotData['from_country']        = ($request->country_id) ? $request->country_id : "";
		$LotData['from_state']          = ($request->state_id) ? $request->state_id : "";
		$lotData['member_discount']     = 0;
		$lotData['member_discount_amt'] = 0;
		$lotData['other_discount']      = 10;
		$lotData['other_discount_amt']  = $request->discount;
		$lotData['gov_tax']             = 7;
		$lotData['gov_tax_amt']         = $request->gst;
		$lotData['service_charge']      = 10;
		$lotData['service_charge_amt']  = $request->service;
		$lotData['total_amt']           = $request->total_amt;
		$lotData['payment']             = $request->payment;
		$lotData['created_by']          = $user_id;
		$lotData['status']              = 0;

		$lotin   = Lotin::create($lotData);
		$lotinId = $lotin->id;

		$lots = $request->lots;
		for ($i = 0; $i < $size; $i++) {
			if ($lots[$i]['item_name'] != "") {
				$itemData['lotin_id']   = $lotinId;
				$itemData['item_name']  = $lots[$i]['item_name'];
				$itemData['barcode']    = $lots[$i]['barcode'];
				$itemData['price_id']   = $lots[$i]['price_id'];
				$itemData['address']    = $lots[$i]['address'];
				$itemData['unit']       = $lots[$i]['unit'];
				$itemData['unit_price'] = $lots[$i]['unit_price'];
				$itemData['quantity']   = $lots[$i]['quantity'];
				$itemData['amount']     = $lots[$i]['amount'];
				$itemData['created_by'] = $user_id;

				Item::create($itemData);
			}

		}
		return view('dashboard.dashboard');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
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
		$search    = $request->get('search');
		$contactNo = $request->get('contactNo');
		$memberNo  = $request->get('memberNo');

		if (Auth::user()->hasRole('administrator')) {
			if ($contactNo) {
				$items = DB::table('receivers as r')->leftJoin('senders as s', 's.id', '=', 'r.sender_id')->select(\DB::raw('r.address as id, r.address as text'))->where('s.contact_no', $contactNo)->where('r.address', 'like', "{$search}%")->orderBy('r.address', 'ASC')->get();
			} else {
				$items = DB::table('receivers as r')->leftJoin('senders as s', 's.id', '=', 'r.sender_id')->select(\DB::raw('r.address as id, r.address as text'))->where('s.member_no', $memberNo)->where('r.address', 'like', "{$search}%")->orderBy('r.address', 'ASC')->get();
			}
		} else {
			if ($contactNo) {
				$items = DB::table('receivers as r')->leftJoin('senders as s', 's.id', '=', 'r.sender_id')->select(\DB::raw('r.address as id, r.address as text'))->where('r.company_id', Auth::user()->company_id)->where('s.contact_no', $contactNo)->where('r.address', 'like', "{$search}%")->orderBy('r.address', 'ASC')->get();
			} else {
				$items = DB::table('receivers as r')->leftJoin('senders as s', 's.id', '=', 'r.sender_id')->select(\DB::raw('r.address as id, r.address as text'))->where('r.company_id', Auth::user()->company_id)->where('s.member_no', $memberNo)->where('r.address', 'like', "{$search}%")->orderBy('r.address', 'ASC')->get();
			}
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
		$contactNo = $request->get('contactNo');
		$memberNo  = $request->get('memberNo');

		if (Auth::user()->hasRole('administrator')) {
			if ($contactNo) {
				$items = DB::table('receivers as r')
					->leftJoin('senders as s', 's.id', '=', 'r.sender_id')
					->leftJoin('nric_townships as snt', 'snt.id', '=', 's.nric_township_id')
					->leftJoin('nric_townships as rnt', 'rnt.id', '=', 'r.nric_township_id')
					->where('s.contact_no', $contactNo)
					->select('r.*', 's.name as s_name', 's.contact_no as s_contact_no', 's.nric_no as s_nric_no', 's.nric_code_id as s_nric_code_id', 's.nric_township_id as s_nric_tp_id', 'snt.short_name as s_township', 'rnt.short_name as r_township')
					->first();
			} else {
				$items = DB::table('receivers as r')
					->leftJoin('senders as s', 's.id', '=', 'r.sender_id')
					->leftJoin('nric_townships as snt', 'snt.id', '=', 's.nric_township_id')
					->leftJoin('nric_townships as rnt', 'rnt.id', '=', 'r.nric_township_id')
					->where('s.member_no', $memberNo)
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
					->where('contact_no', $contactNo)
					->select('r.*', 's.name as s_name', 's.contact_no as s_contact_no', 's.nric_no as s_nric_no', 's.nric_code_id as s_nric_code_id', 's.nric_township_id as s_nric_tp_id', 'snt.short_name as s_township', 'rnt.short_name as r_township')
					->first();
			} else {
				$items = DB::table('receivers as r')
					->leftJoin('senders as s', 's.id', '=', 'r.sender_id')
					->leftJoin('nric_townships as snt', 'snt.id', '=', 's.nric_township_id')
					->leftJoin('nric_townships as rnt', 'rnt.id', '=', 'r.nric_township_id')
					->where('s.company_id', Auth::user()->company_id)
					->where('member_no', $memberNo)
					->select('r.*', 's.name as s_name', 's.contact_no as s_contact_no', 's.nric_no as s_nric_no', 's.nric_code_id as s_nric_code_id', 's.nric_township_id as s_nric_tp_id', 'snt.short_name as s_township', 'rnt.short_name as r_township')
					->first();
			}
		}

		return json_encode($items, JSON_UNESCAPED_UNICODE);

		// if (count($items) > 0) {
		// 	return '1';
		// } else {
		// 	return '0';
		// }

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function searchUnitPrices(Request $request) {
		$priceId = $request->get('priceId');

		$price = Price::where('id', $priceId)->first();

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
	public function searchReceiverByAddress(Request $request) {
		$address = $request->get('address');

		$receiver = DB::table('receivers as r')
			->leftJoin('nric_townships as rnt', 'rnt.id', '=', 'r.nric_township_id')
			->select('r.*', 'rnt.short_name as r_township')
			->where('address', $address)->first();

		$header = array(
			'Content-Type' => 'application/json; charset=UTF-8',
			'charset'      => 'utf-8',
		);

		return json_encode($receiver, JSON_UNESCAPED_UNICODE);
	}
}
