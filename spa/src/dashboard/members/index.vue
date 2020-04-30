<template>
  <v-container>
    <v-toolbar>
      <v-toolbar-title>Members <span class="blue--text">{{ members.length }}</span></v-toolbar-title>
      <div class="flex-grow-1"></div>
      <v-icon>mdi-magnify</v-icon>
      <v-text-field label="Search" hide-details single-line></v-text-field>
      <v-spacer></v-spacer>
      <add-member
        @AddMember="AddMember"
      />
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
                <v-btn text icon color="blue" dark>
                  <v-icon size="20px">mdi-magnify</v-icon>
                </v-btn>
              </v-col>
              <v-col align="center">
                <edit-member
                  :username="member.name"
                  :email="member.email"
                  :memberId="member.id"
                  @UpdateMember="UpdateMember"
                />
              </v-col>
              <v-col align="center">
                <v-dialog v-model="memberDialog[member.id]" max-width="300">
                  <template v-slot:activator="{ on }">
                    <v-btn text icon color="red" v-on="on" @click="$set(memberDialog, member.id, true)">
                      <v-icon size="20px">mdi-delete</v-icon>
                    </v-btn>
                  </template>
                  <v-card>
                    <v-card-title class="headline">Delete Member</v-card-title>
                    <v-card-text>Are you sure you want to delete this member?</v-card-text>
                    <v-card-actions>
                      <div class="flex-grow-1"></div>
                      <v-btn color="green darken-1" text @click="deleteMember(member.id)">Yes</v-btn>
                      <v-btn color="green darken-1" text @click="$set(memberDialog, member.id, false)">Cancel</v-btn>
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
    import EditMember from "./Edit";
    import AddMember from "./Add";

    export default {
        name: "index",
        components:{
            EditMember,
            AddMember
        },
        data(){
            return{
                members:[],
                memberDialog:{},
            }
        },
        methods:{
            AddMember(newMemberInfo){
                let { name, email, pass, role } = newMemberInfo;

                axios.post(`${apiUrl}/api/user/store`, {
                    name,
                    email,
                    pass,
                    role
                })
                    .then( result => this.members = result.data.data )
                    .catch( error => console.log(error) );
            },
            deleteMember(id){
                axios.post(`${apiUrl}/api/user/delete/${id}`)
                    .then( result => this.members = result.data )
                    .catch( error => console.log(error) );

                //close the dialog after the delete
                this.memberDialog = false;
            },
            UpdateMember(id, newMemberInfo){
                let { newName, newEmail, newPass } = newMemberInfo;

                axios.post(`${apiUrl}/api/user/update/${id}`, {
                    newName,
                    newEmail,
                    newPass
                })
                    .then( result => this.members = result.data )
                    .catch( error => console.log(error) );
            },
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