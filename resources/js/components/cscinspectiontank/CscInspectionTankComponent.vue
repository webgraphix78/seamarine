<template>
	<div id="cscinspectiontank-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">CSC inspection tank</h4>
							<a id="add_cscinspectiontank_btn" class="btn btn-success border-dark btn-sm" :href="this.docRoot+'/cscinspectiontank/add'" role="button">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewCscInspectionTank" @edit-object="prepareEditCscInspectionTank" @toggle-object-status="deleteCscInspectionTank" @export-object="printCscInspectionTank"  @duplicate-object="duplicateObject"></DataTableComponent>
			</div>
		</div>
	</div>
</template>
<script>
import * as bootstrap from 'bootstrap';
export default {
	name: "CscInspectionTankmaster",
	props: ['current_user_id', 'all_permissions'],
	data(){
		return{
			dataprops: {
				id: 'cscinspectiontank-list',
				class: 'a',
				base_url: '/api/cscinspectiontank/',
				columns: [
					{ title: 'Company Name', property: 'rel_company_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'Inspection Date', property: 'inspection_date', sortable: true, },
					{ title: 'Inspection Location Name', property: 'rel_inspection_location_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'Operator Lessor', property: 'operator_lessor', sortable: true, },
					{ title: 'Tank No', property: 'tank_no', sortable: true, },
				],
				data_to_send: { current_user_id: this.current_user_id } ,
				reload: false,
				search_params: {
					columns: [
						{
							title: "Company Id",
							property: "company_id",
							type: "relation",
							source: { api: 'Company', id: 'id', value: 'name' } 
						},                        
						{
							title: "Inspection Date",
							property: "inspection_date",
							type: "text",
							
						},                        
						{
							title: "Inspection Location Id",
							property: "inspection_location_id",
							type: "relation",
							source: { api: 'InspectionLocation', id: 'id', value: 'name' } 
						},                        
						{
							title: "Operator Lessor",
							property: "operator_lessor",
							type: "text",
							
						},                        
						{
							title: "Tank No",
							property: "tank_no",
							type: "text",
							
						},                        
						{
							title: "Surveyor Id",
							property: "surveyor_id",
							type: "relation",
							source: { api: 'Surveyor', id: 'id', value: 'name' } 
						},
					]
				},
				search: 'simple',
			},
			addeditModal: null,
			viewModal: null,
			currentUser: siteUserObject,
			readCscInspectionTank: {},
			cscinspectiontankForAdd: {},
			allCompanyIdList: [],
			allInspectionLocationIdList: [],
			allSurveyorIdList: [],

		}
	},
	methods: {
		canceladdedit(event){
			this.cscinspectiontankForAdd.closed = true;
		},
		prepareEditCscInspectionTank(cscinspectiontank){
			window.location = this.docRoot + '/cscinspectiontank/edit/' + cscinspectiontank.id;
		},
		viewCscInspectionTank(cscinspectiontank){
			window.location = this.docRoot + '/cscinspectiontank/view/' + cscinspectiontank.id;
		},
		prepareAddModal(obj){
			this.cscinspectiontankForAdd = Object.assign({});
		},
		saveCscInspectionTank(){
			this.cscinspectiontankForAdd.reload = true;
		},
		duplicateObject(cscinspectiontank) {
			let that = this;
			this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
				if (result.isConfirmed) {
					// Call AXIOS to duplicate the invoice and then open in EDIT Mode
					this.showLoading("Saving ...");
					axios.post(this.docRoot+'/cscinspectiontank/duplicate', { id: cscinspectiontank.id }).then(async function (response) {
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
								window.location = that.docRoot+'/cscinspectiontank/edit/' + newId+"?duplicate=1";
							}, 4000);
						}
					});
				}
			});
		},
		deleteCscInspectionTank(cscinspectiontank, status){
			var thisVar = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to delete?",
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					axios.post('/cscinspectiontank/delete', { id: cscinspectiontank.id, status: status })
                        .then(function (response) {
                            if (response.data.status == 1) {
                                thisVar.showToast('CSCINSPECTIONTANK updated successfully', 'success', 'bottom', 3000);
                                thisVar.dataprops.reload = true;
                            } else {
                                thisVar.showErrors("CSCINSPECTIONTANK could not be updated successfully", response.data.messages, "bottom", 3000);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                            thisVar.showToast("CSCINSPECTIONTANK could not be updated successfully", "error", "bottom", 3000);
                        });
				}
			});
		},
		printCscInspectionTank(cscinspectiontank) {
			window.location = this.docRoot+'/cscinspectiontank/export-to-pdf/' + cscinspectiontank.id;
			this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
		},
	},
	async mounted() {
		this.allCompanyIdList = await this.loadAllCompany(this.docRoot+'/company',{});
		this.allInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/inspectionlocation',{});
		this.allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/surveyor',{});
	}
}
</script>