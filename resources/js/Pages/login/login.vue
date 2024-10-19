<!--https://medium.com/@nisma.hossain.41982/authorization-and-authentication-in-vue-js-and-laravel-simple-way-3cf06be7ab22-->

<template>
<div class="container login mt-5">    
 <div class="card">
      <div class="card-header">
        Login
      </div>
      <div class="card-body">


<div class="text-2xl text-center">
    Join Us today
</div>
<div class="mt-2 mb-2 text-xl text-center">
    this is Login page
</div>
<div class="p-5 m-5">
<form @submit.prevent="validateAndLogin">
<div class="mb-3 pt-0 text-center">
<label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-password">Email:</label>
<input type="text"
v-model="email"
:class="{ 'border-red-500': showErrorEmail }"
placeholder="Email"
class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative
bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2 required"/>
</div>
<div class=" pt-0 text-center">
<label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-password">Password:</label>
<input type="text"
v-model="password"
:class="{ 'border-red-500': showErrorPassword }"
placeholder="Password" class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative
bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2 required"/>
</div>
<div class="mt-3 pt-0 text-center">
<button class="btn btn-primary rounded">
Login
</button>
 <a href="#/register">Register</a>
</div>
</form>
</div>

</div>
</div>
</div>
</template>
<script setup>
import { ref } from 'vue';
import axios from 'axios';
self = this;
const email = ref('');
const password = ref('');
const showErrorEmail = ref(false);
const showErrorPassword = ref(false);
const validateAndLogin = async () => {
showErrorEmail.value = !email.value;
showErrorPassword.value = !password.value;
if (showErrorEmail.value || showErrorPassword.value) {
return;
}
try {
const response = await axios.post('/api/login/', {
	email: email.value,
	password: password.value
});
console.log(response.data.authorisation.token); // Access token from the 'authorisation' object
const token = response.data.authorisation.token; // Access token from the 'authorisation' object
const user = response.data.user; // User object
if(token){
localStorage.setItem('token', token);
localStorage.setItem('user', JSON.stringify(user));
   window.location.href = '#/Dashboard';
} else {
console.error('Token not received');
}
} catch (error) {
console.error(error);
alert(error.message+' '+error.response.data.message);
}
}
</script>