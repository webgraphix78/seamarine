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
			<td width="100%" style="margin: auto;">
				<h3 style="text-align: center;margin: 0;padding: 0;">Loading of {{ $dmcc['loading_of']}}</h3>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="5" cellpadding="0">
		<tr>
			<td width="50%">
				<h3 style="text-align: start;">Date of Loading: {{$dmcc['inspection_date']}}</h3>
			</td>
			<td width="50%">
				<h3 style="text-align: right;">Tank No: {{$dmcc['tank_no']}}</h3>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="5" border="1"  style="margin: 0 auto;">
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">Sr.No.</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Activity</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">Time</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">Remarks</p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">1</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Tank under Nitrogen pressure and all Seals intact</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['seals_intact_time']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;">{{$dmcc['seals_intact_remark'] }}</p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">2</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">All Seals broken</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['seals_broken']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">3</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Pre‐trip inspection by Quality officer carried out</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['pretrip_inspection_qc']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">4</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Bottom discharge valve operated and checked for any leakage of Nitrogen by QC.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['bottom_valve_checked']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">5</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Nitrogen from Container released by opening DN40 Airline Valve by QC.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['n2_released_dn40']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">6</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Operation of Emergency Remote cable checked by QC.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['emergency_remote_checked']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">7</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Manlid opened and Tank checked for any moisture or smell by QC.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['manlid_checked']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">8</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Manlid and Bottom discharge valve closed by QC.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['manlid_valve_closed']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">9</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Tank cleared for Nitrogen purging.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['tank_cleared_for_purging']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">10</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Blind Flange of DN80 Butterfly Top Valve removed and special connector fitted.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['dn80_connector_fitted']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">11</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">N2 purged up to 0.5 bar pressure through DN40 Airline Valve. ( 1st Time)</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['n2_purged_1']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">N2 Cylinder</p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">12</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">N2 pressure released from DN 40 Airline Valve. (1st Time)</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['n2_released_1']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">13</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">N2 purged up to 0.5 bar pressure through DN40 Airline Valve. ( 2nd Time)</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['n2_purged_2']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">N2 Cylinder</p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">14</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">N2 pressure released from DN 40 Airline Valve. (2ndTime)</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['n2_released_2']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">15</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">N2 purged up to 0.5 bar pressure through DN40 Airline Valve. (3rd Time)</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['n2_purged_3']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">N2 Cylinder</p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">16</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">N2 pressure released from DN 40 Airline Valve. (3rdTime)</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['n2_released_3']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">17</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Permission of QC Manager for starting loading BSCL accorded.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['qc_permission_granted']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">18</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Pumping of BSCL started & filling commenced through Special Connector.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['bscl_pumping_started']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">19</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">DN40 Airline Valve opened soon after commencing of loading to avoid building of undue pressure in Tank</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['dn40_opened_during_loading']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">20</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Loading completed, pump stopped and DN 40 Airline Valve closed.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['loading_completed_dn40_closed']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">21</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Butterfly Valve Closed & Special Connector removed from DN80 Butterfly Top Discharge Valve.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['butterfly_valve_closed']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">22</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">BSCL cargo sample removed through Blind Flange opening.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['cargo_sample_removed']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">23</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">Butterfly Valve of DN 80 Top Valve closed and Blind Flange fitted back.</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['butterfly_valve_reclosed']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">24</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">On completion of Cargo stuffing, N2 purged through DN40 Airline Valve in Tank: Nitrogen blanket pressure (0.5 bar).</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['n2_purged_final']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align:center;">N2 Cylinder</p>
			</td>
		</tr>
		<tr>
			<td width="10%">
				<p style="margin:0px;text-align: center;">25</p>
			</td>
			<td width="70%">
				<p style="margin:0px;">N2 pressure released from DN 40 Airline Valve. (3rdTime)</p>
			</td>
			<td width="10%">
				<p style="margin:0px;text-align: center;">{{$dmcc['final_inspection_done']}}</p>
			</td>
			<td width="10%">
				<p style="margin:0px;"></p>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="2" border="0">
		<tr><td>&nbsp;</td></tr>
		<tr valign="bottom">
			<td width="70%" valign="middle" style="text-align: left; margin: auto;">
				<table width="100%">
					<tr>
						<td width="100%" valign="middle" style="margin: auto;">
							<p>Remark: N2 Cylinder Nos: {{ $dmcc['n2_cylinder_nos']}}</p>
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td width="100%" valign="middle" style="margin: auto;">
							<p>Total No. of N2 Cylinder consumed: {{ $dmcc['total_no_cylinder']}} Cylinders.</p>
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td width="100%" valign="middle" style="margin: auto;">
							<p>M/S BSCL REp: {{ $dmcc['bscl_rep']}} Cylinders.</p>
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
							<h3>
								Surveyor Name: {{ $dmcc['rel_surveyor_id']['name'] }}
							</h3>
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td><h3>Certificate Issued Without Any Prejudice</h3></td>
					</tr>
				</table>
			</td>
			<td width="30%" style="text-align: center;" valign="bottom" rowspan="2">
				<img src="{{ $sign }}" alt="Signature" width="60px"/>
			</td>
		</tr>
	</table>
</body>
</html>