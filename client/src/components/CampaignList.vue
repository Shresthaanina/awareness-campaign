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
				<article v-if="campaignLoading" class="col-md-12 article-list">
					<div class="inner">
						<figure style="background-color: rgba(0, 0, 0, 0.12);">
							<Skeletor size="300" as="div"/>
						</figure>
						<div class="details">
							<div class="detail">
								<Skeletor width="200"/>
							</div>
							<h1><Skeletor /></h1>
							<p><Skeletor v-for="i in 3" :key="i"/></p>
							<footer class="float-right"><Skeletor width="70" height="35"/></footer>
						</div>
					</div>
				</article>
				<template v-else>
					<template v-if="campaigns.length == 0">
						<div class="col-md-12">No campaigns available right now.</div>
					</template>
					<template v-else>
						<article class="col-md-12 article-list" v-for="(campaign,k) in campaigns" :key="k">
							<div class="inner">
								<figure>
									<router-link :to="{ name: 'campaign', params:{ slug : campaign.slug}}">
									<img :src="campaignPath + 'thumbnails/' +campaign.image" @error="setAltImage">
								</router-link>
								</figure>
								<div class="details">
								<div class="detail">
									<div class="category" v-if="campaign.category">
										<a href="javascript:void(0);">{{ campaign.category.name }}</a>
									</div>
									<div class="time" v-if="campaign.start_date">{{ formatDate(campaign.start_date) }}</div>
								</div>
								<h1><router-link :to="{ name: 'campaign', params:{ slug : campaign.slug}}">{{ campaign.name }}</router-link></h1>
								<p>
									{{ campaign.excerpt }}
								</p>
								<footer>
									<!-- <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>237</div></a> -->
									<router-link class="btn btn-primary more" :to="{ name: 'campaign', params:{ slug : campaign.slug}}">
										<div>More</div>
										<div><i class="ion-ios-arrow-thin-right"></i></div>
									</router-link>
								</footer>
								</div>
							</div>
						</article>
					</template>
				</template>
				<div class="col-md-12 text-center">
					<pagination v-if="campaignPaginateData.last_page > 1" v-model="current_page" 
						:records="campaignPaginateData.total" 
						:per-page="campaignPaginateData.per_page" 
						@paginate="updateCurrentPage($event)"
						:options="{ theme:'bootstrap4', chunksNavigation: 'scroll', edgeNavigation: true  }"
					/>
				</div>
			</div>
			</div>
			<div class="col-md-4 sidebar">
			<aside>
				<div class="aside-body">
				<figure class="ads">
					<a href="single.html">
						<img src="@/assets/images/promo.png">
					</a>
					<figcaption>Advertisement</figcaption>
				</figure>
				</div>
			</aside>
			<recent-campaigns />
			</div>
		</div>
		</div>
	</section>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import * as moment from "moment/moment";
import RecentCampaigns from "@/components/RecentCampaigns"
export default {
    name:"CampaignList",
	components: { RecentCampaigns },
    data() {
        return {
            campaignPath: process.env.VUE_APP_CAMPAIGN_PATH,
			current_page:1,
        }
    },
    computed: {
        ...mapGetters("campaign", ["campaigns","campaignLoading","campaignPaginateData"]),
    },
	watch:{
		campaignPaginateData(val){
			this.current_page = val.current_page
		}
	},
    created(){
        this.fetchCampaigns()
    },
    methods: {
        ...mapActions('campaign', [
            'fetchCampaigns',
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
		updateCurrentPage(selectedPage){
			this.fetchCampaigns(selectedPage)
			.then(res => {
				this.campaignData = res;
			})
		}
    }
}
</script>