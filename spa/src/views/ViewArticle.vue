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
        color="#00796B"
        fab
        dark
        @click="$router.go(-1)"
      >
        <v-icon>mdi-arrow-left-bold</v-icon>
      </v-btn>

    </v-app-bar>

    <v-container>
        <v-row justify="center" align="center">
          <v-col cols="12">
          <v-card>

            <v-list-item class="text-center">
              <v-list-item-content>
                <div class="overline mb-4">{{ myArticle.created_at }}</div>
                <v-list-item-title class="headline mb-1">
                  {{ myArticle.title }}
                </v-list-item-title>

                <v-divider class="mx-4"></v-divider>

                <span class="mt-5" v-html="myArticle.body"></span>

              </v-list-item-content>

            </v-list-item>

          </v-card>
          </v-col>
        </v-row>
      </v-container>

    <v-container>
      <h2>Comments:</h2>

      <comments-list
        :comments="comments"
      />

      <add-comment
        v-if="$auth.check()"
        :currentArticleID="myArticle.id"
        @commentAdded="getComments"
      />

      <v-row v-if="!$auth.check()">
        <v-col align="center" class="pa-5">
          <v-card class="pa-5">
            <p>Login to add comments</p>
            <v-btn
              color="primary"
              to="/login"
            >
              Login
            </v-btn>
          </v-card>
        </v-col>
      </v-row>

    </v-container>


  </div>
</template>

<script>
import {apiUrl} from '@/variables.js'
import axios from 'axios'
import AddComment from './AddComment.vue'
import CommentsList from './CommentsList.vue'

export default {
  name:'ViewArticle',
  components:{
    CommentsList,
    AddComment,
  },
  data (){
    return {
      myArticle:[],
      comments: [],
    }
  },
  methods:{
    getArticles(){
      axios.get(`${apiUrl}/api/articles/${this.$route.params.id}`)
        .then(result => this.myArticle = result.data)
        .catch(error => console.log(error));
    },
    getComments(){
      axios.get(`${apiUrl}/api/comment/article/${this.$route.params.id}`)
        .then(result => this.comments = result.data)
        .catch(error => console.log(error))
    },
  },
  created(){
    this.getArticles();
    this.getComments();
  },
}
</script>