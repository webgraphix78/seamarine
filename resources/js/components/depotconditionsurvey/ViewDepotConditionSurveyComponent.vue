<template>
	<div id="depotconditionsurvey-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_depotconditionsurvey_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/depotconditionsurvey'" role="button"><i class="ph ph-arrow-left"></i>Back to list</a>
					<h4 class="m-0 text-capitalize">View depot condition survey</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Tank No</label>
				<div>
					<span v-if='readDepotConditionSurvey.tank_no'>{{ readDepotConditionSurvey.tank_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Ref No</label>
				<div>
					<span v-if='readDepotConditionSurvey.ref_no'>{{ readDepotConditionSurvey.ref_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Company Id</label>
				<div>
					<span v-if='readDepotConditionSurvey.rel_company_id?.name'>{{ readDepotConditionSurvey.rel_company_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Date</label>
				<div>
					<span v-if='readDepotConditionSurvey.inspection_date'>{{ readDepotConditionSurvey.inspection_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Mfg Sr No</label>
				<div>
					<span v-if='readDepotConditionSurvey.mfg_sr_no'>{{ readDepotConditionSurvey.mfg_sr_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Last Test Date</label>
				<div>
					<span v-if='readDepotConditionSurvey.last_test_date'>{{ readDepotConditionSurvey.last_test_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Customer Id</label>
				<div>
					<span v-if='readDepotConditionSurvey.rel_customer_id?.name'>{{ readDepotConditionSurvey.rel_customer_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Mgw</label>
				<div>
					<span v-if='readDepotConditionSurvey.mgw'>{{ readDepotConditionSurvey.mgw }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Tare Wt</label>
				<div>
					<span v-if='readDepotConditionSurvey.tare_wt'>{{ readDepotConditionSurvey.tare_wt }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Iso Type</label>
				<div>
					<span v-if='readDepotConditionSurvey.iso_type'>{{ readDepotConditionSurvey.iso_type }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Capacity</label>
				<div>
					<span v-if='readDepotConditionSurvey.capacity'>{{ readDepotConditionSurvey.capacity }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Location Id</label>
				<div>
					<span v-if='readDepotConditionSurvey.rel_inspection_location_id?.name'>{{ readDepotConditionSurvey.rel_inspection_location_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Date Of Mfg</label>
				<div>
					<span v-if='readDepotConditionSurvey.date_of_mfg'>{{ readDepotConditionSurvey.date_of_mfg }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Mfg</label>
				<div>
					<span v-if='readDepotConditionSurvey.mfg'>{{ readDepotConditionSurvey.mfg }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Next Inspection Date</label>
				<div>
					<span v-if='readDepotConditionSurvey.next_inspection_date'>{{ readDepotConditionSurvey.next_inspection_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-6 mb-4 mb-md-0">
				<div class='row g-3'>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Protection Cover</label>
						<div>
							<span v-if="readDepotConditionSurvey.protection_cover=='1'">Yes</span>
							<span v-if="readDepotConditionSurvey.protection_cover=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Manhole Cover Fastening Bolts</label>
						<div>
							<span v-if="readDepotConditionSurvey.manhole_cover_fastening_bolts=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.manhole_cover_fastening_bolts=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Top Safety Valve Sr No</label>
						<div>
							<span v-if='readDepotConditionSurvey.top_safety_valve_sr_no'>{{ readDepotConditionSurvey.top_safety_valve_sr_no }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Top Safety Valve</label>
						<div>
							<span v-if="readDepotConditionSurvey.top_safety_valve=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.top_safety_valve=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Rupture Disc Series</label>
						<div>
							<span v-if="readDepotConditionSurvey.rupture_disc_series=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.rupture_disc_series=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Dipping Pipe</label>
						<div>
							<span v-if="readDepotConditionSurvey.dipping_pipe=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.dipping_pipe=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Air Valve</label>
						<div>
							<span v-if="readDepotConditionSurvey.air_valve=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.air_valve=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Dipstick</label>
						<div>
							<span v-if="readDepotConditionSurvey.dipstick=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.dipstick=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Manhole Gasket Type</label>
						<div>
							<span v-if='readDepotConditionSurvey.manhole_gasket_type'>{{ readDepotConditionSurvey.manhole_gasket_type }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Manhole Gasket</label>
						<div>
							<span v-if="readDepotConditionSurvey.manhole_gasket=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.manhole_gasket=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Walkway</label>
						<div>
							<span v-if="readDepotConditionSurvey.walkway=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.walkway=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Top Loading</label>
						<div>
							<span v-if='readDepotConditionSurvey.top_loading'>{{ readDepotConditionSurvey.top_loading }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Top Loading Flange</label>
						<div>
							<span v-if="readDepotConditionSurvey.top_loading_flange=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.top_loading_flange=='0'">No</span>
		
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class='row g-3'>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Heating Plug Pipe</label>
						<div>
							<span v-if="readDepotConditionSurvey.heating_plug_pipe=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.heating_plug_pipe=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Heating Pipe Covers</label>
						<div>
							<span v-if="readDepotConditionSurvey.heating_pipe_covers=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.heating_pipe_covers=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Bottom Outlet Valve</label>
						<div>
							<span v-if="readDepotConditionSurvey.bottom_outlet_valve=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.bottom_outlet_valve=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Bottom Valve Cap</label>
						<div>
							<span v-if="readDepotConditionSurvey.bottom_valve_cap=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.bottom_valve_cap=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Bottom Valve Bolts Nuts</label>
						<div>
							<span v-if="readDepotConditionSurvey.bottom_valve_bolts_nuts=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.bottom_valve_bolts_nuts=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Bottom Valve Lever</label>
						<div>
							<span v-if="readDepotConditionSurvey.bottom_valve_lever=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.bottom_valve_lever=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Ladder</label>
						<div>
							<span v-if="readDepotConditionSurvey.ladder=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.ladder=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Document Box</label>
						<div>
							<span v-if="readDepotConditionSurvey.document_box=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.document_box=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Thermometer Temp</label>
						<div>
							<span v-if='readDepotConditionSurvey.thermometer_temp'>{{ readDepotConditionSurvey.thermometer_temp }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Thermometer</label>
						<div>
							<span v-if="readDepotConditionSurvey.thermometer=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.thermometer=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Remote Shut Off</label>
						<div>
							<span v-if="readDepotConditionSurvey.remote_shut_off=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.remote_shut_off=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Hand Rail</label>
						<div>
							<span v-if="readDepotConditionSurvey.hand_rail=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.hand_rail=='0'">No</span>
		
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-6">
				<div class='row g-4'>
					<div class="col-12">
							<h5 class="text-uppercase mb-0 fw-semibold">INTERIOR CONDITION:</h5>
						</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Rust</label>
						<div>
							<span v-if="readDepotConditionSurvey.rust=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.rust=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Discolouration</label>
						<div>
							<span v-if="readDepotConditionSurvey.discolouration=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.discolouration=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Surface Scoring</label>
						<div>
							<span v-if="readDepotConditionSurvey.surface_scoring=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.surface_scoring=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Pitting Surface Pin</label>
						<div>
							<span v-if="readDepotConditionSurvey.pitting_surface_pin=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.pitting_surface_pin=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Corrosion Mark</label>
						<div>
							<span v-if="readDepotConditionSurvey.corrosion_mark=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.corrosion_mark=='0'">No</span>
		
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Others</label>
						<div>
							<span v-if="readDepotConditionSurvey.others=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.others=='0'">No</span>
		
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row mb-4">
					<div class="col-12">
						<h5 class="text-uppercase mb-0 fw-semibold">ANY VISIBLE DAMAGES TO FRAMEWORK/CLADDDING</h5>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Framework Front End</label>
						<div>
							<span v-if="readDepotConditionSurvey.framework_front_end=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.framework_front_end=='0'">No</span>
		
						</div>
					</div>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Cladding Front End</label>
						<div>
							<span v-if="readDepotConditionSurvey.cladding_front_end=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.cladding_front_end=='0'">No</span>
		
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Framework Rare End</label>
						<div>
							<span v-if="readDepotConditionSurvey.framework_rare_end=='1'">Yes</span>
							<span v-if="readDepotConditionSurvey.framework_rare_end=='0'">No</span>
		
						</div>
					</div>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Cladding Rare End</label>
						<div>
							<span v-if="readDepotConditionSurvey.cladding_rare_end=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.cladding_rare_end=='0'">No</span>
		
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Framework Right Side</label>
						<div>
							<span v-if="readDepotConditionSurvey.framework_right_side=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.framework_right_side=='0'">No</span>
		
						</div>
					</div>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Cladding Right Side</label>
						<div>
							<span v-if="readDepotConditionSurvey.cladding_right_side=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.cladding_right_side=='0'">No</span>
		
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Framework Left Side</label>
						<div>
							<span v-if="readDepotConditionSurvey.framework_left_side=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.framework_left_side=='0'">No</span>
		
						</div>
					</div>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Cladding Left Side</label>
						<div>
							<span v-if="readDepotConditionSurvey.cladding_left_side=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.cladding_left_side=='0'">No</span>
		
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Framework Top</label>
						<div>
							<span v-if="readDepotConditionSurvey.framework_top=='1'">Yes</span>
							<span v-if="readDepotConditionSurvey.framework_top=='0'">No</span>
		
						</div>
					</div>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Cladding Top</label>
						<div>
							<span v-if="readDepotConditionSurvey.cladding_top=='1'">Yes</span>
							<span v-if="readDepotConditionSurvey.cladding_top=='0'">No</span>
		
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Framework Bottom</label>
						<div>
							<span v-if="readDepotConditionSurvey.framework_bottom=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.framework_bottom=='0'">No</span>
		
						</div>
					</div>
					<div class="col-md-6">
						<label class="form-label text-uppercase fw-bold m-0">Cladding Bottom</label>
						<div>
							<span v-if="readDepotConditionSurvey.cladding_bottom=='1'">Yes</span>
					<span v-if="readDepotConditionSurvey.cladding_bottom=='0'">No</span>
		
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Exterior Remarks</label>
				<div>
					<span v-if='readDepotConditionSurvey.exterior_remarks'>{{ readDepotConditionSurvey.exterior_remarks }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-4">
				<label class="form-label text-uppercase fw-bold m-0">Liquid Tank No</label>
				<div>
					<span v-if='readDepotConditionSurvey.liquid_tank_no'>{{ readDepotConditionSurvey.liquid_tank_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4">
				<label class="form-label text-uppercase fw-bold m-0">Liquid Inspection Date</label>
				<div>
					<span v-if='readDepotConditionSurvey.liquid_inspection_date'>{{ readDepotConditionSurvey.liquid_inspection_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4">
				<label class="form-label text-uppercase fw-bold m-0">Liquid Inspection Location Id</label>
				<div>
					<span v-if='readDepotConditionSurvey.rel_liquid_inspection_location_id?.name'>{{ readDepotConditionSurvey.rel_liquid_inspection_location_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Liquid Img</label>
				<div>
					<template v-if='readDepotConditionSurvey.liquid_img && readDepotConditionSurvey.liquid_img.length > 5'>
						<img :src="docRoot + '/depotconditionsurvey/view-file/' + readDepotConditionSurvey.id + '/liquid_img/_s/123'" style="max-width: 100px" />
					</template>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Remarks</label>
				<div>
					<span v-if='readDepotConditionSurvey.remarks'>{{ readDepotConditionSurvey.remarks }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Surveyor Id</label>
				<div>
					<span v-if='readDepotConditionSurvey.rel_surveyor_id?.name'>{{ readDepotConditionSurvey.rel_surveyor_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	name: "DepotConditionSurveymaster",
	props: ['current_user_id', 'all_permissions','id','isModal', 'readDepotConditionSurvey'],
	data(){
		return{
			currentUser: siteUserObject,
			readDepotConditionSurvey: {},
			allCompanyIdList: [],
			allCustomerIdList: [],
			allInspectionLocationIdList: [],
			allLiquidInspectionLocationIdList: [],
			allSurveyorIdList: [],
		}
	},
	computed: {
			
		parsedprotection_cover() {
			try {
				if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.protection_cover){
					return JSON.parse(this.readDepotConditionSurvey.protection_cover);
				}
			} catch (e) {
				return {};
			}
		},
		parsedmanhole_cover_fastening_bolts() {
			try {
				if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.manhole_cover_fastening_bolts){
					return JSON.parse(this.readDepotConditionSurvey.manhole_cover_fastening_bolts);
				}
			} catch (e) {
				return {};
			}
		},
	
		parsedtop_safety_valve() {
			try {
				if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.top_safety_valve){
					return JSON.parse(this.readDepotConditionSurvey.top_safety_valve);
				}
			} catch (e) {
				return {};
			}
		},
	
		parsedrupture_disc_series() {
			try {
				if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.rupture_disc_series){
					return JSON.parse(this.readDepotConditionSurvey.rupture_disc_series);
				}
			} catch (e) {
				return {};
			}
		},
			
		parseddipping_pipe() {
			try {
				if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.dipping_pipe){
					return JSON.parse(this.readDepotConditionSurvey.dipping_pipe);
				}
			} catch (e) {
				return {};
			}
		},
			
		parsedair_valve() {
			try {
				if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.air_valve){
					return JSON.parse(this.readDepotConditionSurvey.air_valve);
				}
			} catch (e) {
				return {};
			}
		},
			
		parseddipstick() {
			try {
				if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.dipstick){
					return JSON.parse(this.readDepotConditionSurvey.dipstick);
				}
			} catch (e) {
				return {};
			}
		},
			
		parsedmanhole_gasket() {
			try {
				if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.manhole_gasket){
					return JSON.parse(this.readDepotConditionSurvey.manhole_gasket);
				}
			} catch (e) {
				return {};
			}
		},
			
		parsedwalkway() {
			try {
				if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.walkway){
					return JSON.parse(this.readDepotConditionSurvey.walkway);
				}
			} catch (e) {
				return {};
			}
		},
			
		parsedtop_loading_flange() {
			try {
				if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.top_loading_flange){
					return JSON.parse(this.readDepotConditionSurvey.top_loading_flange);
				}
			} catch (e) {
				return {};
			}
		},
			
		parsedheating_plug_pipe() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.heating_plug_pipe){
						return JSON.parse(this.readDepotConditionSurvey.heating_plug_pipe);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedheating_pipe_covers() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.heating_pipe_covers){
						return JSON.parse(this.readDepotConditionSurvey.heating_pipe_covers);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedbottom_outlet_valve() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.bottom_outlet_valve){
						return JSON.parse(this.readDepotConditionSurvey.bottom_outlet_valve);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedbottom_valve_cap() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.bottom_valve_cap){
						return JSON.parse(this.readDepotConditionSurvey.bottom_valve_cap);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedbottom_valve_bolts_nuts() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.bottom_valve_bolts_nuts){
						return JSON.parse(this.readDepotConditionSurvey.bottom_valve_bolts_nuts);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedbottom_valve_lever() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.bottom_valve_lever){
						return JSON.parse(this.readDepotConditionSurvey.bottom_valve_lever);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedladder() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.ladder){
						return JSON.parse(this.readDepotConditionSurvey.ladder);
					}
				} catch (e) {
					return {};
				}
			},
			
		parseddocument_box() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.document_box){
						return JSON.parse(this.readDepotConditionSurvey.document_box);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedthermometer() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.thermometer){
						return JSON.parse(this.readDepotConditionSurvey.thermometer);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedremote_shut_off() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.remote_shut_off){
						return JSON.parse(this.readDepotConditionSurvey.remote_shut_off);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedhand_rail() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.hand_rail){
						return JSON.parse(this.readDepotConditionSurvey.hand_rail);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedrust() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.rust){
						return JSON.parse(this.readDepotConditionSurvey.rust);
					}
				} catch (e) {
					return {};
				}
			},
			
		parseddiscolouration() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.discolouration){
						return JSON.parse(this.readDepotConditionSurvey.discolouration);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedsurface_scoring() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.surface_scoring){
						return JSON.parse(this.readDepotConditionSurvey.surface_scoring);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedpitting_surface_pin() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.pitting_surface_pin){
						return JSON.parse(this.readDepotConditionSurvey.pitting_surface_pin);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedcorrosion_mark() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.corrosion_mark){
						return JSON.parse(this.readDepotConditionSurvey.corrosion_mark);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedothers() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.others){
						return JSON.parse(this.readDepotConditionSurvey.others);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedframework_front_end() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.framework_front_end){
						return JSON.parse(this.readDepotConditionSurvey.framework_front_end);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedcladding_front_end() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.cladding_front_end){
						return JSON.parse(this.readDepotConditionSurvey.cladding_front_end);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedframework_rare_end() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.framework_rare_end){
						return JSON.parse(this.readDepotConditionSurvey.framework_rare_end);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedcladding_rare_end() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.cladding_rare_end){
						return JSON.parse(this.readDepotConditionSurvey.cladding_rare_end);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedframework_right_side() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.framework_right_side){
						return JSON.parse(this.readDepotConditionSurvey.framework_right_side);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedcladding_right_side() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.cladding_right_side){
						return JSON.parse(this.readDepotConditionSurvey.cladding_right_side);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedframework_left_side() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.framework_left_side){
						return JSON.parse(this.readDepotConditionSurvey.framework_left_side);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedcladding_left_side() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.cladding_left_side){
						return JSON.parse(this.readDepotConditionSurvey.cladding_left_side);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedframework_top() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.framework_top){
						return JSON.parse(this.readDepotConditionSurvey.framework_top);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedcladding_top() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.cladding_top){
						return JSON.parse(this.readDepotConditionSurvey.cladding_top);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedframework_bottom() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.framework_bottom){
						return JSON.parse(this.readDepotConditionSurvey.framework_bottom);
					}
				} catch (e) {
					return {};
				}
			},
			
		parsedcladding_bottom() {
				try {
					if(this.readDepotConditionSurvey && this.readDepotConditionSurvey.cladding_bottom){
						return JSON.parse(this.readDepotConditionSurvey.cladding_bottom);
					}
				} catch (e) {
					return {};
				}
			},

	},
	methods: {
		cancelAddEdit(event){
			window.location = this.docRoot + '/depotconditionsurvey';
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/depotconditionsurvey/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.readDepotConditionSurvey = Object.assign({}, response.data);
					})
					.catch(function (error) {
						console.log(error);
					});
			}
		}
	},
	async mounted() {
		if (this.id > 0){
			this.reloadEverything();
			this.allProtectionCoverList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allManholeCoverFasteningBoltsList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allTopSafetyValveList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allRuptureDiscSeriesList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allDippingPipeList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allAirValveList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allDipstickList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allManholeGasketList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allWalkwayList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allTopLoadingFlangeList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allHeatingPlugPipeList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allHeatingPipeCoversList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allBottomOutletValveList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allBottomValveCapList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allBottomValveBoltsNutsList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allBottomValveLeverList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allLadderList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allDocumentBoxList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allThermometerList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allRemoteShutOffList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allHandRailList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allRustList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allDiscolourationList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allSurfaceScoringList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allPittingSurfacePinList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allCorrosionMarkList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allOthersList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allFrameworkFrontEndList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allCladdingFrontEndList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allFrameworkRareEndList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allCladdingRareEndList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allFrameworkRightSideList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allCladdingRightSideList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allFrameworkLeftSideList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allCladdingLeftSideList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allFrameworkTopList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allCladdingTopList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allFrameworkBottomList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
			this.allCladdingBottomList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
		}
	}
}
</script>
