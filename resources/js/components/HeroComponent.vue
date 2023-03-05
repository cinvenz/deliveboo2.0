<template>
    <div class="jumbo-container">
        <div
            class="jumbotron jumbotron-fluid"
            :style="{
                height: '100vh',
                backgroundColor: '#323232',
                backgroundImage:
                    'url(https://img.freepik.com/free-photo/female-chef-adding-sauce-dish_23-2148763222.jpg?w=1060&t=st=1677947528~exp=1677948128~hmac=5370c468e6e3d7bdc2fb386045a41c6b5a5dab0ba475909d0994a96f36b9d9f5)',
                backgroundPosition: 'center',
                backgroundRepeat: 'no-repeat',
                backgroundSize: 'cover',
            }"
        ></div>
        <div class="container text-white cerca">
            <h1 class="display-4">Cerca i tuoi ristoranti preferiti</h1>
            <router-link :to="{ name: 'pageSearch' }">
                <button class="button-86" role="button">Cerca</button>
            </router-link>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    text-align: center; /* center the text horizontally */
    position: absolute;
    inset: 0;
}
.jumbo-container {
    background-color: black;
    position: relative;
}

.jumbotron {
    opacity: 0.5;
}
a {
    text-decoration: none;
}

@media (max-width: 768px) {
    /* adjust the font size for smaller screens */
    .container {
        font-size: 24px;
    }
}

.button-86 {
    all: unset;
    width: 100px;
    height: 30px;
    font-size: 16px;
    background: transparent;
    border: none;
    position: relative;
    color: #f0f0f0;
    cursor: pointer;
    z-index: 1;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
}

.button-86::after,
.button-86::before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: -99999;
    transition: all 0.4s;
}

.button-86::before {
    transform: translate(0%, 0%);
    width: 100%;
    height: 100%;
    background: #133846;
    border-radius: 10px;
}

.button-86::after {
    transform: translate(10px, 10px);
    width: 35px;
    height: 35px;
    background: #ffffff15;
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border-radius: 50px;
}

.button-86:hover::before {
    transform: translate(5%, 20%);
    width: 110%;
    height: 110%;
}

.button-86:hover::after {
    border-radius: 10px;
    transform: translate(0, 0);
    width: 100%;
    height: 100%;
}

.button-86:active::after {
    transition: 0s;
    transform: translate(0, 5%);
}
</style>
