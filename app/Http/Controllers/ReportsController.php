<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller{


	public function getCounts(Request $request){
		$input = $request->all();
		$duration = 0;
		$cleaningCount = 0;
		$dryboxCount = 0;
		$imo1Count = 0;
		$imo5Count = 0;
		$shipperSurveyCount = 0;
		$weightmentCount = 0;
		$onhireCount = 0;
		if (isset($input["duration"])) {
			if( $input["duration"] == 0 ){
				// All records
				$cleaningCount = \App\Models\Cleaning::count();
				$dryboxCount = \App\Models\Drybox::count();

				$imo1Count = \App\Models\Imo1::count();
				$imo5Count = \App\Models\Imo5Condition::count();
				$shipperSurveyCount = \App\Models\ShipperSurvey::count();
				$weightmentCount = \App\Models\Weightment::count();
				$onhireCount = \App\Models\Onhire::count();

			}
			else if( $input["duration"] == 1 ){
				// this month
				$cleaningCount = \App\Models\Cleaning::whereMonth('created_at', date('m'))
					->whereYear('created_at', date('Y'))
					->count();
				$dryboxCount = \App\Models\Drybox::whereMonth('created_at', date('m'))
					->whereYear('created_at', date('Y'))
					->count();
				$imo1Count = \App\Models\Imo1::whereMonth('created_at', date('m'))
					->whereYear('created_at', date('Y'))
					->count();
				$imo5Count = \App\Models\Imo5Condition::whereMonth('created_at', date('m'))
					->whereYear('created_at', date('Y'))
					->count();
				$shipperSurveyCount = \App\Models\ShipperSurvey::whereMonth('created_at', date('m'))
					->whereYear('created_at', date('Y'))
					->count();
				$weightmentCount = \App\Models\Weightment::whereMonth('created_at', date('m'))
					->whereYear('created_at', date('Y'))
					->count();
				$onhireCount = \App\Models\Onhire::whereMonth('created_at', date('m'))
					->whereYear('created_at', date('Y'))
					->count();
			}
			else if($input["duration"] == 2){
				// get last month date
				$lastMonth = strtotime('-1 month');
				// last month
				$cleaningCount = \App\Models\Cleaning::whereMonth('created_at', date('m', $lastMonth))
					->whereYear('created_at', date('Y', $lastMonth))
					->count();
				$cleaningCount = \App\Models\Drybox::whereMonth('created_at', date('m', $lastMonth))
					->whereYear('created_at', date('Y', $lastMonth))
					->count();
				$cleaningCount = \App\Models\Imo1::whereMonth('created_at', date('m', $lastMonth))
					->whereYear('created_at', date('Y', $lastMonth))
					->count();
				$cleaningCount = \App\Models\Imo5Condition::whereMonth('created_at', date('m', $lastMonth))
					->whereYear('created_at', date('Y', $lastMonth))
					->count();
				$cleaningCount = \App\Models\ShipperSurvey::whereMonth('created_at', date('m', $lastMonth))
					->whereYear('created_at', date('Y', $lastMonth))
					->count();
				$cleaningCount = \App\Models\Weightment::whereMonth('created_at', date('m', $lastMonth))
					->whereYear('created_at', date('Y', $lastMonth))
					->count();
				$cleaningCount = \App\Models\Onhire::whereMonth('created_at', date('m', $lastMonth))
					->whereYear('created_at', date('Y', $lastMonth))
					->count();
			}
			else if($input["duration"] == 10){
				if( isset($input["startDate"]) && isset($input["endDate"]) ){
					// get data between startDate and endDate
					$cleaningCount = \App\Models\Cleaning::whereBetween('created_at', [$input['startDate'], $input['endDate']])->count();
					$dryboxCount = \App\Models\Drybox::whereBetween('created_at', [$input['startDate'], $input['endDate']])->count();
					$imo1Count = \App\Models\Imo1::whereBetween('created_at', [$input['startDate'], $input['endDate']])->count();
					$imo5Count = \App\Models\Imo5Condition::whereBetween('created_at', [$input['startDate'], $input['endDate']])->count();
					$shipperSurveyCount = \App\Models\ShipperSurvey::whereBetween('created_at', [$input['startDate'], $input['endDate']])->count();
					$weightmentCount = \App\Models\Weightment::whereBetween('created_at', [$input['startDate'], $input['endDate']])->count();
					$onhireCount = \App\Models\Onhire::whereBetween('created_at', [$input['startDate'], $input['endDate']])->count();
				}
			}
		}
		// get the count of records group by month in the last 6 months
		$cleaningLastSixMonthsCount = \App\Models\Cleaning::selectRaw( 'DATE_FORMAT(created_at, "%b, %Y") as month, count(*) as count')
			->where('created_at', '>=', now()->subMonths(6))
			->groupBy('month')->orderBy('created_at')
			->pluck('count', 'month');
		$dryboxLastSixMonthsCount = \App\Models\Drybox::selectRaw( 'DATE_FORMAT(created_at, "%b, %Y") as month, count(*) as count')
			->where('created_at', '>=', now()->subMonths(6))
			->groupBy('month')->orderBy('created_at')
			->pluck('count', 'month');
		
		$imo1LastSixMonthsCount = \App\Models\Imo1::selectRaw( 'DATE_FORMAT(created_at, "%b, %Y") as month, count(*) as count')
			->where('created_at', '>=', now()->subMonths(6))
			->groupBy('month')->orderBy('created_at')
			->pluck('count', 'month');
		$imo5LastSixMonthsCount = \App\Models\Imo5Condition::selectRaw( 'DATE_FORMAT(created_at, "%b, %Y") as month, count(*) as count')
			->where('created_at', '>=', now()->subMonths(6))
			->groupBy('month')->orderBy('created_at')
			->pluck('count', 'month');
		$shipperSurveyLastSixMonthsCount = \App\Models\ShipperSurvey::selectRaw( 'DATE_FORMAT(created_at, "%b, %Y") as month, count(*) as count')
			->where('created_at', '>=', now()->subMonths(6))
			->groupBy('month')->orderBy('created_at')
			->pluck('count', 'month');
		$weightmentLastSixMonthsCount = \App\Models\Weightment::selectRaw( 'DATE_FORMAT(created_at, "%b, %Y") as month, count(*) as count')
			->where('created_at', '>=', now()->subMonths(6))
			->groupBy('month')->orderBy('created_at')
			->pluck('count', 'month');
		$onhireLastSixMonthsCount = \App\Models\Onhire::selectRaw( 'DATE_FORMAT(created_at, "%b, %Y") as month, count(*) as count')
			->where('created_at', '>=', now()->subMonths(6))
			->groupBy('month')->orderBy('created_at')
			->pluck('count', 'month');
		return response()->json([
			"status" => "1",
			"data" => [
				"count" => [
					"cleaning" => $cleaningCount,
					"drybox" => $dryboxCount,
					"imo1" => $imo1Count,
					"imo5" => $imo5Count,
					"shipperSurvey" => $shipperSurveyCount,
					"weightment" => $weightmentCount,
					"onhire" => $onhireCount,
				],
				"last_6_months" => [
					"cleaning" => $cleaningLastSixMonthsCount,
					"drybox" => $dryboxLastSixMonthsCount,
					"imo1" => $imo1LastSixMonthsCount,
					"imo5" => $imo5LastSixMonthsCount,
					"shipperSurvey" => $shipperSurveyLastSixMonthsCount,
					"weightment" => $weightmentLastSixMonthsCount,
					"onhire" => $onhireLastSixMonthsCount
				]
			]
		]);
	}

	public function downloadReport(Request $request){
		$input = $request->all();
		if( isset($input["report"]) && isset($input["from_date"]) && isset($input["to_date"]) ){
			switch ($input["report"]) {
				case 1:
					// IMO1 Condition
					$dataList = \App\Models\Imo1::with('customer', 'inspection_location', 'surveyor', 'creator')
						->whereBetween('dt_inspection_date', [$input['from_date'], $input['to_date']])
						->where('status', 1);
					if( isset($input["customer_id"]) && $input["customer_id"] > 0 )
						$dataList = $dataList->where('customer_id', $input['customer_id']);
					if( isset($input["inspection_location_id"]) && $input["inspection_location_id"] > 0 )
						$dataList = $dataList->where('inspection_location_id', $input['inspection_location_id']);
					$dataList = $dataList->orderBy("dt_inspection_date")->get();
					// Append occurrence count to each row without removing duplicates
					$occurrences = $dataList->pluck('tank_no')->countBy();
					$dataList = $dataList->map(function ($tank, $index) use ($occurrences) {
						$tank->count_occurrence = $occurrences[$tank->tank_no] ?? 0;
						$tank->row_index = $index + 1;
						return $tank;
					});
					$export = new \App\Exports\Imo1ReportExport(collect($dataList));
					return Excel::download($export, 'Imo1Report.xlsx', \Maatwebsite\Excel\Excel::XLSX);

				case 2:
					// ShipperSurvey
					$dataList = \App\Models\ShipperSurvey::with('customer', 'inspection_location', 'surveyor', 'creator')
						->whereBetween('dt_inspection_date', [$input['from_date'], $input['to_date']])
						->where('status', 1);
					if( isset($input["customer_id"]) && $input["customer_id"] > 0 )
						$dataList = $dataList->where('customer_id', $input['customer_id']);
					if( isset($input["inspection_location_id"]) && $input["inspection_location_id"] > 0 )
						$dataList = $dataList->where('inspection_location_id', $input['inspection_location_id']);
					$dataList = $dataList->orderBy("dt_inspection_date")->get();
					// Append occurrence count to each row without removing duplicates
					$occurrences = $dataList->pluck('tank_container_no')->countBy();
					$dataList = $dataList->map(function ($tank, $index) use ($occurrences) {
						$tank->count_occurrence = $occurrences[$tank->tank_container_no] ?? 0;
						$tank->row_index = $index + 1;
						return $tank;
					});
					$export = new \App\Exports\ShipperSurveyReportExport(collect($dataList));
					return Excel::download($export, 'ShipperSurveyReport.xlsx', \Maatwebsite\Excel\Excel::XLSX);

				case 3:
					$dataList = \App\Models\Cleaning::
						with('customer', 'inspectionlocation', 'surveyor', 'creator')
						->whereBetween('cleaning.dt_inspection_date', [$input['from_date'], $input['to_date']])
						->where('cleaning.status', 1);
					if( isset($input["customer_id"]) && $input["customer_id"] > 0 )
						$dataList = $dataList->where('customer_id', $input['customer_id']);
					if( isset($input["inspection_location_id"]) && $input["inspection_location_id"] > 0 )
						$dataList = $dataList->where('inspection_locn', $input['inspection_location_id']);
					$dataList = $dataList->orderBy("cleaning.dt_inspection_date")->get();
					// Append occurrence count to each row without removing duplicates
					$occurrences = $dataList->pluck('tank_no')->countBy();
					$dataList = $dataList->map(function ($tank, $index) use ($occurrences) {
						$tank->count_occurrence = $occurrences[$tank->tank_no] ?? 0;
						$tank->row_index = $index + 1;
						return $tank;
					});
					$export = new \App\Exports\CleaningReportExport(collect($dataList));
					return Excel::download($export, 'CleaningReport.xlsx', \Maatwebsite\Excel\Excel::XLSX);

				case 4:
					// onhire
					$dataList = \App\Models\Onhire::with('customer', 'inspection_location', 'surveyor', 'creator')
						->whereBetween('created_at', [$input['from_date'], $input['to_date']])
						->where('status', 1);
					if( isset($input["customer_id"]) && $input["customer_id"] > 0 )
						$dataList = $dataList->where('customer_id', $input['customer_id']);
					if( isset($input["inspection_location_id"]) && $input["inspection_location_id"] > 0 )
						$dataList = $dataList->where('inspection_location_id', $input['inspection_location_id']);

					$dataList = $dataList->orderBy("created_at")->get();
					// Append occurrence count to each row without removing duplicates
					$occurrences = $dataList->pluck('unit_nr')->countBy();
					$dataList = $dataList->map(function ($tank, $index) use ($occurrences) {
						$tank->count_occurrence = $occurrences[$tank->unit_nr] ?? 0;
						$tank->row_index = $index + 1;
						return $tank;
					});
					$export = new \App\Exports\OnhireReportExport(collect($dataList));
					return Excel::download($export, 'OnhireReport.xlsx', \Maatwebsite\Excel\Excel::XLSX);
					
				case 5:
					// drybox
					$dataList = \App\Models\Drybox::with('customer', 'inspectionlocation', 'surveyor', 'creator')
						->whereBetween('drybox.dt_inspection_date', [$input['from_date'], $input['to_date']])
						->where('status', 1);
					if( isset($input["customer_id"]) && $input["customer_id"] > 0 )
						$dataList = $dataList->where('customer_id', $input['customer_id']);
					if( isset($input["inspection_location_id"]) && $input["inspection_location_id"] > 0 )
						$dataList = $dataList->where('inspection_location_id', $input['inspection_location_id']);
					$dataList = $dataList->orderBy("drybox.dt_inspection_date")->get();
					// Append occurrence count to each row without removing duplicates
					$occurrences = $dataList->pluck('container_no')->countBy();
					$dataList = $dataList->map(function ($tank, $index) use ($occurrences) {
						$tank->count_occurrence = $occurrences[$tank->container_no] ?? 0;
						$tank->row_index = $index + 1;
						return $tank;
					});
					$export = new \App\Exports\DryboxReportExport(collect($dataList));
					return Excel::download($export, 'DryboxReport.xlsx', \Maatwebsite\Excel\Excel::XLSX);
			}
			
		}
	}
}
