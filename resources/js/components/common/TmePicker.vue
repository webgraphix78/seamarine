<template>
	<div class="time-picker input-group w-100">
		<select v-model="selectedHour" @change="validateTime" class="form-select">
			<option v-for="hour in hours" :key="hour" :value="hour">{{ hour }}</option>
		</select>
		<select v-model="selectedMinute" @change="validateTime" class="form-select">
			<option v-for="minute in minutes" :key="minute" :value="minute">{{ minute }}</option>
		</select>
		<select v-if="showSeconds" v-model="selectedSecond" @change="validateTime" class="form-select">
			<option v-for="second in seconds" :key="second" :value="second">{{ second }}</option>
		</select>
		<select v-if="mode === '12'" v-model="selectedPeriod" @change="validateTime" class="form-select">
			<option value="AM">AM</option>
			<option value="PM">PM</option>
		</select>
		<div v-if="error" class="error">{{ error }}</div>
	</div>
</template>

<script>
export default {
	name: 'TimePicker',
	props: {
		mode: {
			type: String,
			default: '24',
			validator: value => ['12', '24'].includes(value)
		},
		minuteStep: {
			type: Number,
			default: 1,
			validator: value => [1, 5, 10, 15].includes(value)
		},
		showSeconds: {
			type: Boolean,
			default: false
		},
		minTime: {
			type: String,
			default: '00:00:00'
		},
		maxTime: {
			type: String,
			default: '23:59:59'
		}
	},
	data() {
		return {
			selectedHour: null,
			selectedMinute: 0,
			selectedSecond: 0,
			selectedPeriod: 'AM',
			error: ''
		};
	},
	computed: {
		hours() {
			return this.mode === '24' ? Array.from({ length: 24 }, (_, i) => i) : Array.from({ length: 12 }, (_, i) => i + 1);
		},
		minutes() {
			return Array.from({ length: 60 / this.minuteStep }, (_, i) => i * this.minuteStep);
		},
		seconds() {
			return Array.from({ length: 60 }, (_, i) => i);
		}
	},
	methods: {
		validateTime() {
			const hour = this.mode === '12' && this.selectedPeriod === 'PM' ? this.selectedHour + 12 : this.selectedHour;
			const time = `${hour}:${this.selectedMinute?this.selectedMinute:"00"}:${this.selectedSecond || '00'}`;
			console.log(time);
			if (time < this.minTime || time > this.maxTime) {
				this.error = 'Selected time is out of range';
			} else {
				this.error = '';
				this.$emit('time-selected', time);
			}
		}
	}
};
</script>

<style scoped>
.timse-picker {
	display: flex;
	flex-direction: column;
}
.error {
	color: red;
	margin-top: 5px;
}
</style>