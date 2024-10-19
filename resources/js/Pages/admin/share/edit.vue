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
                <h1>Edit Share</h1>
                <router-link to="/share/index" class="btn btn-secondary">Back</router-link>
            </div>
        </div>
        <div class="card-body">
            <form action="">
              <div class="form-group">
                    <label for="title">From User</label>
                    <select  name="from_user_id"   class="form-control" v-model="share.from_user_id" >
					   <option v-for="(user, key) in users" :value="user.id" :key="key">{{ user.name }}</option>

					</select>
					
                </div>
				
				  <div class="form-group">
                    <label for="title">To User</label>
                    <select  name="to_user_id"   class="form-control" v-model="share.to_user_id" >
					   <option v-for="(user, key) in users" :value="user.id" :key="key">{{ user.name }}</option>

					</select>
					
                </div>
				
				<div class="form-group">
                    <label for="title">Post</label>
                    <select  name="post_id"   class="form-control" v-model="share.post_id" >
					   <option v-for="(post, key) in posts" :value="post.id" :key="key">{{ post.title }}</option>

					</select>
					
                </div>
				
				
				<div class="form-group">
                    <label for="title">Status</label>
                    <select  name="status"   class="form-control" v-model="share.status" >
					   <option v-for="(sta, key) in status" :value="sta.value" :key="key">{{ sta.value }}</option>

					</select>
					
                </div>
                <button type="button" class="btn btn-secondary mt-2" v-on:click="updateShare()">Update</button>
            </form>
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

import PulseLoader from 'vue-spinner/src/PulseLoader.vue';


import Header from '../../../components/admin/Header.vue';
import Footer from '../../../components/admin/Footer.vue';
import TopNav from '../../../components/admin/TopNav.vue';
import SideBar from '../../../components/admin/SideBar.vue';

export default {
    name: 'Share',
	components: {
		PulseLoader,
		Header,
		 Footer,
		 TopNav,
		 SideBar
	  },
    data() {
        return {
            share: {}, 
			users:{},	
			posts:{},
			status:[{'value':'active'},{'value':'inactive'}],
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
	    this.getAllUsers();
		this.getAllPosts();
        this.getShare(this.$route.params.id);
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
		async getAllPosts() {
		     const url = `/api/admin/post/get_all`;		     
			 this.show_load = true;
			 await axios.get(url).then(({data})=>{
				this.posts = data;
				console.log(this.posts);
				this.show_load = false;
			 }).catch(({ response })=>{
				console.error(response)
			 })
        },
        async updateShare() {
            try {
				
				console.log(this.share);

                let res = await axios.post('/api/admin/share/update/', this.share);
                toastr.success('Share updated Successfully')
                this.getShare(this.$route.params.id)
            }   catch (error) {
                console.log(error);
				 alert(error.message+' '+error.response.data.message);
            }
        },
        async getShare(id) {
            let res = await axios.get(`/api/admin/share/edit/${id}`);
            this.share = res.data.share
			this.show_load = false;
        }
    }
}
</script>