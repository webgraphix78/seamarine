<template>
	<div id="imo5condition-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">IMO 5 CONDITION</h4>
							<a id="add_imo5_btn" class="btn btn-success btn-sm" :href="docRoot+'/imo5condition/add'">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewImo5Condition"  @upload-object="uploadImages" @print-object="printIMO5Condition" @duplicate-object="duplicateObject" @edit-object="prepareEditImo5Condition" @toggle-object-status="toggleImo5Condition"></DataTableComponent>
			</div>
		</div>

		<div class="modal fade" ref="readModal" id="readImo5ConditionModal" tabindex="-1" aria-labelledby="readImo5ConditionModalLabel" aria-hidden="true" v-if="readImo5Condition">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="readImo5ConditionModalLabel">View Imo5Condition</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Container No</label>
								<div>
									<span v-if="readImo5Condition.container_no">{{ readImo5Condition.container_no }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Tank Type Id</label>
								<div>
									<span v-if="readImo5Condition.tank_type?.type">{{ readImo5Condition.tank_type?.type }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Tcode</label>
								<div>
									<span v-if="readImo5Condition.tcode?.name">{{ readImo5Condition.tcode?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Client</label>
								<div>
									<span v-if="readImo5Condition.client">{{ readImo5Condition.client }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Capacity</label>
								<div>
									<span v-if="readImo5Condition.capacity">{{ readImo5Condition.capacity }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Mfgt Date</label>
								<div>
									<span v-if="readImo5Condition.mfgt_date">{{ formatMySQLDate(readImo5Condition.mfgt_date, "MMM dd, yyyy") }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Gross Wt</label>
								<div>
									<span v-if="readImo5Condition.gross_wt">{{ readImo5Condition.gross_wt }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Csc</label>
								<div>
									<span v-if="readImo5Condition.csc">{{ readImo5Condition.csc }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Inspection Location</label>
								<div>
									<span v-if="readImo5Condition.inspection_location?.name">{{ readImo5Condition.inspection_location?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Next Date</label>
								<div>
									<span v-if="readImo5Condition.next_date">{{ formatMySQLDate(readImo5Condition.next_date, "MMM dd, yyyy") }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Tare Wt</label>
								<div>
									<span v-if="readImo5Condition.tare_wt">{{ readImo5Condition.tare_wt }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Imo Status</label>
								<div>
									<span v-if="readImo5Condition.imo_status == '1'">Import</span>
									<span v-if="readImo5Condition.imo_status == '0'">Export</span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Sealed</label>
								<div>
									<span v-if="readImo5Condition.sealed == '1'">Sealed</span>
									<span v-if="readImo5Condition.sealed == '0'">Unsealed</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Cleaning Location</label>
								<div>
									<span v-if="readImo5Condition.cleaning_location?.name">{{ readImo5Condition.cleaning_location?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Survey Date</label>
								<div>
									<span v-if="readImo5Condition.survey_date">{{ formatMySQLDate(readImo5Condition.survey_date, "MMM dd, yyyy") }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Customer Id</label>
								<div>
									<span v-if="readImo5Condition.customer?.name">{{ readImo5Condition.customer?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Refno</label>
								<div>
									<span v-if="readImo5Condition.refno">{{ readImo5Condition.refno }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Scover</label>
								<div>
									<span v-if="readImo5Condition.scover == '1'">Yes</span>
									<span v-if="readImo5Condition.scover == '0'">No</span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Bvboxyn</label>
								<div>
									<span v-if="readImo5Condition.bvboxyn == '1'">Yes</span>
									<span v-if="readImo5Condition.bvboxyn == '0'">No</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Bvboxsu</label>
								<div>
									<span v-if="readImo5Condition.bvboxsu == '1'">Sealed</span>
									<span v-if="readImo5Condition.bvboxsu == '0'">Unsealed</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Comments</label>
								<div>
									<span v-if="readImo5Condition.comments">{{ readImo5Condition.comments }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Markings Fitted Yes</label>
								<div>
									<span v-if="readImo5Condition.markings_fitted_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.markings_fitted_yes == '0'">No</span>
									<span v-if="readImo5Condition.markings_fitted_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Markings Condition Good</label>
								<div>
									<span v-if="readImo5Condition.markings_condition_good == '1'">Yes</span>
									<span v-if="readImo5Condition.markings_condition_good == '0'">No</span>
									<span v-if="readImo5Condition.markings_condition_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Marking Plates</label>
								<div>
									<span v-if="readImo5Condition.marking_plates">{{ readImo5Condition.marking_plates }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Data Fitted Yes</label>
								<div>
									<span v-if="readImo5Condition.data_fitted_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.data_fitted_yes == '0'">No</span>
									<span v-if="readImo5Condition.data_fitted_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Data Condition Good</label>
								<div>
									<span v-if="readImo5Condition.data_condition_good == '1'">Yes</span>
									<span v-if="readImo5Condition.data_condition_good == '0'">No</span>
									<span v-if="readImo5Condition.data_condition_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Data Plate</label>
								<div>
									<span v-if="readImo5Condition.data_plate">{{ readImo5Condition.data_plate }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Owners Plate Yes</label>
								<div>
									<span v-if="readImo5Condition.owners_plate_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.owners_plate_yes == '0'">No</span>
									<span v-if="readImo5Condition.owners_plate_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Owners Plate Good</label>
								<div>
									<span v-if="readImo5Condition.owners_plate_good == '1'">Yes</span>
									<span v-if="readImo5Condition.owners_plate_good == '0'">No</span>
									<span v-if="readImo5Condition.owners_plate_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Owners Plate</label>
								<div>
									<span v-if="readImo5Condition.owners_plate">{{ readImo5Condition.owners_plate }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manufactures Plate Yes</label>
								<div>
									<span v-if="readImo5Condition.manufactures_plate_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.manufactures_plate_yes == '0'">No</span>
									<span v-if="readImo5Condition.manufactures_plate_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manufactures Plate Good</label>
								<div>
									<span v-if="readImo5Condition.manufactures_plate_good == '1'">Yes</span>
									<span v-if="readImo5Condition.manufactures_plate_good == '0'">No</span>
									<span v-if="readImo5Condition.manufactures_plate_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manufactures Plates</label>
								<div>
									<span v-if="readImo5Condition.manufactures_plates">{{ readImo5Condition.manufactures_plates }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Csc Plate Yes</label>
								<div>
									<span v-if="readImo5Condition.csc_plate_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.csc_plate_yes == '0'">No</span>
									<span v-if="readImo5Condition.csc_plate_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Csc Plate Good</label>
								<div>
									<span v-if="readImo5Condition.csc_plate_good == '1'">Yes</span>
									<span v-if="readImo5Condition.csc_plate_good == '0'">No</span>
									<span v-if="readImo5Condition.csc_plate_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Csc Plate</label>
								<div>
									<span v-if="readImo5Condition.csc_plate">{{ readImo5Condition.csc_plate }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Customs Plate Yes</label>
								<div>
									<span v-if="readImo5Condition.customs_plate_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.customs_plate_yes == '0'">No</span>
									<span v-if="readImo5Condition.customs_plate_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Customs Plate Good</label>
								<div>
									<span v-if="readImo5Condition.customs_plate_good == '1'">Yes</span>
									<span v-if="readImo5Condition.customs_plate_good == '0'">No</span>
									<span v-if="readImo5Condition.customs_plate_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Customs Plate</label>
								<div>
									<span v-if="readImo5Condition.customs_plate">{{ readImo5Condition.customs_plate }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Prefix Yes</label>
								<div>
									<span v-if="readImo5Condition.prefix_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.prefix_yes == '0'">No</span>
									<span v-if="readImo5Condition.prefix_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Prefix Good</label>
								<div>
									<span v-if="readImo5Condition.prefix_good == '1'">Yes</span>
									<span v-if="readImo5Condition.prefix_good == '0'">No</span>
									<span v-if="readImo5Condition.prefix_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Prefix</label>
								<div>
									<span v-if="readImo5Condition.prefix">{{ readImo5Condition.prefix }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Imo Yes</label>
								<div>
									<span v-if="readImo5Condition.imo_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.imo_yes == '0'">No</span>
									<span v-if="readImo5Condition.imo_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Imo Good</label>
								<div>
									<span v-if="readImo5Condition.imo_good == '1'">Yes</span>
									<span v-if="readImo5Condition.imo_good == '0'">No</span>
									<span v-if="readImo5Condition.imo_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Imo</label>
								<div>
									<span v-if="readImo5Condition.imo">{{ readImo5Condition.imo }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Country Code Yes</label>
								<div>
									<span v-if="readImo5Condition.country_code_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.country_code_yes == '0'">No</span>
									<span v-if="readImo5Condition.country_code_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Country Code Good</label>
								<div>
									<span v-if="readImo5Condition.country_code_good == '1'">Yes</span>
									<span v-if="readImo5Condition.country_code_good == '0'">No</span>
									<span v-if="readImo5Condition.country_code_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Country Code</label>
								<div>
									<span v-if="readImo5Condition.country_code">{{ readImo5Condition.country_code }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Rear Ladder Yes</label>
								<div>
									<span v-if="readImo5Condition.rear_ladder_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.rear_ladder_yes == '0'">No</span>
									<span v-if="readImo5Condition.rear_ladder_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Rear Ladder Good</label>
								<div>
									<span v-if="readImo5Condition.rear_ladder_good == '1'">Yes</span>
									<span v-if="readImo5Condition.rear_ladder_good == '0'">No</span>
									<span v-if="readImo5Condition.rear_ladder_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Front Ladder</label>
								<div>
									<span v-if="readImo5Condition.front_ladder">{{ readImo5Condition.front_ladder }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Document Box Yes</label>
								<div>
									<span v-if="readImo5Condition.document_box_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.document_box_yes == '0'">No</span>
									<span v-if="readImo5Condition.document_box_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Document Box Good</label>
								<div>
									<span v-if="readImo5Condition.document_box_good == '1'">Yes</span>
									<span v-if="readImo5Condition.document_box_good == '0'">No</span>
									<span v-if="readImo5Condition.document_box_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Document Box</label>
								<div>
									<span v-if="readImo5Condition.document_box">{{ readImo5Condition.document_box }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Outlet Yes</label>
								<div>
									<span v-if="readImo5Condition.outlet_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.outlet_yes == '0'">No</span>
									<span v-if="readImo5Condition.outlet_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Outlet Good</label>
								<div>
									<span v-if="readImo5Condition.outlet_good == '1'">Yes</span>
									<span v-if="readImo5Condition.outlet_good == '0'">No</span>
									<span v-if="readImo5Condition.outlet_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Outlet</label>
								<div>
									<span v-if="readImo5Condition.outlet">{{ readImo5Condition.outlet }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Bottom Outlet Yes</label>
								<div>
									<span v-if="readImo5Condition.bottom_outlet_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.bottom_outlet_yes == '0'">No</span>
									<span v-if="readImo5Condition.bottom_outlet_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Bottom Outlet Good</label>
								<div>
									<span v-if="readImo5Condition.bottom_outlet_good == '1'">Yes</span>
									<span v-if="readImo5Condition.bottom_outlet_good == '0'">No</span>
									<span v-if="readImo5Condition.bottom_outlet_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Bottom Outlet</label>
								<div>
									<span v-if="readImo5Condition.bottom_outlet">{{ readImo5Condition.bottom_outlet }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Foot Valve Yes</label>
								<div>
									<span v-if="readImo5Condition.foot_valve_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.foot_valve_yes == '0'">No</span>
									<span v-if="readImo5Condition.foot_valve_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Foot Valve Good</label>
								<div>
									<span v-if="readImo5Condition.foot_valve_good == '1'">Yes</span>
									<span v-if="readImo5Condition.foot_valve_good == '0'">No</span>
									<span v-if="readImo5Condition.foot_valve_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Foot Valve</label>
								<div>
									<span v-if="readImo5Condition.foot_valve">{{ readImo5Condition.foot_valve }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Remote Footvalve Yes</label>
								<div>
									<span v-if="readImo5Condition.remote_footvalve_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.remote_footvalve_yes == '0'">No</span>
									<span v-if="readImo5Condition.remote_footvalve_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Remote Footvalve Good</label>
								<div>
									<span v-if="readImo5Condition.remote_footvalve_good == '1'">Yes</span>
									<span v-if="readImo5Condition.remote_footvalve_good == '0'">No</span>
									<span v-if="readImo5Condition.remote_footvalve_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Remote Footvalve</label>
								<div>
									<span v-if="readImo5Condition.remote_footvalve">{{ readImo5Condition.remote_footvalve }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Steam Tubes Yes</label>
								<div>
									<span v-if="readImo5Condition.steam_tubes_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.steam_tubes_yes == '0'">No</span>
									<span v-if="readImo5Condition.steam_tubes_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Steam Tubes Good</label>
								<div>
									<span v-if="readImo5Condition.steam_tubes_good == '1'">Yes</span>
									<span v-if="readImo5Condition.steam_tubes_good == '0'">No</span>
									<span v-if="readImo5Condition.steam_tubes_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Steam Tubes</label>
								<div>
									<span v-if="readImo5Condition.steam_tubes">{{ readImo5Condition.steam_tubes }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Condensate Drains Yes</label>
								<div>
									<span v-if="readImo5Condition.condensate_drains_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.condensate_drains_yes == '0'">No</span>
									<span v-if="readImo5Condition.condensate_drains_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Condensate Drains Good</label>
								<div>
									<span v-if="readImo5Condition.condensate_drains_good == '1'">Yes</span>
									<span v-if="readImo5Condition.condensate_drains_good == '0'">No</span>
									<span v-if="readImo5Condition.condensate_drains_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Condensate Drains</label>
								<div>
									<span v-if="readImo5Condition.condensate_drains">{{ readImo5Condition.condensate_drains }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Thermometer Yes</label>
								<div>
									<span v-if="readImo5Condition.thermometer_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.thermometer_yes == '0'">No</span>
									<span v-if="readImo5Condition.thermometer_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Thermometer Good</label>
								<div>
									<span v-if="readImo5Condition.thermometer_good == '1'">Yes</span>
									<span v-if="readImo5Condition.thermometer_good == '0'">No</span>
									<span v-if="readImo5Condition.thermometer_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Thermometer</label>
								<div>
									<span v-if="readImo5Condition.thermometer">{{ readImo5Condition.thermometer }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Walkway Yes</label>
								<div>
									<span v-if="readImo5Condition.walkway_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.walkway_yes == '0'">No</span>
									<span v-if="readImo5Condition.walkway_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Walkway Good</label>
								<div>
									<span v-if="readImo5Condition.walkway_good == '1'">Yes</span>
									<span v-if="readImo5Condition.walkway_good == '0'">No</span>
									<span v-if="readImo5Condition.walkway_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Walkway</label>
								<div>
									<span v-if="readImo5Condition.walkway">{{ readImo5Condition.walkway }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manlid Protection Yes</label>
								<div>
									<span v-if="readImo5Condition.manlid_protection_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.manlid_protection_yes == '0'">No</span>
									<span v-if="readImo5Condition.manlid_protection_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manlid Protection Good</label>
								<div>
									<span v-if="readImo5Condition.manlid_protection_good == '1'">Yes</span>
									<span v-if="readImo5Condition.manlid_protection_good == '0'">No</span>
									<span v-if="readImo5Condition.manlid_protection_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manlid Protection</label>
								<div>
									<span v-if="readImo5Condition.manlid_protection">{{ readImo5Condition.manlid_protection }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Spillbox Yes</label>
								<div>
									<span v-if="readImo5Condition.spillbox_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.spillbox_yes == '0'">No</span>
									<span v-if="readImo5Condition.spillbox_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Spillbox Good</label>
								<div>
									<span v-if="readImo5Condition.spillbox_good == '1'">Yes</span>
									<span v-if="readImo5Condition.spillbox_good == '0'">No</span>
									<span v-if="readImo5Condition.spillbox_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Spillbox</label>
								<div>
									<span v-if="readImo5Condition.spillbox">{{ readImo5Condition.spillbox }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manlid Yes</label>
								<div>
									<span v-if="readImo5Condition.manlid_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.manlid_yes == '0'">No</span>
									<span v-if="readImo5Condition.manlid_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manlid Good</label>
								<div>
									<span v-if="readImo5Condition.manlid_good == '1'">Yes</span>
									<span v-if="readImo5Condition.manlid_good == '0'">No</span>
									<span v-if="readImo5Condition.manlid_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manlid</label>
								<div>
									<span v-if="readImo5Condition.manlid">{{ readImo5Condition.manlid }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manlid Bolts Yes</label>
								<div>
									<span v-if="readImo5Condition.manlid_bolts_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.manlid_bolts_yes == '0'">No</span>
									<span v-if="readImo5Condition.manlid_bolts_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manlid Bolts Good</label>
								<div>
									<span v-if="readImo5Condition.manlid_bolts_good == '1'">Yes</span>
									<span v-if="readImo5Condition.manlid_bolts_good == '0'">No</span>
									<span v-if="readImo5Condition.manlid_bolts_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Manlid Bolts</label>
								<div>
									<span v-if="readImo5Condition.manlid_bolts">{{ readImo5Condition.manlid_bolts }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Dipstick Yes</label>
								<div>
									<span v-if="readImo5Condition.dipstick_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.dipstick_yes == '0'">No</span>
									<span v-if="readImo5Condition.dipstick_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Dipstick Good</label>
								<div>
									<span v-if="readImo5Condition.dipstick_good == '1'">Yes</span>
									<span v-if="readImo5Condition.dipstick_good == '0'">No</span>
									<span v-if="readImo5Condition.dipstick_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Dipstick</label>
								<div>
									<span v-if="readImo5Condition.dipstick">{{ readImo5Condition.dipstick }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Safety Cover Yes</label>
								<div>
									<span v-if="readImo5Condition.safety_cover_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.safety_cover_yes == '0'">No</span>
									<span v-if="readImo5Condition.safety_cover_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Safety Cover Good</label>
								<div>
									<span v-if="readImo5Condition.safety_cover_good == '1'">Yes</span>
									<span v-if="readImo5Condition.safety_cover_good == '0'">No</span>
									<span v-if="readImo5Condition.safety_cover_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Safety Cover</label>
								<div>
									<span v-if="readImo5Condition.safety_cover">{{ readImo5Condition.safety_cover }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Calibration Chart Yes</label>
								<div>
									<span v-if="readImo5Condition.calibration_chart_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.calibration_chart_yes == '0'">No</span>
									<span v-if="readImo5Condition.calibration_chart_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Calibration Chart Good</label>
								<div>
									<span v-if="readImo5Condition.calibration_chart_good == '1'">Yes</span>
									<span v-if="readImo5Condition.calibration_chart_good == '0'">No</span>
									<span v-if="readImo5Condition.calibration_chart_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Calibration Chart</label>
								<div>
									<span v-if="readImo5Condition.calibration_chart">{{ readImo5Condition.calibration_chart }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Relief Valves Yes</label>
								<div>
									<span v-if="readImo5Condition.relief_valves_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.relief_valves_yes == '0'">No</span>
									<span v-if="readImo5Condition.relief_valves_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Relief Valves Good</label>
								<div>
									<span v-if="readImo5Condition.relief_valves_good == '1'">Yes</span>
									<span v-if="readImo5Condition.relief_valves_good == '0'">No</span>
									<span v-if="readImo5Condition.relief_valves_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Relief Valves</label>
								<div>
									<span v-if="readImo5Condition.relief_valves">{{ readImo5Condition.relief_valves }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Pressure Gauges Yes</label>
								<div>
									<span v-if="readImo5Condition.pressure_gauges_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.pressure_gauges_yes == '0'">No</span>
									<span v-if="readImo5Condition.pressure_gauges_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Pressure Gauges Good</label>
								<div>
									<span v-if="readImo5Condition.pressure_gauges_good == '1'">Yes</span>
									<span v-if="readImo5Condition.pressure_gauges_good == '0'">No</span>
									<span v-if="readImo5Condition.pressure_gauges_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Pressure Gauges</label>
								<div>
									<span v-if="readImo5Condition.pressure_gauges">{{ readImo5Condition.pressure_gauges }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Flame Traps Yes</label>
								<div>
									<span v-if="readImo5Condition.flame_traps_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.flame_traps_yes == '0'">No</span>
									<span v-if="readImo5Condition.flame_traps_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Flame Traps Good</label>
								<div>
									<span v-if="readImo5Condition.flame_traps_good == '1'">Yes</span>
									<span v-if="readImo5Condition.flame_traps_good == '0'">No</span>
									<span v-if="readImo5Condition.flame_traps_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Flame Traps</label>
								<div>
									<span v-if="readImo5Condition.flame_traps">{{ readImo5Condition.flame_traps }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Air Line Cap Yes</label>
								<div>
									<span v-if="readImo5Condition.air_line_cap_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.air_line_cap_yes == '0'">No</span>
									<span v-if="readImo5Condition.air_line_cap_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Air Line Cap Good</label>
								<div>
									<span v-if="readImo5Condition.air_line_cap_good == '1'">Yes</span>
									<span v-if="readImo5Condition.air_line_cap_good == '0'">No</span>
									<span v-if="readImo5Condition.air_line_cap_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Air Line Cap</label>
								<div>
									<span v-if="readImo5Condition.air_line_cap">{{ readImo5Condition.air_line_cap }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Air Line Valve Yes</label>
								<div>
									<span v-if="readImo5Condition.air_line_valve_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.air_line_valve_yes == '0'">No</span>
									<span v-if="readImo5Condition.air_line_valve_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Air Line Valve Good</label>
								<div>
									<span v-if="readImo5Condition.air_line_valve_good == '1'">Yes</span>
									<span v-if="readImo5Condition.air_line_valve_good == '0'">No</span>
									<span v-if="readImo5Condition.air_line_valve_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Air Line Valve</label>
								<div>
									<span v-if="readImo5Condition.air_line_valve">{{ readImo5Condition.air_line_valve }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Top Disch Prot Yes</label>
								<div>
									<span v-if="readImo5Condition.top_disch_prot_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.top_disch_prot_yes == '0'">No</span>
									<span v-if="readImo5Condition.top_disch_prot_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Top Disch Prot Good</label>
								<div>
									<span v-if="readImo5Condition.top_disch_prot_good == '1'">Yes</span>
									<span v-if="readImo5Condition.top_disch_prot_good == '0'">No</span>
									<span v-if="readImo5Condition.top_disch_prot_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Top Disch Prot</label>
								<div>
									<span v-if="readImo5Condition.top_disch_prot">{{ readImo5Condition.top_disch_prot }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Top Disch Valve Yes</label>
								<div>
									<span v-if="readImo5Condition.top_disch_valve_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.top_disch_valve_yes == '0'">No</span>
									<span v-if="readImo5Condition.top_disch_valve_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Top Disch Valve Good</label>
								<div>
									<span v-if="readImo5Condition.top_disch_valve_good == '1'">Yes</span>
									<span v-if="readImo5Condition.top_disch_valve_good == '0'">No</span>
									<span v-if="readImo5Condition.top_disch_valve_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Top Disch Valve</label>
								<div>
									<span v-if="readImo5Condition.top_disch_valve">{{ readImo5Condition.top_disch_valve }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Top Condition Yes</label>
								<div>
									<span v-if="readImo5Condition.top_condition_yes == '1'">Yes</span>
									<span v-if="readImo5Condition.top_condition_yes == '0'">No</span>
									<span v-if="readImo5Condition.top_condition_yes == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Top Condition Good</label>
								<div>
									<span v-if="readImo5Condition.top_condition_good == '1'">Yes</span>
									<span v-if="readImo5Condition.top_condition_good == '0'">No</span>
									<span v-if="readImo5Condition.top_condition_good == '-1'">NA</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Top Condition</label>
								<div>
									<span v-if="readImo5Condition.top_condition">{{ readImo5Condition.top_condition }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Status</label>
								<div>
									<span class="badge rounded-pill bg-success" v-if="readImo5Condition.status == 1">ACTIVE</span>
									<span class="badge rounded-pill bg-danger" v-if="readImo5Condition.status == 0">INACTIVE</span>
								</div>
							</div>
							<div class="col-4">
								<label class="form-label text-uppercase fw-bold m-0">Created By</label>
								<div>
									<span v-if="readImo5Condition.creator?.name">{{ readImo5Condition.creator?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">CLOSE</button>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Upload Images -->
		<UploadImages :dataprops="uploadDataprops" @refresh-object="refreshObject"></UploadImages>
		<!-- Upload Images -->
	</div>
</template>
<script>
	
	export default {
		name: "Imo5Conditionmaster",
		props: ["current_user_id", "all_permissions"],
		data() {
			return {
				dataprops: {
					id: "imo5condition-list",
					class: "a",
					base_url: this.docRoot+"/api/imo5condition/",
					columns: [
						{title: "Ref No", property: "refno"},
						{title: "Container No", property: "container_no"},
						{title: "Status", property: "imo_status", enum: {1: "Import", 0: "Export"}},
						{title: "Survey Date", property: "survey_date", date_type: "mysqldate", display_type: "date", format: "LLL dd, yyyy"},
						{title: "Customer Id", property: "customer.name", alt_value: "Not Specified"},
						{title: "Created By", property: "creator.name", alt_value: "Not Specified"}
					],
					data_to_send: {current_user_id: this.current_user_id},
					reload: false,
					search: "simple"
				},
				uploadDataprops: {
					relatedObject: null,
					name: "IMO5Condition",
				},
				currentUser: siteUserObject,
				readImo5Condition: {},
			};
		},
		methods: {
			duplicateObject(imo5condition) {
				let that = this;
				this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
					if (result.isConfirmed) {
						// Call AXIOS to duplicate the invoice and then open in EDIT Mode
						this.showLoading("Saving ...");
						axios.post(this.docRoot+'/imo5condition/duplicate', { id: imo5condition.id }).then(async function (response) {
							that.closeSwal();
							var status = response.data.status;
							if (status == 1) {
								var newId = response.data.id;
								// Ajax to submit
								that.showToast('Record duplicated successfully', 'success', 'bottom', 3000);
								setTimeout(() => {
									that.showLoading("Redirecting ...");
								}, 2000);
								setTimeout(() => {
									window.location = that.docRoot+'/imo5condition/edit/' + newId+"?duplicate=1";
								}, 4000);
							}
						});
					}
				});
			},
			async saveImo5Condition(event) {
				var thisVar = this;
				if (!this.imo5conditionForAdd.action || this.imo5conditionForAdd.action == "") this.imo5conditionForAdd.action = "details";
				this.imo5conditionForAdd.created_by = this.current_user_id;
				this.showLoading("Saving ...");
				axios
					.post("/imo5condition/save", {imo5condition: this.imo5conditionForAdd})
					.then(async function (response) {
						thisVar.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							thisVar.showToast("IMO 5 Condition saved successfully", "success", "bottom", 3000);
							setTimeout(() => {
								thisVar.dataprops.reload = true;
							}, 1500);
						} else thisVar.showErrors("IMO 5 Condition could not be saved successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						thisVar.closeSwal();
						thisVar.showToast("IMO 5 Condition could not be saved successfully", "error", "bottom", 3000);
					});
			},
			prepareEditImo5Condition(imo5condition) {
				window.location = this.docRoot + "/imo5condition/edit/" + imo5condition.id;
			},
			viewImo5Condition(imo5condition) {
				window.location = this.docRoot + "/imo5condition/view/" + imo5condition.id;
			},
			toggleImo5Condition(imo5condition, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the IMO 5 Condition - <br/>"' + imo5condition.container_no + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.imo5conditionForAdd = imo5condition;
						thisVar.imo5conditionForAdd.status = status;
						thisVar.imo5conditionForAdd.action = "status";
						thisVar.saveImo5Condition();
					}
				});
			},
			printIMO5Condition(imo5condition) {
				window.location = this.docRoot+'/imo5condition/export-to-pdf/' + imo5condition.id;
				this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
			},
			async uploadImages(imo5condition) {
				this.showLoading("Loading images ...");
				await this.refreshObject(imo5condition, "IMO5Condition", 1);
				this.closeSwal();
			},
		},
	};
</script>
