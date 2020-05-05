<template>
  <v-card align="center">
    <v-card-title>
      <span>My Information</span>
    </v-card-title>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="12" sm="6" md="6">
            <v-text-field label="Full Name" :disabled="disableEdit" v-model="newUsername" required></v-text-field>
          </v-col>
          <v-col cols="12" sm="6" md="6">
            <v-text-field label="E-mail" :disabled="disableEdit" v-model="newEmail" required></v-text-field>
          </v-col>
          <v-col cols="12" sm="6" md="6">
            <v-text-field label="New Password" :disabled="disableEdit" v-model="newPass" required></v-text-field>
          </v-col>
          <v-col cols="12" sm="6" md="6" v-if="edit">
            <v-btn color="primary" @click="activateEditAbility">
              <v-icon>
                mdi-pencil
              </v-icon>
              Edit
            </v-btn>
          </v-col>
          <v-col cols="12" sm="6" md="6" v-if="save">
            <v-btn color="success" @click="UpdateMyInfo(member.userId)">
              <v-icon>
                mdi-floppy
              </v-icon>
              save
            </v-btn>
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
        newUsername: null,
        newEmail: null,
        newPass: null,
        edit: true,
        save: false,
        disableEdit:true
      }
    },
    methods:{
      activateEditAbility(){
        this.edit = false;
        this.save = true;
        this.disableEdit = false;
      },
      UpdateMyInfo(id){

        axios.post(`${apiUrl}/api/user/update/${id}`, {
          newName: this.newUsername,
          newEmail: this.newEmail,
          newPass: this.newPass
        })
          .catch( error => console.log(error) );

        //Disable The Edit Ability
        this.edit = true;
        this.save = false;
        this.disableEdit = true;
      },
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