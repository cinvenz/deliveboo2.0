<template>
    <div>
        <NavBar />
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
                class="container position-absolute top-50 start-50 translate-middle text-white"
            >
                <h1 class="display-4 text-center">
                    {{ objRestaurant.restaurant_name }}
                </h1>
                <h2 class="lead text-center">{{ objRestaurant.address }}</h2>
                <p class="lead text-center">{{ objRestaurant.phone }}</p>
            </div>
        </div>

        <!-- Menu Piatti  -->

        <div class="__area text-center">
            <div
                class="contenitore-carte-carrello d-lg-flex justify-content-around"
            >
                <div class="contenitore-carte">
                    <div
                        class="__card"
                        style="width: 18rem"
                        v-for="dish in arrDishes"
                        :key="dish.id"
                    >
                        <router-link
                            :to="{
                                name: 'dishShow',
                                params: { id: dish.id, dish: dish },
                            }"
                        >
                            <img
                                :src="dish.image"
                                :alt="dish.dish_name"
                                class="img-fluid __img"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasBottom"
                                aria-controls="offcanvasBottom"
                            />
                        </router-link>

                        <div class="__card_detail text-left">
                            <router-link
                                :to="{
                                    name: 'dishShow',
                                    params: { id: dish.id, dish: dish },
                                }"
                            >
                                <h4>{{ dish.dish_name }}</h4>
                            </router-link>
                            <p>{{ "€ " + dish.price }}</p>
                            <div class="__type">
                                <span href="#Italian">Italian</span>
                                <span href="#Vegetarian">Vegetarian</span>
                                <span href="#Pizza">Pizza</span>
                            </div>
                            <div class="__detail">
                                <button
                                    @click="addToCart(dish)"
                                    class="button-57"
                                    role="button"
                                >
                                    <span class="text">
                                        Add to
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-cart"
                                            viewBox="0 0 16 16"
                                        >
                                            <path
                                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
                                            /></svg></span
                                    ><span>
                                        <span
                                            ><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                fill="currentColor"
                                                class="bi bi-cart-check-fill"
                                                viewBox="0 0 16 16"
                                            >
                                                <path
                                                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"
                                                /></svg></span
                                    ></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout -->

                <div class="col-md-3 checkout">
                    <h2 class="mb-4">Carrello</h2>
                    <table class="table mb-4" v-if="cart.length > 0">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Rimuovi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(dish, index) in cart" :key="index">
                                <td>{{ dish.dish_name }}</td>
                                <td>{{ dish.price }}</td>
                                <td>
                                    <button
                                        class="btn btn-sm btn-danger"
                                        @click="removeFromCart(dish)"
                                    >
                                        Rimuovi
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>Totale</th>
                                <td>{{ totalTwoDecimals }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <!--  -->
                    <div v-if="cart.length > 0">
                        <h3>Checkout</h3>
                        <input
                            class="form-control mb-2"
                            type="text"
                            v-model="userName"
                            placeholder="Nome*"
                            required
                        />
                        <input
                            class="form-control mb-2"
                            type="text"
                            v-model="userSurname"
                            placeholder="Cognome*"
                            required
                        />
                        <input
                            class="form-control mb-2"
                            type="text"
                            v-model="userIndirizzo"
                            placeholder="Indirizzo*"
                            required
                        />
                        <input
                            class="form-control mb-2"
                            type="text"
                            v-model="userTelefono"
                            placeholder="Numero di telefono*"
                            @keyup="validatePhone(userTelefono)"
                            required
                        />
                        <small
                            class="text-danger"
                            v-if="validatePhoneMessage == 'Numero non valido'"
                        >
                            {{ validatePhoneMessage }}
                        </small>
                        <input
                            class="form-control mb-2"
                            type="text"
                            v-model="userEmail"
                            placeholder="Email*"
                            required
                            @keyup="validateEmail(userEmail)"
                        />
                        <small
                            class="text-danger"
                            v-if="validateEmailMessage == 'Email non valida'"
                        >
                            {{ validateEmailMessage }}
                        </small>
                        <v-braintree
                            authorization="sandbox_pgksqfzg_dhs5g79tpt93p3k8"
                            locale="it_IT"
                            btnText="Ordina"
                            @success="onSuccess"
                            @error="onError"
                        ></v-braintree>
                    </div>
                    <div v-if="responseMessage && cart.length == 0">
                        <p class="text-success font-weight-bold">
                            {{ responseMessage }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import NavBar from "../components/NavBar.vue";

export default {
    props: ["id"],
    components: {
        NavBar,
    },
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
.__area {
    font-family: "Cairo", sans-serif;
    color: #7c7671;
    margin-top: 100px;
}

.__card {
    max-width: 350px;
    margin: 1rem 0 1rem;
    cursor: pointer;
    position: relative;
    display: inline-block;
    color: unset;
    text-decoration: none;
}
.__card:hover {
    color: unset;
}
.__img {
    border-radius: 10px;
}

.__card_detail {
    box-shadow: 0 4px 15px rgba(175, 77, 0, 0.13);
    padding: 13px;
    border-radius: 8px;
    margin: -30px 10px 0;
    position: relative;
    z-index: 2;
    background-color: #fff;
}

.__card_detail:hover {
    box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
}
.__card_detail h4 {
    color: #474340;
    line-height: 100%;
    font-weight: bold;
}
.__card_detail p {
    font-size: 13px;
    font-weight: bold;
    margin-bottom: 0.4rem;
}
.__type span {
    background-color: #feefe3;
    padding: 5px 10px 7px;
    border-radius: 5px;
    display: inline-block;
    margin-right: 10px;
    font-size: 12px;
    color: #fc9d52;
    font-weight: bold;
    line-height: 100%;
}
.__detail {
    margin-top: 15px;
}

.button-57 {
    position: relative;
    overflow: hidden;
    border: 1px solid #474340;
    border-radius: 3px;
    color: #474340;
    display: inline-block;
    font-size: 15px;
    line-height: 15px;
    padding: 10px 10px 10px;
    text-decoration: none;
    cursor: pointer;
    background: #fff;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
}

.button-57 span:first-child {
    position: relative;
    transition: color 600ms cubic-bezier(0.48, 0, 0.12, 1);
    z-index: 10;
}

.button-57 span:last-child {
    color: white;
    display: block;
    position: absolute;
    bottom: 0;
    transition: all 500ms cubic-bezier(0.48, 0, 0.12, 1);
    z-index: 100;
    opacity: 0;
    top: 50%;
    left: 50%;
    transform: translateY(225%) translateX(-50%);
    height: 14px;
    line-height: 13px;
}

.button-57:after {
    content: "";
    position: absolute;
    bottom: -50%;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #133846;
    transform-origin: bottom center;
    transition: transform 600ms cubic-bezier(0.48, 0, 0.12, 1);
    transform: skewY(9.3deg) scaleY(0);
    z-index: 50;
}

.button-57:hover:after {
    transform-origin: bottom center;
    transform: skewY(9.3deg) scaleY(2);
}

.button-57:hover span:last-child {
    transform: translateX(-50%) translateY(-100%);
    opacity: 1;
    transition: all 900ms cubic-bezier(0.48, 0, 0.12, 1);
}
a {
    text-decoration: none;
    color: #133846;
}
</style>
