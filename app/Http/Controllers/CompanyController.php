<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Countries;
use App\States;
use App\Townships;
use Auth;
use Illuminate\Http\Request;
use Session;

class CompanyController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		if (Auth::user()->hasRole('administrator')) {
			$companies = Companies::where('deleted', 'N')->orderBy('id', 'DESC')->paginate(10);
		} else {
			$companies = Companies::where('id', Auth::user()->company_id)->where('deleted', 'N')
				->orderBy('id', 'DESC')->paginate(10);
		}

		return view('companies.index', ['companies' => $companies])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		if (Auth::user()->hasRole('administrator')) {
			$countries = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')
				->lists('country_name', 'id');

			$states = States::where('deleted', 'N')->orderBy('state_name', 'ASC')
				->lists('state_name', 'id');

			$townships = Townships::where('deleted', 'N')->orderBy('township_name', 'ASC')
				->lists('township_name', 'id');
		} else {
			$countries = Countries::where('company_id', Auth::user()->company_id)
				->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');

			$states = States::where('company_id', Auth::user()->company_id)
				->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

			$townships = Townships::where('company_id', Auth::user()->company_id)
				->where('deleted', 'N')->orderBy('township_name', 'ASC')->lists('township_name', 'id');
		}

		return view('companies.create', ['countries' => $countries, 'states' => $states, 'townships' => $townships]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'company_name' => 'required',
			'short_code'   => 'required|unique:companies,short_code',
			'contact_no'   => 'required',
			'email'        => 'required|email|unique:companies,email',
			'expiry_date'  => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
			'image'        => 'mimes:jpeg,bmp,png',
		]);

		$imageName = $this->fileUpload($request);
		if ($imageName) {
			$data['logo'] = $imageName;
		}

		$data    = $request->all();
		$address = '';
		$address .= ($request->unit_number) ? ($request->unit_number . ', ') : '';
		$address .= ($request->building_name) ? ($request->building_name . ', ') : '';
		$address .= ($request->street) ? ($request->street) : '';
		$data['address']    = $address;
		$data['created_by'] = Auth::user()->id;

		$company = Companies::create($data);

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
		$company = Companies::find($id);

		return view('companies.show', ['company' => $company]);
	}

	/**
	 * Redirect Route Using Ajax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editAjax($companyId, Request $request) {
		$id       = $request->id;
		$response = array('status' => 'success', 'url' => 'companies/' . $id . '/edit');

		return response()->json($response);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$company = Companies::find($id);

		if (Auth::user()->hasRole('administrator')) {
			$countries = Countries::where('deleted', 'N')->orderBy('country_name', 'ASC')
				->lists('country_name', 'id');

			$states = States::where('deleted', 'N')->orderBy('state_name', 'ASC')
				->lists('state_name', 'id');

			$townships = Townships::where('deleted', 'N')->orderBy('township_name', 'ASC')
				->lists('township_name', 'id');
		} else {
			$countries = Countries::where('company_id', Auth::user()->company_id)
				->where('deleted', 'N')->orderBy('country_name', 'ASC')->lists('country_name', 'id');

			$states = States::where('company_id', Auth::user()->company_id)
				->where('deleted', 'N')->orderBy('state_name', 'ASC')->lists('state_name', 'id');

			$townships = Townships::where('company_id', Auth::user()->company_id)
				->where('deleted', 'N')->orderBy('township_name', 'ASC')->lists('township_name', 'id');
		}

		return view('companies.edit', ['company' => $company, 'countries' => $countries, 'states' => $states, 'townships' => $townships]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'company_name' => 'required',
			'short_code'   => 'required|unique:companies,short_code',
			'contact_no'   => 'required',
			'expiry_date'  => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
			'image'        => 'mimes:jpeg,bmp,png',
		]);

		$data    = $request->all();
		$address = '';
		$address .= ($request->unit_number) ? ($request->unit_number . ', ') : '';
		$address .= ($request->building_name) ? ($request->building_name . ', ') : '';
		$address .= ($request->street) ? ($request->street) : '';
		$data['address']    = $address;
		$data['updated_by'] = Auth::user()->id;

		$imageName = $this->fileUpload($request);
		if ($imageName) {
			$data['logo'] = $imageName;
		}

		$company  = Companies::find($id);
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
		Companies::find($id)->update(['deleted' => 'Y']);
		Session::flash('success', 'Company deleted successfully');
		$response = array('status' => 'success', 'url' => 'companies');

		return response()->json($response);

		// return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
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
