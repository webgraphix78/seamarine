<template lang="">
	<div class="accordion mb-0" id="accordionExample">
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Billing Reports</button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
				<div class="accordion-body">
					<form :action="docRoot+'/reports/download'" method="post" target="_blank">
						<input type="hidden" name="_token" :value="csrfToken">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label class="form-label text-uppercase fw-bold me-3" for="from_date">Select Report</label>
									<select class="form-select" id="report_type" v-model="report" name="report">
										<option value="1">Condition</option>
										<option value="2">Shipper</option>
										<option value="3">Cleaning</option>
										<option value="4">On hire</option>
										<option value="5">Drybox</option>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label class="form-label text-uppercase fw-bold me-3" for="from_date">From Date</label>
									<input type="date" class="form-control" id="from_date" v-model="from_date" name="from_date">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label class="form-label text-uppercase fw-bold me-3" for="to_date">To Date</label>
									<input type="date" class="form-control" id="to_date" v-model="to_date" name="to_date">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="form-label text-uppercase fw-bold me-3" for="to_date">For Customer</label>
									<div><Select2 v-model="for_customer" :options="customers" :settings="{width: '100%'}" :disabled="disableCustomerSelection"></Select2></div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="all_customers" @click="enableAllCustomers()" :checked="disableCustomerSelection"/>
										<label class="form-check-label" for="all_customers"> All Customers </label>
									</div>
									<input type="hidden" name="customer_id" v-model="for_customer">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="form-label text-uppercase fw-bold me-3" for="to_date">Inspection Location</label>
									<div><Select2 v-model="for_inspection_location" :options="inspectionLocations" :settings="{width: '100%'}" :disabled="disableInspectionLocationSelection"></Select2></div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="all_inspection_locations" @click="enableAllInspectionLocations()" :checked="disableInspectionLocationSelection"/>
										<label class="form-check-label" for="all_inspection_locations"> All Locations </label>
									</div>
									<input type="hidden" name="inspection_location_id" v-model="for_inspection_location">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<div class="mb-2">&nbsp;</div>
									<button class="btn btn-dark" type="submit">Generate</button>
								</div>
							</div>
							<div class="col-sm-3">
								<TimePicker :minute-step="15" mode="12" min-time="09:00:00"></TimePicker>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			report: 1,
			from_date: this.currentMonth(),
			to_date: this.today(),
			for_customer: "0",
			for_inspection_location: "0",
			disableCustomerSelection: true,
			disableInspectionLocationSelection: true,
			customers: [],
			inspectionLocations: [],
			csrfToken: csrfToken,
		}
	},
	props: ["current_user_id"],
	methods: {
		getCustomers() {
			let that = this;
			var URL = "";
			if (this.report == 1)
				URL = this.docRoot + "/api/customer/get";
			let postArr = {
				active: 1
			};
			axios.post(URL, postArr).then(function (response) {
				if( response.data && response.data.data )
					that.customers = response.data.data.map(x => {return { id: x.id, text: x.name }});
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		getInspectionLocations() {
			let that = this;
			var URL = "";
			if (this.report == 1)
				URL = this.docRoot + "/api/inspectionlocation/get";
			let postArr = {
				active: 1
			};
			axios.post(URL, postArr).then(function (response) {
				if( response.data && response.data.data )
					that.inspectionLocations = response.data.data.map(x => {return { id: x.id, text: x.name }});
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		enableAllCustomers() {
			this.disableCustomerSelection = !this.disableCustomerSelection;
			this.for_customer = "0";
		},
		enableAllInspectionLocations() {
			this.disableInspectionLocationSelection = !this.disableInspectionLocationSelection;
			this.for_inspection_location = "0";
		},
		onSubmit() {
			console.log(this.report, this.from_date, this.to_date, this.for_customer, this.for_inspection_location);
		}
	},
	mounted() {
		this.getCustomers();
		this.getInspectionLocations();
	},
}
</script>
<style>
.select2-container{
	height: 35px;
}
.select2-container--default .select2-selection--single{
	height: 100%;
	display: flex;
    align-items: center;
}
</style>