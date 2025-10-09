<template>
	<div id="dmcc-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_dmcc_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/dmcc'" role="button"><i class="ph ph-arrow-left"></i>Back to list</a>
					<h4 class="m-0 text-capitalize">View dmcc</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Tank No</label>
				<div>
					<span v-if='readDmcc.tank_no'>{{ readDmcc.tank_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Company Name</label>
				<div>
					<span v-if='readDmcc.rel_company_id?.name'>{{ readDmcc.rel_company_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Date of Loading</label>
				<div>
					<span v-if='readDmcc.inspection_date'>{{ readDmcc.inspection_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4 g-3'>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Loading Of</label>
				<div>
					<span v-if='readDmcc.loading_of'>{{ readDmcc.loading_of }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Tank under Nitrogen pressure and all Seals intact</label>
				<div>
					<span v-if='readDmcc.seals_intact_time'>{{ readDmcc.seals_intact_time }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Seals Intact Remark</label>
				<div>
					<span v-if='readDmcc.seals_intact_remark'>{{ readDmcc.seals_intact_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">All Seals broken</label>
				<div>
					<span v-if='readDmcc.seals_broken'>{{ readDmcc.seals_broken }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.seals_broken_remark'>{{ readDmcc.seals_broken_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Pre‐trip inspection by Quality officer carried out.</label>
				<div>
					<span v-if='readDmcc.pretrip_inspection_qc'>{{ readDmcc.pretrip_inspection_qc }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.pretrip_inspection_qc_remark'>{{ readDmcc.pretrip_inspection_qc_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Bottom discharge valve operated and checked for any leakage of Nitrogen by QC.</label>
				<div>
					<span v-if='readDmcc.bottom_valve_checked'>{{ readDmcc.bottom_valve_checked }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.bottom_valve_checked_remark'>{{ readDmcc.bottom_valve_checked_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Nitrogen from Container released by opening DN40 Airline Valve by QC.</label>
				<div>
					<span v-if='readDmcc.n2_released_dn40'>{{ readDmcc.n2_released_dn40 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.n2_released_dn40_remark'>{{ readDmcc.n2_released_dn40_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Operation of Emergency Remote cable checked by QC.</label>
				<div>
					<span v-if='readDmcc.emergency_remote_checked'>{{ readDmcc.emergency_remote_checked }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.emergency_remote_checked_remark'>{{ readDmcc.emergency_remote_checked_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Manlid opened and Tank checked for any moisture or smell by QC.</label>
				<div>
					<span v-if='readDmcc.manlid_checked'>{{ readDmcc.manlid_checked }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.manlid_checked_remark'>{{ readDmcc.manlid_checked_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Manlid and Bottom discharge valve closed by QC.</label>
				<div>
					<span v-if='readDmcc.manlid_valve_closed'>{{ readDmcc.manlid_valve_closed }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.manlid_valve_closed_remark'>{{ readDmcc.manlid_valve_closed_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Tank cleared for Nitrogen purging.</label>
				<div>
					<span v-if='readDmcc.tank_cleared_for_purging'>{{ readDmcc.tank_cleared_for_purging }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.tank_cleared_for_purging_remark'>{{ readDmcc.tank_cleared_for_purging_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Blind Flange of DN80 Butterfly Top Valve removed and special connector fitted.</label>
				<div>
					<span v-if='readDmcc.dn80_connector_fitted'>{{ readDmcc.dn80_connector_fitted }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.dn80_connector_fitted_remark'>{{ readDmcc.dn80_connector_fitted_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">N2 purged up to 0.5 bar pressure through DN40 Airline Valve. ( 1st Time)</label>
				<div>
					<span v-if='readDmcc.n2_purged_1'>{{ readDmcc.n2_purged_1 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.n2_purged_1_remark'>{{ readDmcc.n2_purged_1_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">N2 pressure released from DN 40 Airline Valve. (1st Time)</label>
				<div>
					<span v-if='readDmcc.n2_released_1'>{{ readDmcc.n2_released_1 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.n2_released_1_remark'>{{ readDmcc.n2_released_1_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">N2 purged up to 0.5 bar pressure through DN40 Airline Valve. ( 2nd Time)</label>
				<div>
					<span v-if='readDmcc.n2_purged_2'>{{ readDmcc.n2_purged_2 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.n2_purged_2_remark'>{{ readDmcc.n2_purged_2_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">N2 pressure released from DN 40 Airline Valve. (2ndTime)</label>
				<div>
					<span v-if='readDmcc.n2_released_2'>{{ readDmcc.n2_released_2 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.n2_released_2_remark'>{{ readDmcc.n2_released_2_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">N2 purged up to 0.5 bar pressure through DN40 Airline Valve. (3rd Time)</label>
				<div>
					<span v-if='readDmcc.n2_purged_3'>{{ readDmcc.n2_purged_3 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.n2_purged_3_remark'>{{ readDmcc.n2_purged_3_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">N2 pressure released from DN 40 Airline Valve. (3rdTime)</label>
				<div>
					<span v-if='readDmcc.n2_released_3'>{{ readDmcc.n2_released_3 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.n2_released_3_remark'>{{ readDmcc.n2_released_3_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Permission of QC Manager for starting loading BSCL accorded.</label>
				<div>
					<span v-if='readDmcc.qc_permission_granted'>{{ readDmcc.qc_permission_granted }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.qc_permission_granted_remark'>{{ readDmcc.qc_permission_granted_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Pumping of BSCL started & filling commenced through Special Connector.</label>
				<div>
					<span v-if='readDmcc.bscl_pumping_started'>{{ readDmcc.bscl_pumping_started }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.bscl_pumping_started_remark'>{{ readDmcc.bscl_pumping_started_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">DN40 Airline Valve opened soon after commencing of loading to avoid building of undue pressure in Tank</label>
				<div>
					<span v-if='readDmcc.dn40_opened_during_loading'>{{ readDmcc.dn40_opened_during_loading }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.dn40_opened_during_loading_remark'>{{ readDmcc.dn40_opened_during_loading_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Loading completed, pump stopped and DN 40 Airline Valve closed.</label>
				<div>
					<span v-if='readDmcc.loading_completed_dn40_closed'>{{ readDmcc.loading_completed_dn40_closed }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.loading_completed_dn40_closed_remark'>{{ readDmcc.loading_completed_dn40_closed_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Butterfly Valve Closed & Special Connector removed from DN80 Butterfly Top Discharge Valve.</label>
				<div>
					<span v-if='readDmcc.butterfly_valve_closed'>{{ readDmcc.butterfly_valve_closed }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.butterfly_valve_closed_remark'>{{ readDmcc.butterfly_valve_closed_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">BSCL cargo sample removed through Blind Flange opening.</label>
				<div>
					<span v-if='readDmcc.cargo_sample_removed'>{{ readDmcc.cargo_sample_removed }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.cargo_sample_removed_remark'>{{ readDmcc.cargo_sample_removed_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Butterfly Valve of DN 80 Top Valve closed and Blind Flange fitted back.</label>
				<div>
					<span v-if='readDmcc.butterfly_valve_reclosed'>{{ readDmcc.butterfly_valve_reclosed }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.butterfly_valve_reclosed_remark'>{{ readDmcc.butterfly_valve_reclosed_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">On completion of Cargo stuffing, N2 purged through DN40 Airline Valve in Tank: Nitrogen blanket pressure (0.5 bar).</label>
				<div>
					<span v-if='readDmcc.n2_purged_final'>{{ readDmcc.n2_purged_final }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.n2_purged_final_remark'>{{ readDmcc.n2_purged_final_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">After loading inspection completed by QC officer & Loading Operation Completed</label>
				<div>
					<span v-if='readDmcc.final_inspection_done'>{{ readDmcc.final_inspection_done }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Remark</label>
				<div>
					<span v-if='readDmcc.final_inspection_done_remark'>{{ readDmcc.final_inspection_done_remark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">N2 Cylinder Nos</label>
				<div>
					<span v-if='readDmcc.n2_cylinder_nos'>{{ readDmcc.n2_cylinder_nos }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Total No. of N2 Cylinder consumed</label>
				<div>
					<span v-if='readDmcc.total_no_cylinder'>{{ readDmcc.total_no_cylinder }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">M/S BSCL Rep</label>
				<div>
					<span v-if='readDmcc.bscl_rep'>{{ readDmcc.bscl_rep }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Surveyor Name</label>
				<div>
					<span v-if='readDmcc.rel_surveyor_id?.name'>{{ readDmcc.rel_surveyor_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	name: "Dmccmaster",
	props: ['current_user_id', 'all_permissions','id','isModal', 'readDmcc'],
	data(){
		return{
			currentUser: siteUserObject,
			readDmcc: {},
			allCompanyIdList: [],
			allSurveyorIdList: [],
		}
	},
	methods: {
		cancelAddEdit(event){
			window.location = this.docRoot + '/dmcc';
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/dmcc/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.readDmcc = Object.assign({}, response.data);
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
