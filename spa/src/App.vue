<template>
  <v-app>
    <v-app-bar
      app
      color="primary"
      dark
    >
    <v-toolbar-title>Simple Blog</v-toolbar-title>
    
      <v-spacer></v-spacer>
      
    </v-app-bar>

    <v-content>
      <add-article />
      <articles />
    </v-content>
  </v-app>
</template>

<script>
import AddArticle from './components/AddArticle.vue'
import Articles from './components/Articles.vue'

export default {
  name: 'App',

  components: {
    AddArticle,
    Articles
  },

  data: () => ({
    //
  }),
};
</script>
