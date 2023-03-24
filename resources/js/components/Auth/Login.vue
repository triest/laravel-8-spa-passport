<template>
    <form @submit.prevent="saveForm" novalidate>


        <div class="form-group">
            <label for="exampleInputEmail1">Email2 1</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Enter email" v-model="form.email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                   v-model="form.password">
        </div>
        <div class="p-2 w-full mt-4">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</template>
<script>

export default {
    components: {},
    data() {
        return {
            form: {

                email: '',
                password: '',
            },
            errors: null
        }
    },
    methods: {
        saveForm() {
            this.axios.post('/api/login', this.form).then((r) => {
                localStorage.setItem('isLogin', true);
                localStorage.setItem('token', r.data.token);
                localStorage.setItem('user.id', r.data.user.id);
                localStorage.setItem('user.login', r.data.user.login);
                this.$router.push({name: 'index'})
            }).catch((error) => {
                console.log("false")
               // localStorage.setItem('isLogin', false);
            })

        }
    }
}
</script>
