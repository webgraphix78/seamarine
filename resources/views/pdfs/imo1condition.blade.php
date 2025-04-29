<?php
$yesNoNAArray = ["1" => "YES", "0" => "NO", "-1" => "NA"];
$inOutNAArray = ["1" => "IN", "0" => "OUT", "-1" => "NA"];
$yesNoArray = ["1" => "YES", "0" => "NO"];
$imo1ConditionStatusLegend = [];
foreach ($imo1ConditionStatuses as $key => $imo1ConditionStatus) {
	$imo1ConditionStatusLegend[] = $imo1ConditionStatus["code"] . " - " . $imo1ConditionStatus["title"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		div, p, th, td{
			font-size: 7px;
		}
	</style>
</head>
<body>
	<table width="100%" cellspacing="5" cellpadding="0">
		<tr>
			<td width="25%">&nbsp;</td>
			<td width="50%">
				<h3 style="text-align: center;margin: 0;padding: 0;border: 1px solid #000;">EQUIPMENT INSPECTION REPORT</h3>
			</td>
			<td width="25%">&nbsp;</td>
		</tr>
	</table>
	<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr>
			<th width="18%">REF NUMBER</th>
			<td width="16%">{{ $imoACondition['ref_no'] }}</td>
			<th width="15%">TANK NUMBER</th>
			<td width="13%">{{ $imoACondition['tank_no'] }}</td>
			<th width="20%">DATE OF INSPECTION</th>
			<td width="18%">{{ $imoACondition['inspection_date'] }}</td>
		</tr>
		<tr>
			<th width="18%">EMPTY CLEAN</th>
			<td width="16%">{{ $yesNoNAArray[$imoACondition['empty_clean']] }}</td>
			<th width="15%">EMPTY DIRTY</th>
			<td width="13%">{{ $yesNoNAArray[$imoACondition['empty_dirty']] }}</td>
			<th width="20%">LOADED</th>
			<td width="18%">{{ $yesNoNAArray[$imoACondition['loaded']] }}</td>
		</tr>
		<tr>
			<th width="18%">SURVEYOR</th>
			<td width="16%">{{ (isset($imoACondition['surveyor']) && isset($imoACondition['surveyor']['name'])) ? $imoACondition['surveyor']['name']:"-" }}</td>
			<th width="15%">HAZARD CLASS</th>
			<td width="13%">{{ $imoACondition['hazard_class'] }}</td>
			<th width="20%">STATUS</th>
			<td width="18%">{{ ($imoACondition['imo1_status'] == 1?"IMPORT":"EXPORT") }}</td>
		</tr>
		<tr>
			<th width="18%">C.S.C</th>
			<td width="16%">{{ $imoACondition['csc'] }}</td>
			<th width="15%">LOADED AT</th>
			<td width="13%">{{ $imoACondition['loaded_at'] }}</td>
			<th width="20%">TANK TYPE</th>
			<td width="18%">{{ (isset($imoACondition['tanktype']) && isset($imoACondition['tanktype']['type'])) ? $imoACondition['tanktype']['type']:"-" }}, T-CODE: {{ (isset($imoACondition['tcode']) && isset($imoACondition['tcode']['name'])) ? $imoACondition['tcode']['name']:"-" }}</td>
		</tr>
		<tr>
			<th width="18%">MFG. DATE</th>
			<td width="16%">{{ $imoACondition['mfgt_date'] }}</td>
			<th width="15%">CFS</th>
			<td width="13%">{{ $inOutNAArray[$imoACondition['cfs']] }}</td>
			<th width="20%">FOR</th>
			<td width="18%">{{ (isset($imoACondition['for_client_rec']) && isset($imoACondition['for_client_rec']['name'])) ? $imoACondition['for_client_rec']['name']:"-" }}</td>
		</tr>
		<tr>
			<th width="18%">NED</th>
			<td width="16%">{{ $imoACondition['next_date'] }}</td>
			<th width="15%">COUNTRY</th>
			<td width="13%">{{ $imoACondition['country'] }}</td>
			<th width="20%">LOCATION OF INSPECTION</th>
			<td width="18%">{{ (isset($imoACondition['inspection_location']) && isset($imoACondition['inspection_location']['name'])) ? $imoACondition['inspection_location']['name']: "-" }}</td>
		</tr>
		<tr>
			<th width="18%">LAST CARGO CARRIED</th>
			<td width="82%" colspan="5">{{ $imoACondition['last_cargo_carried'] }}</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="3" cellpadding="0" style="border-collapse: collapse;">
		<tr>
			<td align="center">Inspection Of Exterior Condition carried out and appropriate Box marked with °X° or provided codes. In case of named condition not mentioned, comments provided.</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="3" cellpadding="0" style="border-collapse: collapse;">
		<tr>
			<td width="33%" align="center">ANY VISIBLE DAMAGE TO CLADDING/DECALS</td>
			<td width="33%" align="center">ANY VISIBLE DAMAGE TO FRAME MEMBERS</td>
			<td width="34%" align="center"> GENERAL APPEARANCE - INDICATED IF</td>
		</tr>
		<tr>
			<td width="33%">
				<table width="100%" border="0" cellspacing="0" cellpadding="2">
					<tr>
						<td width="50%">&nbsp;</td>
						<td width="25%" align="center">YES/NO</td>
						<td width="25%" align="center">YES/NO</td>
					</tr>
				</table>
				
				<table width="100%" border="0" cellspacing="0" cellpadding="2">
					<tr>
						<td width="50%">FRONT PANEL</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['front_panel_cladding']] }}</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['front_panel_decals']] }}</td>
					</tr>
					<tr>
						<td width="50%">REAR PANEL</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['rear_panel_cladding']] }}</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['rear_panel_decals']] }}</td>
					</tr>
					<tr>
						<td width="50%">RIGHT SIDE</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['right_side_cladding']] }}</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['right_side_decals']] }}</td>
					</tr>
					<tr>
						<td width="50%">LEFT SIDE</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['left_side_cladding']] }}</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['left_side_decals']] }}</td>
					</tr>
					<tr>
						<td width="50%">TOP</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['top_cladding']] }}</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['top_decals']] }}</td>
					</tr>
					<tr>
						<td width="50%">UNDERSIDE</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['underside_cladding']] }}</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['underside_decals']] }}</td>
					</tr>
				</table>
			</td>
			<td width="33%">
				<table width="100%" border="0" cellspacing="0" cellpadding="2">
					<tr>
						<td width="75%">&nbsp;</td>
						<td width="25%" align="center">YES/NO</td>
					</tr>
					<tr>
						<td width="75%">FRONT END</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['front_end_damage']] }}</td>
					</tr>
					<tr>
						<td width="75%">REAR END</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['rear_end_damage']] }}</td>
					</tr>
					<tr>
						<td width="75%">RIGHT SIDE	</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['right_side_damage']] }}</td>
					</tr>
					<tr>
						<td width="75%">LEFT SIDE</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['left_side_damage']] }}</td>
					</tr>
					<tr>
						<td width="75%">TOP SIDE</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['top_damage']] }}</td>
					</tr>
					<tr>
						<td width="75%">BOTTOM</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['underside_damage']] }}</td>
					</tr>
				</table>
			</td>
			<td width="34%">
				<table width="100%" border="0" cellspacing="0" cellpadding="2">
					<tr>
						<td width="75%">&nbsp;</td>
						<td width="25%" align="center">YES/NO</td>
					</tr>
					<tr>
						<td width="75%">EXTERIOR WASH NEEDED</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['exterior_wash_needed']] }}</td>
					</tr>
					<tr>
						<td width="75%">FRAME IS RUSTY</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['rusty_frame']] }}</td>
					</tr>
					<tr>
						<td width="75%">CLADDING IS PATCHY</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['patchy_cladding']] }}</td>
					</tr>
					<tr>
						<td width="75%">PRODUCT SPILLS (STAINS)</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['product_spills']] }}</td>
					</tr>
					<tr>
						<td width="75%">LOGO TO RENEW</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['renew_logo']] }}</td>
					</tr>
					<tr>
						<td width="75%">PREVIOUS HAZ. LABELS</td>
						<td width="25%" style="border: 1 solid #000;text-align: center">{{ $yesNoNAArray[$imoACondition['previous_haz']] }}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000">
		<tr>
			<td align="center">
			All damages, missing parts and deficiencies marked. Each part listed below is inspected in accordance with ITCO norms. Schematic drawing indicates defective areas with name in the Boxes.
			</td>
		</tr>
	</table>
	<p>{{ implode("  |  ", $imo1ConditionStatusLegend) }}</p>
	<table width="100%" border="0" cellspacing="0" cellpadding="1">
		<tr>
			<td width="40%">
				1.&nbsp;LADDER
				@if(strlen(trim($imoACondition['ladder_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['ladder_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['ladder_cond_status_id']]['code'] }}</td>
			<td width="40%">
				&nbsp;15. AIRLINE VALVE
				@if(strlen(trim($imoACondition['airline_valve_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['airline_valve_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['airline_valve_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				2. DOCUMENT BOX
				@if(strlen(trim($imoACondition['document_box_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['document_box_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['document_box_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;16. TANK PRESSURE GUAGE
				@if(strlen(trim($imoACondition['tank_gauge_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['tank_gauge_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['tank_gauge_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				3. TEMPERATURE GUAGE
				@if(strlen(trim($imoACondition['temperature_gauge_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['temperature_gauge_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['temperature_gauge_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;17. DIP-STICK
				@if(strlen(trim($imoACondition['dipstick_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['dipstick_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['dipstick_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				4. STEAM PIPE & CAPS
				@if(strlen(trim($imoACondition['steam_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['steam_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['steam_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;18. CALIBRATION CHART
				@if(strlen(trim($imoACondition['calibration_chart_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['calibration_chart_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['calibration_chart_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				5. STEAM PRESSURE RELIFE VALVE
				@if(strlen(trim($imoACondition['steam_pressure_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['steam_pressure_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['steam_pressure_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;19. SYPHON PIPE (DIP-TUBE) TOP FILL
				@if(strlen(trim($imoACondition['syphon_pipe_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['syphon_pipe_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['syphon_pipe_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				6. REMOTE CONTROL SYSTEM
				@if(strlen(trim($imoACondition['remote_system_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['remote_system_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['remote_system_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;20. B/FLY VALVE (CLAMP/FLANGE)
				@if(strlen(trim($imoACondition['b_fly_valve_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['b_fly_valve_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['b_fly_valve_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				7. ELECTRICAL HEATING
				@if(strlen(trim($imoACondition['electrical_heating_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['electrical_heating_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['electrical_heating_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;21. BLANK FLANGE, TOP FILL (BOLTS) NO
				@if(strlen(trim($imoACondition['blank_flange_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['blank_flange_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['blank_flange_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				8. MANLID
				@if(strlen(trim($imoACondition['manlid_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['manlid_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['manlid_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;22. TOP VAPOUR B/FLY VALVE (CLAMP FLANGE)
				@if(strlen(trim($imoACondition['top_vapour_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['top_vapour_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['top_vapour_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				8(a). MANLID SWINGBOLTS
				@if(strlen(trim($imoACondition['manlid_swing_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['manlid_swing_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['manlid_swing_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;23. TOP VAPOUR BLANK FLANGE (BOLTS) NO
				@if(strlen(trim($imoACondition['top_vapour_bolts_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['top_vapour_bolts_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['top_vapour_bolts_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				9. INSPECTION HATCH
				@if(strlen(trim($imoACondition['insp_hatch_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['insp_hatch_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['insp_hatch_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;24. FLANGED PROVISION
				@if(strlen(trim($imoACondition['flanged_provision_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['flanged_provision_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['flanged_provision_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				9(a). INSPECTION HATCH SWING BOLTS
				@if(strlen(trim($imoACondition['insp_hatch_swing_bolt_no'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['insp_hatch_swing_bolt_no'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['insp_hatch_swing_bolt_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;25. BOTTOM FOOT VALVE
				@if(strlen(trim($imoACondition['bottom_foot_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['bottom_foot_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['bottom_foot_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				10. SPILLBOX COVERS
				@if(strlen(trim($imoACondition['spill_box_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['spill_box_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['spill_box_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;26. BOTTOM B/FLY
				@if(strlen(trim($imoACondition['bottom_bfly_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['bottom_bfly_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['bottom_bfly_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				11. PRE/VAC VALVES
				@if(strlen(trim($imoACondition['pre_valve_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['pre_valve_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['pre_valve_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;27. BOTTOM OUTLET FLANGE
				@if(strlen(trim($imoACondition['bottom_outlet_flange_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['bottom_outlet_flange_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['bottom_outlet_flange_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				12. PRE/VAC BURSTING DISC
				@if(strlen(trim($imoACondition['pre_bursting_disc_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['pre_bursting_disc_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['pre_bursting_disc_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;28. BOTTOM VALVE HANDLE
				@if(strlen(trim($imoACondition['bottom_valve_handle_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['bottom_valve_handle_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['bottom_valve_handle_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				13. WALKWAY (LONG SECTION)
				@if(strlen(trim($imoACondition['walkyway_ls_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['walkyway_ls_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['walkyway_ls_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;29. BOTTOM B/FLY/BALL VALVE HANDLE
				@if(strlen(trim($imoACondition['bottom_bfly_ball_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['bottom_bfly_ball_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['bottom_bfly_ball_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				14. WALKWAY (Short Cross Section)
				@if(strlen(trim($imoACondition['walkyway_scs_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['walkyway_scs_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['walkyway_scs_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;30. FUSIBLE LINK
				@if(strlen(trim($imoACondition['fusible_link_no'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['fusible_link_no'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['fusible_link_cond_status_id']]['code'] }}</td>
		</tr>
		<tr>
			<td width="40%">
				14a. WALKWAY (Mid Length Section)
				@if(strlen(trim($imoACondition['walkyway_mls_nos'])) > 0 )
				&nbsp;&nbsp;&nbsp;&nbsp;NOS - {{trim($imoACondition['walkyway_mls_nos'])}} PC.
				@endif
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $imo1ConditionStatuses[$imoACondition['walkyway_mls_cond_status_id']]['code'] }}</td>
			<td width="40%">
			&nbsp;31. Camera
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $yesNoArray[$imoACondition['camera']] }}</td>
		</tr>
		<tr>
			<td width="40%">
				&nbsp;
			</td>
			<td width="10%" align="center">&nbsp;</td>
			<td width="40%">
			&nbsp;32. GPS
			</td>
			<td width="10%" style="border: 1px solid #000000;" align="center">{{ $yesNoArray[$imoACondition['gps']] }}</td>
		</tr>
	</table>
	<br/>
	<br/>
	<table border="1" cellspacing="0" cellpadding="2">
		<tr>
			<td width="15%">LAST TEST DATE:</td>
			<td width="35%">{{ $imoACondition['last_test_date'] }}</td>
			<td width="15%">TARE:</td>
			<td width="35%">{{ $imoACondition['tare_wt'] }} KGs</td>
		</tr>
		<tr>
			<td width="15%">CAPACITY:</td>
			<td width="35%">{{ $imoACondition['capacity'] }} LTRs</td>
			<td width="15%">MGW:</td>
			<td width="35%">{{ $imoACondition['mgw'] }} KGs</td>
		</tr>
	</table>
	<table border="1" cellspacing="0" cellpadding="2">
		<tr>
			<td>COMMENT: {{ $imoACondition['comments'] }}</td>
		</tr>
	</table>
	@if( $walkway_image != null && strlen($walkway_image) > 0 )
	<table width="100%" cellspacing="0" cellpadding="2" border="0">
		<tr>
			<td width="100%"><img src="{{ $walkway_image }}" style="height:200px; width: 900px;"></td>
		</tr>
	</table>
	@endif 
	<table width="100%" cellspacing="0" cellpadding="2" border="0">
		<tr>
			<td width="88%" style="font-size: 9px;"><p>&nbsp;</p><p>Certificate issued without any prejudice.</p></td>
			<td width="12%" style="text-align: center;"><img src="{{ $sign }}"></td>
		</tr>
	</table>
</body>
</html>