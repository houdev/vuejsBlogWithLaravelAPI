<template>
  <v-container>
    <v-row>
      <v-col cols="4">
        <v-card color="#039BE5" dark elevation="5">
          <v-card-title>
            Total Articles
          </v-card-title>
          <v-card-subtitle class="display-2 mt-5">
            {{ articles.length }}
          </v-card-subtitle>
        </v-card>
      </v-col>
      <v-col cols="4">
        <v-card color="#0097A7" dark elevation="5">
          <v-card-title>
            My Articles
          </v-card-title>
          <v-card-subtitle class="display-2 mt-5">
            {{ myArticles.length }}
          </v-card-subtitle>
        </v-card>
      </v-col>
      <v-col cols="4">
        <v-card color="#00796B" dark elevation="5">
          <v-card-title>
            Total Members
          </v-card-title>
          <v-card-subtitle class="display-2 mt-5">
            {{ members.length }}
          </v-card-subtitle>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    name: "BlogStatistics",
    props:{
      articles: Array,
      members: Array,
      myArticles: Array,
    },
  }
</script>

<style scoped>

</style>