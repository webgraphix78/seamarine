<template>
	<div id="company-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">COMPANY</h4>
							<a id="add_company_btn" class="btn btn-success btn-sm" href="#" role="button" data-bs-toggle="modal" data-bs-target="#addCompanyModal" v-if="['110', '111'].indexOf(all_permissions) >= 0">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewCompany" @edit-object="prepareEditCompany" @toggle-object-status="toggleCompany"></DataTableComponent>
			</div>
		</div>
		<div class="modal fade" ref="addEditModal" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addCompanyModalLabel">ADD Company</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_company_name" class="form-label text-uppercase fw-bold me-3">Name <span class="mandatory">*</span></label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="text" class="form-control" v-model="companyForAdd.name" id="add_company_name" placeholder="Enter Name" />
								</div>
								<template v-for="error of v$.companyForAdd.name.$errors" :key="error.$uid">
									<div class="mandatory mb-1">{{ error.$message }}</div>
								</template>
							</div>
						</div>
						<!-- Upload header -->
						<div class="row mb-4" v-if="companyForAdd.id > 0">
							<div class="col-12">
								<label for="add_company_name" class="form-label text-uppercase fw-bold me-3">Upload Header Image <span class="mandatory">*</span></label>
								<div class="d-flex flex-row gap-3">
									<div class="mb-2" v-if="companyForAdd.header_url && companyForAdd.header_url.length > 5">
										<img :src="docRoot+'/company/view-file/1/' + companyForAdd.id +'/'+imageId" style="max-width: 200px" />
										<p class="my-2 p-0"><a href="javascript:void(0)" class="text-danger" @click="clearCompanyLogo()">Clear logo</a></p>
									</div>
									<div>
										<input type="file" id="header_url" ref="header_url" @change="handleUpload($event, '1', document)" accept="image/*" />
										<div class="d-flex flex-row gap-3 align-items-center mb-2">
											<label for="header_url" class="bg-dark p-2 text-white">
												<span v-if="document.file_name">Upload new header image</span>
												<span v-else>Upload header image</span>
											</label>
											<div class="d-flex flex-column">
												<ul class="list-inline gap-4 m-0">
													<li class="list-inline-item" v-if="document.upload_state == 1 && document.file_name">
														Uploading <span class="text-primary">{{ document.file_name }}</span>
													</li>
													<li class="list-inline-item" v-if="document.upload_state == 1 && upload_progress < 100">|&nbsp;{{ upload_progress }}%</li>
													<li class="list-inline-item" v-if="document.upload_state == 2">
														Uploaded <span class="text-primary">{{ document.file_name }}</span> successfully
													</li>
												</ul>
											</div>
										</div>
										<p class="text-dark mb-0"><small>Maximum upload size is 2MB. Supported format is JPG, JPEG and PNG only.</small></p>
										<p class="text-dark mb-0"><small>Please ensure that the dimensions are correct.</small></p>
									</div>
								</div>
							</div>
						</div>
						<!-- Upload header -->
						
						<!-- Upload signature -->
						<div class="row mb-4" v-if="companyForAdd.id > 0">
							<div class="col-12">
								<label for="add_company_name" class="form-label text-uppercase fw-bold me-3">Upload Signature Image <span class="mandatory">*</span></label>
								<div class="d-flex flex-row gap-3">
									<div class="mb-2" v-if="companyForAdd.signature_url && companyForAdd.signature_url.length > 5">
										<img :src="'/company/view-file/2/'+companyForAdd.id+'/'+imageId" style="max-width: 200px" />
										<p class="my-2 p-0"><a href="javascript:void(0)" class="text-danger" @click="clearCompanyLogo()">Clear logo</a></p>
									</div>
									<div>
										<input type="file" id="signature_url" ref="signature_url" @change="handleUpload($event, '2', document2)" accept="image/*" />
										<div class="d-flex flex-row gap-3 align-items-center mb-2">
											<label for="signature_url" class="bg-dark p-2 text-white">
												<span v-if="document2.file_name">Upload new signature image</span>
												<span v-else>Upload signature image</span>
											</label>
											<div class="d-flex flex-column">
												<ul class="list-inline gap-4 m-0">
													<li class="list-inline-item" v-if="document2.upload_state == 1 && document2.file_name">
														Uploading <span class="text-primary">{{ document2.file_name }}</span>
													</li>
													<li class="list-inline-item" v-if="document2.upload_state == 1 && upload_progress < 100">|&nbsp;{{ upload_progress }}%</li>
													<li class="list-inline-item" v-if="document2.upload_state == 2">
														Uploaded <span class="text-primary">{{ document2.file_name }}</span> successfully
													</li>
												</ul>
											</div>
										</div>
										<p class="text-dark mb-0"><small>Maximum upload size is 2MB. Supported format is JPG, JPEG and PNG only.</small></p>
										<p class="text-dark mb-0"><small>Please ensure that the dimensions are correct.</small></p>
									</div>
								</div>
							</div>
						</div>
						<!-- Upload signature -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal" @click="cancelAddEdit()">CLOSE</button>
						<button type="button" class="btn btn-dark btn-sm" @click="saveCompany()">SAVE CHANGES</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" ref="readModal" id="readCompanyModal" tabindex="-1" aria-labelledby="readCompanyModalLabel" aria-hidden="true" v-if="readCompany">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="readCompanyModalLabel">View Company</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Name</label>
								<div>
									<span v-if="readCompany.name">{{ readCompany.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-6">
								<label class="form-label text-uppercase fw-bold m-0">Header Image</label>
								<div>
									<img :src="docRoot+'/company/view-file/1/' + readCompany.id+'/'+imageId" class="img-fluid">
								</div>
							</div>
							<div class="col-6">
								<label class="form-label text-uppercase fw-bold m-0">Signature</label>
								<div>
									<img :src="docRoot+'/company/view-file/2/' + readCompany.id+'/'+imageId" class="img-fluid">
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Status</label>
								<div>
									<span class="badge rounded-pill bg-success" v-if="readCompany.status == 1">ACTIVE</span>
									<span class="badge rounded-pill bg-danger" v-if="readCompany.status == 0">INACTIVE</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Created By</label>
								<div>
									<span v-if="readCompany.creator?.name">{{ readCompany.creator?.name }}</span
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
			header_url: "",
			signature_url: "",
			action: ""
		};
	}
	function initialStateValidations() {
		return {
			name: {required, minLengthValue: minLength(1)},
		};
	}
	export default {
		name: "Companymaster",
		props: ["current_user_id", "all_permissions"],
		setup() {
			return {
				v$: useVuelidate()
			};
		},
		data() {
			return {
				dataprops: {
					id: "company-list",
					class: "a",
					base_url: this.docRoot + "/api/company/",
					columns: [
						{title: "Name", property: "name"},
						{title: "Created By", property: "creator.name", alt_value: "Not Specified"}
					],
					data_to_send: {current_user_id: this.current_user_id},
					reload: false,
					search: "simple"
				},
				addEditModal: null,
				readModal: null,
				currentUser: siteUserObject,
				companyForAdd: initialState(),
				readCompany: {},
				document: {
					upload_state: 0,
					upload_progress: 0,
					file_name: ""
				},
				document2: {
					upload_state: 0,
					upload_progress: 0,
					file_name: ""
				},
				imageId: 123
			};
		},
		validations() {
			return {
				companyForAdd: initialStateValidations()
			};
		},
		methods: {
			cancelAddEdit(event) {
				this.companyForAdd = initialState();
				this.v$.$reset();
				this.document = {
					upload_state: 0,
					upload_progress: 0,
					file_name: ""
				};
				this.document2 = {
					upload_state: 0,
					upload_progress: 0,
					file_name: ""
				};
			},
			async saveCompany(event) {
				var thisVar = this;
				const result = await this.v$.$validate();
				if (!result) {
					this.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
					console.log(this.v$.$errors);
					return;
				}
				if (!this.companyForAdd.action || this.companyForAdd.action == "") this.companyForAdd.action = "details";
				this.companyForAdd.created_by = this.current_user_id;
				$("#addCompanyModal").modal("hide");
				this.showLoading("Saving ...");
				axios
					.post(this.docRoot + "/company/save", {company: this.companyForAdd})
					.then(async function (response) {
						thisVar.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							thisVar.showToast("Company saved successfully", "success", "bottom", 3000);
							setTimeout(() => {
								thisVar.dataprops.reload = true;
							}, 1500);
							thisVar.companyForAdd = initialState();
							thisVar.v$.$reset();
						} else thisVar.showErrors("Company could not be saved successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						thisVar.closeSwal();
						thisVar.showToast("Company could not be saved successfully", "error", "bottom", 3000);
					});
			},
			prepareEditCompany(company) {
				this.companyForAdd = Object.assign({}, company);
				this.addEditModal.show();
			},
			viewCompany(company) {
				this.readCompany = company;
				this.readModal.show();
			},
			toggleCompany(company, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the Company - <br/>"' + company.name + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.companyForAdd = company;
						thisVar.companyForAdd.status = status;
						thisVar.companyForAdd.action = "status";
						thisVar.saveCompany();
					}
				});
			},
			handleUpload(event, purpose, document) {
				let that = this;
				let file = event.target.files[0];
				console.log(file);
				if (file.size > 2 * 1024 * 1024) {
					this.showToast("File size cannot exceed 2MB", "error", "bottom", 3000);
					return;
				}
				if (file.type != "image/jpg" && file.type != "image/jpeg" && file.type != "image/png") {
					this.showToast("You can only upload JPG, JPEG and PNG images", "error", "bottom", 3000);
					return;
				}
				const formData = new FormData();
				formData.append("purpose", purpose);
				formData.append("company_id", this.companyForAdd.id);
				formData.append("uploaded_file", file);
				document.upload_state = 0;
				document.upload_progress = 0;
				document.file_name = file.name.length > 25 ? file.name.substring(0, 18) + " ... " + file.name.substring(file.name.length - 4) : file.name;
				// Send the data
				let URL = this.docRoot + "/company/upload-file";
				axios
					.post(URL, formData, {
						headers: {
							"Content-Type": "multipart/form-data"
						},
						onUploadProgress: function (progressEvent) {
							document.upload_state = 1;
							document.upload_progress = parseInt(Math.round((progressEvent.loaded / progressEvent.total) * 100));
						}
					})
					.then(async function (response) {
						document.upload_state = 2;
						document.upload_progress = 100;
						var status = response.data.status;
						if (status == 1) {
							that.showToast("File uploaded successfully", "success", "bottom", 3000);
							that.imageId = Math.round(Math.random() * 100);
						} else that.showErrors("File could not be uploaded successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						document.upload_progress = 0;
						document.upload_state = -1;
						console.log(error);
						that.closeSwal();
						that.showToast("File could not be uploaded successfully", "error", "bottom", 3000);
					});
			}
		},
		async mounted() {
			this.addEditModal = new bootstrap.Modal(this.$refs.addEditModal, {backdrop: "static", keyboard: false});
			this.readModal = new bootstrap.Modal(this.$refs.readModal, {backdrop: "static", keyboard: false});
			this.imageId = Math.round(Math.random() * 100);
		}
	};
</script>
