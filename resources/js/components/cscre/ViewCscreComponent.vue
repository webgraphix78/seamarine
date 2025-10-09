<template>
	<div id="cscre-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_cscre_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/cscre'" role="button"><i class="ph ph-arrow-left"></i>Back to list</a>
					<h4 class="m-0 text-capitalize">View cscre</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Ref No</label>
	<div>
		<span v-if='readCscre.ref_no'>{{ readCscre.ref_no }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div><div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Company Name</label>
	<div>
		<span v-if='readCscre.rel_company_id?.name'>{{ readCscre.rel_company_id.name }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Customer name</label>
	<div>
		<span v-if='readCscre.customer_name'>{{ readCscre.customer_name }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
	<div class="col">
		<label class="form-label text-uppercase fw-bold m-0">Serial No</label>
		<div>
			<span v-if='readCscre.serial_no'>{{ readCscre.serial_no }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
	<div class="col">
		<label class="form-label text-uppercase fw-bold m-0">Date of Issue</label>
		<div>
			<span v-if='readCscre.issue_date'>{{ readCscre.issue_date }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
</div>
<div class='row mb-4'>
	<div class="col">
		<label class="form-label text-uppercase fw-bold m-0">Company name</label>
		<div>
			<span v-if='readCscre.company_name'>{{ readCscre.company_name }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Inspection Date</label>
	<div>
		<span v-if='readCscre.inspection_date'>{{ readCscre.inspection_date }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Inspection Location</label>
	<div>
		<span v-if='readCscre.inspection_location'>{{ readCscre.inspection_location }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Address</label>
	<div>
		<span v-if='readCscre.address'>{{ readCscre.address }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Container No</label>
	<div>
		<span v-if='readCscre.container_no'>{{ readCscre.container_no }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">ISO Type (if applicable)</label>
	<div>
		<span v-if='readCscre.iso_type'>{{ readCscre.iso_type }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">CSC Certification Number</label>
	<div>
		<span v-if='readCscre.csc_approval_no'>{{ readCscre.csc_approval_no }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
	<div class="col">
		<label class="form-label text-uppercase fw-bold m-0">Manufacture</label>
		<div>
			<span v-if='readCscre.mfg'>{{ readCscre.mfg }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
</div>
<div class='row mb-4'>
	<div class="col">
		<label class="form-label text-uppercase fw-bold m-0">Manufacture Date:</label>
		<div>
			<span v-if='readCscre.mfg_date'>{{ readCscre.mfg_date }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
</div>
<div class='row mb-4'>
	<div class="col">
		<label class="form-label text-uppercase fw-bold m-0">Manufacture Type</label>
		<div>
			<span v-if='readCscre.mfg_type'>{{ readCscre.mfg_type }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Customs/Transport No.</label>
	<div>
		<span v-if='readCscre.customs_no'>{{ readCscre.customs_no }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
	<div class="col-md-6">
		<label class="form-label text-uppercase fw-bold m-0">Maximum Gross Weight – kg/lbs</label>
		<div>
			<span v-if='readCscre.max_gross_weight'>{{ readCscre.max_gross_weight }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
	<div class="col-md-6">
		<label class="form-label text-uppercase fw-bold m-0">Tare Weight – kg/lbs</label>
		<div>
			<span v-if='readCscre.tare_weight'>{{ readCscre.tare_weight }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
	<div class="col-md-6">
		<label class="form-label text-uppercase fw-bold m-0">Allowable Stacking Weight – kg/lbs</label>
		<div>
			<span v-if='readCscre.stacking_weight'>{{ readCscre.stacking_weight }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
	<div class="col-md-6">
		<label class="form-label text-uppercase fw-bold m-0">Transverse Racking Test Force – kg/lbs</label>
		<div>
			<span v-if='readCscre.racking_test_force'>{{ readCscre.racking_test_force }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">CSC re-inspection date stamped:</label>
	<div>
		<span v-if='readCscre.csc_reinspection_date'>{{ readCscre.csc_reinspection_date }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
	<div class="col">
		<label class="form-label text-uppercase fw-bold m-0">Comments</label>
		<div>
			<span v-if='readCscre.comments'>{{ readCscre.comments }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
	<div class="col">
		<label class="form-label text-uppercase fw-bold m-0">Survey Name</label>
		<div>
			<span v-if='readCscre.surveyor_name'>{{ readCscre.surveyor_name }}</span>
			<span v-else><i>Not specified</i></span>
		</div>
	</div>
</div>

	</div>
</template>
<script>
export default {
	name: "Cscremaster",
	props: ['current_user_id', 'all_permissions','id','isModal', 'readCscre'],
	data(){
		return{
			currentUser: siteUserObject,
			readCscre: {},
			allCompanyIdList: [],
		}
	},
	methods: {
		cancelAddEdit(event){
			window.location = this.docRoot + '/cscre';
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/cscre/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.readCscre = Object.assign({}, response.data);
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
