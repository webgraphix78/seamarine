<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ $weightment['ref_no'] }}</title>
		<style>
			td{
				font-size: 9px;
			}
		</style>
	</head>
	<body>
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<p>To</p>	
					<p>{{ $weightment['customer']['name'] }}</p>
				</td>
				<td align="right">
					{{ date("d-m-Y", strtotime($weightment['date_of_issue'])) }}
				</td>
			</tr>
		</table>
		<p>&nbsp;At the request of {{ $weightment['customer']['name'] }} the undersigned surveyor {{ $weightment['company']['name'] }}, have carried out following job</p>
		<table border="0" cellspacing="2" cellpadding="3">
			<tr>
				<td width="60%">
					1. {{ $weightment['field_1_key'] }}
				</td>
				<td width="20%">
					{{ $weightment['field_1_value_1'] }}
				</td>
				<td width="20%">
					{{ $weightment['field_1_value_1'] }}
				</td>
			</tr>
			<tr>
				<td width="60%">
					2. {{ $weightment['field_2_key'] }}
				</td>
				<td width="20%">
					{{ $weightment['field_2_value_1'] }}
				</td>
				<td width="20%">
					{{ $weightment['field_2_value_1'] }}
				</td>
			</tr>
			<tr>
				<td width="60%">
					3. {{ $weightment['field_3_key'] }}
				</td>
				<td width="20%">
					{{ $weightment['field_3_value_1'] }}
				</td>
				<td width="20%">
					{{ $weightment['field_3_value_1'] }}
				</td>
			</tr>
			<tr>
				<td width="60%">
					4. {{ $weightment['field_4_key'] }}
				</td>
				<td width="20%">
					{{ $weightment['field_4_value_1'] }}
				</td>
				<td width="20%">
					{{ $weightment['field_4_value_1'] }}
				</td>
			</tr>
			<tr>
				<td width="60%">
					5. {{ $weightment['field_5_key'] }}
				</td>
				<td width="20%">
					{{ $weightment['field_5_value_1'] }}
				</td>
				<td width="20%">
					{{ $weightment['field_5_value_1'] }}
				</td>
			</tr>
		</table>
		<p>COMMENT: {{ $weightment['comments'] }}</p>
		<table width="100%" border="1" cellspacing="0" cellpadding="5">
			<tr>
				<td style="font-size: 7.5px;" width="60%">
				THIS REPORT IS BASED SOLELY UPON A VISUAL EXAMINATION OF DOCUMENTS PROVIDED BY
OTHERS .THE SURVEYOR ACCEPTS NO LIABILITY FOR ANY CONDITIONS THAT ARE NOT
APPARENT DURING A NORMAL VISUAL INSPECTION OR THAT MAY BE RESULT OF INACCURATE
INFORMATION PROVIDED IN DOCUMENTS UPON WHICH THE SURVEYOR MUST RELY.WE ARE NOT
TO BE HELD RESPONSIBLE FOR ANY CONDENSATION AND RESURGENT ODOURS OCCURRING
BETEWEEN THE INSPECTION AND THE LOADING OPERATIONS WHICH MAY OCCUR DUE TO
TEMPERATURE VARIATION.SUBJECT ONLY TO CLEANLINESS OF THE TANK, INTERIOR,VALVES &
FITTINGS. Issued without any prejudice
				</td>
				<td rowspan="2" align="right" width="40%">
					<p>For {{ $weightment['company']['name'] }}</p>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="60%">&nbsp;</td>
							<td width="40%">
								<img src="{{ $sign }}">
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					SURVEYOR: {{ $weightment['surveyor']['name'] }}
				</td>
			</tr>
		</table>
	</body>
</html>