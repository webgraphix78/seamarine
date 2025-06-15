<template>
	<div id="dmcc-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_dmcc_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/dmcc'" role="button"><i class="ph ph-arrow-left "></i>Back to list</a>
					<h4 class="m-0 text-capitalize">Add DMCC</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label for="add_dmcc_tank_no" class="form-label text-uppercase fw-bold me-3">Tank No <span class="text-danger">*</span></label>
				<div class="input-group">
					<MaskInput v-model="dmccFormObj.tank_no" mask="AAAA-######-#" class="form-control" :readonly="tankNoVerified" textmode="uppercase"/>
					<span class="input-group-text" :class="tankNoVerified ? 'bg-success' : 'bg-danger'">
						<i class="ph ph-check text-white" v-if="tankNoVerified"></i>
						<i class="ph ph-x text-white" v-if="!tankNoVerified"></i>
					</span>
				</div>
				<template v-for="error of v$.dmccFormObj.tank_no.$errors" :key="error.$uid">
					<div class="mandatory mb-1">{{ error.$message }}</div>
				</template>
				<div class="col-md-4 mt-2" v-if="!tankNoVerified">
					<button type="button" class="btn btn-dark btn-sm" @click="verifyTankNumber()">VERIFY TANK NUMBER</button>
				</div>
				<div class="col-md-6 py-2" v-if="dmccFormObj.id == 0 && tankNoVerified">
					<label for="">Tank last used: <span v-if="lastThree && lastThree.length > 0">On {{  lastThree.join(", ") }}</span><span v-else>Never</span></label>
				</div>
			</div>
		</div>
		<template v-if="tankNoVerified">
			<div class='row mb-4'>
				<div class="col-md-6">
					<label for="add_dmcc_company_id" class="form-label text-uppercase fw-bold me-3">Company Name</label>
					<div>
						<multiselect v-model="dmccFormObj.company_id" :options="allCompanyIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					
				</div>
				<div class="col-md-6">
					<label for="add_dmcc_inspection_date" class="form-label text-uppercase fw-bold me-3">Date of Loading</label>
					<div class="input-group">
						<input type="text" class="form-control"  v-model="dmccFormObj.inspection_date" id="add_dmcc_inspection_date" placeholder="Enter Date of Loading" >
					</div>
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col-12 mb-3">
					<label for="add_dmcc_loading_of" class="form-label text-uppercase fw-bold me-3">Loading Of</label>
					<div class="input-group">
						<input type="text" class="form-control"  v-model="dmccFormObj.loading_of" id="add_dmcc_loading_of" placeholder="Enter Loading Of" >
					</div>
				</div>
				<div class="col-12">
					<p class="text-uppercase fw-bold m-0">Tank under Nitrogen pressure and all Seals intact</p>
				</div>
				<div class="col-md-6 mb-3">
					<label for="add_dmcc_seals_intact_time" class="form-label text-uppercase fw-bold me-3">Time</label>
					<div class="input-group">
						<input type="text" class="form-control"  v-model="dmccFormObj.seals_intact_time" id="add_dmcc_seals_intact_time" placeholder="Enter Time" >
					</div>
					
				</div>
				<div class="col-md-6">
					<label for="add_dmcc_seals_intact_remark" class="form-label text-uppercase fw-bold me-3">Remark</label>
					<div class="input-group">
						<input type="text" class="form-control"  v-model="dmccFormObj.seals_intact_remark" id="add_dmcc_seals_intact_remark" placeholder="Enter Remark" >
					</div>
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_seals_broken" class="form-label text-uppercase fw-bold me-3">All Seals broken</label>
					<div class="input-group">
						<input type="text" class="form-control"  v-model="dmccFormObj.seals_broken" id="add_dmcc_seals_broken" placeholder="Enter Seals Broken" >
					</div>
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_pretrip_inspection_qc" class="form-label text-uppercase fw-bold me-3">Pre‐trip inspection by Quality officer carried out</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.pretrip_inspection_qc" id="add_dmcc_pretrip_inspection_qc" placeholder="Enter Pretrip Inspection Qc" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_bottom_valve_checked" class="form-label text-uppercase fw-bold me-3">Bottom discharge valve operated and checked for any leakage of Nitrogen by QC.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.bottom_valve_checked" id="add_dmcc_bottom_valve_checked" placeholder="Enter Bottom Valve Checked" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_n2_released_dn40" class="form-label text-uppercase fw-bold me-3">Nitrogen from Container released by opening DN40 Airline Valve by QC.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.n2_released_dn40" id="add_dmcc_n2_released_dn40" placeholder="Enter N2 Released Dn40" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_emergency_remote_checked" class="form-label text-uppercase fw-bold me-3">Operation of Emergency Remote cable checked by QC.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.emergency_remote_checked" id="add_dmcc_emergency_remote_checked" placeholder="Enter Emergency Remote Checked" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_manlid_checked" class="form-label text-uppercase fw-bold me-3">Manlid opened and Tank checked for any moisture or smell by QC.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.manlid_checked" id="add_dmcc_manlid_checked" placeholder="Enter Manlid Checked" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_manlid_valve_closed" class="form-label text-uppercase fw-bold me-3">Manlid and Bottom discharge valve closed by QC.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.manlid_valve_closed" id="add_dmcc_manlid_valve_closed" placeholder="Enter Manlid Valve Closed" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_tank_cleared_for_purging" class="form-label text-uppercase fw-bold me-3">Tank cleared for Nitrogen purging.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.tank_cleared_for_purging" id="add_dmcc_tank_cleared_for_purging" placeholder="Enter Tank Cleared For Purging" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_dn80_connector_fitted" class="form-label text-uppercase fw-bold me-3">Blind Flange of DN80 Butterfly Top Valve removed and special connector fitted.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.dn80_connector_fitted" id="add_dmcc_dn80_connector_fitted" placeholder="Enter Dn80 Connector Fitted" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_n2_purged_1" class="form-label text-uppercase fw-bold me-3">N2 purged up to 0.5 bar pressure through DN40 Airline Valve. ( 1st Time)</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.n2_purged_1" id="add_dmcc_n2_purged_1" placeholder="Enter N2 Purged 1" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_n2_released_1" class="form-label text-uppercase fw-bold me-3">N2 pressure released from DN 40 Airline Valve. (1st Time)</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.n2_released_1" id="add_dmcc_n2_released_1" placeholder="Enter N2 Released 1" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_n2_purged_2" class="form-label text-uppercase fw-bold me-3">N2 purged up to 0.5 bar pressure through DN40 Airline Valve. ( 2nd Time)</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.n2_purged_2" id="add_dmcc_n2_purged_2" placeholder="Enter N2 Purged 2" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_n2_released_2" class="form-label text-uppercase fw-bold me-3">N2 pressure released from DN 40 Airline Valve. (2ndTime)</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.n2_released_2" id="add_dmcc_n2_released_2" placeholder="Enter N2 Released 2" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_n2_purged_3" class="form-label text-uppercase fw-bold me-3">N2 purged up to 0.5 bar pressure through DN40 Airline Valve. (3rd Time)</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.n2_purged_3" id="add_dmcc_n2_purged_3" placeholder="Enter N2 Purged 3" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_n2_released_3" class="form-label text-uppercase fw-bold me-3">N2 pressure released from DN 40 Airline Valve. (3rdTime)</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.n2_released_3" id="add_dmcc_n2_released_3" placeholder="Enter N2 Released 3" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_qc_permission_granted" class="form-label text-uppercase fw-bold me-3">Permission of QC Manager for starting loading BSCL accorded.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.qc_permission_granted" id="add_dmcc_qc_permission_granted" placeholder="Enter Qc Permission Granted" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_bscl_pumping_started" class="form-label text-uppercase fw-bold me-3">Pumping of BSCL started & filling commenced through Special Connector.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.bscl_pumping_started" id="add_dmcc_bscl_pumping_started" placeholder="Enter Bscl Pumping Started" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_dn40_opened_during_loading" class="form-label text-uppercase fw-bold me-3">DN40 Airline Valve opened soon after commencing of loading to avoid building of undue pressure in Tank</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.dn40_opened_during_loading" id="add_dmcc_dn40_opened_during_loading" placeholder="Enter Dn40 Opened During Loading" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_loading_completed_dn40_closed" class="form-label text-uppercase fw-bold me-3">Loading completed, pump stopped and DN 40 Airline Valve closed.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.loading_completed_dn40_closed" id="add_dmcc_loading_completed_dn40_closed" placeholder="Enter Loading Completed Dn40 Closed" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_butterfly_valve_closed" class="form-label text-uppercase fw-bold me-3">Butterfly Valve Closed & Special Connector removed from DN80 Butterfly Top Discharge Valve.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.butterfly_valve_closed" id="add_dmcc_butterfly_valve_closed" placeholder="Enter Butterfly Valve Closed" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_cargo_sample_removed" class="form-label text-uppercase fw-bold me-3">BSCL cargo sample removed through Blind Flange opening.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.cargo_sample_removed" id="add_dmcc_cargo_sample_removed" placeholder="Enter Cargo Sample Removed" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_butterfly_valve_reclosed" class="form-label text-uppercase fw-bold me-3">Butterfly Valve of DN 80 Top Valve closed and Blind Flange fitted back.</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.butterfly_valve_reclosed" id="add_dmcc_butterfly_valve_reclosed" placeholder="Enter Butterfly Valve Reclosed" >
						
					</div>
					
				</div>
				<div class="col-12 mb-3">
					<label for="add_dmcc_n2_purged_final" class="form-label text-uppercase fw-bold me-3">On completion of Cargo stuffing, N2 purged through DN40 Airline Valve in Tank: Nitrogen blanket pressure (0.5 bar).</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.n2_purged_final" id="add_dmcc_n2_purged_final" placeholder="Enter N2 Purged Final" >
						
					</div>
					
				</div>
				<div class="col-12">
					<label for="add_dmcc_final_inspection_done" class="form-label text-uppercase fw-bold me-3">After loading inspection completed by QC officer & Loading Operation Completed</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="dmccFormObj.final_inspection_done" id="add_dmcc_final_inspection_done" placeholder="Enter Final Inspection Done" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4 g-3'>
				<div class="col-md-6">
					<label for="add_dmcc_n2_cylinder_nos" class="form-label text-uppercase fw-bold me-3">N2 Cylinder Nos</label>
					<div class="input-group">
						<input type="text" class="form-control"  v-model="dmccFormObj.n2_cylinder_nos" id="add_dmcc_n2_cylinder_nos" placeholder="Enter N2 Cylinder Nos" >
					</div>
				</div>
				<div class="col-md-6">
					<label for="add_dmcc_total_no_cylinder" class="form-label text-uppercase fw-bold me-3">Total No. of N2 Cylinder consumed</label>
					<div class="input-group">
						<input type="text" class="form-control"  v-model="dmccFormObj.total_no_cylinder" id="add_dmcc_total_no_cylinder" placeholder="Enter Total No Cylinder" >
					</div>
				</div>
				<div class="col-md-6">
					<label for="add_dmcc_bscl_rep" class="form-label text-uppercase fw-bold me-3">M/S BSCL Rep</label>
					<div class="input-group">
						<input type="text" class="form-control"  v-model="dmccFormObj.bscl_rep" id="add_dmcc_bscl_rep" placeholder="Enter Bscl Rep" >
					</div>
				</div>
				<div class="col-md-6">
					<label for="add_dmcc_surveyor_id" class="form-label text-uppercase fw-bold me-3">Surveyor Name</label>
					<div>
						<multiselect v-model="dmccFormObj.surveyor_id" :options="allSurveyorIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					
				</div>
			</div>
		</template>
		<div class="row justify-content-center" v-if="tankNoVerified">
			<div class="col-5">
				<a class="btn btn-success w-100" @click="saveDmcc()">Save</a>
			</div>
		</div>
	</div>
