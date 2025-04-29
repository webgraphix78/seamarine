<template lang="">
	<div class="row mb-0 mb-sm-4">
		<div class="col-12 d-flex flex-sm-row gap-2 align-items-center mb-4 mb-sm-0">
			<div class="mb-4 mb-sm-0">
				View Records:
			</div>
			<div class="mb-4 mb-sm-0 duration-select">
				<select class="form-select" aria-label="Default select example" v-model="figureDuration">
					<option value="0">All Time</option>
					<option value="1">This Month</option>
					<option value="2">Last Month</option>
					<option value="10">Date Range</option>
				</select>
			</div>
			<div v-if="figureDuration == 10" class="mb-4 mb-sm-0 w-50">
				<div class="input-group mb-0">
					<span class="input-group-text">From</span>
					<input type="date" class="form-control" v-model="startDate" placeholder="Start Date" />
					<span class="input-group-text">To</span>
					<input type="date" class="form-control" v-model="endDate" placeholder="End Date" />
				</div>
			</div>
			<div class="mb-4 mb-sm-0">
				<button type="button" class="btn btn-dark" @click="getAllReportCount()">Get Report</button>
			</div>
		</div>
	</div>
	<div class="row mb-0 mb-sm-4">
		<div class="col-6 col-sm-3 mb-4 mb-sm-0">
			<div class="widget widget-1 p-3 rounded-3 border border-1 border-dark">
				<div class="number">{{ reportCount.cleaning }}</div>
				<div class="d-flex justify-content-between">
					<div class="text">Total Cleaning Records</div>
					<div class="text">
						<a :href="docRoot+'/cleaning'">View all</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6 col-sm-3 mb-4 mb-sm-0">
			<div class="widget widget-2 p-3 rounded-3 border border-1 border-dark">
				<div class="number">{{ reportCount.drybox }}</div>
				<div class="d-flex justify-content-between">
					<div class="text">Total Drybox Records</div>
					<div class="text">
						<a :href="docRoot+'/drybox'">View all</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6 col-sm-3 mb-4 mb-sm-0">
			<div class="widget widget-3 p-3 rounded-3 border border-1 border-dark">
				<div class="number">{{ reportCount.imo1 }}</div>
				<div class="d-flex justify-content-between">
					<div class="text">Total IMO1 Condition Records</div>
					<div class="text">
						<a :href="docRoot+'/imo1'">View all</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6 col-sm-3 mb-4 mb-sm-0">
			<div class="widget widget-4 p-3 rounded-3 border border-1 border-dark">
				<div class="number">{{ reportCount.imo5 }}</div>
				<div class="d-flex justify-content-between">
					<div class="text">Total IMO5 Condition Records</div>
					<div class="text">
						<a :href="docRoot+'/imo5condition'">View all</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--  -->
	<div class="row mb-0 mb-sm-4">
		<div class="col-6 col-sm-3 mb-4 mb-sm-0">
			<div class="widget widget-5 p-3 rounded-3 border border-1 border-dark">
				<div class="number">{{ reportCount.shipperSurvey }}</div>
				<div class="d-flex justify-content-between">
					<div class="text">Total Shipper Records</div>
					<div class="text">
						<a :href="docRoot+'/shippersurvey'">View all</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6 col-sm-3 mb-4 mb-sm-0">
			<div class="widget widget-6 p-3 rounded-3 border border-1 border-dark">
				<div class="number">{{ reportCount.onhire }}</div>
				<div class="d-flex justify-content-between">
					<div class="text">Total On Hire Records</div>
					<div class="text">
						<a :href="docRoot+'/onhire'">View all</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6 col-sm-3 mb-4 mb-sm-0">
			<div class="widget widget-7 p-3 rounded-3 border border-1 border-dark">
				<div class="number">{{ reportCount.weightment }}</div>
				<div class="d-flex justify-content-between">
					<div class="text">Total Weightment Records</div>
					<div class="text">
						<a :href="docRoot+'/weightment'">View all</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--  -->
	<div class="row mb-0 mb-sm-4" v-if="dataFetched">
		<div class="col-12 d-flex flex-sm-row gap-2 align-items-center mb-4 mb-sm-0">
			<div class="mb-4 mb-sm-0">
				View Graph:
			</div>
			<div class="mb-4 mb-sm-0 duration-select">
				<select class="form-select" id="report_type" v-model="graphType" name="report" @change="showGraphFor()">
					<option :value="1">Condition</option>
					<option :value="2">Shipper</option>
					<option :value="3">Cleaning</option>
					<option :value="4">On hire</option>
					<option :value="5">Drybox</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row mb-0 mb-sm-4" v-if="dataFetched">
		<div class="col-12 mb-4 mb-sm-0">
			<div class="p-3 rounded-3 border border-1 border-dark">
				<Bar :data="chartData" :options="chartOptions"></Bar>
			</div>
		</div>
	</div>
	<!--  -->
</template>
<script>

