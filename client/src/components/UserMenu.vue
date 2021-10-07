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