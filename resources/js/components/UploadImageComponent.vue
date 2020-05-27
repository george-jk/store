<!-- upload-image-component -->
<template>
	<div>
		<div class="modal fade show d-block" id="uploadImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">
							<slot name="title"></slot>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$emit('hide')">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div class="custom-file">
								<input type="file" name="imageFile" ref="file" class="custom-file-input" id="imageFile" required @change="handleFileUpload()">
								<label class="custom-file-label" for="imageFile">
									{{file_name}}
								</label>
							</div>
						</div>
						<div class="form-group">
							<input type="text" name="path" ref="path" class="form-control" id="path" :placeholder="file_path" required @change="handlePathChange()">
						</div>
						<div class="btn btn-light" @click="submitFile()">
							<i class="fa fa-upload" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
	export default {

		name: 'upload-image',

		props:{
			product:{}
		},

		data () {
			return {
				file:'',
				file_name:'Choose file...',
				file_path:this.product.manifacture.replace(/ /g,"_")+'/type/product',
			}
		},

		methods:{
			submitFile(){
				if (!this.file) {
					console.error('no image');
				}else{
					let formData=new FormData();
					formData.append('imageFile', this.file);
					formData.append('path', this.file_path);
					formData.append('product_id', this.product.id);
					axios.post( '/admin/image',
						formData,
						{
							headers: {
								'Content-Type': 'multipart/form-data'
							}
						}
						).then(responce=>{
							console.log(responce.data);
							alert('Image uploaded');
						})
						.catch((error)=>{
							console.error(error);
						});
					}
				},
				handleFileUpload(){
					this.file=this.$refs.file.files[0];
					this.file_name=this.file.name;
				},
				handlePathChange(){

				}
			}
		}
	</script>

	<style lang="css" scoped>
	.blur{
		-webkit-filter: blur(1px);
		-moz-filter: blur(1px);
		-o-filter: blur(1px);
		-ms-filter: blur(1px);
		filter: blur(1px);
	}
</style>