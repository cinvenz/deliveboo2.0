<template>
    <div style="background-color: #f09e75">
        <div class="container finepag">
            <div class="div1">
                <h2>Social</h2>
                <a href="http://">Facebook</a>
                <a href="http://">Twitter</a>
                <a href="http://">Instagram</a>
            </div>
            <div class="div2">
                <h2>Contatti</h2>
                <a
                    href="http://www.google.it/maps/@45.5279562,9.5494161,14z%22%3E"
                    >Via C. Boolean, 78 - Italy</a
                >
                <a href="http://">+39 XXX-XXX-XXXX</a>
                <a href="http://gmail.com/"></a>
            </div>
            <div class="div1">
                <img src="/Risorsa-7.png" alt="" />
            </div>
        </div>
        <div style="background-color: #fe6347; height: 2rem">
            <p style="text-align: center; color: white">
                Made with LOVE by Team 7 #78
            </p>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.finepag {
    display: flex;
    justify-content: space-between;
    padding: 8rem 0;
}
.finepag div {
    display: flex;
    flex-direction: column;
}
.div1 {
    width: 33%;
}
.div2 {
    width: 34%;
}
.finepag a {
    text-decoration: none;
    color: red;
    padding: 0.5rem 0;
}
</style>
