<template>
	<div id="stuffing-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-12-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_stuffing_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/stuffing'" role="button"><i class="ph ph-arrow-left"></i>Back to list</a>
					<h4 class="m-0 text-capitalize">View stuffing</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4 g-3'>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Ref No</label>
				<div>
					<span v-if='readStuffing.ref_no'>{{ readStuffing.ref_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Company Id</label>
				<div>
					<span v-if='readStuffing.rel_company_id?.name'>{{ readStuffing.rel_company_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Customer Name</label>
				<div>
					<span v-if='readStuffing.rel_customer_id?.name'>{{ readStuffing.rel_customer_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Date of Issue</label>
				<div>
					<span v-if='readStuffing.issue_date'>{{ readStuffing.issue_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4 g-3'>
			<div class="col-12">
				<h5 class="m-0 text-center">PORT STUFFING CHECK LIST</h5>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Date of Dispatch from Plant</label>
				<div>
					<span v-if='readStuffing.dispatch_date'>{{ readStuffing.dispatch_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Date of receipt of goods in CFS</label>
				<div>
					<span v-if='readStuffing.cfs_receipt_date'>{{ readStuffing.cfs_receipt_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Name of Product as per Invoice</label>
				<div>
					<span v-if='readStuffing.product_name'>{{ readStuffing.product_name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Quantity Kg</label>
				<div>
					<span v-if='readStuffing.quantity_kg'>{{ readStuffing.quantity_kg }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">No. of packages received from plant</label>
				<div>
					<span v-if='readStuffing.packages_received'>{{ readStuffing.packages_received }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Pre-shipment Invoice No. & Date</label>
				<div>
					<span v-if='readStuffing.preshipment_invoice'>{{ readStuffing.preshipment_invoice }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Excise Invoice No. & Date</label>
				<div>
					<span v-if='readStuffing.excise_invoice'>{{ readStuffing.excise_invoice }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Vehicle Nos</label>
				<div>
					<span v-if='readStuffing.vehicle_nos'>{{ readStuffing.vehicle_nos }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4 g-3'>
			<div class="col-12">
				<h5 class="m-0 text-center">UNLOADING STAGE</h5>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether the goods are in same condition as dispatched from the plant</label>
				<div>
					<span v-if='readStuffing.goods_condition_check'>{{ readStuffing.goods_condition_check }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Date and Time of Unloading of goods</label>
				<div>
					<span v-if='readStuffing.unloading_datetime'>{{ readStuffing.unloading_datetime }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether photos taken BEFORE & AFTER unloading of goods from the vehicle</label>
				<div>
					<span v-if='readStuffing.unloading_photos'>{{ readStuffing.unloading_photos }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether goods received/unloaded at CFS are in good condition?</label>
				<div>
					<span v-if='readStuffing.goods_condition_cfs'>{{ readStuffing.goods_condition_cfs }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether storage area in CFS free of water, dust, dirt, etc.</label>
				<div>
					<span v-if='readStuffing.cfs_area_clean'>{{ readStuffing.cfs_area_clean }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">If not, what are the actions taken</label>
				<div>
					<span v-if='readStuffing.action_taken'>{{ readStuffing.action_taken }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Where are the goods stored in CFS? Support it by photos</label>
				<div>
					<span v-if='readStuffing.goods_storage_location'>{{ readStuffing.goods_storage_location }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4 g-3'>
			<div class="col-12">
				<h5 class="m-0 text-center">PALLETIZATION & SHRINK WRAPPING STAGE:</h5>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether pallets supplied by vendor are in good condition</label>
				<div>
					<span v-if='readStuffing.pallets_condition'>{{ readStuffing.pallets_condition }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether palletization is completed by CHA as per the satisfaction</label>
				<div>
					<span v-if='readStuffing.palletization_done'>{{ readStuffing.palletization_done }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether shipping marks applied on the goods</label>
				<div>
					<span v-if='readStuffing.shipping_marks_done'>{{ readStuffing.shipping_marks_done }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether shrink wrapping is completed as per the requirement</label>
				<div>
					<span v-if='readStuffing.shrink_wrapping_done'>{{ readStuffing.shrink_wrapping_done }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether Drum/ Bag/ Box labelling completed as per the satisfaction</label>
				<div>
					<span v-if='readStuffing.labeling_done'>{{ readStuffing.labeling_done }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether photos taken during palletization, shrink wrapping stage in CFS?</label>
				<div>
					<span v-if='readStuffing.packaging_photos'>{{ readStuffing.packaging_photos }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Date and time of completion of this stage</label>
				<div>
					<span v-if='readStuffing.packaging_done_time'>{{ readStuffing.packaging_done_time }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4 g-3'>
			<div class="col-12">
				<h5 class="m-0 text-center">CONTAINER STUFFING STAGE</h5>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Container No. / Seal No.</label>
				<div>
					<span v-if='readStuffing.container_seal_no'>{{ readStuffing.container_seal_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether fumigation done</label>
				<div>
					<span v-if='readStuffing.fumigation_done'>{{ readStuffing.fumigation_done }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether stage wise photographs of container stuffing taken</label>
				<div>
					<span v-if='readStuffing.stuffing_photos'>{{ readStuffing.stuffing_photos }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether stuffing done as per the satisfaction</label>
				<div>
					<span v-if='readStuffing.stuffing_done'>{{ readStuffing.stuffing_done }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether lashing choking done satisfactory</label>
				<div>
					<span v-if='readStuffing.lashing_done'>{{ readStuffing.lashing_done }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Whether container sealing complete as per the satisfaction</label>
				<div>
					<span v-if='readStuffing.sealing_done'>{{ readStuffing.sealing_done }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Date and time of completion with photo</label>
				<div>
					<span v-if='readStuffing.container_done_time'>{{ readStuffing.container_done_time }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Surveyor Name</label>
				<div>
					<span v-if='readStuffing.rel_surveyor_id?.name'>{{ readStuffing.rel_surveyor_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		name: "Stuffingmaster",
		props: ['current_user_id', 'all_permissions','id','isModal', 'readStuffing'],
		data(){
			return{
				currentUser: siteUserObject,
				readStuffing: {},
				allCompanyIdList: [],
				allCustomerIdList: [],
				allSurveyorIdList: [],
			}
		},
		methods: {
			cancelAddEdit(event){
				window.location = this.docRoot + '/stuffing';
			},
			reloadEverything() {
				if (this.id !== undefined && !isNaN(this.id)) {
					// This is Edit mode - fetch inquiry data
					var that = this;
					var URL = this.docRoot + "/api/stuffing/get-record/" + this.id;
					this.showLoading("Loading ...");
					axios
						.post(URL, {})
						.then(function (response) {
							that.closeSwal();
							that.readStuffing = Object.assign({}, response.data);
						})
						.catch(function (error) {
							console.log(error);
						});
				}
			}
		},
		async mounted() {
			if (this.id > 0){
				this.reloadEverything();
			}
		}
	}
</script>
