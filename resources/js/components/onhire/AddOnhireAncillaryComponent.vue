<template lang="">
	<div id="add-onhire-anc" class="border-top border-secondary">
		<div class="row my-2">
			<div class="col-2">
				<h5>Ancillary Fittings</h5>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_1" id="add_onhireancillary_ancf_1" />
			</div>
			<div class="col-2 text-end py-1">
				<label for="add_onhireancillary_ancf_1_cladding" class="form-label text-uppercase fw-bold m-0">Cladding</label>
			</div>
			<div class="col-2">
				<div>
					<select class="form-select" v-model="onhireancillary.ancf_1_cladding" id="add_ancf_1_cladding">
						<optgroup v-if="allAncf1CladdingList" label="Choose">
							<template v-for="ancf1Cladding in allAncf1CladdingList" :key="ancf1Cladding.id">
								<option :value="ancf1Cladding.id">{{ ancf1Cladding.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_2" id="add_onhireancillary_ancf_2" />
			</div>
			<div class="col-2">
				<select class="form-select" v-model="onhireancillary.ancf_2_ladder" id="add_ancf_2_ladder">
					<optgroup v-if="allAncf2LadderList" label="Choose">
						<template v-for="ancf2Ladder in allAncf2LadderList" :key="ancf2Ladder.id">
							<option :value="ancf2Ladder.id">{{ ancf2Ladder.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-2">
				<select class="form-select" v-model="onhireancillary.ancf_2_ladder_type" id="add_ancf_2_ladder_type">
					<optgroup v-if="allAncf2LadderTypeList" label="Choose">
						<template v-for="ancf2LadderType in allAncf2LadderTypeList" :key="ancf2LadderType.id">
							<option :value="ancf2LadderType.id">{{ ancf2LadderType.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_3" id="add_onhireancillary_ancf_3" />
			</div>
			<div class="col-2 text-end py-1">
				<label for="add_onhireancillary_ancf_3_placard" class="form-label text-uppercase fw-bold m-0">Placard Holders</label>
			</div>
			<div class="col-2">
				<select class="form-select" v-model="onhireancillary.ancf_3_placard" id="add_ancf_3_placard">
					<optgroup v-if="allAncf3PlacardList" label="Choose">
						<template v-for="ancf3Placard in allAncf3PlacardList" :key="ancf3Placard.id">
							<option :value="ancf3Placard.id">{{ ancf3Placard.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_4" id="add_onhireancillary_ancf_4" />
			</div>
			<div class="col-2 text-end py-1">
				<label for="add_onhireancillary_ancf_4_decals" class="form-label text-uppercase fw-bold m-0">Decals</label>
			</div>
			<div class="col-2">
				<select class="form-select" v-model="onhireancillary.ancf_4_decals" id="add_ancf_4_decals">
					<optgroup v-if="allAncf4DecalsList" label="Choose">
						<template v-for="ancf4Decals in allAncf4DecalsList" :key="ancf4Decals.id">
							<option :value="ancf4Decals.id">{{ ancf4Decals.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_5" id="add_onhireancillary_ancf_5" />
			</div>
			<div class="col-2 d-flex flex-row text-end align-items-center justify-content-end">
				<label for="add_onhireancillary_ancf_5_tgauge" class="form-label text-uppercase fw-bold m-0">Temperature gauge</label>
			</div>
			<div class="col-2">
				<div>
					<select class="form-select" v-model="onhireancillary.ancf_5_tgauge" id="add_ancf_5_tgauge">
						<optgroup v-if="allAncf5TgaugeList" label="Choose">
							<template v-for="ancf5Tgauge in allAncf5TgaugeList" :key="ancf5Tgauge.id">
								<option :value="ancf5Tgauge.id">{{ ancf5Tgauge.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
			<div class="col-2 d-flex flex-row gap-2">
				<label for="add_onhireancillary_ancf_5_other" class="form-label text-uppercase fw-bold m-0 py-2">Other</label>
				<div>
					<input type="text" class="form-control" v-model="onhireancillary.ancf_5_other" id="add_onhireancillary_ancf_5_other" />
				</div>
			</div>
			<div class="col-2 d-flex flex-row gap-2">
				<label for="add_onhireancillary_ancf_5_temperature" class="form-label text-uppercase fw-bold m-0 py-2">Temperature</label>
				<div>
					<input type="text" class="form-control" v-model="onhireancillary.ancf_5_temperature" id="add_onhireancillary_ancf_5_temperature" />
				</div>
			</div>
			<div class="col-2">
				<select class="form-select" v-model="onhireancillary.ancf_5_ttype" id="add_ancf_5_ttype">
					<optgroup v-if="allAncf5TtypeList" label="Choose">
						<template v-for="ancf5Ttype in allAncf5TtypeList" :key="ancf5Ttype.id">
							<option :value="ancf5Ttype.id">{{ ancf5Ttype.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_6" id="add_onhireancillary_ancf_6" />
			</div>
			<div class="col-2 text-end py-1">
				<label for="add_onhireancillary_ancf_6_doc_tube" class="form-label text-uppercase fw-bold m-0">Document Tube</label>
			</div>
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_6_doc_tube" id="add_onhireancillary_ancf_6_doc_tube" />
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_7" id="add_onhireancillary_ancf_7" />
			</div>
			<div class="col-2 text-end py-1">
				<label for="add_onhireancillary_ancf_7_steam_tube" class="form-label text-uppercase fw-bold m-0">Steam Tube Cap</label>
			</div>
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_7_steam_tube" id="add_onhireancillary_ancf_7_steam_tube" />
			</div>
			<div class="col-2">
				<select class="form-select" v-model="onhireancillary.ancf_7_steam_tube_value_1" id="add_ancf_7_steam_tube_value_1">
					<optgroup v-if="allAncf7SteamTubeValue1List" label="Choose">
						<template v-for="ancf7SteamTubeValue1 in allAncf7SteamTubeValue1List" :key="ancf7SteamTubeValue1.id">
							<option :value="ancf7SteamTubeValue1.id">{{ ancf7SteamTubeValue1.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
			<div class="col-2">
				<select class="form-select" v-model="onhireancillary.ancf_7_steam_tube_value_2" id="add_ancf_7_steam_tube_value_2">
					<optgroup v-if="allAncf7SteamTubeValue2List" label="Choose">
						<template v-for="ancf7SteamTubeValue2 in allAncf7SteamTubeValue2List" :key="ancf7SteamTubeValue2.id">
							<option :value="ancf7SteamTubeValue2.id">{{ ancf7SteamTubeValue2.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_8" id="add_onhireancillary_ancf_8" />
			</div>
			<div class="col-2 text-end py-1">
				<label for="add_onhireancillary_ancf_8_steam_acc" class="form-label text-uppercase fw-bold m-0">Steam Accessories</label>
			</div>
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_8_steam_acc" id="add_onhireancillary_ancf_8_steam_acc" />
			</div>
			<div class="col-2">
				<select class="form-select" v-model="onhireancillary.ancf_8_steam_acc_value" id="add_ancf_8_steam_acc_value">
					<optgroup v-if="allAncf8SteamAccValueList" label="Choose">
						<template v-for="ancf8SteamAccValue in allAncf8SteamAccValueList" :key="ancf8SteamAccValue.id">
							<option :value="ancf8SteamAccValue.id">{{ ancf8SteamAccValue.title }}</option>
						</template>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_9" id="add_onhireancillary_ancf_9" />
			</div>
			<div class="col-2 text-end py-1">
				<label for="add_onhireancillary_ancf_9_bottom_comp" class="form-label text-uppercase fw-bold m-0">Bottom Compartment Cover Material</label>
			</div>
			<div class="col-2">
				<div>
					<select class="form-select" v-model="onhireancillary.ancf_9_bottom_comp" id="add_ancf_9_bottom_comp">
						<optgroup v-if="allAncf9BottomCompList" label="Choose">
							<template v-for="ancf9BottomComp in allAncf9BottomCompList" :key="ancf9BottomComp.id">
								<option :value="ancf9BottomComp.id">{{ ancf9BottomComp.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-2">
				<input type="text" class="form-control" v-model="onhireancillary.ancf_10" id="add_onhireancillary_ancf_10" />
			</div>
			<div class="col-2 text-end py-1">
				<label for="add_onhireancillary_ancf_10_electrical" class="form-label text-uppercase fw-bold m-0">Electrical</label>
			</div>
			<div class="col-2">
				<div>
					<select class="form-select" v-model="onhireancillary.ancf_10_electrical" id="add_ancf_10_electrical">
						<optgroup v-if="allAncf10ElectricalList" label="Choose">
							<template v-for="ancf10Electrical in allAncf10ElectricalList" :key="ancf10Electrical.id">
								<option :value="ancf10Electrical.id">{{ ancf10Electrical.title }}</option>
							</template>
						</optgroup>
					</select>
				</div>
			</div>
			<div class="col-2 text-end py-1">
				<label for="add_onhireancillary_ancf_10_manufacturer" class="form-label text-uppercase fw-bold m-0">Manufacturer</label>
			</div>
			<div class="col-2">
				<div>
					<input type="text" class="form-control" v-model="onhireancillary.ancf_10_manufacturer" id="add_onhireancillary_ancf_10_manufacturer" />
				</div>
			</div>
		</div>
	</div>
</template>
<script setup>
	import {ref, watch, onMounted} from "vue";
	const initialAncState = {
		id: 0,
		onhire_id: 0,
		ancf_1: "",
		ancf_1_cladding: -1,
		ancf_2: "",
		ancf_2_ladder: -1,
		ancf_2_ladder_type: -1,
		ancf_3: "",
		ancf_3_placard: -1,
		ancf_4: "",
		ancf_4_decals: -1,
		ancf_5: "",
		ancf_5_tgauge: 1,
		ancf_5_other: "",
		ancf_5_temperature: "",
		ancf_5_ttype: -1,
		ancf_6: "",
		ancf_6_doc_tube: "",
		ancf_7: "",
		ancf_7_steam_tube: "",
		ancf_7_steam_tube_value_1: 1,
		ancf_7_steam_tube_value_2: -1,
		ancf_8: "",
		ancf_8_steam_acc: "",
		ancf_8_steam_acc_value: -1,
		ancf_9: "",
		ancf_9_bottom_comp: -1,
		ancf_10: "",
		ancf_10_electrical: -1,
		ancf_10_manufacturer: ""
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
	let onhireancillary = ref({ });
	// onMounted(() => {
	// 	onhireancillary.value = {...initialAncState, ...props.modelValue};
	// });
	let allAncf1CladdingList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "SS/ALU"},
		{id: "2", title: "SS"},
		{id: "3", title: "ALU"},
		{id: "4", title: "GRP"}
	]);
	let allAncf2LadderList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "Front"},
		{id: "2", title: "Rear Ladder"},
		{id: "3", title: "Front Ladder & Rear Ladder"}
	]);
	let allAncf2LadderTypeList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "IRON"},
		{id: "2", title: "SS"},
		{id: "3", title: "ALU"},
		{id: "4", title: "Galvanized"}
	]);
	let allAncf3PlacardList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "0"},
		{id: "2", title: "1"},
		{id: "3", title: "2"},
		{id: "4", title: "3"},
		{id: "5", title: "4"},
		{id: "6", title: "5"},
		{id: "7", title: "6"},
		{id: "8", title: "7"},
		{id: "9", title: "8"},
		{id: "10", title: "9"},
		{id: "11", title: "10"},
		{id: "12", title: "11"},
		{id: "13", title: "12"},
		{id: "14", title: "13"},
		{id: "15", title: "14"},
		{id: "16", title: "15"},
		{id: "17", title: "16"},
		{id: "18", title: "17"},
		{id: "19", title: "18"},
		{id: "20", title: "19"},
		{id: "21", title: "20"}
	]);
	let allAncf4DecalsList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "Weight / Capacity"},
		{id: "2", title: "Foodlogo"}
	]);
	let allAncf5TgaugeList = ref([
		{id: "1", title: "Fortvale"},
		{id: "2", title: "Perolo"},
		{id: "0", title: "Other"}
	]);
	let allAncf5TtypeList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "Analog"},
		{id: "2", title: "Digital"}
	]);
	let allAncf7SteamTubeValue1List = ref([{id: "1", title: "BSP"}]);
	let allAncf7SteamTubeValue2List = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "SS"},
		{id: "2", title: "PVC"},
		{id: "3", title: "ALU"},
		{id: "4", title: "BRASS"}
	]);
	let allAncf8SteamAccValueList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "X Drainvalve"},
		{id: "2", title: "X Pv"}
	]);
	let allAncf9BottomCompList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "IRON"},
		{id: "2", title: "SS"},
		{id: "3", title: "ALU"}
	]);
	let allAncf10ElectricalList = ref([
		{id: "-1", title: "NA"},
		{id: "1", title: "Heating"},
		{id: "2", title: "Cooling"}
	]);
	const updateAncRecord = () => {
		if (onhireancillary !== null && onhireancillary !== undefined && onhireancillary.value !== null && onhireancillary.value !== undefined)
			emit("update:modelValue", onhireancillary.value);
	};
	// Watch
	watch(
		() => onhireancillary,
		(newValue, oldValue) => {
			updateAncRecord();
		},
		{immediate: true, deep: true}
	);
	watch(
		() => props.mainObject?.refresh,
		(newValue, oldValue) => {
			if( newValue == true ){
				onhireancillary.value = {...initialAncState, ...props.mainObject};
				delete onhireancillary.value.refresh;
			}
		},
		{immediate: true, deep: true}
	);
</script>
<style>
	#add-onhire-anc {
		label {
			font-size: 85%;
		}
	}
</style>
