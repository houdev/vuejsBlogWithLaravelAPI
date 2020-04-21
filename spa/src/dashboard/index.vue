<template>
<div>
  <v-navigation-drawer v-model="drawer" app clipped>
      <v-list dense>
        <v-list-item to="/">
          <v-list-item-action>
            <v-icon>mdi-folder-pound-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item to="/AddArticle">
          <v-list-item-action>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Add Article</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
  </v-navigation-drawer>

  <v-app-bar
      app
      color="primary"
      dark
  >
    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
    <v-toolbar-title>Simple Blog</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn icon>
      <v-icon>mdi-account-circle</v-icon>
    </v-btn>
  </v-app-bar>
  
  <add-article />
  
</div>
</template>

<script>
import AddArticle from '@/components/AddArticle.vue';
export default {
  name: "App",
  components:{
    AddArticle,
  },
  data(){
    return {
    drawer: null,
    }
  },

};
</script>


<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
