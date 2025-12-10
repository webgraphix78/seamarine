<template>
	<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse text-light pb-5">
		<div class="position-sticky">
			<div class="flex-shrink-0 px-3">
				<ul class="navbar-nav nav flex-column" id="nav_open">
					<li class="nav-item">
						<a class="nav-link p-0 pt-2 d-flex align-items-center"
							:class="{ 'active': (currentRoute === 'home' || currentRoute === '/') }" aria-current="page"
							href="/home/">
							<i class="ph-gauge me-2"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<li class="nav-item" v-if="currentUser && currentUser.role_id == 1">
						<a class="nav-link p-0 pt-2 d-flex align-items-center"
							:class="{ 'active': currentRoute === 'user' }" :href="docRoot+'/user'">
							<i class="me-2 ph ph-users"></i><span>All Users</span>
						</a>
					</li>
				</ul>
				<!-- My Corner -->
				<template v-if="permittedObjectGroup !== null && permittedObjectGroup !== undefined">
					<template v-for="(permittedObjectGroup, groupName) in permittedObjectGroup">
						<h5 class="sidebar-heading d-flex mt-4 mb-1 fw-bolder align-items-center cursor-pointer"
							v-if="permittedObjectGroup && permittedObjectGroup.length > 0"
							@click="toggleSection(groupName)">
							<span class="flex-grow-1">{{ groupName }}</span>
							<i :class="collapsedSections[groupName] ? 'ph-caret-right' : 'ph-caret-down'" class="ms-2"></i>
						</h5>
						<ul class="navbar-nav nav flex-column" id="nav_masters"
							v-if="permittedObjectGroup && permittedObjectGroup.length > 0 && !collapsedSections[groupName]">
							<li class="nav-item" v-for="permittedObject in permittedObjectGroup">
								<a class="nav-link p-0 pt-2 d-flex align-items-center"
									:class="{ 'active': permittedObject.url.toLowerCase().includes(currentRoute) }"
									:href="docRoot+'/'+permittedObject.url">
									<i :class="'me-2 ph-'+permittedObject.phicon"></i>
									<span>{{ permittedObject.title }}</span>
								</a>
							</li>
						</ul>
					</template>
				</template>
			</div>
		</div>
	</nav>
</template>
<style>
.sidebar .nav-link.active {
	color: rgb(13, 219, 219);
}

.cursor-pointer {
	cursor: pointer;
}

.sidebar-headsing:hover {
	background-color: rgba(0, 0, 0, 0.05);
	border-radius: 4px;
	padding: 4px 8px;
}

.sidebar-heading {
	transition: background-color 0.2s ease;
	user-select: none;
}
</style>
<script>
// Get the current pathname
const currentPath = window.location.pathname;
// Split the pathname into an array of segments
const pathSegments = currentPath.split('/');
// trim all empty segments
while (pathSegments.includes('')) {
	pathSegments.splice(pathSegments.indexOf(''), 1);
}
// Get the first segment
const firstEndpoint = pathSegments[0];

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
			permittedInfo: [],
			permittedOthers: [],
			permittedObjectGroup: {},
			currentRoute: firstEndpoint,
			currentUser: siteUserObject,
			collapsedSections: {'Actions':false, 'Masters': false }
		}
	},
	methods: {
		toggleSection(groupName) {
			this.collapsedSections[groupName] = !this.collapsedSections[groupName];
		},
		initializeCollapsedState() {
			// Initialize all sections as collapsed except the one containing current route
			Object.keys(this.permittedObjectGroup).forEach(groupName => {
				const hasActiveRoute = this.permittedObjectGroup[groupName].some(item => 
					item.url.toLowerCase().includes(this.currentRoute)
				);
				this.collapsedSections[groupName] = !hasActiveRoute;
			});
		}
	},
	mounted() {
		if (this.currentUser) {
			var that = this;
			
			axios.post("/role/get-permitted-objects", { roles: JSON.parse(this.currentUser.roles) })
				.then(function (response) {
					if (response.data.hasOwnProperty("status") && response.data.status == 1) {
						that.menuState = 1;
						if (response.data.hasOwnProperty("permitted_objects") && response.data.permitted_objects !== null) {
							//
							that.permittedObjectGroup = JSON.parse(JSON.stringify(response.data.permitted_objects));
							// Initialize collapsed state after data is loaded
							that.initializeCollapsedState();
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
