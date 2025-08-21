<template>
	<div id="prv-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_prv_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/prv'" role="button"><i class="ph ph-arrow-left "></i>Back to list</a>
					<h4 class="m-0 text-capitalize">Add PRV Calibration</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_prv_ref" class="form-label text-uppercase fw-bold me-3">Ref</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="prvFormObj.ref" id="add_prv_ref" placeholder="Enter Ref" disabled>
				</div>
			</div>
			<div class="col">
				<label for="add_prv_date_of_issue" class="form-label text-uppercase fw-bold me-3">Date Of Issue</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="prvFormObj.date_of_issue" id="add_prv_date_of_issue" placeholder="Enter Date Of Issue" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_prv_customer_id" class="form-label text-uppercase fw-bold me-3">Company name</label>
				<div>
					<multiselect v-model="prvFormObj.company_id" :options="allCompanyIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
			</div>
			<div class="col">
				<label for="add_prv_customer_id" class="form-label text-uppercase fw-bold me-3">Customer Name</label>
				<div>
					<multiselect v-model="prvFormObj.customer_id" :options="allCustomerIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
			</div>
			<div class="col">
				<label for="add_prv_inspection_location_id" class="form-label text-uppercase fw-bold me-3">Inspection Location Id</label>
				<div>
					<multiselect v-model="prvFormObj.inspection_location_id" :options="allInspectionLocationIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_prv_address" class="form-label text-uppercase fw-bold me-3">Address</label>
				<div>
					<textarea class="form-control" v-model="prvFormObj.address" rows="3" id="add_prv_address" placeholder="Enter Address"></textarea>
				</div>
			</div>

		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_prv_tank_no" class="form-label text-uppercase fw-bold me-3">Tank No</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="prvFormObj.tank_no" id="add_prv_tank_no" placeholder="Enter Tank No" >
				</div>
			</div>
			<div class="col">
				<label for="add_prv_inspection_date" class="form-label text-uppercase fw-bold me-3">Inspection Date</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="prvFormObj.inspection_date" id="add_prv_inspection_date" placeholder="Enter Inspection Date" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_prv_address_2" class="form-label text-uppercase fw-bold me-3">Address</label>
				<div>
					<textarea class="form-control" v-model="prvFormObj.address_2" rows="3" id="add_prv_address_2" placeholder="Enter Address"></textarea>
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_prv_mfg" class="form-label text-uppercase fw-bold me-3">Manufacturer</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="prvFormObj.mfg" id="add_prv_mfg" placeholder="Enter Manufacturer" >
				</div>
			</div>
			<div class="col">
				<label for="add_prv_serial_no" class="form-label text-uppercase fw-bold me-3">Serial No</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="prvFormObj.serial_no" id="add_prv_serial_no" placeholder="Enter Serial No" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_prv_full_flow_rate" class="form-label text-uppercase fw-bold me-3">Full Flow Rate</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="prvFormObj.full_flow_rate" id="add_prv_full_flow_rate" placeholder="Enter Full Flow Rate" >
				</div>
			</div>
			<div class="col">
				<label for="add_prv_op" class="form-label text-uppercase fw-bold me-3">Op</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="prvFormObj.op" id="add_prv_op" placeholder="Enter Op" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_prv_vaccum_set" class="form-label text-uppercase fw-bold me-3">Vaccum Set</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="prvFormObj.vaccum_set" id="add_prv_vaccum_set" placeholder="Enter Vaccum Set" >
				</div>
			</div>
			<div class="col">
				<label for="add_prv_bursting_disc" class="form-label text-uppercase fw-bold me-3">Bursting Disc</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="prvFormObj.bursting_disc" id="add_prv_bursting_disc" placeholder="Enter Bursting Disc" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-4">
				<label for="add_prv_surveyor_id" class="form-label text-uppercase fw-bold me-3">Surveyor Name</label>
				<div>
					<multiselect v-model="prvFormObj.surveyor_id" :options="allSurveyorIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
			</div>
		</div>
		<div class="row justify-content-center" v-if="!isModal">
			<div class="col-5">
				<a class="btn btn-success w-100" @click="savePrv()">Save</a>
			</div>
		</div>
	</div>
