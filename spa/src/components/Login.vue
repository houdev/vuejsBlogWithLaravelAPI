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
            <v-form>
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <v-text-field label="Email*" required v-model="email"></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Password*" type="password" required v-model="password"></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-form>
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
    methods:{
      login(){
        let app = this;
        this.$auth.login ({
          data: {
            email: app.email,
            password: app.password
          },
          success: function () {
            app.success = true;
          },
          error: function () {
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