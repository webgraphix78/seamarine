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
				<h3 style="text-align: center;margin: 0;padding: 0;">Gas Free report of T-50 Tank</h3>
			</td>
		</tr>
	</table>
	<table cellspacing="5" cellpadding="0">
		<tr><td>&nbsp;</td></tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="5" border="1"  style="margin: 0 auto;">
		<tr>
			<td width="16%">
				<p style="margin:0px;">Tank No:</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['tank_no']}}</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">Type:</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['type']}}</p>
			</td>
			<td width="16%">
				<p style="margin:0px;">Ref:</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['ref_no']}}</p>
			</td>
		</tr>
		<tr>
			<td width="16%">
				<p style="margin:0px;">CSC No:</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['csc_no']}}</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">Mfg.:</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['mfg']}}</p>
			</td>
			<td width="16%">
				<p style="margin:0px;">NED:</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['ned']}}</p>
			</td>
		</tr>
		<tr>
			<td width="16%">
				<p style="margin:0px;">MGW::</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['mgw']}}</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">Tare Wt:</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['tare_wt']}}</p>
			</td>
			<td width="16%">
				<p style="margin:0px;">Capacity:</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['capacity']}}</p>
			</td>
		</tr>
		<tr>
			<td width="16%">
				<p style="margin:0px;">Inspection Date:</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['inspection_date']}}</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">Inspection Location:</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['rel_inspection_location_id']['name']}}</p>
			</td>
			<td width="16%">
				<p style="margin:0px;">Customer:</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['rel_customer_id']['name']}}</p>
			</td>
		</tr>
		<tr>
			<td width="16%">
				<p style="margin:0px;">Last Cargo Carried::</p>
			</td>
			<td width="17%">
				<p style="margin:0px;">{{$gasfreereport['last_cargo_carried']}}</p>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="5" cellpadding="0">
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td width="50%">
				<h3 style="text-align: start;">LEL Inst Make: {{$gasfreereport['lel_inst'] ?? 'N/A'}}</h3>
			</td>
			<td width="50%">
				<h3 style="text-align: start;">Sr No: {{$gasfreereport['lel_sr_no'] ?? 'N/A'}}</h3>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td width="50%">
				<h3 style="text-align: start;">Calibration Validity Dt: {{$gasfreereport['calibration_validity_dt'] ?? 'N/A'}}</h3>
			</td>
			<td width="50%">
				<h3 style="text-align: start;">Sr No: {{$gasfreereport['calibration_sr_no'] ?? 'N/A'}}</h3>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td width="50%">
				<h3 style="text-align: start;">Oxygen Mtr Make: {{$gasfreereport['oxygen_mtr'] ?? 'N/A'}}</h3>
			</td>
			<td width="50%">
				<h3 style="text-align: start;">Calibration Validity Dt: {{$gasfreereport['oxy_calibration_validity'] ?? 'N/A'}}</h3>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="5" cellpadding="0">
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td width="100%">
				<h3 style="text-align: start;">Function test performed in air before actual space measurement and registered readings:</h3>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<h3 style="text-align: start;">LEL: {{$gasfreereport['in_air_lel'] ?? 'N/A'}}</h3>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<h3 style="text-align: start;">Oxygen: {{$gasfreereport['in_air_oxygen'] ?? 'N/A'}}</h3>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="5" cellpadding="0">
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td width="100%">
				<h3 style="text-align: start;">Test Performed in actual space and registered readings:</h3>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<h3 style="text-align: start;">LEL: {{$gasfreereport['in_space_lel'] ?? 'N/A'}}</h3>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<h3 style="text-align: start;">Oxygen: {{$gasfreereport['in_space_oxygen'] ?? 'N/A'}}</h3>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="5" cellpadding="0">
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td width="100%">
				<h3 style="text-align: start;">Instrument did react to hydrocarbon vapour.</h3>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<h3 style="text-align: start;">{{$gasfreereport['reacted_to_hydrocarbon'] ?? 'N/A'}}</h3>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<h3 style="text-align: start;">Yes & alarmed at {{$gasfreereport['alarmed_at'] ?? 'N/A'}}</h3>
			</td>
		</tr>
	</table>
	<table  width="100%" cellspacing="5" cellpadding="0">
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td width="100%">
				<h3 style="font-weight: 400;">
					<strong>Remarks:</strong> A Thorough Visual Examination of tank exterior carried out, Valves & fitting are free of odour. Tank is found to be free from any kind of explosive or poisonous gas.<br>
					This certificate is to be used in conjunction with safety permit for shipping purposes.
				</h3>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="5" cellpadding="0">
		<tr>
			<td width="100%">
				<h3 style="text-align: start;">WE CERTIFY THAT THIS TANK IS GAS FREE: {{$gasfreereport['tank_is_gas_free'] ?? 'N/A'}}</h3>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td width="100%">
				<h3 style="text-align: start;">THIS CERTIFICATE DOES NOT AUTHORISE WORK TO BE CARRIED OUT OR ENTRY MADE. SEPARATE PERMITS MUST BE ISSUED FOR THIS PURPOSE.</h3>
			</td>
		</tr>
	</table>
	<table><tr><td>&nbsp;</td></tr></table>
	<table width="100%" cellspacing="0" cellpadding="2" border="0">
		<tr valign="middle">
			<td width="75%" valign="middle" style="text-align: left; margin: auto;">
				<table width="100%">
					<tr>
						<td>
							<h3>
								Surveyor Name: {{ $gasfreereport['rel_surveyor_id']['name'] ?? 'N/A' }}
							</h3>
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td><h3>Issued Without Any Prejudice</h3></td>
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
