<template>
	<div id="cscre-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">cscre</h4>
							<a id="add_cscre_btn" class="btn btn-warning border-dark btn-sm" :href="this.docRoot+'/cscre/add'" role="button">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewCscre" @edit-object="prepareEditCscre" @toggle-object-status="deleteCscre" @export-object="printCscre" @duplicate-object="duplicateObject"></DataTableComponent>
			</div>
		</div>
	</div>
</template>
<script>
import * as bootstrap from 'bootstrap';
export default {
	name: "Cscremaster",
	props: ['current_user_id', 'all_permissions'],
	data(){
		return{
			dataprops: {
				id: 'cscre-list',
				class: 'a',
				base_url: '/api/cscre/',
				columns: [
					{ title: 'Ref No', property: 'ref_no', sortable: true, },
					{ title: 'Company Name', property: 'rel_company_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'This is certify that the undersigned surveyor did, at the request of', property: 'request_of_name', sortable: true, },
					{ title: ', attend', property: 'attend', sortable: true, },
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
							title: "Company Name",
							property: "company_id",
							type: "relation",
							source: { api: 'user', id: 'id', value: 'name' } 
						},                        {
							title: "This is certify that the undersigned surveyor did, at the request of",
							property: "request_of_name",
							type: "text",
							
						},
						{
							title: ", attend",
							property: "attend",
							type: "text",
							
						},
						{
							title: ", of",
							property: "of_name",
							type: "text",
							
						},
						{
							title: "on the",
							property: "attend_day",
							type: "text",
							
						},
						{
							title: "day of",
							property: "attend_month",
							type: "text",
							
						},
						{
							title: "Unit Number",
							property: "unit_no",
							type: "text",
							
						},
					]
				},
				search: "simple"
			},
			addeditModal: null,
			viewModal: null,
			currentUser: siteUserObject,
			readCscre: {},
			cscreForAdd: {},
			allCompanyIdList: [],

		}
	},
	methods: {
		canceladdedit(event){
			this.cscreForAdd.closed = true;
		},
		prepareEditCscre(cscre){
			window.location = this.docRoot + '/cscre/edit/' + cscre.id;
		},
		viewCscre(cscre){
			window.location = this.docRoot + '/cscre/view/' + cscre.id;
		},
		prepareAddModal(obj){
			this.cscreForAdd = Object.assign({});
		},
		saveCscre(){
			this.cscreForAdd.reload = true;
		},
		duplicateObject(cscre) {
			let that = this;
			this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
				if (result.isConfirmed) {
					// Call AXIOS to duplicate the invoice and then open in EDIT Mode
					this.showLoading("Saving ...");
					axios.post(this.docRoot+'/cscre/duplicate', { id: cscre.id }).then(async function (response) {
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
								window.location = that.docRoot+'/cscre/edit/' + newId+"?duplicate=1";
							}, 4000);
						}
					});
				}
			});
		},
		deleteCscre(cscre, status){
			var thisVar = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to delete?",
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					axios.post('/cscre/delete', { id: cscre.id, status: status })
                        .then(function (response) {
                            if (response.data.status == 1) {
                                thisVar.showToast('CSCRE updated successfully', 'success', 'bottom', 3000);
                                thisVar.dataprops.reload = true;
                            } else {
                                thisVar.showErrors("CSCRE could not be updated successfully", response.data.messages, "bottom", 3000);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                            thisVar.showToast("CSCRE could not be updated successfully", "error", "bottom", 3000);
                        });
				}
			});
		},
		printCscre(cscre) {
			this.cscreForAdd.reload = true;
			window.location = this.docRoot+'/cscre/export-to-pdf/' + cscre.id;
			this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
		},
	},
	async mounted() {
		this.allCompanyIdList = await this.loadAllCompany(this.docRoot+'/user',{});
	}
}
</script>
