<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use Auth;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller {
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
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$categories  = Category::where('deleted', 'N')->paginate(10);
		$total       = $categories->total();
		$perPage     = $categories->perPage();
		$currentPage = $categories->currentPage();
		$lastPage    = $categories->lastPage();
		$lastItem    = $categories->lastItem();

		return view('categories.index', ['categories' => $categories, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem, 'companyList' => $companyList])->with('i', ($request->get('page', 1) - 1) * 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');

		return view('categories.create', ['companyList' => $companyList]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'company_id' => 'required',
			'name'       => 'required',
			'unit'       => 'required',
		]);

		$data               = $request->all();
		$data['created_by'] = Auth::user()->id;

		$category = Category::create($data);

		return redirect()->route('categories.index')
			->with('success', 'Category created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$category    = Category::find($id);

		return view('categories.show', ['category' => $category, 'companyList' => $companyList]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$companyList = Company::where('deleted', 'N')->orderBy('company_name', 'ASC')->lists('company_name', 'id');
		$category    = Category::find($id);

		return view('categories.edit', ['category' => $category, 'companyList' => $companyList]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$this->validate($request, [
			'company_id' => 'required',
			'name'       => 'required',
			'unit'       => 'required',
		]);

		$data               = $request->all();
		$data['updated_by'] = Auth::user()->id;

		$category = Category::find($id);
		$category->update($data);

		return redirect()->route('categories.index')
			->with('success', 'Category updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Category::find($id)->update(['deleted' => 'Y']);
		Session::flash('success', 'Category deleted successfully');
		$response = array('status' => 'success', 'url' => 'categories');

		return response()->json($response);
	}
}
