import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import parallex from '../components/Parallex'
import login from '../login/Login'
import signup from '../login/Signup'
import forum from '../forum/Forum'
import logout from '../login/Logout'
import read from '../forum/read'
import  create from '../forum/create'
import createcategory from '../category/CreateCategory'
const routes = [
    { path: '/', component: parallex },
     { path: '/login', component: login },
    { path: '/signup', component: signup },
    { path: '/forum', component: forum , name:'forum'},
    { path: '/logout', component: logout },
    { path: '/question/:slug', component: read, name:'read' },
    { path: '/ask', component: create },
    { path: '/category', component: createcategory },
]

const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang: false,
    mode:'history'
})
/*****va permettre d'etre reutisable***/

export default router