<template>
	<div id="stuffing-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">stuffing</h4>
							<a id="add_stuffing_btn" class="btn btn-success border-dark btn-sm" :href="this.docRoot+'/stuffing/add'" role="button" v-if="['0101', '1111'].indexOf(all_permissions) >= 0">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewStuffing" @edit-object="prepareEditStuffing" @toggle-object-status="toggleObjectStatus" @export-object="printStuffing"  @duplicate-object="duplicateObject"></DataTableComponent>
			</div>
		</div>
	</div>
</template>
<script>
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
			// allCompanyIdList: [],
			// allCustomerIdList: [],
			// allSurveyorIdList: [],
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
		saveStuffing(stuffingForAdd){
			var that = this;
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/stuffing/save', { stuffing: stuffingForAdd }).then(async function (response) {
				that.closeSwal();
				var status = response.data.status;
				if( status > 0 ){
					// Set the ID so that duplicate records will not be created
					that.stuffingForAdd.id = response.data.id;
					that.showToast('Stuffing saved successfully', 'success', 'bottom', 3000);
					setTimeout(() => {
						that.dataprops.reload = true;
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
		toggleObjectStatus(stuffing, status){
			var that = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to " + (status == 1 ? "activate" : "deactivate") + ' the stuffing record?',
				showCancelButton: true
			}).then((result) => {
				if (result.isConfirmed) {
					that.stuffingForAdd = stuffing;
					that.stuffingForAdd.status = status;
					that.stuffingForAdd.action = "status";
					that.saveStuffing(that.stuffingForAdd);
				}
			});
		},
		printStuffing(stuffing) {
			window.location = this.docRoot+'/stuffing/export-to-pdf/' + stuffing.id;
			this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
		},
	},
	async mounted() {
		// this.allCompanyIdList = await this.loadAllCompany(this.docRoot+'/company',{});
		// this.allCustomerIdList = await this.loadAllCustomer(this.docRoot+'/customer',{});
		// this.allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/surveyor',{});
	}
}
</script>
