<template>
  <v-dialog v-model="dialog" max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn text icon color="success" v-on="on" dark>
        <v-icon size="20px">mdi-pencil</v-icon>
      </v-btn>
    </template>
    <v-card align="center">
      <v-card-title>
        <span>Edit User Information</span>
      </v-card-title>

      <template>
        <v-hover v-slot:default="{ hover }">
          <v-avatar
            class="avatar"
            cursor="pointer"
            width="100px"
            height="100px"
            @click="$refs.inputUpload.click()"
          >
            <v-img src="https://cdn.vuetifyjs.com/images/john.jpg">
              <v-expand-transition>
                <v-card
                  v-if="hover"
                  class="d-flex transition-fast-in-fast-out grey darken-1 v-card--reveal display-3"
                  style="height: 50%;"
                >
                  <v-icon>mdi-camera</v-icon>
                </v-card>
              </v-expand-transition>
            </v-img>
          </v-avatar>
        </v-hover>

        <input v-show="false" ref="inputUpload" type="file" />
      </template>

      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="6" md="6">
              <v-text-field label="Full Name" v-model="newUsername" required></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="6">
              <v-text-field label="E-mail" v-model="newEmail" required></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="6">
              <v-text-field label="Password" v-model="newPass" required></v-text-field>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <div class="flex-grow-1"></div>
        <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
        <v-btn color="blue darken-1" text @click="UpdateMember">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
    export default {
        name: "EditMember",
        props:['memberId','username','email'],
        data() {
            return {
                dialog: false,
                newUsername: this.username,
                newEmail: this.email,
                newPass: null,
            };
        },
        methods:{
            UpdateMember(){
                let id = this.memberId;
                let newMemberInfo = {
                    newName: this.newUsername,
                    newEmail: this.newEmail,
                    newPass: this.newPass
                }
                this.$emit('UpdateMember', id, newMemberInfo);

                //close dialog
                this.dialog = false;
            },
        },
    }
</script>

<style scoped>

</style>