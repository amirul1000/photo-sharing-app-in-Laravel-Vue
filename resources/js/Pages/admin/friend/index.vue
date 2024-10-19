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
            <h1>Friend</h1>
            <router-link to="/friend/add" class="btn btn-secondary"
                >Create</router-link>
        </div>
    </div>
    <div class="card-body">
	
	   
	   <!--Action-->
		<div>
			<div class="float_left padding_10">
				<i class="fa fa-download"></i> Export 
				<select name="exporttype" v-model="exporttype" class="select" v-on:change="exportData">
					<option value="">Select..</option>
					<option value="Pdf">Pdf</option>
					<option value="CSV">CSV</option>
				</select>
				
				
			</div>
			<div  class="float_right padding_10">
				<ul class="left-side-navbar d-flex align-items-center" style="list-style:none;">
					<li class="hide-phone app-search mr-15">
						
						<input type="text"  placeholder="Search" v-model="search" 
						v-on:keyup="searchData"  class="form-control search-bg"/>

						<button  class="mr-0">
							<i class="fa fa-search"></i>
						</button>
					  
					</li>
				</ul>
			</div>
		</div>
		<!--End of Action//--> 
	
	
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
					<th>From user</th>
					<th>To user</th>
                    <th>Status</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(friend, key) in friends.data" :key="friend.id">
                    <td>{{ key }}</td>
					<td>{{ friend.from_user_name  }}</td>
					<td>{{ friend.to_user_name  }}</td>
                    <td>{{ friend.status }}</td>
                    <td>{{ friend.active }}</td>
                    <td>
                        <router-link
                            :to="{
                                name: 'EditFriend',
                                params: { id: friend.id },
                            }"
                            class="btn btn-info"
                            >Edit</router-link>
                        <button
                            type="button"
                            class="btn btn-danger ms-2"
                            v-on:click="deleteFriend(friend.id)">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


   
  <Bootstrap5Pagination align="center" :data="friends" :limit="2" :size="default"  @pagination-change-page="getFriend"></Bootstrap5Pagination>


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
import {  Bootstrap4Pagination, Bootstrap5Pagination, TailwindPagination } from 'laravel-vue-pagination';

import Header from '../../../components/admin/Header.vue';
import Footer from '../../../components/admin/Footer.vue';
import TopNav from '../../../components/admin/TopNav.vue';
import SideBar from '../../../components/admin/SideBar.vue';

export default {
    name: "Friend",	
	components: {
		PulseLoader,
		Bootstrap5Pagination,
		 Header,
		 Footer,
		 TopNav,
		 SideBar
	  },
    data() {
        return {
              friends: ref({}), 
			  photos: ref([] ), 
			  exporttype: '', 
			  search:'',
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
        this.getFriend(1);
    },
    methods: {
        async getFriend(page=1) {
		     const url = `/api/admin/friend/index?page=${page}`;		     
			 this.show_load = true;
			 await axios.get(url).then(({data})=>{
				this.friends = data;
				this.show_load = false;
			 }).catch(({ response })=>{
				console.error(response)
			 })
        },
		
        async deleteFriend(id) {
		    if(confirm('Are you sure to delete this item?')){
				let res = await axios.get(`/api/admin/friend/destroy/${id}`);
				toastr.success(res.data.message);
				this.getFriend();
			}
        },
		
		async searchData(page=1) {	
		
		      const value = this.search;
		        this.show_load = true;
                await axios.get(`/api/admin/friend/search?page=${page}&key=${value}`).then(({data})=>{
                    this.friends = data;
					this.show_load = false;
                }).catch(({ response })=>{
                    console.error(response)
                })
        },
		
		 exportData() {
		       window.open('/api/admin/friend/'+this.exporttype,'_blank');
        },
		
    },
	
	
};
</script>

<style scoped>
    .pagination{
        margin-bottom: 0;
    }
</style>