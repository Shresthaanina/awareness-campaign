<template>
    <div class="section post-section pt-5" v-if="!campaignLoading">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="heading text-center">{{ campaign.name }}</h2>
                    <p class="lead mb-4 text-center">{{ campaign.excerpt }}</p>
                    <img :src="campaignPath + campaign.image" @error="setAltImage" alt="Image" class="img-fluid rounded mb-4">
                    {{ campaign.description }}
                    <div class="row mt-5 pt-5 border-top">
                        <div class="col-12">
                            <span class="fw-bold text-black small mb-1">Share</span>
                            <ul class="social list-unstyled">
                                <li><a href="#"><span class="icon-facebook"></span></a></li>
                                <li><a href="#"><span class="icon-twitter"></span></a></li>
                                <li><a href="#"><span class="icon-linkedin"></span></a></li>
                                <li><a href="#"><span class="icon-pinterest"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex"
export default {
    name: "Campaign",
    data() {
        return {
            campaignPath: process.env.VUE_APP_CAMPAIGN_PATH
        }
    },
    computed: {
        ...mapGetters("campaign", ["campaign","campaignLoading"])
    },
    created(){
        this.fetchCampaignDetail(this.$route.params.slug)
    },
    methods: {
        ...mapActions('campaign', [
            'fetchCampaignDetail',
        ]),

        setAltImage(e){
            e.target.src = "https://i.picsum.photos/id/830/400/275.jpg?hmac=atIskX6qKhoQCHr5ZnRJ1MYykoX1zcecOpR11Vwjolk"
        }
    }
}
</script>