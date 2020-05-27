<template>
  <v-card align="center">
    <v-card-title>
      <span>My Information</span>
    </v-card-title>
    <v-card-text>

        <v-form ref="editMyProfileForm">
          <v-container>
            <v-row>
              <v-row justify="center">

                <v-avatar
                  class="avatar"
                  width="100px"
                  height="100px"
                  cursor="pointer"
                  @click="$refs.EditAvatar.click()"
                >
                  <img :src="avatar" alt="John" />
                </v-avatar>
                  <input
                    v-show="false"
                    :disabled="disableEdit"
                    ref="EditAvatar"
                    @change="getPictureData($event)"
                    type="file"
                    accept="image/*"

                  />
              </v-row>
              <v-col cols="12">
                <v-alert type="error" v-if="passwordIsRequired.error">
                  {{ passwordIsRequired.message }}
                </v-alert>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-text-field
                  label="Full Name"
                  :disabled="disableEdit"
                  v-model="newUsername"
                  required
                  :rules="editInfoFormRules"
                >
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-text-field
                  label="E-mail"
                  :disabled="disableEdit"
                  v-model="newEmail"
                  required
                  :rules="editInfoFormRules"
                >
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-text-field
                  label="New Password"
                  :disabled="disableEdit"
                  v-model="newPass"
                  required
                  :rules="editInfoFormRules"
                >
                </v-text-field>
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
                <v-btn color="success" @click="UpdateMyInfo(memberId)">
                  <v-icon>
                    mdi-floppy
                  </v-icon>
                  save
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-form>

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
        editInfoFormRules:[
          value => value && value.length >= 4 || 'Minimum length is 4 characters'
        ],
        passwordIsRequired: {
          error: false,
          message: null,
        },
        memberId: null,
        newUsername: null,
        newEmail: null,
        newPass: null,
        avatar: null,
        newAvatar: null,
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

        if(!this.$refs.editMyProfileForm.validate()){
          this.passwordIsRequired.error = true;
          return this.passwordIsRequired.message = "The password is required";
        }

        let newUserInfo = new FormData();
        newUserInfo.append('name', this.newUsername);
        newUserInfo.append('email', this.newEmail);
        newUserInfo.append('pass', this.newPass);
        newUserInfo.append('picture', this.newAvatar);

        axios.post(`${apiUrl}/api/user/update/${id}`, newUserInfo)
          .catch( error => console.log(error) );

        //Disable The Edit Ability
        this.edit = true;
        this.save = false;
        this.disableEdit = true;

        //Refresh the information
        this.getCurrentUserInfo();
      },
      getPictureData(event){
        this.newAvatar = event.target.files[0];
      },
      getCurrentUserInfo(){
        axios.post(apiUrl+'/api/me')
          .then(result => {
            this.newUsername = result.data.data.name;
            this.newEmail = result.data.data.email;
            this.memberId = result.data.data.userId;
            this.avatar = result.data.data.picture;
          })
          .catch(error => console.log(error));
      },
    },
    mounted() {
      this.getCurrentUserInfo();
    }
  }
</script>

<style scoped>

</style>
