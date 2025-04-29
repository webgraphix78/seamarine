<template>
	<div id="onhire-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">ON HIRE</h4>
							<a class="btn btn-success btn-sm" :href="docRoot+'/onhire/add'" v-if="['110', '111'].indexOf(all_permissions) >= 0">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewOnhire" @edit-object="prepareEditOnhire" @upload-object="uploadImages" @print-object="printOnhire" @duplicate-object="duplicateObject" @toggle-object-status="toggleOnhire"></DataTableComponent>
			</div>
		</div>
		
		<!-- Upload Images -->
		<UploadImages :dataprops="uploadDataprops" @refresh-object="refreshObject"></UploadImages>
		<!-- Upload Images -->
	</div>
</template>
<script>
	export default {
		name: "Onhiremaster",
		props: ["current_user_id", "all_permissions"],
		data() {
			return {
				dataprops: {
					id: "onhire-list",
					class: "a",
					base_url: this.docRoot + "/api/onhire/",
					columns: [
						{title: "Unit No", property: "unit_nr"},
						{title: "Customer", property: "customer.name", alt_value: "Not Specified"},
						{ title: "Date", property: "inspection_date" },
						{ title: "Location", property: "inspection_location.name" },
						{title: "Company", property: "company.name", alt_value: "Not Specified"},
					],
					data_to_send: {current_user_id: this.current_user_id},
					reload: false,
					search: "simple"
				},
				currentUser: siteUserObject,
				onhireForAdd: {},
				uploadDataprops: {
					relatedObject: null,
					name: "Onhire",
				},
			};
		},
		methods: {
			async saveOnhire(event) {
				var thisVar = this;
				const result = await this.v$.$validate();
				if (!result) {
					this.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
					console.log(this.v$.$errors);
					return;
				}
				if (!this.onhireForAdd.action || this.onhireForAdd.action == "") this.onhireForAdd.action = "details";
				this.onhireForAdd.created_by = this.current_user_id;
				$("#addOnhireModal").modal("hide");
				this.showLoading("Saving ...");
				axios
					.post(this.docRoot + "/onhire/save", {onhire: this.onhireForAdd})
					.then(async function (response) {
						thisVar.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							thisVar.showToast("On Hire record saved successfully", "success", "bottom", 3000);
							setTimeout(() => {
								thisVar.dataprops.reload = true;
							}, 1500);
							thisVar.onhireForAdd = initialState();
							thisVar.v$.$reset();
						} else thisVar.showErrors("On Hire record could not be saved successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						thisVar.closeSwal();
						thisVar.showToast("On Hire record could not be saved successfully", "error", "bottom", 3000);
					});
			},
			prepareEditOnhire(onhire) {
				window.location = this.docRoot + "/onhire/edit/" + onhire.id;
			},
			viewOnhire(onhire) {
				window.location = this.docRoot + "/onhire/view/" + onhire.id;
			},
			duplicateObject(onhire) {
				let that = this;
				this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
					if (result.isConfirmed) {
						// Call AXIOS to duplicate the invoice and then open in EDIT Mode
						this.showLoading("Saving ...");
						axios.post(this.docRoot+'/onhire/duplicate', { id: onhire.id }).then(async function (response) {
							that.closeSwal();
							var status = response.data.status;
							if (status == 1) {
								var newId = response.data.id;
								// Ajax to submit
								that.showToast('Record duplicated successfully', 'success', 'bottom', 3000);
								setTimeout(() => {
									that.showLoading("Redirecting ...");
								}, 2000);
								setTimeout(() => {
									window.location = that.docRoot+'/onhire/edit/' + newId;
								}, 4000);
							}
						});
					}
				});
			},
			toggleOnhire(onhire, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the On Hire - <br/>"' + onhire.ref_no + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.onhireForAdd = onhire;
						thisVar.onhireForAdd.status = status;
						thisVar.onhireForAdd.action = "status";
						thisVar.saveOnhire();
					}
				});
			},
			printOnhire(onhire) {
				window.location = this.docRoot+'/onhire/export-to-pdf/' + onhire.id;
				this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
			},
			async uploadImages(onhire) {
				this.showLoading("Loading images ...");
				await this.refreshObject(onhire, "OnHire", 1);
				this.closeSwal();
			},
		},
		async mounted() {
		}
	};
</script>
