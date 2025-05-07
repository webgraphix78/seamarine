<template>
	<div id="imo1-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">IMO 1 CONDITION</h4>
							<a id="add_imo1_btn" class="btn btn-success btn-sm" :href="docRoot+'/imo1/add'">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewImo1Condition" @upload-object="uploadImages" @print-object="printIMO1" @duplicate-object="duplicateObject" @edit-object="prepareEditImo1Condition" @toggle-object-status="toggleImo1"></DataTableComponent>
			</div>
		</div>
		<!-- Upload Images -->
		<UploadImages :dataprops="uploadDataprops" @refresh-object="refreshObject"></UploadImages>
		<!-- Upload Images -->
	</div>
	
</template>
<script>
	export default {
		name: "Imo1master",
		props: ["current_user_id", "all_permissions"],
		data() {
			return {
				dataprops: {
					id: "imo1-list",
					class: "a",
					base_url: this.docRoot + "/api/imo1/",
					columns: [
						{title: "Ref No", property: "ref_no"},
						{title: "Company", property: "company.name"},
						{title: "Customer", property: "customer.name"},
						{title: "Inspection Date", property: "dt_inspection_date", date_type: "mysqldate", display_type: "date", format: "LLL dd, yyyy"},
						{title: "Tank Number", property: "tank_no"},
						{title: "Created By", property: "creator.name", alt_value: "Not Specified"}
					],
					data_to_send: {current_user_id: this.current_user_id},
					reload: false,
					search: "simple"
				},
				uploadDataprops: {
					relatedObject: null,
					name: "IMO1Condition",
				},
				currentUser: siteUserObject,
			};
		},
		methods: {
			prepareEditImo1Condition(imo1condition) {
				window.location = this.docRoot + "/imo1/edit/" + imo1condition.id;
			},
			viewImo1Condition(imo1condition) {
				window.location = this.docRoot + "/imo1/view/" + imo1condition.id;
			},
			duplicateObject(imo1) {
				let that = this;
				this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
					if (result.isConfirmed) {
						// Call AXIOS to duplicate the invoice and then open in EDIT Mode
						this.showLoading("Saving ...");
						axios.post(this.docRoot+'/imo1/duplicate', { id: imo1.id }).then(async function (response) {
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
									window.location = that.docRoot+'/imo1/edit/' + newId+"?duplicate=1";
								}, 4000);
							}
						});
					}
				});
			},
			toggleImo1(imo1, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the IMO 1 Condition - <br/>"' + imo1.ref_no + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.imo1ForAdd = imo1;
						thisVar.imo1ForAdd.status = status;
						thisVar.imo1ForAdd.action = "status";
						thisVar.saveImo1();
					}
				});
			},
			printIMO1(imo1) {
				window.location = this.docRoot+'/imo1/export-to-pdf/' + imo1.id;
				this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
			},
			async uploadImages(imo1) {
				this.showLoading("Loading images ...");
				await this.refreshObject(imo1, "IMO1Condition", 1);
				this.closeSwal();
			},
		},
		async mounted() {
		}
	};
</script>
