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
                <h1>Create Category</h1>
                <router-link to="/category/index" class="btn btn-secondary">Back</router-link>
            </div>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-group">
                    <label for="cat_name">Category name</label>
                    <input type="text" name="cat_name" id="cat_name" class="form-control" v-model="category.cat_name" />
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" v-model="category.description"
                        class="form-control" />
                </div>
                <button type="button" class="btn btn-secondary mt-2" v-on:click="saveCategory()">Save</button>
            </form>
        </div>
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

import Header from '../../../components/admin/Header.vue';
import Footer from '../../../components/admin/Footer.vue';
import TopNav from '../../../components/admin/TopNav.vue';
import SideBar from '../../../components/admin/SideBar.vue';

export default {
    name: 'Category',
	components: {
		Header,
		 Footer,
		 TopNav,
		 SideBar
	  },
    data() {
        return {
            category: {} // Initial state
        };
    },
    methods: {
        async saveCategory() {
            try {

                let res = await axios.post('/api/admin/category/store', this.category);
                toastr.success('category saved Successfully')
                this.category = {}
            } catch (error) {
                console.log(error);
            }
        },

    }
}
</script>
