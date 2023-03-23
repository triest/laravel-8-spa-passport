<template>
    <div class="container">

            <div class="container-fluid">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                        <li>
                    </li>
                        <li>
                            <router-link :to="{name: 'index'}">Главная</router-link>
                        </li>
                        <li>
                            <router-link :to="{name: 'create'}" v-if="checkIsLogin">Создать</router-link>
                        </li>
                        <li>
                            <router-link   :to="{name: 'login'}" v-if="!checkIsLogin" >Войти</router-link>
                        </li>
                        <li>
                            <a  v-on:click="logout()" v-if="checkIsLogin" >Выйти</a>
                        </li>
                        <li>
                            <router-link :to="{name: 'register'}"  v-if="!checkIsLogin">Регистрация
                            </router-link>
                        </li>
                    </ul>
            </div>

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
            authUser: window.authUser,
        }
    },
    computed: {
        checkIsLogin: function (){
            console.log(localStorage.getItem('isLogin'))

            if(localStorage.getItem('isLogin')==='true'){
                console.log('isLogin == true');
                return true;
            }else {
                return  false
            }

        },

    },
    methods: {
        isLoggedIn() {
            return localStorage.getItem("auth");
        },
        logout() {
            this.axios
                .post('/api/logout')
                .then(response => function () {
                    localStorage.setItem('isLogin', false);
                    }
                )
                .catch(err => {
                    localStorage.setItem('isLogin', false);
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors;
                    }
                })
                .finally(() => this.$router.go('index'))
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

.table {
    border: #0a0302;

}
</style>
