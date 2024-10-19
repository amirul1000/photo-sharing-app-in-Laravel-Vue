<template>
  
<div id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
       <SideBar></SideBar>
	   
	   
	  <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">  
	             <TopNav></TopNav>
 
     <div class="container-fluid">
       <!--Mian Content-->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Create member</h1>
                <router-link to="/member/index" class="btn btn-secondary">Back</router-link>
            </div>
        </div>
        <div class="card-body">
            <!--<form action="">-->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" v-model="member.name" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" v-model="member.email"
                        class="form-control" />
                </div>
				
				<div class="form-group">
                    <label for="email">Password</label>
                    <input type="text" name="password" id="password" v-model="member.password"
                        class="form-control" />
                </div>
				
				<div class="form-group">
                    <label for="title">Role</label>
                    <select  name="role"   class="form-control" v-model="member.role" >
					   <option v-for="(role, key) in roles" :value="role.value" :key="key">{{ role.value }}</option>

					</select>
					
                </div>
				
				
				<div class="form-group">
                    <label for="title">Active</label>
                    <select  name="active"   class="form-control" v-model="member.active" >
					   <option v-for="(active, key) in actives" :value="active.value" :key="key">{{ active.value }}</option>

					</select>
					
                </div>
				
				
				<div class="form-group">
				  
					<DropZone 
						:maxFiles="Number(10000000000)"
						url="/api/admin/user/photo_upload"
						:uploadOnDrop="true"
						:multipleUpload="true"
						:parallelUpload="1"
						:acceptedFiles="['jpg','jpeg','png','gif']"
						@uploaded="uploaded"
						@addedFile="onFileAdd"
						@errorUpload="onErrorUpload"/>
				
               </div>
			   <div class="form-group">
					  <button @click="cameraOff">I'm on top of the video</button>
                      <button @click="snapshot">Take Picture</button>
					   <camera
							:resolution="{ width: 1024, height: 768 }"
							ref="camera"
							:autoplay="false"
						  ></camera>
			    </div>
				
                <button type="button" class="btn btn-secondary mt-2" v-on:click="saveMember()">Save</button>
            <!--</form>-->
        </div>
    </div>
<!--Main contains--> 

     <div v-if="show_load" style="text-align:center;">
		<pulse-loader :color="color" :size="size" :margin="margin" :radius="radius"></pulse-loader>
	 </div>

</div>

  
</div>

</div>
</div>
 <Footer></Footer>
</div>
</template>

<script>
import { defineComponent, ref } from 'vue';
import axios from "axios";
import toastr from "toastr";

import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
import DropZone from 'dropzone-vue';
import 'dropzone-vue/dist/dropzone-vue.common.css';
import Camera from "simple-vue-camera";


import Header from '../../../components/admin/Header.vue';
import Footer from '../../../components/admin/Footer.vue';
import TopNav from '../../../components/admin/TopNav.vue';
import SideBar from '../../../components/admin/SideBar.vue';


export default defineComponent({
    name: 'member',
	components: {
	    PulseLoader,
		DropZone,
		Camera,
		Header,
		 Footer,
		 TopNav,
		 SideBar
	  },	
	  setup() {
	    const camera = ref(null);
		
		const cameraIsOn = ref(false);

		const cameraOff = () => {
		  cameraIsOn.value ? camera.value.stop() : camera.value.start();
		  cameraIsOn.value = !cameraIsOn.value;
		};
		
		
	    // Use camera reference to call functions
        const snapshot = async () => {
            const blob = await camera.value?.snapshot( 
							{ width: 357, height: 281 },
							"image/png",
							0.5
							);
			
			var reader = new window.FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function () {
				var base64data = reader.result;				
				//console.log(base64data);					
				var block = base64data.split(";");
				// Get the content type of the image
				var contentType = block[0].split(":")[1];
				// get the real base64 content of the file
				var realData = atob(block[1].split(",")[1]);
				
				var max = realData.length;
				var ia = new Uint8Array(max);
				for (var i = 0; i < max; i++) {
				  ia[i] = realData.charCodeAt(i);
				}
				
				let file = new File([ia], 'test.png',{type:"image/png", lastModified:new Date().getTime()});

				
				//console.log(realData);
				let formData = new FormData();
				formData.append('file', file);
				
                axios.post(`/api/admin/user/photo_upload`,formData);
				 
				 
			}
            // To show the screenshot with an image tag, create a url
            const url = URL.createObjectURL(blob);
			
        };
		
        return {
            camera,
            snapshot,
			cameraOff,
            cameraIsOn,
        };
        
    },
    data() {
        return {		
            member: {},
				roles:[{'value':'memer'},{'value':'admin'},{'value':'super'}],
				actives:[{'value':'1'},{'value':'0'}],
			 	color: '#3AB982',
			  	height: '35px',
			  	width: '4px',
			  	size:'12px',
			  	margin: '2px',
			  	radius: '2px',
			  	show_load:false,	
			    loading:'',
				started:'',
				stopped:'',
				paused:'',
				resumed:'',
				cameraChange:'',
				snapshot:'',
				error:'',
			  
        };
    },
    methods: {
        async saveMember() {
            try {

                let res = await axios.post('/api/admin/user/store', this.member);
                toastr.success('Member saved Successfully')
                this.member = {}
            } catch (error) {
                console.log(error);
				alert(error.message+' '+error.response.data.message);
            }
        },
		onFileAdd(){
		 this.show_load = true;
		},
		uploaded(){
		  this.show_load = false;
		},
		onErrorUpload(){
		  this.show_load = false;
		},
		
    }
});
</script>
