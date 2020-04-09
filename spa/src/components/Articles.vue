<template>
    <div>
			<articles-list 
			v-for="(myArticle, index) in myArticles" 
			:key="index" 
			:myArticle="myArticle"
      :currentIndex="index"
			@deleteArticle="$emit('deleteArticle' , myArticle.id)"
      @updateArticle="(id, updatedArticle) => $emit('updateArticle', id, updatedArticle)"
				/>
    </div>
</template>

<script>

import ArticlesList from './ArticlesList.vue'

export default {
    name:'Articles',
    props:{
        'myArticles':Array,
    },
    components: {
    ArticlesList
  },
}
</script>

<style scoped>

</style>