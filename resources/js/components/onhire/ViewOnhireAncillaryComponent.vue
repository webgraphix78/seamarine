<template lang="">
	<div>
		<div class="row mb-1 pt-2 border-top">
			<div class="col-12">
				<h5>Ancillary Fittings :</h5>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_1">{{ readOnhireAncillary.ancf_1 }}</span
				><span v-else><i>-</i></span>
			</div>
			<div class="col-2 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Cladding</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_1_cladding == '-1'">NA</span>
				<span v-if="readOnhireAncillary.ancf_1_cladding == '1'">SS/ALU</span>
				<span v-if="readOnhireAncillary.ancf_1_cladding == '2'">SS</span>
				<span v-if="readOnhireAncillary.ancf_1_cladding == '3'">ALU</span>
				<span v-if="readOnhireAncillary.ancf_1_cladding == '4'">GRP</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_2">{{ readOnhireAncillary.ancf_2 }}</span
				><span v-else><i>-</i></span>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_2_ladder == '-1'">NA</span>
				<span v-if="readOnhireAncillary.ancf_2_ladder == '1'">Front</span>
				<span v-if="readOnhireAncillary.ancf_2_ladder == '2'">Rear Ladder</span>
				<span v-if="readOnhireAncillary.ancf_2_ladder == '3'">Front Ladder & Rear Ladder</span>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_2_ladder_type == '-1'">NA</span>
				<span v-if="readOnhireAncillary.ancf_2_ladder_type == '1'">IRON</span>
				<span v-if="readOnhireAncillary.ancf_2_ladder_type == '2'">SS</span>
				<span v-if="readOnhireAncillary.ancf_2_ladder_type == '3'">ALU</span>
				<span v-if="readOnhireAncillary.ancf_2_ladder_type == '4'">Galvanized</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_3">{{ readOnhireAncillary.ancf_3 }}</span
				><span v-else><i>-</i></span>
			</div>
			<div class="col-2 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Placard Holders</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_3_placard == '-1'">NA</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '1'">0</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '2'">1</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '3'">2</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '4'">3</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '5'">4</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '6'">5</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '7'">6</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '8'">7</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '9'">8</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '10'">9</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '11'">10</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '12'">11</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '13'">12</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '14'">13</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '15'">14</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '16'">15</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '17'">16</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '18'">17</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '19'">18</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '20'">19</span>
				<span v-if="readOnhireAncillary.ancf_3_placard == '21'">20</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_4">{{ readOnhireAncillary.ancf_4 }}</span
				><span v-else><i>-</i></span>
			</div>
			<div class="col-2 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Decals</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_4_decals == '-1'">NA</span>
				<span v-if="readOnhireAncillary.ancf_4_decals == '1'">Weight / Capacity</span>
				<span v-if="readOnhireAncillary.ancf_4_decals == '2'">Foodlogo</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_5">{{ readOnhireAncillary.ancf_5 }}</span
				><span v-else><i>-</i></span>
			</div>
			<div class="col-2 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Temp. Gauge</label>
			</div>
			<div class="col-2">
				<div>
					<span v-if="readOnhireAncillary.ancf_5_tgauge == '1'">Fortvale</span>
					<span v-if="readOnhireAncillary.ancf_5_tgauge == '2'">Perolo</span>
					<template v-if="readOnhireAncillary.ancf_5_tgauge == '0'">
						Other -
						<span v-if="readOnhireAncillary.ancf_5_other">{{ readOnhireAncillary.ancf_5_other }}</span>
						<span v-else><i>Not specified</i></span>
					</template>
				</div>
			</div>
			<div class="col-2 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Temperature</label>
			</div>
			<div class="col-3 d-flex gap-2">
				<div>
					<span v-if="readOnhireAncillary.ancf_5_temperature">{{ readOnhireAncillary.ancf_5_temperature }}</span>
					<span v-else><i>-</i></span>
				</div>
				<div>
					<span v-if="readOnhireAncillary.ancf_5_ttype == '-1'">NA</span>
					<span v-if="readOnhireAncillary.ancf_5_ttype == '1'">Analog</span>
					<span v-if="readOnhireAncillary.ancf_5_ttype == '2'">Digital</span>
				</div>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_6">{{ readOnhireAncillary.ancf_6 }}</span
				><span v-else><i>-</i></span>
			</div>
			<div class="col-2 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Document Tube</label>
			</div>
			<div class="col-2">
				<div>
					<span v-if="readOnhireAncillary.ancf_6_doc_tube">{{ readOnhireAncillary.ancf_6_doc_tube }}</span
					><span v-else><i>-</i></span>
				</div>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_7">{{ readOnhireAncillary.ancf_7 }}</span>
				<span v-else><i>-</i></span>
			</div>
			<div class="col-2 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Steam Tube Cap</label>
			</div>
			<div class="col-2">
				<div>
					<span v-if="readOnhireAncillary.ancf_7_steam_tube">{{ readOnhireAncillary.ancf_7_steam_tube }}</span>
					<span v-else><i>-</i></span>
				</div>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_7_steam_tube_value_1 == '1'">BSP</span>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_7_steam_tube_value_2 == '-1'">NA</span>
				<span v-if="readOnhireAncillary.ancf_7_steam_tube_value_2 == '1'">SS</span>
				<span v-if="readOnhireAncillary.ancf_7_steam_tube_value_2 == '2'">PVC</span>
				<span v-if="readOnhireAncillary.ancf_7_steam_tube_value_2 == '3'">ALU</span>
				<span v-if="readOnhireAncillary.ancf_7_steam_tube_value_2 == '4'">BRASS</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_8">{{ readOnhireAncillary.ancf_8 }}</span>
				<span v-else><i>-</i></span>
			</div>
			<div class="col-2 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Steam Accessories</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_8_steam_acc">{{ readOnhireAncillary.ancf_8_steam_acc }}</span>
				<span v-else><i>-</i></span>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_8_steam_acc_value == '-1'">NA</span>
				<span v-if="readOnhireAncillary.ancf_8_steam_acc_value == '1'">X Drainvalve</span>
				<span v-if="readOnhireAncillary.ancf_8_steam_acc_value == '2'">X Pv</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_9">{{ readOnhireAncillary.ancf_9 }}</span
				><span v-else><i>-</i></span>
			</div>
			<div class="col-4 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Bottom Compartment Cover Material</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_9_bottom_comp == '-1'">NA</span>
				<span v-if="readOnhireAncillary.ancf_9_bottom_comp == '1'">IRON</span>
				<span v-if="readOnhireAncillary.ancf_9_bottom_comp == '2'">SS</span>
				<span v-if="readOnhireAncillary.ancf_9_bottom_comp == '3'">ALU</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_10">{{ readOnhireAncillary.ancf_10 }}</span>
				<span v-else><i>-</i></span>
			</div>
			<div class="col-2 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Electrical</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_10_electrical == '-1'">NA</span>
				<span v-if="readOnhireAncillary.ancf_10_electrical == '1'">Heating</span>
				<span v-if="readOnhireAncillary.ancf_10_electrical == '2'">Cooling</span>
			</div>
			<div class="col-2 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Manufacturer</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireAncillary.ancf_10_manufacturer">{{ readOnhireAncillary.ancf_10_manufacturer }}</span>
				<span v-else><i>-</i></span>
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
	let readOnhireAncillary = ref({});
	watch(
		() => props.mainObject?.refresh,
		(newValue, oldValue) => {
			if (newValue == true) {
				readOnhireAncillary.value = {...props.mainObject};
			}
		},
		{immediate: true, deep: true}
	);
</script>
<style lang=""></style>