import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
	name: "WidgetComponent",
	props: ["current_user_id", "all_permissions"],
	components: { Bar },
	data() {
		return {
			figureDuration: 1,
			startDate: this.firstOfMonth(),
			endDate: this.today(),
			labels: [],
			countData: [],
			dataFetched: false,
			graphType: 3,
			reportCount: {
				cleaning: 0,
				drybox: 0,
				imo1: 0,
				imo5: 0,
				onhire: 0,
				shipperSurvey: 0,
				weightment: 0,
			},
			chartData: {
				labels: ['a', 'b', 'c'],
				datasets: [{ data: [1, 2, 3] }]
			},
			chartOptions: {
				responsive: true
			}
		}
	},
	methods: {
		getAllReportCount() {
			let that = this;
			var URL = this.docRoot + "/api/reports/get-counts";
			axios.post(URL, { duration: this.figureDuration, startDate: this.startDate, endDate: this.endDate })
				.then(function (response) {
					that.reportCount = response.data.data.count;
					// get the data for chart
					that.last6Months = response.data.data.last_6_months;
					that.showGraphFor();
					that.dataFetched = true;
				})
				.catch(function (error) {
					console.log(error);
				});
		},
		showGraphFor() {
			console.log('graphType', this.graphType);
			if (this.graphType == 1) {
				// IMO1 condition
				if( this.last6Months && this.last6Months.imo1 ){
					this.labels = Object.keys(this.last6Months.imo1);
					this.countData = Object.values(this.last6Months.imo1);
					this.chartData = {
						labels: this.labels,
						datasets: [{
							label: 'IMO1 Conditions Records',
							backgroundColor: '#f87979',
							data: this.countData
						}]
					};
				}
			}
			else if (this.graphType == 2) {
				console.log(this.last6Months);
				// shipperSurvey
				if( this.last6Months && this.last6Months.shipperSurvey ){
					console.log(this.last6Months.shipperSurvey);
					this.labels = Object.keys(this.last6Months.shipperSurvey);
					this.countData = Object.values(this.last6Months.shipperSurvey);
					this.chartData = {
						labels: this.labels,
						datasets: [{
							label: 'Shipper Survey Records',
							backgroundColor: '#f87979',
							data: this.countData
						}]
					};
				}
			}
			else if (this.graphType == 3) {
				// cleaning
				if( this.last6Months && this.last6Months.cleaning ){
					this.labels = Object.keys(this.last6Months.cleaning);
					this.countData = Object.values(this.last6Months.cleaning);
					this.chartData = {
						labels: this.labels,
						datasets: [{
							label: 'Cleaning Records',
							backgroundColor: '#f87979',
							data: this.countData
						}]
					};
				}
			}
			else if (this.graphType == 4) {
				// onhire
				if( this.last6Months && this.last6Months.onhire ){
					this.labels = Object.keys(this.last6Months.onhire);
					this.countData = Object.values(this.last6Months.onhire);
					this.chartData = {
						labels: this.labels,
						datasets: [{
							label: 'Onhire Records',
							backgroundColor: '#f87979',
							data: this.countData
						}]
					}
				}
			}
			else if (this.graphType == 5) {
				// drybox
				if( this.last6Months && this.last6Months.drybox ){
					this.labels = Object.keys(this.last6Months.drybox);
					this.countData = Object.values(this.last6Months.drybox);
					this.chartData = {
						labels: this.labels,
						datasets: [{
							label: 'Drybox Records',
							backgroundColor: '#f87979',
							data: this.countData
						}]
					};
				}
			}
		},
		today() {
			let today = new Date();
			let dd = String(today.getDate()).padStart(2, '0');
			let mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
			let yyyy = today.getFullYear();
			return yyyy + '-' + mm + '-' + dd;
		},
		firstOfMonth() {
			let today = new Date();
			let dd = String(today.getDate()).padStart(2, '0');
			let mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
			let yyyy = today.getFullYear();
			return yyyy + '-' + mm + '-01';
		}
	},
	mounted() {
		this.getAllReportCount();
	},
}
</script>
<style>
.widget{
	.number{
		font-size: 48px;
	}
	.text{
		font-size: 14px;
	}
}
.widget-1, .widget-9{
	background-color: #DBF9B8;
	color: black;
}
.widget-2, .widget-10{
	background-color: #FE938C;
	color: black;
}
.widget-3, .widget-11{
	background-color: #6CD4FF;
	color: black;
}
.widget-4, .widget-12{
	background-color: #5D576B;
	color: white;
}
.widget-5, .widget-13{
	background-color: #345995;
	color: white;
}
.widget-6, .widget-14{
	background-color: #E4C3AD;
	color: black;
}
.widget-7, .widget-15{
	background-color: #A72608;
	color: white;
}
.widget-8, .widget-16{
	background-color: #A39BA8;
	color: black;
}
.duration-select{
	@media (max-width: 576px) {
		width: 100%;
	}
	@media (min-width: 576px) {
		width: 50%;
	}
	@media (min-width: 768px) {
		width: 25%;
	}
	@media (min-width: 992px) {
		width: 20%;
	}
	@media (min-width: 1200px) {
		width: 15%;
	}
}
</style>