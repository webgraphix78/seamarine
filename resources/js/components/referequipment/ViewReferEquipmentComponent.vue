<template>
	<div id="referequipment-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_referequipment_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/referequipment'" role="button"><i class="ph ph-arrow-left"></i>Back to list</a>
					<h4 class="m-0 text-capitalize">View referequipment</h4>
				</div>
			</div>
		</div>
		<div class="row py-2 bg-dark mb-3">
			<h4 class="fw-bold text-white text-center m-0">Add Record in the System.</h4>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Ref No</label>
				<div>
					<span v-if='readReferEquipment.ref_no'>{{ readReferEquipment.ref_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Company Id</label>
				<div>
					<span v-if='readReferEquipment.rel_company_id?.name'>{{ readReferEquipment.rel_company_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6"></div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Date</label>
				<div>
					<span v-if='readReferEquipment.inspection_date'>{{ readReferEquipment.inspection_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Location Id</label>
				<div>
					<span v-if='readReferEquipment.rel_inspection_location_id?.name'>{{ readReferEquipment.rel_inspection_location_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Customer Id</label>
				<div>
					<span v-if='readReferEquipment.rel_customer_id?.name'>{{ readReferEquipment.rel_customer_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Tank No</label>
				<div>
					<span v-if='readReferEquipment.tank_no'>{{ readReferEquipment.tank_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Shipping Agency</label>
				<div>
					<span v-if='readReferEquipment.shipping_agency'>{{ readReferEquipment.shipping_agency }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Container Type</label>
				<div>
					<span v-if="parsedcontainer_type?.id=='1'">20RF</span>
					<span v-if="parsedcontainer_type?.id=='2'">40RF</span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Booking No</label>
				<div>
					<span v-if='readReferEquipment.booking_no'>{{ readReferEquipment.booking_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Model</label>
				<div>
					<span v-if='readReferEquipment.model'>{{ readReferEquipment.model }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Serial</label>
				<div>
					<span v-if='readReferEquipment.serial'>{{ readReferEquipment.serial }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">In Service</label>
				<div>
					<span v-if='readReferEquipment.in_service'>{{ readReferEquipment.in_service }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Date of last Pre-Trip Insp.</label>
				<div>
					<span v-if='readReferEquipment.date_of_last_pretrip'>{{ readReferEquipment.date_of_last_pretrip }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Plugged in to Power Supply & run through</label>
				<div>
					<span v-if='readReferEquipment.run_through'>{{ readReferEquipment.run_through }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Temperature Set (PTI)</label>
				<div>
					<span v-if='readReferEquipment.temperature_set_pti'>{{ readReferEquipment.temperature_set_pti }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-6">
				<label class="form-label text-uppercase fw-bold m-0">Temperature Set Rechecked</label>
				<div>
					<span v-if='readReferEquipment.temperature_set_rechecked'>{{ readReferEquipment.temperature_set_rechecked }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row py-2 bg-dark mb-3">
			<h4 class="fw-bold text-white text-center m-0">Container</h4>
		</div>
		<div class="row mb-4">
			<div class="col-md-6">
				<div class='row gy-4'>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Exterior</label>
						<div>
							<span v-if='readReferEquipment.exterior'>{{ readReferEquipment.exterior }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Exterior Right</label>
						<div>
							<span v-if='readReferEquipment.exterior_right'>{{ readReferEquipment.exterior_right }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Exterior Left</label>
						<div>
							<span v-if='readReferEquipment.exterior_left'>{{ readReferEquipment.exterior_left }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Exterior Front</label>
						<div>
							<span v-if='readReferEquipment.exterior_front'>{{ readReferEquipment.exterior_front }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Exterior Roof</label>
						<div>
							<span v-if='readReferEquipment.exterior_roof'>{{ readReferEquipment.exterior_roof }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Exterior Under</label>
						<div>
							<span v-if='readReferEquipment.exterior_under'>{{ readReferEquipment.exterior_under }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Exterior Rear</label>
						<div>
							<span v-if='readReferEquipment.exterior_rear'>{{ readReferEquipment.exterior_rear }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Exterior Rear Door Right</label>
						<div>
							<span v-if='readReferEquipment.exterior_rear_door_right'>{{ readReferEquipment.exterior_rear_door_right }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Exterior Rear Door Left</label>
						<div>
							<span v-if='readReferEquipment.exterior_rear_door_left'>{{ readReferEquipment.exterior_rear_door_left }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Seaworthiness</label>
						<div>
							<span v-if='readReferEquipment.seaworthiness'>{{ readReferEquipment.seaworthiness }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class='row gy-4'>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Interior</label>
						<div>
							<span v-if='readReferEquipment.interior'>{{ readReferEquipment.interior }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Interior Right</label>
						<div>
							<span v-if='readReferEquipment.interior_right'>{{ readReferEquipment.interior_right }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Interior Left</label>
						<div>
							<span v-if='readReferEquipment.interior_left'>{{ readReferEquipment.interior_left }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Interior Front</label>
						<div>
							<span v-if='readReferEquipment.interior_front'>{{ readReferEquipment.interior_front }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Interior Ceiling</label>
						<div>
							<span v-if='readReferEquipment.interior_ceiling'>{{ readReferEquipment.interior_ceiling }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Interior Floor</label>
						<div>
							<span v-if='readReferEquipment.interior_floor'>{{ readReferEquipment.interior_floor }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Interior Rear</label>
						<div>
							<span v-if='readReferEquipment.interior_rear'>{{ readReferEquipment.interior_rear }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Interior Rear Door Right</label>
						<div>
							<span v-if='readReferEquipment.interior_rear_door_right'>{{ readReferEquipment.interior_rear_door_right }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Interior Rear Door Left</label>
						<div>
							<span v-if='readReferEquipment.interior_rear_door_left'>{{ readReferEquipment.interior_rear_door_left }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Clean Free From Odour</label>
						<div>
							<span v-if='readReferEquipment.clean_free_from_odour'>{{ readReferEquipment.clean_free_from_odour }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row py-2 bg-dark mb-3">
			<h4 class="fw-bold text-white text-center m-0">Refrigeration Machinery</h4>
		</div>
		<div class="row mb-4">
			<div class="col-md-6">
				<div class='row gy-4'>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Cable 440</label>
						<div>
							<span v-if='readReferEquipment.cable_440'>{{ readReferEquipment.cable_440 }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Controller</label>
						<div>
							<span v-if='readReferEquipment.controller'>{{ readReferEquipment.controller }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Transformer</label>
						<div>
							<span v-if='readReferEquipment.transformer'>{{ readReferEquipment.transformer }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Mcb</label>
						<div>
							<span v-if='readReferEquipment.mcb'>{{ readReferEquipment.mcb }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Compressor</label>
						<div>
							<span v-if='readReferEquipment.compressor'>{{ readReferEquipment.compressor }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Unit Bolts Fasteners</label>
						<div>
							<span v-if='readReferEquipment.unit_bolts_fasteners'>{{ readReferEquipment.unit_bolts_fasteners }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class='row gy-4'>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Power Plug 440</label>
						<div>
							<span v-if='readReferEquipment.power_plug_440'>{{ readReferEquipment.power_plug_440 }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Contactors</label>
						<div>
							<span v-if='readReferEquipment.contactors'>{{ readReferEquipment.contactors }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Battery</label>
						<div>
							<span v-if='readReferEquipment.battery'>{{ readReferEquipment.battery }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Display Board</label>
						<div>
							<span v-if='readReferEquipment.display_board'>{{ readReferEquipment.display_board }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Wiring terminals & connections in control boxes</label>
						<div>
							<span v-if='readReferEquipment.wiring_terminals'>{{ readReferEquipment.wiring_terminals }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Plugged in to Power Supply , run through & Temperature  set ⁰ C checked</label>
						<div>
							<span v-if='readReferEquipment.refg_run_through'>{{ readReferEquipment.refg_run_through }}</span>
							<span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class='row mb-4'>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Comments</label>
				<div>
					<span v-if='readReferEquipment.comments'>{{ readReferEquipment.comments }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-12">
				<label class="form-label text-uppercase fw-bold m-0">Surveyor Id</label>
				<div>
					<span v-if='readReferEquipment.rel_surveyor_id?.name'>{{ readReferEquipment.rel_surveyor_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>

	</div>
</template>
<script>
export default {
	name: "ReferEquipmentmaster",
	props: ['current_user_id', 'all_permissions','id','isModal', 'readReferEquipment'],
	data(){
		return{
			currentUser: siteUserObject,
			readReferEquipment: {},
			allCompanyIdList: [],
			allInspectionLocationIdList: [],
			allCustomerIdList: [],
			allSurveyorIdList: [],

		}
	},
	computed: {
		parsedcontainer_type() {
			try {
				if(this.readReferEquipment && this.readReferEquipment.container_type){
					return JSON.parse(this.readReferEquipment.container_type);
				}
			} catch (e) {
				return {};
			}
		}
	},
	methods: {
		cancelAddEdit(event){
			window.location = this.docRoot + '/referequipment';
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/referequipment/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.readReferEquipment = Object.assign({}, response.data);
					})
					.catch(function (error) {
						console.log(error);
					});
			}
		}
	},
	async mounted() {
		if (this.id > 0){
			this.reloadEverything();
		}
	}
}
</script>
