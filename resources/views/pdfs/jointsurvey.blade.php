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
			<td width="33%">
				<p>Ref No: </p>
			</td>
			<td width="34%">
				<h3 style="text-align: center;margin: 0;padding: 0;">Joint Survey Report</h3>
				<p>Tank No.: <b></b></p>
			</td>
			<td width="33%">
				<p>Date: </p>
			</td>
		</tr>
	</table>
	<p>At the request of {{ $jointsurvey['customer_name'] }}, the undersigned surveyor, {{ $jointsurvey['tank_no'] }} the undersigned surveyor, Tank container {{ $jointsurvey['tank_no'] }} has been surveyed at, Oceanstar Services, Survey no 84/2, 85/2, Village Belondakhar, Jasai-Digode Road, Uran, Raigad, Maharashtra ° 410207.   
	Mumbai have carried out Joint Survey of Tank Container {{ $jointsurvey['tank_no'] }}. Tank Container {{ $jointsurvey['tank_no'] }} was surveyed at Speedy CFS, Nava Sheva on 26-10-2024. During Joint following were present:
	<ol>
		<li>{{ $jointsurvey['instruction_1'] }}</li>
		<li>{{ $jointsurvey['instruction_2'] }}</li>
		<li>{{ $jointsurvey['instruction_3'] }}</li>
	</ol>

	<p>Tank Container No: {{ $jointsurvey['tank_no'] }}</p>
	<p>Date of Manufature: {{ $jointsurvey['manufacture_date'] }}</p>
	<p>MGW: {{ $jointsurvey['mgw'] }} Kgs</p>
	<p>Tare Wt.: {{ $jointsurvey['tare_wt'] }} Kgs</p>
	<p>Capacity: {{ $jointsurvey['capacity'] }} Kgs</p>
	<p>CSC: {{ $jointsurvey['csc'] }}</p>
	<p>COMMENT: {{ $jointsurvey['comments'] }}</p>
	
	<table width="100%" cellspacing="0" cellpadding="5" border="0">
		<tr>
			<td width="50%">
				SURVEYOR: 
				{{ $jointsurvey['surveyor']['name'] }}
			</td>
			<td width="50%" align="right">
				{{ $jointsurvey['company']['name'] }}
			</td>
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
	</table>
</body>
</html>