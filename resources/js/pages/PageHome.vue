<template>
    <div>
        <NavBar />

        <HeroComponent />
        <!-- Page Content-->
        <section class="pt-5 mt-5">
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
                                <span
                                    ><span
                                        ><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-clock"
                                            viewBox="0 0 16 16"
                                        >
                                            <path
                                                d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"
                                            />
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"
                                            /></svg></span
                                ></span>
                                {{ user.opening_hours }} -
                                {{ user.closing_hours }}
                            </p>
                        </div>
                    </router-link>
                </div>
            </div>
        </section>
        <RegistrationComponent />
        <FooterComponent />
    </div>
</template>

<script>
import NavBar from "../components/NavBar.vue";
import FooterComponent from "../components/FooterComponent.vue";
import HeroComponent from "../components/HeroComponent.vue";
import RegistrationComponent from "../components/RegistrationComponent.vue";

export default {
    name: "PageHome",
    components: {
        NavBar,
        HeroComponent,
        FooterComponent,
        RegistrationComponent,
    },

    data() {
        return {
            arrUsers: null,
            arrCategories: null,
            searchQuery: "",
        };
    },
    created() {
        axios
            .get("/api/users")
            .then((response) => (this.arrUsers = response.data.results));

        // axios
        //     .get("/api/categories")
        //     .then((response) => (this.arrCategories = response.data.results));
    },
    methods: {
        search() {
            axios
                .get(`/api/users?search=${this.searchQuery}`)
                .then((response) => (this.arrUsers = response.data.results));
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
</style>
