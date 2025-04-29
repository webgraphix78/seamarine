<template>
	<div id="product-main">
		<div class="row mb-4">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<h4 class="m-0 me-4">ALL MASTERS</h4>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="card master-container">
					<div class="card-header">Masters</div>
					<ul class="list-group list-group-flush">
						<template v-if="permitted11Masters && permitted11Masters.length > 0">
							<li class="list-group-item" v-for="permittedObject in permitted11Masters">
								<a class="nav-link p-0 pt-2 d-flex align-items-center"
									:class="{ 'active': currentRoute === permittedObject.name.toLowerCase() }"
									:href="permittedObject.url">
									<i :class="'me-2 ph ph-'+permittedObject.phicon"></i>
									<span>{{ permittedObject.title }}</span>
								</a>
							</li>
						</template>
					</ul>
				</div>
			</div>
			<!--  -->
			<div class="col-sm-4">
				<div class="card master-container">
					<div class="card-header">CRM Masters</div>
					<ul class="list-group list-group-flush">
						<template v-if="permitted12Masters && permitted12Masters.length > 0">
							<li class="list-group-item" v-for="permittedObject in permitted12Masters">
								<a class="nav-link p-0 pt-2 d-flex align-items-center"
									:class="{ 'active': currentRoute === permittedObject.name.toLowerCase() }"
									:href="permittedObject.url">
									<i :class="'me-2 ph ph-'+permittedObject.phicon"></i>
									<span>{{ permittedObject.title }}</span>
								</a>
							</li>
						</template>
					</ul>
				</div>
			</div>
			<!--  -->
			<div class="col-sm-4">
				<div class="card master-container">
					<div class="card-header">Other Masters</div>
					<ul class="list-group list-group-flush">
						<template v-if="permitted13Masters && permitted13Masters.length > 0">
							<li class="list-group-item" v-for="permittedObject in permitted13Masters">
								<a class="nav-link p-0 pt-2 d-flex align-items-center"
									:class="{ 'active': currentRoute === permittedObject.name.toLowerCase() }"
									:href="permittedObject.url">
									<i :class="'me-2 ph ph-'+permittedObject.phicon"></i>
									<span>{{ permittedObject.title }}</span>
								</a>
							</li>
						</template>
					</ul>
				</div>
			</div>
			<!--  -->
		</div>
	</div>
</template>
<script>
// Get the current pathname
const currentPath = window.location.pathname;
// Split the pathname into an array of segments
const pathSegments = currentPath.split('/');
// Get the first segment
const firstEndpoint = pathSegments[1]; // Index 0 is an empty string due to leading slash
export default {
	data() {
		return {
			permitted11Masters: [],
			permitted12Masters: [],
			permitted13Masters: [],
			currentRoute: firstEndpoint,
			currentUser: siteUserObject
		}
	},
	mounted() {
		if (this.currentUser) {
			var that = this;
			axios.post(this.docRoot+"/role/get-permitted-objects", { role_id: this.currentUser.role_id })
				.then(function (response) {
					if (response.data.hasOwnProperty("status") && response.data.status == 1) {
						that.menuState = 1;
						if (response.data.hasOwnProperty("permitted_objects") && response.data.permitted_objects.length > 0) {
							response.data.permitted_objects.map((object) => {
								switch (object.category) {
									case 11:
										// Masters
										that.permitted11Masters.push(object);
										break;
									case 12:
										// Masters
										that.permitted12Masters.push(object);
										break;
									case 13:
										// Masters
										that.permitted13Masters.push(object);
										break;
								}
							});
						}
					}
				})
				.catch(function (error) {
					console.log(error);
				});
		}
	}
}
</script>
<style>
.master-container .ph{
	font-size: large;
}
</style>