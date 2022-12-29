<template>
    <div>
        <h2 class="text-center">Посты</h2>

        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Название</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="product in products" :key="product.id">
                <td>{{ product.title }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'view', params: { id: product.id }}" class="btn btn-success">Смотреть
                        </router-link>
                    </div>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: product.id }}" class="btn btn-success">Edit</router-link>
                    </div>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    data() {
        return {
            products: []
        }
    },
    created() {
        this.axios
            .get('/api/post/')
            .then(response => {
                this.products = response.data.data;
            });
    },
    mounted() {
    },
    methods: {
        deleteProduct(id) {
            let result = window.confirm("Delete product?");
            if (!result) {
                return;
            }
            this.axios
                .delete(`/api/products/${id}`)
                .then(response => {
                    let i = this.products.map(data => data.id).indexOf(id);
                    this.products.splice(i, 1)
                });
        }
    }
}
</script>
