<template>
	<div id="equipmentinspection-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_equipmentinspection_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/equipmentinspection'" role="button"><i class="ph ph-arrow-left "></i>Back to list</a>
					<!-- <h4 class="m-0 text-capitalize">Add equipmentinspection</h4> -->
				</div>
			</div>
		</div>
		<div class="row py-2 bg-dark mb-3">
			<h4 class="fw-bold text-white text-center m-0">Add Record in the System.</h4>
		</div>
		<!-- top setion -->
		<div class="row mb-4">
			<div class="col-md-6">
				<div class='row gy-2 align-items-center'>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_ref_no" class="form-label text-uppercase fw-bold m-0  ">Ref No</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.ref_no" id="add_equipmentinspection_ref_no" placeholder="Enter Ref No" disabled>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_company_id" class="form-label text-uppercase fw-bold m-0">Company Name</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.company_id" :options="allCompanyIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_inspection_date" class="form-label text-uppercase fw-bold m-0">Inspection Date</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.inspection_date" id="add_equipmentinspection_inspection_date" placeholder="Enter Inspection Date" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_tank_no" class="form-label text-uppercase fw-bold m-0">Tank Number</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.tank_no" id="add_equipmentinspection_tank_no" placeholder="Enter Tank Number" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_last_cargo_carried" class="form-label text-uppercase fw-bold m-0">Last Cargo Carried:</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.last_cargo_carried" id="add_equipmentinspection_last_cargo_carried" placeholder="Enter Last Cargo Carried" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_empty_clean" class="form-label text-uppercase fw-bold m-0">Empty Clean</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.empty_clean" :options="allEmptyCleanList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_empty_dirty" class="form-label text-uppercase fw-bold m-0">Empty Dirty</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.empty_dirty" :options="allEmptyDirtyList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_loaded" class="form-label text-uppercase fw-bold m-0">Loaded</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.loaded" :options="allLoadedList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_surveyor_id" class="form-label text-uppercase fw-bold m-0">Surveyor</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.surveyor_id" :options="allSurveyorIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_hazard_class" class="form-label text-uppercase fw-bold m-0">Hazard Class</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.hazard_class" id="add_equipmentinspection_hazard_class" placeholder="Enter Hazard Class" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_eq_inspection_status" class="form-label text-uppercase fw-bold m-0">Status</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.eq_inspection_status" :options="allEqInspectionStatusList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_last_test_date" class="form-label text-uppercase fw-bold m-0">Last Test Date</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.last_test_date" id="add_equipmentinspection_last_test_date" placeholder="Enter Last Test Date" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_capacity" class="form-label text-uppercase fw-bold m-0">Capacity</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.capacity" id="add_equipmentinspection_capacity" placeholder="Enter Capacity" >
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class='row gy-2 align-items-center'>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_equipment_type" class="form-label text-uppercase fw-bold m-0">Equipment Type</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.equipment_type" :options="allEquipmentTypeList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_csc" class="form-label text-uppercase fw-bold m-0">C.S.C.</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.csc" id="add_equipmentinspection_csc" placeholder="Enter C.S.C" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_loaded_at" class="form-label text-uppercase fw-bold m-0">Loaded At</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.loaded_at" id="add_equipmentinspection_loaded_at" placeholder="Enter Loaded At" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_tank_type" class="form-label text-uppercase fw-bold m-0">Tank Type</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.tank_type" :options="allTankTypeList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_mfg_date" class="form-label text-uppercase fw-bold m-0">Mfgt. Date</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.mfg_date" id="add_equipmentinspection_mfg_date" placeholder="Enter Mfgt. Date" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_cfs" class="form-label text-uppercase fw-bold m-0">CFS</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.cfs" :options="allCfsList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_for_id" class="form-label text-uppercase fw-bold m-0">For</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.for_id" :options="allForIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_next_date" class="form-label text-uppercase fw-bold m-0">Next Date.</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.next_date" id="add_equipmentinspection_next_date" placeholder="Enter Next Date" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_country" class="form-label text-uppercase fw-bold m-0">Country</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.country" id="add_equipmentinspection_country" placeholder="Enter Country" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_inspection_location_id" class="form-label text-uppercase fw-bold m-0">Inspection Location</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.inspection_location_id" :options="allInspectionLocationIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_customer_id" class="form-label text-uppercase fw-bold m-0">Customer</label>
					</div>
					<div class="col-md-8">
						<multiselect v-model="equipmentinspectionFormObj.customer_id" :options="allCustomerIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_cha_client" class="form-label text-uppercase fw-bold m-0">CHA Client</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.cha_client" id="add_equipmentinspection_cha_client" placeholder="Enter CHA Client" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_tare_weight" class="form-label text-uppercase fw-bold m-0">Tare Weight</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.tare_weight" id="add_equipmentinspection_tare_weight" placeholder="Enter Tare Weight" >
					</div>
					<div class="col-md-4 mt-3 mt-md-0">
						<label for="add_equipmentinspection_mgw" class="form-label text-uppercase fw-bold m-0">MGW</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.mgw" id="add_equipmentinspection_mgw" placeholder="Enter MGW" >
					</div>
				</div>
			</div>
		</div>
		<!-- top setion -->
		<div class="row mb-3 d-none d-md-flex">
			<div class="col-1"> S.No.</div>
			<div class="col-2">Fitting</div>
			<div class="col-2">TIR</div>
			<div class="col-3">Seal</div>
			<div class="col-4">Comments</div>
		</div>
		<!-- Bottom Discharge -->
		<div class='row mb-2 align-items-center'>
			<div class="col-1 d-none d-md-block">01</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label text-uppercase fw-bold d-none d-md-block m-0">Bottom Discharge</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label for="add_equipmentinspection_bottom_discharge_tir" class="form-label text-uppercase fw-bold d-md-none m-0">Bottom Discharge Tir</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.bottom_discharge_tir" id="add_equipmentinspection_bottom_discharge_tir" placeholder="Enter Bottom Discharge Tir" >
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label for="add_equipmentinspection_bottom_discharge_seal" class="form-label text-uppercase fw-bold d-md-none m-0">Bottom Discharge Seal</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.bottom_discharge_seal" id="add_equipmentinspection_bottom_discharge_seal" placeholder="Enter Bottom Discharge Seal" >
				</div>
			</div>
			<div class="col-md-4">
				<label for="add_equipmentinspection_bottom_discharge_comments" class="form-label text-uppercase fw-bold d-md-none m-0">Bottom Discharge Comments</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.bottom_discharge_comments" id="add_equipmentinspection_bottom_discharge_comments" placeholder="Enter Bottom Discharge Comments" >
				</div>
			</div>
		</div>
		<!-- Bottom Discharge -->
		<!-- Manlid -->
		<div class='row mb-2 align-items-center'>
			<div class="col-1 d-none d-md-block">02</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label text-uppercase fw-bold d-none d-md-block m-0">Manlid</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label for="add_equipmentinspection_manlid_tir" class="form-label text-uppercase fw-bold d-md-none m-0">Manlid Tir</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.manlid_tir" id="add_equipmentinspection_manlid_tir" placeholder="Enter Manlid Tir" >
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label for="add_equipmentinspection_manlid_seal" class="form-label text-uppercase fw-bold d-md-none m-0">Manlid Seal</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.manlid_seal" id="add_equipmentinspection_manlid_seal" placeholder="Enter Manlid Seal" >
				</div>
			</div>
			<div class="col-md-4">
				<label for="add_equipmentinspection_manlid_comments" class="form-label text-uppercase fw-bold d-md-none m-0">Manlid Comments</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.manlid_comments" id="add_equipmentinspection_manlid_comments" placeholder="Enter Manlid Comments" >
				</div>
			</div>
		</div>
		<!-- Manlid -->
		<!-- Airline Value -->
		<div class='row mb-2 align-items-center'>
			<div class="col-1 d-none d-md-block">03</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label text-uppercase fw-bold d-none d-md-block m-0">Airline Value</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label for="add_equipmentinspection_airline_value_tir" class="form-label text-uppercase fw-bold d-md-none m-0">Airline Value Tir</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.airline_value_tir" id="add_equipmentinspection_airline_value_tir" placeholder="Enter Airline Value Tir" >
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label for="add_equipmentinspection_airline_value_seal" class="form-label text-uppercase fw-bold d-md-none m-0">Airline Value Seal</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.airline_value_seal" id="add_equipmentinspection_airline_value_seal" placeholder="Enter Airline Value Seal" >
				</div>
			</div>
			<div class="col-md-4">
				<label for="add_equipmentinspection_airline_value_comments" class="form-label text-uppercase fw-bold d-md-none m-0">Airline Value Comments</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.airline_value_comments" id="add_equipmentinspection_airline_value_comments" placeholder="Enter Airline Value Comments" >
				</div>
			</div>
		</div>
		<!-- Airline Value -->
		<!-- PRV -->
		<div class='row mb-2 align-items-center'>
			<div class="col-1 d-none d-md-block">04</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label text-uppercase fw-bold d-none d-md-block m-0">Prv</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label for="add_equipmentinspection_prv_tir" class="form-label text-uppercase fw-bold d-md-none m-0">Prv Tir</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.prv_tir" id="add_equipmentinspection_prv_tir" placeholder="Enter Prv Tir" >
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label for="add_equipmentinspection_prv_seal" class="form-label text-uppercase fw-bold d-md-none m-0">Prv Seal</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.prv_seal" id="add_equipmentinspection_prv_seal" placeholder="Enter Prv Seal" >
				</div>
			</div>
			<div class="col-md-4">
				<label for="add_equipmentinspection_prv_comments" class="form-label text-uppercase fw-bold d-md-none m-0">Prv Comments</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.prv_comments" id="add_equipmentinspection_prv_comments" placeholder="Enter Prv Comments" >
				</div>
			</div>
		</div>
		<!-- PRV -->
		<!-- Top Discharge -->
		<div class='row mb-2 align-items-center'>
			<div class="col-1 d-none d-md-block">05</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label text-uppercase fw-bold d-none d-md-block m-0">Prv</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label for="add_equipmentinspection_top_discharge_tir" class="form-label text-uppercase fw-bold d-none">Top Discharge Tir</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.top_discharge_tir" id="add_equipmentinspection_top_discharge_tir" placeholder="Enter Top Discharge Tir" >
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label for="add_equipmentinspection_top_discharge_seal" class="form-label text-uppercase fw-bold d-none">Top Discharge Seal</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.top_discharge_seal" id="add_equipmentinspection_top_discharge_seal" placeholder="Enter Top Discharge Seal" >
				</div>
			</div>
			<div class="col-md-4">
				<label for="add_equipmentinspection_top_discharge_comments" class="form-label text-uppercase fw-bold d-none">Top Discharge Comments</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.top_discharge_comments" id="add_equipmentinspection_top_discharge_comments" placeholder="Enter Top Discharge Comments" >
				</div>
			</div>
		</div>
		<!-- Top Discharge	 -->
		<!-- To Dischage / Fill Flange -->
		<div class='row mb-2 align-items-center'>
			<div class="col-1 d-none d-md-block">06</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label text-uppercase fw-bold d-none d-md-block m-0">To Dischage/Fill Flange</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label for="add_equipmentinspection_to_discharge_fill_flange_tir" class="form-label text-uppercase fw-bold d-md-none m-0">To Discharge Fill Flange Tir</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.to_discharge_fill_flange_tir" id="add_equipmentinspection_to_discharge_fill_flange_tir" placeholder="Enter To Discharge Fill Flange Tir" >
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label for="add_equipmentinspection_to_discharge_fill_flange_seal" class="form-label text-uppercase fw-bold d-md-none m-0">To Discharge Fill Flange Seal</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.to_discharge_fill_flange_seal" id="add_equipmentinspection_to_discharge_fill_flange_seal" placeholder="Enter To Discharge Fill Flange Seal" >
				</div>
			</div>
			<div class="col-md-4">
				<label for="add_equipmentinspection_to_discharge_fill_flange_comments" class="form-label text-uppercase fw-bold d-md-none m-0">To Discharge Fill Flange Comments</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.to_discharge_fill_flange_comments" id="add_equipmentinspection_to_discharge_fill_flange_comments" placeholder="Enter To Discharge Fill Flange Comments" >
				</div>
			</div>
		</div>
		<!-- To Dischage / Fill Flange -->
		<!-- Safety Provision -->
		<div class='row mb-2 align-items-center'>
			<div class="col-1 d-none d-md-block">07</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label text-uppercase fw-bold d-none d-md-block m-0">Safety Provision</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label for="add_equipmentinspection_safety_provision_tir" class="form-label text-uppercase fw-bold d-md-none m-0">Safety Provision Tir</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.safety_provision_tir" id="add_equipmentinspection_safety_provision_tir" placeholder="Enter Safety Provision Tir" >
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label for="add_equipmentinspection_safety_provision_seal" class="form-label text-uppercase fw-bold d-md-none m-0">Safety Provision Seal</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.safety_provision_seal" id="add_equipmentinspection_safety_provision_seal" placeholder="Enter Safety Provision Seal" >
				</div>
			</div>
			<div class="col-md-4">
				<label for="add_equipmentinspection_safety_provision_comments" class="form-label text-uppercase fw-bold d-md-none m-0">Safety Provision Comments</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.safety_provision_comments" id="add_equipmentinspection_safety_provision_comments" placeholder="Enter Safety Provision Comments" >
				</div>
			</div>
		</div>
		<!-- Safety Provision -->
		<!-- Vapour Return Provision -->
		<div class='row mb-2 align-items-center'>
			<div class="col-1 d-none d-md-block">08</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label text-uppercase fw-bold d-none d-md-block m-0">Vapour Return Provision</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label for="add_equipmentinspection_vapour_return_provision_tir" class="form-label text-uppercase fw-bold d-md-none m-0">Vapour Return Provision Tir</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.vapour_return_provision_tir" id="add_equipmentinspection_vapour_return_provision_tir" placeholder="Enter Vapour Return Provision Tir" >
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label for="add_equipmentinspection_vapour_return_provision_seal" class="form-label text-uppercase fw-bold d-md-none m-0">Vapour Return Provision Seal</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.vapour_return_provision_seal" id="add_equipmentinspection_vapour_return_provision_seal" placeholder="Enter Vapour Return Provision Seal" >
				</div>
			</div>
			<div class="col-md-4">
				<label for="add_equipmentinspection_vapour_return_provision_comments" class="form-label text-uppercase fw-bold d-md-none m-0">Vapour Return Provision Comments</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.vapour_return_provision_comments" id="add_equipmentinspection_vapour_return_provision_comments" placeholder="Enter Vapour Return Provision Comments" >
				</div>
			</div>
		</div>
		<!-- Vapour Return Provision -->
		<!-- Fwd Inspection Hatch -->
		<div class='row mb-2 align-items-center'>
			<div class="col-1 d-none d-md-block">09</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label text-uppercase fw-bold d-none d-md-block m-0">Fwd Inspection Hatch</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label for="add_equipmentinspection_fwd_inspection_hatch_tir" class="form-label text-uppercase fw-bold d-md-none m-0">Fwd Inspection Hatch Tir</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.fwd_inspection_hatch_tir" id="add_equipmentinspection_fwd_inspection_hatch_tir" placeholder="Enter Fwd Inspection Hatch Tir" >
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label for="add_equipmentinspection_fwd_inspection_hatch_seal" class="form-label text-uppercase fw-bold d-md-none m-0">Fwd Inspection Hatch Seal</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.fwd_inspection_hatch_seal" id="add_equipmentinspection_fwd_inspection_hatch_seal" placeholder="Enter Fwd Inspection Hatch Seal" >
				</div>
			</div>
			<div class="col-md-4">
				<label for="add_equipmentinspection_fwd_inspection_hatch_comments" class="form-label text-uppercase fw-bold d-md-none m-0">Fwd Inspection Hatch Comments</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.fwd_inspection_hatch_comments" id="add_equipmentinspection_fwd_inspection_hatch_comments" placeholder="Enter Fwd Inspection Hatch Comments" >
				</div>
			</div>
		</div>
		<!-- Fwd Inspection Hatch -->
		<!-- Afg Inspection Hatch -->
		<div class='row mb-2 align-items-center'>
			<div class="col-1 d-none d-md-block">10</div>
			<div class="col-md-2 d-none d-md-block">
				<label class="form-label text-uppercase fw-bold d-none d-md-block m-0">Afg Inspection Hatch</label>
			</div>
			<div class="col-md-2 col-sm-6">
				<label for="add_equipmentinspection_afg_inspection_hatch_tir" class="form-label text-uppercase fw-bold d-md-none m-0">Afg Inspection Hatch Tir</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.afg_inspection_hatch_tir" id="add_equipmentinspection_afg_inspection_hatch_tir" placeholder="Enter Afg Inspection Hatch Tir" >
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<label for="add_equipmentinspection_afg_inspection_hatch_seal" class="form-label text-uppercase fw-bold d-md-none m-0">Afg Inspection Hatch Seal</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.afg_inspection_hatch_seal" id="add_equipmentinspection_afg_inspection_hatch_seal" placeholder="Enter Afg Inspection Hatch Seal" >
				</div>
			</div>
			<div class="col-md-4">
				<label for="add_equipmentinspection_afg_inspection_hatch_comments" class="form-label text-uppercase fw-bold d-md-none m-0">Afg Inspection Hatch Comments</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="equipmentinspectionFormObj.afg_inspection_hatch_comments" id="add_equipmentinspection_afg_inspection_hatch_comments" placeholder="Enter Afg Inspection Hatch Comments" >
				</div>
			</div>
		</div>
		<!-- Afg Inspection Hatch -->
		<!-- comments -->
		<div class='row mb-3 align-items-center'>
			<label for="add_equipmentinspection_comments" class="form-label text-uppercase fw-bold m-0 col-md-1">Comments</label>
			<div class="col-md-11">
				<textarea class="form-control" v-model="equipmentinspectionFormObj.comments" rows="3" id="add_equipmentinspection_comments" placeholder="Enter Comments"></textarea>
			</div>
		</div>
		<!-- comments -->
		<div class="row justify-content-center" v-if="!isModal">
			<div class="col-5">
				<a class="btn btn-success w-100" @click="saveEquipmentInspection()">Save</a>
			</div>
		</div>
	</div>
