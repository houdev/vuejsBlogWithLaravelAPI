<template>
  <div>
      <add-article
      @newArticle="addArticle"
       />

      <articles 
      :myArticles="myArticles" 
      v-on:deleteArticle="deleteArticle"
      v-on:updateArticle="updateMyArticle"
      />
      
  </div>
</template>

<script>
import AddArticle from '../components/AddArticle.vue'
import Articles from '../components/Articles.vue'
import axios from 'axios'

export default {
  name: 'Home',

  components: {
    AddArticle,
    Articles
  },
  data (){
    return {
      myArticles:[]
    }
  },
  methods:{
    addArticle(newArticle){
      let { title, body } = newArticle;
      
      axios.post('http://127.0.0.1:8000/api/articles', {
          title,
          body
      })
        .then(result => this.myArticles = [...this.myArticles, result.data])
        .catch(error => console.log(error) );

    },
    deleteArticle(id){
      axios.post(`http://127.0.0.1:8000/api/articles/${id}`)
        .then(result => this.myArticles = result.data )
        .catch(error => console.log(error) );
    },
    updateMyArticle(id, updatedArticle){
      let { title, body} = updatedArticle

      axios.post(`http://127.0.0.1:8000/api/articles/update/${id}`, {
          title,
          body
      })
        .then(result => this.myArticles = result.data )
        .catch(error => console.log(error) );
      }
  },
  created(){
    axios.get('http://127.0.0.1:8000/api/articles')
      .then(result => this.myArticles = result.data)
      .catch(error => console.log(error))
  },
};
</script>
