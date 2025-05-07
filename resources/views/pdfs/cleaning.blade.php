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
			<td>
				<h3 style="text-align: center;margin: 0;padding: 0;">CLEANLINESS CERTIFICATE</h3>
			</td>
		</tr>
		<tr>
			<td>
				<h3 style="text-align: center;margin: 0;padding: 0;">TANK CONTAINER CLEANLINESS SURVEY REPORT</h3>
			</td>
		</tr>
	</table>
	<p>
	<table width="100%" border="0" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr>
			<td width="20%">Tank Container No:</td>
			<td width="24%" style="font-weight:bold;">{{ $cleaning['tank_no'] }}</td>
			<td width="10%">Type:</td>
			<td width="18%" style="font-weight:bold;">{{ $cleaning['tank']['type'] }}</td>
			<td width="10%">Ref:</td>
			<td width="18%" style="font-weight:bold;">{{ $cleaning['ref_no'] }}</td>
		</tr>
		<tr>
			<td width="20%">C.S.C:</td>
			<td width="24%" style="font-weight:bold;">{{ $cleaning['csc'] }}</td>
			<td width="10%">Mfg:</td>
			<td width="18%" style="font-weight:bold;">{{ $cleaning['mfgt_date'] }}</td>
			<td width="10%">NED:</td>
			<td width="18%" style="font-weight:bold;">{{ $cleaning['next_date'] }}</td>
		</tr>
		<tr>
			<td width="20%">MGW:</td>
			<td width="24%" style="font-weight:bold;">{{ $cleaning['mgw'] }} KGS</td>
			<td width="10%">Tare Wt.:</td>
			<td width="18%" style="font-weight:bold;">{{ $cleaning['tare_wt'] }} KGS</td>
			<td width="10%">Capacity:</td>
			<td width="18%" style="font-weight:bold;">{{ $cleaning['capacity'] }} LTRS</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr>
			<td width="20%">Inspection Date:</td>
			<td width="24%" style="font-weight:bold;">{{ ($cleaning['dt_inspection_date'] == null ? "Not Specified" : $cleaning['dt_inspection_date']) }}</td>
			<td width="20%">Inspection Location:</td>
			<td width="36%" style="font-weight:bold;">{{ $cleaning['inspectionlocation']['name'] }}</td>
		</tr>
		<tr>
			<td width="20%">Cleaning Co. M/s:</td>
			<td width="80%" style="font-weight:bold;">{{ $cleaning['customer']['name'] }}</td>
			<!-- <td width="20%">for M/s.:</td>
			<td width="36%" style="font-weight:bold;">{{ $cleaning['client']['name'] }}</td> -->
		</tr>
		<tr>
			<td width="20%">T-Code:</td>
			<td width="80%" colspan="2" style="font-weight:bold;">{{ $cleaning['tcode']['name'] }}</td>
		</tr>
		<tr>
			<td width="20%">Last Cargo Carried:<br/>(AS GIVEN)</td>
			<td width="80%" colspan="2" style="font-weight:bold;">{{ $cleaning['last_cargo_carried'] }}</td>
		</tr>
	</table>
	<p>
	<table cellpadding="3" cellspacing="0" width="100%">
		<tr>
			<td colspan="4" width="100%" style="text-align: center; background-color: #e4e4e4;">
				<h4>EXTERIOR</h4>
			</td>
		</tr>
		<tr>
			<td width="70%">Frame, Tank and walkways free of contamination and cargo</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['frame_tank'] == 1 ) ? "YES" : (( $cleaning['frame_tank'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">Manlid and valve compartments free of contamination and cargo</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['manlid_valves'] == 1 ) ? "YES" : (( $cleaning['manlid_valves'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">Serial numbers and statutory marking legible</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['serial_nos'] == 1 ) ? "YES" : (( $cleaning['serial_nos'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">Cargo labels removed</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['labels_removed'] == 1 ) ? "YES" : (( $cleaning['labels_removed'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4" width="100%" style="text-align: center; background-color: #e4e4e4;">
				<h4>INTERIOR</h4>
			</td>
		</tr>
		<tr>
			<td width="70%">Entry made into tank by surveyor</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['entry'] == 1 ) ? "YES" : (( $cleaning['entry'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">Free from odour</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['odour_free'] == 1 ) ? "YES" : (( $cleaning['odour_free'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">Clean and free from last cargo</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['clean_free'] == 1 ) ? "YES" : (( $cleaning['clean_free'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">Free from corrosion</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['corrosion_free'] == 1 ) ? "YES" : (( $cleaning['corrosion_free'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">Dry</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['dry'] == 1 ) ? "YES" : (( $cleaning['dry'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="50%" colspan="2">&nbsp;</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4" width="100%" style="text-align: center; background-color: #e4e4e4;">
				<h4>VALVES/FITTINGS FREE FROM PREVIOUS CARGO</h4>
			</td>
		</tr>
		<tr>
			<td width="70%">Valves</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['valves'] == 1 ) ? "YES" : (( $cleaning['valves'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">Manlid Seal</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['manlid_seal'] == 1 ) ? "YES" : (( $cleaning['manlid_seal'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">Gas free entry permit issue</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['gas_free'] == 1 ) ? "YES" : (( $cleaning['gas_free'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%">Siphon Tube</td>
			<td width="10%" style="border: 1px solid #000000; text-align: center;">{{ ( $cleaning['siphon'] == 1 ) ? "YES" : (( $cleaning['siphon'] == -1 ) ? "NO" : "NA") }}</td>
			<td width="20%">&nbsp;</td>
		</tr>
	</table>
	<br/>
	<table width="100%" cellspacing="0" cellpadding="3" border="0">
		<tr>
			<td width="25%">EXTERIOR/COMMENTS</td>
			<td width="75%">{{ $cleaning['exterior'] }}</td>
		</tr>
		<tr>
			<td width="25%">INTERIOR</td>
			<td width="75%">{{ $cleaning['interior'] }}</td>
		</tr>
		<tr>
			<td width="25%">REMARKS</td>
			<td width="75%">{{ $cleaning['remarks'] }}</td>
		</tr>
		<tr>
			<td width="25%">SEAL NO</td>
			<td width="75%">{{ $cleaning['sealno'] }}</td>
		</tr>
	</table>
	<p></p>
	<table width="100%" cellspacing="0" cellpadding="5" border="1">
		<tr>
			<td width="85%" style="font-size: 7.5px;">
THIS REPORT IS BASED SOLELY UPON A VISUAL EXAMINATION OF DOCUMENTS PROVIDED BY OTHERS. THE SURVEYOR ACCEPTS NO LIABILITY FOR ANY CONDITIONS THAT ARE NOT APPARENT DURING A NORMAL VISUAL INSPECTION OR THAT MAY BE RESULT OF INACCURATE INFORMATION PROVIDED IN DOCUMENTS UPON WHICH THE SURVEYOR MUST RELY.WE ARE NOT TO BE HELD RESPONSIBLE FOR ANY CONDENSATION AND RESURGENT ODOURS OCCURRING BETWEEN THE INSPECTION AND THE LOADING OPERATIONS WHICH MAY OCCUR DUE TO TEMPERATURE VARIATION.SUBJECT ONLY TO CLEANLINESS OF THE TANK, INTERIOR,VALVES & FITTINGS. 
<br/><br/>Issued without any prejudice.
			</td>
			<td width="15%" style="text-align: center;" rowspan="2">
				<img src="{{ $sign }}">
			</td>
		</tr>
		<tr>
			<td width="85%">
				SURVEYOR: 
				{{ $cleaning['surveyor']['name'] }}
			</td>
		</tr>
	</table>
</body>
</html>
