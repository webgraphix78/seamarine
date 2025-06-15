<template>
	<div id="stuffing-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">stuffing</h4>
							<a id="add_stuffing_btn" class="btn btn-success border-dark btn-sm" :href="this.docRoot+'/stuffing/add'" role="button">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewStuffing" @edit-object="prepareEditStuffing" @toggle-object-status="deleteStuffing" @export-object="printStuffing"  @duplicate-object="duplicateObject"></DataTableComponent>
			</div>
		</div>
	</div>
</template>
<script>
import * as bootstrap from 'bootstrap';
export default {
	name: "Stuffingmaster",
	props: ['current_user_id', 'all_permissions'],
	data(){
		return{
			dataprops: {
				id: 'stuffing-list',
				class: 'a',
				base_url: '/api/stuffing/',
				columns: [
					{ title: 'Ref No', property: 'ref_no', sortable: true, },
					{ title: 'Company Id', property: 'rel_company_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'Customer Name', property: 'rel_customer_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'Date of Issue', property: 'issue_date', sortable: true, },
				],
				data_to_send: { current_user_id: this.current_user_id } ,
				reload: false,
				search_params: {
					columns: [
						{
							title: "Ref No",
							property: "ref_no",
							type: "text",
							
						},                        
						{
							title: "Company Id",
							property: "company_id",
							type: "relation",
							source: { api: 'Company', id: 'id', value: 'name' } 
						},                        
						{
							title: "Customer Name",
							property: "customer_id",
							type: "relation",
							source: { api: 'Customer', id: 'id', value: 'title' } 
						},                        
						{
							title: "Date of Issue",
							property: "issue_date",
							type: "text",
							
						},                        
						{
							title: "Surveyor Name",
							property: "surveyor_id",
							type: "relation",
							source: { api: 'Surveyor', id: 'id', value: 'title' } 
						},
					]
				},
				search: "simple"
			},
			addeditModal: null,
			viewModal: null,
			currentUser: siteUserObject,
			readStuffing: {},
			stuffingForAdd: {},
			allCompanyIdList: [],
			allCustomerIdList: [],
			allSurveyorIdList: [],
		}
	},
	methods: {
		canceladdedit(event){
			this.stuffingForAdd.closed = true;
		},
		prepareEditStuffing(stuffing){
			window.location = this.docRoot + '/stuffing/edit/' + stuffing.id;
		},
		viewStuffing(stuffing){
			window.location = this.docRoot + '/stuffing/view/' + stuffing.id;
		},
		prepareAddModal(obj){
			this.stuffingForAdd = Object.assign({});
		},
		saveStuffing(){
			this.stuffingForAdd.reload = true;
		},
		duplicateObject(stuffing) {
			let that = this;
			this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
				if (result.isConfirmed) {
					// Call AXIOS to duplicate the invoice and then open in EDIT Mode
					this.showLoading("Saving ...");
					axios.post(this.docRoot+'/stuffing/duplicate', { id: stuffing.id }).then(async function (response) {
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
								window.location = that.docRoot+'/stuffing/edit/' + newId+"?duplicate=1";
							}, 4000);
						}
					});
				}
			});
		},
		deleteStuffing(stuffing, status){
			var thisVar = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to delete?",
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					axios.post('/stuffing/delete', { id: stuffing.id, status: status })
                        .then(function (response) {
                            if (response.data.status == 1) {
                                thisVar.showToast('STUFFING updated successfully', 'success', 'bottom', 3000);
                                thisVar.dataprops.reload = true;
                            } else {
                                thisVar.showErrors("STUFFING could not be updated successfully", response.data.messages, "bottom", 3000);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                            thisVar.showToast("STUFFING could not be updated successfully", "error", "bottom", 3000);
                        });
				}
			});
		},
		printStuffing(stuffing) {
			window.location = this.docRoot+'/stuffing/export-to-pdf/' + stuffing.id;
			this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
		},
	},
	async mounted() {
		this.allCompanyIdList = await this.loadAllCompany(this.docRoot+'/company',{});
		this.allCustomerIdList = await this.loadAllCustomer(this.docRoot+'/customer',{});
		this.allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/surveyor',{});
	}
}
</script>
