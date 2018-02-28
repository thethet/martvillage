<?php

namespace App\Http\Controllers;

use App\Tag;
use Auth;
use Illuminate\Http\Request;
use Session;

class TagController extends Controller {
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
		$tags = Tag::where('deleted', 'N')->paginate(10);

		$total       = $tags->total();
		$perPage     = $tags->perPage();
		$currentPage = $tags->currentPage();
		$lastPage    = $tags->lastPage();
		$lastItem    = $tags->lastItem();

		return view('tags.index', ['tags' => $tags, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('tags.create');
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
			'tag_name' => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;

		Tag::create($data);

		return redirect()->route('tags.index')
			->with('success', 'Tag created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$tag = Tag::find($id);
		return view('tags.show', ['tag' => $tag]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$tag = Tag::find($id);
		return view('tags.edit', ['tag' => $tag]);
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
			'tag_name' => 'required',
		]);

		$data               = $request->all();
		$data['updated_by'] = Auth::user()->id;
		$tag                = Tag::find($id);
		$tag->update($data);

		return redirect()->route('tags.index')
			->with('success', 'Tag updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Tag::find($id)->update(['deleted' => 'Y', 'deleted_by' => Auth::user()->id]);
		Session::flash('success', 'Tag deleted successfully');
		$response = array('status' => 'success', 'url' => 'tags');

		return response()->json($response);
	}
}
