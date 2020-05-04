<template>
  <div>
    <v-app-bar
            app
            color="primary"
            dark
    >

      <v-toolbar-title>Simple Blog</v-toolbar-title>

    </v-app-bar>

    <v-layout align-center justify-center class="ma-5">
      <v-flex xs8 sm8 md4 >
        <v-card>
          <v-toolbar dark color="primary">
            <v-toolbar-title> Forbidden </v-toolbar-title>
          </v-toolbar>
          <v-container>
            <p class="pt-5 pb-5">Forbidden you don't have permission to access this page.</p>
            <v-btn color="primary" to="/">
              Go back Home
            </v-btn>
          </v-container>
        </v-card>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
    export default {
        name: "403Page"
    }
</script>

<style scoped>

</style>