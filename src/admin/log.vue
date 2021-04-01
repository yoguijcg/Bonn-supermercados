<template>
  <div id="app">
    <h1>Login with Facebook</h1>
    <v-btn class="button"
           appId="375792860173464"
           @login="onLogin"
           @logout="onLogout"

    >
      facebook-mdi
    </v-btn >
    <facebook-login class="button"
                    appId="375792860173464"
                    @login="onLogin"
                    @logout="onLogout"
                   >
    </facebook-login>
    <v-img></v-img>
  </div>
</template>
<script>

import facebookLogin from 'facebook-login-vuejs';


export default {
  name: "app",
  components: { facebookLogin},
  data(){
    return{
      isConnected: false,
      name: '',
      email: '',
      personalID: '',
      FB: undefined
    }
  },
  methods: {
    getUserData() {

      this.FB.api('/me', 'GET',
          userInformation => {
            console.warn("data api",userInformation)
            this.personalID = userInformation.id;
            this.email = userInformation.email;
            this.name = userInformation.name;
          }
      )
    },
    sdkLoaded(payload) {
      this.isConnected = payload.isConnected
      this.FB = payload.FB
      if (this.isConnected) this.getUserData()
    },
    onLogin() {
      this.isConnected = true
      this.getUserData()
    },
    onLogout() {
      this.isConnected = false;
    }
  }
}
</script>
