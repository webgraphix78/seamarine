<template>
	<div id="cleaninglocation-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">CLEANING LOCATION</h4>
							<a id="add_cleaninglocation_btn" class="btn btn-success btn-sm" href="#" role="button" data-bs-toggle="modal" data-bs-target="#addCleaningLocationModal" v-if="['110', '111'].indexOf(all_permissions) >= 0">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewCleaningLocation" @edit-object="prepareEditCleaningLocation" @toggle-object-status="toggleCleaningLocation"></DataTableComponent>
			</div>
		</div>
		<div class="modal fade" ref="addEditModal" id="addCleaningLocationModal" tabindex="-1" aria-labelledby="addCleaningLocationModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addCleaningLocationModalLabel">ADD CleaningLocation</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_cleaninglocation_name" class="form-label text-uppercase fw-bold me-3">Name <span class="mandatory">*</span></label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="text" class="form-control" v-model="cleaninglocationForAdd.name" id="add_cleaninglocation_name" placeholder="Enter Name" />
								</div>
								<template v-for="error of v$.cleaninglocationForAdd.name.$errors" :key="error.$uid">
									<div class="mandatory mb-1">{{ error.$message }}</div>
								</template>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal" @click="cancelAddEdit()">CLOSE</button>
						<button type="button" class="btn btn-dark btn-sm" @click="saveCleaningLocation()">SAVE CHANGES</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" ref="readModal" id="readCleaningLocationModal" tabindex="-1" aria-labelledby="readCleaningLocationModalLabel" aria-hidden="true" v-if="readCleaningLocation">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="readCleaningLocationModalLabel">View CleaningLocation</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Name</label>
								<div>
									<span v-if="readCleaningLocation.name">{{ readCleaningLocation.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Status</label>
								<div>
									<span class="badge rounded-pill bg-success" v-if="readCleaningLocation.status == 1">ACTIVE</span>
									<span class="badge rounded-pill bg-danger" v-if="readCleaningLocation.status == 0">INACTIVE</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Created By</label>
								<div>
									<span v-if="readCleaningLocation.creator?.name">{{ readCleaningLocation.creator?.name }}</span
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
			name: "",
			action: ""
		};
	}
	function initialStateValidations() {
		return {
			name: {required, minLengthValue: minLength(1)}
		};
	}
	export default {
		name: "CleaningLocationmaster",
		props: ["current_user_id", "all_permissions"],
		setup() {
			return {
				v$: useVuelidate()
			};
		},
		data() {
			return {
				dataprops: {
					id: "cleaninglocation-list",
					class: "a",
					base_url: this.docRoot+"/api/cleaninglocation/",
					columns: [
						{title: "Name", property: "name", sortable: true},
						{title: "Created By", property: "creator.name", alt_value: "Not Specified"}
					],
					data_to_send: {current_user_id: this.current_user_id},
					reload: false,
					search: "simple"
				},
				addEditModal: null,
				readModal: null,
				currentUser: siteUserObject,
				cleaninglocationForAdd: initialState(),
				readCleaningLocation: {}
			};
		},
		validations() {
			return {
				cleaninglocationForAdd: initialStateValidations()
			};
		},
		methods: {
			cancelAddEdit(event) {
				this.cleaninglocationForAdd = initialState();
				this.v$.$reset();
			},
			async saveCleaningLocation(event) {
				var thisVar = this;
				const result = await this.v$.$validate();
				if (!result) {
					this.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
					console.log(this.v$.$errors);
					return;
				}
				if (!this.cleaninglocationForAdd.action || this.cleaninglocationForAdd.action == "") this.cleaninglocationForAdd.action = "details";
				this.cleaninglocationForAdd.created_by = this.current_user_id;
				$("#addCleaningLocationModal").modal("hide");
				this.showLoading("Saving ...");
				axios
					.post(this.docRoot+"/cleaninglocation/save", {cleaninglocation: this.cleaninglocationForAdd})
					.then(async function (response) {
						thisVar.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							thisVar.showToast("Cleaning Location saved successfully", "success", "bottom", 3000);
							setTimeout(() => {
								thisVar.dataprops.reload = true;
							}, 1500);
							thisVar.cleaninglocationForAdd = initialState();
							thisVar.v$.$reset();
						} else thisVar.showErrors("Cleaning Location could not be saved successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						thisVar.closeSwal();
						thisVar.showToast("Cleaning Location could not be saved successfully", "error", "bottom", 3000);
					});
			},
			prepareEditCleaningLocation(cleaninglocation) {
				this.cleaninglocationForAdd = Object.assign({}, cleaninglocation);
				this.addEditModal.show();
			},
			viewCleaningLocation(cleaninglocation) {
				this.readCleaningLocation = cleaninglocation;
				this.readModal.show();
			},
			toggleCleaningLocation(cleaninglocation, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the Cleaning Location - <br/>"' + cleaninglocation.name + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.cleaninglocationForAdd = cleaninglocation;
						thisVar.cleaninglocationForAdd.status = status;
						thisVar.cleaninglocationForAdd.action = "status";
						thisVar.saveCleaningLocation();
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
