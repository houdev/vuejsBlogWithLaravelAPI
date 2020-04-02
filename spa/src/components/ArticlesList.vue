<template>
    <div>
      <v-container>
        <v-row justify="center" align="center">
          <v-card width="85%">

            <v-list-item three-line>
            <v-list-item-content>
              <div class="overline mb-4">{{ myArticle.createdDate }}</div>
              <v-list-item-title class="headline mb-1">{{ myArticle.title }}</v-list-item-title>
              <v-list-item-subtitle>{{ myArticle.body }}</v-list-item-subtitle>
            </v-list-item-content>
            </v-list-item>
            
          </v-card>
        </v-row>
      </v-container>
    </div>
</template>

<script>
export default {
    name:'ArticlesList',
    props:['myArticle']
}
</script>

<style scoped>

</style>