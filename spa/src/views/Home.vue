<template>
  <div>
      <v-app-bar
        app
        color="primary"
        dark
      >
        <v-toolbar-title>Simple Blog</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon @click="loginDialog = true">
          <v-icon>mdi-account-circle</v-icon>
        </v-btn>
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
      myArticles:[],
      snackbar:false,
      successMessage:null,
      loginDialog:false,
      email:null,
      password:null,
      success: false,
      has_error: false,
    }
  },
  methods:{
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
        let app = this;
        this.$auth.login({
            data: {
                email: app.email,
                password: app.password
            },
            success: function(data) {
                console.log(data)
                // handle redirection
                app.success = true
                 let redirectTo = 'dashboard'
                app.$router.push({name: redirectTo})
            },
            error: function(res) {
                app.has_error = true
                console.log(res)
            },
        })
    },
  },
  created(){
    axios.get(`${apiUrl}/api/articles`)
      .then(result => this.myArticles = result.data)
      .catch(error => console.log(error))
  },
};
</script>
