<template>
 <v-container>
     <div>
         <v-form  @submit.prevent="login">
             <v-text-field
                     v-model="form.email"
                     label="Email"
                     type="email"
                     required
             ></v-text-field>
             <v-text-field
                     v-model="form.password"
                     type="password"
                     label="E-mail"
                     required
             ></v-text-field>

             <v-btn
                     color="green"
                     type="submit"
             >
                 Login

             </v-btn>
             <router-link to="/signup" class="blue"><v-btn flat>Signup</v-btn></router-link>
         </v-form>
     </div>
 </v-container>
</template>

<script>
    export default {
       data()
       {
           return {
               form:{
                   email:null,
                   password:null
               }
           }
       },
        created()
        {
            if(User.loggedIn())
            {
                this.$router.push({name:'forum'})
            }
            }
    ,
        methods:{
           login(){
               User.login(this.form);
             //  this.$router.push({name:'forum'})
           }
        }
    }
</script>

<style scoped>

</style>