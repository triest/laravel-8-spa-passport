<template>
    <div>
        <h2 class="text-center">Посты1</h2>
        <router-link :to="{name: 'create'}" class="btn btn-success">Создать</router-link>
        <span v-if="checkIsLogin">
        <input type="checkbox" id="checkbox" v-model="myPostsFilter" @click="getPosts()">
        <label for="checkbox">Мои посты</label>
        </span>


            <span v-for="post in posts" :key="post.id">
                    <div class="post-header">
                        <h2 class="post-title"><router-link :to="{name: 'view', params: { id: post.id }}" href="">{{post.title}}</router-link></h2>
                    </div>

                    <div class="post-preview">
                        <a href="#"><img src="images/blog/blog-1.jpg" alt="" class="img-fluid rounded"></a>
                    </div>


                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'view', params: { id: post.id }}" class="btn btn-success">Смотреть
                        </router-link>
                    </div>

                    <span v-for="(tag, index) in post.tags">
                        <span v-if="index != 0">, </span><span>{{ tag.title }}</span>
                    </span>

                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-success">
                            Редактировать
                        </router-link>
                    </div>
                    <div class="btn-group" role="group">
                        <button class="btn btn-danger" @click="deletePost(post.id)">Удалить</button>
                    </div>

            </span>

    </div>
</template>

<script>

export default {
    data() {
        return {
            posts: [],
            myPostsFilter: false
        }
    },
    computed: {
        checkIsLogin: function (){
            console.log(localStorage.getItem('isLogin'));
            console.log(localStorage.getItem('user_id'));
            if(localStorage.getItem('user_id')!== undefined){
                console.log()
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
