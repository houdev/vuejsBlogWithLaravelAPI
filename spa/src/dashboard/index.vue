<template>
<div>
  <v-navigation-drawer v-model="drawer" app clipped>
      <v-list dense>
        <v-list-item to="/dashboard">
          <v-list-item-action>
            <v-icon>mdi-folder-pound-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item to="/dashboard/addArticle">
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

    {{ userName }}

    <v-btn icon @click="logoutDialog = true">
      <v-icon>mdi-account-circle</v-icon>
    </v-btn>

  </v-app-bar>

  <v-content>
    <div id="app">
      <router-view/>
    </div>
  </v-content>

  <v-dialog
    v-model="logoutDialog"
    max-width="290"
  >
    <v-card>
      <v-card-title class="headline">Log-out ?</v-card-title>

      <v-card-text>
        Are You Sure, Do You Want To Log-out ?
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn
          color="green darken-1"
          text
          @click="logoutDialog = false"
        >
          Cancel
        </v-btn>

        <v-btn
          color="green darken-1"
          text
          @click="logout"
        >
          I'm Sure
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>

</div>
</template>

<script>

export default {
  name: "App",
  components:{

  },
  data(){
    return {
    drawer: null,
    logoutDialog: false,
    userName: null,
    }
  },
  methods:{
    logout(){
      let app = this;
      this.$auth
          .logout({
            makeRequest: true,
            redirect: {name: 'Home'},
          });
      app.logoutDialog= false;
    },
  },
  mounted() {
    let app = this
      this.$auth.fetch()
          .then((res) => {
            app.userName = res.data.data.name
          })
  }

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
