<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Outgoing;
use App\Item;
use App\Lotin;

use App\Http\Requests;

class IncomingController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$deptDate = date('Y-m-d');
		$currentTime = date('H:i A');
		if (Auth::user()->hasRole('administrator')) {
			$outgoingList = Outgoing::where('dept_date', $deptDate)->where('time', '<=', $currentTime)->where('deleted', 'N')->get();
		} else {
			$outgoingList = Outgoing::where('dept_date', $deptDate)->where('time', '<=', $currentTime)->where('company_id', Auth::user()->company_id)->where('deleted', 'N')->get();
		}

		return view('incomings.index', ['outgoingList' => $outgoingList]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$outgoing = Outgoing::find($id);

		return view('incomings.show', ['outgoing' => $outgoing]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		Item::find($id)->update(['status' => 2]);

		$item = Item::find($id);

		$allLotCount = Item::where('lotin_id', $item->lotin_id)->count();

		$arriveLotCount = Item::where('lotin_id', $item->lotin_id)->where('status', 2)->count();

		if($allLotCount == $arriveLotCount) {
			Lotin::find($item->lotin_id)->update(['status' => 2]);
		}
		return redirect()->back()->with('success', 'Item is successfully arrive');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}
