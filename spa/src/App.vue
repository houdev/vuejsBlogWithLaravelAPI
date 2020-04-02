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
      <add-article
      @newArticle="addArticle"
       />
      <articles :myArticls="myArticls" />
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
  data (){
    return {
      myArticls:[
        {
          id:1,
          title: 'What is Vuejs',
          body:'vuejs is great framework',
          createdDate: '10-1-2020'
        },
        {
          id:2,
          title: 'about Vuejs',
          body:'vuejs is powerful',
          createdDate: '15-3-2020'
        },
        {
          id:3,
          title: 'Build An App with vuejs',
          body:'creating apps with vusjs is easy',
          createdDate: '30-3-2020'
        }
      ]
    }
  },
  methods:{
    addArticle(newArticle){
      this.myArticls.push(newArticle);
    },
  }
};
</script>
