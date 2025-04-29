<template lang="">
	<div id="imo5-main">
		<div class="row mb-4">
			<div class="col-sm-12">
				<div class="d-flex align-items-center mb-2">
					<h4 class="m-0 me-4">View IMO 5 CONDITION Record</h4>
					<a id="add_imo1_btn" class="btn btn-outline-dark btn-sm" :href="docRoot+'/imo5condition'">Back to list</a>
				</div>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Container No</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.container_no">{{ readImo5Condition.container_no }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Tank Type</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.tank_type">{{ readImo5Condition.tank_type?.type }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>

		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">T-Code</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.tcode">{{ readImo5Condition.tcode?.name }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Status</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.imo_status == 1">Import</span>
				<span v-else-if="readImo5Condition.imo_status == 0">Export</span>
				<span v-else><i>Not specified</i></span>
				&nbsp;
				<span v-if="readImo5Condition.imo_status == 1">-&nbsp;Sealed</span>
				<span v-else-if="readImo5Condition.imo_status == 0">-&nbsp;Unsealed</span>
			</div>
		</div>

		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">At the request of</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.client">{{ readImo5Condition.client }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Depot</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.cleaning_location">{{ readImo5Condition.cleaning_location?.name }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Tank Capacity</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.capacity">{{ readImo5Condition.capacity }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Survey Date</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.survey_date">{{ readImo5Condition.survey_date }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Mfgt Date</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.mfgt_date">{{ readImo5Condition.mfgt_date }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Customer</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.customer">{{ readImo5Condition.customer?.name }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Max Gross Wt</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.gross_wt">{{ readImo5Condition.gross_wt }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Ref No</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.refno">{{ readImo5Condition.refno }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">CSC</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.csc">{{ readImo5Condition.csc }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Sunshield Cover</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.scover">{{ arrYesNoNA[readImo5Condition.scover] }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Location</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.inspection_location">{{ readImo5Condition.inspection_location?.name }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Bottom Valve Box</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.bvboxyn">{{ readImo5Condition.bvboxyn }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Next Date</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.next_date">{{ readImo5Condition.next_date }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Tare Wt</label>
			</div>
			<div class="col-3">
				<span v-if="readImo5Condition.tare_wt">{{ readImo5Condition.tare_wt }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Comments</label>
			</div>
			<div class="col-10">
				<span v-if="readImo5Condition.comments">{{ readImo5Condition.comments }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-2 border-secondary border-bottom">
			<div class="col-4 fw-bold text-center p-2 text-primary">COMPONENT CHECK LIST</div>
			<div class="col-2 fw-bold text-center p-2 text-primary">FITTED</div>
			<div class="col-2 fw-bold text-center p-2 text-primary">CONDITION</div>
			<div class="col-4 fw-bold text-center p-2 text-primary">REMARKS</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">MARKINGS AND PLATES</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.markings_fitted_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.markings_condition_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.marking_plates }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Data Plate</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.data_fitted_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.data_condition_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.data_plate }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Owners Plate</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.owners_plate_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.owners_plate_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.owners_plate }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Manufactures Plate</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.manufactures_plate_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.manufactures_plate_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.manufactures_plates }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">CSC Plate</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.csc_plate_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.csc_plate_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.csc_plate }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Customs approval plate</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.customs_plate_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.customs_plate_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.customs_plate }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Prefix/Number</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.prefix_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.prefix_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.prefix }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">IMO/Number</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.imo_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.imo_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.imo }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Country Code</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.country_code_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.country_code_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.country_code }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Rear Ladder</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.rear_ladder_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.rear_ladder_good] }}
			</div>
			<div class="col-4">
				{{ arrYesNoNA[readImo5Condition.rear_ladder] }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Front Ladder</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.front_ladder_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.front_ladder_good] }}
			</div>
			<div class="col-4">
				{{ arrYesNoNA[readImo5Condition.front_ladder] }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Document Box/Cap/Gask/Chain</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.document_box_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.document_box_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.document_box }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Outlet/Blank/Gask/Chain</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.outlet_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.outlet_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.outlet }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Bottom outlet valve/gaskets</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.bottom_outlet_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.bottom_outlet_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.bottom_outlet }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Footvalve</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.foot_valve_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.foot_valve_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.foot_valve }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Remote Footvalve control</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.remote_footvalve_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.remote_footvalve_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.remote_footvalve }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Steam Tubes/Cap/Gask/Chain</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.steam_tubes_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.steam_tubes_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.steam_tubes }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Condensate drain</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.condensate_drains_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.condensate_drains_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.condensate_drains }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Thermometer</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.thermometer_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.thermometer_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.thermometer }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Walkway</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.walkway_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.walkway_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.walkway }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Manlid Protection Cover</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.manlid_protection_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.manlid_protection_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.manlid_protection }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Spillbox</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.spillbox_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.spillbox_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.spillbox }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Manlid</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.manlid_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.manlid_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.manlid }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Manlid Bolts</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.manlid_bolts_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.manlid_bolts_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.manlid_bolts }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Dipstick</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.dipstick_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.dipstick_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.dipstick }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Safety Dev.Prot.Cover</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.safety_cover_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.safety_cover_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.safety_cover }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Calibration Chart</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.calibration_chart_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.calibration_chart_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.calibration_chart }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">P/V Relief Valves Yes</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.relief_valves_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.relief_valves_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.relief_valves }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Pressure Gauges</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.pressure_gauges_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.pressure_gauges_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.pressure_gauges }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Flame Traps on P/V Rel.Val.</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.flame_traps_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.flame_traps_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.flame_traps }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Air Line Cap</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.air_line_cap_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.air_line_cap_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.air_line_cap }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Air Line Valve</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.air_line_valve_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.air_line_valve_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.air_line_valve }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Top Disch Prot Cover </label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.top_disch_prot_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.top_disch_prot_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.top_disch_prot }}
			</div>
		</div>
		<div class="row mb-2 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Top Disch Valve</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.top_disch_valve_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.top_disch_valve_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.top_disch_valve }}
			</div>
		</div>
		<div class="row mb-4 pb-2 border-secondary border-bottom">
			<div class="col-4">
				<label class="form-label text-uppercase fw-bold pt-2 me-3">Top Disch. Blank</label>
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.top_condition_yes] }}
			</div>
			<div class="col-2 text-center">
				{{ arrYesNoNA[readImo5Condition.top_condition_good] }}
			</div>
			<div class="col-4">
				{{ readImo5Condition.top_condition }}
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: "ViewIMO5Master",
		props: ["current_user_id", "all_permissions", "id"],
		data() {
			return {
				currentUser: siteUserObject,
				readImo5Condition: {},
				arrYesNoNA: { "1": "Yes", "0": "No", "-1": "NA" },
				arrYesNo: { "1": "Yes", "0": "No" },
			};
		},
		methods: {
			reloadEverything() {
				if (this.id !== undefined && !isNaN(this.id)) {
					this.mode = "edit";
					// This is Edit mode - fetch inquiry data
					var that = this;
					var URL = this.docRoot + "/api/imo5condition/get-record/" + this.id;
					this.showLoading("Loading ...");
					axios
						.post(URL, {})
						.then(function (response) {
							that.closeSwal();
							that.readImo5Condition = Object.assign({}, response.data);
						})
						.catch(function (error) {
							console.log(error);
						});
				}
			}
		},
		async mounted() {
			this.reloadEverything();
		}
	};
</script>
