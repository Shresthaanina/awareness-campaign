<template>
    <div>
    <!-- <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
        </div>
        <div class="site-mobile-menu-body">
        <ul class="site-nav-wrap">
            <li class="active"><router-link to="/">Home</router-link></li>
            <li class="has-children">
            <span
                class="arrow-collapse collapsed"
                data-bs-toggle="collapse"
                data-bs-target="#collapseItem0"
            ></span
            ><a href="categories.html">Categories</a>
            <ul class="collapse" id="collapseItem0">
                <li><a href="#">Travel</a></li>
                <li><a href="#">Food</a></li>
                <li><a href="#">Technology</a></li>
                <li><a href="#">Business</a></li>
                <li class="has-children">
                <span
                    class="arrow-collapse collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseItem1"
                ></span
                ><a href="#">Dropdown</a>
                <ul class="collapse" id="collapseItem1">
                    <li><a href="#">Sub Menu One</a></li>
                    <li><a href="#">Sub Menu Two</a></li>
                    <li><a href="#">Sub Menu Three</a></li>
                </ul>
                </li>
            </ul>
            </li>
            <li><a href="#">Travel</a></li>
            <li><a href="#">Food</a></li>
            <li><a href="#">Technology</a></li>
            <li><a href="#">Business</a></li>
        </ul>
        </div>
    </div> -->
    <nav class="site-nav">
        <div class="container">
        <div class="site-navigation">
            <div class="row">
            <div class="col-md-6 text-center order-1 order-md-2 mb-3 mb-md-0">
                <router-link to="/" class="logo m-0 text-uppercase">Awareness Campaign</router-link>
            </div>
            <div class="col-md-3 order-3 order-md-1">
                
            </div>
            <div class="col-md-3 text-end order-2 order-md-3 mb-3 mb-md-0">
                <div class="d-flex">
                <ul class="list-unstyled social me-auto">
                    <template v-if="isAuthenticated">
                        <li>
                            <router-link :to="{ name: 'profile' }">Account</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'logout' }">Logout</router-link>
                        </li>
                    </template>
                    <template v-else>
                    <li>
                        <router-link :to="{ name: 'login' }">Login</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'register' }">Register</router-link>
                    </li>
                    </template>
                    <!-- <li>
                    <a href="#"><span class="icon-twitter"></span></a>
                    </li>
                    <li>
                    <a href="#"><span class="icon-facebook"></span></a>
                    </li>
                    <li>
                    <a href="#"><span class="icon-instagram"></span></a>
                    </li> -->
                </ul>
                <!-- <a href="#" class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block" data-toggle="collapse" data-target="#main-navbar">
                    <span></span>
                </a> -->
                </div>
            </div>
            </div>
            <ul class="js-clone-nav d-none d-lg-inline-none text-start site-menu float-end">
            <li class="active"><a href="index.html">Home</a></li>
            <li class="has-children">
                <a href="categories.html">Categories</a>
                <ul class="dropdown">
                <li><a href="#">Travel</a></li>
                <li><a href="#">Food</a></li>
                <li><a href="#">Technology</a></li>
                <li><a href="#">Business</a></li>
                <li class="has-children">
                    <a href="#">Dropdown</a>
                    <ul class="dropdown">
                    <li><a href="#">Sub Menu One</a></li>
                    <li><a href="#">Sub Menu Two</a></li>
                    <li><a href="#">Sub Menu Three</a></li>
                    </ul>
                </li>
                </ul>
            </li>
            <li><a href="#">Travel</a></li>
            <li><a href="#">Food</a></li>
            <li><a href="#">Technology</a></li>
            <li><a href="#">Business</a></li>
            </ul>
        </div>
        </div>
    </nav>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    computed: {
        ...mapGetters("auth", ["accountDetail","isAuthenticated"]),
    },
}
</script>