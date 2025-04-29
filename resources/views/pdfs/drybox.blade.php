<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $drybox['container_no'] }}</title>
</head>
<body>
	<br/>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="17%">&nbsp;</td>
			<td width="66%" style="border: 1px solid #000">
				<h3 style="text-align: center;margin: 0;padding: 0;">SURVEY REPORT OF CONTAINER CONDITION</h3>
			</td>
			<td width="17%">&nbsp;</td>
		</tr>
	</table>
	<br/><br/>
	<table width="100%" border="0" cellspacing="2" cellpadding="0">
		<tr>
			<td width="15%" style="font-weight: bold;">Reference No. </td>
			<td width="45%">{{ $drybox['ref'] }}</td>
			<td width="10%" style="font-weight: bold;">DATE: </td>
			<td width="30%">{{ date("d-m-Y", strtotime($drybox['created_at'])) }}</td>
		</tr>
	</table>
	<br/><br/>
	<table width="100%" border="0" cellspacing="2" cellpadding="0">
		<tr>
			<td>
				<p style="text-align: center;margin: 0;padding: 0;">THE INSPECTION HAS BEEN CARRIED OUT AT THE REQUEST OF</p>
			</td>
		</tr>
		<tr>
			<td style="font-weight: bold;">
				<p style="text-align: center;margin: 0;padding: 0;">M/s. {{ $drybox['customer']['name'] }}</p>
			</td>
		</tr>
	</table>
	<p>
	<table width="100%" border="1" cellspacing="0" cellpadding="2">
		<tr>
			<td colspan="6" style="font-size: 9px; font-weight: bold;">USE SYMBOL AT EXACT LOCATION ON DIAGRAMES BELOW:</td>
		</tr>
		<tr nobr="true">
			<td style="font-size: 8px;">B. BRUISE(FRP)</td>
			<td style="font-size: 8px;">C. CUT</td>
			<td style="font-size: 8px;">D. DENT</td>
			<td style="font-size: 8px;">H. HOLE</td>
			<td style="font-size: 8px;">K. CRACKED</td>
			<td style="font-size: 8px;">L. LABEL</td>
		</tr>
		<tr nobr="true">
			<td style="font-size: 8px;">M. MISSING</td>
			<td style="font-size: 8px;">O. OIL STAIN-DEBRIS</td>
			<td style="font-size: 8px;">R. RUST</td>
			<td style="font-size: 8px;">S. DISTORTED</td>
			<td colspan="2" style="font-size: 8px;">IR IMPROPER REPAIR</td>
		</tr>
	</table>
	<p>
	<img src="{{ $container }}">
	<p>
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td width="25%" style="font-size: 8px;">PLACE OF INSPECTION.</td>
			<td width="30%" style="font-size: 8px;text-decoration: underline;">{{ $drybox['inspectionlocation']['name'] }}</td>
			<td width="20%" style="font-size: 8px;">TARE WEIGHT</td>
			<td width="25%" style="font-size: 8px;text-decoration: underline;">{{ $drybox['tare_wt'] }} KGS</td>
		</tr>
		<tr>
			<td width="25%" style="font-size: 8px;">DATE OF INSPECTION</td>
			<td width="30%" style="font-size: 8px;">{{ date('d-m-Y', strtotime($drybox['inspection_date'])) }}</td>
			<td width="20%" style="font-size: 8px;">GROSS WEIGHT</td>
			<td width="25%" style="font-size: 8px;">{{ $drybox['gross_wt'] }} KGS</td>
		</tr>
		<tr>
			<td width="25%" style="font-size: 8px;">CONTAINER NO</td>
			<td width="30%" style="font-size: 8px;">{{ $drybox['container_no'] }}</td>
			<td width="20%" style="font-size: 8px;">CSC NO</td>
			<td width="25%" style="font-size: 8px;">{{ $drybox['csc_no'] }}</td>
		</tr>
		<tr>
			<td width="25%" style="font-size: 8px;">SIZE</td>
			<td width="30%" style="font-size: 8px;">{{ $drybox['size'] }} FT</td>
			<td width="20%" style="font-size: 8px;">DATE OF MFG</td>
			<td width="25%" style="font-size: 8px;">{{ $drybox['mfgt_date'] }}</td>
		</tr>
		<tr>
			<td width="25%" style="font-size: 8px;">SURVEYOR</td>
			<td width="30%" style="font-size: 8px;">{{ $drybox['surveyor']['name'] }}</td>
			<td width="20%" style="font-size: 8px;">STATUS</td>
			<td width="25%" style="font-size: 8px;">{{ ($drybox['drybox_status'] == 0 ? "EMPTY":"LOADED") }}</td>
		</tr>
	</table>
	<p>
	<table width="100%" cellspacing="0" cellpadding="2" border="0">
		<tr>
			<td colspan="3"><span style="font-weight: bold; text-decoration: underline;">REMARKS</span></td>
		</tr>
		<tr>
			<td width="25%">REAR END</td>
			<td width="25%" style="font-size: 9px;">{{ $drybox['rear_end'] }}</td>
			<td width="50%" rowspan="8" style="text-align: center;">
				<p>FOR {{ $drybox['company']['name'] }}</p>
				<table width="100%" cellspacing="0" cellpadding="2" border="0">
					<tr>
						<td width="70%">&nbsp;</td>
						<td width="30%"><img src="{{ $sign }}"></td>
					</tr>
					
				</table>
			</td>
		</tr>
		<tr>
			<td width="25%">RIGHT SIDE</td>
			<td width="75%" style="font-size: 9px;">{{ $drybox['right_side'] }}</td>
		</tr>
		<tr>
			<td width="25%">FRONT END</td>
			<td width="75%" style="font-size: 9px;">{{ $drybox['front_end'] }}</td>
		</tr>
		<tr>
			<td width="25%">LEFT SIDE</td>
			<td width="75%" style="font-size: 9px;">{{ $drybox['left_side'] }}</td>
		</tr>
		<tr>
			<td width="25%">TOP ROOF</td>
			<td width="75%" style="font-size: 9px;">{{ $drybox['top_roof'] }}</td>
		</tr>
		<tr>
			<td width="25%">UNDER STRUCTURE</td>
			<td width="75%" style="font-size: 9px;">{{ $drybox['under_structure'] }}</td>
		</tr>
		<tr>
			<td width="25%">INTERIOR</td>
			<td width="75%" style="font-size: 9px;">{{ $drybox['interior'] }}</td>
		</tr>
		<tr>
			<td width="25%">NOTE</td>
			<td width="75%" style="font-size: 9px;">{{ $drybox['note'] }}</td>
		</tr>
	</table>
</body>
</html>