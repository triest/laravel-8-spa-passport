<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">
            <errors-modal v-if="errors" :errors="errors" @close="errors=null"></errors-modal>
            <div class="col-md-6">
                <form @submit.prevent="addProduct">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" v-model="product.title">
                    </div>
                    <div class="form-group">
                        <label>Детали</label>
                        <textarea type="text" class="form-control" v-model="product.description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
                    <router-link :to="{name: 'index'}" >Главная</router-link>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import ErrorsModal from "../ErrorsModal.vue";
import TagList from "./TagList.vue";
export default {
    components:{
        ErrorsModal,
        TagList
    },
    data() {
        return {
            product: {},
            errors: null,
            modalOpen: true
        }
    },
    methods: {
        clouseModal(){

        },
        addProduct() {
            this.axios
                .post('/api/post', this.product)
                .then(response => (
                    this.$router.push({name: 'index'})
                ))
                .catch(err => {
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors;
                    }
                })
                .finally(() => this.loading = false)
        }
    }
}
</script>
