<template>
    <div>
        <NavBar />
        <div
            class="container dish d-flex justify-content-center align-items-center"
            v-if="dish"
        >
            <div class="row">
                <div class="col-md-6 mb-4">
                    <img
                        :src="dish.image"
                        :alt="dish.dish_name"
                        class="dish-img w-100"
                    />
                </div>

                <div class="col-md-6 text-center">
                    <h1>{{ dish.dish_name }}</h1>
                    <h4>Ingredienti:</h4>
                    <p>
                        {{ dish.ingredients }}
                    </p>
                    <h4>Descrizione:</h4>
                    <p>
                        {{ dish.description }}
                    </p>
                </div>
            </div>
        </div>
        <FooterComponent />
    </div>
</template>

<script>
import NavBar from "../components/NavBar.vue";
import FooterComponent from "../components/FooterComponent.vue";
export default {
    props: ["id", "dish"],
    components: {
        NavBar,
        FooterComponent,
    },
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
.dish {
    height: 75vh;
}
.dish-img {
    max-width: 100%;
    height: auto;
}
</style>
