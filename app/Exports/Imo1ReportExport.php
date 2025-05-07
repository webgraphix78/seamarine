<?php

namespace App\Exports;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Imo1ReportExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
	protected $query;
	protected $dataList;
	protected $highlightRows = [];
	
	public function __construct($dataList){
		$this->dataList = $dataList;
	}

	public function collection()
	{
		return $this->dataList;
	}
	
	public function headings(): array
	{
		return [
			'Sr No', 'Tank No', 'Inspection Date', 'Inspection Location', 'Customer', 'Surveyor', 'CFS', 'Login Person', 'System Date', 'Occurence'
		];
	}
	
	public function map($row): array{
		$value = $row->count_occurrence;
        // Check if the value is more than 1
        if ($value > 1) {
            $this->highlightRows[] = $row->row_index;
        }
		$cfsValue = "";
		switch ($row['cfs']) {
			case 1:
				$cfsValue = "In";
				break;
			case 0:
				$cfsValue = "Out";
				break;
			default:
				$cfsValue = "NA";
				break;
		}
		Log::info(json_encode($row));
		return [
			$row->ref_no,
			$row->tank_no,
			date("d-m-Y", strtotime($row->dt_inspection_date)),
			($row->inspection_location != null ? $row->inspection_location->name : ""),
			($row->customer != null ? $row->customer->name: ""),
			($row->surveyor != null ? $row->surveyor->name: ""),
			$cfsValue,
			($row->creator != null ? $row->creator->name : ""),
			date("d-m-Y", strtotime($row->created_at)),
			$row->count_occurrence,
		];
	}
	
	public function styles(Worksheet $sheet)
	{
		$styles = [];
		$styles[1] = [
			'font' => ['bold' => true],
			'fill' => [
				'fillType'   => Fill::FILL_SOLID,
				'startColor' => ['rgb' => 'CCCCCC'],
			],
		];
        foreach ($this->highlightRows as $row) {
            $styles[$row+1] = [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '99D9EA'],
                ],
            ];
        }
        return $styles;
	}
}