</template>
<script>
import { useVuelidate } from '@vuelidate/core';
import { required, minValue, alphaNum, numeric, email, requiredIf, minLength,maxLength, decimal, url } from '@vuelidate/validators';
function initialState(){
	return {
		id:0,
		tank_no:'',
		company_id:'',
		inspection_date:'',
		loading_of:'',
		seals_intact_time:'',
		seals_intact_remark:'',
		seals_broken:'',
		pretrip_inspection_qc:'',
		bottom_valve_checked:'',
		n2_released_dn40:'',
		emergency_remote_checked:'',
		manlid_checked:'',
		manlid_valve_closed:'',
		tank_cleared_for_purging:'',
		dn80_connector_fitted:'',
		n2_purged_1:'',
		n2_released_1:'',
		n2_purged_2:'',
		n2_released_2:'',
		n2_purged_3:'',
		n2_released_3:'',
		qc_permission_granted:'',
		bscl_pumping_started:'',
		dn40_opened_during_loading:'',
		loading_completed_dn40_closed:'',
		butterfly_valve_closed:'',
		cargo_sample_removed:'',
		butterfly_valve_reclosed:'',
		n2_purged_final:'',
		final_inspection_done:'',
		n2_cylinder_nos:'',
		total_no_cylinder:'',
		bscl_rep:'',
		surveyor_id:'',
		deleted_at:'',
		created_at:'',
		updated_at:'',
		reload: false,
		closed: false,
		action: ''
	};
}
function initialStateValidations() {
	return {
		tank_no: {required, minLengthValue: minLength(1)},
	}
}
export default {
	name: "Dmccmaster",
	props: ['current_user_id', 'all_permissions','id', 'isModal', 'dmccForAdd', 'reload', 'closed'],
	setup() {
		return {
			v$: useVuelidate()
		}
	},
	data(){
		return{
			addEditModal: null,
			currentUser: siteUserObject,
			imageId: 0,
			allCompanyIdList: [],
			allSurveyorIdList: [],
			dmccFormObj: initialState(),
			tankNoVerified: false,
		}
	},
	validations() {
		return {
			dmccFormObj: initialStateValidations()
		};
	},
	methods: {
		canceladdedit(event){
			window.location = this.docRoot + '/dmcc';
		},
		formatDate(date) {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
		async saveDmcc(event){
			var that = this;
			const result = await that.v$.$validate();
			if (!result) {
				that.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
				console.log(that.v$.$errors);
				return;
			}
			
			if( !that.dmccFormObj.action || that.dmccFormObj.action == "" )
				that.dmccFormObj.action = "details";
			that.dmccFormObj.created_by = that.current_user_id;
			
			if (  typeof that.dmccFormObj.company_id === 'object' && that.dmccFormObj.company_id.id) {
				that.dmccFormObj.company_id = that.dmccFormObj.company_id.id;
			}
			if (  typeof that.dmccFormObj.surveyor_id === 'object' && that.dmccFormObj.surveyor_id.id) {
				that.dmccFormObj.surveyor_id = that.dmccFormObj.surveyor_id.id;
			}
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/dmcc/save', { dmcc: that.dmccFormObj }).then(async function (response) {
				that.closeSwal();
				var status = response.data.status;
				if( status == 1 ){
					// Set the ID so that duplicate records will not be created
					that.dmccFormObj.id = response.data.id;
					that.showToast('Dmcc saved successfully', 'success', 'bottom', 3000);
					setTimeout(() => {
						window.location = that.docRoot + "/dmcc/";
						that.showLoading("Loading ...");
					}, 1500);
				}
				else{
					that.showErrors("Dmcc could not be saved successfully.", response.data.messages, "bottom", 3000);
				}
			})
			.catch(function (error) {
				console.log(error);
				that.closeSwal();
				that.showToast("Dmcc could not be saved successfully.", "error", "bottom", 3000);
			});
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				this.mode = "edit";
				// This is Edit mode - fetch inquiry data
				var that = this;
				that.tankNoVerified = false;
				var URL = this.docRoot + "/api/dmcc/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.dmccFormObj = Object.assign({}, response.data);
					})
					.catch(function (error) {
						console.log(error);
					});
			}
		},
		displayLabelSetting ({id, text}) {
			return `${text}`;
		},
		verifyTankNumber() {
			var that = this;
			that.tankNoVerified = false;
			that.showLoading("Verifying ...");
			axios
				.post(that.docRoot + "/dmcc/verify-tank-number", { tankNo: that.dmccFormObj.tank_no })
				.then(async function (response) {
					that.closeSwal();
					console.log(response);
					var status = response.data.status;
					if (status == 1){
						that.tankNoVerified = true;
						if (response.data.hasOwnProperty("lastthree") && response.data.lastthree.length > 0) {
							let arrLastThree = response.data.lastthree;
							that.lastThree = arrLastThree.filter((item, index) => arrLastThree.indexOf(item) === index);
						}
					}
					else {
						that.tankNoVerified = false;
						that.showErrors(response.data.message, "error", "bottom", 3000);
					}
				});
		}
	},
	async mounted() {
		if (this.id > 0){
			this.reloadEverything();
		}
		let _allCompanyIdList = await this.loadAllCompany(this.docRoot+'/api/company/get', 'post', {});
		if(Array.isArray(_allCompanyIdList) && _allCompanyIdList.length > 0){
			this.allCompanyIdList = _allCompanyIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/api/surveyor/get', 'post', {});
		if(Array.isArray(_allSurveyorIdList) && _allSurveyorIdList.length > 0){
			this.allSurveyorIdList = _allSurveyorIdList.map(x => {return { id: x.id, text: x.name }});
		}
		if (this.dmccFormObj.company_id) {
			if (Array.isArray(this.allCompanyIdList) && this.allCompanyIdList.length > 0) {
				let _allRelationList = this.allCompanyIdList;
				let relationId = parseInt(this.dmccFormObj.company_id);
				this.dmccFormObj.company_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.dmccFormObj.surveyor_id) {
			if (Array.isArray(this.allSurveyorIdList) && this.allSurveyorIdList.length > 0) {
				let _allRelationList = this.allSurveyorIdList;
				let relationId = parseInt(this.dmccFormObj.surveyor_id);
				this.dmccFormObj.surveyor_id = _allRelationList.find(item => item.id === relationId);
			}
		}
	}
}
</script>