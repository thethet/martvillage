<?php

namespace App\Http\Controllers;

use App\Companies;
use App\States;
use App\Lotin;
use Auth;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('reports.index');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function reportByTrips(Request $request)
	{
		if($request->dept_date) {
			$deptDate = date('Y-m-d', strtotime($request->dept_date));
		} else {
			$deptDate = date('Y-m-d');
		}

		$outgoings = DB::table('outgoings')->where('packing_list', '!=', 0)->orderBy('dept_date', 'ASC')->where('dept_date', $deptDate)->get();
		$company   = Companies::find(Auth::user()->company_id);

		$stateIds    = $company->states;
		$stateIdList = array();
		foreach ($stateIds as $stateId) {
			$stateIdList[] = $stateId->id;
		};

		$stateList   = States::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_code', 'ASC')->lists('state_code', 'id');

		$tripReportLists = array();

		$tripList = array();

		foreach ($outgoings as $outgoing) {
			$incomeWithGst         = 0;
			$totalIncome         = 0;
			$totalGst            = 0;
			$totalServiceCharges = 0;
			$totalMemberDiscount = 0;
			$totalOtherDiscount  = 0;
			$totalDiscount       = 0;
			$items               = DB::table('items')->where('outgoing_id', $outgoing->id)->get();
			foreach ($items as $item) {
				$lotin = Lotin::find($item->lotin_id);
				$totalIncome += $item->amount;
				$totalGst += $item->amount * $company->gst_rate / 100;
				$totalServiceCharges += $item->amount * $company->service_rate / 100;
				$totalMemberDiscount += $item->amount * $lotin->member_discount / 100;
				// $totalOtherDiscount += $item->amount * $lotin->other_discount / 100;
				$totalOtherDiscount += $item->amount * 10 / 100;

				$incomeWithGst += $totalIncome + $totalGst + $totalServiceCharges;
			}
			$totalDiscount                   = $totalMemberDiscount + $totalOtherDiscount;
			$netIncome                       = $incomeWithGst - $totalDiscount;
			$outgoing->total_income          = $incomeWithGst;
			$outgoing->net_income            = $netIncome;
			$outgoing->total_gst             = $totalGst;
			$outgoing->total_service_charges = $totalServiceCharges;
			$outgoing->total_member_discount = $totalMemberDiscount;
			$outgoing->total_other_discount  = $totalOtherDiscount;
			$outgoing->total_discount        = $totalDiscount;


			if(!in_array($stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city], $tripList)) {
				$tripList[] = $stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city];
			}

			if (array_key_exists($stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city], $tripReportLists)) {
				$count                                                              = count($tripReportLists[$stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city]]);
				$tripReportLists[$stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city]][$count] = $outgoing;
			} else {

				$tripReportLists[$stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city]]         = array();
				$count                                                              = count($tripReportLists[$stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city]]);
				$tripReportLists[$stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city]][$count] = $outgoing;
			}
		}

		// dd($tripReportLists);

		return view('reports.report-by-trip', ['tripList' => $tripList, 'tripReportLists' => $tripReportLists]);
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
		//
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
