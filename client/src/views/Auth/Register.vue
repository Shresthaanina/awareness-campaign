<template>
    <div class="section">
        <div class="container">
            <form @submit.prevent="register">
                <div class="mb-3">
                    <input type="text" v-model="user.name" class="form-control" placeholder="Name">
                    <span v-if="db_error && db_error.name">{{ db_error.name[0] }}</span>
                </div>
                <div class="mb-3">
                    <input type="text" v-model="user.phone_no" class="form-control" placeholder="Phone Number">
                    <span v-if="db_error && db_error.phone_no">{{ db_error.phone_no[0] }}</span>
                </div>
                <div class="mb-3">
                    <input type="email" v-model="user.email" class="form-control" placeholder="Email">
                    <span v-if="db_error && db_error.email">{{ db_error.email[0] }}</span>
                </div>
                <div class="mb-3">
                    <input type="password" v-model="user.password" class="form-control" placeholder="Password">
                    <span v-if="db_error && db_error.password">{{ db_error.password[0] }}</span>
                </div>
                <div class="mb-3">
                    <input type="password" v-model="user.confirm_password" class="form-control" placeholder="Confirm Password">
                    <span v-if="db_error && db_error.confirm_password">{{ db_error.confirm_password[0] }}</span>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
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
                name:"",
                phone_no:"",
                email:"",
                password:"",
                confirm_password:"",
            },
            isLoading: false,
            db_error: [],
        }
    },
    methods: {
        register() { 
            this.isLoading = true
            this.$store.dispatch("auth/register", this.user)
            .then( res => {
                this.loading=false
                this.$router.push({ name: "Login"})
                console.log(res)
                this.$swal({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    title: 'User registered successfully',
                    icon: "success", //built in icons: success, warning, error, info
                    timer: 4000, //timeOut for auto-close
                });
            })
            .catch(error=> {
                this.loading=false
                this.db_error = error.errors
            })
        }
    },
}
</script>