<template>
	<div id="surveyor-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">SURVEYOR</h4>
							<a id="add_surveyor_btn" class="btn btn-success btn-sm" href="#" role="button" data-bs-toggle="modal" data-bs-target="#addSurveyorModal" v-if="['110', '111'].indexOf(all_permissions) >= 0">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewSurveyor" @edit-object="prepareEditSurveyor" @toggle-object-status="toggleSurveyor"></DataTableComponent>
			</div>
		</div>
		<div class="modal fade" ref="addEditModal" id="addSurveyorModal" tabindex="-1" aria-labelledby="addSurveyorModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addSurveyorModalLabel">ADD Surveyor</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_surveyor_name" class="form-label text-uppercase fw-bold me-3">Name <span class="mandatory">*</span></label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="text" class="form-control" v-model="surveyorForAdd.name" id="add_surveyor_name" placeholder="Enter Name" />
								</div>
								<template v-for="error of v$.surveyorForAdd.name.$errors" :key="error.$uid">
									<div class="mandatory mb-1">{{ error.$message }}</div>
								</template>
							</div>
							<div class="col-4">
								<label for="add_surveyor_address" class="form-label text-uppercase fw-bold me-3">Address</label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<textarea class="form-control" v-model="surveyorForAdd.address" id="add_surveyor_address" placeholder="Enter Address"></textarea>
								</div>
							</div>
							<div class="col-4">
								<label for="add_surveyor_email" class="form-label text-uppercase fw-bold me-3">Email</label>
								<div>
									<input type="email" class="form-control" v-model="surveyorForAdd.email" id="add_surveyor_email" placeholder="Enter Email" />
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_surveyor_mobile_number" class="form-label text-uppercase fw-bold me-3">Mobile Number</label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="text" class="form-control" v-model="surveyorForAdd.mobile_number" id="add_surveyor_mobile_number" placeholder="Enter Mobile Number" />
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal" @click="cancelAddEdit()">CLOSE</button>
						<button type="button" class="btn btn-dark btn-sm" @click="saveSurveyor()">SAVE CHANGES</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" ref="readModal" id="readSurveyorModal" tabindex="-1" aria-labelledby="readSurveyorModalLabel" aria-hidden="true" v-if="readSurveyor">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="readSurveyorModalLabel">View Surveyor</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Name</label>
								<div>
									<span v-if="readSurveyor.name">{{ readSurveyor.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Address</label>
								<div>
									<span v-if="readSurveyor.address">{{ readSurveyor.address }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Email</label>
								<div>
									<span v-if="readSurveyor.email">{{ readSurveyor.email }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Mobile Number</label>
								<div>
									<span v-if="readSurveyor.mobile_number">{{ readSurveyor.mobile_number }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Status</label>
								<div>
									<span class="badge rounded-pill bg-success" v-if="readSurveyor.status == 1">ACTIVE</span>
									<span class="badge rounded-pill bg-danger" v-if="readSurveyor.status == 0">INACTIVE</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Created By</label>
								<div>
									<span v-if="readSurveyor.creator?.name">{{ readSurveyor.creator?.name }}</span
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
	import { helpers } from '@vuelidate/validators';
	import { required, minValue, alphaNum, numeric, email, requiredIf, minLength } from "@vuelidate/validators";
	import * as bootstrap from "bootstrap";
	function initialState() {
		return {
			id: 0,
			name: "",
			address: "",
			email: "",
			mobile_number: "",

			action: ""
		};
	}
	function initialStateValidations() {
		return {
			name: {required, minLengthValue: minLength(1), contents:helpers.withMessage('Invalid name', helpers.regex(/^\D*$/))},
			address: {minLengthValue: minLength(1)},
			email: {email},
			mobile_number: {minLengthValue: minLength(1)}
		};
	}
	export default {
		name: "Surveyormaster",
		props: ["current_user_id", "all_permissions"],
		setup() {
			return {
				v$: useVuelidate()
			};
		},
		data() {
			return {
				dataprops: {
					id: "surveyor-list",
					class: "a",
					base_url: this.docRoot + "/api/surveyor/",
					columns: [
						{title: "Name", property: "name", sortable: true},
						{title: "Email", property: "email"},
						{title: "Mobile Number", property: "mobile_number"},
						{title: "Created By", property: "creator.name", alt_value: "Not Specified"}
					],
					data_to_send: {current_user_id: this.current_user_id},
					reload: false,
					search: "simple"
				},
				addEditModal: null,
				readModal: null,
				currentUser: siteUserObject,
				surveyorForAdd: initialState(),
				readSurveyor: {}
			};
		},
		validations() {
			return {
				surveyorForAdd: initialStateValidations()
			};
		},
		methods: {
			cancelAddEdit(event) {
				this.surveyorForAdd = initialState();
				this.v$.$reset();
			},
			async saveSurveyor(event) {
				var thisVar = this;
				const result = await this.v$.$validate();
				if (!result) {
					this.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
					console.log(this.v$.$errors);
					return;
				}
				if (!this.surveyorForAdd.action || this.surveyorForAdd.action == "") this.surveyorForAdd.action = "details";
				this.surveyorForAdd.created_by = this.current_user_id;
				$("#addSurveyorModal").modal("hide");
				this.showLoading("Saving ...");
				axios
					.post(this.docRoot + "/surveyor/save", {surveyor: this.surveyorForAdd})
					.then(async function (response) {
						thisVar.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							thisVar.showToast("Surveyor saved successfully", "success", "bottom", 3000);
							setTimeout(() => {
								thisVar.dataprops.reload = true;
							}, 1500);
							thisVar.surveyorForAdd = initialState();
							thisVar.v$.$reset();
						} else thisVar.showErrors("Surveyor could not be saved successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						thisVar.closeSwal();
						thisVar.showToast("Surveyor could not be saved successfully", "error", "bottom", 3000);
					});
			},
			prepareEditSurveyor(surveyor) {
				this.surveyorForAdd = Object.assign({}, surveyor);
				this.addEditModal.show();
			},
			viewSurveyor(surveyor) {
				this.readSurveyor = surveyor;
				this.readModal.show();
			},
			toggleSurveyor(surveyor, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the Surveyor - <br/>"' + surveyor.name + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.surveyorForAdd = surveyor;
						thisVar.surveyorForAdd.status = status;
						thisVar.surveyorForAdd.action = "status";
						thisVar.saveSurveyor();
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
