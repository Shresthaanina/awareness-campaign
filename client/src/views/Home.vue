<template>
    <div>
        <section class="carousel-wrap">
            <carousel>
                <slide v-for="index in slide" :key="index">
                    <div class="slide-content">
                        <div class="img-wrap">
                            <img :src="index.image_source" alt="">
                        </div>
                        <div class="text-wrap">
                            <h3 class="slide-title">{{index.slide_title}}</h3>
                            <div class="slide-content">
                                <p>
                                    {{index.slide_content}}
                                </p>
                            </div>
                            <a class="slide-link btn btn-primary more" :href="index.slide_link">View</a>
                        </div>
                    </div>
                </slide>
                <template #addons>
                    <navigation />
                    <pagination />
                </template>
            </carousel>
        </section>
        <campaign-list></campaign-list>
    </div>
</template>
<script>
// @ is an alias to /src
import CampaignList from "@/components/CampaignList";

import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
export default {
    name: "Home",
    components: {
        CampaignList,
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


            slide: [{
                image_source: require('@/assets/images/slider/slider-1.jpg'),
                slide_title: "Slider title",
                slide_content: "description text",
                slide_link: "#slider-link"
            }, {
                image_source: require('@/assets/images/slider/slider-2.jpg'),
                slide_title: "Slider title",
                slide_content: "description text",
                slide_link: "#slider-link"
            }, {
                image_source: require('@/assets/images/slider/slider-3.jpg'),
                slide_title: "Slider title",
                slide_content: "description text",
                slide_link: "#slider-link"
            }],
        }
    }
};
</script>
<style scoped>



</style>