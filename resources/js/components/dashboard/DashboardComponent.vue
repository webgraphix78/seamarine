<template lang="">
	<div>
		<h3>Dashboard</h3>
		<template v-if="all_permissions == '111'">
			<billing-component :current_user_id="current_user_id"></billing-component>
			<hr>
			<widget-component></widget-component>
		</template>
		<div v-else>
			<div class="row justify-content-center mt-4">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">Dashboard</div>
						<div class="card-body">
							You are logged in!
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	name: "DashboardComponent",
	props: ["current_user_id", "all_permissions"],
}
</script>
