<template>
  <div>
    <v-app-bar
            app
            color="primary"
            dark
    >

      <v-toolbar-title>Simple Blog</v-toolbar-title>

    </v-app-bar>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4 class="mt-5">
        <v-card class="elevation-12">
          <v-toolbar dark color="primary">
            <v-toolbar-title>Login</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form ref="loginForm">
              <v-alert type="error" v-if="credentialError.error">
                {{ credentialError.message }}
              </v-alert>

              <v-text-field
                label="Email*"
                required
                v-model="email"
                :rules="loginFormRules"
              >
              </v-text-field>

              <v-text-field
                label="Password*"
                type="password"
                required
                v-model="password"
                :rules="loginFormRules"
              >
              </v-text-field>

            </v-form>
            <small>*indicates required field</small>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn dark color="success" @click="login">Login</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
  export default {
    name: "Login",
    data(){
      return{
        loginFormRules:[
          value => value && value.length >= 4 || 'Minimum length is 4 characters'
        ],
        credentialError:{
          error: false,
          message: null
        },
        email:null,
        password:null,
      }
    },
    methods:{
      login(){

        // Check the form if it's not validate return null
        if(!this.$refs.loginForm.validate()){
          return null;
        }

        let app = this;
        this.$auth.login ({
          data: {
            email: app.email,
            password: app.password
          },
          success: function () {
            app.success = true;
          },
          error: function (error) {
            if(error.toString().indexOf("401") !== -1){
              app.credentialError.error = true;
              app.credentialError.message = "Your Email OR Password Is Wrong.";
            }
            app.has_error = true;
          },
          redirect: {name: 'dashboard'},
          staySignedIn: true,
          fetchUser: true
        })
      },
    }
  }
</script>

<style scoped>

</style>