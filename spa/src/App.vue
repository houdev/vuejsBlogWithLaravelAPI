<template>
<v-app>
    <v-content>
    <div id="app">
      <router-view/>
    </div>
    </v-content>
</v-app>
</template>

<script>
export default {
  name: "App",
  data: () => ({
    drawer: null,
  }),

};
</script>


<style lang="scss">

</style>
