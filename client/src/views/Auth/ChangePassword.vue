<template>
    <section class="category">
		<div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                        <p class="page-subtitle"><strong>Update Password</strong></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form @submit.prevent="updateAccountPassword">
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-4 col-form-label">Old Password</label>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control" v-model="password.old_password" placeholder="Old Password">
                                        <span class="invalid-feedback" style="display:block;" v-if="db_errors && db_errors.old_password">{{ db_errors.old_password[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-4 col-form-label">New Password</label>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control" v-model="password.new_password" placeholder="New Password">
                                        <span class="invalid-feedback" style="display:block;" v-if="db_errors && db_errors.new_password">{{ db_errors.new_password[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-4 col-form-label">Confirm New Password</label>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control" v-model="password.confirm_password" placeholder="Confirm Password">
                                        <span class="invalid-feedback" style="display:block;" v-if="db_errors && db_errors.confirm_password">{{ db_errors.confirm_password[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-sm-4 col-md-2">
                                        <button type="submit" class="btn btn-primary" :disabled="isSubmitting">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapActions } from "vuex"
export default {
    data() {
        return {
            password:{
                old_password:'',
                new_password:'',
                confirm_password:'',
            },
            db_errors: null,
            isSubmitting: false,
        }
    },

    methods: {
        ...mapActions('auth', [
            'updatePassword',
        ]),
        
        updateAccountPassword(){
            this.db_errors = null
            this.isSubmitting = true
            this.$store.dispatch('auth/updatePassword', this.password)
            .then(res => {
                this.isSubmitting = false
                this.$swal({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    title: res.message,
                    icon: "success", //built in icons: success, warning, error, info
                    timer: 4000, //timeOut for auto-close
                });
            })
            .catch(error => { 
                this.db_errors = error.errors
                this.isSubmitting = false
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
    }
}
</script>