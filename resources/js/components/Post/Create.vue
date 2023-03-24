<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">
            <errors-modal v-if="errors" :errors="errors" @close="errors=null"></errors-modal>
            <div class="col-md-6">
                <form @submit.prevent="addPost">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" v-model="product.title">
                    </div>
                    <div class="form-group">
                        <label>Детали</label>
                        <textarea type="text" class="form-control" v-model="product.description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
                    <router-link :to="{name: 'index'}">Главная</router-link>
                </form>
            </div>
            <button @click="showInputTag"> Добавить тег</button>
            <div v-if="inPutShow">
                <label>Введите тег</label>
                <input v-model="searchTagName" v-on:input="searchTag">
                <span v-for="searchingTag in searchingTags">
                            <button @click="addTag(searchingTag)">{{ searchingTag.title }}</button>
                        </span>
            </div>
            <div v-for="tag in postTags">
                {{ tag.title }}
                <button @click="deleteTag(tag.id)">Удалить</button>
            </div>
        </div>
    </div>
</template>

<script>
import ErrorsModal from "../ErrorsModal.vue";
import TagList from "./TagList.vue";

export default {
    components: {
        ErrorsModal,
        TagList
    },
    data() {
        return {
            product: {},
            errors: null,
            modalOpen: true,
            tags: [],
            tagsId: [],
            inPutShow: false,
            searchTagName: null,
            searchingTags: [],
            postTags: []
        }
    },
    methods: {
        getTags() {
            this.axios
                .get(`/api/tag`)
                .then((res) => {
                    this.tags = res.data.data;
                });
        },
        addTag(tag) {
            this.tagsId.push(tag.id);
            this.postTags.push(tag)
        },
        deleteTag(tag_id) {
            this.postTags = this.postTags.filter(function (item) {
                return item.id !== tag_id;
            });
        },
        addPost() {
            let that = this;
            this.axios
                .post('/api/post', {data:this.product,tags: this.tagsId})
                .then(response => function () {
                    console.log(response.data)
                    this.$router.push({name: 'index'})
                })
                .catch(err => {
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors;
                    }
                })
                .finally(() => function () {
                    this.addTagToPost()
                    this.$router.push({name: 'index'})
                })
            this.$router.push({name: 'index'})
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
                    this.searchingTags = res.data.data
                })
            ;
        },
    }
}
</script>
