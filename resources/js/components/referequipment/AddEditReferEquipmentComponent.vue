<template>
	<div id="referequipment-main">
		<div class="row mb-1" v-if="!isModal">
			<div class="col-sm-7">
				<div class="d-flex align-items-center mb-2">
					<a id="add_referequipment_btn" class="btn btn-dark btn-sm me-4 d-flex align-items-center gap-2" :href="docRoot+'/referequipment'" role="button"><i class="ph ph-arrow-left "></i>Back to list</a>
					<!-- <h4 class="m-0 text-capitalize">Add referequipment</h4> -->
				</div>
			</div>
		</div>
		<div class="row py-2 bg-dark">
			<h4 class="fw-bold text-white text-center m-0">Add Record in the System.</h4>
		</div>
		<!-- ref and company name  -->
		<div class="row mb-4 align-items-center">
			<div class="col-md-2">
				<label for="add_referequipment_ref_no" class="form-label text-uppercase m-0">Ref No</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<div class="input-group">
					<input type="text" class="form-control" v-model="referequipmentFormObj.ref_no" id="add_referequipment_ref_no" placeholder="Enter Ref No" disabled>
				</div>
			</div>
			<div class="col-md-2">
				<label for="add_referequipment_company_id" class="form-label text-uppercase m-0">Company Name</label>
			</div>
			<div class="col-md-4">
				<div>
					<multiselect v-model="referequipmentFormObj.company_id" :options="allCompanyIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
			</div>
		</div>
		<!-- ref and company name  -->
		<!-- inspection date  -->
		<div class='row align-items-center mb-4'>
			<div class="col-md-6 d-none d-md-block"></div>
			<div class="col-md-2">
				<label for="add_referequipment_inspection_date" class="form-label text-uppercase m-0">Inspection Date</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<input type="text" class="form-control"  v-model="referequipmentFormObj.inspection_date" id="add_referequipment_inspection_date" placeholder="Enter Inspection Date" >
			</div>
		</div>
		<!-- inspection date  -->
		<!-- place of inspection & on behalf  -->
		<div class='row mb-4  align-items-center'>
			<label for="add_referequipment_inspection_location_id" class="form-label text-uppercase m-0 col-md-2">Place of Inspection</label>
			<div class="col-md-4 mb-3 mb-md-0">
				<multiselect v-model="referequipmentFormObj.inspection_location_id" :options="allInspectionLocationIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
			</div>
			<label for="add_referequipment_customer_id" class="form-label text-uppercase m-0 col-md-2">On Behalf of</label>
			<div class="col-md-4 mb-3 mb-md-0">
				<multiselect v-model="referequipmentFormObj.customer_id" :options="allCustomerIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
			</div>
		</div>
		<!-- place of inspection & on behalf  -->
		<!-- container no. & shipping agency  -->
		<div class='row mb-4  align-items-center'>
			<div class="col-md-2">
				<label for="add_referequipment_tank_no" class="form-label text-uppercase m-0">Container No</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<input type="text" class="form-control"  v-model="referequipmentFormObj.tank_no" id="add_referequipment_tank_no" placeholder="Enter Container No" >
			</div>
			<div class="col-md-2">
				<label for="add_referequipment_shipping_agency" class="form-label text-uppercase m-0">Shipping Agency</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<input type="text" class="form-control"  v-model="referequipmentFormObj.shipping_agency" id="add_referequipment_shipping_agency" placeholder="Enter Shipping Agency" >
			</div>
		</div>
		<!-- container no. & shipping agency  -->
		<!-- Container type & booking number  -->
		<div class='row mb-4  align-items-center'>
			<label for="add_referequipment_container_type" class="form-label text-uppercase m-0 col-md-2">Container Type</label>
			<div class="col-md-4 mb-3 mb-md-0">
				<multiselect v-model="referequipmentFormObj.container_type" :options="allContainerTypeList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
			</div>
			<div class="col-md-2">
				<label for="add_referequipment_booking_no" class="form-label text-uppercase m-0">Booking No</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<input type="text" class="form-control"  v-model="referequipmentFormObj.booking_no" id="add_referequipment_booking_no" placeholder="Enter Booking No" >
			</div>
		</div>
		<!-- Container type & booking number  -->
		<!-- model -->
		<div class='row mb-4  align-items-center'>
			<div class="col-md-6"></div>
			<div class="col-md-2">
				<label for="add_referequipment_model" class="form-label text-uppercase m-0 ">Model</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<input type="text" class="form-control"  v-model="referequipmentFormObj.model" id="add_referequipment_model" placeholder="Enter Model" >
			</div>
		</div>
		<!-- model -->
		<!-- serial & in service  -->
		<div class='row mb-4  align-items-center'>
			<div class="col-md-2">
				<label for="add_referequipment_serial" class="form-label text-uppercase m-0">Serial</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<input type="text" class="form-control"  v-model="referequipmentFormObj.serial" id="add_referequipment_serial" placeholder="Enter Serial" >
			</div>
			<div class="col-md-2">
				<label for="add_referequipment_in_service" class="form-label text-uppercase m-0">In Service</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<input type="text" class="form-control"  v-model="referequipmentFormObj.in_service" id="add_referequipment_in_service" placeholder="Enter In Service" >
			</div>
		</div>
		<!-- serial & in service  -->
		<!-- Date & plugged  -->
		<div class='row mb-4  align-items-center'>
			<div class="col-md-2">
				<label for="add_referequipment_date_of_last_pretrip" class="form-label text-uppercase m-0">Date of last Pre-Trip Insp.</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<input type="text" class="form-control"  v-model="referequipmentFormObj.date_of_last_pretrip" id="add_referequipment_date_of_last_pretrip" placeholder="Enter Date Of Last Pretrip" >
			</div>
			<div class="col-md-2">
				<label for="add_referequipment_run_through" class="form-label text-uppercase m-0">Plugged in to Power Supply & run through</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				
				<input type="text" class="form-control"  v-model="referequipmentFormObj.run_through" id="add_referequipment_run_through" placeholder="Enter Run Through" >
				
			</div>
		</div>
		<!-- Date & plugged  -->
		<!-- temperature set and Rechecked -->
		<div class='row mb-4  align-items-center'>
			<div class="col-md-2">
				<label for="add_referequipment_temperature_set_pti" class="form-label text-uppercase m-0">Temperature Set (PTI)</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<input type="text" class="form-control"  v-model="referequipmentFormObj.temperature_set_pti" id="add_referequipment_temperature_set_pti" placeholder="Enter Temperature Set Pti" >
			</div>
			<div class="col-md-2">
				<label for="add_referequipment_temperature_set_rechecked" class="form-label text-uppercase m-0">Temp.Set Rechecked</label>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<input type="text" class="form-control"  v-model="referequipmentFormObj.temperature_set_rechecked" id="add_referequipment_temperature_set_rechecked" placeholder="Enter Temperature Set Rechecked" >
			</div>
		</div>
		<!-- temperature set and Rechecked -->
		<div class="row py-2 bg-dark mb-3">
			<h4 class="fw-bold text-white text-center m-0">Container</h4>
		</div>
		<!-- container -->
		<div class="row mb-4  align-items-center">
			<div class="col-md-6">
				<div class='row gy-4 align-items-center'>
					<div class="col-md-6">
						<label for="add_referequipment_exterior" class="form-label text-uppercase m-0">Exterior</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						<input type="text" class="form-control"  v-model="referequipmentFormObj.exterior" id="add_referequipment_exterior" placeholder="Enter Exterior" >
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_exterior_right" class="form-label text-uppercase m-0">Right Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						<input type="text" class="form-control"  v-model="referequipmentFormObj.exterior_right" id="add_referequipment_exterior_right" placeholder="Enter Exterior Right" >
					</div>
					<div class="col-md-6">
						<label for="add_referequipment_exterior_left" class="form-label text-uppercase m-0">Left Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.exterior_left" id="add_referequipment_exterior_left" placeholder="Enter Exterior Left" >
						
					</div>
						
					<div class="col-md-6">
						<label for="add_referequipment_exterior_front" class="form-label text-uppercase m-0">Front Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.exterior_front" id="add_referequipment_exterior_front" placeholder="Enter Exterior Front" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_exterior_roof" class="form-label text-uppercase m-0">Roof</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.exterior_roof" id="add_referequipment_exterior_roof" placeholder="Enter Exterior Roof" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_exterior_under" class="form-label text-uppercase m-0">Under Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.exterior_under" id="add_referequipment_exterior_under" placeholder="Enter Exterior Under" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_exterior_rear" class="form-label text-uppercase m-0">Rear Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.exterior_rear" id="add_referequipment_exterior_rear" placeholder="Enter Exterior Rear" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_exterior_rear_door_right" class="form-label text-uppercase m-0">Rear Door Right Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.exterior_rear_door_right" id="add_referequipment_exterior_rear_door_right" placeholder="Enter Exterior Rear Door Right" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_exterior_rear_door_left" class="form-label text-uppercase m-0">Rear Door Left Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.exterior_rear_door_left" id="add_referequipment_exterior_rear_door_left" placeholder="Enter Exterior Rear Door Left" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_seaworthiness" class="form-label text-uppercase m-0">Seaworthiness</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.seaworthiness" id="add_referequipment_seaworthiness" placeholder="Enter Seaworthiness" >
						
					</div>
						
				</div>
			</div>
			<div class="col-md-6">
				<div class='row gy-4 align-items-center'>
					<div class="col-md-6">
						<label for="add_referequipment_interior" class="form-label text-uppercase m-0">Interior</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						<input type="text" class="form-control"  v-model="referequipmentFormObj.interior" id="add_referequipment_interior" placeholder="Enter Interior" >
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_interior_right" class="form-label text-uppercase m-0">Right Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						<input type="text" class="form-control"  v-model="referequipmentFormObj.interior_right" id="add_referequipment_interior_right" placeholder="Enter Interior Right" >
					</div>
					<div class="col-md-6">
						<label for="add_referequipment_interior_left" class="form-label text-uppercase m-0">Left Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						<input type="text" class="form-control"  v-model="referequipmentFormObj.interior_left" id="add_referequipment_interior_left" placeholder="Enter Interior Left" >
					</div>
					<div class="col-md-6">
						<label for="add_referequipment_interior_front" class="form-label text-uppercase m-0">Front Side & Baffle Plate</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.interior_front" id="add_referequipment_interior_front" placeholder="Enter Interior Front" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_interior_ceiling" class="form-label text-uppercase m-0">Ceiling</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.interior_ceiling" id="add_referequipment_interior_ceiling" placeholder="Enter Interior Ceiling" >
						
					</div>
					<div class="col-md-6">
						<label for="add_referequipment_interior_floor" class="form-label text-uppercase m-0">Floor</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.interior_floor" id="add_referequipment_interior_floor" placeholder="Enter Interior Floor" >
						
					</div>
					<div class="col-md-6">
						<label for="add_referequipment_interior_rear" class="form-label text-uppercase m-0">Rear Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.interior_rear" id="add_referequipment_interior_rear" placeholder="Enter Interior Rear" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_interior_rear_door_right" class="form-label text-uppercase m-0">Rear Door Right Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.interior_rear_door_right" id="add_referequipment_interior_rear_door_right" placeholder="Enter Interior Rear Door Right" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_interior_rear_door_left" class="form-label text-uppercase m-0">Rear Door Left Side</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.interior_rear_door_left" id="add_referequipment_interior_rear_door_left" placeholder="Enter Interior Rear Door Left" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_clean_free_from_odour" class="form-label text-uppercase m-0">Clean & free from any Odour</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.clean_free_from_odour" id="add_referequipment_clean_free_from_odour" placeholder="Enter Clean Free From Odour" >
						
					</div>
						
				</div>
			</div>
		</div>
		<!-- container -->
		<div class="row py-2 bg-dark mb-3">
			<h4 class="fw-bold text-white text-center m-0">Refrigeration Machinery</h4>
		</div>
		<!-- Refrigeration Machinery -->
		<div class="row mb-4  align-items-center">
			<div class="col-md-6">
				<div class='row gy-4 align-items-center'>
					<div class="col-md-6">
						<label for="add_referequipment_cable_440" class="form-label text-uppercase m-0">440 V Cable 18 mtrs.</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.cable_440" id="add_referequipment_cable_440" placeholder="Enter 440 V Cable 18 mtrs." >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_controller" class="form-label text-uppercase m-0">Controller</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						<input type="text" class="form-control"  v-model="referequipmentFormObj.controller" id="add_referequipment_controller" placeholder="Enter Controller" >
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_transformer" class="form-label text-uppercase m-0">Transformer</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.transformer" id="add_referequipment_transformer" placeholder="Enter Transformer" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_mcb" class="form-label text-uppercase m-0">MCB</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.mcb" id="add_referequipment_mcb" placeholder="Enter Mcb" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_compressor" class="form-label text-uppercase m-0">Compressor</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.compressor" id="add_referequipment_compressor" placeholder="Enter Compressor" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_unit_bolts_fasteners" class="form-label text-uppercase m-0">Unit Bolts Fasteners</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.unit_bolts_fasteners" id="add_referequipment_unit_bolts_fasteners" placeholder="Enter Unit Bolts Fasteners" >
						
					</div>
						
				</div>
			</div>
			<div class="col-md-6">
				<div class='row gy-4 align-items-center'>
					<div class="col-md-6">
						<label for="add_referequipment_power_plug_440" class="form-label text-uppercase m-0">440 V Power Plug</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.power_plug_440" id="add_referequipment_power_plug_440" placeholder="Enter 440 V Power Plug" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_contactors" class="form-label text-uppercase m-0">Contactors</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.contactors" id="add_referequipment_contactors" placeholder="Enter Contactors" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_battery" class="form-label text-uppercase m-0">Battery</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.battery" id="add_referequipment_battery" placeholder="Enter Battery" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_display_board" class="form-label text-uppercase m-0">Display Board</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.display_board" id="add_referequipment_display_board" placeholder="Enter Display Board" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_wiring_terminals" class="form-label text-uppercase m-0">Wiring terminals & connections in control boxes</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						
						<input type="text" class="form-control"  v-model="referequipmentFormObj.wiring_terminals" id="add_referequipment_wiring_terminals" placeholder="Enter Wiring Terminals" >
						
					</div>
					
					<div class="col-md-6">
						<label for="add_referequipment_refg_run_through" class="form-label text-uppercase m-0">Plugged in to Power Supply , run through & Temperature  set ⁰ C checked</label>
					</div>
					<div class="col-md-6 mb-3 mb-md-0">
						<input type="text" class="form-control"  v-model="referequipmentFormObj.refg_run_through" id="add_referequipment_refg_run_through" placeholder="Enter Refg Run Through" >
					</div>
				</div>
			</div>
		</div>
		<!-- Refrigeration Machinery -->
		<!-- Comments -->
		<div class='row mb-4  align-items-center'>
			<div class="col">
				<label for="add_referequipment_comments" class="form-label text-uppercase fw-bold mb-2">Comments</label>
				<div>
					<textarea class="form-control" v-model="referequipmentFormObj.comments" rows="3" id="add_referequipment_comments" placeholder="Enter Comments"></textarea>
				</div>
				
			</div>

		</div>
		<!-- Comments -->
		<!-- Surveyors name -->
		<div class='row mb-4  align-items-center'>
			<div class="col">
				<label for="add_referequipment_surveyor_id" class="form-label fw-bold text-uppercase mb-2">Surveyor's Name:</label>
				<div>
					<multiselect v-model="referequipmentFormObj.surveyor_id" :options="allSurveyorIdList" :custom-label="displayLabelSetting" placeholder="Select one"></multiselect>
				</div>
				
			</div>
		</div>
		<!-- Surveyors name -->
		<div class="row justify-content-center" v-if="!isModal">
			<div class="col-5">
				<a class="btn btn-success w-100" @click="saveReferEquipment()">Save</a>
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
ref_no:'AUTOGENERATED',
company_id:'',
inspection_date:'',
inspection_location_id:'',
customer_id:'',
tank_no:'',
shipping_agency:'',
container_type:'',
booking_no:'',
model:'',
serial:'',
in_service:'',
date_of_last_pretrip:'',
run_through:'',
temperature_set_pti:'',
temperature_set_rechecked:'',
exterior:'',
exterior_right:'',
exterior_left:'',
exterior_front:'',
exterior_roof:'',
exterior_under:'',
exterior_rear:'',
exterior_rear_door_right:'',
exterior_rear_door_left:'',
seaworthiness:'',
interior:'',
interior_right:'',
interior_left:'',
interior_front:'',
interior_ceiling:'',
interior_floor:'',
interior_rear:'',
interior_rear_door_right:'',
interior_rear_door_left:'',
clean_free_from_odour:'',
cable_440:'',
controller:'',
transformer:'',
mcb:'',
compressor:'',
unit_bolts_fasteners:'',
power_plug_440:'',
contactors:'',
battery:'',
display_board:'',
wiring_terminals:'',
refg_run_through:'',
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
	name: "ReferEquipmentmaster",
	props: ['current_user_id', 'all_permissions','id', 'isModal', 'referequipmentForAdd', 'reload', 'closed'],
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
			allCustomerIdList: [],
			allContainerTypeList: [],
			allSurveyorIdList: [],

			
			referequipmentFormObj: initialState(),
		}
	},
	validations() {
		return {
			referequipmentFormObj: initialStateValidations()
		};
	},
	
	methods: {
		canceladdedit(event){
			window.location = this.docRoot + '/referequipment';
		},
		formatDate(date) {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
		async saveReferEquipment(event){
			var that = this;
			const result = await that.v$.$validate();
			if (!result) {
				that.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
				console.log(that.v$.$errors);
				return;
			}
			
			if( !that.referequipmentFormObj.action || that.referequipmentFormObj.action == "" )
				that.referequipmentFormObj.action = "details";
			that.referequipmentFormObj.created_by = that.current_user_id;
			
			// if (  typeof that.referequipmentFormObj.company_id === 'object' && that.referequipmentFormObj.company_id.id) {
			// 	that.referequipmentFormObj.company_id = that.referequipmentFormObj.company_id.id;
			// }
			// if (  typeof that.referequipmentFormObj.inspection_location_id === 'object' && that.referequipmentFormObj.inspection_location_id.id) {
			// 	that.referequipmentFormObj.inspection_location_id = that.referequipmentFormObj.inspection_location_id.id;
			// }
			// if (  typeof that.referequipmentFormObj.customer_id === 'object' && that.referequipmentFormObj.customer_id.id) {
			// 	that.referequipmentFormObj.customer_id = that.referequipmentFormObj.customer_id.id;
			// }
			// if (  typeof that.referequipmentFormObj.surveyor_id === 'object' && that.referequipmentFormObj.surveyor_id.id) {
			// 	that.referequipmentFormObj.surveyor_id = that.referequipmentFormObj.surveyor_id.id;
			// }
			if (  typeof that.referequipmentFormObj.container_type === 'object' &&  Object.keys(that.referequipmentFormObj.container_type).length > 0) {
			that.referequipmentFormObj.container_type = that.referequipmentFormObj.container_type;
			}
			that.showLoading("Saving ...");
			axios.post(that.docRoot+'/referequipment/save', { referequipment: that.referequipmentFormObj }).then(async function (response) {
				that.closeSwal();
				var status = response.data.status;
				if( status == 1 ){
					// Set the ID so that duplicate records will not be created
					that.referequipmentFormObj.id = response.data.id;
					that.showToast('ReferEquipment saved successfully', 'success', 'bottom', 3000);
					setTimeout(() => {
						window.location = that.docRoot + "/referequipment/";
						that.showLoading("Loading ...");
					}, 1500);
				}
				else{
					that.showErrors("ReferEquipment could not be saved successfully.", response.data.messages, "bottom", 3000);
				}
			})
			.catch(function (error) {
				console.log(error);
				that.closeSwal();
				that.showToast("ReferEquipment could not be saved successfully.", "error", "bottom", 3000);
			});
		},
		
		reloadEverything() {
			if (this.id !== undefined && !isNaN(this.id)) {
				this.mode = "edit";
				
				// This is Edit mode - fetch inquiry data
				var that = this;
				var URL = this.docRoot + "/api/referequipment/get-record/" + this.id;
				this.showLoading("Loading ...");
				axios
					.post(URL, {})
					.then(function (response) {
						that.closeSwal();
						that.referequipmentFormObj = Object.assign({}, response.data);
						if ( that.referequipmentFormObj.container_type && typeof that.referequipmentFormObj.container_type === 'string' ) {
						that.referequipmentFormObj.container_type = JSON.parse(that.referequipmentFormObj.container_type);
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
		let _allCompanyIdList = await this.loadMasterData(this.docRoot+'/api/user/get', 'post', {});
		if(Array.isArray(_allCompanyIdList) && _allCompanyIdList.length > 0){
			this.allCompanyIdList = _allCompanyIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allInspectionLocationIdList = await this.loadMasterData(this.docRoot + '/api/user/get', 'post', {});
		if(Array.isArray(_allInspectionLocationIdList) && _allInspectionLocationIdList.length > 0){
		this.allInspectionLocationIdList = _allInspectionLocationIdList.map(x => {return { id: x.id, text: x.name }});
		}
		let _allCustomerIdList = await this.loadMasterData(this.docRoot + '/api/user/get', 'post', {});
		if(Array.isArray(_allCustomerIdList) && _allCustomerIdList.length > 0){
			this.allCustomerIdList = _allCustomerIdList.map(x => {return { id: x.id, text: x.name }});
		}
		this.allContainerTypeList = [{ id: '1', text: '20RF' }, { id: '2', text: '40RF' },];
		let _allSurveyorIdList = await this.loadMasterData(this.docRoot+'/api/user/get', 'post', {});
		if(Array.isArray(_allSurveyorIdList) && _allSurveyorIdList.length > 0){
			this.allSurveyorIdList = _allSurveyorIdList.map(x => {return { id: x.id, text: x.name }});
		}
			if (this.referequipmentFormObj.company_id) {
			if (Array.isArray(this.allCompanyIdList) && this.allCompanyIdList.length > 0) {
				let _allRelationList = this.allCompanyIdList;
				let relationId = parseInt(this.referequipmentFormObj.company_id);
				this.referequipmentFormObj.company_id = _allRelationList.find(item => item.id === relationId);
			}
		}if (this.referequipmentFormObj.inspection_location_id) {
			if (Array.isArray(this.allInspectionLocationIdList) && this.allInspectionLocationIdList.length > 0) {
				let _allRelationList = this.allInspectionLocationIdList;
				let relationId = parseInt(this.referequipmentFormObj.inspection_location_id);
				this.referequipmentFormObj.inspection_location_id = _allRelationList.find(item => item.id === relationId);
			}
		}if (this.referequipmentFormObj.customer_id) {
			if (Array.isArray(this.allCustomerIdList) && this.allCustomerIdList.length > 0) {
				let _allRelationList = this.allCustomerIdList;
				let relationId = parseInt(this.referequipmentFormObj.customer_id);
				this.referequipmentFormObj.customer_id = _allRelationList.find(item => item.id === relationId);
			}
		}if (this.referequipmentFormObj.surveyor_id) {
			if (Array.isArray(this.allSurveyorIdList) && this.allSurveyorIdList.length > 0) {
				let _allRelationList = this.allSurveyorIdList;
				let relationId = parseInt(this.referequipmentFormObj.surveyor_id);
				this.referequipmentFormObj.surveyor_id = _allRelationList.find(item => item.id === relationId);
			}
		}
	}
}
</script>
<style>
	.ql-container{height: 60px !important;}
</style>
