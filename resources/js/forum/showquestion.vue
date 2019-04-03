<template>


       <v-card>
           <v-container fluid>
           <v-card-title>
               <div>
                   <div class="headline">
                       {{data.title}}
                   </div>
               </div>
               <span class="grey--text">{{data.user}} said {{data.created_at}} </span>
               <v-spacer></v-spacer>
               <v-btn color="teal" dark>{{replycount}} reponses</v-btn>
           </v-card-title>

               <v-card-text v-html="body"></v-card-text>

               <v-card-actions v-if="own" >
                   <v-btn icon small @click="edit">
                       <v-icon color="orange">edite</v-icon>
                   </v-btn>
                   <v-btn icon small @click="destroy">
                       <v-icon color="red">delete</v-icon>
                   </v-btn>
               </v-card-actions>

           </v-container>
       </v-card>

    
</template>

<script>

    export default {
        name: "showquestion",
        props:['data'],
        data(){
            return {
                /******permet de verifier si l'utilisateur connecter a crée la category*****/
                own : User.own(this.data.user_id),
                replycount:this.data.reply_count
            }
        },
        computed:{
            body()
            {
                return md.parse(this.data.body)
            }
        },

        created()
        {
            EventBus.$on('newreplies',()=>{
                this.replycount++
            });
            /*****ajouter de maniere automatique le nombre de reponse***/
            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.replycount++
                });

            EventBus.$on('deletereply',()=>{
                this.replycount--
            })

   /************supprimùer de maniere automanique lorsque qu'un utilisateur supprime*******/
            Echo.channel('deleteReplyChannel')
                .listen('DeleteReplyEvent',(e)=>{
                   this.replycount--
                })
        }

        ,
        methods:{
            destroy()
            {
                axios.delete(`/api/question/${this.data.slug}`)
                    .then(res=>this.$router.push('/forum'))
                    .catch(error=>console.log(error.response.data))
            },
            edit()
            {
                EventBus.$emit('startEditing')
            }
        }
    }
</script>

<style scoped>

</style>