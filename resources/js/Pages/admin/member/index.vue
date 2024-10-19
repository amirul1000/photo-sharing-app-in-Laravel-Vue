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
            <h1>Member</h1>
            <router-link to="/member/add" class="btn btn-secondary"
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
                    <th>Name</th>
                    <th>Email</th>
					<th>Role</th>
					<th>Picture</th>
					<th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(member, key) in members.data" :key="member.id">
                    <td>{{ key }}</td>
                    <td>{{ member.name }}</td>
                    <td>{{ member.email }}</td>
					<td>{{ member.role }}</td>
					<td>
					   <div v-if="member.profile_picture">
					    <img :src="member.profile_picture" class="img-fluid rounded-circle small" :key="key" style="width:50px;height:50px;"/>
						</div>
					
					</td>
					<td>{{ member.active }}</td>
                    <td>
                        <router-link
                            :to="{
                                name: 'EditMember',
                                params: { id: member.id },
                            }"
                            class="btn btn-info"
                            >Edit</router-link>
                        <button
                            type="button"
                            class="btn btn-danger ms-2"
                            v-on:click="deleteMember(member.id)">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


   
  <Bootstrap5Pagination align="center" :data="members" :limit="2" :size="default"  @pagination-change-page="getMember"></Bootstrap5Pagination>


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
    name: "member",	
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
              members: ref({}), 
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
        this.getMember(1);
    },
    methods: {
        async getMember(page=1) {
		     const url = `/api/admin/user/index?page=${page}`;		     
			 this.show_load = true;
			 await axios.get(url).then(({data})=>{
				this.members = data;
				this.show_load = false;
			 }).catch(({ response })=>{
				console.error(response)
			 })
        },
        async deleteMember(id) {
		    if(confirm('Are you sure to delete this item?')){
				let res = await axios.get(`/api/admin/user/destroy/${id}`);
				toastr.success(res.data.message);
				this.getMember();
			}
        },
		
		async searchData(page=1) {	
		
		      const value = this.search;
		        this.show_load = true;
                await axios.get(`/api/admin/user/search?page=${page}&key=${value}`).then(({data})=>{
                    this.members = data;
					this.show_load = false;
                }).catch(({ response })=>{
                    console.error(response)
                })
        },
		
		 exportData() {
		       window.open('/api/admin/user/'+this.exporttype,'_blank');
        },
		
    },
	
	
};
</script>

<style scoped>
    .pagination{
        margin-bottom: 0;
    }
</style>