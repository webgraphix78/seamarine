<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CleaningExport implements FromQuery, WithHeadings, WithMapping, WithStyles
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
            'Company','Tank Type','Tank No','Tcode','Customer','Inspection Location','Client','Cleaning Location','Surveyor','Frame, Tank and walkways free of contamination and cargo','Manlid and Valve compartments free of contamination and cargo','Serial numbers and statutory','Cargo Labels removed','Entry made into tank by surveyor','Free from odour','Clean and free from last cargo','Free from corrosion','Dry','Valves','Manlid Seal','Gas free entry permit issue','Siphon Tube',
        ];
    }

	public function map($row): array{
        return [
			$row->company_id,$row->tank_type_id,$row->tank_no,$row->tcode_id,$row->customer_id,$row->inspection_locn,$row->client_id,$row->cleaning_location_id,$row->surveyor_id,$row->frame_tank,$row->manlid_valves,$row->serial_nos,$row->labels_removed,$row->entry,$row->odour_free,$row->clean_free,$row->corrosion_free,$row->dry,$row->valves,$row->manlid_seal,$row->gas_free,$row->siphon,
        ];
    }
	
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
