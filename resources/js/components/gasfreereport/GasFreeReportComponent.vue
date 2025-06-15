<template>
	<div id="gasfreereport-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">gas free report</h4>
							<a id="add_gasfreereport_btn" class="btn btn-success border-dark btn-sm" :href="this.docRoot+'/gasfreereport/add'" role="button">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewGasFreeReport" @edit-object="prepareEditGasFreeReport" @toggle-object-status="deleteGasFreeReport" @export-object="printGasFreeReport"  @duplicate-object="duplicateObject"></DataTableComponent>
			</div>
		</div>
	</div>
</template>
<script>
import * as bootstrap from 'bootstrap';
export default {
	name: "GasFreeReportmaster",
	props: ['current_user_id', 'all_permissions'],
	data(){
		return{
			dataprops: {
				id: 'gasfreereport-list',
				class: 'a',
				base_url: '/api/gasfreereport/',
				columns: [
					{ title: 'Tank No', property: 'tank_no', sortable: true, },
					{ title: 'Type', property: 'type', sortable: true, },
					{ title: 'Ref No', property: 'ref_no', sortable: true, },
					{ title: 'Csc No', property: 'csc_no', sortable: true, },
				],
				data_to_send: { current_user_id: this.current_user_id } ,
				reload: false,
				search_params: {
					columns: [
						{
							title: "Tank No",
							property: "tank_no",
							type: "text",
							
						},                        
						{
							title: "Company Id",
							property: "company_id",
							type: "relation",
							source: { api: 'Company', id: 'id', value: 'name' } 
						},                        
						{
							title: "Type",
							property: "type",
							type: "text",
							
						},                        
						{
							title: "Ref No",
							property: "ref_no",
							type: "text",
							
						},                       
						{
							title: "Csc No",
							property: "csc_no",
							type: "text",
							
						},                        
						{
							title: "Mfg",
							property: "mfg",
							type: "text",
							
						},                        
						{
							title: "Ned",
							property: "ned",
							type: "text",
							
						},                        
						{
							title: "Inspection Location Id",
							property: "inspection_location_id",
							type: "relation",
							source: { api: 'InspectionLocation', id: 'id', value: 'name' } 
						},                        
						{
							title: "Customer Id",
							property: "customer_id",
							type: "relation",
							source: { api: 'Customer', id: 'id', value: 'name' } 
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
			readGasFreeReport: {},
			gasfreereportForAdd: {},
			allCompanyIdList: [],
			allInspectionLocationIdList: [],
			allCustomerIdList: [],
			allSurveyorIdList: [],
		}
	},
	methods: {
		canceladdedit(event){
			this.gasfreereportForAdd.closed = true;
		},
		prepareEditGasFreeReport(gasfreereport){
			window.location = this.docRoot + '/gasfreereport/edit/' + gasfreereport.id;
		},
		viewGasFreeReport(gasfreereport){
			window.location = this.docRoot + '/gasfreereport/view/' + gasfreereport.id;
		},
		prepareAddModal(obj){
			this.gasfreereportForAdd = Object.assign({});
		},
		saveGasFreeReport(){
			this.gasfreereportForAdd.reload = true;
		},
		duplicateObject(gasfreereport) {
			let that = this;
			this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
				if (result.isConfirmed) {
					// Call AXIOS to duplicate the invoice and then open in EDIT Mode
					this.showLoading("Saving ...");
					axios.post(this.docRoot+'/gasfreereport/duplicate', { id: gasfreereport.id }).then(async function (response) {
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
								window.location = that.docRoot+'/gasfreereport/edit/' + newId+"?duplicate=1";
							}, 4000);
						}
					});
				}
			});
		},
		deleteGasFreeReport(gasfreereport, status){
			var thisVar = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to delete?",
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					axios.post('/gasfreereport/delete', { id: gasfreereport.id, status: status })
                        .then(function (response) {
                            if (response.data.status == 1) {
                                thisVar.showToast('GASFREEREPORT updated successfully', 'success', 'bottom', 3000);
                                thisVar.dataprops.reload = true;
                            } else {
                                thisVar.showErrors("GASFREEREPORT could not be updated successfully", response.data.messages, "bottom", 3000);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                            thisVar.showToast("GASFREEREPORT could not be updated successfully", "error", "bottom", 3000);
                        });
				}
			});
		},
		printGasFreeReport(gasfreereport) {
			window.location = this.docRoot+'/gasfreereport/export-to-pdf/' + gasfreereport.id;
			this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
		},
	},
	async mounted() {
		this.allCompanyIdList = await this.loadAllCompany(this.docRoot+'/company',{});
		this.allInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/inspectionlocation',{});
		this.allCustomerIdList = await this.loadAllCustomer(this.docRoot+'/customer',{});
		this.allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/surveyor',{});
	}
}
</script>
