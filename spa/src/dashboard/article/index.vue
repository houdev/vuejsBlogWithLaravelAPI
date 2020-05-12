<template>
  <v-container>
    <v-toolbar>

      <v-toolbar-title>Articles <span class="blue--text">{{ articlesCount }}</span></v-toolbar-title>
      <div class="flex-grow-1"></div>
      <v-icon>mdi-magnify</v-icon>
      <v-text-field label="Search" v-model="searchForTitle" @change="searchForTitleFn" hide-details single-line></v-text-field>

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
                  <v-btn
                    fab
                    small
                    color="primary"
                    @click="editThisArticle(article.title, article.body, article.id)">
                    <v-icon>mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn fab small color="red" dark @click="deleteThisArticle(article.id)">
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </td>
              </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-card>
      </v-col>

      <v-pagination
        class="mt-5 mb-5"
        v-model="pagination.current"
        :length="pagination.total"
        @input="getArticles"
      ></v-pagination>

    </v-row>

<!--    Edit Article    -->
    <v-dialog
            v-model="showEditDialog"
            max-width="50%"
    >
      <v-card>
        <v-card-title class="headline">Edit This Article</v-card-title>

        <v-card-text>
          <v-form ref="editArticleForm">
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    label="Title"
                    v-model="currentTitle"
                    :rules="articleTitleRules"
                  >
                  </v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-textarea
                    v-model="currentBody"
                    outlined
                    name="body"
                    label="Body"
                    :rules="articleBodyRules"
                  >
                  </v-textarea>
                </v-col>
              </v-row>
            </v-container>
          </v-form>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            text
            @click="showEditDialog = false"
          >
            Cancel
          </v-btn>

          <v-btn
            color="green darken-1"
            text
            @click="updateThisArticle()"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!--    Delete Article    -->
    <v-dialog
      v-model="showDeleteDialog"
      max-width="290"
    >
      <v-card>
        <v-card-title class="headline">Delete This Article!</v-card-title>

        <v-card-text>
          Do You Want To Delete This Article?
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            text
            @click="showDeleteDialog = false"
          >
            No
          </v-btn>

          <v-btn
            color="green darken-1"
            text
            @click="deleteArticle"
          >
            Yes
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

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
        articleTitleRules:[
          title => title && title.length >= 10 || "The title most be more than 10 characters"
        ],
        articleBodyRules:[
          body => body && body.length >= 20 || "The body most be more than 20 characters"
        ],
        articles:[],
        pagination:{
          current:1,
          total:0
        },
        showEditDialog:false,
        currentArticleId:null,
        currentTitle:null,
        currentBody:null,
        showDeleteDialog:false,
        deleteArticleID:null,
        searchForTitle:null,
        articlesCount: 0,
      }
    },
    methods:{
      getArticles(){
        axios.get(apiUrl+'/api/articles?page=' + this.pagination.current
        ).then( res => {
          this.articles = res.data.data;
          this.pagination.current = res.data.current_page;
          this.pagination.total = res.data.last_page;
        })
      },
      updateArticlesView(newArticlesList){
        this.articles = newArticlesList;
      },
      editThisArticle(currentTitle, currentBody, currentArticleId){

        //Open The Edit Article Dialog
        this.showEditDialog = true;

        //Get The Current Article's Details
        this.currentTitle = currentTitle;
        this.currentBody = currentBody;
        this.currentArticleId = currentArticleId;
      },
      updateThisArticle(){

        // Check the form if it's not validate return null
        if(!this.$refs.editArticleForm.validate()){
          return null;
        }

        //Get The New Article's Details
        let id = this.currentArticleId;
        let title = this.currentTitle;
        let body = this.currentBody;

        //Send Update Request To The API
        axios.post(`${apiUrl}/api/articles/update/${id}`, {
          title,
          body
        })
          .then( result => this.articles = result.data.data )
          .catch( error => console.log(error) );

        // Return the pagination to 1
        this.pagination.current = 1;

        //Close The Edit Article Dialog
        this.showEditDialog = false;
      },
      deleteThisArticle(id){

        //Get The Article's Id From v-for
        this.deleteArticleID = id;

        //Open The Delete Article Dialog
        this.showDeleteDialog = true;
      },
      deleteArticle(){
        //Get The Article's Id To Delete The Article
        let id = this.deleteArticleID;

        //Send Delete Request To The API
        axios.post(`${apiUrl}/api/articles/delete/${id}`)
              .then( result => this.articles = result.data.data )
              .catch( error => console.log(error) );

        // Return the pagination to 1
        this.pagination.current = 1;

        //Close The Delete Article Dialog
        this.showDeleteDialog = false;
      },
      searchForTitleFn(){
        var searchTitle = this.searchForTitle;

        axios.post(`${apiUrl}/api/articles/search`, {
          articleTitle:searchTitle
        })
          .then( result => {
            this.articles = result.data.data;
            this.pagination.current = result.data.current_page;
            this.pagination.total = result.data.last_page;
          })
          .catch( error => console.log(error) );
      },
    },
    created(){
        //get Articles
        this.getArticles();

        // Get Blog Statistics
        axios.get(`${apiUrl}/api/blog/statistics`)
          .then( result => {
            this.articlesCount = result.data.articlesCount;
          })
          .catch( error => console.log(error) );
      }
  }
</script>

<style scoped>

</style>