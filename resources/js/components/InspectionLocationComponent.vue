<template>
	<div id="inspectionlocation-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">INSPECTION LOCATION</h4>
							<a id="add_inspectionlocation_btn" class="btn btn-success btn-sm" href="#" role="button" data-bs-toggle="modal" data-bs-target="#addInspectionLocationModal" v-if="['110', '111'].indexOf(all_permissions) >= 0">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewInspectionLocation" @edit-object="prepareEditInspectionLocation" @toggle-object-status="toggleInspectionLocation"></DataTableComponent>
			</div>
		</div>
		<div class="modal fade" ref="addEditModal" id="addInspectionLocationModal" tabindex="-1" aria-labelledby="addInspectionLocationModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addInspectionLocationModalLabel">ADD InspectionLocation</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_inspectionlocation_name" class="form-label text-uppercase fw-bold me-3">Name <span class="mandatory">*</span></label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="text" class="form-control" v-model="inspectionlocationForAdd.name" id="add_inspectionlocation_name" placeholder="Enter Name" />
								</div>
								<template v-for="error of v$.inspectionlocationForAdd.name.$errors" :key="error.$uid">
									<div class="mandatory mb-1">{{ error.$message }}</div>
								</template>
							</div>
							<div class="col-4">
								<label for="add_inspectionlocation_country_id" class="form-label text-uppercase fw-bold me-3">Country <span class="mandatory">*</span></label>
								<div>
									<select class="form-select" v-model="inspectionlocationForAdd.country_id" id="add_country_id">
										<optgroup v-if="allCountryIdList" label="Choose Country">
											<template v-for="countryId in allCountryIdList" :key="countryId.id">
												<option :value="countryId.id">{{ countryId.name }}</option>
											</template>
										</optgroup>
									</select>
								</div>
								<template v-for="error of v$.inspectionlocationForAdd.country_id.$errors" :key="error.$uid">
									<div class="mandatory mb-1">{{ error.$message }}</div>
								</template>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal" @click="cancelAddEdit()">CLOSE</button>
						<button type="button" class="btn btn-dark btn-sm" @click="saveInspectionLocation()">SAVE CHANGES</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" ref="readModal" id="readInspectionLocationModal" tabindex="-1" aria-labelledby="readInspectionLocationModalLabel" aria-hidden="true" v-if="readInspectionLocation">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="readInspectionLocationModalLabel">View InspectionLocation</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Name</label>
								<div>
									<span v-if="readInspectionLocation.name">{{ readInspectionLocation.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Country</label>
								<div>
									<span v-if="readInspectionLocation.country?.name">{{ readInspectionLocation.country?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Status</label>
								<div>
									<span class="badge rounded-pill bg-success" v-if="readInspectionLocation.status == 1">ACTIVE</span>
									<span class="badge rounded-pill bg-danger" v-if="readInspectionLocation.status == 0">INACTIVE</span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Created By</label>
								<div>
									<span v-if="readInspectionLocation.creator?.name">{{ readInspectionLocation.creator?.name }}</span
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
			country_id: null,

			action: ""
		};
	}
	function initialStateValidations() {
		return {
			name: {required, minLengthValue: minLength(1)},
			country_id: {required}
		};
	}
	export default {
		name: "InspectionLocationmaster",
		props: ["current_user_id", "all_permissions"],
		setup() {
			return {
				v$: useVuelidate()
			};
		},
		data() {
			return {
				dataprops: {
					id: "inspectionlocation-list",
					class: "a",
					base_url: this.docRoot + "/api/inspectionlocation/",
					columns: [
						{title: "Name", property: "name", sortable: true},
						{title: "Country", property: "country.name", alt_value: "Not Specified", sortable: true},
						{title: "Created By", property: "creator.name", alt_value: "Not Specified"}
					],
					data_to_send: {current_user_id: this.current_user_id},
					reload: false,
					search: "simple"
				},
				addEditModal: null,
				readModal: null,
				currentUser: siteUserObject,
				inspectionlocationForAdd: initialState(),
				readInspectionLocation: {},
				allCountryIdList: []
			};
		},
		validations() {
			return {
				inspectionlocationForAdd: initialStateValidations()
			};
		},
		methods: {
			cancelAddEdit(event) {
				this.inspectionlocationForAdd = initialState();
				this.v$.$reset();
			},
			async saveInspectionLocation(event) {
				var thisVar = this;
				const result = await this.v$.$validate();
				if (!result) {
					this.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
					console.log(this.v$.$errors);
					return;
				}
				if (!this.inspectionlocationForAdd.action || this.inspectionlocationForAdd.action == "") this.inspectionlocationForAdd.action = "details";
				this.inspectionlocationForAdd.created_by = this.current_user_id;
				$("#addInspectionLocationModal").modal("hide");
				this.showLoading("Saving ...");
				axios
					.post(this.docRoot + "/inspectionlocation/save", {inspectionlocation: this.inspectionlocationForAdd})
					.then(async function (response) {
						thisVar.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							thisVar.showToast("Inspection Location saved successfully", "success", "bottom", 3000);
							setTimeout(() => {
								thisVar.dataprops.reload = true;
							}, 1500);
							thisVar.inspectionlocationForAdd = initialState();
							thisVar.v$.$reset();
							thisVar.allCountryIdList = await thisVar.loadAllCountry(true);
						} else thisVar.showErrors("Inspection Location could not be saved successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						thisVar.closeSwal();
						thisVar.showToast("Inspection Location could not be saved successfully", "error", "bottom", 3000);
					});
			},
			prepareEditInspectionLocation(inspectionlocation) {
				this.inspectionlocationForAdd = Object.assign({}, inspectionlocation);
				this.addEditModal.show();
			},
			viewInspectionLocation(inspectionlocation) {
				this.readInspectionLocation = inspectionlocation;
				this.readModal.show();
			},
			toggleInspectionLocation(inspectionlocation, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the Inspection Location - <br/>"' + inspectionlocation.name + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.inspectionlocationForAdd = inspectionlocation;
						thisVar.inspectionlocationForAdd.status = status;
						thisVar.inspectionlocationForAdd.action = "status";
						thisVar.saveInspectionLocation();
					}
				});
			}
		},
		async mounted() {
			this.addEditModal = new bootstrap.Modal(this.$refs.addEditModal, {backdrop: "static", keyboard: false});
			this.readModal = new bootstrap.Modal(this.$refs.readModal, {backdrop: "static", keyboard: false});
			this.allCountryIdList = await this.loadAllCountry(true);
		}
	};
</script>
