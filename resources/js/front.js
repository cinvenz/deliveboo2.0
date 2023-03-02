require("./common");

import Vue from "vue";
import App from "./App.vue";
import VueRouter from "vue-router"; // importazione vue-router
import PageHome from "./pages/PageHome";
import PageRestaurant from "./pages/PageRestaurant";
import PageDish from "./pages/PageDish";
import PageCart from "./pages/PageCart";

import vueBraintree from "vue-braintree";
Vue.use(vueBraintree);

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "home",
        component: PageHome,
    },
    {
        path: "/restaurants/:id",
        name: "restaurantsShow",
        component: PageRestaurant,
        props: true,
    },
    {
        path: "/dishes/:id",
        name: "dishShow",
        component: PageDish,
        props: true,
    },
    {
        path: "/cart",
        name: "cart",
        component: PageCart,
    },
];

// personalizzazione del vue-router
const router = new VueRouter({
    mode: "history", // toglie l'# dagli indirizzi ma richiede delle modifiche lato server
    routes, // routes: routes
});

new Vue({
    el: "#root",
    render: (h) => h(App), // renderizzare App nella #root
    // usare vue-router specifico al nostro progetto
    router, // router: router
});
