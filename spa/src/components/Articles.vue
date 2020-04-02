<template>
    <div>
			<articles-list 
			v-for="(myArticle, index) in myArticles" 
			:key="index" 
			:myArticle="myArticle"
			@deleteArticle="$emit('deleteArticle' , myArticle.id)"
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