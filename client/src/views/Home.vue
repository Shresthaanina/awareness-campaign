<template>
<div>
    <campaign-list></campaign-list>
    </div>

</template>

<script>
// @ is an alias to /src
import CampaignList from "@/components/CampaignList";
export default {
  name: "Home",
  components: {
    CampaignList,   
  },
};
</script>
