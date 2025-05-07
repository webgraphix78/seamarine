<?php
$yesNoNAArray = ["1" => "YES", "0" => "NO", "-1" => "NA"];
$gasketTypeArray = ["1" => "Super Tyt", "2" => "Taflon", "3" => "Rubber", "4" => "Nylon"];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ $shipperSurvey['container_no'] }}</title>
		<style>
			td{
				font-size: 9px;
			}
		</style>
	</head>
	<body>
		<br/>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="17%">&nbsp;</td>
				<td width="66%" style="border: 1px solid #000">
					<h3 style="text-align: center;margin: 0;padding: 0;">TANK CONTAINER CLEANLINESS SURVEY REPORT</h3>
				</td>
				<td width="17%">&nbsp;</td>
			</tr>
		</table>
		<br/><br/>
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td width="19%" style="font-weight: bold;">REF:</td>
				<td width="14%">{{ $shipperSurvey['ref_no'] }}</td>
				<td width="20%" style="font-weight: bold;">&nbsp;</td>
				<td width="15%">&nbsp;</td>
				<td width="18%" style="font-weight: bold;">&nbsp;</td>
				<td width="14%">&nbsp;</td>
			</tr>
			<tr>
				<td width="19%" style="font-weight: bold;">Tank Container No:</td>
				<td width="14%">{{ $shipperSurvey['tank_container_no'] }}</td>
				<td width="20%" style="font-weight: bold;">Type:</td>
				<td width="15%">{{ $shipperSurvey['type'] }}</td>
				<td width="18%" style="font-weight: bold;">Survey Date:</td>
				<td width="14%">{{ date("d-m-Y", strtotime($shipperSurvey['dt_inspection_date'])) }}</td>
			</tr>
			<tr>
				<td width="19%" style="font-weight: bold;">Max Gross Wt:</td>
				<td width="14%">{{ $shipperSurvey['gross_wt'] }} kgs</td>
				<td width="20%" style="font-weight: bold;">Tare Wt:</td>
				<td width="15%">{{ $shipperSurvey['tare_wt'] }} kgs</td>
				<td width="18%" style="font-weight: bold;">Capacity:</td>
				<td width="14%">{{ $shipperSurvey['capacity'] }} ltrs</td>
			</tr>
			<tr>
				<td width="19%" style="font-weight: bold;">C.S.C.:</td>
				<td width="14%">{{ $shipperSurvey['csc_no'] }}</td>
				<td width="20%" style="font-weight: bold;">Manufacturing Date:</td>
				<td width="15%">{{ $shipperSurvey['mfg_date'] }}</td>
				<td width="18%" style="font-weight: bold;">Next Test Date:</td>
				<td width="14%">{{ $shipperSurvey['next_date'] }}</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td width="15%" style="font-weight: bold;">Location:</td>
				<td width="35%">{{ $shipperSurvey['inspection_location']['name'] }}</td>
				<td width="20%" style="font-weight: bold;">Last Cargo Carried:</td>
				<td width="30%">{{ $shipperSurvey['last_cargo_carried'] }}</td>
			</tr>
			<tr>
				<td width="15%" style="font-weight: bold;">For Shipper:</td>
				<td width="35%">{{ $shipperSurvey['for_shipper']['name'] }}</td>
				<td width="20%" style="font-weight: bold;">CHA:</td>
				<td width="30%">{{ $shipperSurvey['customer']['name'] }}</td>
			</tr>
		</table>
		<p>
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td width="70%" align="right">Frame, Tank and walkways free of contamination and cargo:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['frame_tank']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Manlid and valve compartments free of contamination and cargo:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['manlid_valve']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Serial numbers and statutory marking legible:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['serial_nos']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Unit having steam jacket:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['steam_jacket']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Unit having bottom seal provision for bullet seal:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['bullet_seal']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Unit having <b>{{ $gasketTypeArray[$shipperSurvey['gasket_type']] }}</b> gasket on man lid cover:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['manlid_cover']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Dipstick originally fitted:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['distick']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Calibration chart fitted:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['calibration']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Siphon tube originally fitted:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['siphon_tube']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Pressure guage fitted:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['pressure_gauge']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Temperature guage fitted:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['temperature_gauge']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">PRV with poppet:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['prv_poppet']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Top discharge provision:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['top_provision']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Interior clean dry and odourless:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['interior_clean']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">VALVES/FITTINGS free from previous cargo:</td>
				<td width="30%">{{ $yesNoNAArray[$shipperSurvey['valves_free']] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Non transferable cargo stains on interior shell:</td>
				<td width="30%">{{ $shipperSurvey['non_transferable'] }}</td>
			</tr>
			<tr>
				<td width="70%" align="right">Polish/Buffing marks in interior:</td>
				<td width="30%">{{ $shipperSurvey['polish_buffing'] }}</td>
			</tr>
		</table>
		<p>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td width="20%">&nbsp;REMARKS:</td>
				<td width="80%">{{ $shipperSurvey['note'] }}</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
			<tr>
				<td width="20%">Manlid Seal No.:</td>
				<td width="30%">{{ $shipperSurvey['manlid_seal_no'] }}</td>
				<td width="20%">Airline V/Seal No.:</td>
				<td width="30%">{{ $shipperSurvey['airline_seal_no'] }}</td>
			</tr>
			<tr>
				<td width="20%">Bottom Seal No.:</td>
				<td width="30%">{{ $shipperSurvey['bottom_seal_no'] }}</td>
				<td width="20%">Top Discharge Seal No.:</td>
				<td width="30%">{{ $shipperSurvey['top_seal'] }}</td>
			</tr>
		</table>
		<table width="100%" border="1" cellspacing="0" cellpadding="3">
			<tr>
				<td style="font-size: 7px;" width="80%">
				THIS REPORT IS BASED SOLELY UPON A VISUAL EXAMINATION OF DOCUMENTS PROVIDED BY
OTHERS. THE SURVEYOR ACCEPTS NO LIABILITY FOR ANY CONDITIONS THAT ARE NOT
APPARENT DURING A NORMAL VISUAL INSPECTION OR THAT MAY BE RESULT OF INACCURATE
INFORMATION PROVIDED IN DOCUMENTS UPON WHICH THE SURVEYOR MUST RELY.WE ARE NOT
TO BE HELD RESPONSIBLE FOR ANY CONDENSATION AND RESURGENT ODOURS OCCURRING
BETWEEN THE INSPECTION AND THE LOADING OPERATIONS WHICH MAY OCCUR DUE TO
TEMPERATURE VARIATION.SUBJECT ONLY TO CLEANLINESS OF THE TANK, INTERIOR,VALVES &
FITTINGS. Issued without any prejudice
				</td>
				<td rowspan="2" width="20%">
					<img src="{{ $sign }}">
				</td>
			</tr>
			<tr>
				<td>
					SURVEYOR: 
					{{ $shipperSurvey['surveyor']['name'] }}
				</td>
			</tr>
		</table>
	</body>
</html>
