<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
use App\State;
use App\Township;
use Auth;
use Illuminate\Http\Request;
use Session;

class CompanyController extends Controller {
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
		if (Auth::user()->hasRole('administrator')) {
			$companies = Company::where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
		} else {
			$companies = Company::where('id', Auth::user()->company_id)->where('deleted', 'N')
				->orderBy('id', 'DESC')->paginate(10);
		}
		$total       = $companies->total();
		$perPage     = $companies->perPage();
		$currentPage = $companies->currentPage();
		$lastPage    = $companies->lastPage();
		$lastItem    = $companies->lastItem();

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

		$countryList  = Country::whereIn('id', $countryIdList)->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList    = State::whereIn('id', $stateIdList)->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townshipList = Township::whereIn('id', $townshipIdList)->orderBy('township_name', 'ASC')->lists('township_name', 'id');

		return view('companies.index', ['companies' => $companies, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'countryList' => $countryList, 'stateList' => $stateList, 'townshipList' => $townshipList])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
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

		$countryList  = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList    = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townshipList = Township::whereIn('id', $townshipIdList)->where('deleted', 'N')->orderBy('township_name', 'ASC')->lists('township_name', 'id');

		return view('companies.create', ['countryList' => $countryList, 'stateList' => $stateList, 'townshipList' => $townshipList]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'company_name'  => 'required',
			'short_code'    => 'required|unique:companies,short_code',
			'contact_no'    => 'required|numeric',
			'email'         => 'required|email|unique:companies,email',
			'expiry_date'   => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
			'image'         => 'mimes:jpeg,jpg,bmp,png',
			'return_period' => 'required|integer',
			'gst_rate'      => 'required|numeric',
			'service_rate'  => 'required|numeric',
			'country_id'    => 'required',
			'state_id'      => 'required',
			'township_id'   => 'required',
		]);

		$imageName = $this->fileUpload($request);
		if ($imageName) {
			$data['logo'] = $imageName;
		}

		$data    = $request->all();
		$address = '';
		$address .= ($request->unit_number) ? ($request->unit_number . '-') : '';
		$address .= ($request->building_name) ? ($request->building_name . ', ') : '';
		$address .= ($request->street) ? ($request->street . ', ') : '';
		$data['address']    = $address;
		$data['created_by'] = Auth::user()->id;

		Company::create($data);

		return redirect()->route('companies.index')
			->with('success', 'Company created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$company = Company::find($id);

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

		$countryList  = Country::whereIn('id', $countryIdList)->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList    = State::whereIn('id', $stateIdList)->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townshipList = Township::whereIn('id', $townshipIdList)->orderBy('township_name', 'ASC')->lists('township_name', 'id');

		return view('companies.show', ['company' => $company, 'countryList' => $countryList, 'stateList' => $stateList, 'townshipList' => $townshipList]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$company = Company::find($id);

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

		$countryList  = Country::whereIn('id', $countryIdList)->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');
		$stateList    = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');
		$townshipList = Township::whereIn('id', $townshipIdList)->where('deleted', 'N')->orderBy('township_name', 'ASC')->lists('township_name', 'id');

		return view('companies.edit', ['company' => $company, 'countryList' => $countryList, 'stateList' => $stateList, 'townshipList' => $townshipList]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'company_name'  => 'required',
			// 'short_code'   => 'required|unique:companies,short_code',
			'contact_no'    => 'required|numeric',
			'expiry_date'   => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
			'image'         => 'mimes:jpeg,jpg,bmp,png',
			'return_period' => 'required|integer',
			'gst_rate'      => 'required|numeric',
			'service_rate'  => 'required|numeric',
			'country_id'    => 'required',
			'state_id'      => 'required',
			'township_id'   => 'required',
		]);

		$data    = $request->all();
		$address = '';
		$address .= ($request->unit_number) ? ($request->unit_number . '-') : '';
		$address .= ($request->building_name) ? ($request->building_name . ', ') : '';
		$address .= ($request->street) ? ($request->street . ', ') : '';
		$data['address']    = $address;
		$data['updated_by'] = Auth::user()->id;

		$imageName = $this->fileUpload($request);
		if ($imageName) {
			$data['logo'] = $imageName;
		}

		$company  = Company::find($id);
		$oldImage = $company->logo;
		$company->update($data);

		if ($imageName) {
			$this->destroyFile($oldImage);
		}

		/*$sent = Mail::send('emails.company-creation-mail', ['company' => $company], function ($message) use ($company) {
		$message->from('martvillageprj@gmail.com');
		$message->to('thetthetaye2709@gmail.com', '')->subject('Your company has been created');
		});

		if ($sent) {
		echo "successfully sent";
		} else {
		echo "cannot send";
		}
		die;*/

		return redirect()->route('companies.index')
			->with('success', 'Company updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Company::find($id)->update(['deleted' => 'Y']);
		Session::flash('success', 'Company deleted successfully');
		$response = array('status' => 'success', 'url' => 'companies');

		return response()->json($response);
	}

	/**
	 * File upload
	 *
	 * @param ConsultantRequest $request
	 * @return static
	 */
	public function fileUpload($request) {
		if ($request->hasFile('image') && $request->file('image')->getError() == 0) {
			$extension = $request->file('image')->getClientOriginalExtension();
			$imageName = rand(11111, 99999) . '.' . $extension;
			$path      = 'uploads/logos';
			$request->file('image')->move($path, $imageName);
			return $imageName;
		} else {
			// sending back with error message.
			\Session::flash('error', 'uploaded file is not valid');
		}
	}

	/**
	 * File Destroy
	 *
	 * @param ConsultantRequest $request
	 * @return static
	 */
	public function destroyFile($file) {
		$fileName = 'uploads/logos/' . $file;
		if (file_exists($fileName)) {
			@unlink($fileName);
		}
	}
}
