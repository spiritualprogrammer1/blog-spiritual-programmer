<template>
    <div class="mt-4">
        <markdown-editor v-model="body" ref="markdownEditor"></markdown-editor>
        <v-btn dark color="green"  @click="submit" >
           Reply
        </v-btn>
    </div>
</template>

<script>
    export default {
        name: "newreplies",
        props:['questionslug'],
        data()
        {
            return {
                    body:null
                  }
        },
        methods:{
            submit()
            {
                axios.post(`/api/question/${this.questionslug}/reply`,{body:this.body})
                    .then(res=>{
                        this.body =  ''
                        EventBus.$emit('newreplies',res.data.reply)  //creation d'un evenement
                        window.scrollTo(0,0); // apres l'ajout faire un scroll
                    })
            }
        }
    }
</script>

<style scoped>

</style>