<template>
    <div>
        <div id="hero" class="position-relative">
            <div
                id="text-hero"
                class="text-center my-py-13 text-white position-absolute"
            >
                <h1>Cerca</h1>
                <select name="types" id="types" @change="sendCategories">
                    <option>-- Scegli la tipologia --</option>
                    <option
                        v-for="(category, index) in categories"
                        :value="category.id"
                        :key="index"
                    >
                        {{ category.nome }}
                    </option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "App",
    components: {},
    data() {
        return {
            categories: [],
            category: null,
        };
    },
    methods: {
        sendCategories(e) {
            console.log(e.target.value);
            /* axios
                .post("/api/types", {
                    id: e.target.value,
                })
                .then((response) => {
                    this.type = response.data;
                }); */
        },
    },
    created() {
        axios
            .get(`/api/categories`)
            .then((response) => {
                this.categories = response.data;
                console.log(this.categories);
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>

<style scoped></style>
