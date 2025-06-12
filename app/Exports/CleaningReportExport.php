<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CleaningReportExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
			'Sr No','Tank No','Inspection Date','Inspection Location','Customer','Surveyor','Login Person','System Date', 'Occurence','status'
		];
	}
	
	public function map($row): array{
		$value = $row->count_occurrence;
        // Check if the value is more than 1
        if ($value > 1) {
            $this->highlightRows[] = $row->row_index;
        }
		return [
			$row->ref_no,
			$row->tank_no,
			$row->inspection_date,
			$row->inspectionlocation->name,
			$row->customer->name,
			$row->surveyor->name,
			$row->creator->name,
			date("d-m-Y", strtotime($row->updated_at)),
			$row->count_occurrence,
			$row->status == 1 ? 'Active' : 'Inactive'
		];
	}
	
	public function styles(Worksheet $sheet)
	{
		$styles = [];
		$styles[1] = [
			'font' => ['bold' => true],
			'fill' => [
				'fillType'   => Fill::FILL_SOLID,
				'startColor' => ['rgb' => 'CCCCCC'], // Grey background for header
			],
		];
        foreach ($this->highlightRows as $row) {
            $styles[$row+1] = [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '99D9EA'], // Yellow background
                ],
            ];
        }
        return $styles;
	}
}
