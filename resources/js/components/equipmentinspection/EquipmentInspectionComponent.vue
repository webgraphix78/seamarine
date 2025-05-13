<template>
	<div id="equipmentinspection-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">equipment inspection</h4>
							<a id="add_equipmentinspection_btn" class="btn btn-success btn-sm" :href="this.docRoot+'/equipmentinspection/add'" role="button">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewEquipmentInspection" @edit-object="prepareEditEquipmentInspection" @toggle-object-status="deleteEquipmentInspection"  @export-object="printEquipmentInspection"  @duplicate-object="duplicateObject"></DataTableComponent>
			</div>
		</div>
		
		
	</div>
</template>
<script>
import * as bootstrap from 'bootstrap';
export default {
	name: "EquipmentInspectionmaster",
	props: ['current_user_id', 'all_permissions'],
	data(){
		return{
			dataprops: {
				id: 'equipmentinspection-list',
				class: 'a',
				base_url: '/api/equipmentinspection/',
				columns: [
					{ title: 'Ref No', property: 'ref_no', sortable: true, },
					{ title: 'Company Name', property: 'rel_company_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'Inspection Date', property: 'inspection_date', sortable: true, },
					{ title: 'Tank Number', property: 'tank_no', sortable: true, },
					{ title: 'Last Cargo Carried', property: 'last_cargo_carried', sortable: true, },
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
						},                        
						{
							title: "Inspection Date",
							property: "inspection_date",
							type: "text",
							
						},                        
						{
							title: "Tank Number",
							property: "tank_no",
							type: "text",
							
						},                        
						{
							title: "Last Cargo Carried",
							property: "last_cargo_carried",
							type: "text",
							
						},                        
						{
							title: "Empty Clean",
							property: "empty_clean",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' }, { id: '-1', value: 'NA' },  ]
						},                        
						{
							title: "Empty Dirty",
							property: "empty_dirty",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' }, { id: '-1', value: 'NA' },  ]
						},                        
						{
							title: "Loaded",
							property: "loaded",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' }, { id: '-1', value: 'NA' },  ]
						},                        
						{
							title: "Surveyor Id",
							property: "surveyor_id",
							type: "relation",
							source: { api: 'user', id: 'id', value: 'name' } 
						},                        {
							title: "Status",
							property: "eq_inspection_status",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Import' }, { id: '2', value: 'Export' },  ]
						},                        
						{
							title: "Equipment Type",
							property: "equipment_type",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Loaded' }, { id: '0', value: 'Unloaded' },  ]
						},                        
						{
							title: "Tank Type",
							property: "tank_type",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'IMO 1' }, { id: '2', value: 'IMO 5' },  ]
						},                        
						{
							title: "CFS",
							property: "cfs",
							type: "textoptions",
							source_enum: [ { id: '-1', value: 'NA' }, { id: '1', value: 'In' }, { id: '0', value: 'Out' },  ]
						},                        
						{
							title: "For Id",
							property: "for_id",
							type: "relation",
							source: { api: 'user', id: 'id', value: 'name' } 
						},                        
						{
							title: "Inspection Location",
							property: "inspection_location_id",
							type: "relation",
							source: { api: 'user', id: 'id', value: 'name' } 
						},                        
						{
							title: "Customer",
							property: "customer_id",
							type: "relation",
							source: { api: 'user', id: 'id', value: 'name' } 
						},
					]
				},
				search: "simple"
			},
			addeditModal: null,
			viewModal: null,
			currentUser: siteUserObject,
			readEquipmentInspection: {},
			equipmentinspectionForAdd: {},
			allCompanyIdList: [],
			allSurveyorIdList: [],
			allForIdList: [],
			allInspectionLocationIdList: [],
			allCustomerIdList: [],
		}
	},
	methods: {
		canceladdedit(event){
			this.equipmentinspectionForAdd.closed = true;
		},
		prepareEditEquipmentInspection(equipmentinspection){
			window.location = this.docRoot + '/equipmentinspection/edit/' + equipmentinspection.id;
		},
		viewEquipmentInspection(equipmentinspection){
			window.location = this.docRoot + '/equipmentinspection/view/' + equipmentinspection.id;
		},
		prepareAddModal(obj){
			this.equipmentinspectionForAdd = Object.assign({});
		},
		saveEquipmentInspection(){
			this.equipmentinspectionForAdd.reload = true;
		},
		duplicateObject(equipmentinspection) {
			let that = this;
			this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
				if (result.isConfirmed) {
					// Call AXIOS to duplicate the invoice and then open in EDIT Mode
					this.showLoading("Saving ...");
					axios.post(this.docRoot+'/equipmentinspection/duplicate', { id: equipmentinspection.id }).then(async function (response) {
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
								window.location = that.docRoot+'/equipmentinspection/edit/' + newId+"?duplicate=1";
							}, 4000);
						}
					});
				}
			});
		},
		deleteEquipmentInspection(equipmentinspection, status){
			var thisVar = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to delete?",
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					axios.post('/equipmentinspection/delete', { id: equipmentinspection.id, status: status })
                        .then(function (response) {
                            if (response.data.status == 1) {
                                thisVar.showToast('EQUIPMENTINSPECTION updated successfully', 'success', 'bottom', 3000);
                                thisVar.dataprops.reload = true;
                            } else {
                                thisVar.showErrors("EQUIPMENTINSPECTION could not be updated successfully", response.data.messages, "bottom", 3000);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                            thisVar.showToast("EQUIPMENTINSPECTION could not be updated successfully", "error", "bottom", 3000);
                        });
				}
			});
		},
		printEquipmentInspection(equipmentinspection) {
			window.location = this.docRoot+'/equipmentinspection/export-to-pdf/' + equipmentinspection.id;
			this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
		},
	},
	async mounted() {
		this.allEmptyCleanList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, { id: '-1', title: 'NA'}, ];
		this.allEmptyDirtyList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, { id: '-1', title: 'NA'}, ];
		this.allLoadedList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, { id: '-1', title: 'NA'}, ];
		this.allEqInspectionStatusList = [{ id: '1', title: 'Import'}, { id: '2', title: 'Export'}, ];
		this.allEquipmentTypeList = [{ id: '1', title: 'Loaded'}, { id: '0', title: 'Unloaded'}, ];
		this.allTankTypeList = [{ id: '1', title: 'IMO 1'}, { id: '2', title: 'IMO 5'}, ];
		this.allCfsList = [{ id: '-1', title: 'NA'}, { id: '1', title: 'In'}, { id: '0', title: 'Out'}, ];
		this.allCompanyIdList = await this.loadAllCompany(this.docRoot+'/company',{});
		this.allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/surveyor',{});
		this.allForIdList = await this.loadAllCustomer(this.docRoot+'/customer',{});
		this.allInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/inspectionlocation',{});
		this.allCustomerIdList = await this.loadAllCustomer(this.docRoot+'/customer',{});
	}
}
</script>
