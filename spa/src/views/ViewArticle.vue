<template>
  <div class="about">
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
          <v-card width="85%">

            <v-list-item class="text-center">
              <v-list-item-content>
                <div class="overline mb-4">{{ myArticle.created_at }}</div>
                <v-list-item-title class="headline mb-1">
                  {{ myArticle.title }}
                </v-list-item-title>

                <v-divider class="mx-4"></v-divider>

                <p class="mt-5">{{ myArticle.body }}</p>
              </v-list-item-content>
            </v-list-item>

          </v-card>
        </v-row>
      </v-container>

  </div>
</template>

<script>
import {apiUrl} from '@/variables.js'
import axios from 'axios'

export default {
  name:'ViewArticle',
  data (){
    return {
      myArticle:[],
    }
  },
  created(){
    axios.get(`${apiUrl}/api/articles/${this.$route.params.id}`)
      .then(result => this.myArticle = result.data)
      .catch(error => console.log(error))
  },
}
</script>