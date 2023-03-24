<template>
    <div>
        <h2 class="text-center">Посты1</h2>

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
                        <router-link :to="{name: 'edit', params: { id: product.id }}" class="btn btn-success">Редактировать</router-link>
                    </div>
                <div class="btn-group" role="group">
                    <button class="btn btn-danger" @click="deletePost(product.id)">Удалить</button>
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
       this.getPosts();
    },
    mounted() {
    },
    methods: {

        getPosts(){
            this.axios
                .get('/api/post/')
                .then(response => {
                    this.products = response.data.data;
                });
        },

        deletePost(id) {
            let result = window.confirm("Удалить пост?");
            if (!result) {
                return;
            }
            this.axios
                .delete(`/api/post/${id}`)
                .then(response => {
                    this.getPosts();
                });
            this.getPosts();
        }
    }
}
</script>
