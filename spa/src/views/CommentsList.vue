<template>

    <v-row>
      <v-col cols="12" v-for="comment in comments" :key="comment.id">
        <v-card>
          <v-list-item>
            <v-list-item-content>
              <div class="overline mb-4">{{ comment.created_at }}</div>
              <v-list-item-title class="mb-1">
                By {{ comment.username }}
              </v-list-item-title>

              <v-divider class="mx-4"></v-divider>

              <p class="mt-5">{{ comment.comment }}</p>
            </v-list-item-content>
          </v-list-item>
        </v-card>
      </v-col>
    </v-row>

</template>

<script>
  export default {
    name: "CommentsList",
    props: ['comments'],
  }
</script>

<style scoped>

</style>