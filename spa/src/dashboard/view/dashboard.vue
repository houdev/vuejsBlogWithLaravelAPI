<template>
  <div>
    <blog-statistics
      :artilcesCount="artilcesCount"
      :usersCount="usersCount"
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
        artilcesCount: 0,
        myArticles: [],
        usersCount: 0,
      }
    },
    created() {
      axios.get(`${apiUrl}/api/blog/statistics`)
      .then( result => {
        this.artilcesCount = result.data.artilcesCount;
        this.usersCount = result.data.usersCount;
      })
      .catch( error => console.log(error) );

      axios.get(`${apiUrl}/api/myarticles`)
        .then( result => this.myArticles = result.data)
        .catch( error => console.log(error) );

    }
  }
</script>

<style scoped>

</style>