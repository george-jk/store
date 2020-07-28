<template>
	<div id="FormatFieldComponent">
		<div class="form-group mt-3">
			<div class="form-row">
				<div class="btn btn-light" @click="bold"><i class="fa fa-bold" aria-hidden="true"></i></div>
				<div class="btn btn-light" @click="underline"><i class="fa fa-underline" aria-hidden="true"></i></div>&nbsp;
				<div class="btn btn-light" @click="ul_li"><i class="fa fa-list-ul" aria-hidden="true"></i></div>&nbsp;
				<div class="btn btn-light" @click="pharagraph"><i class="fa fa-paragraph" aria-hidden="true"></i></div>
			</div>
			<div class="form-row"></div>
			<textarea class="form-control" :name="field_name" ref="ta" v-model="text"></textarea>
		</div>
		<span v-html="text"></span>
	</div>
</template>

<script>
	import Tag from './Tag.js';
	export default {

		name: 'FormatFieldComponent',

		data () {
			return {
				text:'',
				i:{},
			}
		},
		props:{
			field_name:'',
			content:'',
		},
		mounted(){
			return this.text=this.content;
		},
		methods:{
			bold(){
				this.i=new Tag(this.$refs);
				this.text=this.i.insertTag('<b></b>');
			},
			pharagraph(){
				this.i=new Tag(this.$refs);
				this.text=this.i.insertTag('\r\n<p>\r\n</p>\r\n',11);
			},
			underline(){
				this.i=new Tag(this.$refs);
				this.text=this.i.insertTag('<u></u>');
			},
			ul_li(){
				this.i=new Tag(this.$refs);
				this.text=this.i.insertTag('\r\n<ul>\r\n\t<li></li>\r\n\t<li></li>\r\n</ul>\r\n',18);
			}
		}
	}
</script>

<style lang="css" scoped>
</style>