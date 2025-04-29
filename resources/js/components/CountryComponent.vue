<template>
	<div id="country-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">COUNTRY</h4>
							<a id="add_country_btn" class="btn btn-success btn-sm" href="#" role="button" data-bs-toggle="modal" data-bs-target="#addCountryModal" v-if="['110', '111'].indexOf(all_permissions) >= 0">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewCountry" @edit-object="prepareEditCountry" @toggle-object-status="toggleCountry"></DataTableComponent>
			</div>
		</div>
		<div class="modal fade" ref="addEditModal" id="addCountryModal" tabindex="-1" aria-labelledby="addCountryModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addCountryModalLabel">ADD Country</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_country_name" class="form-label text-uppercase fw-bold me-3">Name <span class="mandatory">*</span></label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="text" class="form-control" v-model="countryForAdd.name" id="add_country_name" placeholder="Enter Name" />
								</div>
								<template v-for="error of v$.$errors" :key="error.$uid">
									<div class="mandatory mb-1">{{ error.$message }}</div>
								</template>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal" @click="cancelAddEdit()">CLOSE</button>
						<button type="button" class="btn btn-dark btn-sm" @click="saveCountry()">SAVE CHANGES</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" ref="readModal" id="readCountryModal" tabindex="-1" aria-labelledby="readCountryModalLabel" aria-hidden="true" v-if="readCountry">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="readCountryModalLabel">View Country</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Name</label>
								<div>
									<span v-if="readCountry.name">{{ readCountry.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Status</label>
								<div>
									<span class="badge rounded-pill bg-success" v-if="readCountry.status == 1">ACTIVE</span>
									<span class="badge rounded-pill bg-danger" v-if="readCountry.status == 0">INACTIVE</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Created By</label>
								<div>
									<span v-if="readCountry.creator?.name">{{ readCountry.creator?.name }}</span
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
	import {required, minValue, alphaNum, numeric, email, requiredIf, minLength, alpha, helpers} from "@vuelidate/validators";
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
			name: {required, minLengthValue: minLength(1), contents:helpers.withMessage('Invalid name', helpers.regex(/^\D*$/))}
		};
	}
	export default {
		name: "Countrymaster",
		props: ["current_user_id", "all_permissions"],
		setup() {
			return {
				v$: useVuelidate()
			};
		},
		data() {
			return {
				dataprops: {
					id: "country-list",
					class: "a",
					base_url: this.docRoot + "/api/country/",
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
				countryForAdd: initialState(),
				readCountry: {}
			};
		},
		validations() {
			return {
				countryForAdd: initialStateValidations()
			};
		},
		methods: {
			cancelAddEdit(event) {
				this.countryForAdd = initialState();
				this.v$.$reset();
			},
			async saveCountry(event) {
				var thisVar = this;
				const result = await this.v$.$validate();
				if (!result) {
					this.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
					console.log(this.v$.$errors);
					return;
				}
				if (!this.countryForAdd.action || this.countryForAdd.action == "") this.countryForAdd.action = "details";
				this.countryForAdd.created_by = this.current_user_id;
				$("#addCountryModal").modal("hide");
				this.showLoading("Saving ...");
				axios
					.post(this.docRoot + "/country/save", {country: this.countryForAdd})
					.then(async function (response) {
						thisVar.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							thisVar.showToast("Country saved successfully", "success", "bottom", 3000);
							setTimeout(() => {
								thisVar.dataprops.reload = true;
							}, 1500);
							thisVar.countryForAdd = initialState();
							thisVar.v$.$reset();
						} else thisVar.showErrors("Country could not be saved successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						thisVar.closeSwal();
						thisVar.showToast("Country could not be saved successfully", "error", "bottom", 3000);
					});
			},
			prepareEditCountry(country) {
				this.countryForAdd = Object.assign({}, country);
				this.addEditModal.show();
			},
			viewCountry(country) {
				this.readCountry = country;
				this.readModal.show();
			},
			toggleCountry(country, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the Country - <br/>"' + country.name + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.countryForAdd = country;
						thisVar.countryForAdd.status = status;
						thisVar.countryForAdd.action = "status";
						thisVar.saveCountry();
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
