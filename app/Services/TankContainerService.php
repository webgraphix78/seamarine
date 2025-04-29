<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;

class TankContainerService{
	private static $charLookup = ["A" => 10, "B" => 12, "C" => 13, "D" => 14, "E" => 15, "F" => 16, "G" => 17, "H" => 18, "I" => 19, "J" => 20, "K" => 21, "L" => 23, "M" => 24, "N" => 25, "O" => 26, "P" => 27, "Q" => 28, "R" => 29, "S" => 30, "T" => 31, "U" => 32, "V" => 34, "W" => 35, "X" => 36, "Y" => 37, "Z" => 38, ];
	// Validates the tank container number
	public static function validateTankContainerNumber($tankContainerNo){
		if( preg_match('/[A-Z]{4}\-\d{6}\-\d/mi', $tankContainerNo) ){
			$tankContainerNo = str_replace("-", "", $tankContainerNo);
			// Log::info("Checking :: ".$tankContainerNo);
			// Matched the format
			// Now the tough part - calculation
			$aSet = self::$charLookup[substr($tankContainerNo, 0, 1)] + 
					( self::$charLookup[substr($tankContainerNo, 1, 1)] * 2 ) +
					( self::$charLookup[substr($tankContainerNo, 2, 1)] * 4 ) +
					( self::$charLookup[substr($tankContainerNo, 3, 1)] * 8 ) +
					intval(substr($tankContainerNo, 4, 1)) * 16 +
					intval(substr($tankContainerNo, 5, 1)) * 32 +
					intval(substr($tankContainerNo, 6, 1)) * 64 +
					intval(substr($tankContainerNo, 7, 1)) * 128 +
					intval(substr($tankContainerNo, 8, 1)) * 256 +
					intval(substr($tankContainerNo, 9, 1)) * 512;
			// Log::info($aSet);
			$bSet = self::$charLookup[substr($tankContainerNo, 0, 1)] + 
					( self::$charLookup[substr($tankContainerNo, 1, 1)] * 2 ) +
					( self::$charLookup[substr($tankContainerNo, 2, 1)] * 4 ) +
					( self::$charLookup[substr($tankContainerNo, 3, 1)] * 8 ) +
					intval(substr($tankContainerNo, 4, 1)) * 16 +
					intval(substr($tankContainerNo, 5, 1)) * 32 +
					intval(substr($tankContainerNo, 6, 1)) * 64 +
					intval(substr($tankContainerNo, 7, 1)) * 128 +
					intval(substr($tankContainerNo, 8, 1)) * 256 +
					intval(substr($tankContainerNo, 9, 1)) * 512;
			// Log::info($bSet);
			$cValue = ($aSet/11) - floor($bSet/11);
			// Log::info($cValue);
			$roundValue = round($cValue*11, 1);
			// Log::info($roundValue);
			$modValue = $roundValue % 10;
			// Log::info(substr($tankContainerNo, 10, 1)."::".$modValue);
			return( substr($tankContainerNo, 10, 1) == $modValue ? 1:-1 );
		}
		else
			return -100;
	}
}
