<!-- image-component -->
<template>
    <div class="col" id="app">
        <div  @mouseover="show" @mouseleave="hide">
            <img :src="'https://profitstore.bg'+currentImage.path" :alt="currentImage.description" class="img-thumbnail" height="auto">
            <span class="middle" v-show="button" @click="deleteImage">
                <i class="fa fa-minus-circle" aria-hidden="true"></i>
            </span>
        </div>
        <!-- <div>
            <select @change="change" v-model="newImage" class="form-control mt-1" id="product_image_id" :name="'product_image['+product_image.id+']'" >
                <option v-for="item in allImages" :value="item.id">
                    {{item.description}}
                </option>
            </select>
        </div> -->
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
                button:false,
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
            },
            show(){
                this.button=true;
            },
            hide(){
                this.button=false;
            },
            deleteImage(){
                if(confirm('Delete')){
                    axios({
                        method:'delete',
                        url:'/admin/image/'+this.product_image.id
                    })
                    .then(response=>{
                        if (response.data['database delete']&&response.data['database delete']){
                            alert('Deleted');
                        }else{
                            console.log(response);
                        }
                    });
                }
            }
        }
    }
</script>

<style>
.middle {
  opacity: 0.7;
  font-size: 2rem;
  width: 35%;
  height: 35%;
  position: absolute;
  top: 20%;
  left: 70%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.middle i{
    color: #FF2222;
}
.middle i:hover{
    color: red;
}


</style>