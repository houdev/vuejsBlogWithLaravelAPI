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
    import axios from "axios";
    import Articles from "../../components/Articles";
    import {apiUrl} from '@/variables.js'

    export default {
        name: "MyArticles",
        components: {
            Articles
        },
        data (){
            return {
                myArticles:[],
            }
        },
        methods:{
            deleteArticle(id){
                axios.post(`${apiUrl}/api/articles/delete/${id}`)
                    .then(result => this.myArticles = result.data,
                        this.successMessage = "Article Has Been Deleted Successfully",
                        this.snackbar = true )
                    .catch(error => console.log(error) );
            },
            updateMyArticle(id, updatedArticle){
                let { title, body} = updatedArticle

                axios.post(`${apiUrl}/api/articles/update/${id}`, {
                    title,
                    body
                })
                    .then(result => this.myArticles = result.data,
                        this.successMessage = "Article Has Been Updated Successfully",
                        this.snackbar = true )
                    .catch(error => console.log(error) );
            }
        },
        created(){
            axios.get(apiUrl+'/api/myarticles')
                .then(result => this.myArticles = result.data)
                .catch(error => console.log(error))
        },
    }
</script>

<style scoped>

</style>