<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">

            <div class="col-md-6">
                <form @submit.prevent="addProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <div type="text" class="form-control">{{product.title}}</div>
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <div type="text" class="form-control">{{product.description}}</div>
                    </div>
                    <router-link :to="{name: 'home'}" class="btn btn-success">Back</router-link>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import ErrorsModal from "./ErrorsModal";
export default {
    components:{
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
        getPost(){
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
