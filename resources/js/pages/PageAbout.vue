<template>
    <div>
        <NavBar />
        <div
            v-if="objRestaurant && arrDishes"
            class="p-5 text-center bg-image rounded-3"
            :style="{
                height: '400px',
                backgroundPosition: 'center',
                backgroundRepeat: 'no-repeat',
                backgroundSize: 'cover',
            }"
        >
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.6)">
                <div
                    class="d-flex justify-content-center align-items-center h-100"
                >
                    <div class="text-white">
                        <h1 class="mb-3">c</h1>
                        <h4 class="mb-3">
                            {{ objRestaurant.address }}
                        </h4>
                        <h5 class="mb-3">{{ objRestaurant.phone }}</h5>
                    </div>
                </div>
            </div>
            <img
                :src="objRestaurant.image"
                :alt="objRestaurant.restaurant_name"
                style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                "
            />

            <!-- Menu Piatti  -->
            <div class="container contgene">
                <div class="menpiatt">
                    <div
                        class="card carte"
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
                                style="height: 180px"
                            />
                        </router-link>

                        <div class="card-body">
                            <h5 class="card-title">{{ dish.dish_name }}</h5>
                            <p class="card-text">
                                {{ "€ " + dish.price }}
                            </p>
                            <button
                                @click="addToCart(dish)"
                                class="btn btn-primary"
                            >
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Checkout -->
                <div class="col-12 col-md-4">
                    <div class="container seccont">
                        <table
                            class="table mb-4 carrello"
                            v-if="cart.length > 0"
                        >
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
                        <div v-if="cart.length > 0" class="checkout">
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
                                v-if="
                                    validatePhoneMessage == 'Numero non valido'
                                "
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
                                v-if="
                                    validateEmailMessage == 'Email non valida'
                                "
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

<style lang="scss" scoped>
.contimm {
    justify-content: center;
    width: 100%;
    height: 700px;
    position: relative;
}

.contimm img {
    width: 100%;
    height: 100%;
    filter: brightness(0.4);
    background-size: cover;
    background-position-x: center;
    background-position-y: center;
    display: block;
}

.inforest {
    position: absolute;
    top: 35%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
    text-align: center;
}
.carte {
    border-radius: 20px;
    box-shadow: 0 0 10px rgb(83, 85, 89);
    transition: all 0.2s linear;
    max-height: 400px;
    max-width: 250px;
}
.carte:hover {
    transform: scale(1.2);
}
.carte img {
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position-x: center;
    background-position-y: center;
    display: block;
}
.contgene {
    display: flex;
    justify-content: space-between;
    margin-top: 100px;
}

.menpiatt {
    width: 60%;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 4rem 5rem;
}

.seccont {
    width: 100%;
}
.carrello {
    width: 300px;
    margin-top: 100px;
    flex-wrap: wrap !important;
    justify-content: center !important;
}
.checkout {
    width: 300px;
    box-shadow: 0 0 10px rgb(83, 85, 89);
    padding: 1rem;
}
</style>
