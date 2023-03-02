<template>
    <div>
        <div class="navvv">
            <div class="navsup">
                <div class="contain1">
                    <router-link :to="{ name: 'home' }" class="navbar-brand"
                        ><img
                            class="immaginenav"
                            src="../../img/Risorsa-7.png"
                            alt=""
                    /></router-link>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div
                        class="collapse navbar-collapse"
                        id="navbarSupportedContent"
                    >
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <router-link
                                    :to="{ name: 'usersIndex' }"
                                    class="nav-link"
                                ></router-link>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="contain2">
                    <form class="d-flex" role="search">
                        <input
                            class="form-control me-2"
                            type="search"
                            placeholder="Cerca"
                            aria-label="Search"
                        />
                        <button class="btn btn-outline-success" type="submit">
                            Cerca
                            <font-awesome-icon
                                icon="fa-solid fa-magnifying-glass"
                            />
                        </button>
                    </form>
                </div>
                <div class="contain3">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item carrello">
                            <b
                                ><a
                                    class="carr"
                                    href="/login"
                                    style="text-decoration: none"
                                    >Carrello</a
                                ></b
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container categorie mt-5">
            <b> <a href="http://">Pizza</a></b>
            <b> <a href="http://">Messicano</a></b>
            <b> <a href="http://">Americano</a></b>
            <b> <a href="http://">Cinese</a></b>
            <b> <a href="http://">Pesce</a></b>
            <b> <a href="http://">Carne</a></b>
            <b> <a href="http://">Italiano</a></b>
            <b> <a href="http://">Internazionale</a></b>
            <b> <a href="http://">Dolce</a></b>
            <b> <a href="http://">Kebab</a></b>
            <b> <a href="http://">Fritti</a></b>
            <b> <a href="http://">Poke</a></b>
            <b> <a href="http://">Vegano</a></b>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style>
.immaginenav {
    margin-top: -350px;
    width: 70%;
}
.carrello {
    color: black;
    margin-top: -200px;
}
.carr {
    color: black !important;
}
.contain1 {
    width: 33%;
}
.contain2 {
    width: 34%;
}
.contain3 {
    width: 33%;
    text-align: end;
}
.navvv {
    background-image: url(/sfondo.jpeg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position-x: center;
    background-position-y: 70%;
    height: 600px;
}

.topnav {
    display: flex;
    justify-content: space-between;
}
.navsup {
    display: flex;
    justify-content: space-between;
    height: 70px;
    align-items: center;
    margin: 0px 4.5rem;
    padding-top: 250px;
}
.nav-link {
    color: white !important;
}
.nav-link:hover {
    color: rgb(255, 0, 0) !important;
}

.btn {
    color: white !important;
    border-color: rgb(255, 0, 0) !important;
    background-image: linear-gradient(to right, #ff0101, #e1a900);
}

.btn:hover {
    color: rgb(255, 0, 0) !important;
    background: none !important;
}
.categorie {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    justify-content: center;
}

.categorie a {
    text-decoration: none;
    font-size: 30px;
    margin: 0 1.5rem;
    color: black;
}
.categorie a:hover {
    color: red;
    text-decoration: underline;
}
.btn2 {
    color: white !important;
    border-color: rgb(255, 0, 0) !important;
    background-image: linear-gradient(to right, #ff0101, #e1a900);
    width: 100px;
    border-radius: 10px;
    text-align: center;
}
.carrello {
    justify-content: flex-end;
    display: flex;
}
</style>
