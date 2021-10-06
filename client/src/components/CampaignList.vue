<template>
    <div class="section">
      <div class="container">
        <div class="row g-5">
          <div class="col-lg-4" v-for="(campaign,k) in campaigns" :key="k">
            <div class="post-entry d-block small-post-entry-v">
              <div class="thumbnail">
                <router-link :to="{ name: 'campaign', params:{ slug : campaign.slug}}">
                  <img :src="campaignPath + 'thumbnails/' +campaign.image" @error="setAltImage" alt="Image" class="img-fluid"/>
                </router-link>
              </div>
              <div class="content">
                <div class="post-meta mb-1">
                    <span>By {{ campaign.created_by.name }}</span> —
                    <span class="date">July 2, 2020</span>
                </div>
                <h2 class="heading mb-3">
                  <router-link :to="{ name: 'campaign', params:{ slug : campaign.slug}}">{{ campaign.name }}</router-link>
                </h2>
                <p>{{ campaign.excerpt }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
    name:"CampaignList",
    data() {
        return {
            campaignPath: process.env.VUE_APP_CAMPAIGN_PATH
        }
    },
    computed: {
        ...mapGetters("campaign", ["campaigns"])
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