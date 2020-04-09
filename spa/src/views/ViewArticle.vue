<template>
  <div class="about">

    <v-container>
        <v-row justify="center" align="center">
          <v-card width="85%">

            <v-list-item >
              <v-list-item-content>
                <div class="overline mb-4">{{ myArticle.created_at }}</div>
                <v-list-item-title class="headline mb-1">
                  {{ myArticle.title }}
                </v-list-item-title>

                <v-spacer></v-spacer>

                <v-divider class="mx-4"></v-divider>

                <v-spacer></v-spacer>
                
                <v-list-item-text>{{ myArticle.body }}</v-list-item-text>
              </v-list-item-content>
            </v-list-item>

          </v-card>
        </v-row>
      </v-container>

  </div>
</template>

<script>
import axios from 'axios'

export default {
  name:'ViewArticle',
  data (){
    return {
      myArticle:[],
    }
  },
  created(){
    axios.get(`http://127.0.0.1:8000/api/articles/${this.$route.params.id}`)
      .then(result => this.myArticle = result.data)
      .catch(error => console.log(error))
  },
}
</script>