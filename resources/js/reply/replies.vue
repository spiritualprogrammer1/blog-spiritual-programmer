<template>
   <v-container>
       <reply v-for="(reply,index) in content"
              :key="reply.id"
              :data="reply"
              :index=index
              >

       </reply>
   </v-container>
</template>

<script>
    import reply from './reply'
    export default {
        name: "replies",
        props:['question'],
        components:{reply},
        data(){

            return {
                content:this.question.replies
            }

        },
        created()
        {
            this.listen()
        },
        methods:{
            listen(){
                EventBus.$on('newreplies',(reply) =>{
                   this.content.unshift(reply)
                })
                EventBus.$on('deletereply',(index)=>{
                    axios.delete(`/api/question/${this.question.slug}/reply/${this.content[index].id}`)
                        .then(res=>{
                            this.content.splice(index,1)
                        })

                })
                /**
                 * envoie des notifications en broadcasting
                 */

                Echo.private('App.User.' + User.id())
                    .notification((notification) => {
                        this.content.push(notification.reply)
                    });

                Echo.channel('deleteReplyChannel')
                    .listen('DeleteReplyEvent',(e)=>{
                        for(let index = 0 ; index<this.content.lenght;index++)
                        {
                            if(this.content[index].id == e.id)
                            {
                                this.content.splice(index,1)
                            }
                        }
                    })
            }
        }
    }
</script>

<style scoped>

</style>