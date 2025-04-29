<!doctype html>
<html lang="en">
	<head>
		<title>Cleaning Report Available</title>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	</head>

	<body>
		<p>&nbsp;</p>
		<h4>New {{$data["survey_type"]}} Reports Now on Seamarine Web Site:</h4>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th>Tank Number</th>
				<th>Report Date</th>
				<th>Survey Type</th>
				<th>Depot</th>
				<th>Surveyor</th>
			</tr>
			<tr>
				<td>{{$data["tank_number"]}}</td>
				<td>{{$data["report_date"]}}</td>
				<td>{{$data["survey_type"]}}</td>
				<td>{{$data["inspection_location"]}}</td>
				<td>{{$data["surveyor"]}}</td>
			</tr>
		</table>
		<hr>
		<p>Seamarine Automated Email: logic improved to better list Customer/Lessee. To stop receiving these notices, forward this message to <a href="mailto:admin@seamarin.co">admin@seamarin.co</a> with a note <b>'Remove Me'</b> at the top of the message</p>
	</body>
</html>
