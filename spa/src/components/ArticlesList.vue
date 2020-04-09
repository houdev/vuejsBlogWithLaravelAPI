<template>
    <div>
      <v-container>
        <v-row justify="center" align="center">
          <v-card width="85%">

            <v-list-item three-line :to="'/ViewArticle/'+myArticle.id">
              <v-list-item-content>
                <div class="overline mb-4">{{ myArticle.created_at }}</div>
                <v-list-item-title  class="headline mb-1">{{ myArticle.title }}</v-list-item-title>
                <v-list-item-subtitle>{{ myArticle.body }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <v-card-actions>

              <v-btn icon>
                <v-icon
                  color="error" @click="showDeleteDialog = true"
                >
                mdi-delete
                </v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon
                  color="blue"
                  @click="showEditDialog = true"
                >
                mdi-pencil
                </v-icon>
              </v-btn>

            </v-card-actions>

          </v-card>
        </v-row>
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
              @click="deleteArticle(myArticle.id)"
            >
              Yes
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog
        v-model="showEditDialog"
        max-width="50%"
      >
        <v-card>
          <v-card-title class="headline">Edit This Article</v-card-title>

          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-text-field 
                    label="Title" 
                    v-model="currentTitle"
                  >
                  </v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-textarea
                    v-model="currentBody"
                    outlined
                    name="bdoy"
                    label="Bdoy"
                  >
                  </v-textarea>
                </v-col>
              </v-row>
            </v-container>
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
              @click="UpdateMyArticle(myArticle.id)"
            >
              Save
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      </v-container>
    </div>
</template>

<script>
export default {
    name:'ArticlesList',
    props:['myArticle','currentIndex'],
    data(){
      return{
        showEdit:false,
        showEditDialog:false,
        showDeleteDialog:false,
        currentTitle:this.myArticle.title,
        currentBody:this.myArticle.body,
      }
    },
    methods:{
      UpdateMyArticle(id){
        let updatedArticle = {
          title: this.currentTitle,
          body: this.currentBody,
        }
        this.$emit('updateArticle', id, updatedArticle);

        //close dialog
        this.showEditDialog = false;
      },
      deleteArticle(myArticleId){
        
         this.$emit('deleteArticle' , myArticleId);

         //close dialog
         this.showDeleteDialog = false;
        
      },
    },
}
</script>

<style scoped>

</style>