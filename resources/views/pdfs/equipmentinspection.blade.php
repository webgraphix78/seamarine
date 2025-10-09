<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		td{
			font-size: 8px;
		}
	</style>
</head>
<body>
	<table cellspacing="5" cellpadding="0">
		<tr>
			<td width="20%"></td>
			<td width="60%" style="margin: auto;">
				<h3 style="text-align: center;margin: 0;padding: 0;">EQUIPMENT INSPECTION REPORT LOADED</h3>
			</td>
			<td width="20%">
				<h3 style="text-align: center;margin: 0;padding: 0;">Ref No &nbsp;&nbsp;{{$equipmentinspection['ref_no']}}</h3>
			</td>
		</tr>
	</table>
	<P></P>
	<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr>
			<td width="32%">DATE OF INSPECTION: &nbsp;&nbsp;{{ $equipmentinspection['inspection_date'] ?? 'null' }}</td>
			<td width="32%">TANK NUMEBR:  &nbsp;&nbsp;{{ $equipmentinspection['tank_no'] ?? 'null' }}</td>
			<td width="36%">LAST CARGO CARRIED:  &nbsp;&nbsp;{{ $equipmentinspection['last_cargo_carried'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="32%">EMPTY CLEAN:  &nbsp;&nbsp;
				@switch($equipmentinspection["empty_clean"])
				@case(1)
				Yes
				@break
				@case(0)
				No
				@break
				@case(-1)
				NA
				@break
				@endswitch
			</td>
			<td width="32%">EMPTY DIRTY:  &nbsp;&nbsp;
				@switch($equipmentinspection["empty_dirty"])
				@case(1)
				Yes
				@break
				@case(0)
				No
				@break
				@case(-1)
				NA
				@break
				@endswitch
			</td>
			<td width="36%">LOADED:  &nbsp;&nbsp;
				@switch($equipmentinspection["loaded"])
				@case(1)
				Yes
				@break
				@case(0)
				No
				@break
				@case(-1)
				NA
				@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="32%">SURVEYOR:  &nbsp;&nbsp;{{ $equipmentinspection['rel_surveyor_id']['name'] ?? 'null' }}</td>
			<td width="32%">HAZARD CLASS:  &nbsp;&nbsp;{{ $equipmentinspection['hazard_class'] ?? 'null' }}</td>
			<td width="36%">STATUS:  &nbsp;&nbsp;
				@switch($equipmentinspection["eq_inspection_status"])
				@case(1)
				Import
				@break
				@case(2)
				Export
				@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="32%">C.S.C.:  &nbsp;&nbsp;{{ $equipmentinspection['csc'] ?? 'null' }}</td>
			<td width="32%">LOADED AT:  &nbsp;&nbsp;{{ $equipmentinspection['loaded_at'] ?? 'null' }}</td>
			<td width="36%">TANK TYPE:  &nbsp;&nbsp;
				@switch($equipmentinspection["tank_type"])
				@case(1)
				IMO 1
				@break
				@case(2)
				IMO 5
				@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="32%">MFG. DATE:  &nbsp;&nbsp;{{ $equipmentinspection['mfg_date'] ?? 'null' }}</td>
			<td width="32%">CFS:  &nbsp;&nbsp;
				@switch($equipmentinspection["cfs"])
				@case(1)
				In
				@break
				@case(0)
				Out
				@break
				@case(-1)
				NA
				@break
				@endswitch
			</td>
			<td width="36%">FOR:  &nbsp;&nbsp;{{ $equipmentinspection['rel_for_id']['name'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="32%">NED:  &nbsp;&nbsp;{{ $equipmentinspection['next_date'] ?? 'null' }}</td>
			<td width="32%">COUNTRY:  &nbsp;&nbsp;{{ $equipmentinspection['country'] ?? 'null' }}</td>
			<td width="36%">LOCATION OF INSPECTION:  &nbsp;&nbsp;{{ $equipmentinspection['rel_inspection_location_id']['name'] ?? 'null' }}</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td width="100%" style="text-align:center;">Inspection Of TIR and Sealing Condition Carried out and appropriate Box marked with condition and details.</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
	</table>
	<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
		<tr>
			<td width="10%">S.no.</td>
			<td width="30%">Fitting</td>
			<td width="15%">TIR</td>
			<td width="20%">SEAL</td>
			<td width="25%">Comments</td>
		</tr>
		<tr>
			<td width="10%">1</td>
			<td width="30%">Bottom Discharge</td>
			<td width="15%">{{ $equipmentinspection['bottom_discharge_tir'] ?? '' }}</td>
			<td width="20%">{{ $equipmentinspection['bottom_discharge_seal'] ?? '' }}</td>
			<td width="25%">{{ $equipmentinspection['bottom_discharge_comments'] ?? '' }}</td>
		</tr>
		<tr>
			<td width="10%">2</td>
			<td width="30%">Manlid</td>
			<td width="15%">{{ $equipmentinspection['manlid_tir'] ?? '' }}</td>
			<td width="20%">{{ $equipmentinspection['manlid_seal'] ?? '' }}</td>
			<td width="25%">{{ $equipmentinspection['manlid_comments'] ?? '' }}</td>
		</tr>
		<tr>
			<td width="10%">3</td>
			<td width="30%">Airline Value			</td>
			<td width="15%">{{ $equipmentinspection['airline_value_tir'] ?? '' }}</td>
			<td width="20%">{{ $equipmentinspection['airline_value_seal'] ?? '' }}</td>
			<td width="25%">{{ $equipmentinspection['airline_value_comments'] ?? '' }}</td>
		</tr>
		<tr>
			<td width="10%">4</td>
			<td width="30%">PRV</td>
			<td width="15%">{{ $equipmentinspection['prv_tir'] ?? '' }}</td>
			<td width="20%">{{ $equipmentinspection['prv_seal'] ?? '' }}</td>
			<td width="25%">{{ $equipmentinspection['prv_comments'] ?? '' }}</td>
		</tr>
		<tr>
			<td width="10%">5</td>
			<td width="30%">Top Discharge</td>
			<td width="15%">{{ $equipmentinspection['top_discharge_tir'] ?? '' }}</td>
			<td width="20%">{{ $equipmentinspection['top_discharge_seal'] ?? '' }}</td>
			<td width="25%">{{ $equipmentinspection['top_discharge_comments'] ?? '' }}</td>
		</tr>
		<tr>
			<td width="10%">6</td>
			<td width="30%">To Dischage/Fill Flange</td>
			<td width="15%">{{ $equipmentinspection['to_discharge_fill_flange_tir'] ?? '' }}</td>
			<td width="20%">{{ $equipmentinspection['to_discharge_fill_flange_seal'] ?? '' }}</td>
			<td width="25%">{{ $equipmentinspection['to_discharge_fill_flange_comments'] ?? '' }}</td>
		</tr>
		<tr>
			<td width="10%">7</td>
			<td width="30%">Safety Provision</td>
			<td width="15%">{{ $equipmentinspection['safety_provision_tir'] ?? '' }}</td>
			<td width="20%">{{ $equipmentinspection['safety_provision_seal'] ?? '' }}</td>
			<td width="25%">{{ $equipmentinspection['safety_provision_comments'] ?? '' }}</td>
		</tr>
		<tr>
			<td width="10%">8</td>
			<td width="30%">Vapour Return Provision</td>
			<td width="15%">{{ $equipmentinspection['vapour_return_provision_tir'] ?? '' }}</td>
			<td width="20%">{{ $equipmentinspection['vapour_return_provision_seal'] ?? '' }}</td>
			<td width="25%">{{ $equipmentinspection['vapour_return_provision_comments'] ?? '' }}</td>
		</tr>
		<tr>
			<td width="10%">9</td>
			<td width="30%">Fwd Inspection Hatch</td>
			<td width="15%">{{ $equipmentinspection['fwd_inspection_hatch_tir'] ?? '' }}</td>
			<td width="20%">{{ $equipmentinspection['fwd_inspection_hatch_seal'] ?? '' }}</td>
			<td width="25%">{{ $equipmentinspection['fwd_inspection_hatch_comments'] ?? '' }}</td>
		</tr>
		<tr>
			<td width="10%">10</td>
			<td width="30%">Afg Inspection Hatch</td>
			<td width="15%">{{ $equipmentinspection['afg_inspection_hatch_tir'] ?? '' }}</td>
			<td width="20%">{{ $equipmentinspection['afg_inspection_hatch_seal'] ?? '' }}</td>
			<td width="25%">{{ $equipmentinspection['afg_inspection_hatch_comments'] ?? '' }}</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr><td>&nbsp;</td></tr>
	</table>
	<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
		<tr>
			<td width="50%">
				LAST TEST DATE: &nbsp;&nbsp;{{ $equipmentinspection['last_test_date'] ?? '' }}<br>
				CAPACITY: &nbsp;&nbsp;{{ $equipmentinspection['capacity'] ?? '' }}
			</td>
			<td width="50%">
				TARE: &nbsp;&nbsp;{{ $equipmentinspection['tare_weight'] ?? '' }}<br>
				MGW: &nbsp;&nbsp;{{ $equipmentinspection['mgw'] ?? '' }}
			</td>
		</tr>
		<tr>
			<td width="100%" height="60px">
				COMMENTS: &nbsp;&nbsp;{{ $equipmentinspection['comments'] ?? 'null' }}
			</td>
		</tr>
	</table>
	<p></p>
	<table width="100%" cellspacing="0" cellpadding="2" border="0">
		<tr valign="middle">
			<td width="75%" valign="middle" style="text-align: left; margin: auto;">Issued Without Any Prejudice.</td>
			<td width="25%" style="text-align: center;">
				<img src="{{ $sign }}" alt="Signature" width="100px"/>
			</td>
		</tr>
	</table>
</body>
</html>
