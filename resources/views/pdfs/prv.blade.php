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
			<td width="50%">
				<h3 style="text-align: start;">Ref No: {{ $prv['ref'] }}</h3>
			</td>
			<td width="50%">
				<h3 style="text-align: right;">Date: {{ $prv['date_of_issue'] }}</h3>
			</td>
		</tr>
		<tr>
			<td width="100%" style="text-align: center;text-decoration:underline;">
				<h2 >Pressure Relief Valve Calibration Certificate</h2>
			</td>
		</tr>
	</table>
	
	<table width="100%" cellspacing="0" cellpadding="0" border="0"  style="margin: 0 auto; font-size:21px">
		<tr>
			<td>
				<p>
					This is to certify that undersigned surveyor did, at the request of M/s <strong>{{ $prv['rel_customer_id']['name'] }}</strong> , <strong>{{ $prv['address'] }}</strong> attend Pressure Relief Valve Calibration of Unit Number <strong>{{ $prv['tank_no'] }}</strong> on <strong>{{ $prv['inspection_date'] }}</strong> in <strong>{{ $prv['rel_inspection_location_id']['name'] }}</strong> , <strong>{{ $prv['address_2'] }}</strong>.
				</p>
				
				<p style="text-decoration:underline;">Particulars Of Pressure Relief Valve</p>
				<p style="margin: 4px;">Manufacturer Type: <strong>{{ $prv['mfg'] }}</strong></p>
				<p style="margin:0px; padding: 0px;">Serial Number: <strong>{{ $prv['serial_no'] }}</strong></p>
				<p style="margin:0px; padding: 0px;">Full Flow Rate ( CMHR ) : <strong>{{ $prv['full_flow_rate'] }}</strong></p>
				<p style="margin:0px; padding: 0px;">Operating Pressure ( Bar ) : <strong>{{ $prv['op'] }}</strong></p>
				<p style="margin:0px; padding: 0px;">Vacuum Setting ( Hg) : <strong>{{ $prv['vaccum_set'] }}</strong></p>
				<p style="margin:0px; padding: 0px;">Bursting Disc ( Bar ) : <strong>{{ $prv['bursting_disc'] }}</strong></p>
				
			
				<p>Note : ( a ) This inspection does not meet the requirement of any Regulatory Body.</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( b ) Photographs captured during Bench Test of PRV appended to certificate .</p>
			</td>
		</tr>
	</table>

	<table width="100%" cellspacing="0" cellpadding="5" border="0"  style="margin: 0 auto;">
		<tr>
			<td width="85%">
				<p>&nbsp;</p>
				<h3>Issued without any prejudice.</h3>
				<h3>Surveyor: {{ $prv['rel_surveyor_id']['name'] }}</h3>
			</td>
			<td width="15%" style="text-align: center;" rowspan="2">
				<img src="{{ $sign }}">
			</td>
		</tr>
	</table>
</body>
</html>