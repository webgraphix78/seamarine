<template>
	<div id="depotconditionsurvey-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_depotconditionsurvey_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/depotconditionsurvey'" role="button"><i class="ph ph-arrow-left "></i>Back to list</a>
					<h4 class="m-0 text-capitalize">Add depot condition survey</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label for="add_depotconditionsurvey_tank_no" class="form-label text-uppercase fw-bold me-3">Tank No <span class="text-danger">*</span></label>
				<div class="input-group">
					<MaskInput v-model="depotconditionsurveyFormObj.tank_no" mask="AAAA-######-#" class="form-control" :readonly="tankNoVerified" textmode="uppercase"/>
					<span class="input-group-text" :class="tankNoVerified ? 'bg-success' : 'bg-danger'">
						<i class="ph ph-check text-white" v-if="tankNoVerified"></i>
						<i class="ph ph-x text-white" v-if="!tankNoVerified"></i>
					</span>
				</div>
				<template v-for="error of v$.depotconditionsurveyFormObj.tank_no.$errors" :key="error.$uid">
					<div class="mandatory mb-1">{{ error.$message }}</div>
				</template>
				<div class="col-md-4 mt-2" v-if="!tankNoVerified">
					<button type="button" class="btn btn-dark btn-sm" @click="verifyTankNumber()">VERIFY TANK NUMBER</button>
				</div>
				<div class="col-md-6 py-2" v-if="depotconditionsurveyFormObj.id == 0 && tankNoVerified">
					<label for="">Tank last used: <span v-if="lastThree && lastThree.length > 0">On {{  lastThree.join(", ") }}</span><span v-else>Never</span></label>
				</div>
			</div>
		</div>
		<template v-if="tankNoVerified">
			<div class='row mb-4'>
				<div class="col">
					<label for="add_depotconditionsurvey_ref_no" class="form-label text-uppercase fw-bold me-3">Ref No</label>
					<div class="input-group">
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.ref_no" id="add_depotconditionsurvey_ref_no" placeholder="Enter Ref No" disabled>
					</div>
				</div>
				<div class="col">
					<label for="add_depotconditionsurvey_company_id" class="form-label text-uppercase fw-bold me-3">Company Id</label>
					<div>
						<multiselect v-model="depotconditionsurveyFormObj.company_id" :options="allCompanyIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_depotconditionsurvey_inspection_date" class="form-label text-uppercase fw-bold me-3">Inspection Date</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.inspection_date" id="add_depotconditionsurvey_inspection_date" placeholder="Enter Inspection Date" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_depotconditionsurvey_mfg_sr_no" class="form-label text-uppercase fw-bold me-3">Mfg Sr No</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.mfg_sr_no" id="add_depotconditionsurvey_mfg_sr_no" placeholder="Enter Mfg Sr No" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_depotconditionsurvey_last_test_date" class="form-label text-uppercase fw-bold me-3">Last Test Date</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.last_test_date" id="add_depotconditionsurvey_last_test_date" placeholder="Enter Last Test Date" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_depotconditionsurvey_customer_id" class="form-label text-uppercase fw-bold me-3">Client Name</label>
					<div>
						<multiselect v-model="depotconditionsurveyFormObj.customer_id" :options="allCustomerIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					
				</div>
				<div class="col">
					<label for="add_depotconditionsurvey_mgw" class="form-label text-uppercase fw-bold me-3">Mgw</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.mgw" id="add_depotconditionsurvey_mgw" placeholder="Enter Mgw" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_depotconditionsurvey_tare_wt" class="form-label text-uppercase fw-bold me-3">Tare Wt</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.tare_wt" id="add_depotconditionsurvey_tare_wt" placeholder="Enter Tare Wt" >
						
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_depotconditionsurvey_iso_type" class="form-label text-uppercase fw-bold me-3">Iso Type</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.iso_type" id="add_depotconditionsurvey_iso_type" placeholder="Enter Iso Type" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_depotconditionsurvey_capacity" class="form-label text-uppercase fw-bold me-3">Capacity</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.capacity" id="add_depotconditionsurvey_capacity" placeholder="Enter Capacity" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_depotconditionsurvey_inspection_location_id" class="form-label text-uppercase fw-bold me-3">Inspection Location</label>
					<div>
						<multiselect v-model="depotconditionsurveyFormObj.inspection_location_id" :options="allInspectionLocationIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_depotconditionsurvey_date_of_mfg" class="form-label text-uppercase fw-bold me-3">Date Of Mfg</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.date_of_mfg" id="add_depotconditionsurvey_date_of_mfg" placeholder="Enter Date Of Mfg" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_depotconditionsurvey_mfg" class="form-label text-uppercase fw-bold me-3">Mfg</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.mfg" id="add_depotconditionsurvey_mfg" placeholder="Enter Mfg" >
						
					</div>
					
				</div>
				<div class="col">
					<label for="add_depotconditionsurvey_next_inspection_date" class="form-label text-uppercase fw-bold me-3">Next Inspection Date</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.next_inspection_date" id="add_depotconditionsurvey_next_inspection_date" placeholder="Enter Next Inspection Date" >
						
					</div>
					
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-6">
					<div class='row g-3'>
						<div class="col-12">
							<label for="add_depotconditionsurvey_protection_cover" class="form-label text-uppercase fw-bold me-3">Protection Cover</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.protection_cover" :options="allProtectionCoverList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_manhole_cover_fastening_bolts" class="form-label text-uppercase fw-bold me-3">MANHOLE-PROTECTION COVER-FASTENING BOLTS</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.manhole_cover_fastening_bolts" :options="allManholeCoverFasteningBoltsList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_top_safety_valve_sr_no" class="form-label text-uppercase fw-bold me-3">Top Safety Valve Sr No</label>
							<div class="input-group">
								
								<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.top_safety_valve_sr_no" id="add_depotconditionsurvey_top_safety_valve_sr_no" placeholder="Enter Top Safety Valve Sr No" >
								
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_top_safety_valve" class="form-label text-uppercase fw-bold me-3">Top Safety Valve</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.top_safety_valve" :options="allTopSafetyValveList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_rupture_disc_series" class="form-label text-uppercase fw-bold me-3">RUPTURE DISC (UNDER #3 WHEN IN SERIES)</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.rupture_disc_series" :options="allRuptureDiscSeriesList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_dipping_pipe" class="form-label text-uppercase fw-bold me-3">Dipping Pipe</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.dipping_pipe" :options="allDippingPipeList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<div class="d-flex flex-row gap-2 align-items-center mb-2">
								<label for="add_depotconditionsurvey_air_valve" class="form-label text-uppercase fw-bold m-0">Label:</label>
								<multiselect v-model="depotconditionsurveyFormObj.air_valve_label" :options="allAirValveLabelList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.air_valve" :options="allAirValveList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_dipstick" class="form-label text-uppercase fw-bold me-3">Dipstick</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.dipstick" :options="allDipstickList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_manhole_gasket_type" class="form-label text-uppercase fw-bold me-3">Manhole Gasket Type</label>
							<div class="input-group">
								
								<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.manhole_gasket_type" id="add_depotconditionsurvey_manhole_gasket_type" placeholder="Enter Manhole Gasket Type" >
								
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_manhole_gasket" class="form-label text-uppercase fw-bold me-3">Manhole Gasket</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.manhole_gasket" :options="allManholeGasketList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_walkway" class="form-label text-uppercase fw-bold me-3">Walkway</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.walkway" :options="allWalkwayList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<div class="d-flex flex-row gap-2 align-items-center mb-2">
								<label for="add_depotconditionsurvey_top_loading" class="form-label text-uppercase fw-bold m-0">Label:</label>
								<multiselect v-model="depotconditionsurveyFormObj.top_loading_label" :options="allTopLoadingLabelList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							<div class="input-group">
								<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.top_loading" id="add_depotconditionsurvey_top_loading" placeholder="Enter Top Loading" >
							</div>
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_top_loading_flange" class="form-label text-uppercase fw-bold me-3">Top Loading Flange</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.top_loading_flange" :options="allTopLoadingFlangeList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class='row g-3'>
						<div class="col-12">
							<label for="add_depotconditionsurvey_heating_plug_pipe" class="form-label text-uppercase fw-bold me-3">INLET/OUTLET HEATING PLUG/PIPE</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.heating_plug_pipe" :options="allHeatingPlugPipeList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_heating_pipe_covers" class="form-label text-uppercase fw-bold me-3">INLET/OUTLET HEATING PIPE COVERS</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.heating_pipe_covers" :options="allHeatingPipeCoversList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_bottom_outlet_valve" class="form-label text-uppercase fw-bold me-3">Bottom Outlet Valve</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.bottom_outlet_valve" :options="allBottomOutletValveList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_bottom_valve_cap" class="form-label text-uppercase fw-bold me-3">BOTTOM OUTLET VALVE CAP/BLANK FLANGE</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.bottom_valve_cap" :options="allBottomValveCapList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_bottom_valve_bolts_nuts" class="form-label text-uppercase fw-bold me-3">BOTTOM OUTLET VALVE CAP BOLTS & NUTS</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.bottom_valve_bolts_nuts" :options="allBottomValveBoltsNutsList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_bottom_valve_lever" class="form-label text-uppercase fw-bold me-3">BOTTOM OUTLET VALVE LEVER</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.bottom_valve_lever" :options="allBottomValveLeverList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_ladder" class="form-label text-uppercase fw-bold me-3">Ladder</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.ladder" :options="allLadderList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_document_box" class="form-label text-uppercase fw-bold me-3">Document Box</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.document_box" :options="allDocumentBoxList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_thermometer_temp" class="form-label text-uppercase fw-bold me-3">Thermometer Temp</label>
							<div class="input-group">
								
								<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.thermometer_temp" id="add_depotconditionsurvey_thermometer_temp" placeholder="Enter Thermometer Temp" >
								
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_thermometer" class="form-label text-uppercase fw-bold me-3">Thermometer</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.thermometer" :options="allThermometerList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_remote_shut_off" class="form-label text-uppercase fw-bold me-3">Remote Shut Off</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.remote_shut_off" :options="allRemoteShutOffList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_hand_rail" class="form-label text-uppercase fw-bold me-3">Hand Rail</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.hand_rail" :options="allHandRailList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-6 mb-4 mb-md-0">
					<div class='row g-3'>
						<div class="col-12">
							<h5 class="text-uppercase mb-0 fw-semibold">INTERIOR CONDITION:</h5>
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_rust" class="form-label text-uppercase fw-bold me-3">RUST [SURFACE/SCRATCHES]</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.rust" :options="allRustList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_discolouration" class="form-label text-uppercase fw-bold me-3">Discolouration</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.discolouration" :options="allDiscolourationList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_surface_scoring" class="form-label text-uppercase fw-bold me-3">SURFACE SCORING/GOUGE</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.surface_scoring" :options="allSurfaceScoringList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_pitting_surface_pin" class="form-label text-uppercase fw-bold me-3">PITTING/SURFACE/PIN HOLES</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.pitting_surface_pin" :options="allPittingSurfacePinList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_corrosion_mark" class="form-label text-uppercase fw-bold me-3">Corrosion Mark</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.corrosion_mark" :options="allCorrosionMarkList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-12">
							<label for="add_depotconditionsurvey_others" class="form-label text-uppercase fw-bold me-3">Others</label>
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.others" :options="allOthersList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
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
					<div class="row mb-4">
						<div class="col-md-6">
						</div>
						<div class="col-md-3 col-6">
							<h5 class="mb-0 text-uppercase">framework</h5>
						</div>
						<div class="col-md-3 col-6">
							<h5 class="mb-0 text-uppercase">Cladding</h5>
						</div>
					</div>					
					<div class='row mb-4'>
						<div class="col-md-6">
							<h5 class="mb-0 text-uppercase">Front end</h5>
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_framework_front_end" class="form-label text-uppercase fw-bold me-3">Framework Front End</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.framework_front_end" :options="allFrameworkFrontEndList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_cladding_front_end" class="form-label text-uppercase fw-bold me-3">Cladding Front End</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.cladding_front_end" :options="allCladdingFrontEndList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
					</div>
					<div class='row mb-4'>
						<div class="col-md-6">
							<h5 class="mb-0 text-uppercase">Rare end</h5>
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_framework_rare_end" class="form-label text-uppercase fw-bold me-3">Framework Rare End</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.framework_rare_end" :options="allFrameworkRareEndList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_cladding_rare_end" class="form-label text-uppercase fw-bold me-3">Cladding Rare End</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.cladding_rare_end" :options="allCladdingRareEndList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
					</div>
					<div class='row mb-4'>
						<div class="col-md-6">
							<h5 class="mb-0 text-uppercase">Right Side</h5>
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_framework_right_side" class="form-label text-uppercase fw-bold me-3">Framework Right Side</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.framework_right_side" :options="allFrameworkRightSideList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_cladding_right_side" class="form-label text-uppercase fw-bold me-3">Cladding Right Side</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.cladding_right_side" :options="allCladdingRightSideList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
					</div>
					<div class='row mb-4'>
						<div class="col-md-6">
							<h5 class="mb-0 text-uppercase">Left Side</h5>
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_framework_left_side" class="form-label text-uppercase fw-bold me-3">Framework Left Side</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.framework_left_side" :options="allFrameworkLeftSideList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_cladding_left_side" class="form-label text-uppercase fw-bold me-3">Cladding Left Side</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.cladding_left_side" :options="allCladdingLeftSideList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
					</div>
					<div class='row mb-4'>
						<div class="col-md-6">
							<h5 class="mb-0 text-uppercase">Top</h5>
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_framework_top" class="form-label text-uppercase fw-bold me-3">Framework Top</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.framework_top" :options="allFrameworkTopList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_cladding_top" class="form-label text-uppercase fw-bold me-3">Cladding Top</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.cladding_top" :options="allCladdingTopList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
					</div>
					<div class='row mb-4'>
						<div class="col-md-6">
							<h5 class="mb-0 text-uppercase">Bottom</h5>
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_framework_bottom" class="form-label text-uppercase fw-bold me-3">Framework Bottom</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.framework_bottom" :options="allFrameworkBottomList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
							
						</div>
						<div class="col-md-3 col-6">
							<!-- <label for="add_depotconditionsurvey_cladding_bottom" class="form-label text-uppercase fw-bold me-3">Cladding Bottom</label> -->
							<div class="d-flex flex-row gap-3">
								<multiselect v-model="depotconditionsurveyFormObj.cladding_bottom" :options="allCladdingBottomList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col-12">
					<label for="add_depotconditionsurvey_exterior_remarks" class="form-label text-uppercase fw-bold me-3">Exterior Remarks</label>
					<div>
						<textarea class="form-control" v-model="depotconditionsurveyFormObj.exterior_remarks" rows="3" id="add_depotconditionsurvey_exterior_remarks" placeholder="Enter Exterior Remarks"></textarea>
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col-md-4">
					<label for="add_depotconditionsurvey_liquid_tank_no" class="form-label text-uppercase fw-bold me-3">Liquid Tank No</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.liquid_tank_no" id="add_depotconditionsurvey_liquid_tank_no" placeholder="Enter Liquid Tank No" >
						
					</div>
					
				</div>
				<div class="col-md-4">
					<label for="add_depotconditionsurvey_liquid_inspection_date" class="form-label text-uppercase fw-bold me-3">Liquid Inspection Date</label>
					<div class="input-group">
						
						<input type="text" class="form-control"  v-model="depotconditionsurveyFormObj.liquid_inspection_date" id="add_depotconditionsurvey_liquid_inspection_date" placeholder="Enter Liquid Inspection Date" >
						
					</div>
					
				</div>
				<div class="col-md-4">
					<label for="add_depotconditionsurvey_liquid_inspection_location_id" class="form-label text-uppercase fw-bold me-3">Liquid Inspection Location Id</label>
					<div>
						<multiselect v-model="depotconditionsurveyFormObj.liquid_inspection_location_id" :options="allLiquidInspectionLocationIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-2 col-12  text-md-end px-1">
					<label for="add_company_name" class="form-label text-uppercase fw-bold me-3">Upload Walkway Image</label>
				</div>
				<div class="col-md-7">
					<div class="d-flex flex-row gap-3">
						<div class="mb-2" v-if="depotconditionsurveyFormObj.liquid_img && depotconditionsurveyFormObj.liquid_img.length > 5">
							<img :src="docRoot+'/depotconditionsurvey/view-file/' + depotconditionsurveyFormObj.id +'/123'" style="max-width: 200px" />
							<p class="my-2 p-0"><a href="javascript:void(0)" class="text-danger" @click="clearImage()">Clear image</a></p>
						</div>
						<div v-else>
							<input type="file" id="header_url" ref="header_url" @change="prepareUpload($event)" accept="image/*" />
							<div class="d-flex flex-row gap-3 align-items-center mb-2">
								<label for="header_url" class="bg-dark p-2 text-white rounded-2">
									<span v-if="document.file_name">Upload new image</span>
									<span v-else>Upload image</span>
								</label>
								<button typ="button" class="btn btn-outline-danger" v-if="document.contents && document.contents.length > 0" @click="cancelUpload()">Clear</button>
							</div>
							<p class="text-dark mb-0"><small>Maximum upload size is 2MB. Supported format is JPG, JPEG and PNG only.</small></p>
							<p class="text-dark mb-0"><small>Please ensure that the dimensions are correct.</small></p>
						</div>
					</div>
				</div>
				<div class="col-md-3" v-if="document.contents && document.contents.length > 0">
					<img :src="document.contents" class="img-fluid">
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_depotconditionsurvey_remarks" class="form-label text-uppercase fw-bold me-3">Remarks</label>
					<div>
						<textarea class="form-control" v-model="depotconditionsurveyFormObj.remarks" rows="3" id="add_depotconditionsurvey_remarks" placeholder="Enter Remarks"></textarea>
					</div>
					
				</div>
			</div>
			<div class='row mb-4'>
				<div class="col">
					<label for="add_depotconditionsurvey_surveyor_id" class="form-label text-uppercase fw-bold me-3">Surveyor Name</label>
					<div>
						<multiselect v-model="depotconditionsurveyFormObj.surveyor_id" :options="allSurveyorIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					
				</div>
			</div>
		</template>

		<div class="row justify-content-center" v-if="tankNoVerified">
			<div class="col-5">
				<a class="btn btn-success w-100" @click="saveDepotConditionSurvey()">Save</a>
			</div>
		</div>
	</div>
</template>
<script>
import { useVuelidate } from '@vuelidate/core';
import { required, minValue, alphaNum, numeric, email, requiredIf, minLength,maxLength, decimal, url } from '@vuelidate/validators';
function initialState(){
	return {
		id:0,
		tank_no:'',
		ref_no:'AUTOGENERATED',
		company_id:'',
		inspection_date:'',
		mfg_sr_no:'',
		last_test_date:'',
		customer_id:'',
		mgw:'',
		tare_wt:'',
		iso_type:'',
		capacity:'',
		inspection_location_id:'',
		date_of_mfg:'',
		mfg:'',
		next_inspection_date:'',
		protection_cover:'',
		manhole_cover_fastening_bolts:'',
		top_safety_valve_sr_no:'',
		top_safety_valve:'',
		rupture_disc_series:'',
		dipping_pipe:'',
		air_valve:'',
		air_valve_label:'',		
		dipstick:'',
		manhole_gasket_type:'',
		manhole_gasket:'',
		walkway:'',
		top_loading:'',
		top_loading_label:'',
		top_loading_flange:'',
		heating_plug_pipe:'',
		heating_pipe_covers:'',
		bottom_outlet_valve:'',
		bottom_valve_cap:'',
		bottom_valve_bolts_nuts:'',
		bottom_valve_lever:'',
		ladder:'',
		document_box:'',
		thermometer_temp:'',
		thermometer:'',
		remote_shut_off:'',
		hand_rail:'',
		rust:'',
		discolouration:'',
		surface_scoring:'',
		pitting_surface_pin:'',
		corrosion_mark:'',
		others:'',
		framework_front_end:'',
		cladding_front_end:'',
		framework_rare_end:'',
		cladding_rare_end:'',
		framework_right_side:'',
		cladding_right_side:'',
		framework_left_side:'',
		cladding_left_side:'',
		framework_top:'',
		cladding_top:'',
		framework_bottom:'',
		cladding_bottom:'',
		exterior_remarks:'',
		liquid_tank_no:'',
		liquid_inspection_date:'',
		liquid_inspection_location_id:'',
		liquid_img:'',
		remarks:'',
		surveyor_id:'',
		deleted_at:'',
		created_at:'',
		updated_at:'',

		reload: false,
		closed: false,
		action: ''
	};
}
function initialStateValidations() {
	return {
		tank_no: {  required,  },
	}
}
export default {
	name: "DepotConditionSurveymaster",
	props: ['current_user_id', 'all_permissions','id', 'isModal', 'depotconditionsurveyForAdd', 'reload', 'closed'],
	setup() {
		return {
			v$: useVuelidate()
		}
	},
	data(){
		return{
			addEditModal: null,
			currentUser: siteUserObject,
			document: {
				uploaded_file: null,
				contents: null,
				upload_state: 0,
				upload_progress: 0,
				file_name: ""
			},
			imageId: 0,
			allCompanyIdList: [],
			allCustomerIdList: [],
			allInspectionLocationIdList: [],
			allProtectionCoverList: [],
			allManholeCoverFasteningBoltsList: [],
			allTopSafetyValveList: [],
			allRuptureDiscSeriesList: [],
			allDippingPipeList: [],
			allAirValveList: [],
			allAirValveLabelList: [],
			allTopLoadingLabelList: [],
			allDipstickList: [],
			allManholeGasketList: [],
			allWalkwayList: [],
			allTopLoadingFlangeList: [],
			allHeatingPlugPipeList: [],
			allHeatingPipeCoversList: [],
			allBottomOutletValveList: [],
			allBottomValveCapList: [],
			allBottomValveBoltsNutsList: [],
			allBottomValveLeverList: [],
			allLadderList: [],
			allDocumentBoxList: [],
			allThermometerList: [],
			allRemoteShutOffList: [],
			allHandRailList: [],
			allRustList: [],
			allDiscolourationList: [],
			allSurfaceScoringList: [],
			allPittingSurfacePinList: [],
			allCorrosionMarkList: [],
			allOthersList: [],
			allFrameworkFrontEndList: [],
			allCladdingFrontEndList: [],
			allFrameworkRareEndList: [],
			allCladdingRareEndList: [],
			allFrameworkRightSideList: [],
			allCladdingRightSideList: [],
			allFrameworkLeftSideList: [],
			allCladdingLeftSideList: [],
			allFrameworkTopList: [],
			allCladdingTopList: [],
			allFrameworkBottomList: [],
			allCladdingBottomList: [],
			allLiquidInspectionLocationIdList: [],
			allSurveyorIdList: [],
			depotconditionsurveyFormObj: initialState(),
			tankNoVerified: false,
		}
	},
	validations() {
		return {
			depotconditionsurveyFormObj: initialStateValidations()
		};
	},
	methods: {
		canceladdedit(event){
			window.location = this.docRoot + '/depotconditionsurvey';
		},
		formatDate(date) {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
		async saveDepotConditionSurvey(event){
			var that = this;
			const result = await that.v$.$validate();
			if (!result) {
				that.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
				console.log(that.v$.$errors);
				return;
			}
			
			if( !that.depotconditionsurveyFormObj.action || that.depotconditionsurveyFormObj.action == "" )
				that.depotconditionsurveyFormObj.action = "details";
			that.depotconditionsurveyFormObj.created_by = that.current_user_id;
			
			if (  that.depotconditionsurveyFormObj.company_id != null && typeof that.depotconditionsurveyFormObj.company_id === 'object' && that.depotconditionsurveyFormObj.company_id.id) {
				that.depotconditionsurveyFormObj.company_id = that.depotconditionsurveyFormObj.company_id.id;
			}
			if (  that.depotconditionsurveyFormObj.customer_id != null && typeof that.depotconditionsurveyFormObj.customer_id === 'object' && that.depotconditionsurveyFormObj.customer_id.id) {
				that.depotconditionsurveyFormObj.customer_id = that.depotconditionsurveyFormObj.customer_id.id;
			}
			if (  that.depotconditionsurveyFormObj.inspection_location_id != null && typeof that.depotconditionsurveyFormObj.inspection_location_id === 'object' && that.depotconditionsurveyFormObj.inspection_location_id.id) {
				that.depotconditionsurveyFormObj.inspection_location_id = that.depotconditionsurveyFormObj.inspection_location_id.id;
			}
			if (  that.depotconditionsurveyFormObj.liquid_inspection_location_id != null && typeof that.depotconditionsurveyFormObj.liquid_inspection_location_id === 'object' && that.depotconditionsurveyFormObj.liquid_inspection_location_id.id) {
				that.depotconditionsurveyFormObj.liquid_inspection_location_id = that.depotconditionsurveyFormObj.liquid_inspection_location_id.id;
			}
			if ( that.depotconditionsurveyFormObj.surveyor_id != null && typeof that.depotconditionsurveyFormObj.surveyor_id === 'object' && that.depotconditionsurveyFormObj.surveyor_id.id) {
				that.depotconditionsurveyFormObj.surveyor_id = that.depotconditionsurveyFormObj.surveyor_id.id;
			}
			if (  that.depotconditionsurveyFormObj.protection_cover != null && typeof that.depotconditionsurveyFormObj.protection_cover === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.protection_cover).length > 0) {
				that.depotconditionsurveyFormObj.protection_cover = that.depotconditionsurveyFormObj.protection_cover.id;
			}

			if (  that.depotconditionsurveyFormObj.manhole_cover_fastening_bolts != null && typeof that.depotconditionsurveyFormObj.manhole_cover_fastening_bolts === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.manhole_cover_fastening_bolts).length > 0) {
				that.depotconditionsurveyFormObj.manhole_cover_fastening_bolts = that.depotconditionsurveyFormObj.manhole_cover_fastening_bolts.id;
			}

			if (  that.depotconditionsurveyFormObj.top_safety_valve != null &&  typeof that.depotconditionsurveyFormObj.top_safety_valve === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.top_safety_valve).length > 0) {
				that.depotconditionsurveyFormObj.top_safety_valve = that.depotconditionsurveyFormObj.top_safety_valve.id;
			}

			if (  that.depotconditionsurveyFormObj.rupture_disc_series != null &&  typeof that.depotconditionsurveyFormObj.rupture_disc_series === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.rupture_disc_series).length > 0) {
				that.depotconditionsurveyFormObj.rupture_disc_series = that.depotconditionsurveyFormObj.rupture_disc_series.id;
			}

			if (  that.depotconditionsurveyFormObj.dipping_pipe != null &&  typeof that.depotconditionsurveyFormObj.dipping_pipe === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.dipping_pipe).length > 0) {
				that.depotconditionsurveyFormObj.dipping_pipe = that.depotconditionsurveyFormObj.dipping_pipe.id;
			}

			if (  that.depotconditionsurveyFormObj.air_valve != null &&  typeof that.depotconditionsurveyFormObj.air_valve === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.air_valve).length > 0) {
				that.depotconditionsurveyFormObj.air_valve = that.depotconditionsurveyFormObj.air_valve.id;
			}

			if (  that.depotconditionsurveyFormObj.air_valve_label != null &&  typeof that.depotconditionsurveyFormObj.air_valve_label === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.air_valve_label).length > 0) {
				that.depotconditionsurveyFormObj.air_valve_label = that.depotconditionsurveyFormObj.air_valve_label.id;
			}

			if (  that.depotconditionsurveyFormObj.top_loading_label != null &&  typeof that.depotconditionsurveyFormObj.top_loading_label === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.top_loading_label).length > 0) {
				that.depotconditionsurveyFormObj.top_loading_label = that.depotconditionsurveyFormObj.top_loading_label.id;
			}

			if (  that.depotconditionsurveyFormObj.dipstick != null &&  typeof that.depotconditionsurveyFormObj.dipstick === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.dipstick).length > 0) {
				that.depotconditionsurveyFormObj.dipstick = that.depotconditionsurveyFormObj.dipstick.id;
			}

			if (  that.depotconditionsurveyFormObj.manhole_gasket != null &&  typeof that.depotconditionsurveyFormObj.manhole_gasket === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.manhole_gasket).length > 0) {
				that.depotconditionsurveyFormObj.manhole_gasket = that.depotconditionsurveyFormObj.manhole_gasket.id;
			}

			if (  that.depotconditionsurveyFormObj.walkway != null &&  typeof that.depotconditionsurveyFormObj.walkway === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.walkway).length > 0) {
				that.depotconditionsurveyFormObj.walkway = that.depotconditionsurveyFormObj.walkway.id;
			}

			if (  that.depotconditionsurveyFormObj.top_loading_flange != null &&  typeof that.depotconditionsurveyFormObj.top_loading_flange === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.top_loading_flange).length > 0) {
				that.depotconditionsurveyFormObj.top_loading_flange = that.depotconditionsurveyFormObj.top_loading_flange.id;
			}

			if (  that.depotconditionsurveyFormObj.heating_plug_pipe != null &&  typeof that.depotconditionsurveyFormObj.heating_plug_pipe === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.heating_plug_pipe).length > 0) {
				that.depotconditionsurveyFormObj.heating_plug_pipe = that.depotconditionsurveyFormObj.heating_plug_pipe.id;
			}

			if (  that.depotconditionsurveyFormObj.heating_pipe_covers != null &&  typeof that.depotconditionsurveyFormObj.heating_pipe_covers === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.heating_pipe_covers).length > 0) {
				that.depotconditionsurveyFormObj.heating_pipe_covers = that.depotconditionsurveyFormObj.heating_pipe_covers.id;
			}

			if (  that.depotconditionsurveyFormObj.bottom_outlet_valve != null &&  typeof that.depotconditionsurveyFormObj.bottom_outlet_valve === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.bottom_outlet_valve).length > 0) {
				that.depotconditionsurveyFormObj.bottom_outlet_valve = that.depotconditionsurveyFormObj.bottom_outlet_valve.id;
			}

			if (  that.depotconditionsurveyFormObj.bottom_valve_cap != null &&  typeof that.depotconditionsurveyFormObj.bottom_valve_cap === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.bottom_valve_cap).length > 0) {
				that.depotconditionsurveyFormObj.bottom_valve_cap = that.depotconditionsurveyFormObj.bottom_valve_cap.id;
			}

			if (  that.depotconditionsurveyFormObj.bottom_valve_bolts_nuts != null &&  typeof that.depotconditionsurveyFormObj.bottom_valve_bolts_nuts === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.bottom_valve_bolts_nuts).length > 0) {
				that.depotconditionsurveyFormObj.bottom_valve_bolts_nuts = that.depotconditionsurveyFormObj.bottom_valve_bolts_nuts.id;
			}

			if (  that.depotconditionsurveyFormObj.bottom_valve_lever != null &&  typeof that.depotconditionsurveyFormObj.bottom_valve_lever === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.bottom_valve_lever).length > 0) {
				that.depotconditionsurveyFormObj.bottom_valve_lever = that.depotconditionsurveyFormObj.bottom_valve_lever.id;
			}

			if (  that.depotconditionsurveyFormObj.ladder != null &&  typeof that.depotconditionsurveyFormObj.ladder === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.ladder).length > 0) {
				that.depotconditionsurveyFormObj.ladder = that.depotconditionsurveyFormObj.ladder.id;
			}

			if (  that.depotconditionsurveyFormObj.document_box != null &&  typeof that.depotconditionsurveyFormObj.document_box === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.document_box).length > 0) {
				that.depotconditionsurveyFormObj.document_box = that.depotconditionsurveyFormObj.document_box.id;
			}

			if (  that.depotconditionsurveyFormObj.thermometer != null &&  typeof that.depotconditionsurveyFormObj.thermometer === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.thermometer).length > 0) {
				that.depotconditionsurveyFormObj.thermometer = that.depotconditionsurveyFormObj.thermometer.id;
			}

			if ( that.depotconditionsurveyFormObj.remote_shut_off != null &&  typeof that.depotconditionsurveyFormObj.remote_shut_off === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.remote_shut_off).length > 0) {
				that.depotconditionsurveyFormObj.remote_shut_off = that.depotconditionsurveyFormObj.remote_shut_off.id;
			}

			if (  that.depotconditionsurveyFormObj.hand_rail != null &&  typeof that.depotconditionsurveyFormObj.hand_rail === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.hand_rail).length > 0) {
				that.depotconditionsurveyFormObj.hand_rail = that.depotconditionsurveyFormObj.hand_rail.id;
			}

			if (  that.depotconditionsurveyFormObj.rust != null &&  typeof that.depotconditionsurveyFormObj.rust === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.rust).length > 0) {
				that.depotconditionsurveyFormObj.rust = that.depotconditionsurveyFormObj.rust.id;
			}

			if (  that.depotconditionsurveyFormObj.discolouration != null &&  typeof that.depotconditionsurveyFormObj.discolouration === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.discolouration).length > 0) {
				that.depotconditionsurveyFormObj.discolouration = that.depotconditionsurveyFormObj.discolouration.id;
			}

			if (  that.depotconditionsurveyFormObj.surface_scoring != null &&  typeof that.depotconditionsurveyFormObj.surface_scoring === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.surface_scoring).length > 0) {
				that.depotconditionsurveyFormObj.surface_scoring = that.depotconditionsurveyFormObj.surface_scoring.id;
			}

			if (  that.depotconditionsurveyFormObj.pitting_surface_pin != null &&  typeof that.depotconditionsurveyFormObj.pitting_surface_pin === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.pitting_surface_pin).length > 0) {
				that.depotconditionsurveyFormObj.pitting_surface_pin = that.depotconditionsurveyFormObj.pitting_surface_pin.id;
			}

			if (  that.depotconditionsurveyFormObj.corrosion_mark != null &&  typeof that.depotconditionsurveyFormObj.corrosion_mark === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.corrosion_mark).length > 0) {
				that.depotconditionsurveyFormObj.corrosion_mark = that.depotconditionsurveyFormObj.corrosion_mark.id;
			}

			if (  that.depotconditionsurveyFormObj.others != null &&  typeof that.depotconditionsurveyFormObj.others === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.others).length > 0) {
				that.depotconditionsurveyFormObj.others = that.depotconditionsurveyFormObj.others.id;
			}

			if (  that.depotconditionsurveyFormObj.framework_front_end != null &&  typeof that.depotconditionsurveyFormObj.framework_front_end === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.framework_front_end).length > 0) {
				that.depotconditionsurveyFormObj.framework_front_end = that.depotconditionsurveyFormObj.framework_front_end.id;
			}

			if (  that.depotconditionsurveyFormObj.cladding_front_end != null &&  typeof that.depotconditionsurveyFormObj.cladding_front_end === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.cladding_front_end).length > 0) {
				that.depotconditionsurveyFormObj.cladding_front_end = that.depotconditionsurveyFormObj.cladding_front_end.id;
			}

			if (  that.depotconditionsurveyFormObj.framework_rare_end != null &&  typeof that.depotconditionsurveyFormObj.framework_rare_end === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.framework_rare_end).length > 0) {
				that.depotconditionsurveyFormObj.framework_rare_end = that.depotconditionsurveyFormObj.framework_rare_end.id;
			}

			if (  that.depotconditionsurveyFormObj.cladding_rare_end != null &&  typeof that.depotconditionsurveyFormObj.cladding_rare_end === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.cladding_rare_end).length > 0) {
				that.depotconditionsurveyFormObj.cladding_rare_end = that.depotconditionsurveyFormObj.cladding_rare_end.id;
			}

			if (  that.depotconditionsurveyFormObj.framework_right_side != null &&  typeof that.depotconditionsurveyFormObj.framework_right_side === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.framework_right_side).length > 0) {
				that.depotconditionsurveyFormObj.framework_right_side = that.depotconditionsurveyFormObj.framework_right_side.id;
			}

			if (  that.depotconditionsurveyFormObj.cladding_right_side != null &&  typeof that.depotconditionsurveyFormObj.cladding_right_side === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.cladding_right_side).length > 0) {
				that.depotconditionsurveyFormObj.cladding_right_side = that.depotconditionsurveyFormObj.cladding_right_side.id;
			}

			if (  that.depotconditionsurveyFormObj.framework_left_side != null &&  typeof that.depotconditionsurveyFormObj.framework_left_side === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.framework_left_side).length > 0) {
				that.depotconditionsurveyFormObj.framework_left_side = that.depotconditionsurveyFormObj.framework_left_side.id;
			}

			if (  that.depotconditionsurveyFormObj.cladding_left_side != null &&  typeof that.depotconditionsurveyFormObj.cladding_left_side === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.cladding_left_side).length > 0) {
				that.depotconditionsurveyFormObj.cladding_left_side = that.depotconditionsurveyFormObj.cladding_left_side.id;
			}

			if (  that.depotconditionsurveyFormObj.framework_top != null &&  typeof that.depotconditionsurveyFormObj.framework_top === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.framework_top).length > 0) {
				that.depotconditionsurveyFormObj.framework_top = that.depotconditionsurveyFormObj.framework_top.id;
			}

			if (  that.depotconditionsurveyFormObj.cladding_top != null &&  typeof that.depotconditionsurveyFormObj.cladding_top === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.cladding_top).length > 0) {
				that.depotconditionsurveyFormObj.cladding_top = that.depotconditionsurveyFormObj.cladding_top.id;
			}

			if (  that.depotconditionsurveyFormObj.framework_bottom != null &&  typeof that.depotconditionsurveyFormObj.framework_bottom === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.framework_bottom).length > 0) {
				that.depotconditionsurveyFormObj.framework_bottom = that.depotconditionsurveyFormObj.framework_bottom.id;
			}

			if (  that.depotconditionsurveyFormObj.cladding_bottom != null &&  typeof that.depotconditionsurveyFormObj.cladding_bottom === 'object' &&  Object.keys(that.depotconditionsurveyFormObj.cladding_bottom).length > 0) {
				that.depotconditionsurveyFormObj.cladding_bottom = that.depotconditionsurveyFormObj.cladding_bottom.id;
			}
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/depotconditionsurvey/save', { depotconditionsurvey: that.depotconditionsurveyFormObj }).then(async function (response) {
				that.closeSwal();
				var status = response.data.status;
				if( status == 1 ){
					// Set the ID so that duplicate records will not be created
					that.depotconditionsurveyFormObj.id = response.data.id;
					if ((that.document.uploaded_file == null || that.document.uploaded_file == undefined)) {
						that.showToast('DepotConditionSurvey saved successfully.', 'success', 'bottom', 3000);
						setTimeout(() => {
							window.location = that.docRoot + "/depotconditionsurvey/";
							that.showLoading("Loading ...");
						}, 1500);
					}else {
						that.handleUpload(response.data.id);
					}
				}
				else{
					that.showErrors("DepotConditionSurvey could not be saved successfully.", response.data.messages, "bottom", 3000);
				}
			})
			.catch(function (error) {
				console.log(error);
				that.closeSwal();
				that.showToast("DepotConditionSurvey could not be saved successfully.", "error", "bottom", 3000);
			});
		},
		verifyTankNumber() {
			var that = this;
			that.tankNoVerified = false;
			that.showLoading("Verifying ...");
			axios
				.post(that.docRoot + "/depotconditionsurvey/verify-tank-number", { tankNo: that.depotconditionsurveyFormObj.tank_no })
				.then(async function (response) {
					that.closeSwal();
					console.log(response);
					var status = response.data.status;
					if (status == 1){
						that.tankNoVerified = true;
						if (response.data.hasOwnProperty("lastthree") && response.data.lastthree.length > 0) {
							let arrLastThree = response.data.lastthree;
							that.lastThree = arrLastThree.filter((item, index) => arrLastThree.indexOf(item) === index);
						}
					}
					else {
						that.tankNoVerified = false;
						that.showErrors(response.data.message, "error", "bottom", 3000);
					}
				});
		},
		prepareUpload(event) {
			let file = event.target.files[0];
			if (file.size > 2 * 1024 * 1024) {
				this.showToast("File size cannot exceed 2MB", "error", "bottom", 3000);
				return;
			}
			if (file.type != "image/jpg" && file.type != "image/jpeg" && file.type != "image/png") {
				this.showToast("You can only upload JPG, JPEG and PNG images", "error", "bottom", 3000);
				return;
			}
			this.document.uploaded_file = file;
			this.document.upload_state = 0;
			this.document.upload_progress = 0;
			this.document.file_name = this.document.uploaded_file.name;
			const reader = new FileReader();
			reader.onload = ((e) => {
				this.document.contents = e.target.result;
			});
			reader.readAsDataURL(file);
		},
		cancelUpload() {
			this.document = {
				uploaded_file: null,
				contents: null,
				upload_state: 0,
				upload_progress: 0,
				file_name: ""
			};
		},
		handleUpload(id) {
			let that = this;
			const formData = new FormData();
			formData.append("depotconditionsurvey_id", id);
			formData.append("uploaded_file", this.document.uploaded_file);
			// Send the data
			let URL = this.docRoot + "/depotconditionsurvey/upload-file";
			axios
				.post(URL, formData, {
					headers: {
						"Content-Type": "multipart/form-data"
					},
					onUploadProgress: function (progressEvent) {
						that.document.upload_state = 1;
						that.document.upload_progress = parseInt(Math.round((progressEvent.loaded / progressEvent.total) * 100));
					}
				})
				.then(function (response) {
					that.document.upload_state = 2;
					that.document.upload_progress = 100;
					console.log(response);
					var status = response.data.status;
					if (status == 1) {
						that.showToast("Depot Condition Survey Condition Record saved successfully", "success", "bottom", 3000);
						that.imageId = Math.round(Math.random() * 100);
						setTimeout(() => {
							window.location = that.docRoot + "/depotconditionsurvey/";
							that.showLoading("Loading ...");
						}, 1500);
						// document.body.scrollTop = 0;
						// document.documentElement.scrollTop = 0;
						// that.reloadEverything();
					}
					else {
						that.showErrors("Depot Condition Survey Condition Record has been saved but the File could not be uploaded successfully", response.data.messages, "bottom", 5000);
					}
					return status;
				})
				.catch(function (error) {
					that.document.upload_progress = 0;
					that.document.upload_state = -1;
					console.log(error);
					that.closeSwal();
					that.showToast("File could not be uploaded successfully", "error", "bottom", 3000);
					return -1;
				});
		},
		clearImage() {
			let that = this;
			let URL = this.docRoot + "/depotconditionsurvey/clear-file/" + this.depotconditionsurveyFormObj.id + "/123";
			this.showConfirm("Do you really want to delete the file?", "Yes", "No").then((result) => {
				if (result.isConfirmed) {
					this.showLoading("Clearing file ...");
					axios
						.post(URL, {}, {
							headers: {
								"Content-Type": "multipart/form-data"
							}
						})
						.then(function (response) {
							that.closeSwal();
							var status = response.data.status;
							console.log(response);
							
							if (status == 1) {
								that.showToast("File cleared successfully", "success", "bottom", 3000);
								that.cancelUpload();
								that.depotconditionsurveyFormObj.liquid_img = null;
							}
							else {
								that.showErrors("File could not be cleared successfully", response.data.messages, "bottom", 5000);
							}
							return status;
						})
						.catch(function (error) {
							console.log(error);
							that.closeSwal();
							that.showToast("File could not be cleared successfully", "error", "bottom", 3000);
							return -1;
						});
				}
			});
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				this.mode = "edit";
				this.cancelUpload(1);
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/depotconditionsurvey/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.depotconditionsurveyFormObj = Object.assign({}, response.data);
					})
					.catch(function (error) {
						console.log(error);
					});
			}
		},
		
		displayLabelSetting ({id, text}) {
			return `${text}`;
		},
	},
	async mounted() {
		if (this.id > 0){
			this.reloadEverything();
		}
		this.imageId = Math.round(Math.random() * 100);

		let _allCompanyIdList = await this.loadAllCompany(this.docRoot+'/api/company/get', 'post', {});
		if(Array.isArray(_allCompanyIdList) && _allCompanyIdList.length > 0){
			this.allCompanyIdList = _allCompanyIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allCustomerIdList = await this.loadAllCustomer(this.docRoot+'/api/customer/get', 'post', {});
		if(Array.isArray(_allCustomerIdList) && _allCustomerIdList.length > 0){
			this.allCustomerIdList = _allCustomerIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/api/inspectionlocation/get', 'post', {});
		if(Array.isArray(_allInspectionLocationIdList) && _allInspectionLocationIdList.length > 0){
			this.allInspectionLocationIdList = _allInspectionLocationIdList.map(x => {return { id: x.id, text: x.name }});
		}
		this.allProtectionCoverList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
		this.allManholeCoverFasteningBoltsList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
		this.allTopSafetyValveList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
		this.allRuptureDiscSeriesList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
		this.allDippingPipeList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
		this.allAirValveList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, ];
		this.allAirValveLabelList = [{ id: '1', text: 'Airline Valve'}, { id: '0', text: 'Air Valve with Gauge'}, ];
		this.allTopLoadingLabelList = [{ id: '1', text: 'Top Loading'}, { id: '0', text: 'Top Discharge'}, ];
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
		let _allLiquidInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/api/inspectionlocation/get', 'post', {});
		if(Array.isArray(_allLiquidInspectionLocationIdList) && _allLiquidInspectionLocationIdList.length > 0){
			this.allLiquidInspectionLocationIdList = _allLiquidInspectionLocationIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/api/surveyor/get', 'post', {});
		if(Array.isArray(_allSurveyorIdList) && _allSurveyorIdList.length > 0){
			this.allSurveyorIdList = _allSurveyorIdList.map(x => {return { id: x.id, text: x.name }});
		}
		if (this.depotconditionsurveyFormObj.company_id) {
			if (Array.isArray(this.allCompanyIdList) && this.allCompanyIdList.length > 0) {
				let _allRelationList = this.allCompanyIdList;
				let relationId = parseInt(this.depotconditionsurveyFormObj.company_id);
				this.depotconditionsurveyFormObj.company_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.depotconditionsurveyFormObj.customer_id) {
			if (Array.isArray(this.allCustomerIdList) && this.allCustomerIdList.length > 0) {
				let _allRelationList = this.allCustomerIdList;
				let relationId = parseInt(this.depotconditionsurveyFormObj.customer_id);
				this.depotconditionsurveyFormObj.customer_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.depotconditionsurveyFormObj.inspection_location_id) {
			if (Array.isArray(this.allInspectionLocationIdList) && this.allInspectionLocationIdList.length > 0) {
				let _allRelationList = this.allInspectionLocationIdList;
				let relationId = parseInt(this.depotconditionsurveyFormObj.inspection_location_id);
				this.depotconditionsurveyFormObj.inspection_location_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.depotconditionsurveyFormObj.liquid_inspection_location_id) {
			if (Array.isArray(this.allLiquidInspectionLocationIdList) && this.allLiquidInspectionLocationIdList.length > 0) {
				let _allRelationList = this.allLiquidInspectionLocationIdList;
				let relationId = parseInt(this.depotconditionsurveyFormObj.liquid_inspection_location_id);
				this.depotconditionsurveyFormObj.liquid_inspection_location_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.depotconditionsurveyFormObj.surveyor_id) {
			if (Array.isArray(this.allSurveyorIdList) && this.allSurveyorIdList.length > 0) {
				let _allRelationList = this.allSurveyorIdList;
				let relationId = parseInt(this.depotconditionsurveyFormObj.surveyor_id);
				this.depotconditionsurveyFormObj.surveyor_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.depotconditionsurveyFormObj.protection_cover) {
			if (Array.isArray(this.allProtectionCoverList) && this.allProtectionCoverList.length > 0) {
				const selectedId = this.depotconditionsurveyFormObj.protection_cover;
				this.depotconditionsurveyFormObj.protection_cover = this.allProtectionCoverList.find(item => item.id === selectedId);
			}
		}
			if (this.depotconditionsurveyFormObj.manhole_cover_fastening_bolts) {
				if (Array.isArray(this.allManholeCoverFasteningBoltsList) && this.allManholeCoverFasteningBoltsList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.manhole_cover_fastening_bolts;
				this.depotconditionsurveyFormObj.manhole_cover_fastening_bolts = this.allManholeCoverFasteningBoltsList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.top_safety_valve) {

				if (Array.isArray(this.allTopSafetyValveList) && this.allTopSafetyValveList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.top_safety_valve;
				this.depotconditionsurveyFormObj.top_safety_valve = this.allTopSafetyValveList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.rupture_disc_series) {

				if (Array.isArray(this.allRuptureDiscSeriesList) && this.allRuptureDiscSeriesList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.rupture_disc_series;
				this.depotconditionsurveyFormObj.rupture_disc_series = this.allRuptureDiscSeriesList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.dipping_pipe) {
				if (Array.isArray(this.allDippingPipeList) && this.allDippingPipeList.length > 0) {
				const selectedId = this.depotconditionsurveyFormObj.dipping_pipe;
				this.depotconditionsurveyFormObj.dipping_pipe = this.allDippingPipeList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.air_valve) {
				if (Array.isArray(this.allAirValveList) && this.allAirValveList.length > 0) {
				const selectedId = this.depotconditionsurveyFormObj.air_valve;
				this.depotconditionsurveyFormObj.air_valve = this.allAirValveList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.air_valve_label) {
				if (Array.isArray(this.allAirValveLabelList) && this.allAirValveLabelList.length > 0) {
				const selectedId = this.depotconditionsurveyFormObj.air_valve_label;
				this.depotconditionsurveyFormObj.air_valve_label = this.allAirValveLabelList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.top_loading_label) {
				if (Array.isArray(this.allTopLoadingLabelList) && this.allTopLoadingLabelList.length > 0) {
				const selectedId = this.depotconditionsurveyFormObj.top_loading_label;
				this.depotconditionsurveyFormObj.top_loading_label = this.allTopLoadingLabelList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.dipstick) {
				if (Array.isArray(this.allDipstickList) && this.allDipstickList.length > 0) {
				const selectedId = this.depotconditionsurveyFormObj.dipstick;
				this.depotconditionsurveyFormObj.dipstick = this.allDipstickList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.manhole_gasket) {
				if (Array.isArray(this.allManholeGasketList) && this.allManholeGasketList.length > 0) {
				const selectedId = this.depotconditionsurveyFormObj.manhole_gasket;
				this.depotconditionsurveyFormObj.manhole_gasket = this.allManholeGasketList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.walkway) {
				if (Array.isArray(this.allWalkwayList) && this.allWalkwayList.length > 0) {
				const selectedId = this.depotconditionsurveyFormObj.walkway;
				this.depotconditionsurveyFormObj.walkway = this.allWalkwayList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.top_loading_flange) {
				if (Array.isArray(this.allTopLoadingFlangeList) && this.allTopLoadingFlangeList.length > 0) {
				const selectedId = this.depotconditionsurveyFormObj.top_loading_flange;
				this.depotconditionsurveyFormObj.top_loading_flange = this.allTopLoadingFlangeList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.heating_plug_pipe) {
				if (Array.isArray(this.allHeatingPlugPipeList) && this.allHeatingPlugPipeList.length > 0) {
				const selectedId = this.depotconditionsurveyFormObj.heating_plug_pipe;
				this.depotconditionsurveyFormObj.heating_plug_pipe = this.allHeatingPlugPipeList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.heating_pipe_covers) {

				if (Array.isArray(this.allHeatingPipeCoversList) && this.allHeatingPipeCoversList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.heating_pipe_covers;
				this.depotconditionsurveyFormObj.heating_pipe_covers = this.allHeatingPipeCoversList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.bottom_outlet_valve) {

				if (Array.isArray(this.allBottomOutletValveList) && this.allBottomOutletValveList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.bottom_outlet_valve;
				this.depotconditionsurveyFormObj.bottom_outlet_valve = this.allBottomOutletValveList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.bottom_valve_cap) {

				if (Array.isArray(this.allBottomValveCapList) && this.allBottomValveCapList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.bottom_valve_cap;
				this.depotconditionsurveyFormObj.bottom_valve_cap = this.allBottomValveCapList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.bottom_valve_bolts_nuts) {

				if (Array.isArray(this.allBottomValveBoltsNutsList) && this.allBottomValveBoltsNutsList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.bottom_valve_bolts_nuts;
				this.depotconditionsurveyFormObj.bottom_valve_bolts_nuts = this.allBottomValveBoltsNutsList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.bottom_valve_lever) {

				if (Array.isArray(this.allBottomValveLeverList) && this.allBottomValveLeverList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.bottom_valve_lever;
				this.depotconditionsurveyFormObj.bottom_valve_lever = this.allBottomValveLeverList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.ladder) {

				if (Array.isArray(this.allLadderList) && this.allLadderList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.ladder;
				this.depotconditionsurveyFormObj.ladder = this.allLadderList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.document_box) {

				if (Array.isArray(this.allDocumentBoxList) && this.allDocumentBoxList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.document_box;
				this.depotconditionsurveyFormObj.document_box = this.allDocumentBoxList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.thermometer) {

				if (Array.isArray(this.allThermometerList) && this.allThermometerList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.thermometer;
				this.depotconditionsurveyFormObj.thermometer = this.allThermometerList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.remote_shut_off) {

				if (Array.isArray(this.allRemoteShutOffList) && this.allRemoteShutOffList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.remote_shut_off;
				this.depotconditionsurveyFormObj.remote_shut_off = this.allRemoteShutOffList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.hand_rail) {

				if (Array.isArray(this.allHandRailList) && this.allHandRailList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.hand_rail;
				this.depotconditionsurveyFormObj.hand_rail = this.allHandRailList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.rust) {

				if (Array.isArray(this.allRustList) && this.allRustList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.rust;
				this.depotconditionsurveyFormObj.rust = this.allRustList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.discolouration) {

				if (Array.isArray(this.allDiscolourationList) && this.allDiscolourationList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.discolouration;
				this.depotconditionsurveyFormObj.discolouration = this.allDiscolourationList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.surface_scoring) {

				if (Array.isArray(this.allSurfaceScoringList) && this.allSurfaceScoringList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.surface_scoring;
				this.depotconditionsurveyFormObj.surface_scoring = this.allSurfaceScoringList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.pitting_surface_pin) {

				if (Array.isArray(this.allPittingSurfacePinList) && this.allPittingSurfacePinList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.pitting_surface_pin;
				this.depotconditionsurveyFormObj.pitting_surface_pin = this.allPittingSurfacePinList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.corrosion_mark) {

				if (Array.isArray(this.allCorrosionMarkList) && this.allCorrosionMarkList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.corrosion_mark;
				this.depotconditionsurveyFormObj.corrosion_mark = this.allCorrosionMarkList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.others) {

				if (Array.isArray(this.allOthersList) && this.allOthersList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.others;
				this.depotconditionsurveyFormObj.others = this.allOthersList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.framework_front_end) {

				if (Array.isArray(this.allFrameworkFrontEndList) && this.allFrameworkFrontEndList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.framework_front_end;
				this.depotconditionsurveyFormObj.framework_front_end = this.allFrameworkFrontEndList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.cladding_front_end) {

				if (Array.isArray(this.allCladdingFrontEndList) && this.allCladdingFrontEndList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.cladding_front_end;
				this.depotconditionsurveyFormObj.cladding_front_end = this.allCladdingFrontEndList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.framework_rare_end) {

				if (Array.isArray(this.allFrameworkRareEndList) && this.allFrameworkRareEndList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.framework_rare_end;
				this.depotconditionsurveyFormObj.framework_rare_end = this.allFrameworkRareEndList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.cladding_rare_end) {

				if (Array.isArray(this.allCladdingRareEndList) && this.allCladdingRareEndList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.cladding_rare_end;
				this.depotconditionsurveyFormObj.cladding_rare_end = this.allCladdingRareEndList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.framework_right_side) {

				if (Array.isArray(this.allFrameworkRightSideList) && this.allFrameworkRightSideList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.framework_right_side;
				this.depotconditionsurveyFormObj.framework_right_side = this.allFrameworkRightSideList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.cladding_right_side) {

				if (Array.isArray(this.allCladdingRightSideList) && this.allCladdingRightSideList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.cladding_right_side;
				this.depotconditionsurveyFormObj.cladding_right_side = this.allCladdingRightSideList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.framework_left_side) {

				if (Array.isArray(this.allFrameworkLeftSideList) && this.allFrameworkLeftSideList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.framework_left_side;
				this.depotconditionsurveyFormObj.framework_left_side = this.allFrameworkLeftSideList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.cladding_left_side) {

				if (Array.isArray(this.allCladdingLeftSideList) && this.allCladdingLeftSideList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.cladding_left_side;
				this.depotconditionsurveyFormObj.cladding_left_side = this.allCladdingLeftSideList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.framework_top) {

				if (Array.isArray(this.allFrameworkTopList) && this.allFrameworkTopList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.framework_top;
				this.depotconditionsurveyFormObj.framework_top = this.allFrameworkTopList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.cladding_top) {

				if (Array.isArray(this.allCladdingTopList) && this.allCladdingTopList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.cladding_top;
				this.depotconditionsurveyFormObj.cladding_top = this.allCladdingTopList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.framework_bottom) {

				if (Array.isArray(this.allFrameworkBottomList) && this.allFrameworkBottomList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.framework_bottom;
				this.depotconditionsurveyFormObj.framework_bottom = this.allFrameworkBottomList.find(item => item.id === selectedId);}
			}
			if (this.depotconditionsurveyFormObj.cladding_bottom) {

				if (Array.isArray(this.allCladdingBottomList) && this.allCladdingBottomList.length > 0) {

				const selectedId = this.depotconditionsurveyFormObj.cladding_bottom;
				this.depotconditionsurveyFormObj.cladding_bottom = this.allCladdingBottomList.find(item => item.id === selectedId);}
			}

	}
}
</script>
