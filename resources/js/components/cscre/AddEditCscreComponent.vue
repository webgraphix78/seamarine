<template>
	<div id="cscre-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_cscre_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/cscre'" role="button"><i class="ph ph-arrow-left "></i>Back to list</a>
					<h4 class="m-0 text-capitalize">Add cscre</h4>
				</div>
			</div>
		</div>
		<div class="row py-2 bg-dark mb-3">
			<h4 class="fw-bold text-white text-center m-0">Add Record in the System.</h4>
		</div>
		<div class='row mb-4 align-items-center'>
			<label for="add_cscre_ref_no" class="form-label col-md-1 m-0">Ref No:</label>
			<div class="col-md-3">
				<input type="text" class="form-control"  v-model="cscreFormObj.ref_no" id="add_cscre_ref_no" placeholder="Auto Number" disabled>
			</div>
			<label for="add_cscre_company_id" class="form-label col-md-2 m-0">Company Name:</label>
			<div class="col-md-6">
				<multiselect v-model="cscreFormObj.company_id" :options="allCompanyIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label for="add_cscre_serial_no" class="form-label me-3">Serial No.</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscreFormObj.serial_no" id="add_cscre_serial_no" placeholder="Enter Serial No" >
				</div>
			</div>
			<div class="col-md-6">
				<label for="add_cscre_issue_date" class="form-label me-3">Date of Issue</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscreFormObj.issue_date" id="add_cscre_issue_date" placeholder="Enter Issue Date" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_cscre_customer_name" class="form-label me-3">Customer Name</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscreFormObj.customer_name" id="add_cscre_customer_name" placeholder="Enter Customer Name" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_cscre_of_name" class="form-label me-3">Company Name</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscreFormObj.company_name" id="add_cscre_company_name" placeholder="Enter Company Name" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_cscre_inspection_date" class="form-label me-3">Inspection Date</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscreFormObj.inspection_date" id="add_cscre_inspection_date" placeholder="Enter Inspection Date" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_cscre_inspection_location" class="form-label me-3">Inspection Location</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscreFormObj.inspection_location" id="add_cscre_inspection_location" placeholder="Enter Inspection Location" >
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-12">
				<label for="add_jointsurvey_address" class="form-label me-3">Address</label>
				<div>
					<input type="text" class="form-control" v-model="cscreFormObj.address" id="add_jointsurvey_address" placeholder="Enter the address" />
				</div>
			</div>
		</div>
		<p class="mb-2">General Structural Condition</p>
		<div class='row mb-4 align-items-center'>
			<label for="add_cscre_container_no" class="form-label col-md-3">Container No</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.container_no" id="add_cscre_container_no" placeholder="Enter Unit No" >
			</div>
		</div>
		<div class='row mb-4 align-items-center'>
			<label for="add_cscre_iso_type" class="form-label m-0 col-md-3">ISO Type (if applicable)</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.iso_type" id="add_cscre_iso_type" placeholder="Enter Iso Type" >
			</div>
		</div>
		<div class='row mb-4 align-items-center'>
			<label for="add_cscre_csc_approval_no" class="form-label m-0 col-md-3">Csc Certification Number</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.csc_approval_no" id="add_cscre_csc_approval_no" placeholder="Enter Csc Approval No" >
			</div>
		</div>
		<div class='row mb-4 align-items-center'>
			<label for="add_cscre_customs_no" class="form-label m-0 col-md-3">Customs/Transport No.</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.customs_no" id="add_cscre_customs_no" placeholder="Enter Customs/Transport No" >
			</div>
		</div>
		<div class='row mb-4 align-items-center'>
			<label for="add_cscre_mfg_type" class="form-label m-0 col-md-3">Manufacture Type</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.mfg_type" id="add_cscre_mfg_type" placeholder="Enter Mfg Serial No" >
			</div>
		</div>
		<div class='row mb-4 align-items-center'>
			<label for="add_cscre_mfg" class="form-label m-0 col-md-3">Manufacture</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.mfg" id="add_cscre_mfg" placeholder="Enter Mfg" >
			</div>
		</div>
		<div class='row mb-4 align-items-center'>
			<label for="add_cscre_mfg_date" class="form-label m-0 col-md-3">Manufacture Date:</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.mfg_date" id="add_cscre_mfg_date" placeholder="Enter Mfg Date" >
			</div>
		</div>
		<!-- <p class="mb-3">The above mentioned container was inspected in accordance with procedures set forth by The Convention of Safe Containers and found in satisfactory condition.<br>Note this inspection does not meet the requirements of any other regulatory body</p> -->
		<div class='row mb-4'>
			<label for="add_cscre_max_gross_weight" class="form-label m-0 col-md-3">Maximum Gross Weight – kg/lbs</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.max_gross_weight" id="add_cscre_max_gross_weight" placeholder="Enter Next Csc Inspection Date" >
			</div>
		</div>
		<div class='row mb-4'>
			<label for="add_cscre_tare_weight" class="form-label m-0 col-md-3">Tare Weight – kg/lbs</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.tare_weight" id="add_cscre_tare_weight" placeholder="Enter Tare Weight" >
			</div>
		</div>
		<div class='row mb-4'>
			<label for="add_cscre_stacking_weight" class="form-label m-0 col-md-3">Allowable Stacking Weight – kg/lbs</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.stacking_weight" id="add_cscre_stacking_weight" placeholder="Enter Stacking Weight" >
			</div>
		</div>
		<div class='row mb-4'>
			<label for="add_cscre_racking_test_force" class="form-label m-0 col-md-3">Transverse Racking Test Force – kg/lbs</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.racking_test_force" id="add_cscre_racking_test_force" placeholder="Enter Racking Test Force" >
			</div>
		</div>
		<div class='row mb-4'>
			<label for="add_cscre_csc_reinspection_date" class="form-label m-0 col-md-3">CSC re-examination is due before:</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.csc_reinspection_date" id="add_cscre_csc_reinspection_date" placeholder="Enter Csc Reinspection Date" >
			</div>
		</div>
		<div class="row mb-4">
			<label for="add_cscre_comments" class="form-label m-0 col-md-3">Comments</label>
			<div class="col-md-4">
				<div>
					<textarea class="form-control" v-model="cscreFormObj.comments" id="add_cscre_comments" placeholder="Enter Comments" rows="3"></textarea>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<label for="add_cscre_surveyor_name" class="form-label m-0 col-md-3">Survey Name</label>
			<div class="col-md-4">
				<input type="text" class="form-control"  v-model="cscreFormObj.surveyor_name" id="add_cscre_surveyor_name" placeholder="Enter Surveyor Name" >
			</div>
		</div>
		<div class="row justify-content-center" v-if="!isModal">
			<div class="col-5">
				<a class="btn btn-success w-100" @click="saveCscre()">Save</a>
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
		ref_no:'AUTOGENERATED',
		company_id:'',
		customer_name:'',
		serial_no:'',
		company_name:'',
		inspection_date:'',
		inspection_location:'',
		address:'',
		container_no:'',
		iso_type:'',
		csc_approval_no:'',
		mfg_type:'',
		mfg:'',
		mfg_date:'',
		customs_no:'',
		csc_reinspection_date:'',
		comments:'',
		surveyor_name:'',
		max_gross_weight:'',
		tare_weight:'',
		stacking_weight: '',
		racking_test_force:'',
		issue_date:'',
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
		
	}
}
export default {
	name: "Cscremaster",
	props: ['current_user_id', 'all_permissions','id', 'isModal', 'cscreForAdd', 'reload', 'closed'],
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
			cscreFormObj: initialState(),
		}
	},
	validations() {
		return {
			cscreFormObj: initialStateValidations()
		};
	},
	
	methods: {
		canceladdedit(event){
			window.location = this.docRoot + '/cscre';
		},
		formatDate(date) {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
		async saveCscre(event){
			var that = this;
			const result = await that.v$.$validate();
			if (!result) {
				that.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
				console.log(that.v$.$errors);
				return;
			}
			
			if( !that.cscreFormObj.action || that.cscreFormObj.action == "" )
				that.cscreFormObj.action = "details";
			that.cscreFormObj.created_by = that.current_user_id;
			
			if (  typeof that.cscreFormObj.company_id === 'object' && that.cscreFormObj.company_id.id) {
				that.cscreFormObj.company_id = that.cscreFormObj.company_id.id;
			}
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/cscre/save', { cscre: that.cscreFormObj }).then(async function (response) {
				that.closeSwal();
				var status = response.data.status;
				if( status == 1 ){
					// Set the ID so that duplicate records will not be created
					that.cscreFormObj.id = response.data.id;
					that.showToast('Cscre saved successfully', 'success', 'bottom', 3000);
					setTimeout(() => {
						window.location = that.docRoot + "/cscre/";
						that.showLoading("Loading ...");
					}, 1500);
				}
				else{
					that.showErrors("Cscre could not be saved successfully.", response.data.messages, "bottom", 3000);
				}
			})
			.catch(function (error) {
				console.log(error);
				that.closeSwal();
				that.showToast("Cscre could not be saved successfully.", "error", "bottom", 3000);
			});
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				this.mode = "edit";
				
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/cscre/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.cscreFormObj = Object.assign({}, response.data);
						
						
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
		let _allCompanyIdList = await this.loadAllCompany(this.docRoot + '/api/company/get', 'post', {});
		console.log(_allCompanyIdList);
		
		if(Array.isArray(_allCompanyIdList) && _allCompanyIdList.length > 0){
			this.allCompanyIdList = _allCompanyIdList.map(x => {return { id: x.id, text: x.name }});
		}
		if (this.cscreFormObj.company_id) {
			if (Array.isArray(this.allCompanyIdList) && this.allCompanyIdList.length > 0) {
				let _allRelationList = this.allCompanyIdList;
				let relationId = parseInt(this.cscreFormObj.company_id);
				this.cscreFormObj.company_id = _allRelationList.find(item => item.id === relationId);
			}
		}
	}
}
</script>
<style> .ql-container{height: 60px !important;} </style>
