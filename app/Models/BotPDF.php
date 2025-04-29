<?php
namespace App\Models;

use App\Services\SettingsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use TCPDF;

class BotPDF extends TCPDF {
	public $headerHeight = 0;
	public $headerImage = '';
    //Page header
    public function Header() {
		$pageMargins = $this->getMargins();
		$xPos = $this->getPageWidth()-100-$pageMargins["right"]-$pageMargins["padding_right"];
		$this->setFont('helvetica', '', 10);
		$companyContent = "a=".$this->headerImage.",b=".(Storage::exists($this->headerImage)?"y":"n");
		// $this->headerHeight = $this->GetY()-5;
		// $this->MultiCell(100, 0, $companyContent, 0, 'R', 0, 1, $xPos, 5, true, 1);
		// Logo
		if( strlen($this->headerImage) > 0 && Storage::exists($this->headerImage) ){
			$absolutePath = storage_path("app".DIRECTORY_SEPARATOR.$this->headerImage);
			// $absolutePath = $this->headerImage;
			$path_info = pathinfo($absolutePath);
			$extension = strtoupper($path_info['extension']);
			$this->Image($absolutePath, 
			1, 5, 0, 25, 
			$extension, '', 'M', 
			true, 300, 'C', false, false, 1, true, false, true);
			$this->headerHeight = $this->GetY()+5;
			// $this->headerHeight = ($this->headerHeight < 25?25:$this->headerHeight);
		}
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        // $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}