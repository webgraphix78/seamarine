<template>
	<div id="cscinspectiontank-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_cscinspectiontank_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/cscinspectiontank'" role="button"><i class="ph ph-arrow-left "></i>Back to list</a>
					<h4 class="m-0 text-capitalize">Add csc inspection tank</h4>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_company_id" class="form-label text-uppercase fw-bold me-3">Company Name</label>
				<div>
					<multiselect v-model="cscinspectiontankFormObj.company_id" :options="allCompanyIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
				
			</div>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_inspection_date" class="form-label text-uppercase fw-bold me-3">Inspection Date</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.inspection_date" id="add_cscinspectiontank_inspection_date" placeholder="Enter Inspection Date" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-4">
				<label for="add_cscinspectiontank_inspection_location_id" class="form-label text-uppercase fw-bold me-3">Place of Inspection</label>
				<div>
					<multiselect v-model="cscinspectiontankFormObj.inspection_location_id" :options="allInspectionLocationIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
				
			</div>
			<div class="col-md-4">
				<label for="add_cscinspectiontank_operator_lessor" class="form-label text-uppercase fw-bold me-3">Operator/Lessor</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.operator_lessor" id="add_cscinspectiontank_operator_lessor" placeholder="Enter Operator/Lessor" >
					
				</div>
				
			</div>
			<div class="col-md-4">
				<label for="add_cscinspectiontank_tank_no" class="form-label text-uppercase fw-bold me-3">Owner's Serial Number</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_no" id="add_cscinspectiontank_tank_no" placeholder="Enter Tank No" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_mfg" class="form-label text-uppercase fw-bold me-3">Manufacturer</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.mfg" id="add_cscinspectiontank_mfg" placeholder="Enter Mfg" >
					
				</div>
				
			</div>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_mfg_sr_no" class="form-label text-uppercase fw-bold me-3">Manufacturer Sr No</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.mfg_sr_no" id="add_cscinspectiontank_mfg_sr_no" placeholder="Enter Mfg Sr No" >
					
				</div>
				
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-12">
				<h4 class="m-0 fw-bold">Applicable Regulations. Enter initial approval No. as applicable</h4>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_csc" class="form-label text-uppercase fw-bold me-3">Csc</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.csc" id="add_cscinspectiontank_csc" placeholder="Enter Csc" >
					
				</div>
				
			</div>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_uk_dot" class="form-label text-uppercase fw-bold me-3">Uk Dot</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.uk_dot" id="add_cscinspectiontank_uk_dot" placeholder="Enter Uk Dot" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_imdg" class="form-label text-uppercase fw-bold me-3">Imdg</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.imdg" id="add_cscinspectiontank_imdg" placeholder="Enter Imdg" >
					
				</div>
				
			</div>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_us_dot" class="form-label text-uppercase fw-bold me-3">Us Dot</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.us_dot" id="add_cscinspectiontank_us_dot" placeholder="Enter Us Dot" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_rid" class="form-label text-uppercase fw-bold me-3">Rid</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.rid" id="add_cscinspectiontank_rid" placeholder="Enter Rid" >
					
				</div>
				
			</div>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_aar" class="form-label text-uppercase fw-bold me-3">Aar</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.aar" id="add_cscinspectiontank_aar" placeholder="Enter Aar" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_bam" class="form-label text-uppercase fw-bold me-3">Bam</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.bam" id="add_cscinspectiontank_bam" placeholder="Enter Bam" >
					
				</div>
				
			</div>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_tc_impact" class="form-label text-uppercase fw-bold me-3">Tc Impact</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tc_impact" id="add_cscinspectiontank_tc_impact" placeholder="Enter Tc Impact" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-4">
				<label for="add_cscinspectiontank_tir" class="form-label text-uppercase fw-bold me-3">Tir</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tir" id="add_cscinspectiontank_tir" placeholder="Enter Tir" >
					
				</div>
				
			</div>
			<div class="col-md-4">
				<label for="add_cscinspectiontank_uic" class="form-label text-uppercase fw-bold me-3">Uic</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.uic" id="add_cscinspectiontank_uic" placeholder="Enter Uic" >
					
				</div>
				
			</div>
			<div class="col-md-4">
				<label for="add_cscinspectiontank_fra" class="form-label text-uppercase fw-bold me-3">Fra</label>
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.fra" id="add_cscinspectiontank_fra" placeholder="Enter Fra" >
					
				</div>
				
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-5">
				<div class='row g-3'>
					<div class="col-12">
						<h4 class="m-0 fw-bold">Tank Information</h4>
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_mfg_year" class="form-label text-uppercase fw-bold me-3">Year of Manufacture</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_mfg_year" id="add_cscinspectiontank_tank_mfg_year" placeholder="Enter Mfg Year" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_max_g_wt" class="form-label text-uppercase fw-bold me-3">Max Gross Weight (Kg)</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_max_g_wt" id="add_cscinspectiontank_tank_max_g_wt" placeholder="Enter Max G Wt" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_tare_wt" class="form-label text-uppercase fw-bold me-3">Tare Weight (Kg)</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_tare_wt" id="add_cscinspectiontank_tank_tare_wt" placeholder="Enter Tank Tare Wt" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_capacity" class="form-label text-uppercase fw-bold me-3">Capacity (L)</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_capacity" id="add_cscinspectiontank_tank_capacity" placeholder="Enter Tank Capacity" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_desgin_temp" class="form-label text-uppercase fw-bold me-3">Design Temp (C)</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_desgin_temp" id="add_cscinspectiontank_tank_desgin_temp" placeholder="Enter Tank Desgin Temp" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_mawp_bar" class="form-label text-uppercase fw-bold me-3">M.A.W.P. (Bar)</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_mawp_bar" id="add_cscinspectiontank_tank_mawp_bar" placeholder="Enter Tank Mawp Bar" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_test_press_bar" class="form-label text-uppercase fw-bold me-3">Test Press(Bar)</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_test_press_bar" id="add_cscinspectiontank_tank_test_press_bar" placeholder="Enter Tank Test Press(Bar)" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_top_discharge" class="form-label text-uppercase fw-bold me-3">Top Discharge</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_top_discharge" id="add_cscinspectiontank_tank_top_discharge" placeholder="Enter Tank Top Discharge" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_bottom_discharge" class="form-label text-uppercase fw-bold me-3">Bottom Discharge</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_bottom_discharge" id="add_cscinspectiontank_tank_bottom_discharge" placeholder="Enter Tank Bottom Discharge" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_no_of_closure" class="form-label text-uppercase fw-bold me-3">No. of closures in series</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_no_of_closure" id="add_cscinspectiontank_tank_no_of_closure" placeholder="Enter Tank No Of Closure" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_shell_material" class="form-label text-uppercase fw-bold me-3">Shell Material</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_shell_material" id="add_cscinspectiontank_tank_shell_material" placeholder="Enter Tank Shell Material" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_shell_thickness" class="form-label text-uppercase fw-bold me-3">Shell Thickness(mm)</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_shell_thickness" id="add_cscinspectiontank_tank_shell_thickness" placeholder="Enter Tank Shell Thickness" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_heads_material" class="form-label text-uppercase fw-bold me-3">Heads Material</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_heads_material" id="add_cscinspectiontank_tank_heads_material" placeholder="Enter Tank Heads Material" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_head_thickness" class="form-label text-uppercase fw-bold me-3">Head Thickness (mm)</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_head_thickness" id="add_cscinspectiontank_tank_head_thickness" placeholder="Enter Tank Head Thickness" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_tank_iso_type" class="form-label text-uppercase fw-bold me-3">Iso Type</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.tank_iso_type" id="add_cscinspectiontank_tank_iso_type" placeholder="Enter Tank Iso Type" >
							
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row mb-4">
					<div class="col-12">
						<h4 class="m-0 fw-bold">Inspection Dates (mm/yy)</h4>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-6">
						<label for="add_cscinspectiontank_insp_init_hydro_date" class="form-label text-uppercase fw-bold me-3">Initial Hydro Test</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_init_hydro_date" id="add_cscinspectiontank_insp_init_hydro_date" placeholder="Enter Insp Init Hydro Date" >
							
						</div>
						
					</div>
					<div class="col-md-6">
						<label for="add_cscinspectiontank_insp_hydro_witness" class="form-label text-uppercase fw-bold me-3">Witness</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_hydro_witness" id="add_cscinspectiontank_insp_hydro_witness" placeholder="Enter Insp Hydro Witness" >
							
						</div>
						
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-6">
						<label for="add_cscinspectiontank_insp_last_hydro_date" class="form-label text-uppercase fw-bold me-3">Last Hydro Test</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_last_hydro_date" id="add_cscinspectiontank_insp_last_hydro_date" placeholder="Enter Insp Last Hydro Date" >
							
						</div>
						
					</div>
					<div class="col-md-6">
						<label for="add_cscinspectiontank_insp_last_hydro_witness" class="form-label text-uppercase fw-bold me-3">Witness</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_last_hydro_witness" id="add_cscinspectiontank_insp_last_hydro_witness" placeholder="Enter Insp Last Hydro Witness" >
							
						</div>
						
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-12 mb-4">
						<label for="add_cscinspectiontank_insp_date" class="form-label text-uppercase fw-bold me-3">This inspection date:</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_date" id="add_cscinspectiontank_insp_date" placeholder="Enter Insp Date" >
							
						</div>
						
					</div>
					<div class="col-12">
						<label for="add_cscinspectiontank_next_insp_date" class="form-label text-uppercase fw-bold me-3">Next CSC Due</label>
						<div class="input-group">
							
							<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.next_insp_date" id="add_cscinspectiontank_next_insp_date" placeholder="Enter Next Insp Date" >
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-3 col-12">
				<h4 class="fw-bold text-center">Inspections Performed</h4>
			</div>
			<div class="col-md-3 col-4">
				<h4 class="fw-bold text-center">N/A</h4>
			</div>
			<div class="col-md-3 col-4">
				<h4 class="fw-bold text-center">In Order</h4>
			</div>
			<div class="col-md-3 col-4">
				<h4 class="fw-bold text-center">See Comments</h4>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-3 col-12 ">
				<label class="form-label text-uppercase fw-bold">Internal Inspection</label>
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_inter_perfom_na" class="form-label text-uppercase fw-bold me-3">Insp Inter Perfom Na</label> -->
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_inter_perfom_na" id="add_cscinspectiontank_insp_inter_perfom_na" placeholder="Enter Insp Inter Perfom Na" >
				</div>
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_inter_perfom_in" class="form-label text-uppercase fw-bold me-3">Insp Inter Perfom In</label> -->
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_inter_perfom_in" id="add_cscinspectiontank_insp_inter_perfom_in" placeholder="Enter Insp Inter Perfom In" >
				</div>
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_inter_perfom_remark" class="form-label text-uppercase fw-bold me-3">Insp Inter Perfom Remark</label> -->
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_inter_perfom_remark" id="add_cscinspectiontank_insp_inter_perfom_remark" placeholder="Enter Insp Inter Perfom Remark" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-3 col-12 ">
				<label class="form-label text-uppercase fw-bold">External Inspection</label>
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_ext_perfom_na" class="form-label text-uppercase fw-bold me-3">Insp Ext Perfom Na</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_ext_perfom_na" id="add_cscinspectiontank_insp_ext_perfom_na" placeholder="Enter Insp Ext Perfom Na" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_ext_perfom_in" class="form-label text-uppercase fw-bold me-3">Insp Ext Perfom In</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_ext_perfom_in" id="add_cscinspectiontank_insp_ext_perfom_in" placeholder="Enter Insp Ext Perfom In" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_ext_perfom_remark" class="form-label text-uppercase fw-bold me-3">Insp Ext Perfom Remark</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_ext_perfom_remark" id="add_cscinspectiontank_insp_ext_perfom_remark" placeholder="Enter Insp Ext Perfom Remark" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-3 col-12 ">
				<label class="form-label text-uppercase fw-bold">Date</label>
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_date_na" class="form-label text-uppercase fw-bold me-3">Insp Perfom Date Na</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_date_na" id="add_cscinspectiontank_insp_perfom_date_na" placeholder="Enter Insp Perfom Date Na" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_date_in" class="form-label text-uppercase fw-bold me-3">Insp Perfom Date In</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_date_in" id="add_cscinspectiontank_insp_perfom_date_in" placeholder="Enter Insp Perfom Date In" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_date_remark" class="form-label text-uppercase fw-bold me-3">Insp Perfom Date Remark</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_date_remark" id="add_cscinspectiontank_insp_perfom_date_remark" placeholder="Enter Insp Perfom Date Remark" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-3 col-12 ">
				<label class="form-label text-uppercase fw-bold">Pressure (Bar)</label>
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_pressure_bar_na" class="form-label text-uppercase fw-bold me-3">Insp Perfom Pressure Bar Na</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_pressure_bar_na" id="add_cscinspectiontank_insp_perfom_pressure_bar_na" placeholder="Enter Insp Perfom Pressure Bar Na" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_pressure_bar_in" class="form-label text-uppercase fw-bold me-3">Insp Perfom Pressure Bar In</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_pressure_bar_in" id="add_cscinspectiontank_insp_perfom_pressure_bar_in" placeholder="Enter Insp Perfom Pressure Bar In" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_pressure_bar_remark" class="form-label text-uppercase fw-bold me-3">Insp Perfom Pressure Bar Remark</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_pressure_bar_remark" id="add_cscinspectiontank_insp_perfom_pressure_bar_remark" placeholder="Enter Insp Perfom Pressure Bar Remark" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-3 col-12 ">
				<label class="form-label text-uppercase fw-bold">Fitting Inspection</label>
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_fittin_na" class="form-label text-uppercase fw-bold me-3">Insp Perfom Fittin Na</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_fittin_na" id="add_cscinspectiontank_insp_perfom_fittin_na" placeholder="Enter Insp Perfom Fittin Na" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_fittin_in" class="form-label text-uppercase fw-bold me-3">Insp Perfom Fittin In</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_fittin_in" id="add_cscinspectiontank_insp_perfom_fittin_in" placeholder="Enter Insp Perfom Fittin In" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_fittin_remark" class="form-label text-uppercase fw-bold me-3">Insp Perfom Fittin Remark</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_fittin_remark" id="add_cscinspectiontank_insp_perfom_fittin_remark" placeholder="Enter Insp Perfom Fittin Remark" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-3 col-12 ">
				<label class="form-label text-uppercase fw-bold">Frame Inspection</label>
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_frame_na" class="form-label text-uppercase fw-bold me-3">Insp Perfom Frame Na</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_frame_na" id="add_cscinspectiontank_insp_perfom_frame_na" placeholder="Enter Insp Perfom Frame Na" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_frame_in" class="form-label text-uppercase fw-bold me-3">Insp Perfom Frame In</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_frame_in" id="add_cscinspectiontank_insp_perfom_frame_in" placeholder="Enter Insp Perfom Frame In" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_frame_remark" class="form-label text-uppercase fw-bold me-3">Insp Perfom Frame Remark</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_frame_remark" id="add_cscinspectiontank_insp_perfom_frame_remark" placeholder="Enter Insp Perfom Frame Remark" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-3 col-12 ">
				<label class="form-label text-uppercase fw-bold">Decals Inspection</label>
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_decals_na" class="form-label text-uppercase fw-bold me-3">Insp Perfom Decals Na</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_decals_na" id="add_cscinspectiontank_insp_perfom_decals_na" placeholder="Enter Insp Perfom Decals Na" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_decals_in" class="form-label text-uppercase fw-bold me-3">Insp Perfom Decals In</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_decals_in" id="add_cscinspectiontank_insp_perfom_decals_in" placeholder="Enter Insp Perfom Decals In" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_decals_remark" class="form-label text-uppercase fw-bold me-3">Insp Perfom Decals Remark</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_decals_remark" id="add_cscinspectiontank_insp_perfom_decals_remark" placeholder="Enter Insp Perfom Decals Remark" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-3 col-12 ">
				<label class="form-label text-uppercase fw-bold">Steam Coils Test Pressure (Bar):</label>
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_steam_na" class="form-label text-uppercase fw-bold me-3">Steam Coils Test Pressure (Bar):</label> -->
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_steam_na" id="add_cscinspectiontank_insp_perfom_steam_na" placeholder="Enter Insp Perfom Steam Na" >
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_steam_in" class="form-label text-uppercase fw-bold me-3">Insp Perfom Steam In</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_steam_in" id="add_cscinspectiontank_insp_perfom_steam_in" placeholder="Enter Insp Perfom Steam In" >
					
				</div>
				
			</div>
			<div class="col-md-3 col-4">
				<!-- <label for="add_cscinspectiontank_insp_perfom_steam_remark" class="form-label text-uppercase fw-bold me-3">Insp Perfom Steam Remark</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.insp_perfom_steam_remark" id="add_cscinspectiontank_insp_perfom_steam_remark" placeholder="Enter Insp Perfom Steam Remark" >
					
				</div>
				
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4 col-12">
				<h4 class="fw-bold text-center">Pressure Relief Valves</h4>
			</div>
			<div class="col-md-4 col-6">
				<h4 class="fw-bold text-center">1st</h4>
			</div>
			<div class="col-md-4 col-6">
				<h4 class="fw-bold text-center">2nd</h4>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-4 col-12 ">
				<label class="form-label text-uppercase fw-bold">Manufacturer/Type:</label>
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_mfgr_type_1" class="form-label text-uppercase fw-bold me-3">Manufacturer/Type</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_mfgr_type_1" id="add_cscinspectiontank_p_mfgr_type_1" placeholder="Enter P Mfgr Type 1" >
					
				</div>
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_mfgr_type_2" class="form-label text-uppercase fw-bold me-3">P Mfgr Type 2</label> -->
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_mfgr_type_2" id="add_cscinspectiontank_p_mfgr_type_2" placeholder="Enter P Mfgr Type 2" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-4 col-12 ">
				<label class="form-label text-uppercase fw-bold">Serial Number</label>
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_sr_no_1" class="form-label text-uppercase fw-bold me-3">Serial Number</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_sr_no_1" id="add_cscinspectiontank_p_sr_no_1" placeholder="Enter P Sr No 1" >
					
				</div>
				
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_sr_no_2" class="form-label text-uppercase fw-bold me-3">P Sr No 2</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_sr_no_2" id="add_cscinspectiontank_p_sr_no_2" placeholder="Enter P Sr No 2" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-4 col-12 ">
				<label class="form-label text-uppercase fw-bold">Full Flow Rate (CMHR)</label>
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_full_flow_rate_1" class="form-label text-uppercase fw-bold me-3">Full Flow Rate (CMHR)</label> -->
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_full_flow_rate_1" id="add_cscinspectiontank_p_full_flow_rate_1" placeholder="Enter P Full Flow Rate 1" >
				</div>
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_full_flow_rate_2" class="form-label text-uppercase fw-bold me-3">P Full Flow Rate 2</label> -->
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_full_flow_rate_2" id="add_cscinspectiontank_p_full_flow_rate_2" placeholder="Enter P Full Flow Rate 2" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-4 col-12 ">
				<label class="form-label text-uppercase fw-bold">Operating Pressure (Bar)</label>
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_operating_press_1" class="form-label text-uppercase fw-bold me-3">Operating Pressure (Bar)</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_operating_press_1" id="add_cscinspectiontank_p_operating_press_1" placeholder="Enter P Operating Press 1" >
					
				</div>
				
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_operating_press_2" class="form-label text-uppercase fw-bold me-3">P Operating Press 2</label> -->
				<div class="input-group">
					
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_operating_press_2" id="add_cscinspectiontank_p_operating_press_2" placeholder="Enter P Operating Press 2" >
					
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-4 col-12 ">
				<label class="form-label text-uppercase fw-bold">Vacuum Setting (Hg)</label>
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_vacuum_setting_1" class="form-label text-uppercase fw-bold me-3">Vacuum Setting (Hg)</label> -->
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_vacuum_setting_1" id="add_cscinspectiontank_p_vacuum_setting_1" placeholder="Enter P Vacuum Setting 1" >
				</div>
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_vacuum_setting_2" class="form-label text-uppercase fw-bold me-3">P Vacuum Setting 2</label> -->
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_vacuum_setting_2" id="add_cscinspectiontank_p_vacuum_setting_2" placeholder="Enter P Vacuum Setting 2" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-4 col-12 ">
				<label class="form-label text-uppercase fw-bold">Bursting Disc (Bar)</label>
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_bursting_disc_1" class="form-label text-uppercase fw-bold me-3">Bursting Disc (Bar)</label> -->
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_bursting_disc_1" id="add_cscinspectiontank_p_bursting_disc_1" placeholder="Enter P Bursting Disc 1" >
				</div>
			</div>
			<div class="col-md-4 col-6">
				<!-- <label for="add_cscinspectiontank_p_bursting_disc_2" class="form-label text-uppercase fw-bold me-3">P Bursting Disc 2</label> -->
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.p_bursting_disc_2" id="add_cscinspectiontank_p_bursting_disc_2" placeholder="Enter P Bursting Disc 2" >
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label for="add_cscinspectiontank_comments" class="form-label text-uppercase fw-bold me-3">Comments</label>
				<div>
					<textarea class="form-control" v-model="cscinspectiontankFormObj.comments" rows="3" id="add_cscinspectiontank_comments" placeholder="Enter Comments"></textarea>
				</div>
				
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_platemark" class="form-label text-uppercase fw-bold me-3">Plate Marking/Stamping:</label>
				<div class="input-group">
					<input type="text" class="form-control"  v-model="cscinspectiontankFormObj.platemark" id="add_cscinspectiontank_platemark" placeholder="Enter Platemark" >
				</div>
			</div>
			<div class="col-md-6">
				<label for="add_cscinspectiontank_surveyor_id" class="form-label text-uppercase fw-bold me-3">Surveyor Id</label>
				<div>
					<multiselect v-model="cscinspectiontankFormObj.surveyor_id" :options="allSurveyorIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
			</div>
		</div>
		
		<div class="row justify-content-center" v-if="!isModal">
			<div class="col-5">
				<a class="btn btn-success w-100" @click="saveCscInspectionTank()">Save</a>
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
		company_id:'',
		inspection_date:'',
		inspection_location_id:'',
		operator_lessor:'',
		tank_no:'',
		mfg:'',
		mfg_sr_no:'',
		csc:'',
		uk_dot:'',
		imdg:'',
		us_dot:'',
		rid:'',
		aar:'',
		bam:'',
		tc_impact:'',
		tir:'',
		uic:'',
		fra:'',
		tank_mfg_year:'',
		tank_max_g_wt:'',
		tank_tare_wt:'',
		tank_capacity:'',
		tank_desgin_temp:'',
		tank_mawp_bar:'',
		tank_test_press_bar:'',
		tank_top_discharge:'',
		tank_bottom_discharge:'',
		tank_no_of_closure:'',
		tank_shell_material:'',
		tank_shell_thickness:'',
		tank_heads_material:'',
		tank_head_thickness:'',
		tank_iso_type:'',
		insp_init_hydro_date:'',
		insp_hydro_witness:'',
		insp_last_hydro_date:'',
		insp_last_hydro_witness:'',
		insp_date:'',
		next_insp_date:'',
		insp_inter_perfom_na:'',
		insp_inter_perfom_in:'',
		insp_inter_perfom_remark:'',
		insp_ext_perfom_na:'',
		insp_ext_perfom_in:'',
		insp_ext_perfom_remark:'',
		insp_perfom_date_na:'',
		insp_perfom_date_in:'',
		insp_perfom_date_remark:'',
		insp_perfom_pressure_bar_na:'',
		insp_perfom_pressure_bar_in:'',
		insp_perfom_pressure_bar_remark:'',
		insp_perfom_fittin_na:'',
		insp_perfom_fittin_in:'',
		insp_perfom_fittin_remark:'',
		insp_perfom_frame_na:'',
		insp_perfom_frame_in:'',
		insp_perfom_frame_remark:'',
		insp_perfom_decals_na:'',
		insp_perfom_decals_in:'',
		insp_perfom_decals_remark:'',
		insp_perfom_steam_na:'',
		insp_perfom_steam_in:'',
		insp_perfom_steam_remark:'',
		p_mfgr_type_1:'',
		p_mfgr_type_2:'',
		p_sr_no_1:'',
		p_sr_no_2:'',
		p_full_flow_rate_1:'',
		p_full_flow_rate_2:'',
		p_operating_press_1:'',
		p_operating_press_2:'',
		p_vacuum_setting_1:'',
		p_vacuum_setting_2:'',
		p_bursting_disc_1:'',
		p_bursting_disc_2:'',
		platemark:'',
		comments:'',
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
		
	}
}
export default {
	name: "CscInspectionTankmaster",
	props: ['current_user_id', 'all_permissions','id', 'isModal', 'cscinspectiontankForAdd', 'reload', 'closed'],
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
			allInspectionLocationIdList: [],
			allSurveyorIdList: [],
			cscinspectiontankFormObj: initialState(),
		}
	},
	validations() {
		return {
			cscinspectiontankFormObj: initialStateValidations()
		};
	},
	
	methods: {
		canceladdedit(event){
			window.location = this.docRoot + '/cscinspectiontank';
		},
		formatDate(date) {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
		async saveCscInspectionTank(event){
			var that = this;
			const result = await that.v$.$validate();
			if (!result) {
				that.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
				console.log(that.v$.$errors);
				return;
			}
			
			if( !that.cscinspectiontankFormObj.action || that.cscinspectiontankFormObj.action == "" )
				that.cscinspectiontankFormObj.action = "details";
			that.cscinspectiontankFormObj.created_by = that.current_user_id;
			
			if (  typeof that.cscinspectiontankFormObj.company_id === 'object' && that.cscinspectiontankFormObj.company_id.id) {
				that.cscinspectiontankFormObj.company_id = that.cscinspectiontankFormObj.company_id.id;
			}
			if (  typeof that.cscinspectiontankFormObj.inspection_location_id === 'object' && that.cscinspectiontankFormObj.inspection_location_id.id) {
				that.cscinspectiontankFormObj.inspection_location_id = that.cscinspectiontankFormObj.inspection_location_id.id;
			}
			if (  typeof that.cscinspectiontankFormObj.surveyor_id === 'object' && that.cscinspectiontankFormObj.surveyor_id.id) {
				that.cscinspectiontankFormObj.surveyor_id = that.cscinspectiontankFormObj.surveyor_id.id;
			}
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/cscinspectiontank/save', { cscinspectiontank: that.cscinspectiontankFormObj }).then(async function (response) {
				that.closeSwal();
				var status = response.data.status;
				if( status == 1 ){
					// Set the ID so that duplicate records will not be created
					that.cscinspectiontankFormObj.id = response.data.id;
					that.showToast('CSC Inspection Tank saved successfully', 'success', 'bottom', 3000);
					setTimeout(() => {
						window.location = that.docRoot + "/cscinspectiontank/";
						that.showLoading("Loading ...");
					}, 1500);
				}
				else{
					that.showErrors("CSC Inspection Tank could not be saved successfully.", response.data.messages, "bottom", 3000);
				}
			})
			.catch(function (error) {
				console.log(error);
				that.closeSwal();
				that.showToast("CSC Inspection Tank could not be saved successfully.", "error", "bottom", 3000);
			});
		},
		
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				this.mode = "edit";
				
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/cscinspectiontank/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.cscinspectiontankFormObj = Object.assign({}, response.data);
						
						
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
		let _allInspectionLocationIdList = await this.loadAllInspectionLocation(this.docRoot+'/api/inspectionlocation/get', 'post', {});
		if(Array.isArray(_allInspectionLocationIdList) && _allInspectionLocationIdList.length > 0){
			this.allInspectionLocationIdList = _allInspectionLocationIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allSurveyorIdList = await this.loadAllSurveyor(this.docRoot+'/api/surveyor/get', 'post', {});
		if(Array.isArray(_allSurveyorIdList) && _allSurveyorIdList.length > 0){
			this.allSurveyorIdList = _allSurveyorIdList.map(x => {return { id: x.id, text: x.name }});
		}
		if (this.cscinspectiontankFormObj.company_id) {
			if (Array.isArray(this.allCompanyIdList) && this.allCompanyIdList.length > 0) {
				let _allRelationList = this.allCompanyIdList;
				let relationId = parseInt(this.cscinspectiontankFormObj.company_id);
				this.cscinspectiontankFormObj.company_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.cscinspectiontankFormObj.inspection_location_id) {
			if (Array.isArray(this.allInspectionLocationIdList) && this.allInspectionLocationIdList.length > 0) {
				let _allRelationList = this.allInspectionLocationIdList;
				let relationId = parseInt(this.cscinspectiontankFormObj.inspection_location_id);
				this.cscinspectiontankFormObj.inspection_location_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		if (this.cscinspectiontankFormObj.surveyor_id) {
			if (Array.isArray(this.allSurveyorIdList) && this.allSurveyorIdList.length > 0) {
				let _allRelationList = this.allSurveyorIdList;
				let relationId = parseInt(this.cscinspectiontankFormObj.surveyor_id);
				this.cscinspectiontankFormObj.surveyor_id = _allRelationList.find(item => item.id === relationId);
			}
		}
		
	}
}
</script>