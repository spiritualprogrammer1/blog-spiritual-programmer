<template>
    <v-card>
        <v-toolbar color="cyan" dark dense class="mt-2">
            <v-toolbar-title>Cartegory</v-toolbar-title>
        </v-toolbar>
        <v-list>
            <v-list-tile  v-for="category in categories" :key="category.id" >
                <v-list-tile-content>
                    <v-list-tile-title >{{category.name}}</v-list-tile-title>
                    <!--<v-list-tile-sub-title v-html="item.subtitle"></v-list-tile-sub-title>-->
                </v-list-tile-content>
            </v-list-tile>
        </v-list>

    </v-card>
</template>

<script>
    export default {
        name: "AppSidebar.vue",
        data()
        {
           return {
               categories: {}
           }
        },

    }
</script>

<style scoped>

</style>