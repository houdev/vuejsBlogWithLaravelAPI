<template>
  <div>
      <add-article
      @newArticle="addArticle"
       />

      <articles :myArticles="myArticles" v-on:deleteArticle="deleteArticle"/>
      
  </div>
</template>

<script>
import AddArticle from '../components/AddArticle.vue'
import Articles from '../components/Articles.vue'

export default {
  name: 'Home',

  components: {
    AddArticle,
    Articles
  },
  data (){
    return {
      myArticles:[
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
      this.myArticles.push(newArticle);
    },
    deleteArticle(id){
      this.myArticles = this.myArticles.filter(articls => articls.id !== id );
    },
  }
};
</script>