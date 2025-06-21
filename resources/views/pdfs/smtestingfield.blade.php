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
			<td width="80%" style="margin: auto;">
				<h2 style="margin: 0;padding: 0;">Tank Container SM Testing Field Copy</h2>
			</td>
			<td width="20%"> Date: {{$smtestingfield['inspection_date']}}</td>
		</tr>
	</table>
	<table cellspacing="5" cellpadding="0">
		<tr>
			<td width="100%" style="margin: auto;">
				<p>This certifies that the undernoted tank container has been reinspected in accordance with the regulations indicated.</p>
				<p>Note: This inspection is performed subject to Seamarine Standard Terms and Conditions.</p>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
	</table>
	
	<table  width="100%" cellspacing="0" cellpadding="5" border="1">
		<tr>
			<td>Place of inspection: {{$smtestingfield['rel_inspection_location_id']['name']}}</td>
			<td rowspan="2"><h2 style="margin:0;font-weight:bold;">Owner's Serial Number: <br> {{ $smtestingfield['tank_no'] }}</h2></td>
		</tr>
		<tr>
			<td>Operator/Lessor: {{ $smtestingfield['operator_lessor'] }}</td>
		</tr>
		<tr>
			<td>Manufacturer: {{ $smtestingfield['mfg'] }}</td>
			<td>Manufacturer No: {{ $smtestingfield['mfg_sr_no'] }}</td>
		</tr>
	</table>
	<table cellspacing="5" cellpadding="0">
		<tr><td>&nbsp;</td></tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="2" border="0">
		<tr><td style="text-decoration:underline;"><b>Applicable Regulations. Enter initial approval No. as applicable</b></td></tr>
		<tr>
			<td width="4%" style="border:1px solid #000;"></td>
			<td width="48%">CSC: {{ $smtestingfield['csc'] }}</td>
			<td width="48%">UK-DOT: {{ $smtestingfield['uk_dot'] }}</td>
		</tr>
		<tr>
			<td width="4%"></td>
			<td width="48%">IMDG: {{ $smtestingfield['imdg'] }}</td>
			<td width="48%">US-DOT: {{ $smtestingfield['us_dot'] }}</td>
		</tr>
		<tr>
			<td width="4%"></td>
			<td width="48%">RID/ADR: {{ $smtestingfield['rid'] }}</td>
			<td width="48%">AAR 600: {{ $smtestingfield['aar'] }}</td>
		</tr>
		<tr>
			<td width="4%"></td>
			<td width="48%">BAM: {{ $smtestingfield['bam'] }}</td>
			<td width="48%">TC Impact: {{ $smtestingfield['tc_impact'] }}</td>
		</tr>
		<tr>
			<td width="4%" style="border:1px solid #000;"></td>
			<td width="48%">TIR: {{ $smtestingfield['tir'] }}</td>
			<td width="24%">UIC: {{ $smtestingfield['uic'] }}</td>
			<td width="24%">FRA: {{ $smtestingfield['fra'] }}</td>
		</tr>
	</table>
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="50%">
				<table border="1" cellspacing="0" cellpadding="2" style="border-collapse: collapse;">
					<tr>
						<td width="100%" align="start"><b>Tank Information</b></td>
					</tr>
					<tr >
						<td width="50%" style="border: none;">Year of Manufacture:</td>
						<td width="50%" align="right" style="border: none;">{{ $smtestingfield['tank_mfg_year'] }}</td>
					</tr>
					<tr>
						<td width="50%">Max Gross Weight (Kg):</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_max_g_wt'] }}</td>
					</tr>
					<tr>
						<td width="50%">Tare Weight (Kg):</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_tare_wt'] }}</td>
					</tr>
					<tr>
						<td width="50%">Capacity (L):</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_capacity'] }}</td>
					</tr>
					<tr>
						<td width="50%">Design Temp (C):</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_desgin_temp'] }}</td>
					</tr>
					<tr>
						<td width="50%">M.A.W.P. (Bar):</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_mawp_bar'] }}</td>
					</tr>
					<tr>
						<td width="50%">Test Pressure (Bar):</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_test_press_bar'] }}</td>
					</tr>
					<tr>
						<td width="50%">Top Discharge (Bar):</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_top_discharge'] }}</td>
					</tr>
					<tr>
						<td width="50%">Bottom Discharge (Bar):</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_bottom_discharge'] }}</td>
					</tr>
					<tr>
						<td width="50%">No. of closures in series:</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_no_of_closure'] }}</td>
					</tr>
					<tr>
						<td width="50%">Shell Material:</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_shell_material'] }}</td>
					</tr>
					<tr>
						<td width="50%">Shell Thickness (mm):</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_shell_thickness'] }}</td>
					</tr>
					<tr>
						<td width="50%">Heads Material:</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_heads_material'] }}</td>
					</tr>
					<tr>
						<td width="50%">Heads Thickness (mm):</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_head_thickness'] }}</td>
					</tr>
					<tr>
						<td width="50%">ISO Type:</td>
						<td width="50%" align="right">{{ $smtestingfield['tank_iso_type'] }}</td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table border="1" cellspacing="0" cellpadding="2" style="border-collapse: collapse;">
					<tr>
						<td width="100%" align="start"><b>Inspection Dates (mm/yy)</b></td>
					</tr>
					<tr >
						<td width="50%">Initial Hydro Test:{{ $smtestingfield['insp_init_hydro_date'] }} </td>
						<td width="50%">Witness:{{ $smtestingfield['insp_hydro_witness'] }} </td>
					</tr>
					<tr >
						<td width="50%">Initial Hydro Test:{{ $smtestingfield['insp_last_hydro_date'] }} </td>
						<td width="50%">Witness:{{ $smtestingfield['insp_last_hydro_witness'] }} </td>
					</tr>
					<tr>
						<td width="100%">This inspection date: {{ $smtestingfield['insp_date'] }}</td>
					</tr>
					<tr>
						<td width="100%">Next CSC Due: {{ $smtestingfield['next_insp_date'] }}</td>
					</tr>
				</table>
				<table cellspacing="5" cellpadding="0">
					<tr><td>&nbsp;</td></tr>
				</table>
				<table border="1" cellspacing="0" cellpadding="2" style="border-collapse: collapse;">
					<tr>
						<td width="40%" align="center"><b>Inspections Performed</b></td>
						<td width="10%" align="center"><b>N/A</b></td>
						<td width="25%" align="center"><b>In Order</b></td>
						<td width="25%" align="center"><b>See Comments</b></td>
					</tr>
					<tr >
						<td width="40%">Internal Inspection</td>
						<td width="10%" align="center">{{ $smtestingfield['insp_inter_perfom_na'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_inter_perfom_in'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_inter_perfom_remark'] }} </td>
					</tr>
					<tr >
						<td width="40%">External Inspection</td>
						<td width="10%" align="center">{{ $smtestingfield['insp_ext_perfom_na'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_ext_perfom_in'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_ext_perfom_remark'] }} </td>
					</tr>
					<tr >
						<td width="40%">Date</td>
						<td width="10%" align="center">{{ $smtestingfield['insp_perfom_date_na'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_date_in'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_date_remark'] }} </td>
					</tr>
					<tr >
						<td width="40%">Pressure (Bar)</td>
						<td width="10%" align="center">{{ $smtestingfield['insp_perfom_pressure_bar_na'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_pressure_bar_in'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_pressure_bar_remark'] }} </td>
					</tr>
					<tr >
						<td width="40%">Fittings Inspection</td>
						<td width="10%" align="center">{{ $smtestingfield['insp_perfom_fittin_na'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_fittin_in'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_fittin_remark'] }} </td>
					</tr>
					<tr >
						<td width="40%">Frame Inspection</td>
						<td width="10%" align="center">{{ $smtestingfield['insp_perfom_frame_na'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_frame_in'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_frame_remark'] }} </td>
					</tr>
					<tr >
						<td width="40%">Decals Inspection</td>
						<td width="10%" align="center">{{ $smtestingfield['insp_perfom_decals_na'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_decals_in'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_decals_remark'] }} </td>
					</tr>
					<tr >
						<td width="40%">Steam Coils Test Pressure (Bar)</td>
						<td width="10%" align="center">{{ $smtestingfield['insp_perfom_steam_na'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_steam_in'] }} </td>
						<td width="25%" align="center">{{ $smtestingfield['insp_perfom_steam_remark'] }} </td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table cellspacing="0" cellpadding="0">
		<tr><td>&nbsp;</td></tr>
	</table>
	<table border="0" cellspacing="5" cellpadding="2">
		<tr>
			<td width="50%">
				<table border="1" cellspacing="0" cellpadding="2" style="border-collapse: collapse;">
					<tr>
						<td width="40%" align="center"><b>Pressure Relief Valves</b></td>
						<td width="30%" align="center"><b>1st</b></td>
						<td width="30%" align="center"><b>2nd</b></td>
					</tr>
					<tr>
						<td width="40%" align="center">Manufacturer/Type:</td>
						<td width="30%" align="center">{{ $smtestingfield['p_mfgr_type_1'] }}</td>
						<td width="30%" align="center">{{ $smtestingfield['p_mfgr_type_2'] }}</td>
					</tr>
					<tr>
						<td width="40%" align="center">Serial Number:</td>
						<td width="30%" align="center">{{ $smtestingfield['p_sr_no_1'] }}</td>
						<td width="30%" align="center">{{ $smtestingfield['p_sr_no_2'] }}</td>
					</tr>
					<tr>
						<td width="40%" align="center">Full Flow Rate (CMHR):</td>
						<td width="30%" align="center">{{ $smtestingfield['p_full_flow_rate_1'] }}</td>
						<td width="30%" align="center">{{ $smtestingfield['p_full_flow_rate_2'] }}</td>
					</tr>
					<tr>
						<td width="40%" align="center">Operating Pressure (Bar):</td>
						<td width="30%" align="center">{{ $smtestingfield['p_operating_press_1'] }}</td>
						<td width="30%" align="center">{{ $smtestingfield['p_operating_press_2'] }}</td>
					</tr>
					<tr>
						<td width="40%" align="center">Vacuum Setting (Hg):</td>
						<td width="30%" align="center">{{ $smtestingfield['p_vacuum_setting_1'] }}</td>
						<td width="30%" align="center">{{ $smtestingfield['p_vacuum_setting_2'] }}</td>
					</tr>
					<tr>
						<td width="40%" align="center">Bursting Disc (Bar):</td>
						<td width="30%" align="center">{{ $smtestingfield['p_bursting_disc_1'] }}</td>
						<td width="30%" align="center">{{ $smtestingfield['p_bursting_disc_2'] }}</td>
					</tr>
				</table>
				<table cellspacing="5" cellpadding="0">
					<tr><td>&nbsp;</td></tr>
				</table>
				<table border="1" cellspacing="0" cellpadding="2" style="border-collapse: collapse;">
					<tr>
						<td width="100%">Surveyors Name:</td>
					</tr>
					<tr>
						<td width="100%" >{{ $smtestingfield['rel_surveyor_id']['name'] }}</td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse;" height="100%">
					<tr>
						<td width="100%">Comments: <br> {{ $smtestingfield['comments'] }}</td>
					</tr>
					<tr>
						<td width="100%">
							Plate Marking/Stamping: {{ $smtestingfield['platemark'] }}
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>