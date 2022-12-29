<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://techvblogs.com/blog/spa-authentication-laravel-9-sanctum-vue3-vite" target="_blank">TechvBlogs</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">

                        </li>
                    </ul>
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <ul>
            <li><router-link :to="{name: 'index'}" >Главная1</router-link></li>
            <li><router-link :to="{name: 'create'}" >Создать2</router-link></li>
            <li><router-link :to="{name: 'login'}" >Войти</router-link></li>
            <li><router-link :to="{name: 'register'}" >Регистрация1</router-link></li>
        </ul>

        <div style="margin-left:30%;padding:1px 16px;height:1000px;">
            <router-view></router-view>
        </div>

    </div>
</template>

<script>

import {mapGetters} from 'vuex';
import {mapActions} from 'vuex';

export default {

    data() {
        return {

        }
    },
    computed : {


    },
    mounted() {

        this.example()
    },

    methods: {

        example(){
            console.log("example App2");

        },
        logout() {
            this.axios
                .post('api/logout')
                .then(response => (
                    // this.$router.push({name: 'home'})
                    window.location.href = "/"
                ))
                .catch(err => {
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors;
                    }
                })
                .finally(() => this.loading = false)
        },

    }
}
</script>
