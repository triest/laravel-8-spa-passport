<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                        <li><router-link :to="{name: 'index'}" >Главная</router-link></li>
                        <li><router-link :to="{name: 'create'}"  v-if="authUser !== undefined" >Создать</router-link></li>
                        <li><router-link :to="{name: 'login'}"  v-if="authUser === undefined" >Войти</router-link></li>
                        <li><button  v-on:click="logout()" >Выйти</button></li>
                        <li><router-link :to="{name: 'register'}"  v-if="authUser !== undefined" >Регистрация</router-link></li>

                    </ul>
                </div>
            </div>
        </nav>


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
            authUser: window.authUser
        }
    },
    computed : {


    },
    mounted() {
    },

    methods: {
        logout() {
            this.axios
                .post('/api/logout')
                .then(response => function() {
                    localStorage.removeItem('x_xsrf_token')
                    this.$router.push({name: 'home'})

                    }
                )
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

<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: auto;
    background-color: #f1f1f1;
    position: fixed;
    /*  height: 100%;*/
    margin-top: 5%;
    margin-left: 10%;
    overflow: auto;
}
li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}
li a.active {
    background-color: #04AA6D;
    color: white;
}
li a:hover:not(.active) {
    background-color: #555;
    color: white;
}

.table{
    border: #0a0302;

}
</style>
