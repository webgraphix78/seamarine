<template lang="">
	<div id="view-onhire-unitnr">
		<div class="row my-2">
			<div class="col-2">
				<h5>Unit Nr</h5>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
					<span v-if="readOnhireUnitnr.unit_nr_1">{{ readOnhireUnitnr.unit_nr_1 }}</span
					><span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Calibration Table</label>
			</div>
			<div class="col-2">
				<div>
					<span v-if="readOnhireUnitnr.unit_nr_1_calibration == '-1'">NA</span>
					<span v-if="readOnhireUnitnr.unit_nr_1_calibration == '1'">Stainless Steel</span>
					<span v-if="readOnhireUnitnr.unit_nr_1_calibration == '2'">Paper</span>
				</div>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_1_calibration_value == '-1'">NA</span>
				<span v-if="readOnhireUnitnr.unit_nr_1_calibration_value == '1'">In Spillbox</span>
				<span v-if="readOnhireUnitnr.unit_nr_1_calibration_value == '2'">In Cover</span>
				<span v-if="readOnhireUnitnr.unit_nr_1_calibration_value == '3'">On Cladding</span>
				<span v-if="readOnhireUnitnr.unit_nr_1_calibration_value == '4'">On Manlid</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_2">{{ readOnhireUnitnr.unit_nr_2 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Manlid With Swingbolts</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_2_manlid_swing == '-1'">NA</span>
				<span v-if="readOnhireUnitnr.unit_nr_2_manlid_swing == '1'">4 Bolted</span>
				<span v-if="readOnhireUnitnr.unit_nr_2_manlid_swing == '2'">6 Bolted</span>
				<span v-if="readOnhireUnitnr.unit_nr_2_manlid_swing == '3'">8 Bolted</span>
				<span v-if="readOnhireUnitnr.unit_nr_2_manlid_swing == '4'">16x / 20x</span>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_2_manlid_swing_value == '1'">Fortvale</span>
				<span v-if="readOnhireUnitnr.unit_nr_2_manlid_swing_value == '2'">Perolo</span>
				<span v-if="readOnhireUnitnr.unit_nr_2_manlid_swing_value == '3'">Swift</span>
				<span v-if="readOnhireUnitnr.unit_nr_2_manlid_swing_value == '4'">X Securing Ring</span>
				<span v-if="readOnhireUnitnr.unit_nr_2_manlid_swing_value == '0'">Other</span>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_2_manlid_swing_other">{{ readOnhireUnitnr.unit_nr_2_manlid_swing_other }}</span><span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_3">{{ readOnhireUnitnr.unit_nr_3 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Collapsible Handrails</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_3_collapsible">{{ readOnhireUnitnr.unit_nr_3_collapsible }}</span
				><span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_4">{{ readOnhireUnitnr.unit_nr_4 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Dipstick</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_4_dipstick == '-1'">NA</span>
				<span v-if="readOnhireUnitnr.unit_nr_4_dipstick == '1'">Angle</span>
				<span v-if="readOnhireUnitnr.unit_nr_4_dipstick == '2'">Flat</span>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_4_dipstick_value == '-1'">NA</span>
				<span v-if="readOnhireUnitnr.unit_nr_4_dipstick_value == '1'">Legible</span>
				<span v-if="readOnhireUnitnr.unit_nr_4_dipstick_value == '2'">Bracket</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_5">{{ readOnhireUnitnr.unit_nr_5 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Topcover & Lockings Material</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_5_topcover == '-1'">NA</span>
				<span v-if="readOnhireUnitnr.unit_nr_5_topcover == '1'">SS</span>
				<span v-if="readOnhireUnitnr.unit_nr_5_topcover == '2'">ALU</span>
				<span v-if="readOnhireUnitnr.unit_nr_5_topcover == '3'">IRON</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_6">{{ readOnhireUnitnr.unit_nr_6 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Walkway</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_6_walkway == '-1'">NA</span>
				<span v-if="readOnhireUnitnr.unit_nr_6_walkway == '1'">SS</span>
				<span v-if="readOnhireUnitnr.unit_nr_6_walkway == '2'">ALU</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_7">{{ readOnhireUnitnr.unit_nr_7 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Unit Nr 7 Manlid Gasket</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_7_manlid_gasket == '-1'">NA</span>
				<span v-if="readOnhireUnitnr.unit_nr_7_manlid_gasket == '1'">SWR</span>
				<span v-if="readOnhireUnitnr.unit_nr_7_manlid_gasket == '2'">PTFE</span>
				<span v-if="readOnhireUnitnr.unit_nr_7_manlid_gasket == '3'">Viton A</span>
				<span v-if="readOnhireUnitnr.unit_nr_7_manlid_gasket == '4'">Super Tanktyt</span>
				<span v-if="readOnhireUnitnr.unit_nr_7_manlid_gasket == '0'">Other</span>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_7_manlid_gasket_other">{{ readOnhireUnitnr.unit_nr_7_manlid_gasket_other }}</span
				><span v-else><i>Not specified</i></span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_8">{{ readOnhireUnitnr.unit_nr_8 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Grounding Lug</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_8_grounding == '1'">Yes</span>
				<span v-if="readOnhireUnitnr.unit_nr_8_grounding == '0'">No</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_9">{{ readOnhireUnitnr.unit_nr_9 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Bottomplate</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_9_bottomplate == '-1'">NA</span>
				<span v-if="readOnhireUnitnr.unit_nr_9_bottomplate == '1'">Yes</span>
				<span v-if="readOnhireUnitnr.unit_nr_9_bottomplate == '0'">No</span>
			</div>
		</div>
		<div class="row mb-2 py-2 border-bottom">
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_10">{{ readOnhireUnitnr.unit_nr_10 }}</span
				><span v-else><i>Not specified</i></span>
			</div>
			<div class="col-3 text-end">
				<label class="form-label text-uppercase fw-bold m-0">Pti Date</label>
			</div>
			<div class="col-2">
				<span v-if="readOnhireUnitnr.unit_nr_10_pti_date == '-1'">NA</span>
				<span v-if="readOnhireUnitnr.unit_nr_10_pti_date == '1'">Cable +/-</span>
				<span v-if="readOnhireUnitnr.unit_nr_10_pti_date == '2'">Mtr</span>
				<span v-if="readOnhireUnitnr.unit_nr_10_pti_date == '3'">Splice</span>
				<span v-if="readOnhireUnitnr.unit_nr_10_pti_date == '4'">Plug</span>
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
	let readOnhireUnitnr = ref({});
	watch(
		() => props.mainObject?.refresh,
		(newValue, oldValue) => {
			if (newValue == true) {
				readOnhireUnitnr.value = {...props.mainObject};
			}
		},
		{immediate: true, deep: true}
	);
</script>
<style lang=""></style>
