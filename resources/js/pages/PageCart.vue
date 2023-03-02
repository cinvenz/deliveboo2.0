<<<<<<< HEAD
<!-- <template>
=======
<template>
>>>>>>> cart-component
    <div>
        <h1>Cart</h1>
        <div v-for="item in cart" :key="item.id">
            <h2>{{ item.dish_name }}</h2>
            <p>{{ item.price }}</p>
        </div>
<<<<<<< HEAD
=======

        <button @click="checkout">Checkout</button>
>>>>>>> cart-component
    </div>
</template>

<script>
<<<<<<< HEAD
// import axios from "axios";
export default {
    computed: {
        cart() {
            return this.$route.params.cart;
=======
export default {
    data() {
        return {
            cart: [],
        };
    },

    created() {
        // Set the cart data from the route params
        this.cart = this.$route.params.cart;
    },

    methods: {
        checkout() {
            // Process the checkout
            console.log("Checkout initiated");
            this.cart = [];
>>>>>>> cart-component
        },
    },
};
</script>
<<<<<<< HEAD

 -->
=======
>>>>>>> cart-component
