<template>
    <v-container>
        <div>
            <v-form  @submit.prevent="creat">

                <span class="red--text" v-if="errors.title">{{errors.title[0]}}</span>
                <v-text-field
                        v-model="form.title"
                        label="Name"
                        type="text"
                        required
                ></v-text-field>
                <span class="red--text" v-if="errors.category_id">{{errors.category_id[0]}}</span>
                <v-select
                        :items="categories"
                        item-value="id"
                        item-text="name"
                        v-model="form.category_id"
                        label="Category"
                        autocomplete
                ></v-select>
                <span class="red--text" v-if="errors.body">{{errors.body[0]}}</span>

                <markdown-editor v-model="form.body" ref="markdownEditor"></markdown-editor>
                <v-btn
                        color="green"
                        type="submit"
                        :disabled="disabled"

                >
                    Créer
                </v-btn>

            </v-form>
        </div>
    </v-container>
</template>

<script>
    export default {
        name: "create",
        data(){
            return {
                form : {
                    title:null,
                    category_id:null,
                    body:null
                },
                categories:null,
                errors:{}
            }
        },
    created(){
            axios.get('/api/category')
                .then(res=>this.categories = res.data.data)
                .catch(error=>console.log(error.response.data))

        console.log(this.categories)
    },
        methods:{
            creat()
            {
                axios.post('/api/question',this.form)
                   // .then(res => console.log(res.data))
                    .then(res => this.$router.push(res.data.path))
                    .catch(error => this.errors= error.response.data.errors)
            }
        },
        computed:{
            disabled()
            {
               // return !(this.form.title && this.form.category && this.form.body)
            }

        }
    }
</script>

<style>
    @import '~simplemde/dist/simplemde.min.css';
</style>