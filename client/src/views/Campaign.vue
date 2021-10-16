<template>
    <section class="single">
        <div class="container">
            <div class="row">
                <div class="col-md-4 sidebar" id="sidebar">
                    <aside>
                        <div class="aside-body">
                            <figure class="ads">
                                <img src="@/assets/images/promo.png">
                                <figcaption>Advertisement</figcaption>
                            </figure>
                        </div>
                    </aside>
                    <recent-campaigns />
                </div>
                <div class="col-md-8" v-if="!campaignLoading">
                    <!-- <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Film</li>
                    </ol> -->
                    <article class="article main-article">
                        <header>
                            <h1>{{ campaign.name }}</h1>
                            <ul class="details">
                                <li>Posted on {{ formatDate(campaign.start_date) }}</li>
                                <li v-if="campaign.category"><a>{{ campaign.category.name }}</a></li>
                                <li>By <a href="#">{{ campaign.created_by.name }}</a></li>
                            </ul>
                        </header>
                        <div class="main">
                            <p>{{ campaign.excerpt }}</p>
                            <div class="featured">
                                <figure>
                                    <img :src="campaignPath + campaign.image">
                                </figure>
                            </div>

                            <p v-html="campaign.description"></p>
                        </div>
                    </article>
                    <div class="sharing">
                        <div class="title"><i class="ion-android-share-alt"></i> Sharing is caring</div>
                        <ul class="social">
                            <li>
                                <a href="#" class="facebook">
                                    <i class="ion-social-facebook"></i> Facebook
                                </a>
                            </li>
                            <li>
                                <a href="#" class="twitter">
                                    <i class="ion-social-twitter"></i> Twitter
                                </a>
                            </li>
                            <!-- <li>
                                <a href="#" class="skype">
                                    <i class="ion-ios-email-outline"></i> Email
                                </a>
                            </li> -->
                            <!-- <li class="count">
                                20
                                <div>Shares</div>
                            </li> -->
                        </ul>
                    </div>
                    <div class="line">
                        <div>Organizer</div>
                    </div>
                    <div class="author">
                        <figure>
                            <img :src="userPath + campaign.created_by.image" @error="setUserPlaceholderImage">
                        </figure>
                        <div class="details">
                            <!-- <div class="job">Web Developer</div> -->
                            <h3 class="name">{{ campaign.created_by.name }}</h3>
                            <p>Email: {{ campaign.created_by.email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import userPlaceholderImage from '@/assets/images/user-placeholder.png'
import { mapGetters, mapActions } from "vuex"
import * as moment from "moment/moment";
import RecentCampaigns from "@/components/RecentCampaigns"
export default {
    name: "Campaign",
    components: { RecentCampaigns },
    data() {
        return {
            campaignPath: process.env.VUE_APP_CAMPAIGN_PATH,
            userPath: process.env.VUE_APP_USER_PATH
        }
    },
    computed: {
        ...mapGetters("campaign", ["campaign","campaignLoading"])
    },
    created(){
        this.fetchCampaignDetail(this.$route.params.slug)
    },
    watch: { 
        '$route.params.slug': function(slug) {
            this.fetchCampaignDetail(this.$route.params.slug)
        }
    },
    methods: {
        ...mapActions('campaign', [
            'fetchCampaignDetail',
        ]),

        setAltImage(e){
            e.target.src = "https://i.picsum.photos/id/691/300/215.jpg?hmac=y8rHB4E2US1Q8hpawpEAGFrgDqj6j0DqZp9mUhdZDZM"
        },
        setUserPlaceholderImage(e){
            e.target.src = userPlaceholderImage
        },
        formatDate(val){
			if(val){
				return moment(val).format('ll');
			}
		}
    }
}
</script>