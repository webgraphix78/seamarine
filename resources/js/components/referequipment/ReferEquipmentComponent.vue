<template>
	<div id="referequipment-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">referequipment</h4>
							<a id="add_referequipment_btn" class="btn btn-warning border-dark btn-sm" :href="this.docRoot+'/referequipment/add'" role="button">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewReferEquipment" @edit-object="prepareEditReferEquipment" @toggle-object-status="deleteReferEquipment"></DataTableComponent>
			</div>
		</div>
	</div>
</template>
<script>
import * as bootstrap from 'bootstrap';
export default {
	name: "ReferEquipmentmaster",
	props: ['current_user_id', 'all_permissions'],
	data(){
		return{
			dataprops: {
				id: 'referequipment-list',
				class: 'a',
				base_url: '/api/referequipment/',
				columns: [
					{ title: 'Ref No', property: 'ref_no', sortable: true, },
					{ title: 'Company Id', property: 'rel_company_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'Inspection Date', property: 'inspection_date', sortable: true, },
					{ title: 'Inspection Location Id', property: 'rel_inspection_location_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'Customer Id', property: 'rel_customer_id.name', alt_value: 'Not Specified', },
					{ title: 'Tank No', property: 'tank_no' },

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
							source: { api: 'user', id: 'id', value: 'name' } 
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
							source: { api: 'user', id: 'id', value: 'name' } 
						},
						{
							title: "Customer Id",
							property: "customer_id",
							type: "relation",
							source: { api: 'user', id: 'id', value: 'name' } 
						},
						{
							title: "Container Type",
							property: "container_type",
							type: "textoptions",
							source_enum: [ { id: '1', value: '20RF' }, { id: '2', value: '40RF' },  ]

						},
						{
							title: "Surveyor Id",
							property: "surveyor_id",
							type: "relation",
							source: { api: 'user', id: 'id', value: 'name' } 
						},
						{
							title: "Tank No",
							property: "tank_no",
							type: "text",
							
						},
					]
				}
			},
			addeditModal: null,
			viewModal: null,
			currentUser: siteUserObject,
			readReferEquipment: {},
			referequipmentForAdd: {},
			allCompanyIdList: [],
			allInspectionLocationIdList: [],
			allCustomerIdList: [],
			allSurveyorIdList: [],

		}
	},
	methods: {
		canceladdedit(event){
			this.referequipmentForAdd.closed = true;
		},
		prepareEditReferEquipment(referequipment){
			window.location = this.docRoot + '/referequipment/edit/' + referequipment.id;
		},
		viewReferEquipment(referequipment){
			window.location = this.docRoot + '/referequipment/view/' + referequipment.id;
		},
		prepareAddModal(obj){
			this.referequipmentForAdd = Object.assign({});
		},
		saveReferEquipment(){
			this.referequipmentForAdd.reload = true;
		},
		duplicateObject(referequipment) {
			let that = this;
			this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
				if (result.isConfirmed) {
					// Call AXIOS to duplicate the invoice and then open in EDIT Mode
					this.showLoading("Saving ...");
					axios.post(this.docRoot+'/referequipment/duplicate', { id: referequipment.id }).then(async function (response) {
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
								window.location = that.docRoot+'/referequipment/edit/' + newId+"?duplicate=1";
							}, 4000);
						}
					});
				}
			});
		},
		deleteReferEquipment(referequipment, status){
			var thisVar = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to delete?",
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					axios.post('/referequipment/delete', { id: referequipment.id, status: status })
                        .then(function (response) {
                            if (response.data.status == 1) {
                                thisVar.showToast('REFEREQUIPMENT updated successfully', 'success', 'bottom', 3000);
                                thisVar.dataprops.reload = true;
                            } else {
                                thisVar.showErrors("REFEREQUIPMENT could not be updated successfully", response.data.messages, "bottom", 3000);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                            thisVar.showToast("REFEREQUIPMENT could not be updated successfully", "error", "bottom", 3000);
                        });
				}
			});
		},
		printReferEquipment(referequipment) {
			window.location = this.docRoot+'/referequipment/export-to-pdf/' + referequipment.id;
			this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
		},
	},
	async mounted() {
		this.allCompanyIdList = await this.loadMasterData(this.docRoot+'/user',{});
		this.allInspectionLocationIdList = await this.loadMasterData(this.docRoot+'/user',{});
		this.allCustomerIdList = await this.loadMasterData(this.docRoot+'/user',{});
		this.allContainerTypeList = [{ id: '1', title: '20RF'}, { id: '2', title: '40RF'}, ];
		this.allSurveyorIdList = await this.loadMasterData(this.docRoot+'/user',{});

	}
}
</script>