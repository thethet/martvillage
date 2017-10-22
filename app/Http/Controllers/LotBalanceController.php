<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;

class LotBalanceController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$today = date('Y-m-d');
		$start = date("Y-m-d", strtotime($today . "-30 day"));
		$end   = date("Y-m-d", strtotime($today));

		$lotinList = array();
		for ($k = 0; $k < 31; $k++) {
			$startDate = date("Y-m-d", strtotime($start . "+" . $k . " day"));
			if (Auth::user()->hasRole('administrator')) {
				$lotin     = DB::table('lotins as l')
							->select('l.*', 's.name as sender_name', 'r.name as receiver_name', 'fst.state_name as fstate_name', 'tst.state_name as tstate_name')
							->leftJoin('senders as s', 's.id', '=', 'l.sender_id')
							->leftJoin('receivers as r', 'r.id', '=', 'l.receiver_id')
							->leftJoin('states as fst', 'fst.id', '=', 'l.from_state')
							->leftJoin('states as tst', 'tst.id', '=', 'l.to_state')
							->where('l.status', '0')
							->where('l.deleted', 'N')
							->where('l.date', $startDate)
							// ->where('l.company_id', Auth::user()->company_id)
							// ->where('l.from_country', $outgoing->from_country)
							// ->where('l.from_state', $outgoing->from_city)
							// ->where('l.to_country', $outgoing->to_country)
							// ->where('l.to_state', $outgoing->to_city)
							->orderBy('l.date', 'ASC')->get();
			} else {
				$lotin     = DB::table('lotins as l')
							->select('l.*', 's.name as sender_name', 'r.name as receiver_name', 'fst.state_name as fstate_name', 'tst.state_name as tstate_name')
							->leftJoin('senders as s', 's.id', '=', 'l.sender_id')
							->leftJoin('receivers as r', 'r.id', '=', 'l.receiver_id')
							->leftJoin('states as fst', 'fst.id', '=', 'l.from_state')
							->leftJoin('states as tst', 'tst.id', '=', 'l.to_state')
							->where('l.status', '0')
							->where('l.deleted', 'N')
							->where('l.date', $startDate)
							->where('l.company_id', Auth::user()->company_id)
							// ->where('l.from_country', $outgoing->from_country)
							// ->where('l.from_state', $outgoing->from_city)
							// ->where('l.to_country', $outgoing->to_country)
							// ->where('l.to_state', $outgoing->to_city)
							->orderBy('l.date', 'ASC')->get();
			}
			if (count($lotin) > 0) {
				$lotinList[$startDate] = $lotin;
			}
		}

		return view('lotbalances.index', ['lotinList' => $lotinList]);
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
		//
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
