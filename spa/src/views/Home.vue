<template>
  <div>
      <v-app-bar
        app
        color="primary"
        dark
      >
        <v-toolbar-title>Simple Blog</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn
           icon
           @click="loginDialog = true"
           v-if="!$auth.check()"
        >
          <v-icon>mdi-account-circle</v-icon>
        </v-btn>

        <b class="mr-2" v-if="$auth.check()">{{ userInfo.userName }}</b>

        <v-menu v-if="$auth.check()"
          transition="slide-x-transition"
          bottom
          right
        >
          <template v-slot:activator="{ on }">
            <v-avatar v-on="on" class="avatar" width="40px" height="40px">
              <img :src="userInfo.userPicture" alt="Member-picture" />
            </v-avatar>
          </template>

          <v-list>
            <v-list-item to="/dashboard/dashboard">
              <v-list-item-title>Dashboard</v-list-item-title>
            </v-list-item>
            <v-list-item @click="logout">
              <v-list-item-title>Log-out</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </v-app-bar>

      <v-card class="ma-9">
        <v-row justify="center">
          <v-col cols="12">
            <h2>Articles: <span class="blue--text">{{ myArticles.length }}</span></h2>
          </v-col>
        </v-row>
      </v-card>

      <articles 
        :myArticles="myArticles"
        v-on:deleteArticle="deleteArticle"
        v-on:updateArticle="updateMyArticle"
      />

      <v-snackbar
        v-model="snackbar"
        right
        color="success"
      >
      {{ successMessage }}
        <v-btn
          color="whiet"
          text
          @click="snackbar = false"
        >
        Close
        </v-btn>
      </v-snackbar>

      <v-dialog v-model="loginDialog" max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline">Log in</span>
        </v-card-title>

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
              ></v-text-field>

              <v-text-field
                label="Password*"
                type="password"
                required
                v-model="password"
                :rules="loginFormRules"
                @keyup.enter="login"
              ></v-text-field>

          </v-form>

          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn class="primary" @click="login">
            <v-icon>
              mdi-account
            </v-icon>
            Log in
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-pagination
      class="mt-5 mb-5"
      v-model="pagination.current"
      :length="pagination.total"
      @input="getArticles"
    >
    </v-pagination>

    <v-footer color="primary lighten-3" class="mt-5" padless>
      <v-col
        class="primary lighten-2 py-4 text-center white--text"
        cols="12"
      >
        {{ new Date().getFullYear() }} — <strong>Small Blog</strong>
      </v-col>
    </v-footer>

  </div>
</template>

<script>
import {apiUrl} from '@/variables.js'
import Articles from '../components/Articles.vue'
import axios from 'axios'

export default {
  name: 'Home',

  components: {
    Articles
  },
  data (){
    return {
      loginFormRules:[
        value => value && value.length >= 4 || 'Minimum length is 4 characters'
      ],
      myArticles:[],
      snackbar:false,
      successMessage:null,
      loginDialog:false,
      email:null,
      password:null,
      success: false,
      has_error: false,
      credentialError:{
        error: false,
        message: null
      },
      myToken: null,
      pagination:{
        current:1,
        total:0
      },
      userInfo:{
        userName: null,
        userPicture: null,
      }
    }
  },
  methods:{
    getCurrentUserInfo(){

      //If the user not logged in then return null
      if(!this.$auth.check()) return null;

      this.$auth.fetch().then( res => {
          this.userInfo.userName = res.data.data.name;
          this.userInfo.userPicture = res.data.data.picture;
      });
    },
    getArticles(){
      axios.get(apiUrl+'/api/articles?page=' + this.pagination.current
      ).then( res => {
        this.myArticles = res.data.data;
        this.pagination.current = res.data.current_page;
        this.pagination.total = res.data.last_page;
      })
    },
    deleteArticle(id){
      axios.post(`${apiUrl}/api/articles/delete/${id}`)
        .then(result => this.myArticles = result.data, 
                        this.successMessage = "Article Has Been Deleted Successfully", 
                        this.snackbar = true )
        .catch(error => console.log(error) );
    },
    updateMyArticle(id, updatedArticle){
      let { title, body} = updatedArticle

      axios.post(`${apiUrl}/api/articles/update/${id}`, {
          title,
          body
      })
        .then(result => this.myArticles = result.data, 
                        this.successMessage = "Article Has Been Updated Successfully", 
                        this.snackbar = true )
        .catch(error => console.log(error) );
    },
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
    logout(){
        this.$auth
            .logout({
                makeRequest: true,
                redirect: {name: 'Home'},
            });
    },
  },
  created(){
    //Get Articles
    this.getArticles();

    //Get Current User Info
    this.getCurrentUserInfo();
  },
};
</script>
