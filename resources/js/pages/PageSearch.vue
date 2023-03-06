<template>
    <div>
        <NavBar />
        <div>
            <h2 class="title">Cerca la tipologia del ristorante tra:</h2>
            <div class="d-flex justify-content-center">
                <div class="search-bar-div d-flex pt-3 ps-3">
                    <input
                        class="form-control me-2 search-bar"
                        type="search"
                        v-model="categories"
                        @keyup.enter="search"
                    />
                    <button class="btn btn-outline-success" @click="search">
                        Search
                    </button>
                </div>
            </div>
            <h6 class="typologie">
                Pizza, Messicano, Americano, Cinese, Pesce, Carne, Italiano,
                Internazionale, Dolce, Kebab, Fritti, Poke, Vegano
            </h6>
            <section class="pt-5 mt-2 searchpage">
                <div v-if="isFiltered">
                    <div class="container px-lg-5">
                        <!-- Page Features-->
                        <div class="row gx-lg-5">
                            <router-link
                                v-for="user in arrUsers"
                                :key="user.id"
                                :to="{
                                    name: 'restaurantsShow',
                                    params: { id: user.id },
                                }"
                                class="col-lg-6 col-xxl-4 mb-5"
                            >
                                <div
                                    class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0"
                                >
                                    <div
                                        class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"
                                    >
                                        <i class="bi bi-collection"></i>
                                    </div>
                                    <div class="card-img-wrapper">
                                        <img
                                            :src="user.image"
                                            alt="User image"
                                            class="card-img-top img-fluid"
                                        />
                                    </div>

                                    <h2
                                        class="fs-4 fw-bold"
                                        style="color: #333; font-size: 24px"
                                    >
                                        {{ user.restaurant_name }}
                                    </h2>
                                    <p
                                        class="mb-0"
                                        style="color: #777; font-size: 16px"
                                    >
                                        {{ user.address }}
                                    </p>
                                    <p
                                        class="mb-0"
                                        style="color: #777; font-size: 14px"
                                    >
                                        {{ user.opening_hours }} -
                                        {{ user.closing_hours }}
                                    </p>
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <FooterComponent />
    </div>
</template>

<script>
import NavBar from "../components/NavBar.vue";
import FooterComponent from "../components/FooterComponent.vue";

export default {
    name: "PageHome",
    components: {
        NavBar,
        FooterComponent,
    },

    data() {
        return {
            arrUsers: null,
            isFiltered: false,
            viewedIds: [], // array per memorizzare gli id già visualizzati
        };
    },
    methods: {
        search() {
            if (this.categories) {
                this.arrUsers = null;
                this.isFiltered = true;
                axios
                    .get("/api/users/search", {
                        params: {
                            category: this.categories,
                        },
                    })
                    .then((response) => {
                        // filtro gli utenti per mostrare ogni id una sola volta
                        const filteredResults = response.data.results.filter(
                            (user) => {
                                if (this.viewedIds.includes(user.id)) {
                                    return false; // l'id è già stato visualizzato, quindi ignora l'utente
                                } else {
                                    this.viewedIds.push(user.id); // aggiunge l'id all'array
                                    return true; // mostra l'utente
                                }
                            }
                        );
                        this.arrUsers = filteredResults;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else if (!this.categories) {
                this.isFiltered = false;
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.card-body {
    position: relative;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.card-body:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card-img-wrapper {
    height: 180px;
    position: relative;
    overflow: hidden;
    margin-bottom: 1rem;
}

.card-img-wrapper img {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 100%;
    max-height: 100%;
}

.card-body h2 {
    font-size: 24px;
    color: #333;
}

.card-body p {
    font-size: 16px;
    color: #777;
}

.feature {
    background-color: #ff6347;
}
a {
    text-decoration: none;
}

.searchpage {
    min-height: 50vh;
}

.btn {
    color: white !important;
    border: 3px double white;
    background-image: linear-gradient(to right, #133846, #133850);
}
.btn:hover {
    color: #133846 !important;
    border: 3px double white;
    background: #5f9ea0 !important;
    transition: 0.6s;
}

.search-bar-div {
    width: 20rem;
}
.title {
    text-align: center;
    font-size: 1.5em;
    margin-top: 1.5em;
}
.typologie {
    text-align: center;
    margin-top: 1em;
    font-size: 0.8em;
}
</style>
