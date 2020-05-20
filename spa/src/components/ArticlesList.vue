<template>
    <v-col lg="4" md="6" sm="12" align="center">
      <v-card width="85%">

        <v-img
          class="white--text align-end"
          height="200px"
          :src="myArticle.image"
        >
          <v-card-title>{{ myArticle.title }}</v-card-title>
        </v-img>

        <v-list-item three-line :to="'/ViewArticle/'+myArticle.id">
          <v-list-item-content>
            <div class="overline mb-4">{{ myArticle.created_at }}</div>
            <v-list-item-title  class="headline mb-1">{{ myArticle.title }}</v-list-item-title>
            <v-list-item-subtitle>{{ extractArticleBody }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

        <v-spacer></v-spacer>

        <v-card-actions>
          <v-btn
            :to="'/ViewArticle/'+myArticle.id"
            color="#00796B"
            dark
            small
          >
            Read More
          </v-btn>

        </v-card-actions>

      </v-card>
    </v-col>
</template>

<script>
export default {
    name:'ArticlesList',
    props:['myArticle','currentIndex'],
  computed:{
      extractArticleBody(){

        // Extract Article Body From HTML

        let myArticleBody = this.myArticle.body;
        var span = document.createElement('span');
        span.innerHTML = myArticleBody;

        return span.textContent;
      }
  }
}
</script>

<style scoped>

</style>