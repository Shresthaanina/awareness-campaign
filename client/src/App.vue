<template>
  <Navbar/>
  <router-view/>
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
    ...mapGetters("auth", ["accountDetail","isAuthenticated"]),
  },
  created() {
    if(this.isAuthenticated){
      this.getAccountDetail()
    }
  },

  methods: {
    ...mapActions('auth', [
        'getAccountDetail',
    ]),
  }
}
</script>
<style>
@import "https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap";

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
