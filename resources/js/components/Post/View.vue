<template>
    <div>
        <div class="row">
            <errors-modal v-if="errors" :errors="errors" @close="errors=null"></errors-modal>
            <div class="col-md-6">

                <h1 class="display-5 fw-bold">{{ product.title }}</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead mb-4">{{ product.description }}</p>
                </div>
                <button class="btn btn-danger" @click="deleteProduct(product.id)">Удалить</button>
                <router-link :to="{name: 'index'}" >Главная</router-link>

            </div>
        </div>
    </div>
</template>

<script>
import ErrorsModal from "../ErrorsModal.vue";

export default {
    components: {
        ErrorsModal
    },
    data() {
        return {
            product: {},
            errors: null,
            modalOpen: true
        }
    },
    mounted() {
        this.getPost();
    },
    methods: {
        getPost() {
            this.axios
                .get(`/api/post/${this.$route.params.id}`)
                .then((res) => {
                    this.product = res.data.data;
                });
        },
        deleteProduct(id) {
            let  result = window.confirm("Удалить пост?");
            if(!result){
                return ;
            }
            this.axios
                .delete(`/api/post/${id}`)
                .then(response => {
                    this.$router.push({name: 'index'})
                }).catch((error) => {
                if (error.response !== undefined && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            });
        }
    }
}
</script>
