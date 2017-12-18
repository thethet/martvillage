<?php

namespace App\Http\Controllers;

use App\Company;
use App\Lotin;
use App\State;
use Auth;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return view('reports.index');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function reportByTrips(Request $request) {
		if ($request->dept_date) {
			$deptDate = date('Y-m-d', strtotime($request->dept_date));
		} else {
			$deptDate = date('Y-m-d');
		}

		$query     = DB::table('outgoings')->where('packing_list', '!=', 0)->where('dept_date', $deptDate);
		$myCompany = Company::find(Auth::user()->company_id);

		if (Auth::user()->hasRole('administrator')) {
			$outgoings = $query->orderBy('dept_date', 'ASC')->get();
		} elseif (Auth::user()->hasRole('owner')) {
			$outgoings = $query->where('company_id', Auth::user()->company_id)
				->orderBy('dept_date', 'ASC')->get();
		} else {
			$outgoings = $query->where('from_city', Auth::user()->state_id)
				->where('company_id', Auth::user()->company_id)
				->orderBy('dept_date', 'ASC')->get();
		}

		$stateIds    = $myCompany->states;
		$stateIdList = array();
		foreach ($stateIds as $stateId) {
			$stateIdList[] = $stateId->id;
		};

		$stateList = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_code', 'ASC')->lists('state_code', 'id');

		$tripReportLists = array();

		$tripList = array();

		foreach ($outgoings as $outgoing) {
			$incomeWithGst       = 0;
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
				$totalGst += $item->amount * $myCompany->gst_rate / 100;
				$totalServiceCharges += $item->amount * $myCompany->service_rate / 100;
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

			if (!in_array($stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city], $tripList)) {
				$tripList[] = $stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city];
			}

			if (array_key_exists($stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city], $tripReportLists)) {
				$count                                                                                            = count($tripReportLists[$stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city]]);
				$tripReportLists[$stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city]][$count] = $outgoing;
			} else {

				$tripReportLists[$stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city]]         = array();
				$count                                                                                            = count($tripReportLists[$stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city]]);
				$tripReportLists[$stateList[$outgoing->from_city] . '-' . $stateList[$outgoing->to_city]][$count] = $outgoing;
			}
		}

		return view('reports.report-by-trip', ['tripList' => $tripList, 'tripReportLists' => $tripReportLists]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function salesReport(Request $request) {
		if ($request->date) {
			$date = date('Y-m-d', strtotime($request->date));
		} else {
			$date = date('Y-m-d');
		}

		$queryByCash = Lotin::where('date', $date)->where('payment', 'Paid');
		if (Auth::user()->hasRole('administrator')) {
			$byCashes = $queryByCash->orderBy('from_state', 'ASC')->get();
		} elseif (Auth::user()->hasRole('owner')) {
			$byCashes = $queryByCash->where('company_id', Auth::user()->company_id)
				->orderBy('from_state', 'ASC')->get();
		} else {
			$byCashes = $queryByCash->where('from_state', Auth::user()->state_id)
				->where('company_id', Auth::user()->company_id)
				->orderBy('from_state', 'ASC')->get();
		}

		$queryByCredit = Lotin::where('date', $date)->where('payment', 'Credit');
		if (Auth::user()->hasRole('administrator')) {
			$byCredits = $queryByCredit->orderBy('from_state', 'ASC')->get();
		} elseif (Auth::user()->hasRole('owner')) {
			$byCredits = $queryByCredit->where('company_id', Auth::user()->company_id)
				->orderBy('from_state', 'ASC')->get();
		} else {
			$byCredits = $queryByCredit->where('from_state', Auth::user()->state_id)
				->where('company_id', Auth::user()->company_id)
				->orderBy('from_state', 'ASC')->get();
		}

		$myCompany   = Company::find(Auth::user()->company_id);
		$stateIds    = $myCompany->state;
		$stateIdList = array();
		foreach ($stateIds as $stateId) {
			$stateIdList[] = $stateId->id;
		};
		$stateList = State::whereIn('id', $stateIdList)->where('deleted', 'N')->orderBy('state_code', 'ASC')->lists('state_code', 'id');

		$lotinsByCash   = array();
		$lotinsByCredit = array();

		foreach ($byCashes as $key => $byCash) {
			$salesAmt = $gstAmt = $serviceAmt = $memberDisAmt = $otherDisAmt = $netAmt = $totalDisAmt = $totalSalesAmt = 0;

			$salesAmt      = $byCash->total_amt;
			$gstAmt        = $byCash->total_amt * $myCompany->gst_rate / 100;
			$serviceAmt    = $byCash->total_amt * $myCompany->service_rate / 100;
			$memberDisAmt  = $byCash->total_amt * $byCash->member_discount / 100;
			$otherDisAmt   = $byCash->total_amt * $byCash->other_discount / 100;
			$totalSalesAmt = $salesAmt + $gstAmt + $serviceAmt;
			$totalDisAmt   = $memberDisAmt + $otherDisAmt;
			$netAmt        = $totalSalesAmt - $totalDisAmt;

			if (array_key_exists($stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state], $lotinsByCash)) {
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['sales_amt'] += $salesAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['gst_amt'] += $gstAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['service_amt'] += $serviceAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['member_dis_amt'] += $memberDisAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['other_dis_amt'] += $otherDisAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['total_sales'] += $totalSalesAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['total_dis'] += $totalDisAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['net_sales'] += $netAmt;
			} else {
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['sales_amt']      = $salesAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['gst_amt']        = $gstAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['service_amt']    = $serviceAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['member_dis_amt'] = $memberDisAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['other_dis_amt']  = $otherDisAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['total_sales']    = $totalSalesAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['total_dis']      = $totalDisAmt;
				$lotinsByCash[$stateList[$byCash->from_state] . '-' . $stateList[$byCash->to_state]]['net_sales']      = $netAmt;
			}
		}

		foreach ($byCredits as $key => $byCredit) {
			$salesAmt = $gstAmt = $serviceAmt = $memberDisAmt = $otherDisAmt = $netAmt = $totalDisAmt = $totalSalesAmt = 0;

			$salesAmt      = $byCredit->total_amt;
			$gstAmt        = $byCredit->total_amt * $myCompany->gst_rate / 100;
			$serviceAmt    = $byCredit->total_amt * $myCompany->service_rate / 100;
			$memberDisAmt  = $byCredit->total_amt * $byCredit->member_discount / 100;
			$otherDisAmt   = $byCredit->total_amt * $byCredit->other_discount / 100;
			$totalSalesAmt = $salesAmt + $gstAmt + $serviceAmt;
			$totalDisAmt   = $memberDisAmt + $otherDisAmt;
			$netAmt        = $totalSalesAmt - $totalDisAmt;

			if (array_key_exists($stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state], $lotinsByCredit)) {
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['sales_amt'] += $salesAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['gst_amt'] += $gstAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['service_amt'] += $serviceAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['member_dis_amt'] += $memberDisAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['other_dis_amt'] += $otherDisAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['total_sales'] += $totalSalesAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['total_dis'] += $totalDisAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['net_sales'] += $netAmt;
			} else {
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['sales_amt']      = $salesAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['gst_amt']        = $gstAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['service_amt']    = $serviceAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['member_dis_amt'] = $memberDisAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['other_dis_amt']  = $otherDisAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['total_sales']    = $totalSalesAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['total_dis']      = $totalDisAmt;
				$lotinsByCredit[$stateList[$byCredit->from_state] . '-' . $stateList[$byCredit->to_state]]['net_sales']      = $netAmt;
			}
		}

		return view('reports.sales-report', ['lotinsByCash' => $lotinsByCash, 'lotinsByCredit' => $lotinsByCredit, 'stateList' => $stateList]);
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
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
