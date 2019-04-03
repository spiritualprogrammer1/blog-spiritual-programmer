<template>
    <v-container>
        <v-alert v-if="errorss" :value="true" type="error">
            Entrer le libelle svp.
        </v-alert>
        <v-form  @submit.prevent="submites" >
            <v-text-field
                    v-model="form.name"
                    label="Category Name"
                    type="text"
                    required
            ></v-text-field>

            <v-btn color="pink" type="submit" v-if="editslug" :disable="disabled" >update</v-btn>
            <v-btn color="teal" type="submit" :disable="disabled" v-else>  Créer </v-btn>

        </v-form>

        <v-card>
            <v-toolbar color="indigo" dark dense>
                <v-toolbar-title>Categories</v-toolbar-title>
            </v-toolbar>

            <v-list>
                <div v-for="(category,index) in categories" :key="category.id">
                    <v-list-tile >

                        <v-list-tile-action>
                            <v-btn icon small @click="edit(index)" >
                                <v-icon color="orange">edit</v-icon>
                            </v-btn>

                        </v-list-tile-action>

                        <v-list-tile-content>
                            <v-list-tile-title >{{category.name}}</v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-btn icon small @click="destroy(category.slug)">
                                <v-icon color="red">delete</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                    </v-list-tile>
                    <v-divider></v-divider>
                </div>
            </v-list>


            </v-card>

    </v-container>
</template>

<script>
    export default {
        name: "CreateCategory",
        data()
        {
            return {
                form :{
                    name:null
                },
                categories:{},
                editslug:null,
                errorss:null
            }
        },
        created()
        {
            if(!User.admin())
            {
               this.$router.push('/forum')
            }
            axios.get('/api/category')
                .then(res=>this.categories = res.data.data)

        }
    ,
        methods:{
            submites()
            {
                this.editslug ? this.update() : this.create()

            },
            update()
            {
                axios.patch(`/api/category/${this.editslug}`,this.form)
                    .then(res=>{
                        /*********permet de faire la mise ajour du tableau*****/
                        this.categories.unshift(res.data)
                        this.form.name=null
                    })
            },
            create()
            {
                axios.post('/api/category',this.form)
                    .then(res=>{
                        /*********permet de faire la mise ajour du tableau*****/
                        this.categories.unshift(res.data)
                        this.form.name=null
                    })
                    .catch(error => this.errorss = error.response.data.errors)
            },
            destroy(slug,index)
            {
                axios.delete(`/api/category/${slug}`)
                    .then(res=>this.categories.splice(index,1))
            },
            edit(index)
            {
                /*****on recupere l index de l'iteration puis on indique dans le tableau******/
                this.form.name = this.categories[index].name
                this.editslug = this.categories[index].slug
                this.categories.splice(index,1) //remove la ligne
            }
        },
        computed:{
            disabled(){
                return !this.form.name
            }
        }
    }
</script>

<style scoped>

</style>