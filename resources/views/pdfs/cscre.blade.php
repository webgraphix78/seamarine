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
			<td width="25%"></td>
			<td width="50%" style="margin: auto;">
				<h3 style="text-align: center;margin: 0;padding: 0;">CSC CERTIFICATE Number:{{$cscre['serial_no']}}</h3>
			</td>
			<td width="25%">
			</td>
		</tr>
	</table>
	<table>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td width="100%">
				This certificate is issued to <strong>{{ $cscre['customer_name'] }}</strong> to certify that <strong>{{ $cscre['company_name'] }}</strong>. attended inspections on <strong>{{$cscre['inspection_date']}}</strong> at <strong>{{$cscre['inspection_location']}}</strong>, <strong>{{$cscre['address']}}</strong> for the purpose of conducting a  General Condition survey been carried out on the equipment mentioned here below and that said equipment conforms to the standards of the Convention for Safe Containers 1972 (CSC) and IMO/CSC.1/Circ.138. Furthermore, it is declared that this same equipment appears sound at time of inspection and suitable for the carriage of cargo.
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="margin-bottom:10px;">
		<tr>
			<td width="100%"><p style="text-align:center;text-decoration:underline;">General Structural Condition</p></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
	</table>
	<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr>
			<td width="50%">CONTAINER NO</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['container_no'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">ISO Type</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['iso_type'] ?? 'null' }}</td>
		</tr>
	</table>
	<p></p>
	<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr>
			<td width="50%">CSC Certification No.</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['csc_approval_no'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">Customs/Transport No.</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['customs_no'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">Manufacturer Type:</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['mfg_type'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">Manufacturer:</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['mfg'] ?? 'null' }}</td>
		</tr>
		<tr>
			<td width="50%">Manufacturer Date:</td>
			<td width="50%" style="font-weight:bold;">{{ $cscre['mfg_date'] ?? 'null' }}</td>
		</tr>
	</table>
	<p></p>
	<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr>
			<td width="50%">Maximum Gross Weight – kg/lbs</td>
			<td width="50%" style="font-weight:bold;">100 Kg</td>
		</tr>
		<tr>
			<td width="50%">Tare Weight – kg/lbs</td>
			<td width="50%" style="font-weight:bold;">200 Kg</td>
		</tr>
		<tr>
			<td width="50%">Allowable Stacking Weight – kg/lbs</td>
			<td width="50%" style="font-weight:bold;">300 Kg</td>
		</tr>
		<tr>
			<td width="50%">Transverse Racking Test Force – kg/lbs</td>
			<td width="50%" style="font-weight:bold;">400 Kg</td>
		</tr>
	</table>
	<p></p>
	<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
		<tr><td>CSC RE-EXAMNINATION IS DUE BEFORE: <strong>{{ $cscre['csc_reinspection_date'] }}</strong></td></tr>
	</table>
	<p></p>
	@if(isset($cscre['comments']) && $cscre['comments'])
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr><td>{{ $cscre['comments'] }}</td></tr>
	</table>
	@endif
	<p></p>
    <table width="100%" cellspacing="0" cellpadding="5" border="0">
		<tr>
			<td width="50%">
				<h4>
					Surveyor Name: {{ $cscre['surveyor_name'] }}
				</h4>
			</td>
			<td width="50%" align="right">
				<h4>
					Date of Issue: {{ $cscre['issue_date'] }}
				</h4>
			</td>
		</tr>
	</table>
	<p></p>
	<table width="100%" cellspacing="0" cellpadding="5" border="0"  style="margin: 0 auto;">
		<tr>
			<td width="85%">
				<p>&nbsp;</p>
				<h3>Issued without any prejudice.</h3>
			</td>
			<td width="15%" style="text-align: center;" rowspan="2">
				<img src="{{ $sign }}">
			</td>
		</tr>
	</table>
</body>
</html>
