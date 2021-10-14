<template>
    <!-- <div class="section">
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
    </div> -->
    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">				
                <div class="box box-border">
                    <div class="box-body">
                        <h4>Register</h4>
                        <form @submit.prevent="register">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" v-model="user.name" class="form-control" placeholder="Name">
                                <span class="invalid-feedback" style="display:block;" role="alert" v-if="db_error && db_error.name">{{ db_error.name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" v-model="user.email" class="form-control" placeholder="Email">
                                <span class="invalid-feedback" style="display:block;" role="alert" v-if="db_error && db_error.email">{{ db_error.email[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" v-model="user.phone_no" class="form-control" placeholder="Phone Number">
                                <span class="invalid-feedback" style="display:block;" role="alert" v-if="db_error && db_error.phone_no">{{ db_error.phone_no[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="fw">Password</label>
                                <input type="password" v-model="user.password" class="form-control" placeholder="Password">
                                <span class="invalid-feedback" style="display:block;" role="alert" v-if="db_error && db_error.password">{{ db_error.password[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="fw">Confirm Password</label>
                                <input type="password" v-model="user.confirm_password" class="form-control" placeholder="Confirm Password">
                                <span class="invalid-feedback" style="display:block;" role="alert" v-if="db_error && db_error.confirm_password">{{ db_error.confirm_password[0] }}</span>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-block" :disabled="isSubmitting">Register <img v-if="isSubmitting" src="@/assets/images/spinner.svg" style="height:23px; position:absolute;"></button>
                            </div>
                            <div class="form-group text-center">
                                <span class="text-muted">Already have an account?</span> <router-link :to="{ name: 'login' }">Login</router-link>
                            </div>
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
                name:"",
                phone_no:"",
                email:"",
                password:"",
                confirm_password:"",
            },
            isSubmitting: false,
            db_error: [],
        }
    },
    methods: {
        register() { 
            this.isSubmitting = true
            this.db_error = []
            this.$store.dispatch("auth/register", this.user)
            .then( res => {
                this.$swal({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    title: 'User registered successfully',
                    icon: "success", //built in icons: success, warning, error, info
                    timer: 4000, //timeOut for auto-close
                });
                this.isSubmitting=false
                this.$router.push({ name: "login"})
            })
            .catch(error=> {
                this.isSubmitting=false
                this.db_error = error.errors
            })
        }
    },
}
</script>