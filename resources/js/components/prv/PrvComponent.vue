<template>
	<div id="prv-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">PRV Calibration</h4>
							<a id="add_prv_btn" class="btn btn-success border-dark btn-sm" :href="this.docRoot+'/prv/add'" role="button">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewPrv" @edit-object="prepareEditPrv" @toggle-object-status="deletePrv" @export-object="printPrv"  @duplicate-object="duplicateObject"></DataTableComponent>
			</div>
		</div>
		
		
	</div>
</template>
<script>
export default {
	name: "Prvmaster",
	props: ['current_user_id', 'all_permissions'],
	data(){
		return{
			dataprops: {
				id: 'prv-list',
				class: 'a',
				base_url: '/api/prv/',
				columns: [
					{ title: 'Ref', property: 'ref', sortable: true, },
					{ title: 'Date Of Issue', property: 'date_of_issue', sortable: true, },
					{ title: 'Customer Id', property: 'rel_customer_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'Inspection Location Id', property: 'rel_inspection_location_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'Tank No', property: 'tank_no', },
				],
				data_to_send: { current_user_id: this.current_user_id } ,
				reload: false,
				search_params: {
					columns: [
						{
							title: "Ref",
							property: "ref",
							type: "text",
							
						},                        
						{
							title: "Date Of Issue",
							property: "date_of_issue",
							type: "text",
							
						},                        
						{
							title: "Customer Id",
							property: "customer_id",
							type: "relation",
							source: { api: 'Customer', id: 'id', value: 'name' } 
						},                        
						{
							title: "Inspection Location Id",
							property: "inspection_location_id",
							type: "relation",
							source: { api: 'InspectionLocation', id: 'id', value: 'name' } 
						},                        
						{
							title: "Surveyor Id",
							property: "surveyor_id",
							type: "relation",
							source: { api: 'Surveyor', id: 'id', value: 'name' } 
						},
					]
				},
				search: "simple"
			},
			addeditModal: null,
			viewModal: null,
			currentUser: siteUserObject,
			readPrv: {},
			prvForAdd: {},
			allCustomerIdList: [],
			allInspectionLocationIdList: [],
			allSurveyorIdList: [],
		}
	},
	methods: {
		canceladdedit(event){
			this.prvForAdd.closed = true;
		},
		prepareEditPrv(prv){
			window.location = this.docRoot + '/prv/edit/' + prv.id;
		},
		viewPrv(prv){
			window.location = this.docRoot + '/prv/view/' + prv.id;
		},
		prepareAddModal(obj){
			this.prvForAdd = Object.assign({});
		},
		savePrv(){
			this.prvForAdd.reload = true;
		},
		duplicateObject(prv) {
			let that = this;
			this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
				if (result.isConfirmed) {
					// Call AXIOS to duplicate the invoice and then open in EDIT Mode
					this.showLoading("Saving ...");
					axios.post(this.docRoot+'/prv/duplicate', { id: prv.id }).then(async function (response) {
						that.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							var newId = response.data.id;
							// Ajax to submit
							that.showToast('Record duplicated successfully', 'success', 'bottom', 3000);
							setTimeout(() => {
								that.showLoading("Redirecting ...");
							}, 2000);
							setTimeout(() => {
								window.location = that.docRoot+'/prv/edit/' + newId+"?duplicate=1";
							}, 4000);
						}
					});
				}
			});
		},
		deletePrv(prv, status){
			var thisVar = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to delete?",
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					axios.post('/prv/delete', { id: prv.id, status: status })
                        .then(function (response) {
                            if (response.data.status == 1) {
                                thisVar.showToast('PRV updated successfully', 'success', 'bottom', 3000);
                                thisVar.dataprops.reload = true;
                            } else {
                                thisVar.showErrors("PRV could not be updated successfully", response.data.messages, "bottom", 3000);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                            thisVar.showToast("PRV could not be updated successfully", "error", "bottom", 3000);
                        });
				}
			});
		},
		printPrv(prv) {
			window.location = this.docRoot+'/prv/export-to-pdf/' + prv.id;
			this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
		},
	},
	async mounted() {
		this.allCustomerIdList = await this.loadAllCustomer(this.docRoot+'/customer',{});
		this.allInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/inspectionlocation',{});
		this.allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/surveyor',{});
		this.allCompanyIdList = await this.loadAllCompany(this.docRoot+'/company',{});
	}
}
</script>