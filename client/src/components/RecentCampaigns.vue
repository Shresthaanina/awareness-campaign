<template>
    <aside>
        <h1 class="aside-title">Recent Campaigns</h1>
        <div class="aside-body">
            <article class="article-mini" v-for="(recentCamp,rc) in recentCampaigns" :key="rc">
                <div class="inner">
                <figure>
                    <router-link :to="{ name: 'campaign', params:{ slug : recentCamp.slug}}">
                        <img :src="campaignPath + 'thumbnails/' + recentCamp.image" @error="setAltImage">
                    </router-link>
                </figure>
                <div class="padding">
                <h1><router-link :to="{ name: 'campaign', params:{ slug : recentCamp.slug}}">{{ recentCamp.name }}</router-link></h1>
                    <div class="detail">
                        <!-- <div class="category"><a href="category.html">Lifestyle</a></div> -->
                        <div class="time">{{ formatDate(recentCamp.start_date) }}</div>
                    </div>
                </div>
                </div>
            </article>
        </div>
    </aside>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import * as moment from "moment/moment";
export default {
    data() {
        return {
            campaignPath: process.env.VUE_APP_CAMPAIGN_PATH,
        }
    },
    computed: {
        ...mapGetters("campaign", ["recentCampaigns","recentCampaignLoading"]),
    },
    created(){
		this.fetchRecentCampaigns()
    },
    methods: {
        ...mapActions('campaign', [
            'fetchRecentCampaigns',
        ]),
        setAltImage(e){
            e.target.src = "https://i.picsum.photos/id/691/300/215.jpg?hmac=y8rHB4E2US1Q8hpawpEAGFrgDqj6j0DqZp9mUhdZDZM"
        },
        formatDate(val){
			if(val){
				return moment(val).format('ll');
			}
		},
    }
}
</script>