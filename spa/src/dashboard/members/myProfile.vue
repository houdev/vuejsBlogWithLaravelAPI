<template>
  <v-card align="center">
    <v-card-title>
      <span>My Information</span>
    </v-card-title>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="12" sm="6" md="6">
            <v-text-field label="Full Name" v-model="member.name" required></v-text-field>
          </v-col>
          <v-col cols="12" sm="6" md="6">
            <v-text-field label="E-mail" v-model="member.email" required></v-text-field>
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
  </v-card>
</template>

<script>
  import axios from "axios";
  import {apiUrl} from "@/variables";

  export default {
    name: "myProfile",
    data(){
      return{
        member:[],
      }
    },
    created() {
      axios.post(apiUrl+'/api/me')
        .then(result => this.member = result.data.data)
        .catch(error => console.log(error))
    }
  }
</script>

<style scoped>

</style>