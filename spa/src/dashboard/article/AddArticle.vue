<template>
  <v-dialog v-model="dialog" max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="success" v-on="on" dark>
        <v-icon size="20px">mdi-plus</v-icon>
        Add New Article
      </v-btn>
    </template>
    <v-card align="center">
      <v-form ref="addArticleForm">
        <v-container>
          <v-row justify="center" align="center">
            <v-col cols="10">
              <v-text-field
                label="Title"
                v-model="title"
                :rules="articleTitleRules"
              >
              </v-text-field>
              <v-textarea
                v-model="body"
                outlined
                name="bdoy"
                label="Bdoy"
                :rules="articleBodyRules"
              >
              </v-textarea>
            </v-col>
            <v-col cols="10">
              <v-btn
                color="success"
                @click="AddArticle"
              >
                <v-icon>
                  mdi-plus
                </v-icon>
                Add Article
              </v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-form>

    </v-card>
  </v-dialog>
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
            dialog:false,
            articleTitleRules:[
              title => title && title.length >= 10 || "The title most be more than 10 characters"
            ],
            articleBodyRules:[
              body => body && body.length >= 20 || "The body most be more than 20 characters"
            ],
        }
    },
    methods:{
        AddArticle(){

            // Check the form if it's not validate return null
            if(!this.$refs.addArticleForm.validate()){
            return null;
            }

            Axios.post(`${apiUrl}/api/articles/add`,{
             title: this.title,
             body: this.body
            })
              .then( result => this.$emit('updateArticlesView', result.data.articles ) )
              .catch( error => console.log(error) );

            //empty the fields after the add
            this.title = "";
            this.body = "";

            // close dialog
            this.dialog = false;

        },
    },
}
</script>

<style scoped>

</style>