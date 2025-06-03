<template lang="">
	<div id="add-onhire-unitnr" class="border-top border-secondary">
		<div class="row my-2">
			<div class="col-md-2">
				<h5>Unit Nr</h5>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-2 col-3">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_1" id="add_onhireunitnr_unit_nr_1" />
			</div>
			<div class="col-md-2 col-3 text-end">
				<label for="add_onhireunitnr_unit_nr_1_calibration" class="form-label text-uppercase fw-bold m-0 py-2">Calibration Table</label>
			</div>
			<div class="col-md-2 col-3">
				<select class="form-select" v-model="onhireunitnr.unit_nr_1_calibration" id="add_unit_nr_1_calibration">
					<optgroup v-if="allUnitNr1CalibrationList" label="Choose">
						<template v-for="unitNr1Calibration in allUnitNr1CalibrationList" :key="unitNr1Calibration.id">
							<option :value="unitNr1Calibration.id">{{ unitNr1Calibration.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-3">
				<select class="form-select" v-model="onhireunitnr.unit_nr_1_calibration_value" id="add_unit_nr_1_calibration_value">
					<optgroup v-if="allUnitNr1CalibrationValueList" label="Choose">
						<template v-for="unitNr1CalibrationValue in allUnitNr1CalibrationValueList" :key="unitNr1CalibrationValue.id">
							<option :value="unitNr1CalibrationValue.id">{{ unitNr1CalibrationValue.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-2 col-4">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_2" id="add_onhireunitnr_unit_nr_2" />
			</div>
			<div class="col-md-2 col-4 text-end">
				<label for="add_onhireunitnr_unit_nr_2_manlid_swing" class="form-label text-uppercase fw-bold m-0 py-2">Manlid With Swingbolts</label>
			</div>
			<div class="col-md-2 col-4">
				<div>
					<select class="form-select" v-model="onhireunitnr.unit_nr_2_manlid_swing" id="add_unit_nr_2_manlid_swing">
						<optgroup v-if="allUnitNr2ManlidSwingList" label="Choose">
							<template v-for="unitNr2ManlidSwing in allUnitNr2ManlidSwingList" :key="unitNr2ManlidSwing.id">
								<option :value="unitNr2ManlidSwing.id">{{ unitNr2ManlidSwing.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
			<div class="col-md-2 col-6">
				<select class="form-select" v-model="onhireunitnr.unit_nr_2_manlid_swing_value" id="add_unit_nr_2_manlid_swing_value">
					<optgroup v-if="allUnitNr2ManlidSwingValueList" label="Choose">
						<template v-for="unitNr2ManlidSwingValue in allUnitNr2ManlidSwingValueList" :key="unitNr2ManlidSwingValue.id">
							<option :value="unitNr2ManlidSwingValue.id">{{ unitNr2ManlidSwingValue.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-6">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_2_manlid_swing_other" id="add_onhireunitnr_unit_nr_2_manlid_swing_other" />
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-2 col-4">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_3" id="add_onhireunitnr_unit_nr_3"/>
			</div>
			<div class="col-md-2 col-4 text-end">
				<label for="add_onhireunitnr_unit_nr_3_collapsible" class="form-label text-uppercase fw-bold m-0 py-2">Collapsible Handrails</label>
			</div>
			<div class="col-md-2 col-4">
				<div>
					<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_3_collapsible" id="add_onhireunitnr_unit_nr_3_collapsible"/>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-2 col-3">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_4" id="add_onhireunitnr_unit_nr_4"/>
			</div>
			<div class="col-md-2 col-3 text-end">
				<label for="add_onhireunitnr_unit_nr_4_dipstick" class="form-label text-uppercase fw-bold m-0 py-2">Dipstick</label>
			</div>
			<div class="col-md-2 col-3">
				<select class="form-select" v-model="onhireunitnr.unit_nr_4_dipstick" id="add_unit_nr_4_dipstick">
					<optgroup v-if="allUnitNr4DipstickList" label="Choose">
						<template v-for="unitNr4Dipstick in allUnitNr4DipstickList" :key="unitNr4Dipstick.id">
							<option :value="unitNr4Dipstick.id">{{ unitNr4Dipstick.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-md-2 col-3">
				<select class="form-select" v-model="onhireunitnr.unit_nr_4_dipstick_value" id="add_unit_nr_4_dipstick_value">
					<optgroup v-if="allUnitNr4DipstickValueList" label="Choose">
						<template v-for="unitNr4DipstickValue in allUnitNr4DipstickValueList" :key="unitNr4DipstickValue.id">
							<option :value="unitNr4DipstickValue.id">{{ unitNr4DipstickValue.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-2 col-4">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_5" id="add_onhireunitnr_unit_nr_5"/>
			</div>
			<div class="col-md-2 col-4 text-end">
				<label for="add_onhireunitnr_unit_nr_5_topcover" class="form-label text-uppercase fw-bold m-0 py-2">Topcovers & Lockings Material</label>
			</div>
			<div class="col-md-2 col-4">
				<select class="form-select" v-model="onhireunitnr.unit_nr_5_topcover" id="add_unit_nr_5_topcover">
					<optgroup v-if="allUnitNr5TopcoverList" label="Choose">
						<template v-for="unitNr5Topcover in allUnitNr5TopcoverList" :key="unitNr5Topcover.id">
							<option :value="unitNr5Topcover.id">{{ unitNr5Topcover.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-2 col-4">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_6" id="add_onhireunitnr_unit_nr_6"/>
			</div>
			<div class="col-md-2 col-4 text-end">
				<label for="add_onhireunitnr_unit_nr_6_walkway" class="form-label text-uppercase fw-bold m-0 py-2">Walkway</label>
			</div>
			<div class="col-md-2 col-4">
				<select class="form-select" v-model="onhireunitnr.unit_nr_6_walkway" id="add_unit_nr_6_walkway">
					<optgroup v-if="allUnitNr6WalkwayList" label="Choose">
						<template v-for="unitNr6Walkway in allUnitNr6WalkwayList" :key="unitNr6Walkway.id">
							<option :value="unitNr6Walkway.id">{{ unitNr6Walkway.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-2 col-3">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_7" id="add_onhireunitnr_unit_nr_7"/>
			</div>
			<div class="col-md-2 col-3 text-end">
				<label for="add_onhireunitnr_unit_nr_7_manlid_gasket" class="form-label text-uppercase fw-bold m-0 py-2">Manlid Gasket</label>
			</div>
			<div class="col-md-2 col-3">
				<div>
					<select class="form-select" v-model="onhireunitnr.unit_nr_7_manlid_gasket" id="add_unit_nr_7_manlid_gasket">
						<optgroup v-if="allUnitNr7ManlidGasketList" label="Choose">
							<template v-for="unitNr7ManlidGasket in allUnitNr7ManlidGasketList" :key="unitNr7ManlidGasket.id">
								<option :value="unitNr7ManlidGasket.id">{{ unitNr7ManlidGasket.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
			<div class="col-md-2 col-3">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_7_manlid_gasket_other" id="add_onhireunitnr_unit_nr_7_manlid_gasket_other"/>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-2 col-4">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_8" id="add_onhireunitnr_unit_nr_8"/>
			</div>
			<div class="col-md-2 col-4 text-end">
				<label for="add_onhireunitnr_unit_nr_8_grounding" class="form-label text-uppercase fw-bold m-0 py-2">Grounding Lug</label>
			</div>
			<div class="col-md-2 col-4">
				<select class="form-select" v-model="onhireunitnr.unit_nr_8_grounding" id="add_unit_nr_8_grounding">
					<optgroup v-if="allUnitNr8GroundingList" label="Choose">
						<template v-for="unitNr8Grounding in allUnitNr8GroundingList" :key="unitNr8Grounding.id">
							<option :value="unitNr8Grounding.id">{{ unitNr8Grounding.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-2 col-4">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_9" id="add_onhireunitnr_unit_nr_9"/>
			</div>
			<div class="col-md-2 col-4 text-end">
				<label for="add_onhireunitnr_unit_nr_9_bottomplate" class="form-label text-uppercase fw-bold m-0 py-2">Bottomplate</label>
			</div>
			<div class="col-md-2 col-4">
				<select class="form-select" v-model="onhireunitnr.unit_nr_9_bottomplate" id="add_unit_nr_9_bottomplate">
					<optgroup v-if="allUnitNr9BottomplateList" label="Choose">
						<template v-for="unitNr9Bottomplate in allUnitNr9BottomplateList" :key="unitNr9Bottomplate.id">
							<option :value="unitNr9Bottomplate.id">{{ unitNr9Bottomplate.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-2 col-4">
				<input type="text" class="form-control" v-model="onhireunitnr.unit_nr_10" id="add_onhireunitnr_unit_nr_10"/>
			</div>
			<div class="col-md-2 col-4 text-end">
				<label for="add_onhireunitnr_unit_nr_10_pti_date" class="form-label text-uppercase fw-bold m-0 py-2">Pti Date</label>
			</div>
			<div class="col-md-2 col-4">
				<select class="form-select" v-model="onhireunitnr.unit_nr_10_pti_date" id="add_unit_nr_10_pti_date">
					<optgroup v-if="allUnitNr10PtiDateList" label="Choose">
						<template v-for="unitNr10PtiDate in allUnitNr10PtiDateList" :key="unitNr10PtiDate.id">
							<option :value="unitNr10PtiDate.id">{{ unitNr10PtiDate.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
	</div>
</template>
<script setup>
	import {ref, watch} from "vue";
	const initialUnitnrState = {
		id: 0,
		onhire_id: 0,
		unit_nr_1: "",
		unit_nr_1_calibration: "-1",
		unit_nr_1_calibration_value: "-1",
		unit_nr_2: "",
		unit_nr_2_manlid_swing: "-1",
		unit_nr_2_manlid_swing_value: "1",
		unit_nr_2_manlid_swing_other: "",
		unit_nr_3: "",
		unit_nr_3_collapsible: "",
		unit_nr_4: "",
		unit_nr_4_dipstick: "-1",
		unit_nr_4_dipstick_value: "-1",
		unit_nr_5: "",
		unit_nr_5_topcover: "-1",
		unit_nr_6: "",
		unit_nr_6_walkway: "-1",
		unit_nr_7: "",
		unit_nr_7_manlid_gasket: "-1",
		unit_nr_7_manlid_gasket_other: "",
		unit_nr_8: "",
		unit_nr_8_grounding: "1",
		unit_nr_9: "",
		unit_nr_9_bottomplate: "-1",
		unit_nr_10: "",
		unit_nr_10_pti_date: "-1"
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
	let onhireunitnr = ref({});
	let allUnitNr1CalibrationList = [
		{id: "-1", title: "NA"},
		{id: "1", title: "Stainless Steel"},
		{id: "2", title: "Paper"}
	];
	let allUnitNr1CalibrationValueList = [
		{id: "-1", title: "NA"},
		{id: "1", title: "In Spillbox"},
		{id: "2", title: "In Cover"},
		{id: "3", title: "On Cladding"},
		{id: "4", title: "On Manlid"}
	];
	let allUnitNr2ManlidSwingList = [
		{id: "-1", title: "NA"},
		{id: "1", title: "4 Bolted"},
		{id: "2", title: "6 Bolted"},
		{id: "3", title: "8 Bolted"},
		{id: "4", title: "16x / 20x"}
	];
	let allUnitNr2ManlidSwingValueList = [
		{id: "1", title: "Fortvale"},
		{id: "2", title: "Perolo"},
		{id: "3", title: "Swift"},
		{id: "4", title: "X Securing Ring"},
		{id: "0", title: "Other"}
	];
	let allUnitNr4DipstickList = [
		{id: "-1", title: "NA"},
		{id: "1", title: "Angle"},
		{id: "2", title: "Flat"}
	];
	let allUnitNr4DipstickValueList = [
		{id: "-1", title: "NA"},
		{id: "1", title: "Legible"},
		{id: "2", title: "Bracket"}
	];
	let allUnitNr5TopcoverList = [
		{id: "-1", title: "NA"},
		{id: "1", title: "SS"},
		{id: "2", title: "ALU"},
		{id: "3", title: "IRON"}
	];
	let allUnitNr6WalkwayList = [
		{id: "-1", title: "NA"},
		{id: "1", title: "SS"},
		{id: "2", title: "ALU"}
	];
	let allUnitNr7ManlidGasketList = [
		{id: "-1", title: "NA"},
		{id: "1", title: "SWR"},
		{id: "2", title: "PTFE"},
		{id: "3", title: "Viton A"},
		{id: "4", title: "Super Tanktyt"},
		{id: "0", title: "Other"}
	];
	let allUnitNr8GroundingList = [
		{id: "1", title: "Yes"},
		{id: "0", title: "No"}
	];
	let allUnitNr9BottomplateList = [
		{id: "-1", title: "NA"},
		{id: "1", title: "Yes"},
		{id: "0", title: "No"}
	];
	let allUnitNr10PtiDateList = [
		{id: "-1", title: "NA"},
		{id: "1", title: "Cable +/-"},
		{id: "2", title: "Mtr"},
		{id: "3", title: "Splice"},
		{id: "4", title: "Plug"}
	];
	const updateMainRecord = () => {
		if (onhireunitnr !== null && onhireunitnr !== undefined && onhireunitnr.value !== null && onhireunitnr.value !== undefined) emit("update:modelValue", onhireunitnr.value);
	};
	// Watch
	watch(
		() => onhireunitnr,
		(newValue, oldValue) => {
			updateMainRecord();
		},
		{immediate: true, deep: true}
	);
	watch(
		() => props.mainObject?.refresh,
		(newValue, oldValue) => {
			if (newValue == true) {
				onhireunitnr.value = Object.assign(initialUnitnrState, props.mainObject);
				delete onhireunitnr.value.refresh;
			}
		},
		{immediate: true, deep: true}
	);
</script>

<style>
	#add-onhire-unitnr {
		label {
			font-size: 85%;
		}
	}
</style>
