<template>
	<div id="equipmentinspection-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_equipmentinspection_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/equipmentinspection'" role="button"><i class="ph ph-arrow-left"></i>Back to list</a>
					<h4 class="m-0 text-capitalize">View equipmentinspection</h4>
				</div>
			</div>
		</div>
		<div class="row py-2 bg-dark mb-3">
			<h4 class="fw-bold text-white text-center m-0">View Record in the System.</h4>
		</div>
		<!-- Top section -->
		<div class="row mb-4">
			<div class="col-md-6">
				<div class='row gy-3 align-items-center'>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Ref No</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.ref_no'>{{ readEquipmentInspection.ref_no }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Company Name</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.rel_company_id?.name'>{{ readEquipmentInspection.rel_company_id.name }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Inspection Date</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.inspection_date'>{{ readEquipmentInspection.inspection_date }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Tank Number</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.tank_no'>{{ readEquipmentInspection.tank_no }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Last Cargo Carried</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.last_cargo_carried'>{{ readEquipmentInspection.last_cargo_carried }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Empty Clean</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if="parsedempty_clean?.id=='1'">Yes</span>
						<span v-if="parsedempty_clean?.id=='0'">No</span>
						<span v-if="parsedempty_clean?.id=='-1'">NA</span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Empty Dirty</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if="parsedempty_dirty?.id=='1'">Yes</span>
						<span v-if="parsedempty_dirty?.id=='0'">No</span>
						<span v-if="parsedempty_dirty?.id=='-1'">NA</span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Loaded</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if="parsedloaded?.id=='1'">Yes</span>
						<span v-if="parsedloaded?.id=='0'">No</span>
						<span v-if="parsedloaded?.id=='-1'">NA</span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Surveyor Id</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.rel_surveyor_id?.name'>{{ readEquipmentInspection.rel_surveyor_id.name }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Hazard Class</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.hazard_class'>{{ readEquipmentInspection.hazard_class }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Status</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if="parsedeq_inspection_status?.id=='1'">Import</span>
						<span v-if="parsedeq_inspection_status?.id=='2'">Export</span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Last Test Date</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.last_test_date'>{{ readEquipmentInspection.last_test_date }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Capacity</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.capacity'>{{ readEquipmentInspection.capacity }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class='row gy-2 align-items-center'>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Equipment Type</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if="parsedequipment_type?.id=='1'">Loaded</span>
						<span v-if="parsedequipment_type?.id=='0'">Unloaded</span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">C.S.C.</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.csc'>{{ readEquipmentInspection.csc }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Loaded At</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.loaded_at'>{{ readEquipmentInspection.loaded_at }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Tank Type</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if="parsedtank_type?.id=='1'">IMO 1</span>
						<span v-if="parsedtank_type?.id=='2'">IMO 5</span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Mfgt. Date</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.mfg_date'>{{ readEquipmentInspection.mfg_date }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">CFS</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if="parsedcfs?.id=='-1'">NA</span>
						<span v-if="parsedcfs?.id=='1'">In</span>
						<span v-if="parsedcfs?.id=='0'">Out</span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">For Id</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.rel_for_id?.name'>{{ readEquipmentInspection.rel_for_id.name }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Next Date.</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.next_date'>{{ readEquipmentInspection.next_date }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Country</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.country'>{{ readEquipmentInspection.country }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Inspection Location</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.rel_inspection_location_id?.name'>{{ readEquipmentInspection.rel_inspection_location_id.name }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Customer</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.rel_customer_id?.name'>{{ readEquipmentInspection.rel_customer_id.name }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">CHA Client</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.cha_client'>{{ readEquipmentInspection.cha_client }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">Tare Weight</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.tare_weight'>{{ readEquipmentInspection.tare_weight }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
					<div class="col-md-4 mt-3">
						<label class="form-label fw-bold  m-0">MGW</label>
					</div>
					<div class="col-md-8 mt-1 mt-md-3">
						<span v-if='readEquipmentInspection.mgw'>{{ readEquipmentInspection.mgw }}</span>
						<span v-else><i>Not specified</i></span>
					</div>
				</div>
			</div>
		</div>
		<!-- Afg Inspection Hatch -->
		<div class="row mb-2 d-none d-md-flex">
			<div class="col-1 fw-bold"> S.No.</div>
			<div class="col-2 fw-bold">Fitting</div>
			<div class="col-2 fw-bold">TIR</div>
			<div class="col-3 fw-bold">Seal</div>
			<div class="col-4 fw-bold">Comments</div>
		</div>
		<!-- Bottom Discharge -->
		<div class='row mb-3 mb-md-2 align-items-center'>
			<div class="col-1 d-none d-md-block">01</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label fw-bold d-none d-md-block m-0">Bottom Discharge</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Bottom Discharge Tir</label>
				<div>
					<span v-if='readEquipmentInspection.bottom_discharge_tir'>{{ readEquipmentInspection.bottom_discharge_tir }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Bottom Discharge Seal</label>
				<div>
					<span v-if='readEquipmentInspection.bottom_discharge_seal'>{{ readEquipmentInspection.bottom_discharge_seal }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4">
				<label class="form-label fw-bold  d-md-none m-0">Bottom Discharge Comments</label>
				<div>
					<span v-if='readEquipmentInspection.bottom_discharge_comments'>{{ readEquipmentInspection.bottom_discharge_comments }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<!-- Bottom Discharge -->
		<!-- Manlid -->
		<div class='row mb-3 mb-md-2 align-items-center'>
			<div class="col-1 d-none d-md-block">02</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label fw-bold d-none d-md-block m-0">Manlid</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Manlid Tir</label>
				<div>
					<span v-if='readEquipmentInspection.manlid_tir'>{{ readEquipmentInspection.manlid_tir }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Manlid Seal</label>
				<div>
					<span v-if='readEquipmentInspection.manlid_seal'>{{ readEquipmentInspection.manlid_seal }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4">
				<label class="form-label fw-bold  d-md-none m-0">Manlid Comments</label>
				<div>
					<span v-if='readEquipmentInspection.manlid_comments'>{{ readEquipmentInspection.manlid_comments }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<!-- Manlid -->
		<!-- Airline Value -->
		<div class='row mb-3 mb-md-2 align-items-center'>
			<div class="col-1 d-none d-md-block">03</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label fw-bold d-none d-md-block m-0">Airline Value</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Airline Value Tir</label>
				<div>
					<span v-if='readEquipmentInspection.airline_value_tir'>{{ readEquipmentInspection.airline_value_tir }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Airline Value Seal</label>
				<div>
					<span v-if='readEquipmentInspection.airline_value_seal'>{{ readEquipmentInspection.airline_value_seal }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4 ">
				<label class="form-label fw-bold  d-md-none m-0">Airline Value Comments</label>
				<div>
					<span v-if='readEquipmentInspection.airline_value_comments'>{{ readEquipmentInspection.airline_value_comments }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<!-- Airline Value -->
		<!-- PRV -->
		<div class='row mb-3 mb-md-2 align-items-center'>
			<div class="col-1 d-none d-md-block">04</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label fw-bold d-none d-md-block m-0">PRV</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Prv Tir</label>
				<div>
					<span v-if='readEquipmentInspection.prv_tir'>{{ readEquipmentInspection.prv_tir }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Prv Seal</label>
				<div>
					<span v-if='readEquipmentInspection.prv_seal'>{{ readEquipmentInspection.prv_seal }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4">
				<label class="form-label fw-bold  d-md-none m-0">Prv Comments</label>
				<div>
					<span v-if='readEquipmentInspection.prv_comments'>{{ readEquipmentInspection.prv_comments }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<!-- PRV -->
		<!-- TOp discharge -->
		<div class='row mb-3 mb-md-2 align-items-center'>
			<div class="col-1 d-none d-md-block">05</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label fw-bold d-none d-md-block m-0">Top Discharge</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Top Discharge Tir</label>
				<div>
					<span v-if='readEquipmentInspection.top_discharge_tir'>{{ readEquipmentInspection.top_discharge_tir }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Top Discharge Seal</label>
				<div>
					<span v-if='readEquipmentInspection.top_discharge_seal'>{{ readEquipmentInspection.top_discharge_seal }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4">
				<label class="form-label fw-bold  d-md-none m-0">Top Discharge Comments</label>
				<div>
					<span v-if='readEquipmentInspection.top_discharge_comments'>{{ readEquipmentInspection.top_discharge_comments }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<!-- TOp discharge -->
		<!-- To Dischage / Fill Flange -->
		<div class='row mb-3 mb-md-2 align-items-center'>
			<div class="col-1 fw-bold d-none d-md-block">06</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label fw-bold d-none d-md-block m-0">To Dischage / Fill Flange</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">To Discharge Fill Flange Tir</label>
				<div>
					<span v-if='readEquipmentInspection.to_discharge_fill_flange_tir'>{{ readEquipmentInspection.to_discharge_fill_flange_tir }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">To Discharge Fill Flange Seal</label>
				<div>
					<span v-if='readEquipmentInspection.to_discharge_fill_flange_seal'>{{ readEquipmentInspection.to_discharge_fill_flange_seal }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4">
				<label class="form-label fw-bold  d-md-none m-0">To Discharge Fill Flange Comments</label>
				<div>
					<span v-if='readEquipmentInspection.to_discharge_fill_flange_comments'>{{ readEquipmentInspection.to_discharge_fill_flange_comments }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<!-- To Dischage / Fill Flange -->
		<!-- Safety Provision -->
		<div class='row mb-3 mb-md-2 align-items-center'>
			<div class="col-1 d-none d-md-block">07</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label fw-bold d-none d-md-block m-0">Safety Provision</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Safety Provision Tir</label>
				<div>
					<span v-if='readEquipmentInspection.safety_provision_tir'>{{ readEquipmentInspection.safety_provision_tir }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Safety Provision Seal</label>
				<div>
					<span v-if='readEquipmentInspection.safety_provision_seal'>{{ readEquipmentInspection.safety_provision_seal }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4">
				<label class="form-label fw-bold  d-md-none m-0">Safety Provision Comments</label>
				<div>
					<span v-if='readEquipmentInspection.safety_provision_comments'>{{ readEquipmentInspection.safety_provision_comments }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<!-- Safety Provision -->
		<!-- Vapour Return Provision -->
		<div class='row mb-3 mb-md-2 align-items-center'>
			<div class="col-1 d-none d-md-block">08</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label fw-bold d-none d-md-block m-0">Vapour Return Provision</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Vapour Return Provision Tir</label>
				<div>
					<span v-if='readEquipmentInspection.vapour_return_provision_tir'>{{ readEquipmentInspection.vapour_return_provision_tir }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Vapour Return Provision Seal</label>
				<div>
					<span v-if='readEquipmentInspection.vapour_return_provision_seal'>{{ readEquipmentInspection.vapour_return_provision_seal }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4">
				<label class="form-label fw-bold  d-md-none m-0">Vapour Return Provision Comments</label>
				<div>
					<span v-if='readEquipmentInspection.vapour_return_provision_comments'>{{ readEquipmentInspection.vapour_return_provision_comments }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<!-- Vapour Return Provision -->
		<!-- Fwd Inspection Hatch -->
		<div class='row mb-3 mb-md-2 align-items-center'>
			<div class="col-1 d-none d-md-block">09</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label fw-bold d-none d-md-block m-0">Fwd Inspection Hatch</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Fwd Inspection Hatch Tir</label>
				<div>
					<span v-if='readEquipmentInspection.fwd_inspection_hatch_tir'>{{ readEquipmentInspection.fwd_inspection_hatch_tir }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Fwd Inspection Hatch Seal</label>
				<div>
					<span v-if='readEquipmentInspection.fwd_inspection_hatch_seal'>{{ readEquipmentInspection.fwd_inspection_hatch_seal }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4">
				<label class="form-label fw-bold  d-md-none m-0">Fwd Inspection Hatch Comments</label>
				<div>
					<span v-if='readEquipmentInspection.fwd_inspection_hatch_comments'>{{ readEquipmentInspection.fwd_inspection_hatch_comments }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<!-- Fwd Inspection Hatch -->
		<!-- Afg Inspection Hatch -->
		<div class='row mb-3 align-items-center'>
			<div class="col-1 d-none d-md-block">10</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label fw-bold d-none d-md-block m-0">Afg Inspection Hatch</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Afg Inspection Hatch Tir</label>
				<div>
					<span v-if='readEquipmentInspection.afg_inspection_hatch_tir'>{{ readEquipmentInspection.afg_inspection_hatch_tir }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label class="form-label fw-bold  d-md-none m-0">Afg Inspection Hatch Seal</label>
				<div>
					<span v-if='readEquipmentInspection.afg_inspection_hatch_seal'>{{ readEquipmentInspection.afg_inspection_hatch_seal }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-4">
				<label class="form-label fw-bold  d-md-none m-0">Afg Inspection Hatch Comments</label>
				<div>
					<span v-if='readEquipmentInspection.afg_inspection_hatch_comments'>{{ readEquipmentInspection.afg_inspection_hatch_comments }}</span>
					<span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<!-- Afg Inspection Hatch -->
		<div class='row mb-3'>
			<div class="col-md-1">
				<label class="form-label fw-bold  m-0">Comments</label>
			</div>
			<div class="col-md-11">
				<span v-if='readEquipmentInspection.comments'>{{ readEquipmentInspection.comments }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>

	</div>
</template>
<script>
export default {
	name: "EquipmentInspectionmaster",
	props: ['current_user_id', 'all_permissions','id','isModal', 'readEquipmentInspection'],
	data(){
		return{
			currentUser: siteUserObject,
			readEquipmentInspection: {},
			allCompanyIdList: [],
			allSurveyorIdList: [],
			allForIdList: [],
			allInspectionLocationIdList: [],
			allCustomerIdList: [],
		}
	},
	computed: {
		parsedempty_clean() {
			try {
				if(this.readEquipmentInspection && this.readEquipmentInspection.empty_clean){
					return JSON.parse(this.readEquipmentInspection.empty_clean);
				}
			} catch (e) {
				return {};
			}
		},
		parsedempty_dirty() {
			try {
				if(this.readEquipmentInspection && this.readEquipmentInspection.empty_dirty){
					return JSON.parse(this.readEquipmentInspection.empty_dirty);
				}
			} catch (e) {
				return {};
			}
		},
		parsedloaded() {
			try {
				if(this.readEquipmentInspection && this.readEquipmentInspection.loaded){
					return JSON.parse(this.readEquipmentInspection.loaded);
				}
			} catch (e) {
				return {};
			}
		},
		parsedeq_inspection_status() {
			try {
				if(this.readEquipmentInspection && this.readEquipmentInspection.eq_inspection_status){
					return JSON.parse(this.readEquipmentInspection.eq_inspection_status);
				}
			} catch (e) {
				return {};
			}
		},
		parsedequipment_type() {
			try {
				if(this.readEquipmentInspection && this.readEquipmentInspection.equipment_type){
					return JSON.parse(this.readEquipmentInspection.equipment_type);
				}
			} catch (e) {
				return {};
			}
		},
		parsedtank_type() {
			try {
				if(this.readEquipmentInspection && this.readEquipmentInspection.tank_type){
					return JSON.parse(this.readEquipmentInspection.tank_type);
				}
			} catch (e) {
				return {};
			}
		},
		parsedcfs() {
			try {
				if(this.readEquipmentInspection && this.readEquipmentInspection.cfs){
					return JSON.parse(this.readEquipmentInspection.cfs);
				}
			} catch (e) {
				return {};
			}
		},
	},
	methods: {
		cancelAddEdit(event){
			window.location = this.docRoot + '/equipmentinspection';
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/equipmentinspection/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios.post(URL, {}).then(function (response) {
					that.closeSwal();
					that.readEquipmentInspection = Object.assign({}, response.data);
				})
				.catch(function (error) { console.log(error); });
			}
		}
	},
	async mounted() {
		if (this.id > 0){
			this.reloadEverything();
		}
	}
}
</script>
