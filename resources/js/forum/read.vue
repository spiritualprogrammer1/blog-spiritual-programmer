<template>

    <div v-if="question">

        <edit-question v-if="editing"
        :data=question></edit-question>

            <showquestion
                    v-else
                    :data=question>
            </showquestion>

        <v-container>
            <replies :question="question"></replies>

            <new-reply v-if="loggedIn"  :questionslug="question.slug" ></new-reply>

            <div class="mt-4" v-else>
                <router-link    class="mt-4" to="/login">Connecter vous pour repondre?</router-link>
            </div>


        </v-container>




    </div>
    
</template>

<script>
    import showquestion from './showquestion'
    import EditQuestion from './editQuestion'
    import replies from '../reply/replies'
    import newReply from '../reply/newreplies'
    export default {
        name: "read",
        components:{showquestion,EditQuestion,replies,newReply},
        data()
        {
            return {
                question:null,
                editing:false
            }
        },
        created()
        {
            this.listen(),
                this.getQuestion()

        },
        computed:{
            loggedIn()
            {
                return  User.loggedIn()
            }
        },
        methods:{
            listen()
            {
                EventBus.$on('startEditing',()=>{
                   this.editing = true
                });
                     /*reçoit l evenment*********/
                EventBus.$on('cancelEditing',()=>{
                    this.editing = false
                    }
                )
            },
            getQuestion()
            {
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then(res=>this.question = res.data.data)
            }
        }
    }
</script>

<style scoped>

</style>