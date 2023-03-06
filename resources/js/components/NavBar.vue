<template>
    <nav class="navbar sticky-top navbar-expand-lg navbar-green p-0">
        <div class="container px-lg-5">
            <a class="navbar-brand" href="http://localhost:8000/">
                <img src="../../img/logo.png" alt="" />
            </a>
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
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="http://localhost:8000/register"
                            >Registrazione</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link active-yellow"
                            href="http://localhost:8000/login"
                            >Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
export default {};
</script>
<style lang="scss">
img {
    max-width: 100%;
    height: auto;
    width: 50%;
}
.navbar {
    -webkit-box-shadow: 0 8px 6px -6px black;
    -moz-box-shadow: 0 8px 6px -6px black;
    box-shadow: 0 8px 6px -6px black;
}
.navbar-green {
    background-color: #133846;
}

.nav-link {
    color: white;
}
.nav-link:hover {
    color: #ffac44;
}
.active-yellow {
    color: #ffac44;
}
.active-yellow:hover {
    color: white;
}
</style>
