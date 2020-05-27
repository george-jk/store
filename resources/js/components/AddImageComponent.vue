<!-- add-image-component -->
<template>
	<div class="col col-2 d-flex align-items-center" id="app">
		<span class="plus" @click="showModal=true"><i class="fa fa-plus-square" aria-hidden="true"></i></span>
		<upload-image-component v-if="showModal" @hide="showModal=false" :product='prod'>
			<template slot="title">
				Upload Image
			</template>
		</upload-image-component>
	</div>
</template>

<script>
	import UploadImageComponent from './UploadImageComponent.vue'
	export default {

		name: 'app',

		props:{
			product:{},
		},

		components:{
			UploadImageComponent
		},

		data () {
			return {
				showModal:false,
				prod:this.product,
			}
		}
	}
</script>

<style lang="css" scoped>
.plus i{
	color: gray;
	font-size: 2rem;
}
.plus i:hover{
	color: var(--primary);
	cursor: pointer;
}
</style>