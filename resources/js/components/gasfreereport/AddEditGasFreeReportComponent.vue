<template>
	<div id="gasfreereport-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_gasfreereport_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/gasfreereport'" role="button"><i class="ph ph-arrow-left "></i>Back to list</a>
					<h4 class="m-0 text-capitalize">Add gasfreereport</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label for="add_gasfreereport_tank_no" class="form-label text-uppercase fw-bold me-3">Tank No <span class="text-danger">*</span></label>
				<div class="input-group">
					<MaskInput v-model="gasfreereportFormObj.tank_no" mask="AAAA-######-#" class="form-control" :readonly="tankNoVerified" textmode="uppercase"/>
					<span class="input-group-text" :class="tankNoVerified ? 'bg-success' : 'bg-danger'">
						<i class="ph ph-check text-white" v-if="tankNoVerified"></i>
						<i class="ph ph-x text-white" v-if="!tankNoVerified"></i>
					</span>
				</div>
				<template v-for="error of v$.gasfreereportFormObj.tank_no.$errors" :key="error.$uid">
					<div class="mandatory mb-1">{{ error.$message }}</div>
				</template>
				<div class="col-md-4 mt-2" v-if="!tankNoVerified">
					<button type="button" class="btn btn-dark btn-sm" @click="verifyTankNumber()">VERIFY TANK NUMBER</button>
				</div>
				<div class="col-md-6 py-2" v-if="gasfreereportFormObj.id == 0 && tankNoVerified">
					<label for="">Tank last used: <span v-if="lastThree && lastThree.length > 0">On {{  lastThree.join(", ") }}</span><span v-else>Never</span></label>
				</div>
			</div>
		</div>
		<template v-if="tankNoVerified">
			<div class='row mb-4 g-3'>
				<div class="col-md-6">
					<label for="add_gasfreereport_company_id" class="form-label text-uppercase fw-bold me-3">Company Id</label>
					<div>
						<multiselect v-model="gasfreereportFormObj.company_id" :options="allCompanyIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					
				</div>
				<div class="col-md-6">
					<label for="add_gasfreereport_type" class="form-label text-uppercase fw-bold me-3">Type</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.type" id="add_gasfreereport_type" placeholder="Enter Type" >
						
					</div>
					
				</div>
				<div class="col-md-6">
					<label for="add_gasfreereport_ref_no" class="form-label text-uppercase fw-bold me-3">Ref</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.ref_no" id="add_gasfreereport_ref_no" placeholder="Enter Ref No" disabled>
						
					</div>
					
				</div>
				<div class="col-md-6">
					<label for="add_gasfreereport_csc_no" class="form-label text-uppercase fw-bold me-3">CSC No</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.csc_no" id="add_gasfreereport_csc_no" placeholder="Enter Csc No" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_gasfreereport_mfg" class="form-label text-uppercase fw-bold me-3">MFG</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.mfg" id="add_gasfreereport_mfg" placeholder="Enter Mfg" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_ned" class="form-label text-uppercase fw-bold me-3">NED</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.ned" id="add_gasfreereport_ned" placeholder="Enter Ned" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_mgw" class="form-label text-uppercase fw-bold me-3">MGW</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.mgw" id="add_gasfreereport_mgw" placeholder="Enter Mgw" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_gasfreereport_tare_wt" class="form-label text-uppercase fw-bold me-3">Tare Wt</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.tare_wt" id="add_gasfreereport_tare_wt" placeholder="Enter Tare Wt" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_capacity" class="form-label text-uppercase fw-bold me-3">Capacity</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.capacity" id="add_gasfreereport_capacity" placeholder="Enter Capacity" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_inspection_date" class="form-label text-uppercase fw-bold me-3">Inspection Date</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.inspection_date" id="add_gasfreereport_inspection_date" placeholder="Enter Inspection Date" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_gasfreereport_inspection_location_id" class="form-label text-uppercase fw-bold me-3">Inspection Location</label>
					<div>
						<multiselect v-model="gasfreereportFormObj.inspection_location_id" :options="allInspectionLocationIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_customer_id" class="form-label text-uppercase fw-bold me-3">Customer Name</label>
					<div>
						<multiselect v-model="gasfreereportFormObj.customer_id" :options="allCustomerIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_last_cargo_carried" class="form-label text-uppercase fw-bold me-3">Last Cargo Carried</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.last_cargo_carried" id="add_gasfreereport_last_cargo_carried" placeholder="Enter Last Cargo Carried" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_gasfreereport_lel_inst" class="form-label text-uppercase fw-bold me-3">LEL Inst Make</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.lel_inst" id="add_gasfreereport_lel_inst" placeholder="Enter Lel Inst" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_lel_sr_no" class="form-label text-uppercase fw-bold me-3">Sr No</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.lel_sr_no" id="add_gasfreereport_lel_sr_no" placeholder="Enter Sr No" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_gasfreereport_calibration_validity_dt" class="form-label text-uppercase fw-bold me-3">Calibration Validity Dt</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.calibration_validity_dt" id="add_gasfreereport_calibration_validity_dt" placeholder="Enter Calibration Validity Dt" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_calibration_sr_no" class="form-label text-uppercase fw-bold me-3">Sr No</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.calibration_sr_no" id="add_gasfreereport_calibration_sr_no" placeholder="Enter Sr No" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_gasfreereport_oxygen_mtr" class="form-label text-uppercase fw-bold me-3">Oxygen Mtr Make</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.oxygen_mtr" id="add_gasfreereport_oxygen_mtr" placeholder="Enter Oxygen Mtr" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_oxy_calibration_validity" class="form-label text-uppercase fw-bold me-3">Calibration Validity Dt</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.oxy_calibration_validity" id="add_gasfreereport_oxy_calibration_validity" placeholder="Enter Oxy Calibration Validity" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col-12">
					<p class="m-0">Function test performed in air before actual space measurement and registered readings:</p>
				</div>
				<div class="col">
					<label for="add_gasfreereport_in_air_lel" class="form-label text-uppercase fw-bold me-3">LEL</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.in_air_lel" id="add_gasfreereport_in_air_lel" placeholder="Enter Lel" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_in_air_oxygen" class="form-label text-uppercase fw-bold me-3">Oxygen</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.in_air_oxygen" id="add_gasfreereport_in_air_oxygen" placeholder="Enter In Air Oxygen" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col-12">
					<p class="m-0">Test Performed in actual space and registered readings:</p>
				</div>
				<div class="col">
					<label for="add_gasfreereport_in_space_lel" class="form-label text-uppercase fw-bold me-3">LEL</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.in_space_lel" id="add_gasfreereport_in_space_lel" placeholder="Enter In Space Lel" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_in_space_oxygen" class="form-label text-uppercase fw-bold me-3">Oxygen</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.in_space_oxygen" id="add_gasfreereport_in_space_oxygen" placeholder="Enter In Space Oxygen" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col-12">
					<p class="m-0">Instrument did react to hydrocarbon vapour:</p>
				</div>
				<div class="col">
					<label for="add_gasfreereport_reacted_to_hydrocarbon" class="form-label text-uppercase fw-bold me-3">Reacted To Hydrocarbon</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.reacted_to_hydrocarbon" id="add_gasfreereport_reacted_to_hydrocarbon" placeholder="Enter Reacted To Hydrocarbon" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_alarmed_at" class="form-label text-uppercase fw-bold me-3">Alarmed At</label>
					<div class="input-group">
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.alarmed_at" id="add_gasfreereport_alarmed_at" placeholder="Enter Alarmed At" >
					</div>
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_gasfreereport_tank_is_gas_free" class="form-label text-uppercase fw-bold me-3">Tank Is Gas Free</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="gasfreereportFormObj.tank_is_gas_free" id="add_gasfreereport_tank_is_gas_free" placeholder="Enter Tank Is Gas Free" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_gasfreereport_surveyor_id" class="form-label text-uppercase fw-bold me-3">Surveyor Id</label>
					<div>
						<multiselect v-model="gasfreereportFormObj.surveyor_id" :options="allSurveyorIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					
				</div>
			</div>
		</template>
		<div class="row justify-content-center" v-if="tankNoVerified">
			<div class="col-5">
				<a class="btn btn-success w-100" @click="saveGasFreeReport()">Save</a>
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
		type:'',
		ref_no:'AUTOGENERATED',
		csc_no:'',
		mfg:'',
		ned:'',
		mgw:'',
		tare_wt:'',
		capacity:'',
		inspection_date:'',
		inspection_location_id:'',
		customer_id:'',
		last_cargo_carried:'',
		lel_inst:'',
		lel_sr_no:'',
		calibration_validity_dt:'',
		calibration_sr_no:'',
		oxygen_mtr:'',
		oxy_calibration_validity:'',
		in_air_lel:'',
		in_air_oxygen:'',
		in_space_lel:'',
		in_space_oxygen:'',
		reacted_to_hydrocarbon:'',
		alarmed_at:'',
		tank_is_gas_free:'',
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
	name: "GasFreeReportmaster",
	props: ['current_user_id', 'all_permissions','id', 'isModal', 'gasfreereportForAdd', 'reload', 'closed'],
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
			allInspectionLocationIdList: [],
			allCustomerIdList: [],
			allSurveyorIdList: [],
			gasfreereportFormObj: initialState(),
			tankNoVerified: false,
		}
	},
	validations() {
		return {
			gasfreereportFormObj: initialStateValidations()
		};
	},
	
	methods: {
		canceladdedit(event){
			window.location = this.docRoot + '/gasfreereport';
		},
		formatDate(date) {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
		async saveGasFreeReport(event){
			var that = this;
			const result = await that.v$.$validate();
			if (!result) {
				that.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
				console.log(that.v$.$errors);
				return;
			}
			if( !that.gasfreereportFormObj.action || that.gasfreereportFormObj.action == "" )
				that.gasfreereportFormObj.action = "details";
			that.gasfreereportFormObj.created_by = that.current_user_id;
			
			if (  typeof that.gasfreereportFormObj.company_id === 'object' && that.gasfreereportFormObj.company_id.id) {
				that.gasfreereportFormObj.company_id = that.gasfreereportFormObj.company_id.id;
			}
			if (  typeof that.gasfreereportFormObj.inspection_location_id === 'object' && that.gasfreereportFormObj.inspection_location_id.id) {
				that.gasfreereportFormObj.inspection_location_id = that.gasfreereportFormObj.inspection_location_id.id;
			}
			if (  typeof that.gasfreereportFormObj.customer_id === 'object' && that.gasfreereportFormObj.customer_id.id) {
				that.gasfreereportFormObj.customer_id = that.gasfreereportFormObj.customer_id.id;
			}
			if (  typeof that.gasfreereportFormObj.surveyor_id === 'object' && that.gasfreereportFormObj.surveyor_id.id) {
				that.gasfreereportFormObj.surveyor_id = that.gasfreereportFormObj.surveyor_id.id;
			}
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/gasfreereport/save', { gasfreereport: that.gasfreereportFormObj }).then(async function (response) {
				that.closeSwal();
				var status = response.data.status;
				if( status == 1 ){
					// Set the ID so that duplicate records will not be created
					that.gasfreereportFormObj.id = response.data.id;
					that.showToast('GasFreeReport saved successfully', 'success', 'bottom', 3000);
					setTimeout(() => {
						window.location = that.docRoot + "/gasfreereport/";
						that.showLoading("Loading ...");
					}, 1500);
				}
				else{
					that.showErrors("GasFreeReport could not be saved successfully.", response.data.messages, "bottom", 3000);
				}
			})
			.catch(function (error) {
				console.log(error);
				that.closeSwal();
				that.showToast("GasFreeReport could not be saved successfully.", "error", "bottom", 3000);
			});
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				this.mode = "edit";
				// This is Edit mode - fetch inquiry data
				var that = this;
				that.tankNoVerified = false;
				var URL = this.docRoot + "/api/gasfreereport/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.gasfreereportFormObj = Object.assign({}, response.data);
					})
					.catch(function (error) {
						console.log(error);
					});
			}
		},
		verifyTankNumber() {
			var that = this;
			that.tankNoVerified = false;
			that.showLoading("Verifying ...");
			axios
				.post(that.docRoot + "/gasfreereport/verify-tank-number", { tankNo: that.gasfreereportFormObj.tank_no })
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
		},
		displayLabelSetting ({id, text}) {
			return `${text}`;
		},
	},
	async mounted() {
		if (this.id > 0){
			this.reloadEverything();
		}
		let _allCompanyIdList = await this.loadAllCompany(this.docRoot+'/api/company/get', 'post', {});
		if(Array.isArray(_allCompanyIdList) && _allCompanyIdList.length > 0){
			this.allCompanyIdList = _allCompanyIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/api/inspectionlocation/get', 'post', {});
		if(Array.isArray(_allInspectionLocationIdList) && _allInspectionLocationIdList.length > 0){
			this.allInspectionLocationIdList = _allInspectionLocationIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allCustomerIdList = await this.loadAllCustomer(this.docRoot+'/api/customer/get', 'post', {});
		if(Array.isArray(_allCustomerIdList) && _allCustomerIdList.length > 0){
			this.allCustomerIdList = _allCustomerIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/api/surveyor/get', 'post', {});
		if(Array.isArray(_allSurveyorIdList) && _allSurveyorIdList.length > 0){
			this.allSurveyorIdList = _allSurveyorIdList.map(x => {return { id: x.id, text: x.name }});
		}
		if (this.gasfreereportFormObj.company_id) {
			if (Array.isArray(this.allCompanyIdList) && this.allCompanyIdList.length > 0) {
				let _allRelationList = this.allCompanyIdList;
				let relationId = parseInt(this.gasfreereportFormObj.company_id);
				this.gasfreereportFormObj.company_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.gasfreereportFormObj.inspection_location_id) {
			if (Array.isArray(this.allInspectionLocationIdList) && this.allInspectionLocationIdList.length > 0) {
				let _allRelationList = this.allInspectionLocationIdList;
				let relationId = parseInt(this.gasfreereportFormObj.inspection_location_id);
				this.gasfreereportFormObj.inspection_location_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.gasfreereportFormObj.customer_id) {
			if (Array.isArray(this.allCustomerIdList) && this.allCustomerIdList.length > 0) {
				let _allRelationList = this.allCustomerIdList;
				let relationId = parseInt(this.gasfreereportFormObj.customer_id);
				this.gasfreereportFormObj.customer_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.gasfreereportFormObj.surveyor_id) {
			if (Array.isArray(this.allSurveyorIdList) && this.allSurveyorIdList.length > 0) {
				let _allRelationList = this.allSurveyorIdList;
				let relationId = parseInt(this.gasfreereportFormObj.surveyor_id);
				this.gasfreereportFormObj.surveyor_id = _allRelationList.find(item => item.id === relationId);
			}
		}
	}
}
</script>
<style>
	.ql-container{height: 60px !important;}
</style>
