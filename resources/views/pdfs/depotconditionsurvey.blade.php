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
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td width="30%" style="margin: auto;">
				<h3 style="text-align: start;margin: 0;padding: 0;">Reference No: {{$depotconditionsurvey['ref_no']}}</h3>
			</td>
			<td width="40%">
				<h3 style="text-align: center;margin: 0;padding: 0;">TANK CONTAINER CONDITION REPORT</h3>
			</td>
			<td width="30%"></td>
		</tr>
	</table>
	<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr>
			<th width="25%">DATE OF INSPECTION:<br>{{$depotconditionsurvey['inspection_date']}}</th>
			<th width="25%">CONTAINER NUMBER:<br>{{$depotconditionsurvey['tank_no']}}</th>
			<th width="25%">MFG SR. NO:<br>{{$depotconditionsurvey['mfg_sr_no']}}</th>
			<th width="25%">LAST TEST DATE:<br>{{$depotconditionsurvey['last_test_date']}}</th>
		</tr>
		<tr>
			<th width="25%">CLIENT:<br>{{$depotconditionsurvey['rel_customer_id']['name']}}</th>
			<th width="12%">MGW:<br>{{$depotconditionsurvey['mgw']}}</th>
			<th width="13%">TARE WT:<br>{{$depotconditionsurvey['tare_wt']}}</th>
			<th width="25%">ISO TYPE:<br>{{$depotconditionsurvey['iso_type']}}</th>
			<th width="25%">CAPACITY:<br>{{$depotconditionsurvey['capacity']}}</th>
		</tr>
		<tr>
			<th width="25%">PLACE OF INSEPCTION:<br>{{$depotconditionsurvey['rel_inspection_location_id']['name']}}</th>
			<th width="25%">DATE OF MANUFACTURE: {{$depotconditionsurvey['date_of_mfg']}}</th>
			<th width="25%">MANUFACTURE:<br>{{$depotconditionsurvey['mfg']}}</th>
			<th width="25%">NEXT INSPCTION DATE:<br>{{$depotconditionsurvey['next_inspection_date']}}</th>
		</tr>
	</table>
	<table width="100%"><tr><td>&nbsp;</td></tr></table>
	<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-top: 1px solid #000000;">
		<tr>
			<td align="center" width="100%">PLEASE MARK CLEARLY ALL DAMAGES AND DEFICIENCIES, ICC REGULATIONS REQUIRE THAT EACH PART LISTED BE INSPECTED. THE DRAWINGS ABOVE ARE SCHEMATIC ONLY. PLEASE DRAW IN ANY DEFECTIVE PARTS AND NAME THEM IN THE BLANK NUMBERED SPACE BELOW USING THE FOLLOWING CODES TO SHOW THE CONDITION OF THE EQUIPMENT:</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr style="">
			<td width="4%" style="border: 1px solid #eeeeee; text-align: center;">Z</td>
			<td width="7%">PREVIOUS REPAIR </td>
			<td width="4%" style="border: 1px solid #eeeeee; text-align: center;">ST</td>
			<td width="7%">STAIN </td>
			<td width="4%" style="border: 1px solid #eeeeee; text-align: center;">CT</td>
			<td width="7%">CUT </td>
			<td width="4%" style="border: 1px solid #eeeeee; text-align: center;">HO</td>
			<td width="7%">HOLE </td>
			<td width="4%" style="border: 1px solid #eeeeee; text-align: center;">MS</td>
			<td width="7%">MISSING </td>
			<td width="4%" style="border: 1px solid #eeeeee; text-align: center;">BR</td>
			<td width="7%">BROKEN</td>
			<td width="4%" style="border: 1px solid #eeeeee; text-align: center;">DT</td>
			<td width="7%">DENT </td>
			<td width="4%" style="border: 1px solid #eeeeee; text-align: center;">IR</td>
			<td width="7%">IMPROPER REPAIR  </td>
			<td width="4%" style="border: 1px solid #eeeeee; text-align: center;">GL</td>
			<td width="7%">GLUE LABEL</td>
		</tr>
	</table>
	<tr><td>&nbsp;</td></tr>
	<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000">
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td align="center">
			All damages, missing parts and deficiencies marked. Each part listed below is inspected in accordance with ITCO norms. Schematic drawing indicates defective areas with name in the Boxes.
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
	</table>
	<tr><td>&nbsp;</td></tr>
	<table width="100%" border="0" cellspacing="0" cellpadding="1">
		<tr>
			<td width="50%">
				<table width="100%">
					<tr>
						<td width="80%">1.&nbsp; PROTECTION COVER</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["protection_cover"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">2.&nbsp; MANHOLE-PROTECTION COVER-FASTENING BOLTS</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["manhole_cover_fastening_bolts"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">3.&nbsp; TOP SAFETY VALVE (SR. NO. <strong>{{$depotconditionsurvey['top_safety_valve_sr_no']}}</strong>)</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["top_safety_valve"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">4.&nbsp; RUPTURE DISC (UNDER #3 WHEN IN SERIES)</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["rupture_disc_series"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">5.&nbsp; DIPPING PIPE</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["dipping_pipe"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">6.&nbsp; AIR VALVE</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["air_valve"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">7.&nbsp; DIPSTICK</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["dipstick"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">8.&nbsp; MANHOLE GASKET TYPE - <strong>{{$depotconditionsurvey['manhole_gasket_type']}}</strong></td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["manhole_gasket"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">9.&nbsp; WALKWAY</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["walkway"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">10.&nbsp; TOP LOADING – <strong>{{$depotconditionsurvey['top_loading']}}</strong> FLANGE</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["top_loading_flange"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table width="100%">
					<tr>
						<td width="80%">11.&nbsp; INLET/OUTLET HEATING PLUG/PIPE</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["heating_plug_pipe"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">11a.&nbsp; INLET/OUTLET HEATING PIPE COVERS</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["heating_pipe_covers"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">12.&nbsp; BOTTOM OUTLET VALVE</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["bottom_outlet_valve"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">13.&nbsp; BOTTOM OUTLET VALVE CAP/BLANK FLANGE</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["bottom_valve_cap"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">13a.&nbsp; BOTTOM OUTLET VALVE CAP BOLTS & NUTS</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["bottom_valve_bolts_nuts"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">13b.&nbsp; BOTTOM OUTLET VALVE LEVER</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["bottom_valve_lever"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">14.&nbsp; LADDER</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["ladder"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">15.&nbsp; DOCUMENT BOX</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["document_box"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">16.&nbsp; THERMOMETER: <strong>{{$depotconditionsurvey['thermometer_temp']}}</strong> FLANGE</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["thermometer"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">17.&nbsp; REMOTE SHUT OFF</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["remote_shut_off"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">18.&nbsp; HAND RAIL</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["hand_rail"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<tr><td>&nbsp;</td></tr>
	<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-top: 1px solid #000000;">
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td align="center">
				PLEASE INSPECT FOR THE FOLLOWING CONDITIONS AND CHECK THE APPROPRIATE BOX IF THE NAMED CONDITION IS NOT PRESENT ANY DEFECTS TO BE SPECIFIED IN THE COMMENTS AREA PROVIDED BELOW.
			</td>
		</tr>
	</table>
	<tr><td>&nbsp;</td></tr>
	<table width="100%" border="0" cellspacing="0" cellpadding="1">
		<tr>
			<td width="45%">
				<table width="100%">
					<tr><td width="100%" style="font-weight:bold;">INTERIOR CONDITION:</td></tr>
					<tr>
						<td width="80%">RUST [SURFACE/SCRATCHES]</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["rust"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">DISCOLOURATION</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["discolouration"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">SURFACE SCORING/GOUGE</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["surface_scoring"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">PITTING/SURFACE/PIN HOLES</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["pitting_surface_pin"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">CORROSION MARK</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["corrosion_mark"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="80%">OTHERS</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["others"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
				</table>
			</td>
			<td width="5%"></td>
			<td width="50%">
				<table width="100%">
					<tr><td width="100%" style="font-weight:bold;">ANY VISIBLE DAMAGES TO FRAMEWORK/CLADDDING</td></tr>
					<tr>
						<td width="60%">FRONT END</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["framework_front_end"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["cladding_front_end"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="60%">REAR END</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["framework_rare_end"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["cladding_rare_end"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="60%">RIGHT SIDE</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["framework_right_side"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["cladding_right_side"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="60%">LEFT SIDE</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["framework_left_side"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["cladding_left_side"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="60%">TOP</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["framework_top"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["cladding_top"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
					<tr>
						<td width="60%">BOTTOM</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["framework_bottom"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
						<td width="20%" style="border: 1px solid #000000; text-align: center;">
							@switch($depotconditionsurvey["cladding_bottom"])
							@case(1)
							Yes
							@break
							@case(0)
							No
							@break
							@endswitch
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
	</table>
	<table width="100%"><tr><td>&nbsp;</td></tr></table>
	<table border="1" cellspacing="0" cellpadding="10" style="padding:10px;">
		<tr>
			<td>Exterior Remarks: {{ $depotconditionsurvey['exterior_remarks'] }}</td>
		</tr>
	</table>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<table width="100%"><tr><td>&nbsp;</td></tr></table>
	<table width="100%" border="0" cellspacing="0" cellpadding="2" >
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td>Tank Container Mapping Chart for LIQUID tanks</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
	</table>
	<table border="1" cellspacing="0" cellpadding="8" >
		<tr>
			<td>Tank Number: {{ $depotconditionsurvey['liquid_tank_no'] }}</td>
			<td>Date: {{ $depotconditionsurvey['liquid_inspection_date'] }}</td>
			<td>Location: {{ $depotconditionsurvey['rel_liquid_inspection_location_id']['name'] }}</td>
		</tr>
	</table>
	<table width="100%"><tr><td>&nbsp;</td></tr></table>
	@if( $liquid_img != null && strlen($liquid_img) > 0 )
	<table width="100%" cellspacing="0" cellpadding="2" border="0">
		<tr>
			<td width="100%"><img src="{{ $liquid_img }}" style="height:600px; width: 900px;"></td>
		</tr>
	</table>
	@endif 
	<table width="100%"><tr><td>&nbsp;</td></tr></table>
	<table border="1" cellspacing="0" cellpadding="10" style="padding:10px;">
		<tr>
			<td>Remarks: {{ $depotconditionsurvey['remarks'] }}</td>
		</tr>
	</table>
	<table width="100%"><tr><td>&nbsp;</td></tr></table>
	<table width="100%" cellspacing="0" cellpadding="2" border="0">
		<tr valign="middle">
			<td width="75%" valign="middle" style="text-align: left; margin: auto;">
				<table width="100%">
					<tr>
						<td>Certificate Issued Without Any Prejudice</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
							NAME OF INSPECTOR:: {{ $depotconditionsurvey['rel_surveyor_id']['name'] ?? 'N/A' }}
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