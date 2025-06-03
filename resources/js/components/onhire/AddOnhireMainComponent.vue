<template lang="">
	<div id="add-onhire-main">
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
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-4">
				<input type="text" class="form-control" v-model="onhiremain.bd_x" id="add_onhiremain_bd_x" />
			</div>
			<div class="col-md-2 col-4">
				<select class="form-select" v-model="onhiremain.bd_x_value" id="add_bd_x_value">
					<optgroup v-if="allBdXValueList" label="Choose Bd X Value">
						<template v-for="bdXValue in allBdXValueList" :key="bdXValue.id">
							<option :value="bdXValue.id">{{ bdXValue.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-4">
				<input type="text" class="form-control" v-model="onhiremain.bd_other" id="add_onhiremain_bd_other" :disabled="onhiremain.bd_x_value != '0'" />
			</div>
			<div class="col-md-2 col-4">
				<select class="form-select" v-model="onhiremain.bd_butterfly_ball" id="add_bd_butterfly_ball">
					<optgroup v-if="allBdButterflyBallList" label="Choose Bd Butterfly Ball">
						<template v-for="bdButterflyBall in allBdButterflyBallList" :key="bdButterflyBall.id">
							<option :value="bdButterflyBall.id">{{ bdButterflyBall.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-4">
				<input type="text" class="form-control" v-model="onhiremain.bd_butterfly_ball_sn" id="add_onhiremain_bd_butterfly_ball_sn" />
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_bd_tir_strip" class="form-label text-uppercase fw-bold m-0">Tir Strips</label>
			</div>
			<div class="col-md-2 col-6">
				<div>
					<select class="form-select" v-model="onhiremain.bd_tir_strip" id="add_bd_tir_strip">
						<optgroup v-if="allBdTirStripList" label="Choose Bd Tir Strip">
							<template v-for="bdTirStrip in allBdTirStripList" :key="bdTirStrip.id">
								<option :value="bdTirStrip.id">{{ bdTirStrip.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_bd_spacers" class="form-label text-uppercase fw-bold m-0">Spacers</label>
			</div>
			<div class="col-md-2 col-6">
				<div>
					<select class="form-select" v-model="onhiremain.bd_spacers" id="add_bd_spacers">
						<optgroup v-if="allBdSpacersList" label="Choose Bd Spacers">
							<template v-for="bdSpacers in allBdSpacersList" :key="bdSpacers.id">
								<option :value="bdSpacers.id">{{ bdSpacers.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Footvalve</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.fv_x" id="add_onhiremain_fv_x" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.fv_x_value" id="add_fv_x_value">
					<optgroup v-if="allFvXValueList" label="Choose Fv X Value">
						<template v-for="fvXValue in allFvXValueList" :key="fvXValue.id">
							<option :value="fvXValue.id">{{ fvXValue.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.fv_other" id="add_onhiremain_fv_other" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.fv_option" id="add_fv_option">
					<optgroup v-if="allFvOptionList" label="Choose Fv Option">
						<template v-for="fvOption in allFvOptionList" :key="fvOption.id">
							<option :value="fvOption.id">{{ fvOption.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_fv_tir_strip" class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.fv_tir_strip" id="add_fv_tir_strip">
					<optgroup v-if="allFvTirStripList" label="Choose Fv Tir Strip">
						<template v-for="fvTirStrip in allFvTirStripList" :key="fvTirStrip.id">
							<option :value="fvTirStrip.id">{{ fvTirStrip.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Bottom Outlet Cap/Blank :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.bocp_x" id="add_onhiremain_bocp_x" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.bocp_x_value" id="add_bocp_x_value">
					<optgroup v-if="allBocpXValueList" label="Choose Bocp X Value">
						<template v-for="bocpXValue in allBocpXValueList" :key="bocpXValue.id">
							<option :value="bocpXValue.id">{{ bocpXValue.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_bocp_3_bsp" class="form-label text-uppercase fw-bold m-0">3" Bsp</label>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.bocp_3_bsp" id="add_onhiremain_bocp_3_bsp" />
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_bocp_cap" class="form-label text-uppercase fw-bold m-0">Cap</label>
			</div>
			<div class="col-md-2 col-6">
				<div>
					<select class="form-select" v-model="onhiremain.bocp_cap" id="add_bocp_cap">
						<optgroup v-if="allBocpCapList" label="Choose Bocp Cap">
							<template v-for="bocpCap in allBocpCapList" :key="bocpCap.id">
								<option :value="bocpCap.id">{{ bocpCap.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Remote Trip :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.rt_x" id="add_onhiremain_rt_x" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.rt_type" id="add_rt_type">
					<optgroup v-if="allRtTypeList" label="Choose Rt Type">
						<template v-for="rtType in allRtTypeList" :key="rtType.id">
							<option :value="rtType.id">{{ rtType.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_rt_fusible_link" class="form-label text-uppercase fw-bold m-0">Fusible Link</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.rt_fusible_link" id="add_rt_fusible_link">
					<optgroup v-if="allRtFusibleLinkList" label="Choose Rt Fusible Link">
						<template v-for="rtFusibleLink in allRtFusibleLinkList" :key="rtFusibleLink.id">
							<option :value="rtFusibleLink.id">{{ rtFusibleLink.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Top Discharge :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.td_x" id="add_onhiremain_td_x" />
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.td_dn" id="add_onhiremain_td_dn" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.td_dn_value_1" id="add_td_dn_value_1">
					<optgroup v-if="allTdDnValue1List" label="Choose Td Dn Value 1">
						<template v-for="tdDnValue1 in allTdDnValue1List" :key="tdDnValue1.id">
							<option :value="tdDnValue1.id">{{ tdDnValue1.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.td_dn_value_2" id="add_td_dn_value_2">
					<optgroup v-if="allTdDnValue2List" label="Choose Td Dn Value 2">
						<template v-for="tdDnValue2 in allTdDnValue2List" :key="tdDnValue2.id">
							<option :value="tdDnValue2.id">{{ tdDnValue2.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.td_dn_other" id="add_onhiremain_td_dn_other" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.td_butterfly_ball" id="add_td_butterfly_ball">
					<optgroup v-if="allTdButterflyBallList" label="Choose Td Butterfly Ball">
						<template v-for="tdButterflyBall in allTdButterflyBallList" :key="tdButterflyBall.id">
							<option :value="tdButterflyBall.id">{{ tdButterflyBall.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_td_tir_strip" class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
			</div>
			<div class="col-md-2 col-6">
				<div>
					<select class="form-select" v-model="onhiremain.td_tir_strip" id="add_td_tir_strip">
						<optgroup v-if="allTdTirStripList" label="Choose Td Tir Strip">
							<template v-for="tdTirStrip in allTdTirStripList" :key="tdTirStrip.id">
								<option :value="tdTirStrip.id">{{ tdTirStrip.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_td_siphon_tube" class="form-label text-uppercase fw-bold m-0">Siphon Tube</label>
			</div>
			<div class="col-md-2 col-6">
				<div>
					<select class="form-select" v-model="onhiremain.td_siphon_tube" id="add_td_siphon_tube">
						<optgroup v-if="allTdSiphonTubeList" label="Choose Td Siphon Tube">
							<template v-for="tdSiphonTube in allTdSiphonTubeList" :key="tdSiphonTube.id">
								<option :value="tdSiphonTube.id">{{ tdSiphonTube.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Top Loading :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.tl_x" id="add_onhiremain_tl_x" />
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.tl_dn" id="add_onhiremain_tl_dn" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.tl_dn_value_1" id="add_tl_dn_value_1">
					<optgroup v-if="allTlDnValue1List" label="Choose Tl Dn Value 1">
						<template v-for="tlDnValue1 in allTlDnValue1List" :key="tlDnValue1.id">
							<option :value="tlDnValue1.id">{{ tlDnValue1.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.tl_dn_value_2" id="add_tl_dn_value_2">
					<optgroup v-if="allTlDnValue2List" label="Choose Tl Dn Value 2">
						<template v-for="tlDnValue2 in allTlDnValue2List" :key="tlDnValue2.id">
							<option :value="tlDnValue2.id">{{ tlDnValue2.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.tl_dn_other" id="add_onhiremain_tl_dn_other" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.tl_butterfly_ball" id="add_tl_butterfly_ball">
					<optgroup v-if="allTlButterflyBallList" label="Choose Tl Butterfly Ball">
						<template v-for="tlButterflyBall in allTlButterflyBallList" :key="tlButterflyBall.id">
							<option :value="tlButterflyBall.id">{{ tlButterflyBall.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_tl_tir_strip" class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
			</div>
			<div class="col-md-2 col-6">
				<div>
					<select class="form-select" v-model="onhiremain.tl_tir_strip" id="add_tl_tir_strip">
						<optgroup v-if="allTlTirStripList" label="Choose Tl Tir Strip">
							<template v-for="tlTirStrip in allTlTirStripList" :key="tlTirStrip.id">
								<option :value="tlTirStrip.id">{{ tlTirStrip.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Air Vent :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.av_x" id="add_onhiremain_av_x" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.av_value_inch" id="add_av_value_inch">
					<optgroup v-if="allAvValueInchList" label="Choose Av Value Inch">
						<template v-for="avValueInch in allAvValueInchList" :key="avValueInch.id">
							<option :value="avValueInch.id">{{ avValueInch.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.av_value" id="add_av_value">
					<optgroup v-if="allAvValueList" label="Choose Av Value">
						<template v-for="avValue in allAvValueList" :key="avValue.id">
							<option :value="avValue.id">{{ avValue.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.av_other" id="add_onhiremain_av_other" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.av_butterfly_ball" id="add_av_butterfly_ball">
					<optgroup v-if="allAvButterflyBallList" label="Choose Av Butterfly Ball">
						<template v-for="avButterflyBall in allAvButterflyBallList" :key="avButterflyBall.id">
							<option :value="avButterflyBall.id">{{ avButterflyBall.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Air Vent Connection :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-12">
				<select class="form-select" v-model="onhiremain.avc_type" id="add_avc_type">
					<optgroup v-if="allAvcTypeList" label="Choose Avc Type">
						<template v-for="avcType in allAvcTypeList" :key="avcType.id">
							<option :value="avcType.id">{{ avcType.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_avc_tir_strip" class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.avc_tir_strip" id="add_avc_tir_strip">
					<optgroup v-if="allAvcTirStripList" label="Choose Avc Tir Strip">
						<template v-for="avcTirStrip in allAvcTirStripList" :key="avcTirStrip.id">
							<option :value="avcTirStrip.id">{{ avcTirStrip.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_avc_cap_blank_v1" class="form-label text-uppercase fw-bold m-0">Air Vent</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.avc_cap_blank_v1" id="add_avc_cap_blank_v1">
					<optgroup v-if="allAvcCapBlankV1List" label="Choose Avc Cap Blank V1">
						<template v-for="avcCapBlankV1 in allAvcCapBlankV1List" :key="avcCapBlankV1.id">
							<option :value="avcCapBlankV1.id">{{ avcCapBlankV1.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.avc_cap_blank_v2" id="add_avc_cap_blank_v2">
					<optgroup v-if="allAvcCapBlankV2List" label="Choose Avc Cap Blank V2">
						<template v-for="avcCapBlankV2 in allAvcCapBlankV2List" :key="avcCapBlankV2.id">
							<option :value="avcCapBlankV2.id">{{ avcCapBlankV2.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.avc_cap_blank_v3" id="add_avc_cap_blank_v3">
					<optgroup v-if="allAvcCapBlankV3List" label="Choose Avc Cap Blank V3">
						<template v-for="avcCapBlankV3 in allAvcCapBlankV3List" :key="avcCapBlankV3.id">
							<option :value="avcCapBlankV3.id">{{ avcCapBlankV3.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_avc_air_pressure_gauge" class="form-label text-uppercase fw-bold m-0">Airline Pressure Gauge</label>
			</div>
			<div class="col-md-2 col-6">
				<div>
					<input type="text" class="form-control" v-model="onhiremain.avc_air_pressure_gauge" id="add_onhiremain_avc_air_pressure_gauge" />
				</div>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Srv 1 :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv1_x" id="add_onhiremain_srv1_x" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv1_value1" id="add_srv1_value1">
					<optgroup v-if="allSrv1Value1List" label="Choose Srv1 Value1">
						<template v-for="srv1Value1 in allSrv1Value1List" :key="srv1Value1.id">
							<option :value="srv1Value1.id">{{ srv1Value1.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv1_other" id="add_onhiremain_srv1_other" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv1_value2" id="add_srv1_value2">
					<optgroup v-if="allSrv1Value2List" label="Choose Srv1 Value2">
						<template v-for="srv1Value2 in allSrv1Value2List" :key="srv1Value2.id">
							<option :value="srv1Value2.id">{{ srv1Value2.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv1_value3" id="add_srv1_value3">
					<optgroup v-if="allSrv1Value3List" label="Choose Srv1 Value3">
						<template v-for="srv1Value3 in allSrv1Value3List" :key="srv1Value3.id">
							<option :value="srv1Value3.id">{{ srv1Value3.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 d-flex justify-content-end align-items-center gap-2">
				<label for="add_onhiremain_srv1_pressure" class="form-label text-uppercase fw-bold m-0">Pressure</label>
				<input type="text" class="form-control" v-model="onhiremain.srv1_pressure" id="add_onhiremain_srv1_pressure" />
				<label for="add_onhiremain_srv1_pressure" class="form-label text-uppercase fw-bold m-0">Bar</label>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_srv1_vac" class="form-label text-uppercase fw-bold m-0">Vac</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv1_vac" id="add_srv1_vac">
					<optgroup v-if="allSrv1VacList" label="Choose Srv1 Vac">
						<template v-for="srv1Vac in allSrv1VacList" :key="srv1Vac.id">
							<option :value="srv1Vac.id">{{ srv1Vac.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_srv1_serial" class="form-label text-uppercase fw-bold m-0">Serial</label>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv1_serial" id="add_onhiremain_srv1_serial" />
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_srv1_tir_strip" class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv1_tir_strip" id="add_srv1_tir_strip">
					<optgroup v-if="allSrv1TirStripList" label="Choose Srv1 Tir Strip">
						<template v-for="srv1TirStrip in allSrv1TirStripList" :key="srv1TirStrip.id">
							<option :value="srv1TirStrip.id">{{ srv1TirStrip.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_srv1_flame_screen" class="form-label text-uppercase fw-bold m-0">Flame Screen</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv1_flame_screen" id="add_srv1_flame_screen">
					<optgroup v-if="allSrv1FlameScreenList" label="Choose Srv1 Flame Screen">
						<template v-for="srv1FlameScreen in allSrv1FlameScreenList" :key="srv1FlameScreen.id">
							<option :value="srv1FlameScreen.id">{{ srv1FlameScreen.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Srv 2 :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv2_x" id="add_onhiremain_srv2_x" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv2_value1" id="add_srv2_value1">
					<optgroup v-if="allSrv2Value1List" label="Choose Srv2 Value1">
						<template v-for="srv2Value1 in allSrv2Value1List" :key="srv2Value1.id">
							<option :value="srv2Value1.id">{{ srv2Value1.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv2_other" id="add_onhiremain_srv2_other" />
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv2_value2" id="add_srv2_value2">
					<optgroup v-if="allSrv2Value2List" label="Choose Srv2 Value2">
						<template v-for="srv2Value2 in allSrv2Value2List" :key="srv2Value2.id">
							<option :value="srv2Value2.id">{{ srv2Value2.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv2_value3" id="add_srv2_value3">
					<optgroup v-if="allSrv2Value3List" label="Choose Srv2 Value3">
						<template v-for="srv2Value3 in allSrv2Value3List" :key="srv2Value3.id">
							<option :value="srv2Value3.id">{{ srv2Value3.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 d-flex justify-content-end align-items-center gap-2">
				<label for="add_onhiremain_srv2_pressure" class="form-label text-uppercase fw-bold m-0">Pressure</label>
				<input type="text" class="form-control" v-model="onhiremain.srv2_pressure" id="add_onhiremain_srv2_pressure" />
				<label for="add_onhiremain_srv2_pressure" class="form-label text-uppercase fw-bold m-0">Bar</label>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_srv2_vac" class="form-label text-uppercase fw-bold m-0">Vac</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv2_vac" id="add_srv2_vac">
					<optgroup v-if="allSrv2VacList" label="Choose Srv2 Vac">
						<template v-for="srv2Vac in allSrv2VacList" :key="srv2Vac.id">
							<option :value="srv2Vac.id">{{ srv2Vac.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_srv2_serial" class="form-label text-uppercase fw-bold m-0">Serial</label>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv2_serial" id="add_onhiremain_srv2_serial" />
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_srv2_tir_strip" class="form-label text-uppercase fw-bold m-0">Tir Strip</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv2_tir_strip" id="add_srv2_tir_strip">
					<optgroup v-if="allSrv2TirStripList" label="Choose Srv2 Tir Strip">
						<template v-for="srv2TirStrip in allSrv2TirStripList" :key="srv2TirStrip.id">
							<option :value="srv2TirStrip.id">{{ srv2TirStrip.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_srv2_flame_screen" class="form-label text-uppercase fw-bold m-0">Flame Screen</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.srv2_flame_screen" id="add_srv2_flame_screen">
					<optgroup v-if="allSrv2FlameScreenList" label="Choose Srv2 Flame Screen">
						<template v-for="srv2FlameScreen in allSrv2FlameScreenList" :key="srv2FlameScreen.id">
							<option :value="srv2FlameScreen.id">{{ srv2FlameScreen.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Rupture Disc 1 :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2">
				<input type="text" class="form-control" v-model="onhiremain.rd1_x" id="add_onhiremain_rd1_x" />
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_rd1_manufacturer" class="form-label text-uppercase fw-bold m-0">Manufacturer</label>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.rd1_manufacturer" id="add_onhiremain_rd1_manufacturer" />
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_rd1_bar" class="form-label text-uppercase fw-bold m-0">Bar</label>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.rd1_bar" id="add_onhiremain_rd1_bar" />
			</div>
			<div class="col-12 d-flex justify-content-end align-items-center gap-2">
				<label for="add_onhiremain_rd1_size" class="form-label text-uppercase fw-bold m-0">Size</label>
				<div>
					<input type="text" class="form-control" v-model="onhiremain.rd1_size" id="add_onhiremain_rd1_size" />
				</div>
				<label for="add_onhiremain_rd1_size" class="form-label text-uppercase fw-bold m-0">"/mm</label>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Rupture Disc 2 :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 ">
				<input type="text" class="form-control" v-model="onhiremain.rd2_x" id="add_onhiremain_rd2_x" />
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_rd2_manufacturer" class="form-label text-uppercase fw-bold m-0">Manufacturer</label>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.rd2_manufacturer" id="add_onhiremain_rd2_manufacturer" />
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_rd2_bar" class="form-label text-uppercase fw-bold m-0">Bar</label>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.rd2_bar" id="add_onhiremain_rd2_bar" />
			</div>
			<div class="col-md-2 d-flex justify-content-end align-items-center gap-2">
				<label for="add_onhiremain_rd2_size" class="form-label text-uppercase fw-bold m-0">Size</label>
				<div>
					<input type="text" class="form-control" v-model="onhiremain.rd2_size" id="add_onhiremain_rd2_size" />
				</div>
				<label for="add_onhiremain_rd2_size" class="form-label text-uppercase fw-bold m-0">"/mm</label>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Srv 1 Manometer :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv1_mano_x" id="add_onhiremain_srv1_mano_x" />
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv1_mano_value1" id="add_onhiremain_srv1_mano_value1" />
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_srv1_mano_bar" class="form-label text-uppercase fw-bold m-0">Bar</label>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv1_mano_bar" id="add_onhiremain_srv1_mano_bar" />
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-12">
				<h5>Srv 2 Manometer :</h5>
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv2_mano_x" id="add_onhiremain_srv2_mano_x" />
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv2_mano_value" id="add_onhiremain_srv2_mano_value" />
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_srv2_mano_bar" class="form-label text-uppercase fw-bold m-0">Bar</label>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhiremain.srv2_mano_bar" id="add_onhiremain_srv2_mano_bar" />
			</div>
		</div>
		<div class="row mb-4 g-3">
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_gps" class="form-label text-uppercase fw-bold m-0">GPS</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.gps" id="add_gps">
					<optgroup v-if="allGpsList" label="Choose Gps">
						<template v-for="gps in allGpsList" :key="gps.id">
							<option :value="gps.id">{{ gps.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
				<label for="add_onhiremain_camera" class="form-label text-uppercase fw-bold m-0">Camera</label>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhiremain.camera" id="add_camera">
					<optgroup v-if="allCameraList" label="Choose Camera">
						<template v-for="camera in allCameraList" :key="camera.id">
							<option :value="camera.id">{{ camera.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
	</div>
</template>
<script setup>
	import {ref, watch} from "vue";
	const initialMainState = {
		id: 0,
		onhire_id: 0,
		bd_x: "",
		bd_x_value: 1,
		bd_other: "",
		bd_butterfly_ball: -1,
		bd_butterfly_ball_sn: "",
		bd_tir_strip: 1,
		bd_spacers: 1,
		fv_x: "",
		fv_x_value: 1,
		fv_other: "",
		fv_option: -1,
		fv_tir_strip: 1,
		bocp_x: "",
		bocp_x_value: -1,
		bocp_3_bsp: "",
		bocp_cap: -1,
		rt_x: "",
		rt_type: -1,
		rt_fusible_link: 1,
		td_x: "",
		td_dn: "",
		td_dn_value_1: -1,
		td_dn_value_2: 1,
		td_dn_other: "",
		td_butterfly_ball: -1,
		td_tir_strip: 1,
		td_siphon_tube: 1,
		tl_x: "",
		tl_dn: "",
		tl_dn_value_1: -1,
		tl_dn_value_2: 1,
		tl_dn_other: "",
		tl_butterfly_ball: -1,
		tl_tir_strip: 1,
		av_x: "",
		av_value_inch: -1,
		av_value: 1,
		av_other: "",
		av_butterfly_ball: -1,
		avc_type: -1,
		avc_tir_strip: 1,
		avc_cap_blank_v1: -1,
		avc_cap_blank_v2: -1,
		avc_cap_blank_v3: -1,
		avc_air_pressure_gauge: "",
		srv1_x: "",
		srv1_value1: 1,
		srv1_other: "",
		srv1_value2: -1,
		srv1_value3: -1,
		srv1_pressure: "",
		srv1_vac: -1,
		srv1_serial: "",
		srv1_tir_strip: 1,
		srv1_flame_screen: 1,
		srv2_x: "",
		srv2_value1: 1,
		srv2_other: "",
		srv2_value2: -1,
		srv2_value3: -1,
		srv2_pressure: "",
		srv2_vac: -1,
		srv2_serial: "",
		srv2_tir_strip: 1,
		srv2_flame_screen: 1,
		rd1_x: "",
		rd1_manufacturer: "",
		rd1_bar: "",
		rd1_size: "",
		rd2_x: "",
		rd2_manufacturer: "",
		rd2_bar: "",
		rd2_size: "",
		srv1_mano_x: "",
		srv1_mano_value1: "",
		srv1_mano_bar: "",
		srv2_mano_x: "",
		srv2_mano_value: "",
		srv2_mano_bar: "",
		gps: 1,
		camera: 1
	};
	const props = defineProps({
		mainObject: {
			type: Object,
			required: true
		},
		modelValue: {
			type: Object,
			required: true
		}
	});
	const emit = defineEmits(["update:modelValue"]);
	let onhiremain = ref({ });
	// onMounted(() => {
	// 	onhiremain.value = {...initialMainState, ...props.modelValue};
	// });

	// Properties
	const yesnoArray = ref([
		{id: "1", title: "Yes"},
		{id: "0", title: "No"}
	]);
	let allBdXValueList = ref([
		{id: "1", title: "Fort Vale"},
		{id: "2", title: "Perolo"},
		{id: "3", title: "Pelican"},
		{id: "0", title: "Other"}
	]);
	let allBdButterflyBallList = ref([
		{id: "1", title: "Butterfly"},
		{id: "2", title: "Ball"},
		{id: "-1", title: "NA"}
	]);
	let allBdTirStripList = ref([...yesnoArray.value]);
	let allBdSpacersList = ref([
		{id: "1", title: "0"},
		{id: "2", title: "1"},
		{id: "3", title: "2"},
		{id: "4", title: "3"},
		{id: "5", title: "4"}
	]);
	let allFvXValueList = ref([
		{id: "1", title: "Fort Vale"},
		{id: "2", title: "Perolo"},
		{id: "0", title: "Other"}
	]);
	let allFvOptionList = ref([
		{id: "1", title: "Cleanflow"},
		{id: "2", title: "Highlift"},
		{id: "3", title: "Neatflow"},
		{id: "4", title: "Neatco"},
		{id: "-1", title: "NA"}
	]);
	let allFvTirStripList = ref([...yesnoArray.value]);
	let allBocpXValueList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "4 Bolt Blank"},
		{id: "2", title: "6 Bolt Blank"},
		{id: "3", title: "8 Bolt Blank"}
	]);
	let allBocpCapList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "SS"},
		{id: "2", title: "ALU"},
		{id: "3", title: "PVC"},
		{id: "4", title: "BRASS"}
	]);
	let allRtTypeList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "Pull Cable"},
		{id: "2", title: "Handle"},
		{id: "3", title: "Spring"}
	]);
	let allRtFusibleLinkList = ref([...yesnoArray.value]);
	let allTdDnValue1List = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "4 Bolt Blank"},
		{id: "2", title: "6 Bolt Blank"},
		{id: "3", title: "8 Bolt Blank"}
	]);
	let allTdDnValue2List = ref([
		{id: "1", title: "Fort Vale"},
		{id: "2", title: "Perolo"},
		{id: "3", title: "Pelican"},
		{id: "0", title: "Other"}
	]);
	let allTdButterflyBallList = ref([
		{id: "1", title: "Butterfly"},
		{id: "2", title: "Ball"},
		{id: "-1", title: "NA"}
	]);
	let allTdTirStripList = ref([...yesnoArray.value]);
	let allTdSiphonTubeList = ref([...yesnoArray.value]);
	let allTlDnValue1List = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "4 Bolt Blank"},
		{id: "2", title: "6 Bolt Blank"},
		{id: "3", title: "8 Bolt Blank"}
	]);
	let allTlDnValue2List = ref([
		{id: "1", title: "Fort Vale"},
		{id: "2", title: "Perolo"},
		{id: "3", title: "Pelican"},
		{id: "0", title: "Other"}
	]);
	let allTlButterflyBallList = ref([
		{id: "1", title: "Butterfly"},
		{id: "2", title: "Ball"},
		{id: "-1", title: "NA"}
	]);
	let allTlTirStripList = ref([...yesnoArray.value]);
	let allAvValueInchList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "3/4 Inch"},
		{id: "2", title: "1 Inch"},
		{id: "3", title: "1.5 Inch"},
		{id: "4", title: "2 Inch"},
		{id: "5", title: "2.5 Inch"},
		{id: "6", title: "3 Inch"}
	]);
	let allAvValueList = ref([
		{id: "1", title: "Fort Value"},
		{id: "2", title: "Perolo"},
		{id: "3", title: "Pelican"},
		{id: "0", title: "Other"}
	]);
	let allAvButterflyBallList = ref([
		{id: "1", title: "Butterfly"},
		{id: "2", title: "Ball"},
		{id: "-1", title: "NA"}
	]);
	let allAvcTypeList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "Bsp"},
		{id: "2", title: 'Npt"'},
		{id: "3", title: "Quick"},
		{id: "4", title: "Flange"}
	]);
	let allAvcTirStripList = ref([...yesnoArray.value]);
	let allAvcCapBlankV1List = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "Cap"},
		{id: "2", title: "Blank"}
	]);
	let allAvcCapBlankV2List = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "4 Bolt Bank"},
		{id: "2", title: "Cap with Chain"},
		{id: "3", title: "Cable"}
	]);
	let allAvcCapBlankV3List = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "SS"},
		{id: "2", title: "ALU"}
	]);
	let allSrv1Value1List = ref([
		{id: "1", title: "Fort Vale"},
		{id: "2", title: "Perolo"},
		{id: "0", title: "Other"}
	]);
	let allSrv1Value2List = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "Flanged"},
		{id: "2", title: "Threaded"}
	]);
	let allSrv1Value3List = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "4 Bolt Blank"},
		{id: "2", title: "6 Bolt Blank"},
		{id: "3", title: "8 Bolt Blank"}
	]);
	let allSrv1VacList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "6 inch Hg"},
		{id: "2", title: "6.2 inch Hg"}
	]);
	let allSrv1TirStripList = ref([...yesnoArray.value]);
	let allSrv1FlameScreenList = ref([...yesnoArray.value]);
	let allSrv2Value1List = ref([
		{id: "1", title: "Fort Vale"},
		{id: "2", title: "Perolo"},
		{id: "0", title: "Other"}
	]);
	let allSrv2Value2List = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "Flanged"},
		{id: "2", title: "Threaded"}
	]);
	let allSrv2Value3List = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "4 Bolt Blank"},
		{id: "2", title: "6 Bolt Blank"},
		{id: "3", title: "8 Bolt Blank"}
	]);
	let allSrv2VacList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "6 inch Hg"},
		{id: "2", title: "6.2 inch Hg"}
	]);
	let allSrv2TirStripList = ref([...yesnoArray.value]);
	let allSrv2FlameScreenList = ref([...yesnoArray.value]);
	let allCameraList = ref([...yesnoArray.value]);
	let allGpsList = ref([...yesnoArray.value]);
	const updateMainRecord = () => {
		if (onhiremain !== null && onhiremain !== undefined && onhiremain.value !== null && onhiremain.value !== undefined) 
			emit("update:modelValue", onhiremain.value);
	};
	// Watch
	watch(
		() => onhiremain,
		(newValue, oldValue) => {
			updateMainRecord();
		},
		{immediate: true, deep: true}
	);
	watch(
		() => props.mainObject?.refresh,
		(newValue, oldValue) => {
			if( newValue == true ){
				onhiremain.value = {...initialMainState, ...props.mainObject};
				delete onhiremain.value.refresh;
			}
		},
		{immediate: true, deep: true}
	);
</script>
<style>
	#add-onhire-main {
		label {
			font-size: 85%;
		}
	}
</style>
