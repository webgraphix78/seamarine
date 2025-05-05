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
				<h3 style="text-align: center;margin: 0;padding: 0;">Refer Equipment Acceptability Report</h3>
			</td>
			<td width="20%">
				<h3 style="text-align: center;margin: 0;padding: 0;">Ref No {{$referequipment['ref_no']}}</h3>
			</td>
		</tr>
	</table>
	<p>
		<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
			<tr>
				<td width="25%">Place Of Inspection:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['rel_inspection_location_id']['name'] ?? 'null' }}</td>
				<td width="25%">On Behalf Of:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['rel_customer_id']['name'] ?? 'null' }}</td>
			</tr>
			<tr>
				<td width="25%">Container No:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['tank_no'] ?? 'null' }}</td>
				<td width="25%">Shipping Agency:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['shipping_agency'] ?? 'null' }}</td>
			</tr>
			<tr>
				<td width="25%">Container Type:</td>
				<td width="25%" style="font-weight:bold;" >
					@switch($referequipment["container_type"])
					@case(1)
					20RF
					@break
					@case(2)
					40RF
					@break
					@endswitch
				</td>
				<td width="25%">Booking No:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['booking_no'] ?? 'null' }}</td>
			</tr>
			<tr>
				<td width="25%">Refrigeration Machinery:</td>
				<td width="25%" style="font-weight:bold;"></td>
				<td width="25%">Model:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['model'] ?? 'null' }}</td>
			</tr>
			<tr>
				<td width="25%">Serial:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['serial'] ?? 'null' }}</td>
				<td width="25%">In Service:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['in_service'] ?? 'null' }}</td>
			</tr>
			<tr>
				<td width="25%">Place Of Inspection:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['rel_inspection_location_id']['name'] ?? 'null' }}</td>
				<td width="25%">On Behalf Of:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['rel_customer_id']['name'] ?? 'null' }}</td>
			</tr>
			<tr>
				<td width="25%">Date Of Last Pre-Trip Insp:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['date_of_last_pretrip'] ?? 'null' }}</td>
				<td width="25%">Plugged In To Power Supply & Run Through:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['run_through'] ?? 'null' }}</td>
			</tr>
			<tr>
				<td width="25%">Temperature Set (PTI):</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['temperature_set_pti'] ?? 'null' }}</td>
				<td width="25%">Temp.Set Rechecked:</td>
				<td width="25%" style="font-weight:bold;">{{ $referequipment['temperature_set_rechecked'] ?? 'null' }}</td>
			</tr>
		</table>
	<p>
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td align="center" width="100%" >
			Inspection of Exterior/interior of container and Refrigeration Machinery carried out. All components found within acceptable limit marked O K.<br>Incase of any remark marked R and same elaborated in comment box.
			</td>
		</tr>
		<tr>
			<td width="100%" >Container</td>
		</tr>
	</table>
	<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr>
			<td width="25%">Exterior:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['exterior'] ?? 'null' }}</td>
			<td width="25%">Interior:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['interior'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Right Side:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['exterior_right'] ?? 'null' }}</td>
			<td width="25%">Right Side:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['interior_right'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Left Side:</td>
			<td width="25%" style="font-weight:bold;" >{{ $referequipment['exterior_left'] ?? 'null' }}</td>
			<td width="25%">Left Side:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['interior_left'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Front Side:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['exterior_front'] ?? 'null' }}</td>
			<td width="25%">Front Side & Baffle Plate:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['interior_front'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Roof:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['exterior_roof'] ?? 'null' }}</td>
			<td width="25%">Ceiling:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['interior_ceiling'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Under Side:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['exterior_under'] ?? 'null' }}</td>
			<td width="25%">Floor:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['interior_floor'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Rear Side:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['exterior_rear'] ?? 'null' }}</td>
			<td width="25%">Rear Side:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['interior_rear'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Rear Door Right Side:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['exterior_rear_door_right'] ?? 'null' }}</td>
			<td width="25%">Rear Door Right Side:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['interior_rear_door_right'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Rear Door Left Side:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['exterior_rear_door_left'] ?? 'null' }}</td>
			<td width="25%">Rear Door Left Side:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['interior_rear_door_left'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Seaworthiness:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['seaworthiness'] ?? 'null' }}</td>
			<td width="25%">Clean & Free From Any Odour:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['clean_free_from_odour'] ?? 'null' }}</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="margin-bottom:10px;">
		<tr><td width="100%">&nbsp;</td></tr>
		<tr>
			<td width="100%">Refrigeration Machinery</td>
		</tr>
		<tr>
			<td width="100%">&nbsp;</td>
		</tr>
	</table>
	<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr>
			<td width="25%">440 V Cable 18 mtrs.:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['cable_440'] ?? 'null' }}</td>
			<td width="25%">440 V Power Plug:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['power_plug_440'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Controller:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['controller'] ?? 'null' }}</td>
			<td width="25%">Contactors:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['contactors'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Transformer:</td>
			<td width="25%" style="font-weight:bold;" >{{ $referequipment['transformer'] ?? 'null' }}</td>
			<td width="25%">Battery:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['battery'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">MCB:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['mcb'] ?? 'null' }}</td>
			<td width="25%">Display Board:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['display_board'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Compressor:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['compressor'] ?? 'null' }}</td>
			<td width="25%">Wiring Terminals & Connections In Control Boxes:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['wiring_terminals'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="25%">Unit Bolts Fasteners:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['unit_bolts_fasteners'] ?? 'null' }}</td>
			<td width="25%">Plugged in to Power Supply , run through & Temperature set ⁰ C checked:</td>
			<td width="25%" style="font-weight:bold;">{{ $referequipment['refg_run_through'] ?? 'null' }}</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr><td>COMMENT:</td></tr>
		<tr><td>{{ $referequipment['comments'] }}</td></tr>
	</table>
	<table><tr><td>&nbsp;</td></tr></table>
	<table><tr><td>&nbsp;</td></tr></table>
	<table width="100%" cellspacing="0" cellpadding="2" border="0">
		<tr valign="middle">
			<td width="75%" valign="middle" style="text-align: left; margin: auto;">
				<table width="100%">
					<tr>
						<td>Certificate Issued Without Any Prejudice</td>
					</tr>
					<tr>
						<td>
							Surveyor Name: {{ $referequipment['rel_surveyor_id']['name'] ?? 'N/A' }}
						</td>
					</tr>
				</table>
			</td>
			<td width="25%" style="text-align: center;" valign="middle" rowspan="2">
				<img src="{{ $sign }}" alt="Signature" width="70px"/>
			</td>
		</tr>
	</table>
</body>
</html>