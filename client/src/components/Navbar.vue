<template>
    <!-- <div>
    <ul>
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
        
    </ul>
    </div> -->
    <header class="primary">
        <div class="firstbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="brand">
                            <router-link :to="{ name: 'home' }">
                                <img src="@/assets/images/logo.png" alt="Magz Logo">
                            </router-link>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <form class="search" autocomplete="off">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="Type something here">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="ion-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3 col-sm-12 text-right">
                        <ul class="nav-icons">
                            <template v-if="isAuthenticated">
                                <li><router-link :to="{ name: 'profile' }"><i class="ion-person-add"></i><div>Account</div></router-link></li>
                                <li><router-link :to="{ name: 'logout' }"><i class="ion-person"></i><div>Logout</div></router-link></li>
                            </template>
                            <template v-else>
                                <li><router-link :to="{ name: 'login' }"><i class="ion-person"></i><div>Login</div></router-link></li>
                                <li><router-link :to="{ name: 'register' }"><i class="ion-person-add"></i><div>Register</div></router-link></li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start nav -->
        <nav class="menu">
            <div class="container">
                <div class="brand">
                    <a href="#">
                        <img src="@/assets/images/logo.png" alt="Magz Logo">
                    </a>
                </div>
                <div class="mobile-toggle">
                    <a href="#" data-toggle="menu" data-target="#menu-list"><i class="ion-navicon-round"></i></a>
                </div>
                <div class="mobile-toggle">
                    <a href="#" data-toggle="sidebar" data-target="#sidebar"><i class="ion-ios-arrow-left"></i></a>
                </div>
                <div id="menu-list">
                    <ul class="nav-list">
                        <li><a href="javascript::void(0)" @click="filterCampaignList()">All</a></li>
                        <li v-for="(category,c) in categoryList" :key="c"><a href="javascript::void(0)" @click="filterCampaignList(category.id)">{{ category.name }}</a></li>
                        <li class="dropdown magz-dropdown"><a href="#">My Account <i class="ion-ios-arrow-right"></i></a>
                            <ul class="dropdown-menu">
                                <li><router-link :to="{ name: 'profile' }"><i class="icon ion-person"></i> Profile</router-link></li>
                                <li><router-link :to="{ name: 'my-campaigns' }"><i class="icon ion-heart"></i> My Campaigns</router-link></li>
                                <li><router-link :to="{ name: 'new-campaign' }"><i class="icon ion-chatbox"></i> New Campaign</router-link></li>
                                <li><a href="#"><i class="icon ion-key"></i> Change Password</a></li>
                                <li class="divider"></li>
                                <li><router-link :to="{ name: 'logout' }"><i class="icon ion-log-out"></i> Logout</router-link></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End nav -->
    </header>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    computed: {
        ...mapGetters("auth", ["accountDetail","isAuthenticated"]),
        ...mapGetters("campaign", ["categoryList"]),
    },
    created(){
        this.getCategoryList()
    },
    methods: {
        ...mapActions('campaign', [
            'getCategoryList',
            'fetchCampaigns',
            'setCampaignCategoryId',
        ]),
        filterCampaignList(category_id = ''){
            this.setCampaignCategoryId(category_id)
            this.fetchCampaigns()
        }
    }
}
</script>