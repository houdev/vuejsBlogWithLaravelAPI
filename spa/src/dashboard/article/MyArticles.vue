<template>
  <div>
    <v-toolbar class="ma-5">

      <v-toolbar-title>Articles <span class="blue--text">{{ myArticles.length }}</span></v-toolbar-title>

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
              <tr v-for="article in myArticles" :key="article.id">
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

  </div>
</template>

<script>
    import axios from "axios";
    import {apiUrl} from '@/variables.js'
    import AddArticle from "./AddArticle";

    export default {
        name: "MyArticles",
        components: {
            AddArticle
        },
        data (){
            return {
                articleTitleRules:[
                  title => title && title.length >= 10 || "The title most be more than 10 characters"
                ],
                articleBodyRules:[
                  body => body && body.length >= 20 || "The body most be more than 20 characters"
                ],
                myArticles:[],
                showEditDialog: false,
                currentArticleId: null,
                currentTitle: null,
                currentBody: null,
                showDeleteDialog: false,
                deleteArticleID: null,
            }
        },
        methods:{
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

              //Update Articles List View
              this.updateArticlesView();

              //Close The Edit Article Dialog
              this.showEditDialog = false;
            },
            updateArticlesView(){
              axios.get(apiUrl+'/api/myarticles')
                .then(result => this.myArticles = result.data)
                .catch(error => console.log(error))
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

              //Update Articles List View
              this.updateArticlesView();

              //Close The Delete Article Dialog
              this.showDeleteDialog = false;
            },
        },
        created(){
            axios.get(apiUrl+'/api/myarticles')
                .then(result => this.myArticles = result.data)
                .catch(error => console.log(error))
        },
    }
</script>

<style scoped>

</style>