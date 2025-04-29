<template>
	<div id="onhire-read-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">VIEW ON-HIRE RECORD</h4>
							<a class="btn btn-outline-success btn-sm" :href="docRoot+'/onhire'">Back to list</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Company</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.company?.name">{{ readOnhire.company?.name }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Ref No</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.ref_no">{{ readOnhire.ref_no }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Customer</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.customer?.name">{{ readOnhire.customer?.name }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Survey Type</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.survey_type == '1'">On-Hire</span>
					<span v-if="readOnhire.survey_type == '2'">Off-Hire</span>
					<span v-if="readOnhire.survey_type == '3'">Condition</span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Date</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.inspection_date">{{ readOnhire.inspection_date }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Location</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.inspection_location?.name">{{ readOnhire.inspection_location?.name }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Form for Liquid Tanks</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.form_liquid_tanks == '1'">Food</span>
					<span v-if="readOnhire.form_liquid_tanks == '2'">Chemicals</span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Surveyor</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.surveyor?.name">{{ readOnhire.surveyor?.name }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Unit Nr</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.unit_nr">{{ readOnhire.unit_nr }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Tank Type Id</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.tank_type?.type">{{ readOnhire.tank_type?.type }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Tcode</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.tcode?.name">{{ readOnhire.tcode?.name }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Manufacturer</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.manufacturer">{{ readOnhire.manufacturer }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Iso Type</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.iso_type">{{ readOnhire.iso_type }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Adr</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.adr">{{ readOnhire.adr }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Serial No</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.serial_no">{{ readOnhire.serial_no }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-6">
				<div class="row">
					<div class="col-3 text-end">
						<label class="form-label text-uppercase fw-bold m-0">First Test</label>
					</div>
					<div class="col-3">
						<div>
							<span v-if="readOnhire.first_test">{{ readOnhire.first_test }}</span
							><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-3 text-end">
						<label class="form-label text-uppercase fw-bold m-0">By</label>
					</div>
					<div class="col-3">
						<div>
							<span v-if="readOnhire.first_by">{{ readOnhire.first_by }}</span
							><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-3 text-end">
						<label class="form-label text-uppercase fw-bold m-0">Last 2.5yr</label>
					</div>
					<div class="col-3">
						<div>
							<span v-if="readOnhire.last_25">{{ readOnhire.last_25 }}</span
							><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-3 text-end">
						<label class="form-label text-uppercase fw-bold m-0">By</label>
					</div>
					<div class="col-3">
						<div>
							<span v-if="readOnhire.last_25_by">{{ readOnhire.last_25_by }}</span
							><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-6">
				<div class="row">
					<div class="col-3 text-end">
						<label class="form-label text-uppercase fw-bold m-0">Last 5yr</label>
					</div>
					<div class="col-3">
						<div>
							<span v-if="readOnhire.last_5">{{ readOnhire.last_5 }}</span
							><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-3 text-end">
						<label class="form-label text-uppercase fw-bold m-0">By</label>
					</div>
					<div class="col-3">
						<div>
							<span v-if="readOnhire.last_5_by">{{ readOnhire.last_5_by }}</span
							><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-3 text-end">
						<label class="form-label text-uppercase fw-bold m-0">Next Due Date</label>
					</div>
					<div class="col-3">
						<div>
							<span v-if="readOnhire.next_due_date">{{ readOnhire.next_due_date }}</span
							><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-3 text-end">
						<label class="form-label text-uppercase fw-bold m-0">Csc Acep Date</label>
					</div>
					<div class="col-3">
						<div>
							<span v-if="readOnhire.csc_acep_date">{{ readOnhire.csc_acep_date }}</span
							><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Max Gross Wgt</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.max_gross_wgt">{{ readOnhire.max_gross_wgt }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Tare Wgt</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.tare_wgt">{{ readOnhire.tare_wgt }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Capacity</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.capacity">{{ readOnhire.capacity }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Mawp</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.mawp">{{ readOnhire.mawp }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Test Pressure</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.test_pressure">{{ readOnhire.test_pressure }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Steam Tube Wp</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.steam_tube_wp">{{ readOnhire.steam_tube_wp }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Steam Test Pressure</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.steam_test_pressure">{{ readOnhire.steam_test_pressure }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Shell Tank Material</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.shell_tank_material">{{ readOnhire.shell_tank_material }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Shell Head</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.shell_head">{{ readOnhire.shell_head }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Shell Thickness</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.shell_thickness">{{ readOnhire.shell_thickness }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Shell Head Thickness</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.shell_head_thickness">{{ readOnhire.shell_head_thickness }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Walkway Image 1</label>
			</div>
			<div class="col-3">
				<template v-if="readOnhire.walkway_image_1">
					<a href="#" data-bs-toggle="modal" data-bs-target="#mdl_walkway_image_1">Image 1</a>
				</template>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Walkway Image 2</label>
			</div>
			<div class="col-3">
				<template v-if="readOnhire.walkway_image_2">
					<a href="#" data-bs-toggle="modal" data-bs-target="#mdl_walkway_image_2">Image 2</a>
				</template>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Comment 1</label>
			</div>
			<div class="col-3">
				<span v-if="readOnhire.comment_1">{{ readOnhire.comment_1 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Comment 2</label>
			</div>
			<div class="col-3">
				<span v-if="readOnhire.comment_2">{{ readOnhire.comment_2 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-2 border-bottom">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Status</label>
			</div>
			<div class="col-3">
				<div>
					<span class="badge rounded-pill bg-success" v-if="readOnhire.status == 1">ACTIVE</span>
					<span class="badge rounded-pill bg-danger" v-if="readOnhire.status == 0">INACTIVE</span>
				</div>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Created By</label>
			</div>
			<div class="col-3">
				<div>
					<span v-if="readOnhire.creator?.name">{{ readOnhire.creator?.name }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<!-- Walkway image 1 -->
		<div class="modal fade" id="mdl_walkway_image_1" tabindex="-1" aria-labelledby="mdl_walkway_image_1Label" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="mdl_walkway_image_1Label">Walkway Image 1</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<img :src="'/onhire/view-file/1/'+readOnhire.id+'/123'" class="img-fluid">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Walkway image 1 -->
		<!-- Walkway image 2 -->
		<div class="modal fade" id="mdl_walkway_image_2" tabindex="-1" aria-labelledby="mdl_walkway_image_2Label" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="mdl_walkway_image_2Label">Walkway Image 2</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<img :src="'/onhire/view-file/2/'+readOnhire.id+'/123'" class="img-fluid">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Walkway image 2 -->
		<!-- Main child -->
		<onhiremain-view-component :main-object="mainObject"></onhiremain-view-component>
		<!-- Main child -->
		<onhireancillary-view-component :main-object="ancillaryObject"></onhireancillary-view-component>
		<onhireunitnr-view-component :main-object="unitnrObject"></onhireunitnr-view-component>
	</div>
</template>
<script>
	export default {
		name: "ViewOnhiremaster",
		props: ["current_user_id", "all_permissions", "id"],
		data() {
			return {
				currentUser: siteUserObject,
				readOnhire: {},
				mainObject: {},
				ancillaryObject: {},
				unitnrObject: {}
			};
		},
		methods: {
			reloadEverything() {
				if (this.id !== undefined && !isNaN(this.id)) {
					var that = this;
					var URL = this.docRoot + "/api/onhire/get-record/" + this.id;
					this.showLoading("Loading ...");
					axios
						.post(URL, {})
						.then(function (response) {
							that.closeSwal();
							that.readOnhire = Object.assign({}, response.data);
							if (that.readOnhire.main) {
								that.mainObject = that.readOnhire.main;
								that.mainObject.refresh = true;
							}
							if (that.readOnhire.ancillary) {
								that.ancillaryObject = that.readOnhire.ancillary;
								that.ancillaryObject.refresh = true;
							}
							if (that.readOnhire.unitnr) {
								that.unitnrObject = that.readOnhire.unitnr;
								that.unitnrObject.refresh = true;
							}
						})
						.catch(function (error) {
							console.log(error);
						});
				}
			}
		},
		async mounted() {
			this.reloadEverything();
		}
	};
</script>
