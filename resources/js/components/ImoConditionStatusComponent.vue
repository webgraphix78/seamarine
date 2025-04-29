<template>
	<div id="imoconditionstatus-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">IMO CONDITION STATUS</h4>
							<a id="add_imoconditionstatus_btn" class="btn btn-success btn-sm" href="#" role="button" data-bs-toggle="modal" data-bs-target="#addImoConditionStatusModal" v-if="['110', '111'].indexOf(all_permissions) >= 0">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewImoConditionStatus" @edit-object="prepareEditImoConditionStatus" @toggle-object-status="toggleImoConditionStatus"></DataTableComponent>
			</div>
		</div>
		<div class="modal fade" ref="addEditModal" id="addImoConditionStatusModal" tabindex="-1" aria-labelledby="addImoConditionStatusModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addImoConditionStatusModalLabel">ADD ImoConditionStatus</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_imoconditionstatus_title" class="form-label text-uppercase fw-bold me-3">Title <span class="mandatory">*</span></label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="text" class="form-control" v-model="imoconditionstatusForAdd.title" id="add_imoconditionstatus_title" placeholder="Enter Title" />
								</div>
								<template v-for="error of v$.imoconditionstatusForAdd.title.$errors" :key="error.$uid">
									<div class="mandatory mb-1">{{ error.$message }}</div>
								</template>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_imoconditionstatus_code" class="form-label text-uppercase fw-bold me-3">Code <span class="mandatory">*</span></label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="text" class="form-control" v-model="imoconditionstatusForAdd.code" id="add_imoconditionstatus_code" placeholder="Enter Code" />
								</div>
								<template v-for="error of v$.imoconditionstatusForAdd.code.$errors" :key="error.$uid">
									<div class="mandatory mb-1">{{ error.$message }}</div>
								</template>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal" @click="cancelAddEdit()">CLOSE</button>
						<button type="button" class="btn btn-dark btn-sm" @click="saveImoConditionStatus()">SAVE CHANGES</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" ref="readModal" id="readImoConditionStatusModal" tabindex="-1" aria-labelledby="readImoConditionStatusModalLabel" aria-hidden="true" v-if="readImoConditionStatus">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="readImoConditionStatusModalLabel">View ImoConditionStatus</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Title</label>
								<div>
									<span v-if="readImoConditionStatus.title">{{ readImoConditionStatus.title }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Code</label>
								<div>
									<span v-if="readImoConditionStatus.code">{{ readImoConditionStatus.code }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Status</label>
								<div>
									<span class="badge rounded-pill bg-success" v-if="readImoConditionStatus.status == 1">ACTIVE</span>
									<span class="badge rounded-pill bg-danger" v-if="readImoConditionStatus.status == 0">INACTIVE</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Created By</label>
								<div>
									<span v-if="readImoConditionStatus.creator?.name">{{ readImoConditionStatus.creator?.name }}</span
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
			title: "",
			code: "",
			action: ""
		};
	}
	function initialStateValidations() {
		return {
			title: {required, minLengthValue: minLength(1)},
			code: {required, minLengthValue: minLength(1)}
		};
	}
	export default {
		name: "ImoConditionStatusmaster",
		props: ["current_user_id", "all_permissions"],
		setup() {
			return {
				v$: useVuelidate()
			};
		},
		data() {
			return {
				dataprops: {
					id: "imoconditionstatus-list",
					class: "a",
					base_url: this.docRoot + "/api/imoconditionstatus/",
					columns: [
						{title: "Title", property: "title", sortable: true},
						{title: "Code", property: "code", sortable: true},
						{title: "Created By", property: "creator.name", alt_value: "Not Specified"}
					],
					data_to_send: {current_user_id: this.current_user_id},
					reload: false,
					search: "simple"
				},
				addEditModal: null,
				readModal: null,
				currentUser: siteUserObject,
				imoconditionstatusForAdd: initialState(),
				readImoConditionStatus: {}
			};
		},
		validations() {
			return {
				imoconditionstatusForAdd: initialStateValidations()
			};
		},
		methods: {
			cancelAddEdit(event) {
				this.imoconditionstatusForAdd = initialState();
				this.v$.$reset();
			},
			async saveImoConditionStatus(event) {
				var thisVar = this;
				const result = await this.v$.$validate();
				if (!result) {
					this.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
					console.log(this.v$.$errors);
					return;
				}
				if (!this.imoconditionstatusForAdd.action || this.imoconditionstatusForAdd.action == "") this.imoconditionstatusForAdd.action = "details";
				this.imoconditionstatusForAdd.created_by = this.current_user_id;
				$("#addImoConditionStatusModal").modal("hide");
				this.showLoading("Saving ...");
				axios
					.post(this.docRoot + "/imoconditionstatus/save", {imoconditionstatus: this.imoconditionstatusForAdd})
					.then(async function (response) {
						thisVar.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							thisVar.showToast("IMO Condition Status saved successfully", "success", "bottom", 3000);
							setTimeout(() => {
								thisVar.dataprops.reload = true;
							}, 1500);
							thisVar.imoconditionstatusForAdd = initialState();
							thisVar.v$.$reset();
						} else thisVar.showErrors("IMO Condition Status could not be saved successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						thisVar.closeSwal();
						thisVar.showToast("IMO Condition Status could not be saved successfully", "error", "bottom", 3000);
					});
			},
			prepareEditImoConditionStatus(imoconditionstatus) {
				this.imoconditionstatusForAdd = Object.assign({}, imoconditionstatus);
				this.addEditModal.show();
			},
			viewImoConditionStatus(imoconditionstatus) {
				this.readImoConditionStatus = imoconditionstatus;
				this.readModal.show();
			},
			toggleImoConditionStatus(imoconditionstatus, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the IMO Condition Status - <br/>"' + imoconditionstatus.title + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.imoconditionstatusForAdd = imoconditionstatus;
						thisVar.imoconditionstatusForAdd.status = status;
						thisVar.imoconditionstatusForAdd.action = "status";
						thisVar.saveImoConditionStatus();
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
