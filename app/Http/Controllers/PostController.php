<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Auth;
use Illuminate\Http\Request;
use Session;

class PostController extends Controller {
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
		$posts = Post::where('deleted', 'N')->paginate(3);

		$total       = $posts->total();
		$perPage     = $posts->perPage();
		$currentPage = $posts->currentPage();
		$lastPage    = $posts->lastPage();
		$lastItem    = $posts->lastItem();

		return view('posts.index', ['posts' => $posts, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem])->with('i', ($request->get('page', 1) - 1) * 3);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$tagList = Tag::where('deleted', 'N')->lists('tag_name', 'id');

		return view('posts.create', ['tagList' => $tagList]);
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
			'tags_id'   => 'required',
			'post_name' => 'required',
			'content'   => 'required',
			'post_img'  => 'mimes:jpeg,jpg,bmp,png',
		]);

		$data      = $request->all();
		$imageName = $this->fileUpload($request);
		if ($imageName) {
			$data['post_img'] = $imageName;
		}
		$data['created_by'] = Auth::user()->id;

		Post::create($data);

		return redirect()->route('posts.index')
			->with('success', 'Post created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$tagList = Tag::where('deleted', 'N')->lists('tag_name', 'id');
		$post    = Post::find($id);

		return view('posts.show', ['post' => $post, 'tagList' => $tagList]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$tagList = Tag::where('deleted', 'N')->lists('tag_name', 'id');
		$post    = Post::find($id);

		return view('posts.edit', ['post' => $post, 'tagList' => $tagList]);
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
			'post_name' => 'required',
			'post_img'  => 'mimes:jpeg,jpg,bmp,png',
		]);

		$data      = $request->all();
		$imageName = $this->fileUpload($request);
		if ($imageName) {
			$data['post_img'] = $imageName;
		}
		$data['updated_by'] = Auth::user()->id;

		$post     = Post::find($id);
		$oldImage = $post->post_img;
		$post->update($data);

		if ($imageName) {
			$this->destroyFile($oldImage);
		}

		return redirect()->route('posts.index')
			->with('success', 'Post updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Post::find($id)->update(['deleted' => 'Y', 'deleted_by' => Auth::user()->id]);
		Session::flash('success', 'Post deleted successfully');
		$response = array('status' => 'success', 'url' => 'posts');

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
			$path      = 'uploads/posts';
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
		$fileName = 'uploads/posts/' . $file;
		if (file_exists($fileName)) {
			@unlink($fileName);
		}
	}
}
