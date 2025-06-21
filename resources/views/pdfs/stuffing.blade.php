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
			<td width="25%">
				<h3 style="text-align: center;margin: 0;padding: 0;">Reference No: {{$stuffing['ref_no']}}</h3>
			</td>
			<td width="50%" style="margin: auto;">
			</td>
			<td width="25%">
				<h3 style="text-align: center;margin: 0;padding: 0;">Date Of Issue: {{$stuffing['issue_date']}}</h3>
			</td>
		</tr>
	</table>
	<table cellspacing="5" cellpadding="0">
		<tr><td></td></tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="5" border="0"  style="margin: 0 auto;">
		<tr>
			<td width="100%">
				<h3 style="text-decoration:underline; margin:0px;text-align:center;">{{$stuffing['rel_customer_id']['name']}}</h3>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<h3 style="text-decoration:underline; margin:0px;text-align:center;">PORT STUFFING CHECK LIST</h3>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="5" border="1"  style="margin: 0 auto;">
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">1</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Date of Dispatch from Plant</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['dispatch_date']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">2</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Date of receipt of goods in CFS</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['cfs_receipt_date']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">3</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Name of Product as per Invoice</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['product_name']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">4</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Quantity in Kgs</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['quantity_kg']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">5</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">No. of packages received from plant</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['packages_received']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">6</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Pre-shipment Invoice No. & Date</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['preshipment_invoice']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">7</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Excise Invoice No. & Date</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['excise_invoice']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">8</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Vehicle Nos</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['vehicle_nos']}}</p>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="5" border="0"  style="margin: 0 auto;">
		<tr>
			<td width="100%">
				<h3 style="text-decoration:underline; margin:0px;text-align:center;">UNLOADING STAGE</h3>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="5" border="1"  style="margin: 0 auto;">
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">9</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether the goods are in same condition as dispatched from the plant (compare it with photos received from plant logistics)</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['goods_condition_check']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">10</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Date and Time of Unloading of goods</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['unloading_datetime']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">11</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether photos taken BEFORE & AFTER unloading of goods from the vehicle</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['unloading_photos']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">12</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether goods received/unloaded at CFS are in good condition?</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['goods_condition_cfs']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">13</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether storage area in CFS free of water, dust, dirt, etc. (e.g. including rains/ moisture etc.)</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['cfs_area_clean']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">14</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">If not, what are the actions taken</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['action_taken']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">15</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Where are the goods stored in CFS? Support it by photos</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['goods_storage_location']}}</p>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="5" border="0"  style="margin: 0 auto;">
		<tr>
			<td width="100%">
				<h3 style="text-decoration:underline; margin:0px;text-align:center;">PALLETIZATION & SHRINK WRAPPING STAGE:</h3>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="5" border="1"  style="margin: 0 auto;">
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">16</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether pallets supplied by vendor are in good condition</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['pallets_condition']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">17</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether palletization is completed by CHA as per the satisfaction(e.g. lot wise)</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['palletization_done']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">18</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether shipping marks applied on the goods</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['shipping_marks_done']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">19</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether shrink wrapping is completed as per the requirement</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['shrink_wrapping_done']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">20</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether Drum/ Bag/ Box labelling completed as per the satisfaction (Shipping Marks, Haz. Stickers)</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['labeling_done']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">21</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether photos taken during palletization, shrink wrapping stage inCFS?</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['packaging_photos']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">22</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Date and time of completion of this stage</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['packaging_done_time']}}</p>
			</td>
		</tr>
	</table>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<table width="100%" cellspacing="0" cellpadding="5" border="0"  style="margin: 0 auto;">
		<tr>
			<td width="100%">
				<h3 style="text-decoration:underline; margin:0px;text-align:center;">CONTAINER STUFFING STAGE</h3>
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="5" border="1"  style="margin: 0 auto;">
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">23</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Container No. / Seal No.</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['container_seal_no']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">24</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether fumigation done</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['fumigation_done']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">25</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether stage wise photographs of container stuffing taken</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['stuffing_photos']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">26</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether stuffing done as per the satisfaction</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['stuffing_done']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">27</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether lashing choking done satisfactory</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['lashing_done']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">28</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Whether container sealing complete as per the satisfaction</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['sealing_done']}}</p>
			</td>
		</tr>
		<tr>
			<td width="6%">
				<p style="margin:0px;text-align:center;">29</p>
			</td>
			<td width="46%">
				<p style="margin:0px;">Date and time of completion with photo</p>
			</td>
			<td width="46%">
				<p style="margin:0px;text-align:center;">{{$stuffing['container_done_time']}}</p>
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
							Surveyor Name: {{ $stuffing['rel_surveyor_id']['name'] ?? 'N/A' }}
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td><h4>For Sea Marine Inspection Services (I) Pvt. Ltd.</h4></td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>Issued Without Any Prejudice</td>
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
