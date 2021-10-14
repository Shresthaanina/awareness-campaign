<template>
    <section class="category">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-left">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="card-title">
                                        My Profile
                                    </h3>
                                </div>
                            </div>
                        </div><!-- end header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form @submit.prevent="updateProfileData">
                                    <div class="form-group row mb-3">
                                        <label for="" class="col-sm-4 col-form-label">Image</label>
                                        <div class="col-md-8">
                                            <div class="img-preview" v-if="user.imageUrl">
                                                <img :src="user.imageUrl" @error="setAltImage">
                                                <div><span class="btn btn-sm" @click="removeFile">Remove</span></div>
                                            </div>
                                            <input v-else type="file" class="form-control" @change="fileSelected">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="" class="col-sm-4 col-form-label">Name</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" v-model="user.name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="" class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-md-8">
                                            <input type="email" class="form-control" v-model="user.email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="" class="col-sm-4 col-form-label">Phone Number</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" v-model="user.phone_no" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="offset-sm-4 col-md-2">
                                            <button type="submit" class="btn btn-primary" :disabled="isSubmitting">Update <img v-if="isSubmitting" src="@/assets/images/spinner.svg" style="height:23px; position:absolute;"></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- end card body -->
                    </div>
                </div>
            </div>
            <!-- card end -->
        </div>
    </section>
</template>
<script>
import userPlaceholderImage from '@/assets/images/user-placeholder.png'
import UserMenu from "@/components/UserMenu"
import { mapActions } from "vuex"
export default {
    components: { UserMenu },
    data() {
        return {
            user: {
                name: '',
                email: '',
                phone_no: '',
                image: '',
                imageUrl: ''
            },
            userPath: process.env.VUE_APP_USER_PATH,
            db_errors: null,
            isSubmitting: false,
        }
    },
    mounted() {
        let accountDetail = this.$store.state.auth.accountDetail
        this.user.name = accountDetail.name
        this.user.email = accountDetail.email
        this.user.phone_no = accountDetail.phone_no
        this.user.imageUrl = this.userPath + accountDetail.image
    },
    methods: {
        ...mapActions('auth', [
            'updateProfile',
        ]),
        fileSelected(e) {
            const file = e.target.files[0];
            this.user.image = file;
            this.user.imageUrl = URL.createObjectURL(file);
        },
        removeFile() {
            this.user.imageUrl = null
            this.user.image = ''
        },
        setAltImage(e){
            e.target.src = userPlaceholderImage
        },
        updateProfileData() {
            this.db_errors = null
            this.isSubmitting = true
            let formData = new FormData()
            formData.append('_method', 'PATCH');
            formData.append('name', this.user.name);
            formData.append('email', this.user.email);
            if (this.user.phone_no != '' && this.user.phone_no != null) {
                formData.append('phone_no', this.user.phone_no);
            }
            if (this.user.image != '') {
                formData.append('image', this.user.image, this.user.image.name);
            }
            this.$store.dispatch('auth/updateProfile', formData)
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
                })
        }
    }
}
</script>
<style>
.img-preview {
    display: flex;
}

.img-preview img {
    width: 100px;
    height: 100px;
    object-fit: contain;
}

.invalid-feedback {
    display: block;
    text-align: left;
}
</style>