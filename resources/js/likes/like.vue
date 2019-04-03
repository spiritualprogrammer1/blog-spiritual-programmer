<template>

        <v-btn icon @click="likeIt">
            <v-icon :color="color">
                favorite
            </v-icon>{{counts}}
        </v-btn>

</template>

<script>
    export default {
        name: "like",
        props:['content'],
        data()
        {
           return {
               liked:this.content.liked,
               counts:this.content.liked_count
           }
        },
        computed:{
            color()
            {
                return this.liked ? 'red':'red lighten-4'
            }
        },
        created()
        {
            Echo.channel('likeChannel')
                .listen('LikeEvent', (e) => {
                    console.log(e)
                  // if(this.content.id == e.id )
                  // {
                  //       e.type ==1 ? this.count ++ : this.count --
                  // }
                });
        }
        ,
        methods:{

            likeIt()
            {
                 if(User.loggedIn())
                 {
                    this.liked ?  this.decre() :  this.incre()
                    this.liked = !this.liked //like recoit le contraire de son statut actuelle

               }
            },

            incre()
            {
                axios.post(`/api/like/${this.content.id}`)
                    .then(res=>this.counts++)
          //return this.counts ++
            },

            decre()
            {
                axios.delete(`/api/like/${this.content.id}`)
                    .then(res=>this.counts--)
            }

        }
    }
</script>

<style scoped>

</style>