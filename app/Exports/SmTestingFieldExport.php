<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Log;

class SmTestingFieldExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
	protected $query;

	public function __construct(\Illuminate\Database\Eloquent\Builder $query){
		$this->query = $query;
	}

	public function query(){
		return $this->query;
	}

	public function headings(): array
    {
        return [
            'Company Id','Inspection Date','Inspection Location Id','Operator Lessor','Tank No',
        ];
    }

	public function map($row): array{
        return [
			$row->rel_company_id->name,
$row->inspection_date,
$row->rel_inspection_location_id->name,
$row->operator_lessor,
$row->tank_no,

        ];
    }
	
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
