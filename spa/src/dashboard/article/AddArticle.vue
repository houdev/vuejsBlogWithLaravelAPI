<template>
    <div>
      <v-snackbar
        v-model="snackbar"
        right
        color="success"
      >
      {{ successMessage }}
        <v-btn
          color="white"
          text
          @click="snackbar = false"
        >
        Close
        </v-btn>
      </v-snackbar>
      <v-row justify="center" align="center">
        <v-col cols="10">
          <v-text-field label="Title" v-model="title"></v-text-field>
          <v-textarea
          v-model="body"
          outlined
          name="bdoy"
          label="Bdoy"
          >
          </v-textarea>
        </v-col>
        <v-col cols="10">
          <v-btn color="success"
          v-bind:disabled="title.length < 5" 
          @click="AddArticle">
            <v-icon>
                mdi-plus
            </v-icon>
            Add Article
          </v-btn>
        </v-col>
      </v-row>
    </div>
</template>

<script>
import {apiUrl} from '@/variables.js'
import Axios from 'axios';

export default {
    name:'AddArticle',
    data(){
        return {
            title: "",
            body: "",
            snackbar:false,
            successMessage:null
        }
    },
    methods:{
    AddArticle(){
       
       Axios.post(`${apiUrl}/api/articles/add`,{
         title: this.title,
         body: this.body
       })
          .then(result => this.successMessage = result.data.message, this.snackbar=true)
          .catch(error => console.log(error));
       
        //empty the fields after the add
        this.title = "";
        this.body = "";
    },
    }
}
</script>

<style scoped>

</style>