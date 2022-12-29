<template>
    <div>
        <div class="row">

            <div class="col-md-6">

                <h1 class="display-5 fw-bold">{{ product.title }}</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead mb-4">{{ product.description }}</p>

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
            errors: null,
            modalOpen: true
        }
    },
    mounted() {
        console.log("mount view")
        this.getPost();
    },
    methods: {
        getPost() {
            console.log(this.$route.params.id);
            this.axios
                .get(`/api/post/${this.$route.params.id}`)
                .then((res) => {
                    this.product = res.data.data;
                });
        },
    }
}
</script>
