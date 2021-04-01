<template>

  <div id="centro">

    <div id="button">

      <h1>Ingresar </h1>
      <hr>

      <div class="facebook-login-button">
        <button v-facebook-login-button="appd" id="loginF">
          <v-icon large dark>mdi-facebook</v-icon>
          Iniciar Sesión con Facebook
        </button>
      </div>

      <div class="google-signin-button">
        <button v-google-signin-button="clientId" id="loginG">
          <v-icon large dark>mdi-google</v-icon>
          Iniciar Sesión con Google
        </button>
      </div>

      <div style="margin-top: 15px;">
        <h3>
          ¿No estas registrado?
          <a @click.prevent="dialog=true" id="regis">
            Regístrate Aqui
          </a>
        </h3>
      </div>

    </div>

    <div>

      <v-row justify="center">
        <v-dialog
            v-model="dialog"
            max-width="390"
        >
          <v-card>
            <v-card-title class="headline" >
              Registrar una nueva cuenta
            </v-card-title>
            <hr>
            <v-card-text style="text-align: center;">
              <div class="facebook-login-button">
                <button v-facebook-login-button="appd" id="loginFa" @click="facebookregistrar()">
                  <v-icon large dark>mdi-facebook</v-icon>
                  Regístrarme con Facebook
                </button>
              </div>

              <div class="google-signin-button">
                <button v-google-signin-button="clientId" id="loginGo" @click="googleresgistrar()">
                  <v-icon large dark>mdi-google</v-icon>
                  Regístrarme con Google
                </button>
              </div>
            </v-card-text>

            <hr>
            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn
                  color="red "
                  text
                  @click="dialog = false"
              >
                Cancelar
              </v-btn>


            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>

      <v-dialog
          v-model="Rdatos"
          persistent
          max-width="700px"
      >
        <v-card>
          <v-card-title>
            <span class="headline">Perfil de usuario</span>
          </v-card-title>
          <hr>
          <v-card-text>

            <v-container>
              <v-row>
                <v-col
                    cols="12"
                    sm="6"
                    md="4"
                >
                  <v-img :src="datosGoogle.img" width="100" height="100" style="border-radius: 50px; margin: 0 auto;">

                  </v-img>
                </v-col>
                <v-col
                    cols="12"
                    sm="6"
                    md="4"
                >
                  <v-text-field
                      label="Nombre"
                      v-model="datosGoogle.nombre"
                      required
                  ></v-text-field>
                </v-col>

                <v-col
                    cols="12"
                    sm="6"
                    md="4"
                >
                  <v-text-field
                      label="Apellidos"
                      persistent-hint
                      v-model="datosGoogle.apellidos"
                      required
                  ></v-text-field>
                </v-col>



                <v-col
                    cols="12"
                    sm="6"
                    md="4"
                >
                  <v-text-field
                      label="Carnet"
                      v-model="datosGoogle.carnet"
                      persistent-hint
                      required
                  ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    sm="6"
                    md="4"
                >
                  <v-text-field
                      label="Numero de celular"
                      v-model="datosGoogle.numero1"
                      required
                  ></v-text-field>
                </v-col>

                <v-col
                    cols="12"
                    sm="6"
                    md="4"
                >
                  <v-text-field
                      label="Numero de celular #2"
                      persistent-hint
                      v-model="datosGoogle.numero2"
                      required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                      label="Correo electronico"
                      v-model="datosGoogle.correo"
                      disabled
                      required
                  ></v-text-field>
                </v-col>

              </v-row>
            </v-container>

          </v-card-text>
          <hr>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                color="red darken-1"
                text
                @click="Rdatos = false"
            >
              Cancelar
            </v-btn>
            <v-btn
                color="green darken-1"
                text
                @click="next(datosGoogle)"
            >
              Aceptar
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-snackbar
          v-model="snackbar"
          color="error"
      >
        <v-row>
          <v-spacer></v-spacer>
          <h4>Algun Campo esta vacio</h4>
          <v-spacer></v-spacer>
        </v-row>
      </v-snackbar>

      <v-snackbar
          v-model="snackbarError"
          color="error"
      >
        <v-row>
          <v-spacer></v-spacer>
          <v-icon color="error">mdi-account-remove-outline</v-icon>
          <h4>El usuario no existe</h4>
          <v-spacer></v-spacer>
        </v-row>
      </v-snackbar>
      <v-snackbar
          v-model="snackbarWarn"
          color="error"
      >
        <v-row>
          <v-spacer></v-spacer>
          <h4>Este Usuario ya existe</h4>
          <v-spacer></v-spacer>
        </v-row>
      </v-snackbar>

    </div>
 </div>

</template>

<script>
import axios from 'axios'

import FacebookLoginButton from 'vue-facebook-login-button-directive'
import GoogleSingInButton from 'vue-google-signin-button-directive'

