<template>
    <div class="col-md-2 site-menu-body">
        <ul class="site-nav-wrap">
            <li>
                <router-link :to="{ name: 'profile'}">Profile</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'my-campaigns'}">My Campaigns</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'new-campaign'}">New Campaign</router-link>
            </li>
        </ul>
    </div>
</template>

<style>
    .site-menu-body {
        position: relative;
        padding: 0 20px 20px 20px;
        padding-bottom: 150px;
    }
    .site-menu-body .site-nav-wrap{
        padding: 0;
        margin: 0;
        list-style: none;
        position: relative;
    }
    .site-menu-body .site-nav-wrap > li {
        display: block;
        position: relative;
        float: left;
        width: 100%;
    }
    .site-menu-body .site-nav-wrap > li > a {
        padding: 5px 20px;
        display: block;
        position: relative;
        padding-left: 20px;
        font-size: 14px;
    }
</style>