<?php

namespace App\Http\Controllers;

use App\Slider;
use Auth;
use Illuminate\Http\Request;
use Session;

class SliderController extends Controller {
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
		$sliders = Slider::where('deleted', 'N')->paginate(3);

		$total       = $sliders->total();
		$perPage     = $sliders->perPage();
		$currentPage = $sliders->currentPage();
		$lastPage    = $sliders->lastPage();
		$lastItem    = $sliders->lastItem();

		return view('sliders.index', ['sliders' => $sliders, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem])->with('i', ($request->get('page', 1) - 1) * 3);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('sliders.create');
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

		$this->validate($request, [
			'slider_name' => 'required',
			'slider_img'  => 'mimes:jpeg,jpg,bmp,png',
		]);

		$data      = $request->all();
		$imageName = $this->fileUpload($request);
		if ($imageName) {
			$data['slider_img'] = $imageName;
		}
		$data['created_by'] = Auth::user()->id;

		Slider::create($data);

		return redirect()->route('sliders.index')
			->with('success', 'Slider created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$slider = Slider::find($id);
		return view('sliders.show', ['slider' => $slider]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$slider = Slider::find($id);
		return view('sliders.edit', ['slider' => $slider]);
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

		$this->validate($request, [
			'slider_name' => 'required',
			'slider_img'  => 'mimes:jpeg,jpg,bmp,png',
		]);

		$data      = $request->all();
		$imageName = $this->fileUpload($request);
		if ($imageName) {
			$data['slider_img'] = $imageName;
		}
		$data['updated_by'] = Auth::user()->id;

		$slider   = Slider::find($id);
		$oldImage = $slider->slider_img;
		$slider->update($data);

		if ($imageName) {
			$this->destroyFile($oldImage);
		}

		return redirect()->route('sliders.index')
			->with('success', 'Slider updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Slider::find($id)->update(['deleted' => 'Y', 'deleted_by' => Auth::user()->id]);
		Session::flash('success', 'Slider deleted successfully');
		$response = array('status' => 'success', 'url' => 'sliders');

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
			$path      = 'uploads/sliders';
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
		$fileName = 'uploads/sliders/' . $file;
		if (file_exists($fileName)) {
			@unlink($fileName);
		}
	}
}