export default {
  name: 'index',

  directives:{
    FacebookLoginButton,
    GoogleSingInButton
  },
  data: () => ({
    appd: '2448214182150019',
    snackbar:false,
    snackbarError:false,
    snackbarWarn:false,
    clientId: '559588489085-3vh29divcalr5kmg5ac5vc47j45r3pbk.apps.googleusercontent.com',
    dialog:false,
    Rdatos:false,
    datosGoogle:{
      nombre:'',
      apellidos:'',
      carnet:'',
      numero1:'',
      numero2:'',
      correo:'',
      img:''
    },
    googletype:'',
    facebooktype:'',
    login:[],
  }),
  mounted() {
   // this.click()
    if (localStorage.getItem('login')) {
      try {
        this.login = JSON.parse(localStorage.getItem('login'));
        return this.$router.push('/market/'+this.login.script)

        //localStorage.removeItem('login')
      } catch(e) {
        localStorage.removeItem('login');
      }
    }
  },
  methods:{
    next(d){
      if (d.apellidos=='' || d.nombre=='' || d.carnet==''||  d.correo==''|| d.img=='' || d.numero2=='' || d.numero1==''){
        this.snackbar=true
      }else{
        this.Rdatos = false
        console.log(d.correo)
        if (d.correo== undefined){
          alert('porfavor contactese con el administrador')
        }else{
          axios.get('registrarcli.php?correo='+d.correo
       ).then((r)=>{
         if (r.data==false){
           const fd = new FormData();
           fd.append('nombre',d.nombre)
           fd.append('apellido',d.apellidos)
           fd.append('carnet',d.carnet)
           fd.append('correo',d.correo)
           fd.append('img',d.img)
           fd.append('tel1',d.numero1)
           fd.append('tel2',d.numero2)

           axios.post('registrarcli.php',fd
           ).then((res)=>{
             this.$router.replace('/market/'+res.data.script)
           })
         }else{
           this.snackbarWarn=true
         }
       })

        }


      }
      //
    },
    googleresgistrar(){
      this.googletype= 'registrar'
    },
    facebookregistrar(){
      this.facebooktype='registrar'
    },
    OnFacebookAuthSuccess(idToken) {
      this.datosGoogle.nombre =  idToken.first_name
      this.datosGoogle.apellidos =  idToken.last_name
      this.datosGoogle.correo =  idToken.email
      this.datosGoogle.img =  idToken.picture.data.url
      this.faregistrarte()
      console.log('success')
      //console.log(idToken)

    },
    faregistrarte(){
      if (this.facebooktype=='registrar'){
        this.Rdatos=true
        this.dialog=false
        this.facebooktype=''
      }else{
        axios.get('registrarcli.php?correo='+this.datosGoogle.correo
        ).then((r)=>{
          if (r.data==false) {
            this.snackbarError=true
          }else{
            return this.$router.push('/market/'+r.data.script)
          }
        })
      }
    },
    OnFacebookAuthFail(error) {
      console.log(error)
    },
    OnGoogleAuthSuccess(idToken) {
      this.datosGoogle.nombre =  idToken.BT
      this.datosGoogle.apellidos =  idToken.xR
      this.datosGoogle.correo =  idToken.At
      this.datosGoogle.img =  idToken.WI
      this.goregistrarte()
      console.log('success')
      //console.log(idToken)
    },
    goregistrarte(){
      if (this.googletype=='registrar'){
        this.Rdatos=true
        this.dialog=false
        this.googletype=''
      }else{
        axios.get('registrarcli.php?correo='+this.datosGoogle.correo
        ).then((r)=>{
          if (r.data==false) {
            this.snackbarError=true
          }else{
            return this.$router.replace('/market/'+r.data.script)
          }
        })
      }
    },
    OnGoogleAuthFail(error) {
      console.log(error)
    }
  }
};
</script>

<style scoped>
#centro {

  background: url("../assets/ini.jpg")no-repeat fixed center;
  /*background-repeat: no-repeat;*/
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  /*background-size:100%;*/
  height: 100vh;
  width: 100%;
}
.facebook-login-button {
  color: white;
  background-color: #3b5998;
  height: 50px;
  width: 100%;
  font-size: 16px;
  border-radius: 25px;
  text-align: center;
  margin-top: 15px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}
 .google-signin-button {
   color: white;
   width:100%;
   background-color: red;
   height: 50px;
   font-size: 16px;
   border-radius: 25px;
   text-align: center;
   margin-top: 15px;
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
 }
 #button{
   position: absolute;
   width: 25%;
   height: 25vh;
   left: 50%;
   top: 50%;
   text-align: center;
   margin-top: -12.5vh;
   margin-left: -12.5%;
 }
 #loginF{
   width: 100%;
   height: 100%;

 }
 #loginF:hover{
   background: blue;
   cursor: pointer;
   border-radius: 25px;
 }
#loginG{
  width: 100%;
  height: 100%;

}
#loginG:hover{
  background: darkred;
  cursor: pointer;
  border-radius: 25px;
}
#loginFa{
  width: 100%;
  height: 100%;

}
#loginFa:hover{
  background: blue;
  cursor: pointer;
  border-radius: 25px;
}
#loginGo{
  width: 100%;
  height: 100%;

}
#loginGo:hover{
  background: darkred;
  cursor: pointer;
  border-radius: 25px;
}
#regis{
  color: blue;
}
#regis:hover{
  cursor: pointer;
  color:royalblue;
}
h1{
  font-size: 50px;
  color: #424242;
}
@media (max-width: 992px){
  #button{
    width: 45%;
    height: 30vh;
    margin-left: -22.5%;
    margin-top: -15vh;
  }
  .facebook-login-button{
    font-size: 25px;
  }
  .google-signin-button{
    font-size: 25px;
  }
  h3{
    font-size: 22px;
  }
  h1{
    font-size: 45px;
  }
}
@media (max-width: 768px){
  #button{
    width: 50%;
    height: 30vh;
    margin-left: -25%;
    margin-top: -15vh;
  }
  .facebook-login-button{
    font-size: 20px;
  }
  .google-signin-button{
    font-size: 20px;
  }
  h3{
    font-size: 21px;
  }
  h1{
    font-size: 40px;
  }
}
@media (max-width: 576px){
  #button{
    width: 60%;
    height: 30vh;
    margin-left: -30%;
    margin-top: -15vh;
  }
  .facebook-login-button{
    font-size: 15px;
  }
  .google-signin-button{
    font-size: 15px;
  }
  h3{
    font-size: 17px;
  }
  h1{
    font-size: 45px;
  }
}
</style>