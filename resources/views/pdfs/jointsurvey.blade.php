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
				<h3 style="text-align: start;">Ref No: {{ $jointsurvey['ref_no'] }}</h3>
			</td>
			<td width="50%">
				<h3 style="text-align: right;">Date: {{ date("d-m-Y", strtotime($jointsurvey['created_at'])) }}</h3>
			</td>
		</tr>
		<tr>
			<td width="30%"></td>
			<td width="40%">
				<h2 style="text-align: center;margin: 0;padding: 0;text-decoration:underline;">Joint Survey Report</h2>
				<h2 style="text-align: center;margin: 0;padding: 0;text-decoration:underline;">Tank No.: <b>{{ $jointsurvey['tank_no'] }}</b></h2>
			</td>
			<td width="30%"></td>
		</tr>
	</table>
	<p>At the request of <strong>{{ $jointsurvey['customer_name'] }}</strong>, the undersigned surveyor, <strong>{{ $jointsurvey['company_name'] }}</strong>, Mumbai has carried out Joint Survey of Tank Container: <strong>{{ $jointsurvey['tank_no'] }}</strong>. Tank has been surveyed at <strong>{{ $jointsurvey['address'] }}</strong></p>

	<p style="text-decoration:underline;">Tank Particulars as noted are as follows:</p>
	<p style="margin: 4px;">Tank Container No: {{ $jointsurvey['tank_no'] }}</p>
	<p style="margin:0px; padding: 0px;">Year of manufacture: {{ $jointsurvey['mfg_date'] }}</p>
	<p style="margin:0px; padding: 0px;">CSC No: {{ $jointsurvey['csc'] }}</p>
	<p style="margin:0px; padding: 0px;">MGW: {{ $jointsurvey['mgw'] }}</p>
	<p style="margin:0px; padding: 0px;">Tare Wt.: {{ $jointsurvey['tare_weight'] }}</p>
	<p style="margin:0px; padding: 0px;">Capacity: {{ $jointsurvey['capacity'] }}</p>
	
	<p style="text-decoration:underline;">Joint Survey attended by following:</p>
	<ol>
		@if(isset($jointsurvey['instruction_1']) && $jointsurvey['instruction_1'])
			<li>{{ $jointsurvey['instruction_1'] }}</li>
		@endif
		
		@if(isset($jointsurvey['instruction_2']) && $jointsurvey['instruction_2'])
			<li>{{ $jointsurvey['instruction_2'] }}</li>
		@endif
		
		@if(isset($jointsurvey['instruction_3']) && $jointsurvey['instruction_3'])
			<li>{{ $jointsurvey['instruction_3'] }}</li>
		@endif
		
		@if(isset($jointsurvey['instruction_4']) && $jointsurvey['instruction_4'])
			<li>{{ $jointsurvey['instruction_4'] }}</li>
		@endif
		
		@if(isset($jointsurvey['instruction_5']) && $jointsurvey['instruction_5'])
			<li>{{ $jointsurvey['instruction_5'] }}</li>
		@endif
	</ol>

	@if(isset($jointsurvey['comments']) && $jointsurvey['comments'])
	<p>{{ $jointsurvey['comments'] }}</p>
	@endif
	<table width="100%" cellspacing="0" cellpadding="5" border="0"  style="margin: 0 auto;">
		<tr>
			<td width="85%">
				<p>&nbsp;</p>
				<h3>Certificate Issued without any prejudice.</h3>
				<h3>SURVEYOR: {{ $jointsurvey['surveyor']['name'] }}</h3>
			</td>
			<td width="15%" style="text-align: center;" rowspan="2">
				<img src="{{ $sign }}">
			</td>
		</tr>
	</table>
</body>
</html>
