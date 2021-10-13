<template>
    <section class="carousel-wrap">
        <carousel>
            <slide v-for="(banner,b) in banners" :key="b">
                <div class="slide-content">
                    <div class="img-wrap">
                        <img :src="bannerPath + banner.image" alt="">
                    </div>
                    <div class="text-wrap">
                        <div class="text-content-wrap">
                          
                            <h3 class="slide-title" v-if="banner.title">{{ banner.title }}</h3>
                            <div class="slide-content" v-if="banner.excerpt">
                                <p>{{ banner.excerpt }}</p>
                            </div>
                            <a class="slide-link btn btn-primary more" v-if="banner.button_text" :href="banner.button_link" target="_new">{{ banner.button_text }}</a>
                        </div>
                    </div>
                </div>
            </slide>
            <template #addons>
                <navigation />
                <pagination />
            </template>
        </carousel>
    </section>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
export default {
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    data() {
        return {
            settings: {
                itemsToShow: 1,
            },
            bannerPath: process.env.VUE_APP_BANNER_PATH,
            // slide: [{
            //     image_source: require('@/assets/images/slider/slider-1.jpg'),
            //     slide_title: "Slider title",
            //     slide_content: "description text",
            //     slide_link: "#slider-link"
            // }, {
            //     image_source: require('@/assets/images/slider/slider-2.jpg'),
            //     slide_title: "Slider title",
            //     slide_content: "description text",
            //     slide_link: "#slider-link"
            // }, {
            //     image_source: require('@/assets/images/slider/slider-3.jpg'),
            //     slide_title: "Slider title",
            //     slide_content: "description text",
            //     slide_link: "#slider-link"
            // }],
        }
    },
    computed: {
        ...mapGetters("banner", ["banners"]),
    },
    created() {
        this.fetchBanners()
    },
    methods: {
        ...mapActions('banner', ['fetchBanners']),
    }
}
</script>