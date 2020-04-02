<template>
    <div>
			<articles-list 
			v-for="(myArticle, index) in myArticls" 
			:key="index" 
			:myArticle="myArticle"
				/>
    </div>
</template>

<script>

import ArticlesList from './ArticlesList.vue'

export default {
    name:'Articles',
    props:{
        'myArticls':Array,
    },
    components: {
    ArticlesList
  },
}
</script>

<style scoped>

</style>