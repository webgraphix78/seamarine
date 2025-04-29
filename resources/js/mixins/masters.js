import {DateTime} from "luxon";

export default {
	data() {
		return {
			GLOBAL_ROOT: ""
		};
	},
	mounted() {},
	methods: {
		async loadAllTankType(active) {
			var URL = this.docRoot + "/api/tanktype/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},
		async loadAllImoConditionStatus(active) {
			var URL = this.docRoot + "/api/imoconditionstatus/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},
		async loadAllCompany(active) {
			var URL = this.docRoot + "/api/company/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},
		async loadAllTank(active) {
			var URL = this.docRoot + "/api/tank/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},
		async loadAllTcode(active) {
			var URL = this.docRoot + "/api/tcode/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},

		async loadAllCustomer(active) {
			var URL = this.docRoot + "/api/customer/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},

		async loadAllInspectionLocation(active) {
			var URL = this.docRoot + "/api/inspectionlocation/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},

		async loadAllCleaningLocation(active) {
			var URL = this.docRoot + "/api/cleaninglocation/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},

		async loadAllSurveyor(active) {
			var URL = this.docRoot + "/api/surveyor/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},

		async loadAllCountry(active) {
			var URL = this.docRoot + "/api/country/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},
		async loadAllDepartments(active) {
			var URL = this.docRoot + "/api/department/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},
		async loadAllRole(active) {
			var URL = this.docRoot + "/api/role/get";
			let allRecords = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allRecords = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allRecords;
		},
		async loadAllUser(active) {
			var URL = this.docRoot + "/api/user/get";
			let allUsers = [];
			var postArr = {};
			if (active) postArr["active"] = 1;
			await axios
				.post(URL, postArr)
				.then(function (response) {
					allUsers = response.data.data;
				})
				.catch(function (error) {
					console.log(error);
				});
			return allUsers;
		},
		async refreshObject(object, name, state) {
			let that = this;
			var URL = this.docRoot + "/api/media/get-images";
			let images = [];
			console.log(name);
			var postArr = {
				object_id: object.id,
				object_name: name
			};
			await axios
				.post(URL, postArr)
				.then(function (response) {
					object.images = response.data;
					setTimeout(() => {
						that.uploadDataprops.relatedObject = object;
						if (state == 1) that.uploadDataprops.showModal = true;
					}, 100);
				})
				.catch(function (error) {
					console.log(error);
				});
			return images;
		}
	}
};
