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
						<div class="time">December 26, 2016</div>
					</div>
					<h1><router-link :to="{ name: 'campaign', params:{ slug : campaign.slug}}">{{ campaign.name }}</router-link></h1>
					<p>
						{{ campaign.excerpt }}
					</p>
					<footer>
						<a href="#" class="love"><i class="ion-android-favorite-outline"></i> <div>237</div></a>
						<router-link class="btn btn-primary more" :to="{ name: 'campaign', params:{ slug : campaign.slug}}">
						<div>More</div>
						<div><i class="ion-ios-arrow-thin-right"></i></div>
						</router-link>
					</footer>
					</div>
				</div>
				</article>
				<div class="col-md-12 text-center">
				<ul class="pagination">
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
				</div>
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
				<article class="article-fw">
					<div class="inner">
					<figure>
						<a href="single.html">
							<img src="@/assets/images/news/img12.jpg">
						</a>
					</figure>
					<div class="details">
						<h1><a href="single.html">Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit</a></h1>
						<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua.
						</p>
						<div class="detail">
						<div class="time">December 26, 2016</div>
						<div class="category"><a href="category.html">Lifestyle</a></div>
						</div>
					</div>
					</div>
				</article>
				<div class="line"></div>
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
			<aside>
				<div class="aside-body">
				<form class="newsletter">
					<div class="icon">
					<i class="ion-ios-email-outline"></i>
					<h1>Newsletter</h1>
					</div>
					<div class="input-group">
					<input type="email" class="form-control email" placeholder="Your mail">
					<div class="input-group-btn">
						<button class="btn btn-primary"><i class="ion-paper-airplane"></i></button>
					</div>
					</div>
					<p>By subscribing you will receive new articles in your email.</p>
				</form>
				</div>
			</aside>
			</div>
		</div>
		</div>
	</section>
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
            e.target.src = "https://i.picsum.photos/id/691/300/215.jpg?hmac=y8rHB4E2US1Q8hpawpEAGFrgDqj6j0DqZp9mUhdZDZM"
        }
    }
}
</script>