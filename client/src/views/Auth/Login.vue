<template>
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">				
                <div class="box box-border">
                    <div class="box-body">
                        <h4>Login</h4>
                        <form @submit.prevent="login">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="email" v-model="user.email" class="form-control" placeholder="Email">
                                <span class="invalid-feedback" style="display:block;" role="alert" v-if="db_error && db_error.email">
                                    <strong>{{ db_error.email[0] }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="fw">Password
                                    <!-- <a href="forgot.html" class="pull-right">Forgot Password?</a> -->
                                </label>
                                <input type="password" v-model="user.password" class="form-control" placeholder="Password">
                                <span class="invalid-feedback" style="display:block;" role="alert" v-if="db_error && db_error.password">
                                    <strong>{{ db_error.password[0] }}</strong>
                                </span>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-block" :disabled="isSubmitting">Login <img v-if="isSubmitting" src="@/assets/images/spinner.svg" style="height:23px; position:absolute;"></button>
                            </div>
                            <div class="form-group text-center">
                                <span class="text-muted">Don't have an account?</span> <router-link :to="{ name: 'register' }">Create one</router-link>
                            </div>
                            <!-- <div class="title-line">
                                or
                            </div>
                            <a href="#" class="btn btn-social btn-block facebook"><i class="ion-social-facebook"></i> Login with Facebook</a> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            user: {
                email:"",
                password:""
            },
            db_error: [],
            isSubmitting: false,
        }
    },
    methods: {
        login() {
            this.isSubmitting = true
            this.$store.dispatch("auth/login", this.user)
            .then( res => {
                this.isSubmitting=false
                this.$router.push({ name: "home"})
                console.log(res)
            })
            .catch(error=> { 
                this.isSubmitting=false
                this.db_error = error.errors
                this.$swal({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    title: error.message,
                    icon: "error", //built in icons: success, warning, error, info
                    timer: 4000, //timeOut for auto-close
                });
            })
        }
    },
}
</script>