<template>
	<div id="dmcc-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">DMCC</h4>
							<a id="add_dmcc_btn" class="btn btn-success border-dark btn-sm" :href="this.docRoot+'/dmcc/add'" role="button">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewDmcc" @edit-object="prepareEditDmcc" @toggle-object-status="deleteDmcc" @export-object="printDmcc"  @duplicate-object="duplicateObject"></DataTableComponent>
			</div>
		</div>
		
		
	</div>
</template>
<script>
import * as bootstrap from 'bootstrap';
export default {
	name: "Dmccmaster",
	props: ['current_user_id', 'all_permissions'],
	data(){
		return{
			dataprops: {
				id: 'dmcc-list',
				class: 'a',
				base_url: '/api/dmcc/',
				columns: [
					{ title: 'Tank No', property: 'tank_no', sortable: true, },
					{ title: 'Company Name', property: 'rel_company_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'Date of Loading', property: 'inspection_date', sortable: true, },
					{ title: 'Loading Of', property: 'loading_of', sortable: true, },

				],
				data_to_send: { current_user_id: this.current_user_id } ,
				reload: false,
				search_params: {
					columns: [
						{
							title: "Tank No",
							property: "tank_no",
							type: "text",
							
						},                        {
							title: "Company Name",
							property: "company_id",
							type: "relation",
							source: { api: 'Company', id: 'id', value: 'name' } 
						},                        {
							title: "Date of Loading",
							property: "inspection_date",
							type: "text",
							
						},                        {
							title: "Loading Of",
							property: "loading_of",
							type: "text",
							
						},                        {
							title: "Tank under Nitrogen pressure and all Seals intact",
							property: "seals_intact_time",
							type: "text",
							
						},                        {
							title: "Surveyor Name",
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
			readDmcc: {},
			dmccForAdd: {},
			allCompanyIdList: [],
allSurveyorIdList: [],

		}
	},
	methods: {
		canceladdedit(event){
			this.dmccForAdd.closed = true;
		},
		prepareEditDmcc(dmcc){
			window.location = this.docRoot + '/dmcc/edit/' + dmcc.id;
		},
		viewDmcc(dmcc){
			window.location = this.docRoot + '/dmcc/view/' + dmcc.id;
		},
		prepareAddModal(obj){
			this.dmccForAdd = Object.assign({});
		},
		saveDmcc(){
			this.dmccForAdd.reload = true;
		},
		duplicateObject(dmcc) {
			let that = this;
			this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
				if (result.isConfirmed) {
					// Call AXIOS to duplicate the invoice and then open in EDIT Mode
					this.showLoading("Saving ...");
					axios.post(this.docRoot+'/dmcc/duplicate', { id: dmcc.id }).then(async function (response) {
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
								window.location = that.docRoot+'/dmcc/edit/' + newId+"?duplicate=1";
							}, 4000);
						}
					});
				}
			});
		},
		deleteDmcc(dmcc, status){
			var thisVar = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to delete?",
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					axios.post('/dmcc/delete', { id: dmcc.id, status: status })
                        .then(function (response) {
                            if (response.data.status == 1) {
                                thisVar.showToast('DMCC updated successfully', 'success', 'bottom', 3000);
                                thisVar.dataprops.reload = true;
                            } else {
                                thisVar.showErrors("DMCC could not be updated successfully", response.data.messages, "bottom", 3000);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                            thisVar.showToast("DMCC could not be updated successfully", "error", "bottom", 3000);
                        });
				}
			});
		},
		printDmcc(dmcc) {
			window.location = this.docRoot+'/dmcc/export-to-pdf/' + dmcc.id;
			this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
		},
	},
	async mounted() {
		this.allCompanyIdList = await this.loadAllCompany(this.docRoot+'/company',{});
		this.allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/surveyor',{});
	}
}
</script>
