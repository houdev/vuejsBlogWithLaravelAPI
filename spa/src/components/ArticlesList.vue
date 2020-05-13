<template>
    <v-col cols="4" align="center">
      <v-card width="85%">

        <v-list-item three-line :to="'/ViewArticle/'+myArticle.id">
          <v-list-item-content>
            <div class="overline mb-4">{{ myArticle.created_at }}</div>
            <v-list-item-title  class="headline mb-1">{{ myArticle.title }}</v-list-item-title>
            <v-list-item-subtitle>{{ myArticle.body }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

      </v-card>
    </v-col>
</template>

<script>
export default {
    name:'ArticlesList',
    props:['myArticle','currentIndex'],
}
</script>

<style scoped>

</style>