<template>
  <div>
    <blog-statistics
      :articles="articles"
      :members="members"
      :myArticles="myArticles"
    />
  </div>
</template>

<script>
  import BlogStatistics from "./BlogStatistics";
  import {apiUrl} from "../../variables";
  import axios from "axios";

  export default {
    name: "dashboard",
    components:{
      BlogStatistics
    },
    data(){
      return{
        articles:[],
        myArticles:[],
        members:[],
      }
    },
    created() {
      axios.get(`${apiUrl}/api/articles`)
      .then( result => this.articles = result.data)
      .catch( error => console.log(error) );

      axios.get(`${apiUrl}/api/myarticles`)
        .then( result => this.myArticles = result.data)
        .catch( error => console.log(error) );

      axios.post(`${apiUrl}/api/users`)
      .then( result => this.members = result.data)
      .catch( error => console.log(error) );

    }
  }
</script>

<style scoped>

</style>