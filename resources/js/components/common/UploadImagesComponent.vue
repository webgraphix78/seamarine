<template lang="">
	<div>
		<div class="modal fade" ref="uploadImagesModal" id="uploadImagesModal" tabindex="-1" aria-labelledby="uploadImagesModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="uploadImagesModalLabel">Upload Images</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancelUpload"></button>
					</div>
					<div class="modal-body">
						<div v-if="!dataprops || !dataprops.relatedObject">
							<p>Mandatory structure for "dataprops" property is:</p>
							<ul>
								<li>relatedObject: object that has 'id' property</li>
								<li>relatedObject name: name of the related object</li>
								<!-- <li>base api: base of the api where the file operation will be performed.
									<ul>
										<li>/base/add - file uploads will be handled</li>
										<li>/base/delete - file uploaded will be deleted</li>
									</ul>
								</li> -->
							</ul>
							<p>1. ADD API will be passed the following payload</p>
							<ul>
								<li>id: relatedObject.id</li>
								<li>name: relatedObject.name</li>
								<li>uploaded_file: Image Contents</li>
							</ul>
							<p>2. DELETE API will be passed the following payload</p>
							<ul>
								<li>image_id</li>
							</ul>
							<p>3. VIEW API will be passed the following payload</p>
							<ul>
								<li>image_id</li>
								<li>random_id</li>
							</ul>
						</div>
						<!-- Upload file -->
						<div v-else>
							<div class="row mb-4">
								<div class="col-12">
									<label for="add_company_name" class="form-label text-uppercase fw-bold me-3">Upload Image <span class="mandatory">*</span></label>
									<div class="d-flex flex-row gap-3 align-items-center mb-2">
										<input type="file" id="file_to_upload" ref="file_to_upload" @change="handleUpload($event)" accept="image/*" multiple/>
										<label for="file_to_upload" class="bg-dark p-2 text-white">
											<span>Upload image</span>
										</label>
										<!-- <div class="d-flex flex-column">
											<ul class="list-inline gap-4 m-0">
												<li class="list-inline-item" v-if="document.upload_state == 1 && document.file_name">
													Uploading <span class="text-primary">{{ document.file_name }}</span>
												</li>
												<li class="list-inline-item" v-if="document.upload_state == 1 && upload_progress < 100">|&nbsp;{{ upload_progress }}%</li>
												<li class="list-inline-item" v-if="document.upload_state == 2">
													Uploaded <span class="text-primary">{{ document.file_name }}</span> successfully
												</li>
											</ul>
										</div> -->
									</div>
									<p class="text-dark mb-0"><small>Maximum upload size is 2MB. Supported format is JPG, JPEG and PNG only.</small></p>
									<p class="text-dark mb-0"><small>Please ensure that the dimensions are correct.</small></p>
								</div>
							</div>
							<!-- List of files -->
							<template v-if="dataprops.relatedObject?.images && dataprops.relatedObject?.images.length > 0">
								<h5 class="mb-2">Uploaded files</h5>
								<div class="row mb-2">
									<div class="col-3 p-1" v-for="image of dataprops.relatedObject.images">
										<img :src="this.docRoot+'/api/media/view/'+image.id+'/'+imageId" class="img-fluid mb-1">
										<p class="mb-1">
											<span>{{image.name}}</span>
											<span v-if="image.size < 999">{{ image.size}} bytes</span>
											<span v-if="image.size <= 999999 && image.size > 999">{{Math.round(image.size/1000, 2)}} KB</span>
											<span v-if="image.size > 999999">{{Math.round(image.size/1000000, 2)}} MB</span>
										</p>
										<p class="m-0"><a href="javascript:void(0)" class="small text-danger" @click="deleteUpload(image.id)">Delete</a></p>
									</div>
									<!-- <div class="col-5 p-1">
									</div>
									<div class="col-3 p-1">
									</div> -->
								</div>
							</template>
							<div class="row mb-2" v-else>
								<div class="col-12">
									<p>No images have been uploaded yet.</p>
								</div>
							</div>
						</div>
						<!-- Upload file -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">CLOSE</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import * as bootstrap from "bootstrap";
	/*
	Mandatory dataprops structure
	{
		relatedObject: <object that has id property>
		api: api where the file must be uploaded
	}
	*/
	export default {
		name: 'UploadImagesComponent',
		props: [ 'dataprops' ],
		data() {
			return {
				images: [],
				addEditModal: null,
				documents: [],
				allFilesUploaded: false,
				imageId: 123
			}
		},
		methods: {
			cancelUpload() {
			},
			handleUpload(event) {
				let that = this;
				if (event.target.files && event.target.files.length > 0) {
					this.documents = [];
					for (let index = 0; index < event.target.files.length; index++) {
						let file = event.target.files[index];
						if (file.size > 2 * 1024 * 1024) {
							this.showToast("File size cannot exceed 2MB", "error", "bottom", 3000);
							return;
						}
						if (file.type != "image/jpg" && file.type != "image/jpeg" && file.type != "image/png") {
							this.showToast("You can only upload JPG, JPEG and PNG images", "error", "bottom", 3000);
							return;
						}
						this.documents.push({
							upload_state: 0,
							upload_progress: 0,
							file: file,
							file_name: file.name
						});
					}
					this.documents.map((document) => {
						const formData = new FormData();
						formData.append("id", this.dataprops.relatedObject.id);
						formData.append("name", this.dataprops.name);
						formData.append("uploaded_file", document.file);
						document.upload_state = 0;
						document.upload_progress = 0;
						document.file_name = document.file.name.length > 25 ? document.file.name.substring(0, 18) + " ... " + document.file.name.substring(document.file.name.length - 4) : document.file.name;
						// Send the data
						let URL = this.docRoot + "/api/media/add";
						console.log(URL);
						axios.post(URL, formData, {
								headers: {
									"Content-Type": "multipart/form-data"
								},
								onUploadProgress: function (progressEvent) {
									document.upload_state = 1;
									document.upload_progress = parseInt(Math.round((progressEvent.loaded / progressEvent.total) * 100));
								}
							})
							.then(async function (response) {
								document.upload_state = 2;
								document.upload_progress = 100;
								var status = response.data.status;
								if (status == 1) {
									that.imageId = Math.round(Math.random() * 100);
									document.upload_state = 2;
									document.upload_progress = 0;
									that.checkAllUploaded();
								} else that.showErrors("File could not be uploaded successfully", response.data.messages, "bottom", 3000);
							})
							.catch(function (error) {
								document.upload_progress = 0;
								document.upload_state = -1;
								console.log(error);
								that.closeSwal();
								that.showToast("File could not be uploaded successfully", "error", "bottom", 3000);
							});
					});
				}
			},
			checkAllUploaded() {
				let count = 0;
				console.log("All documents ", this.documents);
				this.documents.map((document) => {
					if (document.upload_state == 2) count++;
					console.log("Count ", count, this.documents.length);
					
					if( count == this.documents.length ){
						console.log("Documents ", this.documents);
						this.showToast("Images uploaded successfully", "success", "bottom", 3000);
						this.$emit("refreshObject", this.dataprops.relatedObject, this.dataprops.name, 0);
					}
				})
			},
			deleteUpload(id){
				let that = this;
				this.showLoading("Deleting file ...");
				axios
					.post(this.docRoot + "/api/media/delete", {image_id: id})
					.then(async function (response) {
						that.closeSwal();
						var status = response.data.status;
						if (status == 1) {
							// Ajax to submit
							that.showToast("Image deleted successfully", "success", "bottom", 3000);
							setTimeout(() => {
								that.dataprops.reload = true;
								that.$emit("refreshObject", that.dataprops.relatedObject, that.dataprops.name, 0);
							}, 1500);
						} else that.showErrors("Image could not be deleted successfully", response.data.messages, "bottom", 3000);
					})
					.catch(function (error) {
						console.log(error);
						that.closeSwal();
						that.showToast("Image could not be deleted successfully", "error", "bottom", 3000);
					});
			}
		},
		mounted() {
			this.uploadImagesModal = new bootstrap.Modal(this.$refs.uploadImagesModal, {backdrop: "static", keyboard: false});
			this.imageId = Math.round(Math.random() * 100);
		},
		watch:{
			'dataprops.showModal': {
				handler(newValue, oldValue) {
					if( newValue == true ){
						this.dataprops.showModal = false;
						this.uploadImagesModal.show();
					}
				}
			},
			'dataprops.relatedObject': {
				handler(newValue, oldValue) {
					console.log("Reached");
				}
			}
		}
	}
</script>
