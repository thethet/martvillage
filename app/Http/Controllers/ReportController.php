<?php

namespace App\Http\Controllers;

use App\Companies;
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
		$outgoings = DB::table('outgoings')->where('packing_list', '!=', 0)->orderBy('dept_date', 'ASC')->get();
		$company   = Companies::find(Auth::user()->company_id);

		$tripReportLists = array();

		$tripLists = array();
		$tripLists[] = '1-4';
		$tripLists[] = '1-3';


		foreach ($outgoings as $outgoing) {
			$totalIncome         = 0;
			$totalGst            = 0;
			$totalServiceCharges = 0;
			$totalMemberDiscount = 0;
			$totalOtherDiscount  = 0;
			$totalDiscount       = 0;
			$items               = DB::table('items')->where('outgoing_id', $outgoing->id)->get();
			foreach ($items as $item) {
				$lotin = Lotin::find($item->lotin_id);
				$totalIncome += $item->unit_price;
				$totalGst += $item->unit_price * $company->gst_rate / 100;
				$totalServiceCharges += $item->unit_price * $company->service_rate / 100;
				$totalMemberDiscount += $item->unit_price * $lotin->member_discount / 100;
				// $totalOtherDiscount += $item->unit_price * $lotin->other_discount / 100;
			}
			$totalDiscount                   = $totalMemberDiscount                   = $totalOtherDiscount;
			$outgoing->total_income          = $totalIncome;
			$outgoing->total_gst             = $totalGst;
			$outgoing->total_service_charges = $totalServiceCharges;
			$outgoing->total_member_discount = $totalMemberDiscount;
			$outgoing->total_other_discount  = $totalOtherDiscount;
			$outgoing->total_discount        = $totalDiscount;

			$tripList[] = $outgoing->from_city . '-' . $outgoing->to_city;
			if (array_key_exists($outgoing->from_city . '-' . $outgoing->to_city, $tripReportLists)) {
				$count                                                              = count($tripReportLists[$outgoing->from_city . '-' . $outgoing->to_city]);
				$tripReportLists[$outgoing->from_city . '-' . $outgoing->to_city][$count] = $outgoing;
			} else {

				$tripReportLists[$outgoing->from_city . '-' . $outgoing->to_city]         = array();
				$count                                                              = count($tripReportLists[$outgoing->from_city . '-' . $outgoing->to_city]);
				$tripReportLists[$outgoing->from_city . '-' . $outgoing->to_city][$count] = $outgoing;
			}
		}

		dd($tripList);

		return view('reports.report-by-trip', ['tripList' => $tripReportLists]);

		dd($tripReportLists);
		echo "welcome";
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
