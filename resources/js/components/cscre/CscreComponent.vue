<template>
	<div id="cscre-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">cscre</h4>
							<a id="add_cscre_btn" class="btn btn-success border-dark btn-sm" v-if="['0101', '1111'].indexOf(all_permissions) >= 0" :href="this.docRoot+'/cscre/add'" role="button">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewCscre" @edit-object="prepareEditCscre" @toggle-object-status="toggleObjectStatus" @export-object="printCscre" @duplicate-object="duplicateObject"></DataTableComponent>
			</div>
		</div>
	</div>
</template>
<script>
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
					{ title: 'Customer Name', property: 'customer_name', sortable: true, },
					{ title: 'serial_no', property: 'serial_no', sortable: true, },
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
							title: "Customer Name",
							property: "customer_name",
							type: "text",
							
						},
						{
							title: "serial_no",
							property: "serial_no",
							type: "text",
							
						},
						{
							title: "company name",
							property: "company_name",
							type: "text",
							
						},
						{
							title: "inspection date",
							property: "inspection_date",
							type: "text",
							
						},
						{
							title: "inspection location",
							property: "inspection_location",
							type: "text",
							
						},
						{
							title: "container no",
							property: "container_no",
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
		saveCscre(cscreForAdd){
			var that = this;
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/cscre/save', { cscre: cscreForAdd }).then(async function (response) {
				console.log(response);
				that.closeSwal();
				var status = response.data.status;
				if( status > 0 ){
					// Set the ID so that duplicate records will not be created
					that.cscreForAdd.id = response.data.id;
					that.showToast('CSCRE saved successfully', 'success', 'bottom', 3000);
					setTimeout(() => {
						that.dataprops.reload = true;
						that.showLoading("Loading ...");
					}, 1500);
				}
				else{
					that.showErrors("CSCRE could not be saved successfully.", response.data.messages, "bottom", 3000);
				}
			})
			.catch(function (error) {
				console.log(error);
				that.closeSwal();
				that.showToast("CSCRE could not be saved successfully.", "error", "bottom", 3000);
			});
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
		toggleObjectStatus(cscre, status){
			var that = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to " + (status == 1 ? "activate" : "deactivate") + ' the Cleaning record?',
				showCancelButton: true
			}).then((result) => {
				if (result.isConfirmed) {
					that.cscreForAdd = cscre;
					that.cscreForAdd.status = status;
					that.cscreForAdd.action = "status";
					that.cscreForAdd.reload = true;
					that.saveCscre(that.cscreForAdd);
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
