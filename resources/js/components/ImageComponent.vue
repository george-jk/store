<template>
    <div class="col" id="app">
            <img :src="'https://profitstore.bg'+currentImage.path" :alt="currentImage.description" class="img-thumbnail" height="auto">
            <select @change="change" v-model="newImage" class="form-control mt-1" id="product_image_id" :name="'product_image['+product_image.id+']'" >
                <option v-for="item in allImages" :value="item.id">
                    {{item.description}}
                </option>
            </select>

    </div>
</template>

<script>
    export default {

        name: 'app',

        props:{
            product_image:{},
            key_image:''
        },

        data () {
            return {
                currentImage:[],
                allImages:[],
                newImage:[],
            }
        },

        created(){

            axios({
                method: 'get',
                url: '/admin/image/'
            })
            .then(response=> this.allImages=response.data);

            this.currentImage=this.product_image;
        },

        methods:{
            change(){
                this.currentImage=this.allImages[this.newImage];
                this.allImages.forEach(key=>{
                    if (key.id==this.newImage) {this.currentImage=key}
                })
            }
        }
    }
</script>
