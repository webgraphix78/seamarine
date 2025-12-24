<template>
	<div id="depotconditionsurvey-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4 text-capitalize">depot condition survey</h4>
							<a id="add_depotconditionsurvey_btn" class="btn btn-success border-dark btn-sm" :href="this.docRoot+'/depotconditionsurvey/add'" role="button" v-if="['0101', '1111'].indexOf(all_permissions) >= 0">Add</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewDepotConditionSurvey" @edit-object="prepareEditDepotConditionSurvey" @upload-Object="uploadImages" @toggle-object-status="toggleObjectStatus" @export-object="printDepotConditionSurvey"  @duplicate-object="duplicateObject"></DataTableComponent>
				<!-- Upload Images -->
				<UploadImages :dataprops="uploadDataprops" @refresh-object="refreshObject"></UploadImages>
				<!-- Upload Images -->
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
					{ title: 'Ref No', property: 'ref_no', sortable: true, },
					{ title: 'Tank No', property: 'tank_no', sortable: true, },
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
			uploadDataprops: {
				relatedObject: null,
				name: "depot_condition_survey",
			},
			addeditModal: null,
			viewModal: null,
			currentUser: siteUserObject,
			readDepotConditionSurvey: {},
			depotconditionsurveyForAdd: {},
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
		saveDepotConditionSurvey(depotconditionsurveyForAdd){
			var that = this;
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/depotconditionsurvey/save', { depotconditionsurvey: depotconditionsurveyForAdd }).then(async function (response) {
				that.closeSwal();
				var status = response.data.status;
				if( status > 0 ){
					// Set the ID so that duplicate records will not be created
					that.depotconditionsurveyForAdd.id = response.data.id;
					that.showToast('Depot Condition Survey saved successfully', 'success', 'bottom', 3000);
					setTimeout(() => {
						that.dataprops.reload = true;
						that.showLoading("Loading ...");
					}, 1500);
				}
				else{
					that.showErrors("Depot Condition Survey could not be saved successfully.", response.data.messages, "bottom", 3000);
				}
			})
			.catch(function (error) {
				console.log(error);
				that.closeSwal();
				that.showToast("Depot Condition Survey could not be saved successfully.", "error", "bottom", 3000);
			});
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
		toggleObjectStatus(depotconditionsurvey, status){
			var that = this;
			Swal.fire({
				icon: "question",
				html: "Do you really want to " + (status == 1 ? "activate" : "deactivate") + ' the Depot Condition Survey record?',
				showCancelButton: true
			}).then((result) => {
				if (result.isConfirmed) {
					that.depotconditionsurveyForAdd = depotconditionsurvey;
					that.depotconditionsurveyForAdd.status = status;
					that.depotconditionsurveyForAdd.action = "status";
					that.saveDepotConditionSurvey(that.depotconditionsurveyForAdd);
				}
			});
		},
		printDepotConditionSurvey(depotconditionsurvey) {
			window.location = this.docRoot+'/depotconditionsurvey/export-to-pdf/' + depotconditionsurvey.id;
			this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
		},
		async uploadImages(depotconditionsurvey) {
			this.showLoading("Loading images ...");
			await this.refreshObject(depotconditionsurvey, "depot_condition_survey", 1);
			this.closeSwal();
		},
	},
	async mounted() {
	}
}
</script>
