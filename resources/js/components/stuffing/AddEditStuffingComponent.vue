<template>
	<div id="stuffing-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-12-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_stuffing_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/stuffing'" role="button"><i class="ph ph-arrow-left "></i>Back to list</a>
					<h4 class="m-0 text-capitalize">Add stuffing</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4 g-3'>
			<div class="col-12"></div>
			<div class="col-md-6">
				<label for="add_stuffing_ref_no" class="form-label text-uppercase fw-bold me-3">Reference No</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.ref_no" id="add_stuffing_ref_no" placeholder="Enter Ref No" disabled>
					
				</div>
				
			</div>
			<div class="col-md-6">
				<label for="add_stuffing_company_id" class="form-label text-uppercase fw-bold me-3">Company Name</label>
				<div>
					<multiselect v-model="stuffingFormObj.company_id" :options="allCompanyIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
				
			</div>
			<div class="col-md-6">
				<label for="add_stuffing_customer_id" class="form-label text-uppercase fw-bold me-3">CUSTOMER NAME</label>
				<div>
					<multiselect v-model="stuffingFormObj.customer_id" :options="allCustomerIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
				
			</div>
			<div class="col-md-6">
				<label for="add_stuffing_issue_date" class="form-label text-uppercase fw-bold me-3">Date of Issue</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="stuffingFormObj.issue_date" id="add_stuffing_issue_date" placeholder="Enter Date of Issue" >
				</div>
			</div>
		</div>
		<div class='row mb-4 g-3'>
			<div class="col-12">
				<h5 class="m-0 text-center">PORT STUFFING CHECK LIST</h5>
			</div>
			<div class="col-12">
				<label for="add_stuffing_dispatch_date" class="form-label text-uppercase fw-bold me-3">Date of Dispatch from Plant</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="stuffingFormObj.dispatch_date" id="add_stuffing_dispatch_date" placeholder="Enter Dispatch Date" >
				</div>
			</div>
			<div class="col-12">
				<label for="add_stuffing_cfs_receipt_date" class="form-label text-uppercase fw-bold me-3">Date of receipt of goods in CFS</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.cfs_receipt_date" id="add_stuffing_cfs_receipt_date" placeholder="Enter Cfs Receipt Date" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_product_name" class="form-label text-uppercase fw-bold me-3">Name of Product as per Invoice</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.product_name" id="add_stuffing_product_name" placeholder="Enter Product Name" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_quantity_kg" class="form-label text-uppercase fw-bold me-3">Quantity in Kgs</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.quantity_kg" id="add_stuffing_quantity_kg" placeholder="Enter Quantity Kg" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_packages_received" class="form-label text-uppercase fw-bold me-3">No. of packages received from plant</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.packages_received" id="add_stuffing_packages_received" placeholder="Enter Packages Received" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_preshipment_invoice" class="form-label text-uppercase fw-bold me-3">Pre-shipment Invoice No. & Date</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.preshipment_invoice" id="add_stuffing_preshipment_invoice" placeholder="Enter Preshipment Invoice" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_excise_invoice" class="form-label text-uppercase fw-bold me-3">Excise Invoice No. & Date</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.excise_invoice" id="add_stuffing_excise_invoice" placeholder="Enter Excise Invoice" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_vehicle_nos" class="form-label text-uppercase fw-bold me-3">Vehicle Nos</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.vehicle_nos" id="add_stuffing_vehicle_nos" placeholder="Enter Vehicle Nos" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4 g-3'>
			<div class="col-12">
				<h5 class="m-0 text-center">UNLOADING STAGE</h5>
			</div>
			<div class="col-12">
				<label for="add_stuffing_goods_condition_check" class="form-label text-uppercase fw-bold me-3">Whether the goods are in same condition as dispatched from the plant (compare it with photos received from plant logistics)</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.goods_condition_check" id="add_stuffing_goods_condition_check" placeholder="Enter Goods Condition Check" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_unloading_datetime" class="form-label text-uppercase fw-bold me-3">Date and Time of Unloading of goods</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.unloading_datetime" id="add_stuffing_unloading_datetime" placeholder="Enter Unloading Datetime" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_unloading_photos" class="form-label text-uppercase fw-bold me-3">Whether photos taken BEFORE & AFTER unloading of goods from the vehicle</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.unloading_photos" id="add_stuffing_unloading_photos" placeholder="Enter Unloading Photos" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_goods_condition_cfs" class="form-label text-uppercase fw-bold me-3">Whether goods received/unloaded at CFS are in good condition?</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.goods_condition_cfs" id="add_stuffing_goods_condition_cfs" placeholder="Enter Goods Condition Cfs" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_cfs_area_clean" class="form-label text-uppercase fw-bold me-3">Whether storage area in CFS free of water, dust, dirt, etc. (e.g. including rains/ moisture etc.)</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.cfs_area_clean" id="add_stuffing_cfs_area_clean" placeholder="Enter Cfs Area Clean" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_action_taken" class="form-label text-uppercase fw-bold me-3">If not, what are the actions taken</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.action_taken" id="add_stuffing_action_taken" placeholder="Enter Action Taken" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_goods_storage_location" class="form-label text-uppercase fw-bold me-3">Where are the goods stored in CFS? Support it by photos</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.goods_storage_location" id="add_stuffing_goods_storage_location" placeholder="Enter Goods Storage Location" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4 g-3'>
			<div class="col-12">
				<h5 class="m-0 text-center">PALLETIZATION & SHRINK WRAPPING STAGE:</h5>
			</div>
			<div class="col-12">
				<label for="add_stuffing_pallets_condition" class="form-label text-uppercase fw-bold me-3">Whether pallets supplied by vendor are in good condition</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.pallets_condition" id="add_stuffing_pallets_condition" placeholder="Enter Pallets Condition" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_palletization_done" class="form-label text-uppercase fw-bold me-3">Whether palletization is completed by CHA as per the satisfaction (e.g. lot wise)</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.palletization_done" id="add_stuffing_palletization_done" placeholder="Enter Palletization Done" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_shipping_marks_done" class="form-label text-uppercase fw-bold me-3">Whether shipping marks applied on the goods</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.shipping_marks_done" id="add_stuffing_shipping_marks_done" placeholder="Enter Shipping Marks Done" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_shrink_wrapping_done" class="form-label text-uppercase fw-bold me-3">Whether shrink wrapping is completed as per the requirement</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.shrink_wrapping_done" id="add_stuffing_shrink_wrapping_done" placeholder="Enter Shrink Wrapping Done" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_labeling_done" class="form-label text-uppercase fw-bold me-3">Whether Drum/ Bag/ Box labelling completed as per the satisfaction (Shipping Marks, Haz. Stickers)</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.labeling_done" id="add_stuffing_labeling_done" placeholder="Enter Labeling Done" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_packaging_photos" class="form-label text-uppercase fw-bold me-3">Whether photos taken during palletization, shrink wrapping stage in CFS?</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.packaging_photos" id="add_stuffing_packaging_photos" placeholder="Enter Packaging Photos" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_packaging_done_time" class="form-label text-uppercase fw-bold me-3">Date and time of completion of this stage</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.packaging_done_time" id="add_stuffing_packaging_done_time" placeholder="Enter Packaging Done Time" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4 g-3'>
			<div class="col-12">
				<h5 class="m-0 text-center">CONTAINER STUFFING STAGE</h5>
			</div>
			<div class="col-12">
				<label for="add_stuffing_container_seal_no" class="form-label text-uppercase fw-bold me-3">Container No. / Seal No.</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.container_seal_no" id="add_stuffing_container_seal_no" placeholder="Enter Container Seal No" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_fumigation_done" class="form-label text-uppercase fw-bold me-3">Whether fumigation done</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.fumigation_done" id="add_stuffing_fumigation_done" placeholder="Enter Fumigation Done" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_stuffing_photos" class="form-label text-uppercase fw-bold me-3">Whether stage wise photographs of container stuffing taken</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.stuffing_photos" id="add_stuffing_stuffing_photos" placeholder="Enter Stuffing Photos" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_stuffing_done" class="form-label text-uppercase fw-bold me-3">Whether stuffing done as per the satisfaction</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.stuffing_done" id="add_stuffing_stuffing_done" placeholder="Enter Stuffing Done" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_lashing_done" class="form-label text-uppercase fw-bold me-3">Whether lashing choking done satisfactory</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.lashing_done" id="add_stuffing_lashing_done" placeholder="Enter Lashing Done" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_sealing_done" class="form-label text-uppercase fw-bold me-3">Whether container sealing complete as per the satisfaction</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.sealing_done" id="add_stuffing_sealing_done" placeholder="Enter Sealing Done" >
					
				</div>
				
			</div>
			<div class="col-12">
				<label for="add_stuffing_container_done_time" class="form-label text-uppercase fw-bold me-3">Date and time of completion with photo</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="stuffingFormObj.container_done_time" id="add_stuffing_container_done_time" placeholder="Enter Container Done Time" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-12">
				<label for="add_stuffing_surveyor_id" class="form-label text-uppercase fw-bold me-3">Surveyor Name</label>
				<div>
					<multiselect v-model="stuffingFormObj.surveyor_id" :options="allSurveyorIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
			</div>
		</div>
		<div class="row justify-content-center" v-if="!isModal">
			<div class="col-5">
				<a class="btn btn-success w-100" @click="saveStuffing()">Save</a>
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
		customer_id:'',
		issue_date:'',
		dispatch_date:'',
		cfs_receipt_date:'',
		product_name:'',
		quantity_kg:'',
		packages_received:'',
		preshipment_invoice:'',
		excise_invoice:'',
		vehicle_nos:'',
		goods_condition_check:'',
		unloading_datetime:'',
		unloading_photos:'',
		goods_condition_cfs:'',
		cfs_area_clean:'',
		action_taken:'',
		goods_storage_location:'',
		pallets_condition:'',
		palletization_done:'',
		shipping_marks_done:'',
		shrink_wrapping_done:'',
		labeling_done:'',
		packaging_photos:'',
		packaging_done_time:'',
		container_seal_no:'',
		fumigation_done:'',
		stuffing_photos:'',
		stuffing_done:'',
		lashing_done:'',
		sealing_done:'',
		container_done_time:'',
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
		
	}
}
export default {
	name: "Stuffingmaster",
	props: ['current_user_id', 'all_permissions','id', 'isModal', 'stuffingForAdd', 'reload', 'closed'],
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
			allCustomerIdList: [],
			allSurveyorIdList: [],
			stuffingFormObj: initialState(),
		}
	},
	validations() {
		return {
			stuffingFormObj: initialStateValidations()
		};
	},
	methods: {
		canceladdedit(event){
			window.location = this.docRoot + '/stuffing';
		},
		formatDate(date) {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
		async saveStuffing(event){
			var that = this;
			const result = await that.v$.$validate();
			if (!result) {
				that.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
				console.log(that.v$.$errors);
				return;
			}
			
			if( !that.stuffingFormObj.action || that.stuffingFormObj.action == "" )
				that.stuffingFormObj.action = "details";
			that.stuffingFormObj.created_by = that.current_user_id;
			
			if (  typeof that.stuffingFormObj.company_id === 'object' && that.stuffingFormObj.company_id.id) {
				that.stuffingFormObj.company_id = that.stuffingFormObj.company_id.id;
			}
			if (  typeof that.stuffingFormObj.customer_id === 'object' && that.stuffingFormObj.customer_id.id) {
				that.stuffingFormObj.customer_id = that.stuffingFormObj.customer_id.id;
			}
			if (  typeof that.stuffingFormObj.surveyor_id === 'object' && that.stuffingFormObj.surveyor_id.id) {
				that.stuffingFormObj.surveyor_id = that.stuffingFormObj.surveyor_id.id;
			}
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/stuffing/save', { stuffing: that.stuffingFormObj }).then(async function (response) {
				that.closeSwal();
				var status = response.data.status;
				if( status == 1 ){
					// Set the ID so that duplicate records will not be created
					that.stuffingFormObj.id = response.data.id;
					that.showToast('Stuffing saved successfully', 'success', 'bottom', 3000);
					setTimeout(() => {
						window.location = that.docRoot + "/stuffing/";
						that.showLoading("Loading ...");
					}, 1500);
				}
				else{
					that.showErrors("Stuffing could not be saved successfully.", response.data.messages, "bottom", 3000);
				}
			})
			.catch(function (error) {
				console.log(error);
				that.closeSwal();
				that.showToast("Stuffing could not be saved successfully.", "error", "bottom", 3000);
			});
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				this.mode = "edit";
				
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/stuffing/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.stuffingFormObj = Object.assign({}, response.data);
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
		let _allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/api/surveyor/get', 'post', {});
		if(Array.isArray(_allSurveyorIdList) && _allSurveyorIdList.length > 0){
			this.allSurveyorIdList = _allSurveyorIdList.map(x => {return { id: x.id, text: x.name }});
		}
		if (this.stuffingFormObj.company_id) {
			if (Array.isArray(this.allCompanyIdList) && this.allCompanyIdList.length > 0) {
				let _allRelationList = this.allCompanyIdList;
				let relationId = parseInt(this.stuffingFormObj.company_id);
				this.stuffingFormObj.company_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.stuffingFormObj.customer_id) {
			if (Array.isArray(this.allCustomerIdList) && this.allCustomerIdList.length > 0) {
				let _allRelationList = this.allCustomerIdList;
				let relationId = parseInt(this.stuffingFormObj.customer_id);
				this.stuffingFormObj.customer_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.stuffingFormObj.surveyor_id) {
			if (Array.isArray(this.allSurveyorIdList) && this.allSurveyorIdList.length > 0) {
				let _allRelationList = this.allSurveyorIdList;
				let relationId = parseInt(this.stuffingFormObj.surveyor_id);
				this.stuffingFormObj.surveyor_id = _allRelationList.find(item => item.id === relationId);
			}
		}
	}
}
</script>
