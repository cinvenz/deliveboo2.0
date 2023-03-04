<template>
    <div>
        <form @submit.prevent="searchUsers">
            <div>
                <label for="category">Specializzazione:</label>
                <input type="text" id="category" v-model="category" />
            </div>
            <button type="submit">Cerca</button>
        </form>
        <ul>
            <li v-for="user in users" :key="user.id">
                {{ user.name }} -
                {{ user.categories.map((c) => c.name).join(", ") }}
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            category: "",
            users: [],
        };
    },
    methods: {
        searchUsers() {
            axios
                .get("/users/search", { params: { category: this.category } })
                .then((response) => {
                    this.users = response.data.results;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
