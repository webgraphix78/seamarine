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
	<label class="form-label text-uppercase fw-bold m-0">This is certify that the undersigned surveyor did, at the request of</label>
	<div>
		<span v-if='readCscre.request_of_name'>{{ readCscre.request_of_name }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">, attend</label>
	<div>
		<span v-if='readCscre.attend'>{{ readCscre.attend }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">, of</label>
	<div>
		<span v-if='readCscre.of_name'>{{ readCscre.of_name }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">on the</label>
	<div>
		<span v-if='readCscre.attend_day'>{{ readCscre.attend_day }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">day of</label>
	<div>
		<span v-if='readCscre.attend_month'>{{ readCscre.attend_month }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Unit Number</label>
	<div>
		<span v-if='readCscre.unit_no'>{{ readCscre.unit_no }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">CSC Approval Number</label>
	<div>
		<span v-if='readCscre.csc_approval_no'>{{ readCscre.csc_approval_no }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Mfg</label>
	<div>
		<span v-if='readCscre.mfg'>{{ readCscre.mfg }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Mfg Date:</label>
	<div>
		<span v-if='readCscre.mfg_date'>{{ readCscre.mfg_date }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Mfg S/N</label>
	<div>
		<span v-if='readCscre.mfg_serial_no'>{{ readCscre.mfg_serial_no }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
</div>
</div>
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Container Type</label>
	<div>
		<span v-if='readCscre.container_type'>{{ readCscre.container_type }}</span>
		<span v-else><i>Not specified</i></span>
	</div>
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
<div class='row mb-4'>
<div class="col">
	<label class="form-label text-uppercase fw-bold m-0">Next CSC Inspection Date</label>
	<div>
		<span v-if='readCscre.next_csc_inspection_date'>{{ readCscre.next_csc_inspection_date }}</span>
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
	<label class="form-label text-uppercase fw-bold m-0">Survey made without prejudice</label>
	<div>
		<span v-if='readCscre.survey_without_prejudice'>{{ readCscre.survey_without_prejudice }}</span>
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
