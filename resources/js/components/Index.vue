<template>
    <div>
        <h2 class="text-center">Посты1</h2>
        <router-link :to="{name: 'create'}" class="btn btn-success">Создать</router-link>
        <span v-if="checkIsLogin">
        <input type="checkbox" id="checkbox" v-model="myPostsFilter" @click="getPosts()">
        <label for="checkbox">Мои посты</label>
        </span>
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Название</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="post in posts" :key="post.id">
                <td>{{ post.title }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'view', params: { id: post.id }}" class="btn btn-success">Смотреть
                        </router-link>
                    </div>
                </td>
                <td>
                    <span v-for="(tag, index) in post.tags">
                        <span v-if="index != 0">, </span><span>{{ tag.title }}</span>
                    </span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-success">
                            Редактировать
                        </router-link>
                    </div>
                    <div class="btn-group" role="group">
                        <button class="btn btn-danger" @click="deletePost(post.id)">Удалить</button>
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
            posts: [],
            myPostsFilter: true
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
    mounted() {
        this.getPosts()
    },
    methods: {

        getPosts() {
            let params = {}
            if (this.myPostsFilter === false) {
                params = {my: true};
            }
            this.axios
                .get('/api/post/', {params: params})
                .then(response => {
                    this.posts = response.data.data;
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
