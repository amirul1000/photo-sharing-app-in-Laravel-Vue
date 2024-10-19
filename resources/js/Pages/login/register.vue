<template>   
  <div class="container login mt-5">    
  
    <a href="#/">login</a> |  <a href="#/">Forget Password</a>
  
    <div class="card">
      <div class="card-header">
        Register
      </div>
      <div class="card-body">
        <!--<form>-->
          <div class="form-group">
            <label for="email">Name</label>
            <input
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.name }"
              id="name"
              v-model="member.name"
              placeholder="Enter name"
            />
            <div class="invalid-feedback" v-if="errors.name">
              {{ errors.name[0] }}
            </div>
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input
              type="email"
              class="form-control"
              :class="{ 'is-invalid': errors.email }"
              id="email"
              v-model="member.email"
              placeholder="Enter email"
            />
            <div class="invalid-feedback" v-if="errors.email">
              {{ errors.email[0] }}
            </div>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              class="form-control"
              :class="{ 'is-invalid': errors.password }"
              id="password"
              v-model="member.password"
              placeholder="Password"
            />
            <div class="invalid-feedback" v-if="errors.password">
              {{ errors.password[0] }}
            </div>
          </div>
          <div class="form-group">
            <label for="password_confirmation">Confirm password</label>
            <input
              type="password"
              class="form-control"
              id="password_confirmation"
              v-model="member.password_confirmation"
              placeholder="Confirm password"
            />
          </div>
          <button type="button" @click="register" class="btn btn-primary">
            Register
          </button>
        <!--</form>-->
      </div>
    </div>
  </div>
</template>



<script>
import { ref } from 'vue';
import axios from "axios";
import toastr from "toastr";


export default {
    name: 'Register',
	components: {
		
	  },
    data() {
        return {
		    member:ref({}),
            name: null,
			email: null,
			password: null,
			password_confirmation: null,
			errors:{},
			};
    },
    methods: {
        async register() {
            try {
			
			   console.log(this.member);
                let response = await axios.post('/api/register', this.member);
				
                toastr.success('Registration has been completed Successfully')
                this.member = {};
				
				const token = response.data.authorisation.token; 
				const user = response.data.user; 
				if(token){
					localStorage.setItem('token', token);
					localStorage.setItem('user', JSON.stringify(user));
				     window.location.href = '#member/Dashboard';
				} else {
					console.error('Token not received');
				}
				
            } catch (error) {			   
                console.log(error);
				alert(error.message+' '+error.response.data.message);
            }
        },

    }
}
</script>
