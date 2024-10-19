<template>
   <LeftMenu></LeftMenu>
   
   <Topnav></Topnav>
 </template>	

<script>

import LeftMenu from '../../components/admin/LeftMenu.vue';
import Topnav from '../../components/admin/Topnav.vue';

export default {
    name: "Header",
	components: {
	LeftMenu,
	Topnav
  }
};
</script>