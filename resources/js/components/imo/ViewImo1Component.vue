<template>
	<div id="imo1-main">
		<div class="row mb-4">
			<div class="col-sm-12">
				<div class="d-flex align-items-center mb-2">
					<h4 class="m-0 me-4">View IMO 1 CONDITION Record</h4>
					<a id="add_imo1_btn" class="btn btn-outline-dark btn-sm" :href="docRoot+'/imo1'">Back to list</a>
				</div>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Ref No</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.ref_no">{{ readImo1.ref_no }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Company Id</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.company_id">{{ readImo1.company?.name }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Date</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.inspection_date">{{ formatMySQLDate(readImo1.inspection_date, "MMM dd, yyyy") }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">C.S.C.</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.csc">{{ readImo1.csc }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Loaded At</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.loaded_at">{{ readImo1.loaded_at }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Tank Type</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.tanktype?.name">{{ readImo1.tanktype?.name }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Tank Number</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.tank_no">{{ readImo1.tank_no }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">T-Code</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.tcode?.name">{{ readImo1.tcode?.name }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Last Cargo Carried</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.last_cargo_carried">{{ readImo1.last_cargo_carried }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Mfgt Date</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.mfgt_date">{{ readImo1.mfgt_date }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Empty Clean</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.empty_clean == '1'">Yes</span>
				<span v-if="readImo1.empty_clean == '0'">No</span>
				<span v-if="readImo1.empty_clean == '-1'">NA</span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Empty Dirty</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.empty_dirty == '1'">Yes</span>
				<span v-if="readImo1.empty_dirty == '0'">No</span>
				<span v-if="readImo1.empty_dirty == '-1'">NA</span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">CFS</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.cfs == '1'">In</span>
				<span v-if="readImo1.cfs == '0'">Out</span>
				<span v-if="readImo1.cfs == '-1'">NA</span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">For</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.for_client?.name">{{ readImo1.for_client?.name }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Loaded</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.loaded == '1'">Yes</span>
				<span v-if="readImo1.loaded == '0'">No</span>
				<span v-if="readImo1.loaded == '-1'">NA</span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Next Date</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.next_date">{{ readImo1.next_date }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Surveyor</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.surveyor?.name">{{ readImo1.surveyor?.name }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Country</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.country">{{ readImo1.country }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Hazard Class</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.hazard_class">{{ readImo1.hazard_class }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Location</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.inspection_location?.name">{{ readImo1.inspection_location?.name }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-1 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Customer</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.customer?.name">{{ readImo1.customer?.name }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">CHA Client</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.cha_client == '1'">Yes</span>
				<span v-if="readImo1.cha_client == '0'">No</span>
			</div>
		</div>
		<div class="row mb-4 border-bottom">
			<div class="col-2 text-end px-1">
				<label class="form-label text-uppercase fw-bold m-0">Status</label>
			</div>
			<div class="col-3">
				<span v-if="readImo1.imo1_status == '1'">Import</span>
				<span v-if="readImo1.imo1_status == '0'">Export</span>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-sm-4">
				<div class="clear text-center mb-2">ANY VISIBLE DAMAGE TO CLADDING/DECALS</div>
				<div class="row mb-2 border-bottom">
					<div class="col-5">&nbsp;</div>
					<div class="col-3 px-1 text-center fw-bold">CLADDING</div>
					<div class="col-3 px-1 text-center fw-bold">DECALS</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-5">
						<label class="form-label fw-bold m-0">Front Panel</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.front_panel_cladding == '1'">Yes</span>
						<span v-if="readImo1.front_panel_cladding == '0'">No</span>
						<span v-if="readImo1.front_panel_cladding == '-1'">NA</span>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.front_panel_decals == '1'">Yes</span>
						<span v-if="readImo1.front_panel_decals == '0'">No</span>
						<span v-if="readImo1.front_panel_decals == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-5">
						<label class="form-label fw-bold m-0">Rear Panel</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.rear_panel_cladding == '1'">Yes</span>
						<span v-if="readImo1.rear_panel_cladding == '0'">No</span>
						<span v-if="readImo1.rear_panel_cladding == '-1'">NA</span>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.rear_panel_decals == '1'">Yes</span>
						<span v-if="readImo1.rear_panel_decals == '0'">No</span>
						<span v-if="readImo1.rear_panel_decals == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-5">
						<label class="form-label fw-bold m-0">Right Side</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.right_side_cladding == '1'">Yes</span>
						<span v-if="readImo1.right_side_cladding == '0'">No</span>
						<span v-if="readImo1.right_side_cladding == '-1'">NA</span>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.right_side_decals == '1'">Yes</span>
						<span v-if="readImo1.right_side_decals == '0'">No</span>
						<span v-if="readImo1.right_side_decals == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-5">
						<label class="form-label fw-bold m-0">Left Side</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.left_side_cladding == '1'">Yes</span>
						<span v-if="readImo1.left_side_cladding == '0'">No</span>
						<span v-if="readImo1.left_side_cladding == '-1'">NA</span>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.left_side_decals == '1'">Yes</span>
						<span v-if="readImo1.left_side_decals == '0'">No</span>
						<span v-if="readImo1.left_side_decals == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-5">
						<label class="form-label fw-bold m-0">Top</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.top_cladding == '1'">Yes</span>
						<span v-if="readImo1.top_cladding == '0'">No</span>
						<span v-if="readImo1.top_cladding == '-1'">NA</span>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.top_decals == '1'">Yes</span>
						<span v-if="readImo1.top_decals == '0'">No</span>
						<span v-if="readImo1.top_decals == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-5">
						<label class="form-label fw-bold m-0">Underside</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.underside_cladding == '1'">Yes</span>
						<span v-if="readImo1.underside_cladding == '0'">No</span>
						<span v-if="readImo1.underside_cladding == '-1'">NA</span>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.underside_decals == '1'">Yes</span>
						<span v-if="readImo1.underside_decals == '0'">No</span>
						<span v-if="readImo1.underside_decals == '-1'">NA</span>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="clear text-center mb-2">ANY VISIBLE DAMAGE TO FRAME MEMBERS</div>
				<div class="row mb-2 border-bottom">
					<div class="col-8">&nbsp;</div>
					<div class="col-3 text-center fw-bold">YES/NO</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Front End</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.front_end_damage == '1'">Yes</span>
						<span v-if="readImo1.front_end_damage == '0'">No</span>
						<span v-if="readImo1.front_end_damage == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Rear End</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.rear_end_damage == '1'">Yes</span>
						<span v-if="readImo1.rear_end_damage == '0'">No</span>
						<span v-if="readImo1.rear_end_damage == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Right Side</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.right_side_damage == '1'">Yes</span>
						<span v-if="readImo1.right_side_damage == '0'">No</span>
						<span v-if="readImo1.right_side_damage == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Left Side</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.left_side_damage == '1'">Yes</span>
						<span v-if="readImo1.left_side_damage == '0'">No</span>
						<span v-if="readImo1.left_side_damage == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Top (Bent ABV 25MM)</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.top_damage == '1'">Yes</span>
						<span v-if="readImo1.top_damage == '0'">No</span>
						<span v-if="readImo1.top_damage == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Underside</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.underside_damage == '1'">Yes</span>
						<span v-if="readImo1.underside_damage == '0'">No</span>
						<span v-if="readImo1.underside_damage == '-1'">NA</span>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="clear text-center mb-2">GENERAL APPEARANCE - INDICATE IF:</div>
				<div class="row mb-2 border-bottom">
					<div class="col-8">&nbsp;</div>
					<div class="col-3 text-center fw-bold">YES/NO</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Exterior Wash Needed</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.exterior_wash_needed == '1'">Yes</span>
						<span v-if="readImo1.exterior_wash_needed == '0'">No</span>
						<span v-if="readImo1.exterior_wash_needed == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Frame is Rusty</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.rusty_frame == '1'">Yes</span>
						<span v-if="readImo1.rusty_frame == '0'">No</span>
						<span v-if="readImo1.rusty_frame == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Cladding is Patchy</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.patchy_cladding == '1'">Yes</span>
						<span v-if="readImo1.patchy_cladding == '0'">No</span>
						<span v-if="readImo1.patchy_cladding == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Product Spills (Stains)</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.product_spills == '1'">Yes</span>
						<span v-if="readImo1.product_spills == '0'">No</span>
						<span v-if="readImo1.product_spills == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Logo to Renew</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.renew_logo == '1'">Yes</span>
						<span v-if="readImo1.renew_logo == '0'">No</span>
						<span v-if="readImo1.renew_logo == '-1'">NA</span>
					</div>
				</div>
				<div class="row mb-2 align-items-center border-bottom">
					<div class="col-8">
						<label class="form-label fw-bold m-0">Previous Haz Labels</label>
					</div>
					<div class="col-3 px-1 text-center">
						<span v-if="readImo1.previous_haz == '1'">Yes</span>
						<span v-if="readImo1.previous_haz == '0'">No</span>
						<span v-if="readImo1.previous_haz == '-1'">NA</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-6">
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">1.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Ladder</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.ladder_nos">{{ readImo1.ladder_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.ladder_cond_status?.title">{{ readImo1.ladder_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">2.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Document Box</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.document_box_nos">{{ readImo1.document_box_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.document_box_cond_status?.title">{{ readImo1.document_box_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">3.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Temperature Gauge</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.temperature_gauge_nos">{{ readImo1.temperature_gauge_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.temperature_gauge_cond_status?.title">{{ readImo1.temperature_gauge_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">4.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Steam Pipe & Caps</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.steam_nos">{{ readImo1.steam_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.steam_cond_status?.title">{{ readImo1.steam_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">5.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Steam Pressure Relief Valve</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.steam_pressure_nos">{{ readImo1.steam_pressure_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.steam_pressure_cond_status?.title">{{ readImo1.steam_pressure_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">6.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Remote Control System</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.remote_system_nos">{{ readImo1.remote_system_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.remote_system_cond_status?.title">{{ readImo1.remote_system_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">7.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Electrical Heating</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.electrical_heating_nos">{{ readImo1.electrical_heating_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.electrical_heating_cond_status?.title">{{ readImo1.electrical_heating_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">8.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Manlid</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.manlid_nos">{{ readImo1.manlid_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.manlid_cond_status?.title">{{ readImo1.manlid_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">8a.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Manlid Swing Bolts</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.manlid_swing_nos">{{ readImo1.manlid_swing_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.manlid_swing_cond_status?.title">{{ readImo1.manlid_swing_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">9.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Inspection Hatch</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.insp_hatch_nos">{{ readImo1.insp_hatch_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.insp_hatch_cond_status?.title">{{ readImo1.insp_hatch_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">9a.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Inspection Hatch Swing Bolts</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.insp_hatch_swing_bolt_no">{{ readImo1.insp_hatch_swing_bolt_no }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.insp_hatch_swing_bolt_cond_status?.title">{{ readImo1.insp_hatch_swing_bolt_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">10.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Spill Box Covers</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.spill_box_nos">{{ readImo1.spill_box_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.spill_box_cond_status?.title">{{ readImo1.spill_box_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">11.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Pre/Vac Valves</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.pre_valve_nos">{{ readImo1.pre_valve_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.pre_valve_cond_status?.title">{{ readImo1.pre_valve_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">12.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Pre/Vac Bursting Disc</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.pre_bursting_disc_nos">{{ readImo1.pre_bursting_disc_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.pre_bursting_disc_cond_status?.title">{{ readImo1.pre_bursting_disc_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">13.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">WalkyWay (Long Section)</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.walkyway_ls_nos">{{ readImo1.walkyway_ls_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.walkyway_ls_cond_status?.title">{{ readImo1.walkyway_ls_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">14.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">WalkyWay (Short Cross Section)</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.walkyway_scs_nos">{{ readImo1.walkyway_scs_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.walkyway_scs_cond_status?.title">{{ readImo1.walkyway_scs_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">14a.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">WalkyWay (Mid length Section)</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.walkyway_mls_nos">{{ readImo1.walkyway_mls_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.walkyway_mls_cond_status?.title">{{ readImo1.walkyway_mls_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
			</div>
			<div class="col-6">
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">15.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Airline Valve</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.airline_valve_nos">{{ readImo1.airline_valve_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.airline_valve_cond_status?.title">{{ readImo1.airline_valve_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">16.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Tank Pressure Gauge</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.tank_gauge_nos">{{ readImo1.tank_gauge_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.tank_gauge_cond_status?.title">{{ readImo1.tank_gauge_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">17.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Dip-Stick</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.dipstick_nos">{{ readImo1.dipstick_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.dipstick_cond_status?.title">{{ readImo1.dipstick_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">18.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Calibration Chart</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.calibration_chart_nos">{{ readImo1.calibration_chart_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.calibration_chart_cond_status?.title">{{ readImo1.calibration_chart_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">19.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Syphon Pipe(Dip-Tube)Top Fill</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.syphon_pipe_nos">{{ readImo1.syphon_pipe_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.syphon_pipe_cond_status?.title">{{ readImo1.syphon_pipe_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">20.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">B/FLY Valve (Clamp/Flange)</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.b_fly_valve_nos">{{ readImo1.b_fly_valve_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.bfly_valve_cond_status?.title">{{ readImo1.bfly_valve_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">21.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Blank Flange, Top Fill (BOLTS) No.</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.blank_flange_nos">{{ readImo1.blank_flange_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.blank_flange_cond_status?.title">{{ readImo1.blank_flange_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">22.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Top Vapour B/Fly Valve (Clamp Flange)</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.top_vapour_nos">{{ readImo1.top_vapour_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.top_vapour_cond_status?.title">{{ readImo1.top_vapour_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">23.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Top Vapour Blank Flange (Bolts) No.</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.top_vapour_bolts_nos">{{ readImo1.top_vapour_bolts_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.top_vapour_bolts_cond_status?.title">{{ readImo1.top_vapour_bolts_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">24.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Flanged Provision</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.flanged_provision_nos">{{ readImo1.flanged_provision_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.flanged_provision_cond_status?.title">{{ readImo1.flanged_provision_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">25.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Bottom Foot Valve</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.bottom_foot_nos">{{ readImo1.bottom_foot_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.bottom_foot_cond_status?.title">{{ readImo1.bottom_foot_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">26.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Bottom B/Fly</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.bottom_bfly_nos">{{ readImo1.bottom_bfly_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.bottom_bfly_cond_status?.title">{{ readImo1.bottom_bfly_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">27.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Bottom Outlet Flange</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.bottom_outlet_flange_nos">{{ readImo1.bottom_outlet_flange_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.bottom_outlet_flange_cond_status?.title">{{ readImo1.bottom_outlet_flange_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">28.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Bottom Valve Handle</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.bottom_valve_handle_nos">{{ readImo1.bottom_valve_handle_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.bottom_valve_handle_cond_status?.title">{{ readImo1.bottom_valve_handle_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">29.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Bottom B/Fly/Ball Valve Handle</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.bottom_bfly_ball_nos">{{ readImo1.bottom_bfly_ball_nos }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.bottom_bfly_ball_cond_status?.title">{{ readImo1.bottom_bfly_ball_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">30.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Fusible Link</label></div>
						<div>Nos:</div>
					</div>
					<div class="col-2">
						<span v-if="readImo1.fusible_link_no">{{ readImo1.fusible_link_no }}</span>
						<span v-else><i>-</i></span>
					</div>
					<div class="col-3">
						<span v-if="readImo1.fusible_link_cond_status?.title">{{ readImo1.fusible_link_cond_status?.title }}</span>
						<span v-else><i>-</i></span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">31.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">Camera</label></div>
					</div>
					<div class="col-2">&nbsp;</div>
					<div class="col-3">
						<span v-if="readImo1.camera == '1'">Yes</span>
						<span v-if="readImo1.camera == '0'">No</span>
					</div>
				</div>
				<!--  -->
				<div class="row mb-1">
					<div class="col-7 d-flex align-items-center">
						<div class="number">32.</div>
						<div class="flex-grow-1"><label class="form-label fw-bold m-0">GPS</label></div>
					</div>
					<div class="col-2">&nbsp;</div>
					<div class="col-3">
						<span v-if="readImo1.gps == '1'">Yes</span>
						<span v-if="readImo1.gps == '0'">No</span>
					</div>
				</div>
				<!--  -->
			</div>
		</div>
		<!-- Till here -->
		<div class="row mb-4">
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Walkway Image</label>
			</div>
			<div class="col-3" v-if="readImo1.walkway_image && readImo1.walkway_image.length > 0">
				<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#mdlWalkwayImage">View</button>
			</div>
			<div class="col-3" v-else>
				<i>No image uploaded</i>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-3">
				<label class="form-label text-uppercase fw-bold m-0">Last Test Date</label>
				<div>
					<span v-if="readImo1.last_test_date">{{ readImo1.last_test_date }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3">
				<label class="form-label text-uppercase fw-bold m-0">Tare Weight</label>
				<div>
					<span v-if="readImo1.tare_wt">{{ readImo1.tare_wt }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3">
				<label class="form-label text-uppercase fw-bold m-0">Capacity</label>
				<div>
					<span v-if="readImo1.capacity">{{ readImo1.capacity }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3">
				<label class="form-label text-uppercase fw-bold m-0">MGW</label>
				<div>
					<span v-if="readImo1.mgw">{{ readImo1.mgw }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-6">
				<label class="form-label text-uppercase fw-bold m-0">Comments</label>
				<div>
					<span v-if="readImo1.comments">{{ readImo1.comments }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-3">
				<label class="form-label text-uppercase fw-bold m-0">Created By</label>
				<div>
					<span v-if="readImo1.creator?.name">{{ readImo1.creator?.name }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="mdlWalkwayImage" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="mdlWalkwayImageTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
			role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="mdlWalkwayImageTitle">View Walkway Image</h5>
				</div>
				<div class="modal-body">
					<img :src="docRoot+'/imo1/view-file/' + readImo1.id +'/'+imageId" class="img-fluid"/>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		name: "ViewIMO1Master",
		props: ["current_user_id", "all_permissions", "id"],
		data() {
			return {
				currentUser: siteUserObject,
				readImo1: {},
				imageId: null
			};
		},
		methods: {
			reloadEverything() {
				if (this.id !== undefined && !isNaN(this.id)) {
					var that = this;
					var URL = this.docRoot + "/api/imo1/get-record/" + this.id;
					this.showLoading("Loading ...");
					axios
						.post(URL, {})
						.then(function (response) {
							that.closeSwal();
							that.readImo1 = Object.assign({}, response.data);
						})
						.catch(function (error) {
							console.log(error);
						});
				}
			},
		},
		async mounted() {
			this.reloadEverything();
			this.imageId = Math.round(Math.random() * 100);
		}
	};
</script>
