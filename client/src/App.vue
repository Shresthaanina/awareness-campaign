<template>
    <Navbar />
    <router-view />
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import Navbar from '@/components/Navbar'
export default {
    components: { Navbar },
    beforeCreate() {
        this.$store.dispatch('auth/initialize');
    },

    computed: {
        ...mapGetters("auth", ["accountDetail", "isAuthenticated"]),
    },
    created() {
        if (this.isAuthenticated) {
            this.getAccountDetail()
        }
    },

    methods: {
        ...mapActions('auth', [
            'getAccountDetail',
        ]),

    },
    watch: {
        $route(to, from) {
            console.log(to);
            console.log(from);
            var sectionFirstPadding = function() {
                setTimeout(() => {

                    if ($("header.primary").length) {
                        $("section").eq(0).addClass("first");
                        $("section.first").css({
                            paddingTop: $("header.primary").outerHeight() + 15
                        });
                    }
                    $(window).on("resize", function() {
                        if ($("header.primary").length) {
                            $("section.first").css({
                                paddingTop: $("header.primary").outerHeight() + 15
                            })
                        }
                    });
                }, 500);
            }
            sectionFirstPadding();
        }
    }
}
</script>
<style>
@import "https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap";
</style>