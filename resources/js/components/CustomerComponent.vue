<template>
	<div id="customer-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">CUSTOMER</h4>
							<a id="add_customer_btn" class="btn btn-success btn-sm" href="#" role="button" data-bs-toggle="modal" data-bs-target="#addCustomerModal" v-if="['110', '111'].indexOf(all_permissions) >= 0">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewCustomer" @edit-object="prepareEditCustomer" @toggle-object-status="toggleCustomer"></DataTableComponent>
			</div>
		</div>
		<div class="modal fade" ref="addEditModal" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addCustomerModalLabel">ADD Customer</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_customer_name" class="form-label text-uppercase fw-bold me-3">Name <span class="mandatory">*</span></label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="text" class="form-control" v-model="customerForAdd.name" id="add_customer_name" placeholder="Enter Name" />
								</div>
								<template v-for="error of v$.customerForAdd.name.$errors" :key="error.$uid">
									<div class="mandatory mb-1">{{ error.$message }}</div>
								</template>
							</div>
							<div class="col-4">
								<label for="add_customer_contact_person" class="form-label text-uppercase fw-bold me-3">Contact Person</label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="text" class="form-control" v-model="customerForAdd.contact_person" id="add_customer_contact_person" placeholder="Enter Contact Person" />
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_customer_email" class="form-label text-uppercase fw-bold me-3">Email</label>
								<div>
									<input type="email" class="form-control" v-model="customerForAdd.email" id="add_customer_email" placeholder="Enter Email" />
								</div>
							</div>
							<div class="col-4">
								<label for="add_customer_mobile_number" class="form-label text-uppercase fw-bold me-3">Mobile Number</label>
								<div>
									<input type="tel" class="form-control" v-model="customerForAdd.mobile_number" id="add_customer_mobile_number" placeholder="Enter Mobile Number" />
								</div>
							</div>
							<div class="col-4">
								<label for="add_customer_fax_number" class="form-label text-uppercase fw-bold me-3">Fax Number</label>
								<div>
									<input type="tel" class="form-control" v-model="customerForAdd.fax_number" id="add_customer_fax_number" placeholder="Enter Fax Number" />
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label for="add_customer_address" class="form-label text-uppercase fw-bold me-3">Address</label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<textarea class="form-control" v-model="customerForAdd.address" id="add_customer_address" placeholder="Enter Address"></textarea>
								</div>
							</div>
							<div class="col-4">
								<label for="add_customer_is_cha" class="form-label text-uppercase fw-bold me-3">Is CHA</label>
								<div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="add_customer_is_cha" id="add_customer_is_cha" v-model="customerForAdd.is_cha" true-value="1" false-value="0" />
										<label class="form-check-label" for="add_customer_is_cha">Is CHA</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row mb-4" v-if="customerForAdd.id == 0">
							<div class="col-4">
								<label for="add_customer_login_id" class="form-label text-uppercase fw-bold me-3">Email for login <span class="mandatory">*</span></label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="email" class="form-control" v-model="customerForAdd.login_id" id="add_customer_login_id" placeholder="Enter Login Id" />
								</div>
							</div>
							<div class="col-4">
								<label for="add_customer_password" class="form-label text-uppercase fw-bold me-3">Password <span class="mandatory">*</span></label
								><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								<div>
									<input type="text" class="form-control" v-model="customerForAdd.password" id="add_customer_password" placeholder="Enter Password" />
								</div>
							</div>
						</div>
						<div class="row" v-else>
							<div class="col-12">
								<p>You can reset the user's credentials in <strong>'All Users'</strong>.</p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal" @click="cancelAddEdit()">CLOSE</button>
						<button type="button" class="btn btn-dark btn-sm" @click="saveCustomer()">SAVE CHANGES</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" ref="readModal" id="readCustomerModal" tabindex="-1" aria-labelledby="readCustomerModalLabel" aria-hidden="true" v-if="readCustomer">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="readCustomerModalLabel">View Customer</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Name</label>
								<div>
									<span v-if="readCustomer.name">{{ readCustomer.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Contact Person</label>
								<div>
									<span v-if="readCustomer.contact_person">{{ readCustomer.contact_person }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Email</label>
								<div>
									<span v-if="readCustomer.email">{{ readCustomer.email }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Mobile Number</label>
								<div>
									<span v-if="readCustomer.mobile_number">{{ readCustomer.mobile_number }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Fax Number</label>
								<div>
									<span v-if="readCustomer.fax_number">{{ readCustomer.fax_number }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-8">
								<label class="form-label text-uppercase fw-bold m-0">Address</label>
								<div>
									<span v-if="readCustomer.address">{{ readCustomer.address }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Is Cha</label>
								<div>
									<span v-if="readCustomer.is_cha">{{ readCustomer.is_cha }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Status</label>
								<div>
									<span class="badge rounded-pill bg-success" v-if="readCustomer.status == 1">ACTIVE</span>
									<span class="badge rounded-pill bg-danger" v-if="readCustomer.status == 0">INACTIVE</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Created By</label>
								<div>
									<span v-if="readCustomer.creator?.name">{{ readCustomer.creator?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<p>You can view the user in <strong>'All Users'</strong>.</p>
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
			contact_person: "",
			fax_number: "",
			address: "",
			email: "",
			mobile_number: "",
			login_id: "",
			password: "",
			is_cha: false,
			action: ""
		};
	}
	function initialStateValidations() {
		return {
			name: {required, minLengthValue: minLength(1)},
			contact_person: {minLengthValue: minLength(1)},
			fax_number: {minLengthValue: minLength(1)},
			address: {minLengthValue: minLength(1)},
			email: {email},
			mobile_number: {minLengthValue: minLength(1)},
			is_cha: {}
		};
	}
	export default {
		name: "Customermaster",
		props: ["current_user_id", "all_permissions"],
		setup() {
			return {
				v$: useVuelidate()
			};
		},
		data() {
			return {
				dataprops: {
					id: "customer-list",
					class: "a",
					base_url: this.docRoot + "/api/customer/",
					columns: [
						{title: "Name", property: "name", sortable: true},
						{title: "Contact Person", property: "contact_person", sortable: true},
						{title: "Fax Number", property: "fax_number"},
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
				customerForAdd: initialState(),
				readCustomer: {}
			};
		},
		validations() {
			return {
				customerForAdd: initialStateValidations()
			};
		},
		methods: {
			cancelAddEdit(event) {
				this.customerForAdd = initialState();
				this.v$.$reset();
			},
			async saveCustomer(event) {
				var thisVar = this;
				const result = await this.v$.$validate();
				if (!result) {
					this.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
					console.log(this.v$.$errors);
					return;
				}
				if (this.customerForAdd.id == 0 &&
					(this.customerForAdd.login_id === null || this.customerForAdd.login_id === undefined || this.customerForAdd.login_id.trim() === "" || 
					this.customerForAdd.password === null || this.customerForAdd.password === undefined || this.customerForAdd.password.trim() === "")) {
						this.showToast("Please specify login credentials.", "error", "bottom", 2000);
						return;
				}
				if (!this.customerForAdd.action || this.customerForAdd.action == "") this.customerForAdd.action = "details";
				this.customerForAdd.created_by = this.current_user_id;
				$("#addCustomerModal").modal("hide");
				this.showLoading("Saving ...");
				axios
					.post(this.docRoot + "/customer/save", {customer: this.customerForAdd})
					.then(async function (response) {
						thisVar.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							thisVar.showToast("Customer saved successfully", "success", "bottom", 3000);
							setTimeout(() => {
								thisVar.dataprops.reload = true;
							}, 1500);
							thisVar.customerForAdd = initialState();
							thisVar.v$.$reset();
						} else thisVar.showErrors("Customer could not be saved successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						thisVar.closeSwal();
						thisVar.showToast("Customer could not be saved successfully", "error", "bottom", 3000);
					});
			},
			prepareEditCustomer(customer) {
				this.customerForAdd = Object.assign({}, customer);
				this.addEditModal.show();
			},
			viewCustomer(customer) {
				this.readCustomer = customer;
				this.readModal.show();
			},
			toggleCustomer(customer, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the Customer - <br/>"' + customer.name + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.customerForAdd = customer;
						thisVar.customerForAdd.status = status;
						thisVar.customerForAdd.action = "status";
						thisVar.saveCustomer();
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
