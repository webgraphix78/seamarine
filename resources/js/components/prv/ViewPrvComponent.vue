<template>
	<div id="prv-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_prv_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/prv'" role="button"><i class="ph ph-arrow-left"></i>Back to list</a>
					<h4 class="m-0 text-capitalize">View PRV Calibration</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Ref</label>
				<div>
					<span v-if='readPrv.ref'>{{ readPrv.ref }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Date Of Issue</label>
				<div>
					<span v-if='readPrv.date_of_issue'>{{ readPrv.date_of_issue }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'><div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Company Name</label>
				<div>
					<span v-if='readPrv.rel_company_id?.name'>{{ readPrv.rel_company_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Customer Name</label>
				<div>
					<span v-if='readPrv.rel_customer_id?.name'>{{ readPrv.rel_customer_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Location Id</label>
				<div>
					<span v-if='readPrv.rel_inspection_location_id?.name'>{{ readPrv.rel_inspection_location_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Address</label>
				<div>
					<span v-if='readPrv.address'>{{ readPrv.address }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Tank No</label>
				<div>
					<span v-if='readPrv.tank_no'>{{ readPrv.tank_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Date</label>
				<div>
					<span v-if='readPrv.inspection_date'>{{ readPrv.inspection_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Address 2</label>
				<div>
					<span v-if='readPrv.address_2'>{{ readPrv.address_2 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Mfg</label>
				<div>
					<span v-if='readPrv.mfg'>{{ readPrv.mfg }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Serial No</label>
				<div>
					<span v-if='readPrv.serial_no'>{{ readPrv.serial_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Full Flow Rate</label>
				<div>
					<span v-if='readPrv.full_flow_rate'>{{ readPrv.full_flow_rate }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Op</label>
				<div>
					<span v-if='readPrv.op'>{{ readPrv.op }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Vaccum Set</label>
				<div>
					<span v-if='readPrv.vaccum_set'>{{ readPrv.vaccum_set }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Bursting Disc</label>
				<div>
					<span v-if='readPrv.bursting_disc'>{{ readPrv.bursting_disc }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Surveyor Id</label>
				<div>
					<span v-if='readPrv.rel_surveyor_id?.name'>{{ readPrv.rel_surveyor_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	name: "Prvmaster",
	props: ['current_user_id', 'all_permissions','id','isModal'],
	data(){
		return{
			currentUser: siteUserObject,
			readPrv: {},
			allCustomerIdList: [],
			allInspectionLocationIdList: [],
			allSurveyorIdList: [],
		}
	},
	methods: {
		cancelAddEdit(event){
			window.location = this.docRoot + '/prv';
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/prv/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.readPrv = Object.assign({}, response.data);
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
