<template>
	<div id="gasfreereport-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_gasfreereport_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/gasfreereport'" role="button"><i class="ph ph-arrow-left"></i>Back to list</a>
					<h4 class="m-0 text-capitalize">View gas free report</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Tank No</label>
				<div>
					<span v-if='readGasFreeReport.tank_no'>{{ readGasFreeReport.tank_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Company Id</label>
				<div>
					<span v-if='readGasFreeReport.rel_company_id?.name'>{{ readGasFreeReport.rel_company_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Type</label>
				<div>
					<span v-if='readGasFreeReport.type'>{{ readGasFreeReport.type }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Ref No</label>
				<div>
					<span v-if='readGasFreeReport.ref_no'>{{ readGasFreeReport.ref_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Csc No</label>
				<div>
					<span v-if='readGasFreeReport.csc_no'>{{ readGasFreeReport.csc_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Mfg</label>
				<div>
					<span v-if='readGasFreeReport.mfg'>{{ readGasFreeReport.mfg }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Ned</label>
				<div>
					<span v-if='readGasFreeReport.ned'>{{ readGasFreeReport.ned }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Mgw</label>
				<div>
					<span v-if='readGasFreeReport.mgw'>{{ readGasFreeReport.mgw }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Tare Wt</label>
				<div>
					<span v-if='readGasFreeReport.tare_wt'>{{ readGasFreeReport.tare_wt }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Capacity</label>
				<div>
					<span v-if='readGasFreeReport.capacity'>{{ readGasFreeReport.capacity }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Date</label>
				<div>
					<span v-if='readGasFreeReport.inspection_date'>{{ readGasFreeReport.inspection_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Location Id</label>
				<div>
					<span v-if='readGasFreeReport.rel_inspection_location_id?.name'>{{ readGasFreeReport.rel_inspection_location_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Customer Id</label>
				<div>
					<span v-if='readGasFreeReport.rel_customer_id?.name'>{{ readGasFreeReport.rel_customer_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Last Cargo Carried</label>
				<div>
					<span v-if='readGasFreeReport.last_cargo_carried'>{{ readGasFreeReport.last_cargo_carried }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Lel Inst</label>
				<div>
					<span v-if='readGasFreeReport.lel_inst'>{{ readGasFreeReport.lel_inst }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Lel Sr No</label>
				<div>
					<span v-if='readGasFreeReport.lel_sr_no'>{{ readGasFreeReport.lel_sr_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Calibration Validity Dt</label>
				<div>
					<span v-if='readGasFreeReport.calibration_validity_dt'>{{ readGasFreeReport.calibration_validity_dt }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Calibration Sr No</label>
				<div>
					<span v-if='readGasFreeReport.calibration_sr_no'>{{ readGasFreeReport.calibration_sr_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Oxygen Mtr</label>
				<div>
					<span v-if='readGasFreeReport.oxygen_mtr'>{{ readGasFreeReport.oxygen_mtr }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Oxy Calibration Validity</label>
				<div>
					<span v-if='readGasFreeReport.oxy_calibration_validity'>{{ readGasFreeReport.oxy_calibration_validity }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">In Air Lel</label>
				<div>
					<span v-if='readGasFreeReport.in_air_lel'>{{ readGasFreeReport.in_air_lel }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">In Air Oxygen</label>
				<div>
					<span v-if='readGasFreeReport.in_air_oxygen'>{{ readGasFreeReport.in_air_oxygen }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">In Space Lel</label>
				<div>
					<span v-if='readGasFreeReport.in_space_lel'>{{ readGasFreeReport.in_space_lel }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">In Space Oxygen</label>
				<div>
					<span v-if='readGasFreeReport.in_space_oxygen'>{{ readGasFreeReport.in_space_oxygen }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Reacted To Hydrocarbon</label>
				<div>
					<span v-if='readGasFreeReport.reacted_to_hydrocarbon'>{{ readGasFreeReport.reacted_to_hydrocarbon }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Alarmed At</label>
				<div>
					<span v-if='readGasFreeReport.alarmed_at'>{{ readGasFreeReport.alarmed_at }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Tank Is Gas Free</label>
				<div>
					<span v-if='readGasFreeReport.tank_is_gas_free'>{{ readGasFreeReport.tank_is_gas_free }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Surveyor Id</label>
				<div>
					<span v-if='readGasFreeReport.rel_surveyor_id?.name'>{{ readGasFreeReport.rel_surveyor_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>

	</div>
</template>
<script>
export default {
	name: "GasFreeReportmaster",
	props: ['current_user_id', 'all_permissions','id','isModal', 'readGasFreeReport'],
	data(){
		return{
			currentUser: siteUserObject,
			readGasFreeReport: {},
			allCompanyIdList: [],
			allInspectionLocationIdList: [],
			allCustomerIdList: [],
			allSurveyorIdList: [],
		}
	},
	methods: {
		cancelAddEdit(event){
			window.location = this.docRoot + '/gasfreereport';
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/gasfreereport/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.readGasFreeReport = Object.assign({}, response.data);
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
