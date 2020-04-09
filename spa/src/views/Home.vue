<template>
  <div>


      <articles 
      :myArticles="myArticles" 
      v-on:deleteArticle="deleteArticle"
      v-on:updateArticle="updateMyArticle"
      />
      
  </div>
</template>

<script>
import Articles from '../components/Articles.vue'
import axios from 'axios'

export default {
  name: 'Home',

  components: {
    Articles
  },
  data (){
    return {
      myArticles:[]
    }
  },
  methods:{
    deleteArticle(id){
      axios.post(`http://127.0.0.1:8000/api/articles/delete/${id}`)
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
