<template>
    <div class="text-center" style="margin: 20px 0px 20px 0px">
        <h1 class="text-bold">Laravel Crud</h1>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
        <div class="container">
            <div class="collapse navbar-collapse">
                <!-- for logged-in user-->
                <div class="navbar-nav" v-if="isLoggedIn">
                    <router-link
                        to="/dashboard"
                        class="nav-item nav-link text-white"
                        >Dashboard</router-link
                    >
                    <router-link
                        to="/posts"
                        class="nav-item nav-link text-white"
                        >Posts</router-link
                    >
                </div>
                <div class="navbar-nav ml-auto" v-if="isLoggedIn">
                    <router-link
                        to="/register"
                        class="nav-item nav-link text-white mr-auto"
                        >Register new User
                    </router-link>
                    <a
                        class="nav-item nav-link text-white"
                        style="cursor: pointer"
                        @click="logout"
                        >Logout</a
                    >
                </div>
                <!-- for non-logged user-->
                <div class="navbar-nav" v-else>
                    <router-link to="/" class="nav-item nav-link text-white"
                        >Home</router-link
                    >
                    <router-link
                        to="/login"
                        class="nav-item nav-link text-white"
                        >login</router-link
                    >
                </div>
            </div>
        </div>
    </nav>
    <br />
    <div class="container">
        <router-view />
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        };
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true;
        }
    },
    methods: {
        logout(e) {
            console.log("ss");
            e.preventDefault();
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .post("/api/logout")
                    .then((response) => {
                        if (response.data.success) {
                            window.location.href = "/";
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        },
    },
};
</script>
