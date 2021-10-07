<template>
    <div class="section pt-5">
        <div class="container">
            <div class="row">
                <user-menu />
                <div class="col-lg-8 ">
                    <div class="row mb-5">
                        <div class="col-lg-12">
                            <h2>My Campaigns</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" v-for="(campaign,k) in campaigns" :key="k">
                            <div class="post-entry d-md-flex small-horizontal mb-5">
                                <div class="me-md-5 thumbnail mb-3 mb-md-0">
                                    <router-link :to="{ name: 'campaign', params:{ slug : campaign.slug}}">
                                        <img :src="campaignPath + 'thumbnails/' +campaign.image" @error="setAltImage" alt="Image" class="img-fluid"/>
                                    </router-link>
                                </div>
                                <div class="content">
                                    <div class="post-meta mb-3">
                                        <span>By {{ campaign.created_by.name }}</span> —
                                        <span class="date">July 2, 2020</span>
                                        <router-link :to="{ name: 'edit-campaign', params: { slug:campaign.slug } }" class="float-right">Edit</router-link>
                                    </div>
                                    <h2 class="heading"><router-link :to="{ name: 'campaign', params:{ slug : campaign.slug}}">{{ campaign.name }}</router-link></h2>
                                    <p>{{ campaign.excerpt }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import UserMenu from "@/components/UserMenu"
import { mapGetters, mapActions } from "vuex"
export default {
    components: { UserMenu },
    data() {
        return {
            campaignPath: process.env.VUE_APP_CAMPAIGN_PATH
        }
    },
    
    computed: {
        ...mapGetters("campaign", ["campaignLoading","campaigns"])
    },

    created(){
        this.fetchCampaigns()
    },

    methods: {
        ...mapActions('campaign', [
            'fetchCampaigns',
        ]),

        setAltImage(e){
            e.target.src = "https://i.picsum.photos/id/830/400/275.jpg?hmac=atIskX6qKhoQCHr5ZnRJ1MYykoX1zcecOpR11Vwjolk"
        }
    }
}
</script>

<style scoped>
    .content {
        width: 100%;
        text-align: left;
    }
</style>