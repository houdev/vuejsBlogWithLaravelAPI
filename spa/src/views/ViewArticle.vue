<template>
  <div class="about">

    <v-container>
        <v-row justify="center" align="center">
          <v-card width="85%">

            <v-list-item >
              <v-list-item-content>
                <div class="overline mb-4">{{ myArticles[currentIndex].created_at }}</div>
                <v-list-item-title class="headline mb-1">
                  {{ myArticles[currentIndex].title }}
                </v-list-item-title>
                <v-spacer></v-spacer>
                <v-divider class="mx-4"></v-divider>
                <v-spacer></v-spacer>
                <v-list-item-text>{{ myArticles[currentIndex].body }}</v-list-item-text>
              </v-list-item-content>
            </v-list-item>

          </v-card>
        </v-row>
      </v-container>

  </div>
</template>

<script>
export default {
  name:'About',
  data (){
    return {
      myArticles:[
        {
          id:1,
          title: 'What is Vuejs',
          body:'vuejs is great framework',
          created_at: '10-1-2020'
        },
        {
          id:2,
          title: 'about Vuejs',
          body:'vuejs is powerful',
          created_at: '15-3-2020'
        },
        {
          id:3,
          title: 'Build An App with vuejs',
          body:'creating apps with vusjs is easy',
          created_at: '30-3-2020'
        }
      ],
      currentIndex: this.$route.params.index
    }
  },
}
</script>