<template>
	<div id="depotconditionsurvey-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">depot condition survey</h4>
							<a id="add_depotconditionsurvey_btn" class="btn btn-success border-dark btn-sm" :href="this.docRoot+'/depotconditionsurvey/add'" role="button">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewDepotConditionSurvey" @edit-object="prepareEditDepotConditionSurvey" @toggle-object-status="deleteDepotConditionSurvey" @export-object="printDepotConditionSurvey"  @duplicate-object="duplicateObject"></DataTableComponent>
			</div>
		</div>
	</div>
</template>
<script>
import * as bootstrap from 'bootstrap';
export default {
	name: "DepotConditionSurveymaster",
	props: ['current_user_id', 'all_permissions'],
	data(){
		return{
			dataprops: {
				id: 'depotconditionsurvey-list',
				class: 'a',
				base_url: '/api/depotconditionsurvey/',
				columns: [
					{ title: 'Tank No', property: 'tank_no', sortable: true, },
					{ title: 'Ref No', property: 'ref_no', sortable: true, },
					{ title: 'Company Id', property: 'rel_company_id.name', alt_value: 'Not Specified', sortable: true, },
					{ title: 'Inspection Date', property: 'inspection_date', sortable: true, },
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
							title: "Inspection Date",
							property: "inspection_date",
							type: "text",
							
						},                        
						{
							title: "Customer Id",
							property: "customer_id",
							type: "relation",
							source: { api: 'Customer', id: 'id', value: 'name' } 
						},                        
						{
							title: "Inspection Location Id",
							property: "inspection_location_id",
							type: "relation",
							source: { api: 'InspectionLocation', id: 'id', value: 'name' } 
						},                        
						{
							title: "Protection Cover",
							property: "protection_cover",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Manhole Cover Fastening Bolts",
							property: "manhole_cover_fastening_bolts",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Top Safety Valve",
							property: "top_safety_valve",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Rupture Disc Series",
							property: "rupture_disc_series",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Dipping Pipe",
							property: "dipping_pipe",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Air Valve",
							property: "air_valve",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Dipstick",
							property: "dipstick",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Manhole Gasket",
							property: "manhole_gasket",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Walkway",
							property: "walkway",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Top Loading Flange",
							property: "top_loading_flange",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Heating Plug Pipe",
							property: "heating_plug_pipe",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Heating Pipe Covers",
							property: "heating_pipe_covers",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Bottom Outlet Valve",
							property: "bottom_outlet_valve",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Bottom Valve Cap",
							property: "bottom_valve_cap",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Bottom Valve Bolts Nuts",
							property: "bottom_valve_bolts_nuts",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Bottom Valve Lever",
							property: "bottom_valve_lever",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Ladder",
							property: "ladder",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Document Box",
							property: "document_box",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Thermometer",
							property: "thermometer",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Remote Shut Off",
							property: "remote_shut_off",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Hand Rail",
							property: "hand_rail",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Rust",
							property: "rust",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Discolouration",
							property: "discolouration",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Surface Scoring",
							property: "surface_scoring",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Pitting Surface Pin",
							property: "pitting_surface_pin",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Corrosion Mark",
							property: "corrosion_mark",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Others",
							property: "others",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Framework Front End",
							property: "framework_front_end",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Cladding Front End",
							property: "cladding_front_end",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Framework Rare End",
							property: "framework_rare_end",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Cladding Rare End",
							property: "cladding_rare_end",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Framework Right Side",
							property: "framework_right_side",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Cladding Right Side",
							property: "cladding_right_side",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Framework Left Side",
							property: "framework_left_side",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Cladding Left Side",
							property: "cladding_left_side",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Framework Top",
							property: "framework_top",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Cladding Top",
							property: "cladding_top",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Framework Bottom",
							property: "framework_bottom",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        
						{
							title: "Cladding Bottom",
							property: "cladding_bottom",
							type: "textoptions",
							source_enum: [ { id: '1', value: 'Yes' }, { id: '0', value: 'No' },  ]

						},                        {
							title: "Liquid Inspection Location Id",
							property: "liquid_inspection_location_id",
							type: "relation",
							source: { api: 'InspectionLocation', id: 'id', value: 'name' } 
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
			readDepotConditionSurvey: {},
			depotconditionsurveyForAdd: {},
			allCompanyIdList: [],
			allCustomerIdList: [],
			allInspectionLocationIdList: [],
			allLiquidInspectionLocationIdList: [],
			allSurveyorIdList: [],
		}
	},
	methods: {
		canceladdedit(event){
			this.depotconditionsurveyForAdd.closed = true;
		},
		prepareEditDepotConditionSurvey(depotconditionsurvey){
			window.location = this.docRoot + '/depotconditionsurvey/edit/' + depotconditionsurvey.id;
		},
		viewDepotConditionSurvey(depotconditionsurvey){
			window.location = this.docRoot + '/depotconditionsurvey/view/' + depotconditionsurvey.id;
		},
		prepareAddModal(obj){
			this.depotconditionsurveyForAdd = Object.assign({});
		},
		saveDepotConditionSurvey(){
			this.depotconditionsurveyForAdd.reload = true;
		},
		duplicateObject(depotconditionsurvey) {
			let that = this;
			this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
				if (result.isConfirmed) {
					// Call AXIOS to duplicate the invoice and then open in EDIT Mode
					this.showLoading("Saving ...");
					axios.post(this.docRoot+'/depotconditionsurvey/duplicate', { id: depotconditionsurvey.id }).then(async function (response) {
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
								window.location = that.docRoot+'/depotconditionsurvey/edit/' + newId+"?duplicate=1";
							}, 4000);
						}
					});
				}
			});
		},
		deleteDepotConditionSurvey(depotconditionsurvey, status){
			var thisVar = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to delete?",
				showCancelButton: true,
			}).then((result) => {
				if (result.isConfirmed) {
					axios.post('/depotconditionsurvey/delete', { id: depotconditionsurvey.id, status: status })
                        .then(function (response) {
                            if (response.data.status == 1) {
                                thisVar.showToast('DEPOTCONDITIONSURVEY updated successfully', 'success', 'bottom', 3000);
                                thisVar.dataprops.reload = true;
                            } else {
                                thisVar.showErrors("DEPOTCONDITIONSURVEY could not be updated successfully", response.data.messages, "bottom", 3000);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                            thisVar.showToast("DEPOTCONDITIONSURVEY could not be updated successfully", "error", "bottom", 3000);
                        });
				}
			});
		},
		printDepotConditionSurvey(depotconditionsurvey) {
			window.location = this.docRoot+'/depotconditionsurvey/export-to-pdf/' + depotconditionsurvey.id;
			this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
		},
	},
	async mounted() {
		this.allCompanyIdList = await this.loadAllCompany(this.docRoot+'/company',{});
		this.allCustomerIdList = await this.loadAllCustomer(this.docRoot+'/customer',{});
		this.allInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/inspectionlocation',{});
		this.allProtectionCoverList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allManholeCoverFasteningBoltsList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allTopSafetyValveList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allRuptureDiscSeriesList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allDippingPipeList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allAirValveList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allDipstickList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allManholeGasketList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allWalkwayList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allTopLoadingFlangeList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allHeatingPlugPipeList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allHeatingPipeCoversList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allBottomOutletValveList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allBottomValveCapList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allBottomValveBoltsNutsList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allBottomValveLeverList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allLadderList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allDocumentBoxList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allThermometerList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allRemoteShutOffList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allHandRailList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allRustList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allDiscolourationList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allSurfaceScoringList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allPittingSurfacePinList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allCorrosionMarkList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allOthersList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allFrameworkFrontEndList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allCladdingFrontEndList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allFrameworkRareEndList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allCladdingRareEndList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allFrameworkRightSideList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allCladdingRightSideList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allFrameworkLeftSideList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allCladdingLeftSideList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allFrameworkTopList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allCladdingTopList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allFrameworkBottomList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allCladdingBottomList = [{ id: '1', title: 'Yes'}, { id: '0', title: 'No'}, ];
		this.allLiquidInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/inspectionlocation',{});
		this.allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/surveyor',{});
	}
}
</script>
