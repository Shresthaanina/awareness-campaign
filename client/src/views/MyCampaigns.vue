<template>
    <section class="category">
		<div class="container">
		<div class="row">
			<div class="col-md-8 text-left">
			<div class="row">
				<div class="col-md-12">
				<p class="page-subtitle">My Campaigns</p>
				</div>
			</div>
			<div class="row">
				<article class="col-md-12 article-list" v-for="(campaign,k) in campaigns" :key="k">
				<div class="inner">
					<figure>
						<router-link :to="{ name: 'campaign', params:{ slug : campaign.slug}}">
						<img :src="campaignPath + 'thumbnails/' +campaign.image" @error="setAltImage">
					</router-link>
					</figure>
					<div class="details">
					<div class="detail">
						<!-- <div class="category">
						<a href="category.html">Film</a>
						</div> -->
						<div class="time">{{ formatDate(campaign.start_date) }}</div>
					</div>
					<h1><router-link :to="{ name: 'campaign', params:{ slug : campaign.slug}}">{{ campaign.name }}</router-link></h1>
					<p>
						{{ campaign.excerpt }}
					</p>
					<footer>
						<!-- <a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>237</div></a> -->
						<router-link class="btn btn-primary more" :to="{ name: 'edit-campaign', params: { slug:campaign.slug } }">
						<div>Edit</div>
						<div><i class="ion-ios-arrow-thin-right"></i></div>
						</router-link>
					</footer>
					</div>
				</div>
				</article>
				<div class="col-md-12 text-center">
					<pagination v-model="campaignData.current_page" 
						:records="campaignData.total" 
						:per-page="campaignData.per_page" 
						@paginate="updateCurrentPage($event)"
						:options="{ theme:'bootstrap4', chunksNavigation: 'scroll', edgeNavigation: true  }"
					/>
				<!-- <ul class="pagination">
					<li class="prev"><a href="#"><i class="ion-ios-arrow-left"></i></a></li>
					<li class="active"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">...</a></li>
					<li><a href="#">97</a></li>
					<li class="next"><a href="#"><i class="ion-ios-arrow-right"></i></a></li>
				</ul>
				<div class="pagination-help-text">
					Showing 8 results of 776 &mdash; Page 1
				</div> -->
				</div>
			</div>
			</div>
			<div class="col-md-4 sidebar">
			<aside>
				<div class="aside-body">
				<figure class="ads">
					<a href="single.html">
						<img src="@/assets/images/ad.png">
					</a>
					<figcaption>Advertisement</figcaption>
				</figure>
				</div>
			</aside>
			<aside>
				<h1 class="aside-title">Recent Post</h1>
				<div class="aside-body">
				<article class="article-mini">
					<div class="inner">
					<figure>
						<a href="single.html">
						<img src="@/assets/images/news/img05.jpg">
					</a>
					</figure>
					<div class="padding">
					<h1><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
					<div class="detail">
						<div class="category"><a href="category.html">Lifestyle</a></div>
						<div class="time">December 22, 2016</div>
					</div>
					</div>
					</div>
				</article>
				<article class="article-mini">
					<div class="inner">
					<figure>
						<a href="single.html">
							<img src="@/assets/images/news/img02.jpg">
						</a>
					</figure>
					<div class="padding">
						<h1><a href="single.html">Fusce ullamcorper elit at felis cursus suscipit</a></h1>
						<div class="detail">
						<div class="category"><a href="category.html">Travel</a></div>
						<div class="time">December 21, 2016</div>
						</div>
					</div>
					</div>
				</article>
				<article class="article-mini">
					<div class="inner">
					<figure>
						<a href="single.html">
							<img src="@/assets/images/news/img13.jpg">
						</a>
					</figure>
					<div class="padding">
						<h1><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
						<div class="detail">
						<div class="category"><a href="category.html">International</a></div>
						<div class="time">December 20, 2016</div>
						</div>
					</div>
					</div>
				</article>
				</div>
			</aside>
			</div>
		</div>
		</div>
	</section>
</template>

<script>
import { mapGetters, mapActions } from "vuex"
import * as moment from "moment/moment";
export default {
    data() {
        return {
            campaignPath: process.env.VUE_APP_CAMPAIGN_PATH,
			campaignData: {
				total: 0,
				per_page:0,
				current_page:1
			},
        }
    },
    
    computed: {
        ...mapGetters("auth", ["accountDetail"]),
        ...mapGetters("campaign", ["campaignLoading","campaigns"])
    },

    created(){
		this.setCampaignCreatedById(this.accountDetail.id)
        this.fetchCampaigns()
		.then(res => {
			this.campaignData = res;
		})
    },

    methods: {
        ...mapActions('campaign', [
            'fetchCampaigns',
			'setCampaignCreatedById'
        ]),

        setAltImage(e){
            e.target.src = "https://i.picsum.photos/id/830/400/275.jpg?hmac=atIskX6qKhoQCHr5ZnRJ1MYykoX1zcecOpR11Vwjolk"
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