</template>
<script>
import { useVuelidate } from '@vuelidate/core';
function initialState(){
	return {
		id:0,
		ref_no:'AUTOGENERATED',
		company_id:'',
		inspection_date:'',
		tank_no:'',
		last_cargo_carried:'',
		empty_clean:'',
		empty_dirty:'',
		loaded:'',
		surveyor_id:'',
		hazard_class:'',
		eq_inspection_status:'',
		last_test_date:'',
		capacity:'',
		equipment_type:'',
		csc:'',
		loaded_at:'',
		tank_type:'',
		mfg_date:'',
		cfs:'',
		for_id:'',
		next_date:'',
		country:'',
		inspection_location_id:'',
		customer_id:'',
		cha_client:'',
		tare_weight:'',
		mgw:'',
		bottom_discharge_tir:'',
		bottom_discharge_seal:'',
		bottom_discharge_comments:'',
		manlid_tir:'',
		manlid_seal:'',
		manlid_comments:'',
		airline_value_tir:'',
		airline_value_seal:'',
		airline_value_comments:'',
		prv_tir:'',
		prv_seal:'',
		prv_comments:'',
		top_discharge_tir:'',
		top_discharge_seal:'',
		top_discharge_comments:'',
		to_discharge_fill_flange_tir:'',
		to_discharge_fill_flange_seal:'',
		to_discharge_fill_flange_comments:'',
		safety_provision_tir:'',
		safety_provision_seal:'',
		safety_provision_comments:'',
		vapour_return_provision_tir:'',
		vapour_return_provision_seal:'',
		vapour_return_provision_comments:'',
		fwd_inspection_hatch_tir:'',
		fwd_inspection_hatch_seal:'',
		fwd_inspection_hatch_comments:'',
		afg_inspection_hatch_tir:'',
		afg_inspection_hatch_seal:'',
		afg_inspection_hatch_comments:'',
		comments:'',
		deleted_at:'',
		created_at:'',
		updated_at:'',

		reload: false,
		closed: false,
		action: ''
	};
}
export default {
	name: "EquipmentInspectionmaster",
	props: ['current_user_id', 'all_permissions','id', 'isModal', 'equipmentinspectionForAdd', 'reload', 'closed'],
	setup() {
		return {
			v$: useVuelidate()
		}
	},
	data(){
		return{
			addEditModal: null,
			currentUser: siteUserObject,
			imageId: 0,
			allCompanyIdList: [],
			allEmptyCleanList: [],
			allEmptyDirtyList: [],
			allLoadedList: [],
			allSurveyorIdList: [],
			allEqInspectionStatusList: [],
			allEquipmentTypeList: [],
			allTankTypeList: [],
			allCfsList: [],
			allForIdList: [],
			allInspectionLocationIdList: [],
			allCustomerIdList: [],
			equipmentinspectionFormObj: initialState(),
		}
	},
	
	methods: {
		canceladdedit(event){
			window.location = this.docRoot + '/equipmentinspection';
		},
		formatDate(date) {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
		async saveEquipmentInspection(event){
			var that = this;
			const result = await that.v$.$validate();
			if (!result) {
				that.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
				console.log(that.v$.$errors);
				return;
			}
			if( !that.equipmentinspectionFormObj.action || that.equipmentinspectionFormObj.action == "" )
				that.equipmentinspectionFormObj.action = "details";
			that.equipmentinspectionFormObj.created_by = that.current_user_id;
			
			if (  typeof that.equipmentinspectionFormObj.company_id === 'object' && that.equipmentinspectionFormObj.company_id.id) {
				that.equipmentinspectionFormObj.company_id = that.equipmentinspectionFormObj.company_id.id;
			}
			if (  typeof that.equipmentinspectionFormObj.surveyor_id === 'object' && that.equipmentinspectionFormObj.surveyor_id.id) {
				that.equipmentinspectionFormObj.surveyor_id = that.equipmentinspectionFormObj.surveyor_id.id;
			}
			if (  typeof that.equipmentinspectionFormObj.for_id === 'object' && that.equipmentinspectionFormObj.for_id.id) {
				that.equipmentinspectionFormObj.for_id = that.equipmentinspectionFormObj.for_id.id;
			}
			if (  typeof that.equipmentinspectionFormObj.inspection_location_id === 'object' && that.equipmentinspectionFormObj.inspection_location_id.id) {
				that.equipmentinspectionFormObj.inspection_location_id = that.equipmentinspectionFormObj.inspection_location_id.id;
			}
			if (  typeof that.equipmentinspectionFormObj.customer_id === 'object' && that.equipmentinspectionFormObj.customer_id.id) {
				that.equipmentinspectionFormObj.customer_id = that.equipmentinspectionFormObj.customer_id.id;
			}

						
			if (  typeof that.equipmentinspectionFormObj.empty_clean === 'object' &&  Object.keys(that.equipmentinspectionFormObj.empty_clean).length > 0) {
				that.equipmentinspectionFormObj.empty_clean = that.equipmentinspectionFormObj.empty_clean;
			}

			if (  typeof that.equipmentinspectionFormObj.empty_dirty === 'object' &&  Object.keys(that.equipmentinspectionFormObj.empty_dirty).length > 0) {
				that.equipmentinspectionFormObj.empty_dirty = that.equipmentinspectionFormObj.empty_dirty;
			}

			if (  typeof that.equipmentinspectionFormObj.loaded === 'object' &&  Object.keys(that.equipmentinspectionFormObj.loaded).length > 0) {
				that.equipmentinspectionFormObj.loaded = that.equipmentinspectionFormObj.loaded;
			}

			if (  typeof that.equipmentinspectionFormObj.eq_inspection_status === 'object' &&  Object.keys(that.equipmentinspectionFormObj.eq_inspection_status).length > 0) {
				that.equipmentinspectionFormObj.eq_inspection_status = that.equipmentinspectionFormObj.eq_inspection_status;
			}

			if (  typeof that.equipmentinspectionFormObj.equipment_type === 'object' &&  Object.keys(that.equipmentinspectionFormObj.equipment_type).length > 0) {
				that.equipmentinspectionFormObj.equipment_type = that.equipmentinspectionFormObj.equipment_type;
			}

			if (  typeof that.equipmentinspectionFormObj.tank_type === 'object' &&  Object.keys(that.equipmentinspectionFormObj.tank_type).length > 0) {
				that.equipmentinspectionFormObj.tank_type = that.equipmentinspectionFormObj.tank_type;
			}

			if (  typeof that.equipmentinspectionFormObj.cfs === 'object' &&  Object.keys(that.equipmentinspectionFormObj.cfs).length > 0) {
				that.equipmentinspectionFormObj.cfs = that.equipmentinspectionFormObj.cfs;
			}
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/equipmentinspection/save', { equipmentinspection: that.equipmentinspectionFormObj }).then(async function (response) {
				that.closeSwal();
				var status = response.data.status;
				if( status == 1 ){
					// Set the ID so that duplicate records will not be created
					that.equipmentinspectionFormObj.id = response.data.id;
					that.showToast('EquipmentInspection saved successfully', 'success', 'bottom', 3000);
					setTimeout(() => {
						window.location = that.docRoot + "/equipmentinspection/";
						that.showLoading("Loading ...");
					}, 1500);
				}
				else{
					that.showErrors("EquipmentInspection could not be saved successfully.", response.data.messages, "bottom", 3000);
				}
			})
			.catch(function (error) {
				console.log(error);
				that.closeSwal();
				that.showToast("EquipmentInspection could not be saved successfully.", "error", "bottom", 3000);
			});
		},
		
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				this.mode = "edit";
				
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/equipmentinspection/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios.post(URL, {}).then(function (response) {
					that.closeSwal();
					that.equipmentinspectionFormObj = Object.assign({}, response.data);
					if ( that.equipmentinspectionFormObj.empty_clean && typeof that.equipmentinspectionFormObj.empty_clean === 'string' ) {
						that.equipmentinspectionFormObj.empty_clean = JSON.parse(that.equipmentinspectionFormObj.empty_clean);
					}

					if ( that.equipmentinspectionFormObj.empty_dirty && typeof that.equipmentinspectionFormObj.empty_dirty === 'string' ) {
						that.equipmentinspectionFormObj.empty_dirty = JSON.parse(that.equipmentinspectionFormObj.empty_dirty);
					}

					if ( that.equipmentinspectionFormObj.loaded && typeof that.equipmentinspectionFormObj.loaded === 'string' ) {
						that.equipmentinspectionFormObj.loaded = JSON.parse(that.equipmentinspectionFormObj.loaded);
					}

					if ( that.equipmentinspectionFormObj.eq_inspection_status && typeof that.equipmentinspectionFormObj.eq_inspection_status === 'string' ) {
						that.equipmentinspectionFormObj.eq_inspection_status = JSON.parse(that.equipmentinspectionFormObj.eq_inspection_status);
					}

					if ( that.equipmentinspectionFormObj.equipment_type && typeof that.equipmentinspectionFormObj.equipment_type === 'string' ) {
						that.equipmentinspectionFormObj.equipment_type = JSON.parse(that.equipmentinspectionFormObj.equipment_type);
					}

					if ( that.equipmentinspectionFormObj.tank_type && typeof that.equipmentinspectionFormObj.tank_type === 'string' ) {
						that.equipmentinspectionFormObj.tank_type = JSON.parse(that.equipmentinspectionFormObj.tank_type);
					}

					if ( that.equipmentinspectionFormObj.cfs && typeof that.equipmentinspectionFormObj.cfs === 'string' ) {
						that.equipmentinspectionFormObj.cfs = JSON.parse(that.equipmentinspectionFormObj.cfs);
					}

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
		let _allCompanyIdList = await this.loadAllCompany(this.docRoot+'/api/company/get', 'post', {});
		if(Array.isArray(_allCompanyIdList) && _allCompanyIdList.length > 0){
			this.allCompanyIdList = _allCompanyIdList.map(x => {return { id: x.id, text: x.name }});
		}
		this.allEmptyCleanList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, { id: '-1', text: 'NA'}, ];
		this.allEmptyDirtyList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, { id: '-1', text: 'NA'}, ];
		this.allLoadedList = [{ id: '1', text: 'Yes'}, { id: '0', text: 'No'}, { id: '-1', text: 'NA'}, ];

		let _allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/api/surveyor/get', 'post', {});
		if(Array.isArray(_allSurveyorIdList) && _allSurveyorIdList.length > 0){
			this.allSurveyorIdList = _allSurveyorIdList.map(x => {return { id: x.id, text: x.name }});
		}

		this.allEqInspectionStatusList = [{ id: '1', text: 'Import'}, { id: '2', text: 'Export'}, ];
		this.allEquipmentTypeList = [{ id: '1', text: 'Loaded'}, { id: '0', text: 'Unloaded'}, ];
		this.allTankTypeList = [{ id: '1', text: 'IMO 1'}, { id: '2', text: 'IMO 5'}, ];
		this.allCfsList = [{ id: '-1', text: 'NA'}, { id: '1', text: 'In'}, { id: '0', text: 'Out'}, ];

		let _allForIdList = await this.loadAllCustomer(this.docRoot+'/api/customer/get', 'post', {});
		if(Array.isArray(_allForIdList) && _allForIdList.length > 0){
			this.allForIdList = _allForIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/api/inspectionlocation/get', 'post', {});
		if(Array.isArray(_allInspectionLocationIdList) && _allInspectionLocationIdList.length > 0){
			this.allInspectionLocationIdList = _allInspectionLocationIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allCustomerIdList = await this.loadAllCustomer(this.docRoot+'/api/customer/get', 'post', {});
		if(Array.isArray(_allCustomerIdList) && _allCustomerIdList.length > 0){
			this.allCustomerIdList = _allCustomerIdList.map(x => {return { id: x.id, text: x.name }});
		}
		if (this.equipmentinspectionFormObj.company_id) {
			if (Array.isArray(this.allCompanyIdList) && this.allCompanyIdList.length > 0) {
				let _allRelationList = this.allCompanyIdList;
				let relationId = parseInt(this.equipmentinspectionFormObj.company_id);
				this.equipmentinspectionFormObj.company_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.equipmentinspectionFormObj.surveyor_id) {
			if (Array.isArray(this.allSurveyorIdList) && this.allSurveyorIdList.length > 0) {
				let _allRelationList = this.allSurveyorIdList;
				let relationId = parseInt(this.equipmentinspectionFormObj.surveyor_id);
				this.equipmentinspectionFormObj.surveyor_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.equipmentinspectionFormObj.for_id) {
			if (Array.isArray(this.allForIdList) && this.allForIdList.length > 0) {
				let _allRelationList = this.allForIdList;
				let relationId = parseInt(this.equipmentinspectionFormObj.for_id);
				this.equipmentinspectionFormObj.for_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.equipmentinspectionFormObj.inspection_location_id) {
			if (Array.isArray(this.allInspectionLocationIdList) && this.allInspectionLocationIdList.length > 0) {
				let _allRelationList = this.allInspectionLocationIdList;
				let relationId = parseInt(this.equipmentinspectionFormObj.inspection_location_id);
				this.equipmentinspectionFormObj.inspection_location_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.equipmentinspectionFormObj.customer_id) {
			if (Array.isArray(this.allCustomerIdList) && this.allCustomerIdList.length > 0) {
				let _allRelationList = this.allCustomerIdList;
				let relationId = parseInt(this.equipmentinspectionFormObj.customer_id);
				this.equipmentinspectionFormObj.customer_id = _allRelationList.find(item => item.id === relationId);
			}
		}
	}
}
</script>
<style>
	.ql-container{height: 60px !important;}
</style>