</template>
<script>
import { useVuelidate } from '@vuelidate/core';
function initialState(){
	return {
		id:0,
		ref:'AUTOGENERATED',
		date_of_issue:'',
		company_id:'',
		customer_id:'',
		inspection_location_id:'',
		address:'',
		tank_no:'',
		inspection_date:'',
		address_2:'',
		mfg:'',
		serial_no:'',
		full_flow_rate:'',
		op:'',
		vaccum_set:'',
		bursting_disc:'',
		surveyor_id:'',
		created_at:'',
		updated_at:'',
		reload: false,
		closed: false,
		action: ''
	};
}
export default {
	name: "Prvmaster",
	props: ['current_user_id', 'all_permissions','id', 'isModal', 'prvForAdd', 'reload', 'closed'],
	data(){
		return{
			addEditModal: null,
			currentUser: siteUserObject,
			imageId: 0,
			allCustomerIdList: [],
			allInspectionLocationIdList: [],
			allSurveyorIdList: [],
			allCompanyIdList:[],
			prvFormObj: initialState(),
		}
	},
	
	methods: {
		canceladdedit(event){
			window.location = this.docRoot + '/prv';
		},
		formatDate(date) {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
		async savePrv(event){
			var that = this;
			if( !that.prvFormObj.action || that.prvFormObj.action == "" )
				that.prvFormObj.action = "details";
			that.prvFormObj.created_by = that.current_user_id;

			if (  typeof that.prvFormObj.company_id === 'object' && that.prvFormObj.company_id.id) {
				that.prvFormObj.company_id = that.prvFormObj.company_id.id;
			}
			if ( that.prvFormObj.customer_id != 'null' && typeof that.prvFormObj.customer_id === 'object' && that.prvFormObj.customer_id.id) {
				that.prvFormObj.customer_id = that.prvFormObj.customer_id.id;
			}
			if ( that.prvFormObj.inspection_location_id != 'null' && typeof that.prvFormObj.inspection_location_id === 'object' && that.prvFormObj.inspection_location_id.id) {
				that.prvFormObj.inspection_location_id = that.prvFormObj.inspection_location_id.id;
			}
			if ( that.prvFormObj.surveyor_id != 'null' && typeof that.prvFormObj.surveyor_id === 'object' && that.prvFormObj.surveyor_id.id) {
				that.prvFormObj.surveyor_id = that.prvFormObj.surveyor_id.id;
			}
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/prv/save', { prv: that.prvFormObj }).then(async function (response) {
				that.closeSwal();
				var status = response.data.status;
				if( status == 1 ){
					// Set the ID so that duplicate records will not be created
					that.prvFormObj.id = response.data.id;
					that.showToast('Prv saved successfully', 'success', 'bottom', 3000);
					setTimeout(() => {
						window.location = that.docRoot + "/prv/";
						that.showLoading("Loading ...");
					}, 1500);
				}
				else{
					that.showErrors("Prv could not be saved successfully.", response.data.messages, "bottom", 3000);
				}
			})
			.catch(function (error) {
				console.log(error);
				that.closeSwal();
				that.showToast("Prv could not be saved successfully.", "error", "bottom", 3000);
			});
		},
		
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				this.mode = "edit";
				
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/prv/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.prvFormObj = Object.assign({}, response.data);
					})
					.catch(function (error) {
						console.log(error);
					});
			}
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
		let _allCustomerIdList = await this.loadAllCustomer(this.docRoot+'/api/customer/get', 'post', {});
		if(Array.isArray(_allCustomerIdList) && _allCustomerIdList.length > 0){
			this.allCustomerIdList = _allCustomerIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/api/inspectionlocation/get', 'post', {});
		if(Array.isArray(_allInspectionLocationIdList) && _allInspectionLocationIdList.length > 0){
			this.allInspectionLocationIdList = _allInspectionLocationIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/api/surveyor/get', 'post', {});
		if(Array.isArray(_allSurveyorIdList) && _allSurveyorIdList.length > 0){
			this.allSurveyorIdList = _allSurveyorIdList.map(x => {return { id: x.id, text: x.name }});
		}
		if (this.prvFormObj.customer_id) {
			if (Array.isArray(this.allCustomerIdList) && this.allCustomerIdList.length > 0) {
				let _allRelationList = this.allCustomerIdList;
				let relationId = parseInt(this.prvFormObj.customer_id);
				this.prvFormObj.customer_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.prvFormObj.inspection_location_id) {
			if (Array.isArray(this.allInspectionLocationIdList) && this.allInspectionLocationIdList.length > 0) {
				let _allRelationList = this.allInspectionLocationIdList;
				let relationId = parseInt(this.prvFormObj.inspection_location_id);
				this.prvFormObj.inspection_location_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.prvFormObj.surveyor_id) {
			if (Array.isArray(this.allSurveyorIdList) && this.allSurveyorIdList.length > 0) {
				let _allRelationList = this.allSurveyorIdList;
				let relationId = parseInt(this.prvFormObj.surveyor_id);
				this.prvFormObj.surveyor_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.prvFormObj.company_id) {
			if (Array.isArray(this.allCompanyIdList) && this.allCompanyIdList.length > 0) {
				let _allRelationList = this.allCompanyIdList;
				let relationId = parseInt(this.prvFormObj.company_id);
				this.prvFormObj.company_id = _allRelationList.find(item => item.id === relationId);
			}
		}
	}
}
</script>
