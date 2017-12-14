<?php

namespace App\Http\Controllers;

use App\Item;
use App\Lotin;
use App\Outgoing;
use Auth;
use Illuminate\Http\Request;

class IncomingController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		if ($request->arrival_date) {
			$arrivalDate = date('Y-m-d', strtotime($request->arrival_date));
		} else {
			$arrivalDate = date('Y-m-d');
		}

		if ($request->arrival_time) {
			$currentTime = date('H:i A', strtotime($request->arrival_time));
		} else {
			$currentTime = date('H:i A');
		}

		$query = Outgoing::where('arrival_date', $arrivalDate)
		// ->where('arrival_time', '<=', $currentTime)
			->where('deleted', 'N');

		if (Auth::user()->hasRole('administrator')) {
			$outgoingList = $query->paginate(10);
		} elseif (Auth::user()->hasRole('owner')) {
			$outgoingList = $query->where('company_id', Auth::user()->company_id)->paginate(10);
		} else {
			$outgoingList = $query->where('company_id', Auth::user()->company_id)
				->where('to_city', Auth::user()->state_id)->paginate(10);
		}
		$total       = $outgoingList->total();
		$perPage     = $outgoingList->perPage();
		$currentPage = $outgoingList->currentPage();
		$lastPage    = $outgoingList->lastPage();
		$lastItem    = $outgoingList->lastItem();

		return view('incomings.index', ['outgoingList' => $outgoingList, 'total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage, 'lastPage' => $lastPage, 'lastItem' => $lastItem])->with('p', ($request->get('page', 1) - 1) * 5);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function search(Request $request) {
		if ($request->arrival_date) {
			$arrivalDate = date('Y-m-d', strtotime($request->arrival_date));
		} else {
			$arrivalDate = date('Y-m-d');
		}

		if ($request->arrival_time) {
			$currentTime = date('H:i A', strtotime($request->arrival_time));
		} else {
			$currentTime = date('H:i A');
		}

		$query = Outgoing::where('arrival_date', $arrivalDate)
		// ->where('arrival_time', '>=', $currentTime)
			->where('deleted', 'N');

		if (Auth::user()->hasRole('administrator')) {
			$outgoingList = $query->get();
		} elseif (Auth::user()->hasRole('owner')) {
			$outgoingList = $query->where('company_id', Auth::user()->company_id)->get();
		} else {
			$outgoingList = $query->where('company_id', Auth::user()->company_id)
				->where('to_city', Auth::user()->state_id)->get();
		}

		return view('incomings.index', ['outgoingList' => $outgoingList]);
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
	public function store() {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$outgoing = Outgoing::find($id);

		return view('incomings.show', ['outgoing' => $outgoing]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		Item::find($id)->update(['status' => 2]);

		$item = Item::find($id);

		$allLotCount = Item::where('lotin_id', $item->lotin_id)->count();

		$arriveLotCount = Item::where('lotin_id', $item->lotin_id)->where('status', 2)->count();

		$incomingDate = date('Y-m-d');
		if ($allLotCount == $arriveLotCount) {
			Lotin::find($item->lotin_id)->update(['status' => 2, 'incoming_date' => $incomingDate]);
		}
		return redirect()->back()->with('success', 'Item is successfully arrive');
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
}
