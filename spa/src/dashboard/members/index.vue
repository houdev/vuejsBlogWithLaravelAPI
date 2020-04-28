<template>
  <v-container>
    <v-toolbar>
      <v-toolbar-title>Members <span class="blue--text">{{ members.length }}</span></v-toolbar-title>
      <div class="flex-grow-1"></div>
      <v-icon>mdi-magnify</v-icon>
      <v-text-field label="Search" hide-details single-line></v-text-field>
    </v-toolbar>
    <v-row>
      <v-col v-for="(member, key) in members" :key="key" cols="12" md="3">
        <v-card class="pt-5">
          <v-row justify="center">
            <v-avatar class="avatar" width="70px" height="70px">
              <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" />
            </v-avatar>
          </v-row>

          <v-card-text align="center">{{ member.name }}</v-card-text>
          <v-card-actions>
            <v-row>
              <v-col align="center">
                <v-btn text icon color="blue" dark to="/member/details">
                  <v-icon size="20px">mdi-magnify</v-icon>
                </v-btn>
              </v-col>
              <v-col align="center">
                <v-dialog v-model="memberDialog" max-width="300">
                  <template v-slot:activator="{ on }">
                    <v-btn text icon color="red" v-on="on">
                      <v-icon size="20px">mdi-delete</v-icon>
                    </v-btn>
                  </template>
                  <v-card>
                    <v-card-title class="headline">Delete Member</v-card-title>
                    <v-card-text>Are you sure you want to delete this member?</v-card-text>
                    <v-card-actions>
                      <div class="flex-grow-1"></div>
                      <v-btn color="green darken-1" text @click="memberDialog = false">Yes</v-btn>
                      <v-btn color="green darken-1" text @click="memberDialog = false">Cancel</v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-col>
            </v-row>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
    import axios from "axios";
    import {apiUrl} from "@/variables";

    export default {
        name: "index",
        data(){
            return{
                members:[],
                memberDialog:false,
            }
        },
        created() {
            axios.post(apiUrl+'/api/users')
                .then(result => this.members = result.data)
                .catch(error => console.log(error))
        }
    }
</script>

<style scoped>

</style>