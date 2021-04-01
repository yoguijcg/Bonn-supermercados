# vue-facebook-login-button-directive

> :closed_lock_with_key: A simple [Vue](https://vuejs.org) directive to include [Facebook Sign-In Button](https://developers.facebook.com/docs/facebook-login/web?locale=en_US) behavior in any component.

## Install

```bash
$ npm install --save vue-facebook-login-button-directive

$ yarn add vue-facebook-login-button-directive
```

## Usage

Import the directive and attach it to any component, let's give you an example:

> Important: `OnFacebookAuthSuccess` and `OnFacebookAuthFail` are mandatory methods you have to declare in your component where you are using the directive.

```html
<template>
  <button v-facebook-login-button="appId" class="facebook-login-button">
    Continue with Facebook
  </button>
</template>

<script>
  import FacebookLoginButton from 'vue-facebook-login-button-directive'
  export default {
    directives: {
      FacebookLoginButton
    },
    data: () => ({
      appId: 'Your_Facebook_App-Id'
    }),
    methods: {
      OnFacebookAuthSuccess(idToken) {
        // Receive the idToken and make your magic with the backend
      },
      OnFacebookAuthFail(error) {
        console.log(error)
      }
    }
  }
</script>

<style>
  .facebook-login-button {
    color: white;
    background-color: #3b5998;
    height: 50px;
    font-size: 16px;
    border-radius: 10px;
    padding: 10px 20px 25px 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
</style>
```
