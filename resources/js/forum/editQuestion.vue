<template>
    <v-container fluid>
        <v-form @submit.prevent="update">
            <v-text-field
                    v-model="form.title"
                    label="Name"
                    type="text"
                    required
            ></v-text-field>

            <markdown-editor v-model="form.body" ref="markdownEditor"></markdown-editor>
            <v-card-actions>
                <v-btn icon small type="submit">
                    <v-icon color="teal">save</v-icon>
                </v-btn>
                <v-btn icon small @click="cancel" >
                    <v-icon >cancel</v-icon>
                </v-btn>
            </v-card-actions>

        </v-form>
    </v-container>
</template>

<script>
    export default {
        name: "editQuestion",
        props:['data'],
        data()
        {
            return{
                form:{
                    title:null,
                    body:null
                }
            }
        },
        methods:{

            cancel()
            {
                /*****emettre un envement******/
                EventBus.$emit('cancelEditing')
            },
            update()
            {
                axios.patch(`/api/question/${this.form.slug}`,this.form)
                    .then(res => this.cancel())
            }
        },
        mounted()
        {
            this.form = this.data
        }
    }
</script>

<style scoped>

</style>