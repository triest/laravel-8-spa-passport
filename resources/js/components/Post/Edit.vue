<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <errors-modal v-if="errors" :errors="errors" @close="errors=null"></errors-modal>
            <div class="col-md-6">
                <form @submit.prevent="updateProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="post.title">
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input type="text" class="form-control" v-model="post.description">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <router-link :to="{name: 'index'}" class="btn btn-success">Back</router-link>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import ErrorsModal from "../ErrorsModal.vue";
export default {
    components:{
        ErrorsModal
    },
    data() {
        return {
            post: {},
            errors: null,
        }
    },
    created() {
       this.getPost();
    },
    methods: {
        updateProduct() {
            this.axios
                .patch(`/api/post/${this.$route.params.id}`, this.post)
                .then((res) => {
                    this.$router.push({ name: 'index' });
                }) .catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },
        getPost(){

            this.axios
                .get(`/api/post/${this.$route.params.id}`)
                .then((res) => {
                    this.post = res.data.data;

                });
        }
    }
}
</script>
