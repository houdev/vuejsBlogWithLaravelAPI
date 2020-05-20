<template>
<div>
  <v-navigation-drawer v-model="drawer" app>

      <v-list dense>
        <v-list-item
            v-for="(dashbordItem, key) in authDashboardItems"
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

    <b class="mr-2">{{ userInfo.userName }}</b>

    <v-menu
      transition="slide-x-transition"
      bottom
      right
    >
      <template v-slot:activator="{ on }">
        <v-avatar v-on="on" class="avatar" width="40px" height="40px">
          <img :src="userInfo.userPicture" alt="Member-picture" />
        </v-avatar>
      </template>

      <v-list>
        <v-list-item to="/">
          <v-list-item-title>View Blog</v-list-item-title>
        </v-list-item>
        <v-list-item @click="logoutDialog = true">
          <v-list-item-title>Log-out</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>

  </v-app-bar>

  <v-content class="pa-0">
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
      userInfo:{
        userName: null,
        userPicture: null,
      },
    dashbordItems:[
        { title: 'Dashboard', icon: 'mdi-view-dashboard', to:'/dashboard/dashboard', display: this.$auth.check() },
        { title: 'My Profile', icon: 'mdi-account', to:'/dashboard/myProfile', display: this.$auth.check() },
        { title: 'Articles', icon: 'mdi-file-plus', to:'/dashboard/articles', display: this.$auth.check(1) },
        { title: 'My Articles', icon: 'mdi-file-document', to:'/dashboard/myArticles', display: this.$auth.check() },
        { title: 'Members', icon: 'mdi-account-multiple', to:'/dashboard/members', display: this.$auth.check(1) },
    ],
    }
  },
  methods:{
    getCurrentUserInfo(){

      //If the user not logged in then return null
        if(!this.$auth.check()) return null;

        this.$auth.fetch().then( res => {
          this.userInfo.userName = res.data.data.name;
          this.userInfo.userPicture = res.data.data.picture;
        });
    },
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
  computed:{
      authDashboardItems(){
          return this.dashbordItems.filter(function(items) {
              return items.display;
          });
      }
  },
  mounted() {

      //Get Current User Info
      this.getCurrentUserInfo();
  }

};
</script>


<style lang="scss">

</style>
