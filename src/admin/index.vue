<template>
  <div>
    <div id="fondo">
      <div id="form">
        <div id="icon">
          <v-icon color="#9bc220" size="150">mdi-account-circle-outline</v-icon>
        </div>
        <div id="center">
          <h2 style="color: #9bc220;">Iniciar sesión</h2>

          <v-form class="center">
            <v-text-field
                v-model="user"
                label="Usuario"
                required
                dark
                outlined
                color="#9bc220"
            ></v-text-field>

            <v-text-field
                v-model="pass"
                label="contraseña"
                required
                dark
                color="#9bc220"
                outlined
                type="password"
            ></v-text-field>

            <v-btn
                color="#9bc220"
                class="mr-4"
                block
                dark
                type="submit"
                @click.prevent="validate"
            >
              Ingresar
            </v-btn>

          </v-form>
        </div>
      </div>
    </div>

    <v-snackbar
        v-model="snackbar"
        color="error"
        class="snack"
    >
      El usuario o password es incorrecto
      vuelve a intentarlo

    </v-snackbar>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: "index",
  data:()=>({
    user:'',
    pass:'',
    snackbar: false,
    logadmin: [],

  }),
  mounted() {
    if (localStorage.getItem('adminL')) {
      try {
        this.logadmin = JSON.parse(localStorage.getItem('adminL'));
        return this.$router.push('/administrador/'+this.logadmin.id)

        //localStorage.removeItem('login')
      } catch(e) {
        localStorage.removeItem('adminL');
      }
    }
  },
  methods:{
    validate(){
      const fr = new FormData();
      fr.append('u',this.user)
      fr.append('p',this.pass)
      axios.post('loginadmin.php',fr
      ).then((result)=>{
        if (result.data == false){
          this.snackbar =true;
        }else{
          this.$router.replace('/administrador/'+result.data.id)
        }
      })
        //SE USA PARA ENVIAR PARAMETROS MEDIANTE NAME EL DE ARRIBA ES MENOS CODIGO Y FUNCIONA
      /*return this.$router.push({
          name:'dashboards',
          params:{id: result.data.id}
      })*/
    }
  }
}
</script>

<style scoped>
#fondo{
  background: black;
  width: 100%;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
#form{
  height: 50vh;
  width: 30%;
  border: #9bc220 solid 4px;
  border-radius: 10px;
  position: absolute;
  z-index: 1;
}
#icon{
  background: black;
  border-radius: 50%;
  position: absolute;
  z-index: 2;
  margin-top: -75px;
  left: 50%;
  margin-left: -75px;
}
#center{
  height: 82%;
  width: 100%;
  margin-top: 75px;
  text-align: center;
}
.center{margin: 5%;}
@media (max-width: 768px){
  #form{
    width: 80%;
    height: 45vh;
  }
  .snack{
    top: -10%;
  }
}
@media (max-width: 576px){
  #form{
    width: 80%;
    height: 40vh;
  }
  .snack{
    top: -15%;
  }
}
</style>