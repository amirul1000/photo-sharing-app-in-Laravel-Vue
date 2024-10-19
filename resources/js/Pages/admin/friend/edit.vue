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
                <h1>Edit friend</h1>
                <router-link to="/friend/index" class="btn btn-secondary">Back</router-link>
            </div>
        </div>
        <div class="card-body">
            <!--<form action="">-->
                    <div class="form-group">
                    <label for="title">From User</label>
                    <select  name="from_user_id"   class="form-control" v-model="friend.from_user_id" >
					   <option v-for="(user, key) in users" :value="user.id" :key="key">{{ user.name }}</option>

					</select>
					
                </div>
				
				 <div class="form-group">
                    <label for="title">To User</label>
                    <select  name="to_user_id"   class="form-control" v-model="friend.to_user_id" >
					   <option v-for="(user, key) in users" :value="user.id" :key="key">{{ user.name }}</option>

					</select>
					
                </div>
				
				<div class="form-group">
                    <label for="title">Status</label>
                    <select  name="status"   class="form-control" v-model="friend.status" >
					   <option v-for="(sta, key) in status" :value="sta.value" :key="key">{{ sta.value }}</option>

					</select>
					
                </div>
				
				<div class="form-group">
                    <label for="title">Active</label>
                    <select  name="active"   class="form-control" v-model="friend.active" >
					   <option v-for="(active, key) in actives" :value="active.value" :key="key">{{ active.value }}</option>

					</select>
					
                </div>
				
                <button type="button" class="btn btn-secondary mt-2" v-on:click="updateFriend()">Update</button>
            <!--</form>-->
        </div>
    </div>
	
	<div v-if="show_load" style="text-align:center;">
     <pulse-loader :color="color" :size="size" :margin="margin" :radius="radius"></pulse-loader>
    </div>
 
	<!--Main contains-->
	</div>

	</div>

	</div>
	</div>
	 <Footer></Footer>
	</div>
	</template>


<script>
import { ref } from 'vue';
import axios from "axios";
import toastr from "toastr";

import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

import DropZone from 'dropzone-vue';
import 'dropzone-vue/dist/dropzone-vue.common.css';

import Header from '../../../components/admin/Header.vue';
import Footer from '../../../components/admin/Footer.vue';
import TopNav from '../../../components/admin/TopNav.vue';
import SideBar from '../../../components/admin/SideBar.vue';

export default {
    name: 'friend',
	components: {
		PulseLoader,
		DropZone,
		Header,
		 Footer,
		 TopNav,
		 SideBar
	  },
    data() {
        return {
              friend: {},
			  users:{},
			  status:[{'value':'request'},{'value':'accept'},{'value':'reject'}],
			  actives:[{'value':'1'},{'value':'0'}],
			  color: '#3AB982',
			  height: '35px',
			  width: '4px',
			  size:'12px',
			  margin: '2px',
			  radius: '2px',
			  show_load:true,
        };
    },
    mounted() {
        this.getFriend(this.$route.params.id);
		this.getAllUsers();
    },
    methods: {
		async getAllUsers() {
		     const url = `/api/admin/user/get_all`;		     
			 this.show_load = true;
			 await axios.get(url).then(({data})=>{
				this.users = data;
				console.log(this.users);
				this.show_load = false;
			 }).catch(({ response })=>{
				console.error(response)
			 })
        },
        async updateFriend() {
            try {
				
				console.log(this.friend);

                let res = await axios.post('/api/admin/friend/update/', this.friend);
                toastr.success('friend updated Successfully')
                this.getFriend(this.$route.params.id)
            }   catch (error) {
                console.log(error);
            }
        },
        async getFriend(id) {
            let res = await axios.get(`/api/admin/friend/edit/${id}`);
            this.friend = res.data.friend
			this.show_load = false;
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
}
</script>