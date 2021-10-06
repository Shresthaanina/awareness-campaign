<template>
    <div class="section">
        <div class="container">
            <form @submit.prevent="login">
                <div class="input-group mb-3">
                    <input type="email" v-model="user.email" class="form-control" placeholder="Email">
                    <span class="invalid-feedback" style="display:block;" role="alert" v-if="db_error && db_error.email">
                        <strong>{{ db_error.email[0] }}</strong>
                    </span>
                </div>
                <div class="input-group mb-3">
                    <input type="password" v-model="user.password" class="form-control" placeholder="Password">
                    <span class="invalid-feedback" style="display:block;" role="alert" v-if="db_error && db_error.password">
                        <strong>{{ db_error.password[0] }}</strong>
                    </span>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                email:"",
                password:""
            },
            isLoading: false,
            db_error: [],
        }
    },
    methods: {
        login() {
            this.isLoading = true
            this.$store.dispatch("auth/login", this.user)
            .then( res => {
                this.loading=false
                this.$router.push({ name: "Home"})
                console.log(res)
            })
            .catch(error=> {
                this.loading=false
                this.db_error = error.errors
            })
        }
    },
}
</script>