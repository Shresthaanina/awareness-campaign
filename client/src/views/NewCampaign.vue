<template>
    <section class="category">
		<div class="container">
            <div class="row">
                <div class="col-md-8 text-left">
                    <div class="row">
                        <div class="col-md-12">
                        <h1 class="page-title">All Campaigns</h1>
                        <p class="page-subtitle">Showing all campaigns</p>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <form @submit.prevent="submitCampaign">
                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" v-model="campaign.name" placeholder="Name">
                                        <span class="invalid-feedback" v-if="db_errors && db_errors.name">{{ db_errors.name[0] }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="" class="col-sm-2 col-form-label">Location</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" v-model="campaign.location" placeholder="Location">
                                        <span class="invalid-feedback" v-if="db_errors && db_errors.location">{{ db_errors.location[0] }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" v-model="campaign.start_date">
                                        <span class="invalid-feedback" v-if="db_errors && db_errors.start_date">{{ db_errors.start_date[0] }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">End Date</label>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" v-model="campaign.end_date">
                                        <span class="invalid-feedback" v-if="db_errors && db_errors.end_date">{{ db_errors.end_date[0] }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-md-10">
                                        <div class="img-preview" v-if="campaign.imageUrl">
                                            <img :src="campaign.imageUrl" >
                                            <div><span class="btn btn-sm" @click="removeFile">Remove</span></div>
                                        </div>
                                        <input v-else type="file" class="form-control" @change="fileSelected">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="" class="col-sm-2 col-form-label">Excerpt</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" rows="3" v-model="campaign.excerpt"></textarea>
                                        <span class="invalid-feedback" v-if="db_errors && db_errors.excerpt">{{ db_errors.excerpt[0] }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-md-10">
                                        <ckeditor :editor="editor" v-model="campaign.description" ></ckeditor>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-sm-2 col-md-2">
                                        <button type="submit" class="btn btn-primary" :disabled="campaignLoading">{{ campaign.id != '' ? 'Update' : 'Create' }}</button>
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
import UserMenu from "@/components/UserMenu"
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { mapGetters, mapActions } from "vuex"
export default {
    components: { UserMenu },
    data() {
        return {
            campaign: {
                id:'',
                name:'',
                location:'',
                excerpt:'',
                description:'',
                image:'',
                imageUrl:'',
                start_date:'',
                end_date:'',
            },
            campaignPath: process.env.VUE_APP_CAMPAIGN_PATH,
            db_errors: null,
            editor: ClassicEditor
        }
    },

    computed: {
        ...mapGetters("campaign", ["campaignLoading"])
    },

    created(){
        let campaignSlug = this.$route.params.slug;
        if(campaignSlug){
            this.fetchCampaignDetail(campaignSlug)
            .then(res => {
                this.campaign.id = res.id
                this.campaign.name = res.name
                this.campaign.location = res.location
                this.campaign.excerpt = res.excerpt
                this.campaign.description = res.description
                this.campaign.start_date = res.start_date
                this.campaign.end_date = res.end_date
                this.campaign.imageUrl = this.campaignPath + res.image
            });
        }
    },

    methods: {
        ...mapActions('campaign', [
            'createCampaign',
            'updateCampaign',
            'fetchCampaignDetail',
        ]),

        fileSelected(e){
            const file = e.target.files[0];
            this.campaign.image = file;
            this.campaign.imageUrl = URL.createObjectURL(file);
        },
        removeFile(){
            this.campaign.imageUrl = null
            this.campaign.image = ''
        },

        submitCampaign(){
            this.db_errors = null
            let formData = new FormData()
            formData.append('name', this.campaign.name);
            formData.append('location', this.campaign.location);
            formData.append('start_date', this.campaign.start_date);
            formData.append('end_date', this.campaign.end_date);
            formData.append('excerpt', this.campaign.excerpt);
            formData.append('description', this.campaign.description);
            formData.append('is_active', '1');
            if(this.campaign.image != ""){
                if(this.campaign.image.manuallyAdded != true){
                    formData.append('image', this.campaign.image, this.campaign.image.name);
                }
            }
            if(this.campaign.id != ''){
                formData.append('_method', 'PATCH')
                let campaignId = this.campaign.id
                this.updateCampaign({ id:campaignId, formData:formData })
                .then(res => {
                    this.$swal({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        title: res.message,
                        icon: "success", //built in icons: success, warning, error, info
                        timer: 4000, //timeOut for auto-close
                    });
                    this.$router.push({name: 'my-campaigns'})
                })
                .catch(error => {
                    this.db_errors = error.data.errors;
                })
            }else {
                this.createCampaign(formData)
                .then(res => {
                    this.$swal({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        title: res.message,
                        icon: "success", //built in icons: success, warning, error, info
                        timer: 4000, //timeOut for auto-close
                    });
                    this.$router.push({name: 'my-campaigns'})
                })
                .catch(error => {
                    this.db_errors = error.data.errors;
                })
            }
        }
    }
}
</script>

<style >
    .img-preview {
        display: flex;
    }
    .img-preview img{
        width: 200px;
        height: 136px;
        object-fit: contain;
    }
    .invalid-feedback {
        display: block;
        text-align: left;
    }
</style>