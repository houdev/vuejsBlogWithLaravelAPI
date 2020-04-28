<template>
<div>
  <v-navigation-drawer v-model="drawer" app>

    <v-list-item>
      <v-list-item-content>
        <v-list-item-title class="title">
          {{ userName }}
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <v-divider></v-divider>

      <v-list dense>
        <v-list-item
            v-for="(dashbordItem, key) in dashbordItems"
            :key="key"
            :to="dashbordItem.to">
          <v-list-item-action>
            <v-icon>{{ dashbordItem.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{ dashbordItem.title }}</v-list-item-title>
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
    <v-container>
      <router-view />
    </v-container>
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
    dashbordItems:[
        { title: 'Dashboard', icon: 'mdi-view-dashboard', to:'/dashboard' },
        { title: 'Add Article', icon: 'mdi-image', to:'/dashboard/addArticle' },
        { title: 'My Articles', icon: 'mdi-help-box', to:'/dashboard/myArticles' },
        { title: 'Members', icon: 'mdi-help-box', to:'/dashboard/members' },
    ],
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

</style>
