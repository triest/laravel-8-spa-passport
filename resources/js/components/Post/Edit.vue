<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <errors-modal v-if="errors" :errors="errors" @close="errors=null"></errors-modal>
            <div class="col-md-6">
                <form @submit.prevent="updatePost">
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
                <div v-for="tag in postTags">
                    {{ tag.title }}
                    <button @click="deleteTag(tag.id)">Удалить</button>
                </div>
            </div>
            <button @click="showInputTag"> Добавить тег</button>
            <div v-if="inPutShow">
                <label>Введите тег</label>
                <input v-model="searchTagName" v-on:input="searchTag">
                <span v-for="searchingTag in serchingTags">
                            <button @click="addTag(searchingTag.id)">{{ searchingTag.title }}</button>
                        </span>
            </div>

        </div>
    </div>
</template>

<script>
import ErrorsModal from "../ErrorsModal.vue";

export default {
    components: {
        ErrorsModal,
        //    TagList
    },
    data() {
        return {
            post: {},
            tags: {},
            tagsId: [],
            postTags: [],
            errors: null,
            inPutShow: false,
            searchTagName: null,
            serchingTags: {}
        }
    },
    created() {
        this.getPost();
        this.getTags()
    },
    methods: {
        updatePost() {
            this.axios
                .put(`/api/post/${this.$route.params.id}`, this.post)
                .then((res) => {
                    this.$router.push({name: 'index'});
                }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },
        getTags() {
            this.axios
                .get(`/api/tag`)
                .then((res) => {
                    this.tags = res.data.data;
                });
        },
        getPost() {

            this.axios
                .get(`/api/post/${this.$route.params.id}`)
                .then((res) => {

                    this.post = res.data.data;
                    let that = this;
                    this.postTags = this.post.tags;
                    this.post.tags.forEach(function (item) {
                        that.tagsId.push(item.id)

                    })
                });
        },
        showInputTag() {
            this.inPutShow = !this.inPutShow;
        },


        searchTag() {
            const params = {
                query: this.searchTagName
            }

            this.axios.get('/api/tag', {params})
                .then((res) => {
                    this.serchingTags = res.data.data
                })
            ;
        },
        addTag(tag_id) {
            this.tagsId.push(tag_id);
            this.axios.post('/api/post/' + this.post.id + '/tag/bulk',  {data: this.tagsId})
                .then((res) => {
                    this.getTags()
                    this.getPost()
                })
        },
        deleteTag(tag_id) {
            this.tagsId = this.tagsId.filter(function (item) {
                return item !== tag_id;
            });

            this.axios.post('/api/post/' + this.post.id + '/tag/bulk',
                {data: this.tagsId}
            )
                .then((res) => {
                    this.getTags()
                    this.getPost()
                })
        }

    }
}
</script>
