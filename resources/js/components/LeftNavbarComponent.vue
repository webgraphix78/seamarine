<template>
	<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar offcanvas-sm collapse text-dark">
		<div class="position-sticky">
			<div class="flex-shrink-0 px-3">
				<ul class="navbar-nav nav flex-column" id="nav_open">
					<li class="nav-item text-center p-2">
						<a class="nav-link p-0 pt-2 align-items-center d-block d-sm-none" href="#" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
							<i class="ph ph-x me-2"></i>
							<span>CLOSE MENU</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link p-0 pt-2 d-flex align-items-center"
							:class="{ 'active': (currentRoute === 'home' || currentRoute === '/') }" aria-current="page"
							href="/home">
							<i class="ph-gauge me-2"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<!--li class="nav-item">
						<a class="nav-link p-0 pt-2 d-flex align-items-center"
							:class="{ 'active': currentRoute === 'calendar' }" aria-current="page" href="#">
							<i class="ph-calendar me-2"></i>
							<span>Calendar</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link p-0 pt-2 d-flex align-items-center"
							:class="{ 'active': currentRoute === 'all-masters' }" href="/all-masters">
							<i class="me-2 ph ph-square"></i><span>All Masters</span>
						</a>
					</li-->
					<li class="nav-item" v-if="currentUser && currentUser.role_id == 1">
						<a class="nav-link p-0 pt-2 d-flex align-items-center"
							:class="{ 'active': currentRoute === 'user' }" :href="docRoot+'/user'">
							<i class="me-2 ph ph-users"></i><span>All Users</span>
						</a>
					</li>
				</ul>
				<!-- Information -->
				<h5 class="sidebar-heading d-flex mt-4 mb-1 fw-bolder"
					v-if="permittedMasters && permittedMasters.length > 0 && currentUser && currentUser.role_id == 1">
					<span>MASTERS</span>
				</h5>
				<ul class="navbar-nav nav flex-column" id="nav_masters"
					v-if="permittedMasters && permittedMasters.length > 0 && currentUser && currentUser.role_id == 1">
					<li class="nav-item" v-for="permittedObject in permittedMasters">
						<a class="nav-link p-0 pt-2 d-flex align-items-center"
							:class="{ 'active': currentRoute === permittedObject.name.toLowerCase() }"
							:href="docRoot+'/'+permittedObject.url">
							<i :class="'me-2 ph ph-'+permittedObject.phicon"></i>
							<span>{{ permittedObject.title }}</span>
						</a>
					</li>
				</ul>
				<!-- Information -->
				<!-- My Corner -->
				<h5 class="sidebar-heading d-flex mt-4 mb-1 fw-bolder"
					v-if="permittedActions && permittedActions.length > 0">
					<span>Actions</span>
				</h5>
				<ul class="navbar-nav nav flex-column" id="nav_masters"
					v-if="permittedActions && permittedActions.length > 0">
					<li class="nav-item" v-for="permittedObject in permittedActions">
						<a class="nav-link p-0 pt-2 d-flex align-items-center"
							:class="{ 'active': currentRoute === permittedObject.name.toLowerCase() }"
							:href="docRoot+'/'+permittedObject.url">
							<i :class="'me-2 ph ph-'+permittedObject.phicon"></i>
							<span>{{ permittedObject.title }}</span>
						</a>
					</li>
				</ul>
				<!-- My Corner -->
				<!-- Others -->
				<h5 class="sidebar-heading d-flex mt-4 mb-1 fw-bolder"
					v-if="permittedOthers && permittedOthers.length > 0">
					<span>ACTIONS</span>
				</h5>
				<ul class="navbar-nav nav flex-column mb-4" id="nav_masters"
					v-if="permittedOthers && permittedOthers.length > 0">
					<li class="nav-item" v-for="permittedObject in permittedOthers">
						<a class="nav-link p-0 pt-2 d-flex align-items-center"
							:class="{ 'active': currentRoute === permittedObject.name.toLowerCase() }"
							:href="docRoot+'/'+permittedObject.url">
							<i :class="'me-2 ph ph-'+permittedObject.phicon"></i>
							<span>{{ permittedObject.title }}</span>
						</a>
					</li>
				</ul>
				<!-- Others -->
			</div>
		</div>
	</nav>
</template>
<style>
.sidebar .nav-link.active {
	color: rgb(13, 219, 219);
}
</style>
<script>
// Get the current pathname
const currentPath = window.location.pathname;
// Split the pathname into an array of segments
const pathSegments = currentPath.split('/');
// Get the first segment
const firstEndpoint = pathSegments[1]; // Index 0 is an empty string due to leading slash

export default {
   data(){
		return {
			menuState: 0,
			// For toggling
			salesMasters: true,
			salesTransac: false,
			vendorMasters: false,
			mainMasters: false,
			userMasters: false,
			otherMasters: false,
			permittedActions: [],
			permittedMasters: [],
			permittedOthers: [],
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
									case 1:
										// Information
										that.permittedActions.push(object);
										break;
									case 11:
										// Masters
										that.permittedMasters.push(object);
										break;
									case 12:
										// Actions
										that.permittedOthers.push(object);
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
