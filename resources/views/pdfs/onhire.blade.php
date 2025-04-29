<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $onhire['ref_no'] }}</title>
	<style>
		td {
			font-size: 9px;
		}
	</style>
</head>

<body>
	<table width="100%" border="0" cellspacing="5" cellpadding="0" style="border: 1 solid #000000">
		<tr>
			<td width="33%"><b>Customer:</b>&nbsp;{{ $onhire["customer"]["name"] }}</td>
			<td width="33%">
				<b>Survey Type:</b>&nbsp;
				@switch($onhire["survey_type"])
				@case(1)
				On-hire
				@break
				@case(2)
				Off-hire
				@break
				@case(3)
				Condition
				@break
				@endswitch
			</td>
			<td width="34%">
				<b>Form for Liquid Tanks:</b>&nbsp;
				@switch($onhire["form_liquid_tanks"])
				@case(1)
				Food
				@break
				@case(2)
				Chemicals
				@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="33%">
				<b>Date:</b>&nbsp;{{$onhire["inspection_date"]}}
			</td>
			<td colspan="2" width="67%">
				<b>Location:</b>&nbsp;{{$onhire["inspection_location"]["name"]}}
			</td>
		</tr>
	</table>
	<table border="0" cellspacing="4" cellpadding="2">
		<tr>
			<td width="33%"><b>Unit Nr:</b>&nbsp; {{$onhire["unit_nr"]}}</td>
			<td width="33%"><b>Tank Type:</b>&nbsp; {{$onhire["tank_type"]["type"]}} </td>
			<td width="34%"><b>UN PORTABLE TANK:</b>&nbsp; {{$onhire["tcode"]["name"]}}</td>
		</tr>
		<tr>
			<td width="33%"><b>Manufacturer:</b>&nbsp; {{$onhire["manufacturer"]}}</td>
			<td width="33%"><b>ISO Type:</b>&nbsp;  {{$onhire["iso_type"]}} </td>
			<td width="34%"><b>Serial No:</b>&nbsp;  {{$onhire["serial_no"]}}</td>
		</tr>
		<tr>
			<td width="33%"><b>First Test:</b>&nbsp;{{$onhire["first_test"]}} <b>By:</b> {{$onhire["first_by"]}}</td>
			<td width="33%"><b>Last 2.5 yrs:</b>&nbsp;{{$onhire["last_25"]}} <b>By:</b> {{$onhire["last_25_by"]}}</td>
			<td width="34%"><b>Last 5 Yrs:</b>&nbsp;{{$onhire["last_5"]}} <b>By:</b> {{$onhire["last_5_by"]}}</td>
		</tr>

		<tr>
			<td width="33%"><b>Next Test Due:</b>&nbsp; {{$onhire["next_due_date"]}} </td>
			<td width="67%"><b>CSC ACEP-Next CSC Due:</b>&nbsp;{{$onhire["csc_acep_date"]}}</td>
		</tr>

		<tr>
			<td width="33%"><b>Maximum Gross Weight(Kg):</b>&nbsp; {{$onhire["max_gross_wgt"]}} </td>
			<td width="33%"><b>Tare(Kg):</b>&nbsp; {{$onhire["tare_wgt"]}} </td>
			<td width="34%"><b>Capacity (L):</b>&nbsp; {{$onhire["capacity"]}}</td>
		</tr>

		<tr>
			<td width="33%"><b>MAWP:</b>&nbsp; {{$onhire["mawp"]}}</td>
			<td width="67%"><b>Test Pressure:</b>&nbsp; {{$onhire["test_pressure"]}}</td>
		</tr>

		<tr>
			<td width="33%"><b>Steam Tube WP:</b>&nbsp; {{$onhire["steam_tube_wp"]}}</td>
			<td width="67%"><b>Steam Test Pressure:</b>&nbsp; {{$onhire["steam_test_pressure"]}}</td>
		</tr>
	</table>
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="50%"><b>Shell Tank Material:</b>&nbsp; {{$onhire["shell_tank_material"]}}</td>
			<td width="50%"><b>Shell Head:</b>&nbsp; {{$onhire["shell_head"]}}</td>
		</tr>
		<tr>
			<td width="50%"><b>Shell Thickness (mm):</b>&nbsp; {{$onhire["shell_thickness"]}}</td>
			<td width="50%"><b>Shell Head Thickness (mm):</b>&nbsp; {{$onhire["shell_head_thickness"]}}</td>
		</tr>
	</table>
	<table border="0" cellspacing="5" cellpadding="4" style="border: 1 solid #000000">
		<tr>
			<td width="33%" align="center"><b>X = Fitted</b></td>
			<td width="33%" align="center"><b>XX = Fitted with comments</b></td>
			<td width="34%" align="center"><b>N/A = Not Applicable</b></td>
		</tr>
	</table>
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{ $onhire["main"]["bd_x"] }}</td>
			<td width="30%">
				<b>Bottom Discharge:</b>&nbsp; 
				@switch($onhire["main"]["bd_x_value"])
					@case(1)
						Fortvale
					@break
					@case(2)
						Perolo
					@break
					@case(3)
						Pelican
					@break
					@case(0)
						Other - {{$onhire["main"]["bd_other"]}}
					@break
				@endswitch
			</td>
			<td width="30%">
				@switch($onhire["main"]["bd_butterfly_ball"])
					@case(1)
						Butterfly
					@break
					@case(2)
						Ball
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>
			<td width="30%"><b>SN:</b>&nbsp; {{$onhire["main"]["bd_butterfly_ball_sn"]}}</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="30%">
				<b>TIR Strips:</b>&nbsp;
				@switch($onhire["main"]["bd_tir_strip"])
					@case(1)
						Yes
					@break
					@case(0)
						No
					@break
				@endswitch
			</td>
			<td width="60%" colspan="2"><b>Spacers:</b>&nbsp;
				@switch($onhire["main"]["bd_spacers"])
					@case(1)
						0
					@break
					@case(2)
						1
					@break
					@case(3)
						2
					@break
					@case(4)
						3
					@break
					@case(5)
						4
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="10%">{{ $onhire["main"]["fv_x"] }}</td>
			<td width="30%"><b>Foot Valve:</b>&nbsp;
				@switch($onhire["main"]["fv_x_value"])
					@case(1)
						Fort Vale
					@break
					@case(2)
						Perolo
					@break
					@case(0)
						Other - {{ $onhire["main"]["fv_other"] }}
					@break
				@endswitch
			</td>
			<td width="30%">
				@switch($onhire["main"]["fv_option"])
					@case(1)
						Cleanflow
					@break
					@case(2)
						Highlift
					@break
					@case(3)
						Neatflow
					@break
					@case(4)
						Neatco
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>
			<td width="30%">
				<b>TIR Strips:</b>&nbsp;
				@switch($onhire["main"]["fv_tir_strip"])
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
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{ $onhire["main"]["bocp_x"] }}</td>
			<td width="30%"><b>Bottom Outlet Cap/Blank:</b>&nbsp; 
				@switch($onhire["main"]["bocp_x_value"])
					@case(1)
						4 Bolt Blank
					@break
					@case(2)
						6 Bolt Blank
					@break
					@case(3)
						8 Bolt Blank
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>
			<td width="30%"><b>3" BSP:</b>&nbsp; {{$onhire["main"]["bocp_3_bsp"]}}</td>
			<td width="30%"><b>Cap:</b>&nbsp; 
				@switch($onhire["main"]["bocp_cap"])
					@case(1)
						SS
					@break
					@case(2)
						ALU
					@break
					@case(3)
						PVC
					@break
					@case(4)
						BRASS
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>
		</tr>
	</table>
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{$onhire["main"]["rt_x"]}}</td>
			<td width="30%"><b>Remote Trip:</b>&nbsp; 
			@switch($onhire["main"]["rt_type"])
					@case(1)
						Pull Cable
					@break
					@case(2)
						Handle
					@break
					@case(3)
						Spring
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>
			<td width="60%" colspan="2"><b>Fusible Link:</b>&nbsp;
				@switch($onhire["main"]["rt_fusible_link"])
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
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{$onhire["main"]["td_x"]}}</td>
			<td width="30%"><b>Top Discharge:</b>&nbsp; {{$onhire["main"]["td_dn"]}}</td>
			<td width="30%">
				@switch($onhire["main"]["td_dn_value_1"])
					@case(1)
						4 Bolt Blank
					@break
					@case(2)
						6 Bolt Blank
					@break
					@case(3)
						8 Bolt Blank
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>
			<td width="30%" colspan="2">
				@switch($onhire["main"]["td_dn_value_2"])
					@case(1)
						Fortvale
					@break
					@case(2)
						Perolo
					@break
					@case(3)
						Pelican
					@break
					@case(0)
						Other - {{$onhire["main"]["td_dn_other"]}}
					@break
				@endswitch
				&nbsp;&nbsp;&nbsp;
				@switch($onhire["main"]["td_butterfly_ball"])
					@case(1)
						Butterfly
					@break
					@case(2)
						Ball
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="30%">
				<b>TIR Strips:</b>&nbsp;
				@switch($onhire["main"]["td_tir_strip"])
					@case(1)
						Yes
					@break
					@case(0)
						No
					@break
				@endswitch
			</td>
			<td width="30%" colspan="2">
				<b>Siphon Tube:</b>&nbsp; 
				@switch($onhire["main"]["td_siphon_tube"])
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
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{$onhire["main"]["tl_x"]}}</td>
			<td width="30%"><b>Top Loading:</b>&nbsp; {{$onhire["main"]["tl_dn"]}}</td>
			<td width="30%">
				@switch($onhire["main"]["tl_dn_value_1"])
					@case(1)
					4 Bolt Blank
					@break
					@case(2)
					6 Bolt Blank
					@break
					@case(3)
					8 Bolt Blank
					@break
					@case(-1)
						No
					@break
				@endswitch
				&nbsp;&nbsp;&nbsp;
				@switch($onhire["main"]["tl_dn_value_2"])
					@case(1)
						Fortvale
					@break
					@case(2)
						Perolo
					@break
					@case(3)
						Pelican
					@break
					@case(0)
						Other - {{$onhire["main"]["tl_dn_other"]}}
					@break
				@endswitch
			</td>
			<td width="30%">
				@switch($onhire["main"]["tl_butterfly_ball"])
					@case(1)
						Butterfly
					@break
					@case(2)
						Ball
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="90%" colspan="3">
				<b>TIR Strips:</b>&nbsp;
				@switch($onhire["main"]["tl_tir_strip"])
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
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{$onhire["main"]["av_x"]}}</td>
			<td width="30%"><b>Air Vent:</b>&nbsp;
				@switch($onhire["main"]["av_value_inch"])
					@case(1)
					3/4 Inch
					@break
					@case(2)
					1 Inch
					@break
					@case(3)
					1.5 Inch
					@break
					@case(4)
					2 Inch
					@break
					@case(5)
					2.5 Inch
					@break
					@case(6)
					3 Inch
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="30%">
				@switch($onhire["main"]["av_value"])
					@case(1)
						Fortvale
					@break
					@case(2)
						Perolo
					@break
					@case(3)
						Pelican
					@break
					@case(0)
						Other - {{$onhire["main"]["av_other"]}}
					@break
				@endswitch
			</td>
			<td width="30%">
				@switch($onhire["main"]["av_butterfly_ball"])
					@case(1)
						Butterfly
					@break
					@case(2)
						Ball
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>		
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="30%"><b>Air Vent Connection:</b>&nbsp;
				@switch($onhire["main"]["avc_type"])
					@case(1)
					Bsp
					@break
					@case(2)
					Npt"
					@break
					@case(3)
					Quick
					@break
					@case(4)
					Flange
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td colspan="2" width="60%">
				<b>TIR Strips:</b>&nbsp;
				@switch($onhire["main"]["avc_tir_strip"])
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
			<td width="10%">&nbsp;</td>
			<td width="30%"><b>Air Vent</b>&nbsp;
				@switch($onhire["main"]["avc_cap_blank_v1"])
					@case(1)
					Cap
					@break
					@case(2)
					Blank
					@break
					@case(-1)
					NA
					@break
				@endswitch
				&nbsp;&nbsp;&nbsp;
				@switch($onhire["main"]["avc_cap_blank_v2"])
					@case(1)
						4 Bolt Bank
					@break
					@case(2)
						Cap with Chain
					@break
					@case(3)
						Cable
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>
			<td width="30%">
				@switch($onhire["main"]["avc_cap_blank_v3"])
					@case(1)
						SS
					@break
					@case(2)
						ALU
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>
			<td width="30%"><b>Airline Pressure Gauge</b>&nbsp; {{$onhire["main"]["avc_air_pressure_gauge"]}}</td>
		</tr>
	</table>
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{$onhire["main"]["srv1_x"]}}</td>
			<td width="18%">
				<b>SRV1:</b>&nbsp;
				@switch($onhire["main"]["srv1_value1"])
					@case(1)
					Fort Vale
					@break
					@case(2)
					Perolo
					@break
					@case(0)
					Other - {{$onhire["main"]["srv1_other"]}}
					@break
				@endswitch
			</td>
			<td width="18%">
				@switch($onhire["main"]["srv1_value2"])
					@case(1)
					Flanged
					@break
					@case(2)
					Threaded
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="18%">
				@switch($onhire["main"]["srv1_value3"])
					@case(1)
					4 Bolt Blank
					@break
					@case(2)
					6 Bolt Blank
					@break
					@case(3)
					8 Bolt Blank
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="18%"><b>Pressure:</b>&nbsp; {{$onhire["main"]["srv1_pressure"]}} Bar</td>
			<td width="18%"><b>Vac:</b>&nbsp;
				@switch($onhire["main"]["srv1_vac"])
					@case(1)
					6 inch Hg
					@break
					@case(2)
					6.2 inch Hg
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="18%"><b>Serial:</b>&nbsp; {{$onhire["main"]["srv1_serial"]}}</td>
			<td width="18%">
				<b>TIR Strips:</b>&nbsp;
				@switch($onhire["main"]["srv1_tir_strip"])
					@case(1)
						Yes
					@break
					@case(0)
						No
					@break
				@endswitch
			</td>
			<td width="54%">
				<b>Flame screen:</b>&nbsp;
				@switch($onhire["main"]["srv1_flame_screen"])
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
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{$onhire["main"]["srv2_x"]}}</td>
			<td width="18%">
				<b>SRV2:</b>&nbsp;
				@switch($onhire["main"]["srv2_value1"])
					@case(1)
					Fort Vale
					@break
					@case(2)
					Percolo
					@break
					@case(0)
					Other - {{$onhire["main"]["srv2_other"]}}
					@break
				@endswitch
			</td>
			<td width="18%">
				@switch($onhire["main"]["srv2_value2"])
					@case(1)
					Flanged
					@break
					@case(2)
					Threaded
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="18%">
				@switch($onhire["main"]["srv2_value3"])
					@case(1)
					4 Bolt Blank
					@break
					@case(2)
					6 Bolt Blank
					@break
					@case(3)
					8 Bolt Blank
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="18%">
				<b>Pressure:</b>&nbsp; {{$onhire["main"]["srv2_pressure"]}} Bar 
			</td>
			<td width="18%">
				<b>Vac:</b>&nbsp;
				@switch($onhire["main"]["srv2_vac"])
					@case(1)
					6 inch Hg
					@break
					@case(2)
					6.2 inch Hg
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="18%"><b>Serial:</b>&nbsp; {{$onhire["main"]["srv2_serial"]}}</td>
			<td width="18%">
				<b>TIR Strips:</b>&nbsp;
				@switch($onhire["main"]["srv2_tir_strip"])
					@case(1)
						Yes
					@break
					@case(0)
						No
					@break
				@endswitch
			</td>
			<td width="54%"><b>Flame screen:</b>&nbsp;
				@switch($onhire["main"]["srv2_flame_screen"])
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
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{ $onhire["main"]["rd1_x"] }}</td>
			<td width="25%"><b>Rupture Disc 1:</b>&nbsp;</td>
			<td width="25%"><b>Manufacturer:</b>&nbsp;{{ $onhire["main"]["rd1_manufacturer"] }}</td>
			<td width="20%"><b>Bar: </b>&nbsp;{{ $onhire["main"]["rd1_bar"] }}</td>
			<td width="20%"><b>Size  </b>&nbsp;{{ $onhire["main"]["rd1_size"] }}/mm</td>
		</tr>
	</table>
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{ $onhire["main"]["rd2_x"] }}</td>
			<td width="25%"><b>Rupture Disc 2:</b>&nbsp;</td>
			<td width="25%"><b>Manufacturer:</b>&nbsp;{{ $onhire["main"]["rd2_manufacturer"] }}</td>
			<td width="20%"><b>Bar: </b>&nbsp;{{ $onhire["main"]["rd2_bar"] }}</td>
			<td width="20%"><b>Size  </b>&nbsp;{{ $onhire["main"]["rd2_size"] }}/mm</td>
		</tr>
	</table>
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{ $onhire["main"]["srv1_mano_x"] }}</td>
			<td width="45%"><b>Srv 1 Manometer: </b>&nbsp;{{ $onhire["main"]["srv1_mano_value1"] }}</td>
			<td width="45%"><b>Bar: </b>&nbsp;{{ $onhire["main"]["srv1_mano_bar"] }}</td>
		</tr>
	</table>	
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="10%" style="text-decoration: underline;">{{ $onhire["main"]["srv2_mano_x"] }}</td>
			<td width="45%"><b>Srv 2 Manometer: </b>&nbsp;{{ $onhire["main"]["srv2_mano_value1"] }}</td>
			<td width="45%"><b>Bar: </b>&nbsp;{{ $onhire["main"]["srv2_mano_bar"] }}</td>
		</tr>
	</table>
	<br pagebreak="true"/>
	<table border="0" cellspacing="2" cellpadding="2" width="100%">
		<tr>
			<td colspan="2"><b>ANCLLARY FITTINGS</b></td>
			<td colspan="2"><b>Unit Nr: {{ $onhire["unit_nr"] }}</b></td>
		</tr>
		<tr>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["ancillary"]["ancf_1"] }}</td>
			<td width="45%"><b>Cladding:</b>&nbsp;
				@switch($onhire["ancillary"]["ancf_1_cladding"])
					@case(1)
					SS/ALU
					@break
					@case(2)
					SS
					@break
					@case(3)
					ALU
					@break
					@case(4)
					GRP
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["unitnr"]["unit_nr_1"] }}</td>
			<td width="45%">
				<b>Calibration Table:</b>&nbsp;
				@switch($onhire["unitnr"]["unit_nr_1_calibration"])
					@case(1)
						Stainless Steel
					@break
					@case(2)
						Paper
					@break
					@case(-1)
						NA
					@break
				@endswitch
				&nbsp;&nbsp;&nbsp;
				@switch($onhire["unitnr"]["unit_nr_1_calibration_value"])
					@case(1)
						In Spillbox
					@break
					@case(2)
						In Cover
					@break
					@case(3)
						On Cladding
					@break
					@case(4)
						On Manlid
					@break
					@case(-1)
						NA
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["ancillary"]["ancf_2"] }}</td>
			<td width="45%">Rear Ladder:
				@switch($onhire["ancillary"]["ancf_2_ladder"])
					@case(1)
					<b>Front</b>&nbsp;
					@break
					@case(2)
					<b>Rear Ladder</b>&nbsp;
					@break
					@case(3)
					<b>Front Ladder & Rear Ladder</b>&nbsp;
					@break
					@case(-1)
					NA
					@break
				@endswitch
				@switch($onhire["ancillary"]["ancf_2_ladder_type"])
					@case(1)
					IRON
					@break
					@case(2)
					SS
					@break
					@case(3)
					ALU
					@break
					@case(4)
					Galvanized
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["unitnr"]["unit_nr_2"] }}</td>
			<td width="45%">
				<b>Manlid With Swingbolts:</b>&nbsp;
				@switch($onhire["unitnr"]["unit_nr_2_manlid_swing"])
					@case(1)
					4 Bolted
					@break
					@case(2)
					6 Bolted
					@break
					@case(3)
					8 Bolted
					@break
					@case(4)
					16x / 20x
					@break
					@case(-1)
					NA
					@break
				@endswitch
				&nbsp;&nbsp;&nbsp;&nbsp;
				@switch($onhire["unitnr"]["unit_nr_2_manlid_swing_value"])
					@case(1)
					Fortvale
					@break
					@case(2)
					Perolo
					@break
					@case(3)
					Swift
					@break
					@case(4)
					X Securing Ring
					@break
					@case(-1)
					{{ $onhire["unitnr"]["unit_nr_2_manlid_swing_other"] }}
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["ancillary"]["ancf_3"] }}</td>
			<td width="45%"><b>Placard Holders:</b>&nbsp;
			@switch($onhire["ancillary"]["ancf_3_placard"])
					@case(1)
					0
					@break
					@case(2)
					1
					@break
					@case(3)
					2
					@break
					@case(4)
					3
					@break
					@case(5)
					4
					@break
					@case(6)
					5
					@break
					@case(7)
					6
					@break
					@case(8)
					7
					@break
					@case(9)
					8
					@break
					@case(10)
					9
					@break
					@case(11)
					10
					@break
					@case(12)
					11
					@break
					@case(13)
					12
					@break
					@case(14)
					13
					@break
					@case(15)
					14
					@break
					@case(16)
					15
					@break
					@case(17)
					16
					@break
					@case(18)
					17
					@break
					@case(19)
					18
					@break
					@case(10)
					19
					@break
					@case(21)
					20
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["unitnr"]["unit_nr_3"] }}</td>
			<td width="45%">
				<b>Collapsable Handrails:</b>&nbsp;
				{{ $onhire["unitnr"]["unit_nr_3_collapsible"] }}
			</td>
		</tr>
		<tr>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["ancillary"]["ancf_4"] }}</td>
			<td width="45%"><b>Decals:</b>&nbsp;
				@switch($onhire["ancillary"]["ancf_4_decals"])
					@case(1)
					Weight / Capacity
					@break
					@case(2)
					Foodlogo
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["unitnr"]["unit_nr_4"] }}</td>
			<td width="45%">
				<b>Dipstick:</b>&nbsp;
				@switch($onhire["unitnr"]["unit_nr_4_dipstick"])
					@case(1)
					Angle
					@break
					@case(2)
					Flat
					@break
					@case(-1)
					NA
					@break
				@endswitch
				&nbsp;&nbsp;&nbsp;&nbsp;
				@switch($onhire["unitnr"]["unit_nr_4_dipstick_value"])
					@case(1)
					Legible
					@break
					@case(2)
					Bracket
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["ancillary"]["ancf_5"] }}</td>
			<td width="45%"><b>Temp. Gauge:</b>&nbsp;
				@switch($onhire["ancillary"]["ancf_5_tgauge"])
					@case(1)
					Fortvale
					@break
					@case(2)
					Perolo
					@break
					@case(0)
					{{ $onhire["ancillary"]["ancf_5_other"] }}
					@break
				@endswitch
				<b>Temperature:</b>&nbsp; {{ $onhire["ancillary"]["ancf_5_temperature"] }}
				@switch($onhire["ancillary"]["ancf_5_ttype"])
					@case(1)
					Analog
					@break
					@case(2)
					Digital
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["unitnr"]["unit_nr_5"] }}</td>
			<td width="45%">
				<b>Topcovers & Lockings Material:</b>&nbsp;
				@switch($onhire["unitnr"]["unit_nr_5_topcover"])
					@case(1)	
					SS
					@break
					@case(2)
					ALU
					@break
					@case(3)
					IRON
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["ancillary"]["ancf_6"] }}</td>
			<td width="45%"><b>Document Tube:</b>&nbsp;{{ $onhire["ancillary"]["ancf_6_doc_tube"] }}</td>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["unitnr"]["unit_nr_6"] }}</td>
			<td width="45%">
				<b>Walkway:</b>&nbsp;
				@switch($onhire["unitnr"]["unit_nr_6_walkway"])
					@case(1)	
					SS
					@break
					@case(2)
					ALU
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["ancillary"]["ancf_7"] }}</td>
			<td width="45%"><b>Steam Tube Cap:</b>&nbsp;{{ $onhire["ancillary"]["ancf_7_steam_tube"] }}
				&nbsp;&nbsp;&nbsp;
				@switch($onhire["ancillary"]["ancf_7_steam_tube_value_1"])
					@case(1)
					BSP
					@break
				@endswitch
				&nbsp;&nbsp;&nbsp;
				@switch($onhire["ancillary"]["ancf_7_steam_tube_value_2"])
					@case(1)
					SS
					@break
					@case(2)
					PVC
					@break
					@case(3)
					ALU
					@break
					@case(4)
					BRASS
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["unitnr"]["unit_nr_7"] }}</td>
			<td width="45%">
				<b>Manlid Gasket:</b>&nbsp;
				@switch($onhire["unitnr"]["unit_nr_7_manlid_gasket"])
					@case(1)	
					SWR
					@break
					@case(2)
					PTFE
					@break
					@case(3)
					Viton A
					@break
					@case(4)
					Super Tanktyt
					@break
					@case(0)
					{{ $onhire["unitnr"]["unit_nr_7_manlid_gasket_other"] }}
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
		</tr>
		<tr>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["ancillary"]["ancf_8"] }}</td>
			<td width="45%">
				<b>Steam Accessoires:</b>&nbsp;{{ $onhire["ancillary"]["ancf_8_steam_acc"] }}
				&nbsp;&nbsp;&nbsp;
				@switch($onhire["ancillary"]["ancf_8_steam_acc_value"])
					@case(1)
					X Drainvalve
					@break
					@case(2)
					X Pv
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["unitnr"]["unit_nr_8"] }}</td>
			<td width="45%">
				<b>Grounding Lug:</b>&nbsp;
				@switch($onhire["unitnr"]["unit_nr_8_grounding"])
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
			<td width="5%" style="text-decoration: underline;">{{ $onhire["ancillary"]["ancf_9"] }}</td>
			<td width="45%"><b>Bottom Compartment Cover Material:</b>&nbsp;
				@switch($onhire["ancillary"]["ancf_9_bottom_comp"])
					@case(1)
					IRON
					@break
					@case(2)
					SS
					@break
					@case(3)
					ALU
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["unitnr"]["unit_nr_9"] }}</td>
			<td width="45%">
				<b>Bottomplate:</b>&nbsp;
				@switch($onhire["unitnr"]["unit_nr_9_bottomplate"])
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
			<td width="5%" style="text-decoration: underline;">{{ $onhire["ancillary"]["ancf_10"] }}</td>
			<td width="45%">
				<b>Electrical:</b>&nbsp;
				@switch($onhire["ancillary"]["ancf_10_electrical"])
					@case(1)
					Heating
					@break
					@case(2)
					Cooling
					@break
					@case(-1)
					NA
					@break
				@endswitch
				&nbsp;&nbsp;&nbsp;
				<b>Manufacturer:</b>&nbsp;
				{{$onhire["ancillary"]["ancf_10_manufacturer"]}}
			</td>
			<td width="5%" style="text-decoration: underline;">{{ $onhire["unitnr"]["unit_nr_10"] }}</td>
			<td width="45%">
				<b>PTI Date:</b>&nbsp;
				@switch($onhire["unitnr"]["unit_nr_10_pti_date"])
					@case(1)	
					Cable +/-
					@break
					@case(2)
					Mtr
					@break
					@case(3)
					Splice
					@break
					@case(4)
					Plug
					@break
					@case(-1)
					NA
					@break
				@endswitch
			</td>
		</tr>
	</table>
	@if($walkway_image_1 != null && strlen($walkway_image_1) > 0 )
		<table border="0" cellspacing="5" cellpadding="2" width="100%">
			<tr>
				<td><b>FRAME / CLADDING</b></td>
			</tr>
			<tr>
				<td width="100%"><img src="{{ $walkway_image_1 }}" style="max-width: 100%;"></td>
			</tr>
		</table>
	@endif 
	<table border="0" cellspacing="1" cellpadding="2" width="100%" style="border: 1px solid #000000">
		<tr>
			<td width="17%" style="font-size: 7.5px;">D1: Dented 5-10mm</td>
			<td width="17%" style="font-size: 7.5px;">AF: Product Affected</td>
			<td width="17%" style="font-size: 7.5px;">CR: Craked</td>
			<td width="17%" style="font-size: 7.5px;">EW: Existing Weld</td>
			<td width="16%" style="font-size: 7.5px;">SC: Scratched</td>
			<td width="16%" style="font-size: 7.5px;">MS: Missing</td>
		</tr>
		<tr>
			<td width="17%" style="font-size: 7.5px;">D2: Dented 10-15mm</td>
			<td width="17%" style="font-size: 7.5px;">BR: Broken</td>
			<td width="17%" style="font-size: 7.5px;">CT: Cut</td>
			<td width="17%" style="font-size: 7.5px;">GL: Glue Marks</td>
			<td width="16%" style="font-size: 7.5px;">SL: Sealed</td>
			<td width="16%" style="font-size: 7.5px;">PE: Peeling</td>
		</tr>
		<tr>
			<td width="17%" style="font-size: 7.5px;">D3: Dented 15-20mm</td>
			<td width="17%" style="font-size: 7.5px;">BT: Bent</td>
			<td width="17%" style="font-size: 7.5px;">EI: Existing Insert</td>
			<td width="17%" style="font-size: 7.5px;">GO: Gouged Material</td>
			<td width="16%" style="font-size: 7.5px;">ST: Stained</td>
			<td width="16%" style="font-size: 7.5px;">PL: Over Plated</td>
		</tr>
		<tr>
			<td width="17%" style="font-size: 7.5px;">D4: Dented 20-25mm</td>
			<td width="17%" style="font-size: 7.5px;">BU: Burned</td>
			<td width="17%" style="font-size: 7.5px;">EP: Existing Patch</td>
			<td width="17%" style="font-size: 7.5px;">GR: Ground</td>
			<td width="16%" style="font-size: 7.5px;">HM: Hammer Marks</td>
			<td width="16%" style="font-size: 7.5px;">&nbsp;</td>
		</tr>
		<tr>
			<td width="17%" style="font-size: 7.5px;">D5: Dented 25-40mm</td>
			<td width="17%" style="font-size: 7.5px;">CM: Customer Marks</td>
			<td width="17%" style="font-size: 7.5px;">ER: Existing Repair</td>
			<td width="17%" style="font-size: 7.5px;">HO: Holed</td>
			<td width="16%" style="font-size: 7.5px;">IR: Improper Repair</td>
			<td width="16%" style="font-size: 7.5px;">&nbsp;</td>
		</tr>
		<tr>
			<td width="17%" style="font-size: 7.5px;">D6: Dented >40mm</td>
			<td width="17%" style="font-size: 7.5px;">CO: Corrosion</td>
			<td width="17%" style="font-size: 7.5px;">ES: Existing Section</td>
			<td width="17%" style="font-size: 7.5px;">RS: Re-Secured</td>
			<td width="16%" style="font-size: 7.5px;">LO: Loose</td>
			<td width="16%" style="font-size: 7.5px;">&nbsp;</td>
		</tr>
	</table>
	<p>
	<table border="0" cellspacing="2" cellpadding="2" width="100%" style="border: 1px solid #000000">
		<tr>
			<td>
				<b>Comments:</b>&nbsp;{{ $onhire["comment_1"] }}
			</td>
		</tr>
	</table>

	<br pagebreak="true"/>
	<table border="0" cellspacing="2" cellpadding="5" width="100%" style="border: 1px solid #000000">
		<tr>
			<td width="40%">
				<b>Tank Number:</b>&nbsp;{{ $onhire["unit_nr"] }}
			</td>
			<td width="20%">
				<b>Date:</b>&nbsp;{{ date("Y-m-d", strtotime($onhire["inspection_date"])) }}
			</td>
			<td width="40%">
				<b>Location:</b>&nbsp;{{ $onhire["inspection_location"]["name"] }}
			</td>
		</tr>
	</table>
	@if( $walkway_image_2 != null && strlen($walkway_image_2) > 0 )
		<table border="0" cellspacing="5" cellpadding="2" width="100%">
			<tr>
				<td width="100%"><b>Tank Container Mapping Chart for LIQUID tanks</b></td>
			</tr>
			<tr>
				<td width="100%"><img src="{{ $walkway_image_2 }}" style="max-width: 100%;"></td>
			</tr>
		</table>
	@endif 
	<table border="0" cellspacing="2" cellpadding="5" width="100%" style="border: 1px solid #000000">
		<tr>
			<td>
				<b>Remarks:</b>&nbsp;{{ $onhire["comment_2"] }}
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<!-- <table border="0" cellspacing="2" cellpadding="5" width="100%">
		<tr>
			<td>
				<b>Remarks:</b>&nbsp;{{ $onhire["comment_2"] }}
			</td>
		</tr>
	</table> -->
	<table width="100%" cellspacing="0" cellpadding="2" border="0">
		<tr>
			<td width="85%" style="font-size: 9px;">
				<p>Certificate issued without any prejudice.</p>
				<p><b>NAME OF INSPECTOR</b></p>
				<p>{{ $onhire["surveyor"]["name"] }}</p>
			</td>
			<td width="15%" style="text-align: center;"><img src="{{ $sign }}"></td>
		</tr>
	</table>
</body>

</html>