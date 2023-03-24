<template>
    <div>
        <div class="row">
            <errors-modal v-if="errors" :errors="errors" @close="errors=null"></errors-modal>
            <div class="col-md-6">



                <div class="post-header">
                    <h2 class="post-title"><a href="#">{{product.title}}</a></h2>
                </div>
                <div class="post-content">
                    <p>{{product.description}}</p>
                </div>

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
            tags: {},
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
