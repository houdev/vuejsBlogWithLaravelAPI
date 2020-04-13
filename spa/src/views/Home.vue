<template>
  <div>
      <v-card class="ma-9">
      <v-row justify="space-between">
        <v-col cols="6">
          <h2>Articles: <span class="blue--text">{{ myArticles.length }}</span></h2>
        </v-col>
        <v-col cols="6">
          <v-btn color="success" to="/AddArticle">
            <v-icon>
              mdi-plus
            </v-icon>
            Add New Article
          </v-btn>
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
      successMessage:null
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
      }
  },
  created(){
    axios.get(`${apiUrl}/api/articles`)
      .then(result => this.myArticles = result.data)
      .catch(error => console.log(error))
  },
};
</script>
