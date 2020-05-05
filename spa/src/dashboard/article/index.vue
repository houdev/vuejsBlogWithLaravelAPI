<template>
  <v-container>
    <v-toolbar>

      <v-toolbar-title>Articles <span class="blue--text">{{ articles.length }}</span></v-toolbar-title>
      <div class="flex-grow-1"></div>
      <v-icon>mdi-magnify</v-icon>
      <v-text-field label="Search" hide-details single-line></v-text-field>

      <v-spacer></v-spacer>

      <add-article @updateArticlesView="updateArticlesView" />

    </v-toolbar>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-simple-table>
            <template v-slot:default>
              <thead>
              <tr>
                <th class="text-left">Title</th>
                <th class="text-left">Last Update</th>
                <th class="text-left">Actions</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="article in articles" :key="article.id">
                <td>{{ article.title }}</td>
                <td>{{ article.updated_at }}</td>
                <td>
                  <v-btn fab small color="primary">
                    <v-icon>mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn fab small color="red" dark>
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </td>
              </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import AddArticle from "./AddArticle";
  import { apiUrl } from "../../variables";
  import axios from "axios";

  export default {
    name: "articles",
    components:{
      AddArticle
    },
    data () {
      return {
        articles:[]
      }
    },
    methods:{
      updateArticlesView(newArticlesList){
        this.articles = newArticlesList;
      }
    },
    created(){
        //get Articles
        axios.get(apiUrl+'/api/articles'
        ).then( res => this.articles = res.data )
      }
  }
</script>

<style scoped>

</style>