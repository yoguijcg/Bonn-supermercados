/* eslint-disable no-undef */
import Vue from 'vue'

export default Vue.directive('facebook-login-button', {
  bind(el, binding, vnode) {
    CheckComponentMethods()
    const appId = binding.value
    const facebookSignInAPI = document.createElement('script')
    facebookSignInAPI.setAttribute('src', '//connect.facebook.net/en_US/sdk.js')
    document.head.appendChild(facebookSignInAPI)

    facebookSignInAPI.onload = InitFacebookButton
    
    function InitFacebookButton() {
      FB.init({
        appId,
        xfbml: true,
        version: 'v3.1'
      })
       //FB.logout()
    }


    el.addEventListener('click', PopUp)
  

    function PopUp() {
      //console.warn(binding)
      FB.login(
        function(facebookResponse) {
          if (facebookResponse.status === 'connected') {
            FB.api('/me?fields=id,first_name,last_name,email,picture', function(response) {
              OnSuccess(facebookResponse.authResponse, response)
            })
          } else {
            Onfail()
          }
        },
        { scope: 'public_profile,email', return_scopes: true }
      )
    }
    function OnSuccess(facebookAuthResponse, facebookProfileResponse) {
      vnode.context.OnFacebookAuthSuccess(
        //facebookAuthResponse,
        facebookProfileResponse,
    )
    }
    function Onfail() {
      vnode.context.OnFacebookAuthFail('Facebook sign-in failed')
    }
    function CheckComponentMethods() {
      if (!vnode.context.OnFacebookAuthSuccess) {
        throw new Error(
          'The method OnFacebookAuthSuccess must be defined on the component'
        )
      }

      if (!vnode.context.OnFacebookAuthFail) {
        throw new Error(
          'The method OnFacebookAuthFail must be defined on the component'
        )
      }
    }
  }
})
