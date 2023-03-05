<template>
    <div>
        <NavBar />
        <!-- <div
            v-if="objRestaurant && arrDishes"
            class="jumbotron jumbotron-fluid position-relative"
        >
            <img
                :src="objRestaurant.image"
                :alt="objRestaurant.restaurant_name"
                class="img-fluid mx-auto d-block"
                style="max-width: 100%; height: auto; object-fit: cover"
            />

            <div
                class="container position-absolute top-50 start-50 translate-middle"
            >
                <h1 class="display-4 text-center">
                    {{ objRestaurant.restaurant_name }}
                </h1>
                <p class="lead text-center">{{ objRestaurant.address }}</p>
            </div>
        </div> -->
        <div
            class="jumbotron jumbotron-fluid position-relative"
            v-if="objRestaurant && arrDishes"
        >
            <img
                :src="objRestaurant.image"
                class="card-img-top"
                :alt="objRestaurant.restaurant_name"
            />
            <div
                class="container position-absolute top-50 start-50 translate-middle"
            >
                <h1 class="display-4 text-center">
                    {{ objRestaurant.restaurant_name }}
                </h1>
                <h4 class="lead text-center">{{ objRestaurant.address }}</h4>
                <p class="lead text-center">{{ objRestaurant.phone }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import NavBar from "../components/NavBar.vue";

export default {
    name: "PageRestaurant",
    components: {
        NavBar,
    },
    props: ["id"],
    data() {
        return {
            objRestaurant: null,
            arrDishes: null,
            cart: [],

            total: 0,
            id: null,
            userName: null,
            userIndirizzo: null,
            userTelefono: null,
            validatePhoneMessage: null,
            userEmail: null,
            validateEmailMessage: null,
            responseMessage: null,
        };
    },
    created() {
        axios
            .get("/api/users/" + this.id)
            .then((response) => (this.objRestaurant = response.data.results))
            .then(() => {
                axios
                    .get("/api/users/" + this.id + "/dishes")
                    .then((response) => {
                        this.arrDishes = response.data.results;
                        console.log(this.arrDishes);
                    });
            });
    },
    methods: {
        addToCart(dish) {
            const cartItem = {
                id: dish.id,
                dish_name: dish.dish_name,
                price: dish.price,
            };
            this.cart.push(cartItem);
            this.total += parseFloat(dish.price);
        },

        removeFromCart(dish) {
            this.cart.splice(this.cart.indexOf(dish), 1);
            this.total -= parseFloat(dish.price);
            this.save();
        },

        save() {
            localStorage.setItem("cart", JSON.stringify(this.cart));
            localStorage.setItem("total", this.total);
            localStorage.setItem("id", this.id);
        },
        onSuccess(payload) {
            axios
                .post("/api/checkout", {
                    nonce: payload.nonce,
                    total: this.total.toFixed(2),
                    restaurantId: this.id,
                    userName: this.userName,
                    userSurname: this.userSurname,
                    userIndirizzo: this.userIndirizzo,
                    userTelefono: this.userTelefono,
                    userEmail: this.userEmail,
                    dishIdsArray: this.dishIdsArray,
                })
                .then((response) => {
                    this.cart = [];
                    this.total = 0;
                    this.save();
                    this.responseMessage = response.data.message;
                });
        },
        onError(error) {
            let message = error.message;
        },
        validateEmail(value) {
            if (/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/.test(value)) {
                this.validateEmailMessage = "Email valida";
            } else {
                this.validateEmailMessage = "Email non valida";
            }
        },
        validatePhone(value) {
            if (/^((\+|00)?39)?3\d{2}\d{6,7}$/.test(value)) {
                this.validatePhoneMessage = "Numero valido";
            } else {
                this.validatePhoneMessage = "Numero non valido";
            }
        },
    },

    mounted() {
        const url = window.location.href;
        const id = url.substring(url.lastIndexOf("/") + 1);
        this.id = id;
        /* JSON.parse(localStorage.getItem("id")); */
        axios
            .get(`/api/users/${id}`)
            .then((response) => {
                this.user = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
        if (
            localStorage.getItem("id") &&
            localStorage.getItem("id") != this.id
        ) {
            console.log(this.id);
            console.log(localStorage.getItem("id"));
            localStorage.removeItem("cart");
            localStorage.removeItem("total");
            localStorage.removeItem("id");
        }
        if (localStorage.getItem("cart")) {
            try {
                this.cart = JSON.parse(localStorage.getItem("cart"));
                this.total = parseFloat(localStorage.getItem("total"));
                this.id = JSON.parse(localStorage.getItem("id"));
            } catch (e) {
                localStorage.removeItem("cart");
                localStorage.removeItem("total");
                localStorage.removeItem("id");
            }
        }
    },
    computed: {
        // this.total with only two numbers after the decimal point
        totalTwoDecimals() {
            return this.total.toFixed(2);
        },
    },
};
</script>
<style scoped>
.jumbotron {
    position: relative;
    overflow: hidden;
}
.jumbotron .card-img-top {
    max-width: 100%;
    max-height: 400px; /* imposta un'altezza massima di 400px */
    margin: 0 auto;
    object-fit: cover; /* evita che l'immagine si deformi */
}

.container {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
