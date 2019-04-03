<template>
    <v-toolbar color="indigo" dark>
        <!--<v-toolbar-side-icon></v-toolbar-side-icon>-->
        <v-toolbar-title >
            <router-link class="white--text" to="/">Programmer spiritual</router-link>

        </v-toolbar-title>
        <v-spacer></v-spacer>



        <app-notification v-if="loggedIn" ></app-notification>

        <div class="hidden-sm-and-down">
            <router-link
                    v-for="item in items"
                    :key="item.title"
                    :to="item.to"
                    v-if="item.show">
                <v-btn flat>{{item.title}}</v-btn>

            </router-link>


        </div>
    </v-toolbar>
</template>

<script>
import AppNotification from './AppNotification'
    export default {
    components:{AppNotification},
        data()
        {
            return {
                loggedIn : User.loggedIn(),
                items:[
                    {title: 'Forum', to:'/forum',show:true},
                    {title: 'Login', to:'/login',show: !User.loggedIn()},
                     {title: 'Logout', to:'/logout',show: User.loggedIn()},
                    {title : 'poser des questions', to:'/ask',show: User.loggedIn()},
                     {title : 'Category', to:'/category',show: User.admin()}
                ]
            }
        },
        created()
        {
            EventBus.$on('logout',()=>{
                User.logout()
            })
        }
    }

</script>

<style scoped>

</style>