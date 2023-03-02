<template>
    <div v-if="dish">
        <h4>{{ dish.dish_name }}</h4>
        <h5>Prezzo: {{ dish.price }}</h5>
        <img :src="dish.image" :alt="dish.dish_name" class="dish-img" />
        <p>{{ dish.ingredients }}</p>
    </div>
</template>

<script>
export default {
    props: ["id", "dish"],
    data() {
        return {
            objDish: null,
        };
    },
    created() {
        this.objDish = this.dish;
    },
};
</script>

<style lang="scss" scoped>
.dish-img {
    width: 300px;
}
</style>
