<template>
    <div>
      <v-container>
        <v-row justify="center" align="center">
          <v-card width="85%">

            <v-list-item three-line v-if="!showEdit" :to="'/ViewArticle/'+currentIndex">
              <v-list-item-content>
                <div class="overline mb-4">{{ myArticle.created_at }}</div>
                <v-list-item-title  class="headline mb-1">{{ myArticle.title }}</v-list-item-title>
                <v-list-item-subtitle>{{ myArticle.body }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <div v-if="showEdit">
              <v-text-field 
              label="Title" 
              v-model="currentTitle"
              >
              </v-text-field>
              <v-textarea
              v-model="myArticle.body"
              outlined
              name="bdoy"
              label="Bdoy"
              >
              </v-textarea>
            </div>

            <v-card-actions>

              <v-btn icon>
                <v-icon
                color="error" @click="$emit('deleteArticle' , myArticle.id)"
                >
                mdi-delete
                </v-icon>
              </v-btn>
              <v-btn icon v-if="!showEdit">
                <v-icon
                color="blue"
                @click="showEdit = true"
                >
                mdi-pencil
                </v-icon>
              </v-btn>
              <v-btn icon v-if="showEdit">
                <v-icon
                color="green" @click="UpdateMyArticle(myArticle.id)"
                >
                mdi-floppy
                </v-icon>
              </v-btn>

            </v-card-actions>

          </v-card>
        </v-row>
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

        this.showEdit = false;
      }
    },
}
</script>

<style scoped>

</style>