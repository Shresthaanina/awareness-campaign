<template>
    <div>
        <banner-carousel></banner-carousel>
        <campaign-list></campaign-list>
    </div>
</template>
<script>
// @ is an alias to /src
import CampaignList from "@/components/CampaignList";
import BannerCarousel from "@/components/BannerCarousel";
export default {
    name: "Home",
    components: {
        CampaignList,
        BannerCarousel,
    },
    data() {
        return {
            
        }
    }
};
</script>
<style scoped>



</style>