<template lang="">
	<div class="mb-4">
		<div class="row mb-3">
			<div class="col-4 border border-dark text-center p-2">X = Fitted</div>
			<div class="col-4 border border-dark text-center p-2">Xx = Fitted With Comments</div>
			<div class="col-4 border border-dark text-center p-2">N/A = Not Applicable</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Bottom Discharge</h5>
			</div>
		</div>
		<div class="row mb-2 gap-2">
			<div class="col-md-1 col-4">
				<div>
					<span v-if="readOnhireMain.bd_x">{{ readOnhireMain.bd_x }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class="col-md-2 col-4">
				<div>
					<span v-if="readOnhireMain.bd_x_value == '1'">Fortvale</span>
					<span v-else-if="readOnhireMain.bd_x_value == '2'">Perolo</span>
					<span v-else-if="readOnhireMain.bd_x_value == '3'">Pelican</span>
					<template v-else-if="readOnhireMain.bd_x_value == '0'">
						<span>Other - </span>
						<span v-if="readOnhireMain.bd_other">{{ readOnhireMain.bd_other }}</span>
						<span v-else><i>Not specified</i></span>
					</template>
				</div>
			</div>
			<div class="col-md-2 col-4">
				<div>
					<span v-if="readOnhireMain.bd_butterfly_ball == '1'">Butterfly</span>
					<span v-else-if="readOnhireMain.bd_butterfly_ball == '2'">Ball</span>
					<span v-else-if="readOnhireMain.bd_butterfly_ball == '-1'">NA</span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">SN:</label>
				<div>
					<span v-if="readOnhireMain.bd_butterfly_ball_sn">{{ readOnhireMain.bd_butterfly_ball_sn }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
				<div>
					<span v-if="readOnhireMain.bd_tir_strip == '1'">Yes</span>
					<span v-if="readOnhireMain.bd_tir_strip == '0'">No</span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Spacers</label>
				<div>
					<span v-if="readOnhireMain.bd_spacers == '1'">0</span>
					<span v-else-if="readOnhireMain.bd_spacers == '2'">1</span>
					<span v-else-if="readOnhireMain.bd_spacers == '3'">2</span>
					<span v-else-if="readOnhireMain.bd_spacers == '4'">3</span>
					<span v-else-if="readOnhireMain.bd_spacers == '5'">4</span>
				</div>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Footvalve</h5>
			</div>
		</div>
		<div class="row mb-2 g-2">
			<div class=" col-md-1 col-4">
				<span v-if="readOnhireMain.fv_x">{{ readOnhireMain.fv_x }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.fv_x_value == '1'">Fort Vale</span>
				<span v-else-if="readOnhireMain.fv_x_value == '2'">Perolo</span>
				<template v-else-if="readOnhireMain.fv_x_value == '0'">
					<span>Other - </span>
					<span v-if="readOnhireMain.fv_other">{{ readOnhireMain.fv_other }}</span>
					<span v-else><i>Not specified</i></span>
				</template>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.fv_option == '1'">Cleanflow</span>
				<span v-else-if="readOnhireMain.fv_option == '2'">Highlift</span>
				<span v-else-if="readOnhireMain.fv_option == '3'">Neatflow</span>
				<span v-else-if="readOnhireMain.fv_option == '4'">Neatco</span>
				<span v-else-if="readOnhireMain.fv_option == '-1'">NA</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
				<div>
					<span v-if="readOnhireMain.fv_tir_strip == '1'">Yes</span>
					<span v-if="readOnhireMain.fv_tir_strip == '0'">No</span>
				</div>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Bottom Outlet Cap/Blank :</h5>
			</div>
		</div>
		<div class="row mb-2">
			<div class=" col-md-1 col-4">
				<span v-if="readOnhireMain.bocp_x">{{ readOnhireMain.bocp_x }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.bocp_x_value == '-1'">NA</span>
				<span v-else-if="readOnhireMain.bocp_x_value == '1'">4 Bolt Blank</span>
				<span v-else-if="readOnhireMain.bocp_x_value == '2'">6 Bolt Blank</span>
				<span v-else-if="readOnhireMain.bocp_x_value == '3'">8 Bolt Blank</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">3" Bsp</label>
				<div>
					<span v-if="readOnhireMain.bocp_3_bsp">{{ readOnhireMain.bocp_3_bsp }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Cap</label>
				<div>
					<span v-if="readOnhireMain.bocp_cap == '-1'">NA</span>
					<span v-else-if="readOnhireMain.bocp_cap == '1'">SS</span>
					<span v-else-if="readOnhireMain.bocp_cap == '2'">ALU</span>
					<span v-else-if="readOnhireMain.bocp_cap == '3'">PVC</span>
					<span v-else-if="readOnhireMain.bocp_cap == '4'">BRASS</span>
					<span v-else><i>Not Specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Remote Trip :</h5>
			</div>
		</div>
		<div class="row mb-2">
			<div class=" col-md-1 col-4">
				<span v-if="readOnhireMain.rt_x">{{ readOnhireMain.rt_x }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.rt_type == '-1'">NA</span>
				<span v-else-if="readOnhireMain.rt_type == '1'">Pull Cable</span>
				<span v-else-if="readOnhireMain.rt_type == '2'">Handle</span>
				<span v-else-if="readOnhireMain.rt_type == '3'">Spring</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Fusible Link</label>
				<div>
					<span v-if="readOnhireMain.rt_fusible_link == '1'">Yes</span>
					<span v-if="readOnhireMain.rt_fusible_link == '0'">No</span>
				</div>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Top Discharge :</h5>
			</div>
		</div>
		<div class="row mb-2 g-2">
			<div class=" col-md-1 col-4">
				<span v-if="readOnhireMain.td_x">{{ readOnhireMain.td_x }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.td_dn">{{ readOnhireMain.td_dn }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.td_dn_value_1 == '-1'">NA</span>
				<span v-else-if="readOnhireMain.td_dn_value_1 == '1'">4 Bolt Blank</span>
				<span v-else-if="readOnhireMain.td_dn_value_1 == '2'">6 Bolt Blank</span>
				<span v-else-if="readOnhireMain.td_dn_value_1 == '3'">8 Bolt Blank</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class=" col-md-2 col-6">
				<span v-if="readOnhireMain.td_dn_value_2 == '1'">Fort Vale</span>
				<span v-else-if="readOnhireMain.td_dn_value_2 == '2'">Perolo</span>
				<span v-else-if="readOnhireMain.td_dn_value_2 == '3'">Pelican</span>
				<template v-else-if="readOnhireMain.td_dn_value_2 == '0'">
					<span>Other</span>
					<span v-if="readOnhireMain.td_dn_other">{{ readOnhireMain.td_dn_other }}</span>
					<span v-else><i>Not specified</i></span>
				</template>
			</div>
			<div class=" col-md-2 col-6">
				<label class="form-label text-uppercase fw-bold m-0">Butterfly Ball</label>
				<div>
					<span v-if="readOnhireMain.td_butterfly_ball == '1'">Butterfly</span>
					<span v-else-if="readOnhireMain.td_butterfly_ball == '2'">Ball</span>
					<span v-else-if="readOnhireMain.td_butterfly_ball == '-1'">NA</span>
					<span v-else><i>Not Specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-1">
			<div class=" col-md-2 col-6">
				<label class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
				<div>
					<span v-if="readOnhireMain.td_tir_strip == '1'">Yes</span>
					<span v-if="readOnhireMain.td_tir_strip == '0'">No</span>
				</div>
			</div>
			<div class=" col-md-2 col-6">
				<label class="form-label text-uppercase fw-bold m-0">Siphon Tube</label>
				<div>
					<span v-if="readOnhireMain.td_siphon_tube == '1'">Yes</span>
					<span v-if="readOnhireMain.td_siphon_tube == '0'">No</span>
				</div>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Top Loading :</h5>
			</div>
		</div>
		<div class="row mb-2 g-2">
			<div class=" col-md-1 col-4">
				<span v-if="readOnhireMain.tl_x">{{ readOnhireMain.tl_x }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.tl_dn">{{ readOnhireMain.tl_dn }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.tl_dn_value_1 == '-1'">NA</span>
				<span v-else-if="readOnhireMain.tl_dn_value_1 == '1'">4 Bolt Blank</span>
				<span v-else-if="readOnhireMain.tl_dn_value_1 == '2'">6 Bolt Blank</span>
				<span v-else-if="readOnhireMain.tl_dn_value_1 == '3'">8 Bolt Blank</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.tl_dn_value_2 == '1'">Fort Vale</span>
				<span v-else-if="readOnhireMain.tl_dn_value_2 == '2'">Perolo</span>
				<span v-else-if="readOnhireMain.tl_dn_value_2 == '3'">Pelican</span>
				<template v-else-if="readOnhireMain.tl_dn_value_2 == '0'">
					<span>Other - </span>
					<span v-if="readOnhireMain.tl_dn_other">{{ readOnhireMain.tl_dn_other }}</span>
					<span v-else><i>Not specified</i></span>
				</template>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Butterfly Ball</label>
				<div>
					<span v-if="readOnhireMain.tl_butterfly_ball == '1'">Butterfly</span>
					<span v-else-if="readOnhireMain.tl_butterfly_ball == '2'">Ball</span>
					<span v-else-if="readOnhireMain.tl_butterfly_ball == '-1'">NA</span>
					<span v-else><i>Not Specified</i></span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
				<div>
					<span v-if="readOnhireMain.tl_tir_strip == '1'">Yes</span>
					<span v-else-if="readOnhireMain.tl_tir_strip == '0'">No</span>
					<span v-else><i>Not Specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Air Vent :</h5>
			</div>
		</div>
		<div class="row mb-2">
			<div class=" col-md-1 col-4">
				<span v-if="readOnhireMain.av_x">{{ readOnhireMain.av_x }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.av_value_inch == '-1'">NA</span>
				<span v-else-if="readOnhireMain.av_value_inch == '1'">3/4 Inch</span>
				<span v-else-if="readOnhireMain.av_value_inch == '2'">1 Inch</span>
				<span v-else-if="readOnhireMain.av_value_inch == '3'">1.5 Inch</span>
				<span v-else-if="readOnhireMain.av_value_inch == '4'">2 Inch</span>
				<span v-else-if="readOnhireMain.av_value_inch == '5'">2.5 Inch</span>
				<span v-else-if="readOnhireMain.av_value_inch == '6'">3 Inch</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.av_value == '1'">Fort Value</span>
				<span v-else-if="readOnhireMain.av_value == '2'">Perolo</span>
				<span v-else-if="readOnhireMain.av_value == '3'">Pelican</span>
				<template v-else-if="readOnhireMain.av_value == '0'">
					<span>Other - </span>
					<span v-if="readOnhireMain.av_other">{{ readOnhireMain.av_other }}</span
					><span v-else><i>Not specified</i></span>
				</template>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.av_butterfly_ball == '1'">Butterfly</span>
				<span v-else-if="readOnhireMain.av_butterfly_ball == '2'">Ball</span>
				<span v-else-if="readOnhireMain.av_butterfly_ball == '-1'">NA</span>
				<span v-else><i>Not Specified</i></span>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Air Vent Connection :</h5>
			</div>
		</div>
		<div class="row mb-2 g-2">
			<div class=" col-md-1 col-4">
				<span v-if="readOnhireMain.avc_type == '-1'">NA</span>
				<span v-else-if="readOnhireMain.avc_type == '1'">Bsp</span>
				<span v-else-if="readOnhireMain.avc_type == '2'">Npt"</span>
				<span v-else-if="readOnhireMain.avc_type == '3'">Quick</span>
				<span v-else-if="readOnhireMain.avc_type == '4'">Flange</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
				<div>
					<span v-if="readOnhireMain.avc_tir_strip == '1'">Yes</span>
					<span v-else-if="readOnhireMain.avc_tir_strip == '0'">No</span>
					<span v-else><i>Not Specified</i></span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Air Vent</label>
				<div>
					<span v-if="readOnhireMain.avc_cap_blank_v1 == '-1'">NA</span>
					<span v-else-if="readOnhireMain.avc_cap_blank_v1 == '1'">Cap</span>
					<span v-else-if="readOnhireMain.avc_cap_blank_v1 == '2'">Blank</span>
					<span v-else><i>Not Specified</i></span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.avc_cap_blank_v2 == '-1'">NA</span>
				<span v-else-if="readOnhireMain.avc_cap_blank_v2 == '1'">4 Bolt Bank</span>
				<span v-else-if="readOnhireMain.avc_cap_blank_v2 == '2'">Cap with Chain</span>
				<span v-else-if="readOnhireMain.avc_cap_blank_v2 == '3'">Cable</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.avc_cap_blank_v3 == '-1'">NA</span>
				<span v-else-if="readOnhireMain.avc_cap_blank_v3 == '1'">SS</span>
				<span v-else-if="readOnhireMain.avc_cap_blank_v3 == '2'">ALU</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class="col-md-3 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Air Pressure Gauge</label>
				<div>
					<span v-if="readOnhireMain.avc_air_pressure_gauge">{{ readOnhireMain.avc_air_pressure_gauge }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>SRV 1 :</h5>
			</div>
		</div>
		<div class="row mb-2 g-2">
			<div class=" col-md-1 col-4">
				<span v-if="readOnhireMain.srv1_x">{{ readOnhireMain.srv1_x }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.srv1_value1 == '1'">Fort Vale</span>
				<span v-else-if="readOnhireMain.srv1_value1 == '2'">Perolo</span>
				<template v-else-if="readOnhireMain.srv1_value1 == '0'">
					Other -
					<span v-if="readOnhireMain.srv1_other">{{ readOnhireMain.srv1_other }}</span
					><span v-else><i>Not specified</i></span>
				</template>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.srv1_value2 == '-1'">NA</span>
				<span v-else-if="readOnhireMain.srv1_value2 == '1'">Flanged</span>
				<span v-else-if="readOnhireMain.srv1_value2 == '2'">Threaded</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.srv1_value3 == '-1'">NA</span>
				<span v-else-if="readOnhireMain.srv1_value3 == '1'">4 Bolt Blank</span>
				<span v-else-if="readOnhireMain.srv1_value3 == '2'">6 Bolt Blank</span>
				<span v-else-if="readOnhireMain.srv1_value3 == '3'">8 Bolt Blank</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class=" col-md-2 col-4 d-flex flex-column flex-md-row gap-2">
				<span class="form-label text-uppercase fw-bold m-0">Pressure</span>
				<span v-if="readOnhireMain.srv1_pressure">{{ readOnhireMain.srv1_pressure }}</span>
				<span v-else><i>-</i></span>
				<span class="form-label text-uppercase fw-bold m-0">Bar</span>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Vac</label>
				<div>
					<span v-if="readOnhireMain.srv1_vac == '-1'">NA</span>
					<span v-else-if="readOnhireMain.srv1_vac == '1'">6 inch Hg</span>
					<span v-else-if="readOnhireMain.srv1_vac == '2'">6.2 inch Hg</span>
					<span v-else><i>Not Specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2">
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Serial</label>
				<div>
					<span v-if="readOnhireMain.srv1_serial">{{ readOnhireMain.srv1_serial }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
				<div>
					<span v-if="readOnhireMain.srv1_tir_strip == '1'">Yes</span>
					<span v-if="readOnhireMain.srv1_tir_strip == '0'">No</span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Flame Screen</label>
				<div>
					<span v-if="readOnhireMain.srv1_flame_screen == '1'">Yes</span>
					<span v-if="readOnhireMain.srv1_flame_screen == '0'">No</span>
				</div>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Srv 2 :</h5>
			</div>
		</div>
		<div class="row mb-2 g-2">
			<div class=" col-md-1 col-4">
				<span v-if="readOnhireMain.srv2_x">{{ readOnhireMain.srv2_x }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.srv2_value1 == '1'">Fort Vale</span>
				<span v-else-if="readOnhireMain.srv2_value1 == '2'">Perolo</span>
				<template v-else-if="readOnhireMain.srv2_value1 == '0'">
					Other -
					<span v-if="readOnhireMain.srv2_other">{{ readOnhireMain.srv2_other }}</span
					><span v-else><i>Not specified</i></span>
				</template>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.srv2_value2 == '-1'">NA</span>
				<span v-else-if="readOnhireMain.srv2_value2 == '1'">Flanged</span>
				<span v-else-if="readOnhireMain.srv2_value2 == '2'">Threaded</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.srv2_value3 == '-1'">NA</span>
				<span v-else-if="readOnhireMain.srv2_value3 == '1'">4 Bolt Blank</span>
				<span v-else-if="readOnhireMain.srv2_value3 == '2'">6 Bolt Blank</span>
				<span v-else-if="readOnhireMain.srv2_value3 == '3'">8 Bolt Blank</span>
				<span v-else><i>Not Specified</i></span>
			</div>
			<div class=" col-md-2 col-8 d-flex gap-2">
				<label class="form-label text-uppercase fw-bold m-0">Pressure</label>
				<span v-if="readOnhireMain.srv2_pressure">{{ readOnhireMain.srv2_pressure }}</span>
				<span v-else><i>-</i></span>
				<label class="form-label text-uppercase fw-bold m-0">Bar</label>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Vac</label>
				<div>
					<span v-if="readOnhireMain.srv2_vac == '-1'">NA</span>
					<span v-else-if="readOnhireMain.srv2_vac == '1'">6 inch Hg</span>
					<span v-else-if="readOnhireMain.srv2_vac == '2'">6.2 inch Hg</span>
					<span v-else><i>Not Specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2">
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Serial</label>
				<div>
					<span v-if="readOnhireMain.srv2_serial">{{ readOnhireMain.srv2_serial }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
				<div>
					<span v-if="readOnhireMain.srv2_tir_strip == '1'">Yes</span>
					<span v-if="readOnhireMain.srv2_tir_strip == '0'">No</span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Flame Screen</label>
				<div>
					<span v-if="readOnhireMain.srv2_flame_screen == '1'">Yes</span>
					<span v-if="readOnhireMain.srv2_flame_screen == '0'">No</span>
				</div>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Rupture Disc 1 :</h5>
			</div>
		</div>
		<div class="row mb-2">
			<div class=" col-md-2 col-6">
				<span v-if="readOnhireMain.rd1_x">{{ readOnhireMain.rd1_x }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-6">
				<label class="form-label text-uppercase fw-bold m-0">Manufacturer</label>
				<div>
					<span v-if="readOnhireMain.rd1_manufacture">{{ readOnhireMain.rd1_manufacturer }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class=" col-md-2 col-6">
				<label class="form-label text-uppercase fw-bold m-0">Bar</label>
				<div>
					<span v-if="readOnhireMain.rd1_bar">{{ readOnhireMain.rd1_bar }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class=" col-md-2 col-6 d-flex gap-2">
				<label class="form-label text-uppercase fw-bold m-0">Size</label>
				<span v-if="readOnhireMain.rd1_size">{{ readOnhireMain.rd1_size }}</span>
				<span v-else><i>Not specified</i></span>
				<label class="form-label text-uppercase fw-bold m-0">"/mm</label>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Rupture Disc 2 :</h5>
			</div>
		</div>
		<div class="row mb-2">
			<div class=" col-md-2 col-62">
				<span v-if="readOnhireMain.rd2_x">{{ readOnhireMain.rd2_x }}</span>
				<span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-62">
				<label class="form-label text-uppercase fw-bold m-0">Manufacturer</label>
				<div>
					<span v-if="readOnhireMain.rd2_manufacture">{{ readOnhireMain.rd2_manufacturer }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class=" col-md-2 col-62">
				<label class="form-label text-uppercase fw-bold m-0">Bar</label>
				<div>
					<span v-if="readOnhireMain.rd2_bar">{{ readOnhireMain.rd2_bar }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
			<div class=" col-md-2 col-62 d-flex gap-2">
				<label class="form-label text-uppercase fw-bold m-0">Size</label>
				<span v-if="readOnhireMain.rd2_size">{{ readOnhireMain.rd2_size }}</span>
				<span v-else><i>-</i></span>
				<label class="form-label text-uppercase fw-bold m-0">"/mm</label>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Srv 1 Manometer :</h5>
			</div>
		</div>
		<div class="row mb-2">
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.srv1_mano_x">{{ readOnhireMain.srv1_mano_x }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.srv1_mano_value1">{{ readOnhireMain.srv1_mano_value1 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Bar</label>
				<div>
					<span v-if="readOnhireMain.srv1_mano_bar">{{ readOnhireMain.srv1_mano_bar }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Srv 2 Manometer :</h5>
			</div>
		</div>
		<div class="row mb-2">
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.srv2_mano_x">{{ readOnhireMain.srv2_mano_x }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<span v-if="readOnhireMain.srv2_mano_value">{{ readOnhireMain.srv2_mano_value }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Bar</label>
				<div>
					<span v-if="readOnhireMain.srv2_mano_bar">{{ readOnhireMain.srv2_mano_bar }}</span
					><span v-else><i>Not specified</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-1 pt-2 border-top">
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Gps</label>
			</div>
			<div class=" col-md-2 col-4">
				<div>
					<span v-if="readOnhireMain.gps == '1'">Yes</span>
					<span v-if="readOnhireMain.gps == '0'">No</span>
				</div>
			</div>
			<div class=" col-md-2 col-4">
				<label class="form-label text-uppercase fw-bold m-0">Camera</label>
			</div>
			<div class=" col-md-2 col-4">
				<div>
					<span v-if="readOnhireMain.camera == '1'">Yes</span>
					<span v-if="readOnhireMain.camera == '0'">No</span>
				</div>
			</div>
		</div>
	</div>
</template>
<script setup>
	import {ref, watch} from "vue";
	const props = defineProps({
		mainObject: {
			type: Object,
			required: true
		}
	});
	let readOnhireMain = ref({});
	watch(
		() => props.mainObject?.refresh,
		(newValue, oldValue) => {
			if (newValue == true) {
				readOnhireMain.value = {...props.mainObject};
			}
		},
		{immediate: true, deep: true}
	);
</script>
<style lang=""></style>
