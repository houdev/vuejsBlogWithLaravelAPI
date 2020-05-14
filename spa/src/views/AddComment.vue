<template>
  <v-card align="center">
    <v-form ref="addCommentForm">
      <v-container>
        <v-row justify="center" align="center">
          <v-col cols="10">

            <v-textarea
              v-model="comment"
              outlined
              name="comment"
              label="Comment"
              :rules="commentRules"
            >
            </v-textarea>
          </v-col>
          <v-col cols="10">
            <v-btn
              color="success"
              @click="addComment"
            >
              <v-icon>
                mdi-plus
              </v-icon>
              Add Comment
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>

  </v-card>
</template>

<script>
  import {apiUrl} from '@/variables.js'
  import axios from 'axios'

  export default {
    name: "Comment",
    props: ['currentArticleID'],
    data (){
      return {
        commentRules: [
          comment => comment && comment.length >= 10 || 'Minimum characters is 10',
          comment => comment && comment.length <= 100 || 'Maximum characters is 100',
        ],
        comment: null,
      }
    },
    methods:{
      addComment(){

        // Check the form if it's not validate return null
        if(!this.$refs.addCommentForm.validate()){
          return null;
        }

        let comment = this.comment;
        let articleId = this.currentArticleID;

        axios.post(`${apiUrl}/api/comment/add`,{
          comment,
          articleId
        })
          .catch(error => console.log(error));

        //send 'commentAdded' event to update the comments list
        this.$emit('commentAdded');

        this.comment = null;
      },
    },
  }
</script>

<style scoped>

</style>