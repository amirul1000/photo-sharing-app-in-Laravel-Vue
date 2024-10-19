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
	
	
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<div class="col-md-12 col-lg-4"  style="padding: 5px;">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title mb-1">Members</h4>
			  <h4 class="text-primary mb-1">{{counting.users}}</h4>
			  <router-link to="/member/index" 
			  class="btn btn-secondary">View</router-link>
			</div>		
		  </div>
		</div>


		<div class="col-md-12 col-lg-4"  style="padding: 5px;">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title mb-1">Category</h4>
			  <h4 class="text-primary mb-1">{{counting.category}}</h4>
			  <router-link to="/category/index" 
			  class="btn btn-secondary">View</router-link>
			</div>		
		  </div>
		</div>


		<div class="col-md-12 col-lg-4"  style="padding: 5px;">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title mb-1">Post</h4>
			  <h4 class="text-primary mb-1">{{counting.post}}</h4>
			  <router-link to="/post/index" 
			  class="btn btn-secondary">View</router-link>
			</div>		
		  </div>
		</div>


		<div class="col-md-12 col-lg-4"  style="padding: 5px;">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title mb-1">Share</h4>
			  <h4 class="text-primary mb-1">{{counting.share}}</h4>
			  <router-link to="/share/index" 
			  class="btn btn-secondary">View</router-link>
			</div>		
		  </div>
		</div>
		
		
		<div class="col-md-12 col-lg-4"  style="padding: 5px;">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title mb-1">Friend</h4>
			  <h4 class="text-primary mb-1">{{counting.friend}}</h4>
			  <router-link to="/friend/index" 
			  class="btn btn-secondary">View</router-link>
			</div>		
		  </div>
		</div>
		
		
	</div>
	
  </div>

   <!--Main contains-->
   
 <div v-if="show_load" style="text-align:center;">
    <pulse-loader :color="color" :size="size" :margin="margin" :radius="radius"></pulse-loader>
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

import Header from '../../components/admin/Header.vue';
import Footer from '../../components/admin/Footer.vue';
import TopNav from '../../components/admin/TopNav.vue';
import SideBar from '../../components/admin/SideBar.vue';

export default {
    name: "Dashboard",
	components: {
	     PulseLoader,
		 Header,
		 Footer,
		 TopNav,
		 SideBar
  },
  data() {
        return {
              counting : ref({}), 
			  show_load:true,
			  }
		},
   mounted() {
        this.getAdminDashboardCounting();
    },
   methods: {
        async getAdminDashboardCounting() {
		     const url = `/api/admin/counting`;		     
			 this.show_load = true;
			 await axios.get(url).then(({data})=>{
				this.counting = data;
				console.log(this.counting);
				this.show_load = false;
			 }).catch(({ response })=>{
				console.error(response)
			 })
        },
	}
};
</script>	