<template>
    <div>
        <NavBar />
        <div class="container">
            <div class="sium">
                <div v-for="user in arrUsers" :key="user.id" class="contgen">
                    <router-link
                        style="text-decoration: none"
                        :to="{
                            name: 'restaurantsShow',
                            params: { id: user.id },
                        }"
                    >
                        <div class="carte">
                            <div class="cont1">
                                <img
                                    :src="user.image"
                                    class="card-img-top"
                                    alt="..."
                                />
                            </div>
                            <div class="cont2">
                                <h4>{{ user.restaurant_name }}</h4>
                                <p><b> Via:</b> {{ user.address }}</p>
                                <p>
                                    <b> Orario apertura:</b>
                                    {{ user.opening_hours }}
                                </p>
                                <p>
                                    <b> Orario chiusura:</b>
                                    {{ user.closing_hours }}
                                </p>
                                <p><b>Tel:</b> {{ user.phone }}</p>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>

            <div>
                <div class="SINGUP">
                    <h1>Do you have a restaurant?</h1>
                    <p>Find out all the advantages of home delivery</p>
                    <a href="/login" class="btn btn-outline-success">Sing UP</a>
                </div>
            </div>

            <div class="pubbl">
                <div class="primocont">
                    <div>
                        <img src="/servizio-a-domicilio.jpg" alt="" />
                    </div>
                    <div class="testo">
                        <h4>CONSEGNE VELOCI</h4>
                        <p>
                            Ricevi i tuoi piatti direttammente a casa tua in
                            tutta sicurezza e in breve tempo
                        </p>
                    </div>
                </div>
                <div class="primocont">
                    <div>
                        <img src="/divano.jpeg" alt="" />
                    </div>
                    <div class="testo">
                        <h4>GODITI IL CIBO</h4>
                        <p>
                            Condividi i piatti con amici e parenti quando e dove
                            vuoi
                        </p>
                    </div>
                </div>
            </div>
            <div class="primocont contesterno">
                <div>
                    <img src="/ordina-ora.jpeg" alt="" />
                </div>
                <div class="testo">
                    <h4>ORDINA FACILMENTE</h4>
                    <p>
                        Ordina i tuoi piatti preferiti in modo semplice e veloce
                        grazie al nostro sito
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
    name: "PageHome",
    components: {
        NavBar,
        FooterComponent,
    },

    data() {
        return {
            arrUsers: null,
        };
    },
    created() {
        axios
            .get("/api/users")
            .then((response) => (this.arrUsers = response.data.results));
    },
};
</script>

<style lang="scss" scoped>
.contgen {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.carte {
    display: flex;
    width: 600px;
    border-radius: 4px;
    margin: 1rem 1rem;
    transition: all 0.2s linear;
    box-shadow: 0 0 10px rgb(83, 85, 89);
}
.carte:hover {
    transform: scale(1.2);
}
.cont1 {
    height: 200px;
    overflow: hidden;
    border-radius: 4px 4px 0 0;
    width: 300px;
}

.cont1 img {
    width: 85%;
    height: 100%;
    object-fit: cover;
}

.cont2 {
    padding: 10px;
}

.cont2 h4 {
    margin-top: 0;
}

.cont2 p {
    margin-bottom: 5px;
}

h4 {
    color: black;
}

p {
    color: black;
}
.sium {
    margin-top: 50px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.SINGUP {
    margin-top: 100px;
    box-sizing: border-box;
    text-align: center;
    background-image: url("/sous-chef-significato-cosa-fa.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position-x: center;
    background-position-y: center;
    height: 600px;
}
.SINGUP h1 {
    font-size: 90px !important;
    padding-top: 250px;
    color: white;
}
.SINGUP p {
    color: white;
    font-size: 40px !important;
}
.SINGUP .btn {
    color: white !important;
    background-image: linear-gradient(to right, #ff0101, #e1a900);
    border-radius: 5px !important;
    width: 90px;
    height: 40px;
    padding-top: 0.5rem;
}

.SINGUP .btn:hover {
    color: #ff0101;
    background: rgb(255, 153, 0) !important;
}
.pubbl {
    margin-top: 7rem;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin: auto;
}
.primocont img {
    width: 250px;
    height: 250px;
}

.primocont {
    width: 500px;
    display: flex;
    justify-content: space-between;
    border-radius: 4px;
    box-shadow: 0 0 10px rgb(83, 85, 89);
    margin: 4rem 0rem;
}

.primocont h4 {
    text-align: center;
    margin-bottom: 20px;
}
.primocont p {
    text-align: center;
}
.testo {
    padding: 2rem 1rem;
}
.contesterno {
    margin: auto;

    margin-bottom: 3rem;
}
</style>
