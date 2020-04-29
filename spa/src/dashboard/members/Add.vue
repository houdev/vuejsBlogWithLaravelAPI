<template>
  <v-dialog v-model="dialog" max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="success" v-on="on" dark>
        <v-icon size="20px">mdi-plus</v-icon>
        Add New Member
      </v-btn>
    </template>
    <v-card align="center">
      <v-card-title>
        <span>Add New Member</span>
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
              <v-text-field label="Full Name" v-model="name" required></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="6">
              <v-text-field label="E-mail" v-model="email" required></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="6">
              <v-text-field label="Password" type="password" v-model="pass" required></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="6">
              <v-select
                :items="roles"
                label="Role"
                v-model="role"
                required
              ></v-select>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <div class="flex-grow-1"></div>
        <v-btn color="red" dark  @click="dialog = false">Close</v-btn>
        <v-btn color="success"  @click="AddMember">Add Member</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
    export default {
        name: "AddMember",
        data() {
            return {
                dialog: false,
                name: null,
                email: null,
                pass: null,
                roles: ['Author','Admin'],
                role:null,
            };
        },
        methods:{
            AddMember(){
                let newMemberInfo = {
                    name: this.name,
                    email: this.email,
                    pass: this.pass,
                    role: this.role
                }
                this.$emit('AddMember', newMemberInfo);

                //close dialog
                this.dialog = false;
            },
        },
    }
</script>

<style scoped>

</style>