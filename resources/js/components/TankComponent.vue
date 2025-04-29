<template>
	<div id="tank-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">TANK TYPE</h4>
							<a id="add_tank_btn" class="btn btn-success btn-sm" href="#" role="button" data-bs-toggle="modal" data-bs-target="#addTankModal" v-if="['110', '111'].indexOf(all_permissions) >= 0">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewTank" @edit-object="prepareEditTank" @toggle-object-status="toggleTank"></DataTableComponent>
			</div>
		</div>
		<div class="modal fade" ref="addEditModal" id="addTankModal" tabindex="-1" aria-labelledby="addTankModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addTankModalLabel">ADD Tank</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_tank_type" class="form-label text-uppercase fw-bold me-3">Type <span class="mandatory">*</span></label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<!-- <input type="text" class="form-control" v-model="tankForAdd.type" id="add_tank_type" placeholder="Enter Type" /> -->
									<MaskInput v-model="tankForAdd.type" mask="XXXXXXX" class="form-control" textmode="uppercase"/>
								</div>
								<template v-for="error of v$.tankForAdd.type.$errors" :key="error.$uid">
									<div class="mandatory mb-1">{{ error.$message }}</div>
								</template>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal" @click="cancelAddEdit()">CLOSE</button>
						<button type="button" class="btn btn-dark btn-sm" @click="saveTank()">SAVE CHANGES</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" ref="readModal" id="readTankModal" tabindex="-1" aria-labelledby="readTankModalLabel" aria-hidden="true" v-if="readTank">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="readTankModalLabel">View Tank</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Type</label>
								<div>
									<span v-if="readTank.type">{{ readTank.type }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Status</label>
								<div>
									<span class="badge rounded-pill bg-success" v-if="readTank.status == 1">ACTIVE</span>
									<span class="badge rounded-pill bg-danger" v-if="readTank.status == 0">INACTIVE</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Created By</label>
								<div>
									<span v-if="readTank.creator?.name">{{ readTank.creator?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">CLOSE</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import {useVuelidate} from "@vuelidate/core";
	import {required, minValue, alphaNum, numeric, email, requiredIf, minLength} from "@vuelidate/validators";
	import * as bootstrap from "bootstrap";
	function initialState() {
		return {
			id: 0,
			type: "",
			action: ""
		};
	}
	function initialStateValidations() {
		return {
			type: {required, minLengthValue: minLength(1)}
		};
	}
	export default {
		name: "TankTypeMaster",
		props: ["current_user_id", "all_permissions"],
		setup() {
			return {
				v$: useVuelidate()
			};
		},
		data() {
			return {
				dataprops: {
					id: "tanktype-list",
					class: "a",
					base_url: this.docRoot + "/api/tanktype/",
					columns: [
						{title: "Type", property: "type", sortable: true},
						{title: "Created By", property: "creator.name", alt_value: "Not Specified"}
					],
					data_to_send: {current_user_id: this.current_user_id},
					reload: false,
					search: "simple"
				},
				addEditModal: null,
				readModal: null,
				currentUser: siteUserObject,
				tankForAdd: initialState(),
				readTank: {}
			};
		},
		validations() {
			return {
				tankForAdd: initialStateValidations()
			};
		},
		methods: {
			cancelAddEdit(event) {
				this.tankForAdd = initialState();
				this.v$.$reset();
			},
			async saveTank(event) {
				var thisVar = this;
				const result = await this.v$.$validate();
				if (!result) {
					this.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
					console.log(this.v$.$errors);
					return;
				}
				if (!this.tankForAdd.action || this.tankForAdd.action == "") this.tankForAdd.action = "details";
				this.tankForAdd.created_by = this.current_user_id;
				$("#addTankModal").modal("hide");
				this.showLoading("Saving ...");
				axios
					.post(this.docRoot + "/tanktype/save", {tanktype: this.tankForAdd})
					.then(async function (response) {
						thisVar.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							thisVar.showToast("Tank Type saved successfully", "success", "bottom", 3000);
							setTimeout(() => {
								thisVar.dataprops.reload = true;
							}, 1500);
							thisVar.tankForAdd = initialState();
							thisVar.v$.$reset();
						} else thisVar.showErrors("Tank Type could not be saved successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						thisVar.closeSwal();
						thisVar.showToast("Tank Type could not be saved successfully", "error", "bottom", 3000);
					});
			},
			prepareEditTank(tank) {
				this.tankForAdd = Object.assign({}, tank);
				this.addEditModal.show();
			},
			viewTank(tank) {
				this.readTank = tank;
				this.readModal.show();
			},
			toggleTank(tank, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the Tank Type - <br/>"' + tank.type + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.tankForAdd = tank;
						thisVar.tankForAdd.status = status;
						thisVar.tankForAdd.action = "status";
						thisVar.saveTank();
					}
				});
			}
		},
		async mounted() {
			this.addEditModal = new bootstrap.Modal(this.$refs.addEditModal, {backdrop: "static", keyboard: false});
			this.readModal = new bootstrap.Modal(this.$refs.readModal, {backdrop: "static", keyboard: false});
		}
	};
</script>
