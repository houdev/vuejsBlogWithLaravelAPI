<template>
    <div>
      <v-row justify="center" align="center">
        <v-col cols="10">
          <v-text-field label="Title" v-model="title"></v-text-field>
          <v-textarea
          v-model="body"
          outlined
          name="bdoy"
          label="Bdoy"
          >
          </v-textarea>
        </v-col>
        <v-col cols="10">
          <v-btn color="success"
          v-bind:disabled="title.length < 5" 
          @click="AddArticle">
            <v-icon>
                mdi-plus
            </v-icon>
            Add Article
          </v-btn>
        </v-col>
      </v-row>
    </div>
</template>

<script>

export default {
    name:'AddArticle',
    data(){
        return {
            title: "",
            body: "",
        }
    },
    methods:{
    AddArticle(){
        let newArticle = {
            id: Math.round(Math.random() *1000),
            title: this.title,
            body: this.body,
            createdDate: '01-4-2020'
        }
        this.$emit('newArticle' , newArticle);
        this.title = "";
        this.body = "";
    },
    }
}
</script>

<style scoped>

</style>