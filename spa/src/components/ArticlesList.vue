<template>
    <div>
      <v-container>
        <v-row justify="center" align="center">
          <v-card width="85%">

            <v-list-item three-line v-if="!showEdit">
              <v-list-item-content>
                <div class="overline mb-4">{{ myArticle.createdDate }}</div>
                <v-list-item-title class="headline mb-1">{{ myArticle.title }}</v-list-item-title>
                <v-list-item-subtitle>{{ myArticle.body }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <div v-if="showEdit">
              <v-text-field 
              label="Title" 
              v-model="myArticle.title"
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
                color="green" @click="showEdit = false"
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
    props:['myArticle'],
    data(){
      return{
        showEdit:false
      }
    },
}
</script>

<style scoped>

</style>