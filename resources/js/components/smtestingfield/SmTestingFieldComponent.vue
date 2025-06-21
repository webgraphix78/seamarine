<template>
	<div id="smtestingfield-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">SM testing field</h4>
							<a id="add_smtestingfield_btn" class="btn btn-success border-dark btn-sm" :href="this.docRoot+'/smtestingfield/add'" role="button">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewSmTestingField" @edit-object="prepareEditSmTestingField" @toggle-object-status="deleteSmTestingField" @export-object="printSmTestingField"  @duplicate-object="duplicateObject"></DataTableComponent>
			</div>
		</div>
		
		
	</div>
</template>
<script>
import * as bootstrap from 'bootstrap';
export default {
	name: "SmTestingFieldmaster",
	props: ['current_user_id', 'all_permissions'],
	data(){
		return{
			dataprops: {
				id: 'smtestingfield-list',
				class: 'a',
				base_url: '/api/smtestingfield/',
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
				search: "simple"
			},
			addeditModal: null,
			viewModal: null,
			currentUser: siteUserObject,
			readSmTestingField: {},
			smtestingfieldForAdd: {},
			allCompanyIdList: [],
			allInspectionLocationIdList: [],
			allSurveyorIdList: [],
		}
	},
	methods: {
		canceladdedit(event){
			this.smtestingfieldForAdd.closed = true;
		},
		prepareEditSmTestingField(smtestingfield){
			window.location = this.docRoot + '/smtestingfield/edit/' + smtestingfield.id;
		},
		viewSmTestingField(smtestingfield){
			window.location = this.docRoot + '/smtestingfield/view/' + smtestingfield.id;
		},
		prepareAddModal(obj){
			this.smtestingfieldForAdd = Object.assign({});
		},
		saveSmTestingField(){
			this.smtestingfieldForAdd.reload = true;
		},
		duplicateObject(smtestingfield) {
			let that = this;
			this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
				if (result.isConfirmed) {
					// Call AXIOS to duplicate the invoice and then open in EDIT Mode
					this.showLoading("Saving ...");
					axios.post(this.docRoot+'/smtestingfield/duplicate', { id: smtestingfield.id }).then(async function (response) {
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
								window.location = that.docRoot+'/smtestingfield/edit/' + newId+"?duplicate=1";
							}, 4000);
						}
					});
				}
			});
		},
		deleteSmTestingField(smtestingfield, status){
			var thisVar = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to delete?",
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					axios.post('/smtestingfield/delete', { id: smtestingfield.id, status: status })
                        .then(function (response) {
                            if (response.data.status == 1) {
                                thisVar.showToast('SMTESTINGFIELD updated successfully', 'success', 'bottom', 3000);
                                thisVar.dataprops.reload = true;
                            } else {
                                thisVar.showErrors("SMTESTINGFIELD could not be updated successfully", response.data.messages, "bottom", 3000);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                            thisVar.showToast("SMTESTINGFIELD could not be updated successfully", "error", "bottom", 3000);
                        });
				}
			});
		},
		printSmTestingField(smtestingfield) {
			window.location = this.docRoot+'/smtestingfield/export-to-pdf/' + smtestingfield.id;
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