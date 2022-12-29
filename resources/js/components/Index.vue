<template>
    <div>
        <h2 class="text-center">Products List</h2>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Detail</th>
                <!-- <th>Actions</th> -->
            </tr>
            </thead>
            <tbody>
            <div v-for="product in products" :key="product.id">
                <td>{{ product.title }}</td>
                <td>{{ product.detail }}</td>
            </div>
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
        console.log(this.products)
    },
    mounted() {
        console.log("products")
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
