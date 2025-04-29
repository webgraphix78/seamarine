<?php
$yesNoNAArray = ["1" => "YES", "0" => "NO", "-1" => "NA"];
$yesNoArray = ["1" => "YES", "0" => "NO"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		div, p, th, td{
			font-size: 8px;
		}
	</style>
</head>
<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td>
				<h3 style="text-align: center;margin: 0;padding: 0;">TANK CONTAINER CONDITION INSPECTION REPORT</h3>
			</td>
		</tr>
		<tr>
			<td style="text-align: right">
				REF NO: {{ $imo5Condition['refno'] }}
			</td>
		</tr>
	</table>
	<p>
	<table width="100%" border="1" cellspacing="0" cellpadding="2">
		<tr>
			<td width="20%" align="center">CONTAINER NO</td>
			<td width="30%" align="center">AT THE REQUEST OF</td>
			<td width="25%" align="center">LOCATION</td>
			<td width="25%" align="center">DEPOT</td>
		</tr>
		<tr>
			<td width="20%" align="center">{{ $imo5Condition['container_no'] }}</td>
			<td width="30%" align="center">{{ $imo5Condition['client'] }}</td>
			<td width="25%" align="center">{{ $imo5Condition['inspection_location']['name'] }}</td>
			<td width="25%" align="center">{{ $imo5Condition['cleaning_location']['name'] }}</td>
		</tr>
	</table>
	<table width="100%" border="1" cellspacing="0" cellpadding="2">
		<tr>
			<td width="20%" align="center">TANK TYPE</td>
			<td width="15%" align="center">MFG. DATE</td>
			<td width="15%" align="center">C.S.C</td>
			<td width="25%" align="center">MAX. GROSS WT.</td>
			<td width="25%" align="center">TARE WT.</td>
		</tr>
		<tr>
			<td width="20%" align="center">{{ $imo5Condition['tank_type']['type'] }}</td>
			<td width="15%" align="center">{{ $imo5Condition['mfgt_date'] }}</td>
			<td width="15%" align="center">{{ $imo5Condition['csc'] }}</td>
			<td width="25%" align="center">{{ $imo5Condition['gross_wt'] }}</td>
			<td width="25%" align="center">{{ $imo5Condition['tare_wt'] }}</td>
		</tr>
		<tr>
			<td width="20%" align="center">TANK CAPACITY</td>
			<td width="15%" align="center">NED</td>
			<td width="15%" align="center">STATUS</td>
			<td width="25%" align="center">DATE OF SURVEY</td>
			<td width="25%" align="center">T-CODE</td>
		</tr>
		<tr>
			<td width="20%" align="center">{{ $imo5Condition['capacity'] }}</td>
			<td width="15%" align="center">{{ $imo5Condition['next_date'] }}</td>
			<td width="15%" align="center">{{ $imo5Condition['imo_status'] }}</td>
			<td width="25%" align="center">{{ $imo5Condition['survey_date'] }}</td>
			<td width="25%" align="center">{{ $imo5Condition['tcode']['name'] }}</td>
		</tr>
	</table>
	<p>
	<img src="{{ $imo5diagram }}">
	<p>
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td>
				REMARKS: {{ $imo5Condition['comments'] }}
			</td>
		</tr>
	</table>
	<p>
	<table width="100%" border="1" cellspacing="0" cellpadding="3">
		<thead>
			<tr>
				<td width="40%" style="font-weight: bold">COMPONENT CHECK LIST</td>
				<td width="16%" align="center" colspan="2" style="font-weight: bold">FITTED</td>
				<td width="16%" align="center" colspan="2" style="font-weight: bold">CONDITION</td>
				<td width="28%" style="font-weight: bold">REMARKS</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">MARKINGS AND PLATES</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['markings_fitted_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['markings_fitted_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['markings_condition_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['markings_condition_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['marking_plates'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Data Plate</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['data_fitted_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['data_fitted_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['data_condition_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['data_condition_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['data_plate'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Owners Plate</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['owners_plate_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['owners_plate_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['owners_plate_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['owners_plate_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['owners_plate'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Manufactures Plate</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manufactures_plate_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manufactures_plate_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manufactures_plate_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manufactures_plate_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['manufactures_plates'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">CSC Plate</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['csc_plate_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['csc_plate_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['csc_plate_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['csc_plate_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['csc_plate'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Customs approval plate</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['customs_plate_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['customs_plate_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['customs_plate_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['customs_plate_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['customs_plate'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Prefix/Number</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['prefix_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['prefix_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['prefix_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['prefix_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['prefix'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">IMO/Number</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['imo_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['imo_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['imo_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['imo_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['imo'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Country Code</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['country_code_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['country_code_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['country_code_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['country_code_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['country_code'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Rear Ladder</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['rear_ladder_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['rear_ladder_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['rear_ladder_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['rear_ladder_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['rear_ladder'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Front Ladder</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['front_ladder_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['front_ladder_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['front_ladder_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['front_ladder_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['front_ladder'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Document Box/Cap/Gask/Chain</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['document_box_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['document_box_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['document_box_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['document_box_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['document_box'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Outlet/Blank/Gask/Chain</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['outlet_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['outlet_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['outlet_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['outlet_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['outlet'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Bottom outlet valve/gaskets</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['bottom_outlet_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['bottom_outlet_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['bottom_outlet_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['bottom_outlet_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['bottom_outlet'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Footvalve</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['foot_valve_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['foot_valve_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['foot_valve_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['foot_valve_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['foot_valve'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Remote Footvalve control</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['remote_footvalve_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['remote_footvalve_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['remote_footvalve_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['remote_footvalve_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['remote_footvalve'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Steam Tubes/Cap/Gask/Chain</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['steam_tubes_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['steam_tubes_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['steam_tubes_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['steam_tubes_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['steam_tubes'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Condensate drain</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['condensate_drains_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['condensate_drains_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['condensate_drains_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['condensate_drains_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['condensate_drains'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Thermometer</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['thermometer_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['thermometer_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['thermometer_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['thermometer_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['thermometer'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Walkway</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['walkway_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['walkway_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['walkway_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['walkway_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['walkway'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Manlid Protection Cover</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_protection_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_protection_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_protection_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_protection_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['manlid_protection'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Spillbox</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['spillbox_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['spillbox_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['spillbox_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['spillbox_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['spillbox'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Manlid</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['manlid'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Manlid Bolts</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_bolts_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_bolts_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_bolts_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['manlid_bolts_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['manlid_bolts'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Dipstick</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['dipstick_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['dipstick_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['dipstick_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['dipstick_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['dipstick'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Safety Dev.Prot.Cover</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['safety_cover_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['safety_cover_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['safety_cover_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['safety_cover_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['safety_cover'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Calibration Chart</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['calibration_chart_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['calibration_chart_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['calibration_chart_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['calibration_chart_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['calibration_chart'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">P/V Relief Valves Yes</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['relief_valves_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['relief_valves_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['relief_valves_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['relief_valves_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['relief_valves'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Pressure Gauges</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['pressure_gauges_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['pressure_gauges_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['pressure_gauges_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['pressure_gauges_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['pressure_gauges'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Flame Traps on P/V Rel.Val.</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['flame_traps_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['flame_traps_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['flame_traps_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['flame_traps_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['flame_traps'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Air Line Cap</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['air_line_cap_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['air_line_cap_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['air_line_cap_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['air_line_cap_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['air_line_cap'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Air Line Valve</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['air_line_valve_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['air_line_valve_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['air_line_valve_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['air_line_valve_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['air_line_valve'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Top Disch Prot Cover </label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_disch_prot_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_disch_prot_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_disch_prot_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_disch_prot_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['top_disch_prot'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Top Disch Valve</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_disch_valve_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_disch_valve_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_disch_valve_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_disch_valve_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['top_disch_valve'] }}
				</td>
			</tr>
			<tr>
				<td width="40%">
					<label class="form-label text-uppercase fw-bold pt-2 me-3">Top Disch. Blank</label>
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_condition_yes'] == 1 ? "YES":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_condition_yes'] == 0 ? "NO":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_condition_good'] == 1 ? "OK":"" }}
				</td>
				<td width="8%" align="center">
					{{ $imo5Condition['top_condition_good'] == -1 ? "NA":"" }}
				</td>
				<td width="28%">
					{{ $imo5Condition['top_condition'] }}
				</td>
			</tr>
		</tbody>
	</table>
	<table width="100%" border="1" cellspacing="0" cellpadding="5">
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="5">
					<tr>
						<td>NOTE: BOTTOM VALVE BOX - YES / , SUNSHIELD COVER - YES</td>
					</tr>
					<tr>
						<td align="center"> SURVEY CODES :</td>
					</tr>
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="5">
								<tr>
									<td width="10%">B</td>
									<td width="20%">BENT</td>
									<td width="10%">D1</td>
									<td width="20%">DENT upto 7mm.</td>
									<td width="10%">WT</td>
									<td width="30%">WEAR +TEAR</td>
								</tr>
								<tr>
									<td width="10%">C</td>
									<td width="20%">CUT</td>
									<td width="10%">D2</td>
									<td width="20%">DENT 7- 10mm.</td>
									<td width="10%">ST</td>
									<td width="30%">STAINED</td>
								</tr>
								<tr>
									<td width="10%">CR</td>
									<td width="20%">CRACKED</td>
									<td width="10%">D3</td>
									<td width="20%">DENT 10 - 20mm.</td>
									<td width="10%">IRR</td>
									<td width="30%">IMPROPER REPAIR RECENT</td>
								</tr>
								<tr>
									<td width="10%">COR</td>
									<td width="20%">CORROSION</td>
									<td width="10%">D4</td>
									<td width="20%">DENT 20 - 25mm.</td>
									<td width="10%">IRO</td>
									<td width="30%">IMPROPER REPAIR OLD</td>
								</tr>
								<tr>
									<td width="10%">H</td>
									<td width="20%">HOLE</td>
									<td width="10%">D5</td>
									<td width="20%">DENT 25 - 30mm.</td>
									<td width="10%">EX</td>
									<td width="30%">EXISTING REPAIR</td>
								</tr>
								<tr>
									<td width="10%">L</td>
									<td width="20%">LOOSE</td>
									<td width="10%">D6</td>
									<td width="20%">DENT 30 - 40mm.</td>
									<td width="10%">EX</td>
									<td width="30%">SCRATCHED</td>
								</tr>
								<tr>
									<td width="10%">M</td>
									<td width="20%">MISSING</td>
									<td width="10%">D7</td>
									<td width="20%">DENT above 40mm.</td>
									<td width="10%">&nbsp;</td>
									<td width="30%">&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="100%" border="1" cellspacing="0" cellpadding="5">
		<tr>
			<td width="50%">CONTAINER NUMBER: {{ $imo5Condition['container_no'] }}</td>
			<td width="50%">
				<table width="100%" border="0" cellspacing="0" cellpadding="5">
					<tr>
						<td width="65%">&nbsp;</td>
						<td width="35%">
							<img src="{{ $sign }}">
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>