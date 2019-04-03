<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->

    </head>
    <body>
    <div id="app">
        <v-app>
            <template>
                <v-toolbar>
                    <v-toolbar-side-icon></v-toolbar-side-icon>
                    <v-toolbar-title>Title</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items class="hidden-sm-and-down">
                        <v-btn flat>Link One</v-btn>
                        <v-btn flat>Link Two</v-btn>
                        <v-btn flat>Link Three</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
            </template>
        </v-app>
    </div>
    </body>
</html>
