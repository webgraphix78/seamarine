<template>
	<div id="cscinspectiontank-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_cscinspectiontank_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/cscinspectiontank'" role="button"><i class="ph ph-arrow-left"></i>Back to list</a>
					<h5 class="m-0 text-capitalize">View csc inspection tank</h5>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Company Id</label>
				<div>
					<span v-if='readCscInspectionTank.rel_company_id?.name'>{{ readCscInspectionTank.rel_company_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Date</label>
				<div>
					<span v-if='readCscInspectionTank.inspection_date'>{{ readCscInspectionTank.inspection_date }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Inspection Location Id</label>
				<div>
					<span v-if='readCscInspectionTank.rel_inspection_location_id?.name'>{{ readCscInspectionTank.rel_inspection_location_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Operator Lessor</label>
				<div>
					<span v-if='readCscInspectionTank.operator_lessor'>{{ readCscInspectionTank.operator_lessor }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Tank No</label>
				<div>
					<span v-if='readCscInspectionTank.tank_no'>{{ readCscInspectionTank.tank_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Mfg</label>
				<div>
					<span v-if='readCscInspectionTank.mfg'>{{ readCscInspectionTank.mfg }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Mfg Sr No</label>
				<div>
					<span v-if='readCscInspectionTank.mfg_sr_no'>{{ readCscInspectionTank.mfg_sr_no }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-12">
				<h5 class="m-0 fw-bold">Applicable Regulations. Enter initial approval No. as applicable</h5>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Csc</label>
				<div>
					<span v-if='readCscInspectionTank.csc'>{{ readCscInspectionTank.csc }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Uk Dot</label>
				<div>
					<span v-if='readCscInspectionTank.uk_dot'>{{ readCscInspectionTank.uk_dot }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Imdg</label>
				<div>
					<span v-if='readCscInspectionTank.imdg'>{{ readCscInspectionTank.imdg }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Us Dot</label>
				<div>
					<span v-if='readCscInspectionTank.us_dot'>{{ readCscInspectionTank.us_dot }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Rid</label>
				<div>
					<span v-if='readCscInspectionTank.rid'>{{ readCscInspectionTank.rid }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Aar</label>
				<div>
					<span v-if='readCscInspectionTank.aar'>{{ readCscInspectionTank.aar }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Bam</label>
				<div>
					<span v-if='readCscInspectionTank.bam'>{{ readCscInspectionTank.bam }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Tc Impact</label>
				<div>
					<span v-if='readCscInspectionTank.tc_impact'>{{ readCscInspectionTank.tc_impact }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Tir</label>
				<div>
					<span v-if='readCscInspectionTank.tir'>{{ readCscInspectionTank.tir }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Uic</label>
				<div>
					<span v-if='readCscInspectionTank.uic'>{{ readCscInspectionTank.uic }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Fra</label>
				<div>
					<span v-if='readCscInspectionTank.fra'>{{ readCscInspectionTank.fra }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-5">
				<div class='row g-4'>
					<div class="col-12">
						<h5 class="m-0 fw-bold">Tank Information</h5>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Mfg Year</label>
						<div>
							<span v-if='readCscInspectionTank.tank_mfg_year'>{{ readCscInspectionTank.tank_mfg_year }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Max G Wt</label>
						<div>
							<span v-if='readCscInspectionTank.tank_max_g_wt'>{{ readCscInspectionTank.tank_max_g_wt }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Tare Wt</label>
						<div>
							<span v-if='readCscInspectionTank.tank_tare_wt'>{{ readCscInspectionTank.tank_tare_wt }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Capacity</label>
						<div>
							<span v-if='readCscInspectionTank.tank_capacity'>{{ readCscInspectionTank.tank_capacity }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Desgin Temp</label>
						<div>
							<span v-if='readCscInspectionTank.tank_desgin_temp'>{{ readCscInspectionTank.tank_desgin_temp }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Mawp Bar</label>
						<div>
							<span v-if='readCscInspectionTank.tank_mawp_bar'>{{ readCscInspectionTank.tank_mawp_bar }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Test Press Bar</label>
						<div>
							<span v-if='readCscInspectionTank.tank_test_press_bar'>{{ readCscInspectionTank.tank_test_press_bar }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Top Discharge</label>
						<div>
							<span v-if='readCscInspectionTank.tank_top_discharge'>{{ readCscInspectionTank.tank_top_discharge }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Bottom Discharge</label>
						<div>
							<span v-if='readCscInspectionTank.tank_bottom_discharge'>{{ readCscInspectionTank.tank_bottom_discharge }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank No Of Closure</label>
						<div>
							<span v-if='readCscInspectionTank.tank_no_of_closure'>{{ readCscInspectionTank.tank_no_of_closure }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Shell Material</label>
						<div>
							<span v-if='readCscInspectionTank.tank_shell_material'>{{ readCscInspectionTank.tank_shell_material }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Shell Thickness</label>
						<div>
							<span v-if='readCscInspectionTank.tank_shell_thickness'>{{ readCscInspectionTank.tank_shell_thickness }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Heads Material</label>
						<div>
							<span v-if='readCscInspectionTank.tank_heads_material'>{{ readCscInspectionTank.tank_heads_material }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Head Thickness</label>
						<div>
							<span v-if='readCscInspectionTank.tank_head_thickness'>{{ readCscInspectionTank.tank_head_thickness }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label text-uppercase fw-bold m-0">Tank Iso Type</label>
						<div>
							<span v-if='readCscInspectionTank.tank_iso_type'>{{ readCscInspectionTank.tank_iso_type }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row mb-4">
					<div class="col-12">
						<h5 class="m-0 fw-bold">Inspection Dates (mm/yy)</h5>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col">
						<label class="form-label text-uppercase fw-bold m-0">Insp Init Hydro Date</label>
						<div>
							<span v-if='readCscInspectionTank.insp_init_hydro_date'>{{ readCscInspectionTank.insp_init_hydro_date }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col">
						<label class="form-label text-uppercase fw-bold m-0">Insp Hydro Witness</label>
						<div>
							<span v-if='readCscInspectionTank.insp_hydro_witness'>{{ readCscInspectionTank.insp_hydro_witness }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col">
						<label class="form-label text-uppercase fw-bold m-0">Insp Last Hydro Date</label>
						<div>
							<span v-if='readCscInspectionTank.insp_last_hydro_date'>{{ readCscInspectionTank.insp_last_hydro_date }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col">
						<label class="form-label text-uppercase fw-bold m-0">Insp Last Hydro Witness</label>
						<div>
							<span v-if='readCscInspectionTank.insp_last_hydro_witness'>{{ readCscInspectionTank.insp_last_hydro_witness }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col">
						<label class="form-label text-uppercase fw-bold m-0">Insp Date</label>
						<div>
							<span v-if='readCscInspectionTank.insp_date'>{{ readCscInspectionTank.insp_date }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col">
						<label class="form-label text-uppercase fw-bold m-0">Next Insp Date</label>
						<div>
							<span v-if='readCscInspectionTank.next_insp_date'>{{ readCscInspectionTank.next_insp_date }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3 col-12">
						<h5 class="fw-bold text-center">Inspections Performed</h5>
					</div>
					<div class="col-md-3 col-4">
						<h5 class="fw-bold text-center">N/A</h5>
					</div>
					<div class="col-md-3 col-4">
						<h5 class="fw-bold text-center">In Order</h5>
					</div>
					<div class="col-md-3 col-4">
						<h5 class="fw-bold text-center">See Comments</h5>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-3 col-12 ">
						<label class="form-label text-uppercase fw-bold">Internal Inspection</label>
					</div>
					<div class="col-md-3 col-4">
						<!-- <label class="form-label text-uppercase fw-bold m-0">Insp Inter Perfom Na</label> -->
						<div>
							<span v-if='readCscInspectionTank.insp_inter_perfom_na'>{{ readCscInspectionTank.insp_inter_perfom_na }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<!-- <label class="form-label text-uppercase fw-bold m-0">Insp Inter Perfom In</label> -->
						<div>
							<span v-if='readCscInspectionTank.insp_inter_perfom_in'>{{ readCscInspectionTank.insp_inter_perfom_in }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<!-- <label class="form-label text-uppercase fw-bold m-0">Insp Inter Perfom Remark</label> -->
						<div>
							<span v-if='readCscInspectionTank.insp_inter_perfom_remark'>{{ readCscInspectionTank.insp_inter_perfom_remark }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-3 col-12 ">
						<label class="form-label text-uppercase fw-bold">External Inspection</label>
					</div>
					<div class="col-md-3 col-4">
						<!-- <label class="form-label text-uppercase fw-bold m-0">Insp Ext Perfom Na</label> -->
						<div>
							<span v-if='readCscInspectionTank.insp_ext_perfom_na'>{{ readCscInspectionTank.insp_ext_perfom_na }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<!-- <label class="form-label text-uppercase fw-bold m-0">Insp Ext Perfom In</label> -->
						<div>
							<span v-if='readCscInspectionTank.insp_ext_perfom_in'>{{ readCscInspectionTank.insp_ext_perfom_in }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<!-- <label class="form-label text-uppercase fw-bold m-0">Insp Ext Perfom Remark</label> -->
						<div>
							<span v-if='readCscInspectionTank.insp_ext_perfom_remark'>{{ readCscInspectionTank.insp_ext_perfom_remark }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-3 col-12 ">
						<label class="form-label text-uppercase fw-bold">Date</label>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Date Na</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_date_na'>{{ readCscInspectionTank.insp_perfom_date_na }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Date In</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_date_in'>{{ readCscInspectionTank.insp_perfom_date_in }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Date Remark</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_date_remark'>{{ readCscInspectionTank.insp_perfom_date_remark }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-3 col-12 ">
						<label class="form-label text-uppercase fw-bold">Pressure (Bar)</label>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Pressure Bar Na</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_pressure_bar_na'>{{ readCscInspectionTank.insp_perfom_pressure_bar_na }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Pressure Bar In</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_pressure_bar_in'>{{ readCscInspectionTank.insp_perfom_pressure_bar_in }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Pressure Bar Remark</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_pressure_bar_remark'>{{ readCscInspectionTank.insp_perfom_pressure_bar_remark }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-3 col-12 ">
						<label class="form-label text-uppercase fw-bold">Fitting Inspection</label>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Fittin Na</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_fittin_na'>{{ readCscInspectionTank.insp_perfom_fittin_na }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Fittin In</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_fittin_in'>{{ readCscInspectionTank.insp_perfom_fittin_in }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Fittin Remark</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_fittin_remark'>{{ readCscInspectionTank.insp_perfom_fittin_remark }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-3 col-12 ">
						<label class="form-label text-uppercase fw-bold">Frame Inspection</label>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Frame Na</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_frame_na'>{{ readCscInspectionTank.insp_perfom_frame_na }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Frame In</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_frame_in'>{{ readCscInspectionTank.insp_perfom_frame_in }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
					<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Frame Remark</label>
					<div>
						<span v-if='readCscInspectionTank.insp_perfom_frame_remark'>{{ readCscInspectionTank.insp_perfom_frame_remark }}</span><span v-else><i>Not specified</i></span>
					</div>
				</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-3 col-12 ">
						<label class="form-label text-uppercase fw-bold">Decals Inspection</label>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Decals Na</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_decals_na'>{{ readCscInspectionTank.insp_perfom_decals_na }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Decals In</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_decals_in'>{{ readCscInspectionTank.insp_perfom_decals_in }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Decals Remark</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_decals_remark'>{{ readCscInspectionTank.insp_perfom_decals_remark }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
				<div class='row mb-4'>
					<div class="col-md-3 col-12 ">
						<label class="form-label text-uppercase fw-bold">Steam Coils Test Pressure (Bar):</label>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Steam Na</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_steam_na'>{{ readCscInspectionTank.insp_perfom_steam_na }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Steam In</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_steam_in'>{{ readCscInspectionTank.insp_perfom_steam_in }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
					<div class="col-md-3 col-4">
						<label class="form-label text-uppercase fw-bold m-0">Insp Perfom Steam Remark</label>
						<div>
							<span v-if='readCscInspectionTank.insp_perfom_steam_remark'>{{ readCscInspectionTank.insp_perfom_steam_remark }}</span><span v-else><i>Not specified</i></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Mfgr Type 1</label>
				<div>
					<span v-if='readCscInspectionTank.p_mfgr_type_1'>{{ readCscInspectionTank.p_mfgr_type_1 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Mfgr Type 2</label>
				<div>
					<span v-if='readCscInspectionTank.p_mfgr_type_2'>{{ readCscInspectionTank.p_mfgr_type_2 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Sr No 1</label>
				<div>
					<span v-if='readCscInspectionTank.p_sr_no_1'>{{ readCscInspectionTank.p_sr_no_1 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Sr No 2</label>
				<div>
					<span v-if='readCscInspectionTank.p_sr_no_2'>{{ readCscInspectionTank.p_sr_no_2 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Full Flow Rate 1</label>
				<div>
					<span v-if='readCscInspectionTank.p_full_flow_rate_1'>{{ readCscInspectionTank.p_full_flow_rate_1 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Full Flow Rate 2</label>
				<div>
					<span v-if='readCscInspectionTank.p_full_flow_rate_2'>{{ readCscInspectionTank.p_full_flow_rate_2 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Operating Press 1</label>
				<div>
					<span v-if='readCscInspectionTank.p_operating_press_1'>{{ readCscInspectionTank.p_operating_press_1 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Operating Press 2</label>
				<div>
					<span v-if='readCscInspectionTank.p_operating_press_2'>{{ readCscInspectionTank.p_operating_press_2 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Vacuum Setting 1</label>
				<div>
					<span v-if='readCscInspectionTank.p_vacuum_setting_1'>{{ readCscInspectionTank.p_vacuum_setting_1 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Vacuum Setting 2</label>
				<div>
					<span v-if='readCscInspectionTank.p_vacuum_setting_2'>{{ readCscInspectionTank.p_vacuum_setting_2 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Bursting Disc 1</label>
				<div>
					<span v-if='readCscInspectionTank.p_bursting_disc_1'>{{ readCscInspectionTank.p_bursting_disc_1 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">P Bursting Disc 2</label>
				<div>
					<span v-if='readCscInspectionTank.p_bursting_disc_2'>{{ readCscInspectionTank.p_bursting_disc_2 }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Platemark</label>
				<div>
					<span v-if='readCscInspectionTank.platemark'>{{ readCscInspectionTank.platemark }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Comments</label>
				<div>
					<span v-if='readCscInspectionTank.comments'>{{ readCscInspectionTank.comments }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class='row mb-4'>
			<div class="col">
				<label class="form-label text-uppercase fw-bold m-0">Surveyor Id</label>
				<div>
					<span v-if='readCscInspectionTank.rel_surveyor_id?.name'>{{ readCscInspectionTank.rel_surveyor_id.name }}</span><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>

	</div>
</template>
<script>
export default {
	name: "CscInspectionTankmaster",
	props: ['current_user_id', 'all_permissions','id','isModal', 'readCscInspectionTank'],
	data(){
		return{
			currentUser: siteUserObject,
			readCscInspectionTank: {},
			allCompanyIdList: [],
			allInspectionLocationIdList: [],
			allSurveyorIdList: [],
		}
	},
	methods: {
		cancelAddEdit(event){
			window.location = this.docRoot + '/cscinspectiontank';
		},
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/cscinspectiontank/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.readCscInspectionTank = Object.assign({}, response.data);
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
		}
	}
}
</script>
