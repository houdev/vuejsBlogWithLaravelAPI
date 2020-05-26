<template>
  <v-container>
    <v-toolbar>
      <v-toolbar-title>Members <span class="blue--text">{{ members.length }}</span></v-toolbar-title>
      <div class="flex-grow-1"></div>
      <v-icon>mdi-magnify</v-icon>
      <v-text-field
        label="Search"
        v-model="searchForMember"
        @change="searchForMemberFn"
        hide-details
        single-line
      >
      </v-text-field>
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
              <img :src="member.picture" alt="John" />
            </v-avatar>
          </v-row>

          <v-card-text align="center">{{ member.name }}</v-card-text>
          <v-card-actions>
            <v-row>
              <v-col align="center">
                <edit-member
                  :username="member.name"
                  :email="member.email"
                  :memberId="member.id"
                  :memberPic="member.picture"
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
      <v-pagination
        class="mt-5 mb-5"
        v-model="pagination.current"
        :length="pagination.total"
        @input="getMembers"
      ></v-pagination>
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
                searchForMember: null,
                pagination:{
                  current:1,
                  total:0
                },
            }
        },
        methods:{
            getMembers(){
              axios.post(apiUrl+'/api/users?page=' + this.pagination.current)
                .then(result => {
                  this.members = result.data.data
                  this.pagination.current = result.data.current_page;
                  this.pagination.total = result.data.last_page;
                })
                .catch(error => console.log(error))
            },
            AddMember(newMemberInfo){
                let { name, email, pass, role } = newMemberInfo;

                axios.post(`${apiUrl}/api/user/store`, {
                    name,
                    email,
                    password: pass,
                    role
                })
                    .catch( error => console.log(error) );

                //Refresh members list
                this.getMembers();
            },
            deleteMember(id){
                axios.post(`${apiUrl}/api/user/delete/${id}`)
                    .catch( error => console.log(error) );

                //Refresh members list
                this.getMembers();

                //close the dialog after the delete
                this.memberDialog = false;
            },
            UpdateMember(id, newMemberInfo){
                let { newName, newEmail, newPass, pictureData } = newMemberInfo;

                axios.post(`${apiUrl}/api/user/update/${id}`, {
                    name: newName,
                    email: newEmail,
                    pass: newPass
                })
                    .catch(error => console.log(error));

                //upload and update the picture
                axios.post(`${apiUrl}/api/picture/add`, pictureData)
                    .catch(error => console.log(error));

                //Refresh members list
                this.getMembers();
            },
          searchForMemberFn(){
            let searchMember = this.searchForMember;

            axios.post(`${apiUrl}/api/user/search`, {
              username:searchMember
            })
              .then( result => {
                this.members = result.data.data;
                this.pagination.current = result.data.current_page;
                this.pagination.total = result.data.last_page;
              })
              .catch( error => console.log(error) );
          },
        },
        created() {
            this.getMembers();
        }
    }
</script>

<style scoped>

</style>