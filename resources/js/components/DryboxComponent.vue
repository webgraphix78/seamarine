<template>
	<div id="drybox-main">
		<div class="row">
			<div class="col-sm-12">
				<div class="row mb-1">
					<div class="col-sm-7">
						<div class="d-flex align-items-center mb-2">
							<h4 class="m-0 me-4">DRYBOX</h4>
							<a id="add_drybox_btn" class="btn btn-success btn-sm" href="#" role="button" data-bs-toggle="modal" data-bs-target="#addDryboxModal" v-if="['110', '111'].indexOf(all_permissions) >= 0">ADD</a>
						</div>
					</div>
				</div>
				<DataTableComponent :dataprops="dataprops" @view-object="viewDrybox" @upload-object="uploadImages" @edit-object="prepareEditDrybox" @duplicate-object="duplicateObject" @print-object="printDrybox" @toggle-object-status="toggleDrybox" v-if="mode != 'mobileapp'"></DataTableComponent>
			</div>
		</div>
		<div class="modal fade" ref="addEditModal" id="addDryboxModal" tabindex="-1" aria-labelledby="addDryboxModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addDryboxModalLabel"><span v-if="dryboxForAdd.id > 0">Edit</span><span v-else>Add</span> Drybox Record</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-md-3 d-flex justify-content-md-end align-items-center">
								<label for="add_drybox_container_no" class="form-label text-uppercase fw-bold me-3">Container No</label><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
							</div>
							<div class="col-md-3">
								<div class="input-group">
									<MaskInput v-model="dryboxForAdd.container_no" mask="AAAA-######-#" class="form-control" :readonly="tankNoVerified" textmode="uppercase"/>
									<span class="input-group-text" :class="tankNoVerified ? 'bg-success' : 'bg-danger'">
										<i class="ph ph-check text-white" v-if="tankNoVerified"></i>
										<i class="ph ph-x text-white" v-if="!tankNoVerified"></i>
									</span>
								</div>
								<template v-for="error of v$.dryboxForAdd.container_no.$errors" :key="error.$uid">
									<div class="mandatory mb-1">{{ error.$message }}</div>
								</template>
							</div>
							<div class="col-md-6 py-2" v-if="dryboxForAdd.id == 0 && tankNoVerified">
								<label for="">Tank last used: <span v-if="lastThree && lastThree.length > 0">On {{  lastThree.join(", ") }}</span><span v-else>Never</span></label>
							</div>
						</div>
						<template v-if="tankNoVerified">
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_ref" class="form-label text-uppercase fw-bold me-3">Ref No</label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="text" class="form-control" v-model="dryboxForAdd.ref" id="add_drybox_ref" placeholder="AUTO GENERATED" readonly>
									</div>
								</div>
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_company_id" class="form-label text-uppercase fw-bold me-3">Company <span class="mandatory">*</span></label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<select class="form-select" v-model="dryboxForAdd.company_id" id="add_company_id">
											<optgroup v-if="allCompanyIdList" label="Choose Company">
												<template v-for="companyId in allCompanyIdList" :key="companyId.id">
													<option :value="companyId.id">{{ companyId.name }}</option>
												</template>
											</optgroup>
										</select>
									</div>
									<template v-for="error of v$.dryboxForAdd.company_id.$errors" :key="error.$uid">
										<div class="mandatory mb-1">{{ error.$message }}</div>
									</template>
								</div>
							</div>
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_inspection_location_id" class="form-label text-uppercase fw-bold me-3 text-end">Place Of Inspection <span class="mandatory">*</span></label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<select class="form-select" v-model="dryboxForAdd.inspection_location_id" id="add_inspection_location_id">
											<optgroup v-if="allInspectionLocationIdList" label="Choose Inspection Location">
												<template v-for="inspectionLocationId in allInspectionLocationIdList" :key="inspectionLocationId.id">
													<option :value="inspectionLocationId.id">{{ inspectionLocationId.name }}</option>
												</template>
											</optgroup>
										</select>
									</div>
									<template v-for="error of v$.dryboxForAdd.inspection_location_id.$errors" :key="error.$uid">
										<div class="mandatory mb-1">{{ error.$message }}</div>
									</template>
								</div>
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_inspection_date" class="form-label text-uppercase fw-bold me-3 text-end	">Inspection Date</label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<MaskInput v-model="dryboxForAdd.inspection_date" mask="##-##-####" class="form-control" textmode="uppercase" placeholder="DD-MM-YYYY"/>
									</div>
								</div>
							</div>
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_size" class="form-label text-uppercase fw-bold me-3">Size</label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="text" class="form-control" v-model="dryboxForAdd.size" id="add_drybox_size" placeholder="Enter Size" />
									</div>
								</div>
							</div>
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_tare_wt" class="form-label text-uppercase fw-bold me-3">Tare Weight</label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="number" class="form-control" v-empty-zero v-model="dryboxForAdd.tare_wt" id="add_drybox_tare_wt" placeholder="Enter Tare Wt" />
									</div>
								</div>
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_gross_wt" class="form-label text-uppercase fw-bold me-3">Gross Weight</label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="number" class="form-control" v-empty-zero v-model="dryboxForAdd.gross_wt" id="add_drybox_gross_wt" placeholder="Enter Gross Wt" />
									</div>
								</div>
							</div>
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_csc_no" class="form-label text-uppercase fw-bold me-3">Csc No</label>
									<a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="text" class="form-control" v-model="dryboxForAdd.csc_no" id="add_drybox_csc_no" placeholder="Enter Csc No" />
									</div>
								</div>
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_mfgt_date" class="form-label text-uppercase fw-bold me-3">Mfgt Date</label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<!-- <MonthYearPicker  v-model="dryboxForAdd.mfgt_date" :min="new Date(1990, 1, 1)" :max="new Date()" returnmode="String" class="form-select"/> -->
										<input type="text" class="form-control" v-model="dryboxForAdd.mfgt_date" id="add_cleaning_next_date" placeholder="Enter Mfgt Date" />
									</div>
								</div>
							</div>
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_customer_id" class="form-label text-uppercase fw-bold me-3">Customer <span class="mandatory">*</span></label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<select class="form-select" v-model="dryboxForAdd.customer_id" id="add_customer_id">
											<optgroup v-if="allCustomerIdList" label="Choose Customer">
												<template v-for="customerId in allCustomerIdList" :key="customerId.id">
													<option :value="customerId.id">{{ customerId.name }}</option>
												</template>
											</optgroup>
										</select>
									</div>
									<template v-for="error of v$.dryboxForAdd.customer_id.$errors" :key="error.$uid">
										<div class="mandatory mb-1">{{ error.$message }}</div>
									</template>
								</div>
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_surveyor_id" class="form-label text-uppercase fw-bold me-3">Surveyor <span class="mandatory">*</span></label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<select class="form-select" v-model="dryboxForAdd.surveyor_id" id="add_surveyor_id">
											<optgroup v-if="allSurveyorIdList" label="Choose Surveyor">
												<template v-for="surveyorId in allSurveyorIdList" :key="surveyorId.id">
													<option :value="surveyorId.id">{{ surveyorId.name }}</option>
												</template>
											</optgroup>
										</select>
									</div>
									<template v-for="error of v$.dryboxForAdd.surveyor_id.$errors" :key="error.$uid">
										<div class="mandatory mb-1">{{ error.$message }}</div>
									</template>
								</div>
							</div>
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-12 p-2 bg-info text-center">
									<h5 class="m-0">REMARKS</h5>
								</div>
							</div>
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_rear_end" class="form-label text-uppercase fw-bold me-3">Rear End</label
									><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="text" class="form-control" v-model="dryboxForAdd.rear_end" id="add_drybox_rear_end" placeholder="Enter Rear End" />
									</div>
								</div>
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_right_side" class="form-label text-uppercase fw-bold me-3">Right Side</label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="text" class="form-control" v-model="dryboxForAdd.right_side" id="add_drybox_right_side" placeholder="Enter Right Side" />
									</div>
								</div>
							</div>
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_front_end" class="form-label text-uppercase fw-bold me-3">Front End</label
									><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="text" class="form-control" v-model="dryboxForAdd.front_end" id="add_drybox_front_end" placeholder="Enter Front End" />
									</div>
								</div>
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_left_side" class="form-label text-uppercase fw-bold me-3">Left Side</label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="text" class="form-control" v-model="dryboxForAdd.left_side" id="add_drybox_left_side" placeholder="Enter Left Side" />
									</div>
								</div>
							</div>
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_top_roof" class="form-label text-uppercase fw-bold me-3">Top Roof</label
									><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="text" class="form-control" v-model="dryboxForAdd.top_roof" id="add_drybox_top_roof" placeholder="Enter Top Roof" />
									</div>
								</div>
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_under_structure" class="form-label text-uppercase fw-bold me-3 text-end">Under Structure</label
									><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="text" class="form-control" v-model="dryboxForAdd.under_structure" id="add_drybox_under_structure" placeholder="Enter Under Structure" />
									</div>
								</div>
							</div>
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_interior" class="form-label text-uppercase fw-bold me-3">Interior</label
									><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<input type="text" class="form-control" v-model="dryboxForAdd.interior" id="add_drybox_interior" placeholder="Enter Interior" />
									</div>
								</div>
								<div class="col-md-3 col-6 d-flex justify-content-end align-items-center">
									<label for="add_drybox_drybox_status" class="form-label text-uppercase fw-bold me-3">Drybox Status</label>
								</div>
								<div class="col-md-3 col-6">
									<div>
										<select class="form-select" v-model="dryboxForAdd.drybox_status" id="add_drybox_status">
											<optgroup v-if="allDryboxStatusList" label="Choose Drybox Status">
												<template v-for="dryboxStatus in allDryboxStatusList" :key="dryboxStatus.id">
													<option :value="dryboxStatus.id">{{ dryboxStatus.title }}</option>
												</template>
											</optgroup>
										</select>
									</div>
								</div>
							</div>
							<div class="row mb-md-4 mb-3 g-2 g-md-3">
								<div class="col-md-3 d-flex justify-content-md-end align-items-top">
									<label for="add_drybox_note" class="form-label text-uppercase fw-bold me-3">Note</label
									><a href="#" class="cstooltip" data-tooltip="Allowed characters are A-Z, 0-9 and space, comma, full stop, underscore, dash and single quote." tabindex="-1"><i class="ph ph-question"></i></a>
								</div>
								<div class="col-md-6">
									<div>
										<textarea class="form-control" v-model="dryboxForAdd.note" id="add_drybox_note" placeholder="Enter Note" rows="3"></textarea>
									</div>
								</div>
							</div>
						</template>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal" @click="cancelAddEdit()">CLOSE</button>
						<button type="button" class="btn btn-dark btn-sm" v-if="tankNoVerified" @click="saveDrybox()">SAVE CHANGES</button>
						<button type="button" class="btn btn-dark btn-sm" v-else @click="verifyTankNumber()">VERIFY TANK NUMBER</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" ref="readModal" id="readDryboxModal" tabindex="-1" aria-labelledby="readDryboxModalLabel" aria-hidden="true" v-if="readDrybox">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="readDryboxModalLabel">View Drybox Record</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelAddEdit"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Ref:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.ref">{{ readDrybox.ref }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Company:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.company?.name">{{ readDrybox.company?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0 text-end">Inspection Location:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.inspectionlocation?.name">{{ readDrybox.inspectionlocation?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Inspection Date:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.inspection_date">{{ formatMySQLDate(readDrybox.inspection_date, "MMM dd, yyyy") }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Container No:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.container_no">{{ readDrybox.container_no }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Size:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.size">{{ readDrybox.size }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Tare Wt:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.tare_wt">{{ readDrybox.tare_wt }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Gross Wt:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.gross_wt">{{ readDrybox.gross_wt }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Csc No:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.csc_no">{{ readDrybox.csc_no }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Mfgt Date:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.mfgt_date">{{ readDrybox.mfgt_date }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Customer:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.customer?.name">{{ readDrybox.customer?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Surveyor:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.surveyor?.name">{{ readDrybox.surveyor?.name }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Rear End:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.rear_end">{{ readDrybox.rear_end }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Right Side:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.right_side">{{ readDrybox.right_side }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Front End:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.front_end">{{ readDrybox.front_end }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Left Side:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.left_side">{{ readDrybox.left_side }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Top Roof:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.top_roof">{{ readDrybox.top_roof }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Under Structure:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.under_structure">{{ readDrybox.under_structure }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Interior:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.interior">{{ readDrybox.interior }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Drybox Status:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.drybox_status == '0'">Empty</span>
									<span v-if="readDrybox.drybox_status == '1'">Loaded</span>
								</div>
							</div>
						</div>
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Note:</label>
							</div>
							<div class="col-md-9 col-6">
								<div>
									<span v-if="readDrybox.note">{{ readDrybox.note }}</span
									><span v-else><i>Not specified</i></span>
								</div>
							</div>
						</div>
						<div class="row mb-3 g-3">
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Status:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span class="badge rounded-pill bg-success" v-if="readDrybox.status == 1">ACTIVE</span>
									<span class="badge rounded-pill bg-danger" v-if="readDrybox.status == 0">INACTIVE</span>
								</div>
							</div>
							<div class="col-md-3 col-6 d-flex justify-content-end">
								<label class="form-label text-uppercase fw-bold m-0">Created By:</label>
							</div>
							<div class="col-md-3 col-6">
								<div>
									<span v-if="readDrybox.creator?.name">{{ readDrybox.creator?.name }}</span
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
	import {useVuelidate} from "@vuelidate/core";
	import {required, minValue, alphaNum, numeric, email, requiredIf, minLength} from "@vuelidate/validators";
	import * as bootstrap from "bootstrap";
	function initialState() {
		return {
			id: 0,
			ref: "",
			company_id: null,
			inspection_location_id: null,
			inspection_date: "",
			container_no: "",
			size: "",
			tare_wt: 0,
			gross_wt: 0,
			csc_no: "",
			mfgt_date: "",
			customer_id: null,
			surveyor_id: null,
			rear_end: "",
			right_side: "",
			front_end: "",
			left_side: "",
			top_roof: "",
			under_structure: "",
			interior: "",
			drybox_status: null,
			note: "",
			action: ""
		};
	}
	function initialStateValidations() {
		return {
			ref: {minLengthValue: minLength(1)},
			company_id: {required},
			inspection_location_id: {required},
			container_no: {minLengthValue: minLength(1)},
			tare_wt: {numeric, minValue: minValue(0)},
			gross_wt: {numeric, minValue: minValue(0)},
			csc_no: {minLengthValue: minLength(1)},
			customer_id: {required},
			surveyor_id: {required},
			note: {minLengthValue: minLength(1)},
		};
	}
	export default {
		name: "Dryboxmaster",
		props: ["current_user_id", "all_permissions","mode","id","param1"],
		setup() {
			return {
				v$: useVuelidate()
			};
		},
		data() {
			return {
				dataprops: {
					id: "drybox-list",
					class: "a",
					base_url: this.docRoot+"/api/drybox/",
					columns: [
						{title: "Ref", property: "ref"},
						{title: "Company", property: "company.name", alt_value: "Not Specified"},
						{title: "Inspection Location", property: "inspectionlocation.name", alt_value: "Not Specified", sortable: true},
						{title: "Container No", property: "container_no"},
						{title: "Customer", property: "customer.name", alt_value: "Not Specified"},
						{title: "Created By", property: "creator.name", alt_value: "Not Specified"}
					],
					data_to_send: {current_user_id: this.current_user_id},
					reload: false,
					search: "simple"
				},
				uploadDataprops: {
					relatedObject: null,
					name: "Drybox",
				},
				addEditModal: null,
				readModal: null,
				currentUser: siteUserObject,
				dryboxForAdd: initialState(),
				readDrybox: {},
				allCompanyIdList: [],
				allInspectionLocationIdList: [],
				allCustomerIdList: [],
				allSurveyorIdList: [],
				allDryboxStatusList: [],
				tankNoVerified: false,
				lastThree: []
			};
		},
		validations() {
			return {
				dryboxForAdd: initialStateValidations()
			};
		},
		methods: {
			cancelAddEdit(event) {
				this.dryboxForAdd = initialState();
				this.tankNoVerified = false;
				this.v$.$reset();
			},
			verifyTankNumber() {
				var that = this;
				this.showLoading("Verifying ...");
				axios
					.post(this.docRoot + "/drybox/verify-tank-number", { tankNo: this.dryboxForAdd.container_no })
					.then(async function (response) {
						that.closeSwal();
						console.log(response);
						var status = response.data.status;
						if (status == 1){
							that.tankNoVerified = true;
							if (response.data.hasOwnProperty("lastthree") && response.data.lastthree.length > 0) {
								let arrLastThree = response.data.lastthree;
								that.lastThree = arrLastThree.filter((item, index) => arrLastThree.indexOf(item) === index);
							}
						}
						else {
							that.tankNoVerified = false;
							that.showErrors(response.data.message, "error", "bottom", 3000);
						}
					});
			},
			duplicateObject(cleaning) {
				let that = this;
				this.showConfirm("Are you sure you want to create a duplicate of this record?", "Yes", "No").then((result) => {
					if (result.isConfirmed) {
						this.dryboxForAdd = Object.assign({}, cleaning);
						this.dryboxForAdd.id = 0;
						this.dryboxForAdd.ref = null;
						console.log(this.dryboxForAdd);
						this.tankNoVerified = false;
						this.addEditModal.show();
					}
				});
			},
			async saveDrybox(event) {
				var thisVar = this;
				const result = await this.v$.$validate();
				if (!result) {
					this.showToast("Form validation failed. Please check.", "error", "bottom", 2000);
					console.log(this.v$.$errors);
					return;
				}
				// Validate the inspection date
				if ( this.dryboxForAdd.inspection_date.length < 10) {
					this.showToast("Inspection date is required", "error", "bottom", 2000);
					return;
				}
				else {
					// validate date using regex
					var dateRegex = /^(0[1-9]|1[0-9]|2[0-9]|3[0-1])-(0[1-9]|1[0-2])-\d{4}$/;
					if (!dateRegex.test(this.dryboxForAdd.inspection_date)) {
						this.showToast("Invalid inspection date format", "error", "bottom", 2000);
						return;
					}
				}
				if (!this.dryboxForAdd.action || this.dryboxForAdd.action == "") this.dryboxForAdd.action = "details";
				this.dryboxForAdd.created_by = this.current_user_id;
				$("#addDryboxModal").modal("hide");
				this.showLoading("Saving ...");
				axios
					.post(this.docRoot+"/drybox/save", {drybox: this.dryboxForAdd})
					.then(async function (response) {
						thisVar.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							thisVar.showToast("Drybox saved successfully", "success", "bottom", 3000);
							if(thisVar.mode === "mobileapp") {
								window.location = thisVar.docRoot + "/operation-successful";
							}
							setTimeout(() => {
								thisVar.dataprops.reload = true;
							}, 1500);
							thisVar.dryboxForAdd = initialState();
							thisVar.tankNoVerified = false;
							thisVar.v$.$reset();
						} else thisVar.showErrors("Drybox could not be saved successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						thisVar.closeSwal();
						thisVar.showToast("Drybox could not be saved successfully", "error", "bottom", 3000);
					});
			},
			prepareEditDrybox(drybox) {
				this.dryboxForAdd = Object.assign({}, drybox);
				this.tankNoVerified = false;
				this.addEditModal.show();
			},
			viewDrybox(drybox) {
				this.readDrybox = drybox;
				this.readModal.show();
			},
			toggleDrybox(drybox, status) {
				var thisVar = this;
				Swal.fire({
					icon: "question",
					html: "Do you really want to " + (status == 1 ? "reactivate" : "deactivate") + ' the Drybox - <br/>"' + drybox.none + '"?',
					showCancelButton: true
				}).then((result) => {
					if (result.isConfirmed) {
						thisVar.dryboxForAdd = drybox;
						thisVar.dryboxForAdd.status = status;
						thisVar.dryboxForAdd.action = "status";
						thisVar.saveDrybox();
					}
				});
			},
			printDrybox(drybox) {
				window.location = this.docRoot+'/drybox/export-to-pdf/' + drybox.id;
				this.showToast("Printing. Please wait ...", "success", "bottom", 3000);
			},
			async uploadImages(drybox) {
				this.showLoading("Loading images ...");
				await this.refreshObject(drybox, "Drybox", 1);
				this.closeSwal();
			},
		},
		async mounted() {
			this.addEditModal = new bootstrap.Modal(this.$refs.addEditModal, {backdrop: "static", keyboard: false});
			this.readModal = new bootstrap.Modal(this.$refs.readModal, {backdrop: "static", keyboard: false});
			if (this.mode && this.mode == "mobileapp") {
				if(this.param1 && this.param1 != null && this.param1 != undefined) {
					if (this.id !== undefined && !isNaN(this.id)) {
						var URL = this.docRoot + "/api/drybox/get-record/" + this.id;
						var that = this;
						this.showLoading("Loading ...");
						axios.post(URL, {}).then(function (response) {
							let dryboxObj = Object.assign({}, response.data);
							if(that.param1 === "edit"){
								that.prepareEditDrybox(dryboxObj);
							}else{
								that.viewDrybox(dryboxObj);
							}
							that.closeSwal();	
						})
						.catch(function (error) {
							console.log(error);
						});
					}
				}else{
					this.addEditModal.show();
				}
				this.$refs.addEditModal.addEventListener('hidden.bs.modal', () => { window.location = this.docRoot + "/operation-canceled"; });
				this.$refs.readModal.addEventListener('hidden.bs.modal', () => { window.location = this.docRoot + "/operation-canceled"; });
			}
			this.allCompanyIdList = await this.loadAllCompany(true);
			this.allInspectionLocationIdList = await this.loadAllInspectionLocation(true);
			this.allCustomerIdList = await this.loadAllCustomer(true);
			this.allSurveyorIdList = await this.loadAllSurveyor(true);
			this.allDryboxStatusList = [
				{id: "0", title: "Empty"},
				{id: "1", title: "Loaded"}
			];
		}
	};
</script>
