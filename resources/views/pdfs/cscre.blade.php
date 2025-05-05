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
			<td width="25%"></td>
			<td width="50%" style="margin: auto;">
				<h3 style="text-align: center;margin: 0;padding: 0;">CSC Inspection	</h3>
			</td>
			<td width="25%">
				<h3 style="text-align: center;margin: 0;padding: 0;">Reference No {{$cscre['ref_no']}}</h3>
			</td>
		</tr>
	</table>
	<table cellspacing="5" cellpadding="0">
		<tr>
			<td width="25%"></td>
			<td width="50%" style="margin: auto;"></td>
			<td width="25%">
				<h3 style="text-align: center;margin: 0;padding: 0;">Date: {{$cscre['created_at']}}</h3>
			</td>
		</tr>
	</table>
	<p></p>
	<table>
		<tr>
			<td width="100%">
				This cerificate is issued to Seamarine to certify that Seamarine Surveyors &e Accessories (1) Pvt Ltd artended inspections on 15-03-2018 at 8:34 PM for the purpose of conducting a General Condition survey been carried out on the equipment mentioned here below and that said equipment conforms to the standards of the Convention for Safe Containers 1972 (CSC) and IMO/CSC.1/Circ. 138. Furthermore, it is declared that this same equipment appears sound at time of inspection and suitable for the carriage of cargo.
			</td>
		</tr>
	</table>
	<p>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="margin-bottom:10px;">
		<tr>
			<td width="100%">General Structural Condition</td>
		</tr>
	</table>
	<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr>
			<td width="50%">Unit Number:</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['unit_no'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">ISO Type:</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['iso_type'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">Csc Approval Number:</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['csc_approval_no'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">Cotainer No:</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['csc_approval_no'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">Manufacturer Type:</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['mfg'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">Manufacturer:</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['mfg_serial_no'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">Manufacturer Date:</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['mfg_date'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">Cotainer No:</td>
			<td width="50%" style="font-weight:bold;">100 Kg</td>
		</tr>
		<tr>
			<td width="50%">Cotainer No:</td>
			<td width="50%" style="font-weight:bold;">200 Kg</td>
		</tr>
		<tr>
			<td width="50%">Cotainer No:</td>
			<td width="50%" style="font-weight:bold;">300 Kg</td>
		</tr>
		<tr>
			<td width="50%">Cotainer No:</td>
			<td width="50%" style="font-weight:bold;">400 Kg</td>
		</tr>
		<tr>
			<td width="50%">Cotainer No:</td>
			<td width="50%" style="font-weight:bold;">50 Kh</td>
		</tr>
	</table>
	<p></p>
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr><td>COMMENT: {{ $cscre['comments'] }}</td></tr>
	</table>
	<p></p>
    <table width="100%" cellspacing="0" cellpadding="5" border="0">
		<tr>
			<td width="50%">
				SURVEYOR: 
				{{ $cscre['survey_without_prejudice'] }}
			</td>
			<td width="50%" align="right">
				{{ $cscre['rel_company_id']['name'] }}
			</td>
		</tr>
	</table>
	<p></p>
	<table width="100%" cellspacing="0" cellpadding="4" border="1" style="border-collapse: collapse;">
		<tr>
			<td width="70%" style="font-size: 7.5px;">
				THIS REPORT IS BASED SOLELY UPON A VISUAL EXAMINATION OF DOCUMENTS PROVIDED BY OTHERS. THE SURVEYOR ACCEPTS NO LIABILITY FOR ANY CONDITIONS THAT ARE NOT APPARENT DURING A NORMAL VISUAL INSPECTION OR THAT MAY BE RESULT OF INACCURATE INFORMATION PROVIDED IN DOCUMENTS UPON WHICH THE SURVEYOR MUST RELY.WE ARE NOT TO BE HELD RESPONSIBLE FOR ANY CONDENSATION AND RESURGENT ODOURS OCCURRING BETWEEN THE INSPECTION AND THE LOADING OPERATIONS WHICH MAY OCCUR DUE TO TEMPERATURE VARIATION.SUBJECT ONLY TO CLEANLINESS OF THE TANK, INTERIOR,VALVES & FITTINGS. Issued without any prejudice.
			</td>
			<td width="30%" style="text-align: right;" >
				<img src="{{ $sign }}">
			</td>
		</tr>
	</table>
</body>
</html>