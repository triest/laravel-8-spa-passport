<template>
    <div class="container">
        <ul>
            <li><router-link :to="{name: 'home'}" >Главная1</router-link></li>
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
                .post('/logout')
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
