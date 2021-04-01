<template>
  <div>
    <div v-if="!isMobile()" >
      <v-app-bar
          app
          fixed
          color="#e30c18"
          dark
          shrink-on-scroll
          height="-50"
      >

        <v-app-bar-nav-icon>
          <img @click="$router.push('/market/inicio')" src="https://bonnsupermercados.com/bonnlogoB.png" style="width: 150px; margin-left: 100px;">
        </v-app-bar-nav-icon>

        <v-spacer></v-spacer>
        <v-btn icon @click="busq=true">
          <v-icon>mdi-magnify</v-icon>
        </v-btn>
        <v-menu
            bottom
            min-width="200px"
            rounded
            offset-y
        >
          <template v-slot:activator="{ on }">
            <v-btn
                icon
                x-large
                v-on="on"
            >
              <v-avatar
                  color="brown"
                  size="48"
              >
                <v-img :src="userc.images"></v-img>
              </v-avatar>
            </v-btn>
          </template>
          <v-card width="400">
            <v-list-item-content class="justify-center">
              <div class="mx-auto text-center">
                <v-avatar
                    color="brown"
                >
                  <v-img :src="userc.images"></v-img>
                </v-avatar>
                <h3>{{ userc.nombre }} <span> </span>{{userc.apellidos}}</h3>
                <p class="caption mt-3" style="font-size: 25px;">
               {{ userc.correo }}
                </p>

                <v-divider class="my-3"></v-divider>
                <v-btn
                    depressed
                    rounded
                    text
                    color="info"
                    @click="editar=true"
                >
                  <v-icon>mdi-pencil</v-icon>
                  Editar Cuenta
                </v-btn>
                <v-divider class="my-3"></v-divider>
                <v-btn
                    depressed
                    rounded
                    text
                    color="error"
                    @click="exit()"
                >
                  <v-icon>mdi-power</v-icon>
                  Desconectar
                </v-btn>
              </div>
            </v-list-item-content>
          </v-card>
        </v-menu>


        <template v-slot:extension >
          <v-sheet
              class="mx-auto"
              width="80%"
              color="#e30c18"
          >
            <v-slide-group
                multiple
                show-arrows
            >
              <v-slide-item
                  v-for="(n,c) in cat1"
                  :key="c"
              >
                <v-menu
                    bottom
                    offset-y
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        v-on="on"
                        v-bind="attrs"
                        style="background: transparent; border: 2px solid white;"
                        @click="catt1(n.titulo)"
                    >
                      {{n.titulo}}
                    </v-btn>
                  </template>
                  <v-list>
                    <v-list-item
                        v-for="(item, index) in cat2"
                        :key="index"
                    >
                      <v-menu
                          bottom
                          offset-x
                      >
                        <template v-slot:activator="{ on, attrs }">
                          <v-btn
                              v-on="on"
                              v-bind="attrs"
                              block
                              text
                              @click="catt2(item.titulo_dos)"
                          >
                            {{ item.titulo_dos }}
                          </v-btn>
                        </template>
                        <v-list>
                          <v-list-item
                              v-for="(i, inx) in cat3"
                              :key="inx"
                          >
                            <v-btn
                                block
                                text
                                @click="catt3(i)"
                            >
                              {{ i.titulo_tres }}
                            </v-btn>
                          </v-list-item>
                        </v-list>
                      </v-menu>
                    </v-list-item>
                  </v-list>
                </v-menu>

              </v-slide-item>
            </v-slide-group>
          </v-sheet>

          <v-menu
              bottom
              min-width="200px"
              rounded
              offset-y
          >
            <template v-slot:activator="{ on }">

              <v-badge
                  bottom
                  left
                  overlap
                  icon="mdi-cart-variant"
                  style="width: 20%;"
              >
                <v-btn
                    v-on="on"
                    outlined
                    color="white"
                    style=" text-transform: lowercase; font-size: 14px;"
                    block
                    small
                    @click="carrito()"
                >
                  {{cantidad}} <span style="text-transform: uppercase">A</span>rticulo(s)-{{precio}} <span style="text-transform: uppercase">B</span>s.
                </v-btn>
              </v-badge>

            </template>
            <v-card width="300">
              <v-list-item-content class="justify-center">
                <div>
                  <div class="text-center">
                    <h3>Productos</h3>
                  </div>
                  <v-divider></v-divider>
                  <div style="max-height: 40vh;overflow-y: auto">
                    <v-col cols="12" v-for="(p,x) in detallesprod" :key="x">
                      <v-row style="margin: 1%;">
                        <div>
                          <h4>{{ p.nombre }}</h4>
                          <h5>{{ p.codigo }}</h5>
                          <h4>{{ p.total }}</h4>
                        </div>
                        <v-spacer>
                        </v-spacer>
                        <v-img :src="'https://bonnsupermercados.com/'+p.img" :aspect-ratio="9/9" width="100" height="100"></v-img>

                      </v-row>
                      <v-divider ></v-divider>

                    </v-col>
                  </div>
                  <v-divider ></v-divider>
                  <v-row style="margin: 3%;">
                    <h3>Total</h3>
                    <v-spacer></v-spacer>
                    <h3>{{precio}} Bs.</h3>
                  </v-row>
                  <v-divider ></v-divider>
                  <div class="text-center">
                    <v-btn
                        depressed
                        rounded
                        text
                        color="success"
                        @click="pedido()"
                    >
                      <v-icon>mdi-cart-arrow-right</v-icon>
                      Hacer pedido
                    </v-btn>
                  </div>
                </div>
              </v-list-item-content>
            </v-card>
          </v-menu>

        </template>


      </v-app-bar>

    </div>

    <div v-else>
      <v-navigation-drawer
          app
          dark
          color="#e30b18"
          v-model="menu"
      >
        <v-list dense>
            <v-list-group
                v-for="(t,i) in cat1"
                :key="i"
                @click="catt1(t.titulo)"
            >
              <template v-slot:activator>
                <v-list-item-content >
                  <v-list-item-title v-text="t.titulo"></v-list-item-title>
                  <hr>
                </v-list-item-content>
              </template>

              <v-list>
                <v-list-group
                    v-for="(i,x) in cat2"
                    :key="x"
                    @click="catt2(i.titulo_dos)"
                    style="background: darkred;"
                >
                  <template v-slot:activator>
                    <v-list-item-content >
                      <v-list-item-title v-text="i.titulo_dos"></v-list-item-title>
                      <hr>
                    </v-list-item-content>
                  </template>
                  <v-list-item
                      v-for="(i,x) in cat3"
                      :key="x"
                      style="background: indianred;"
                  >
                    <v-list-item-content>
                      <v-list-item-title v-text="i.titulo_tres" @click="catt3(i)" ></v-list-item-title>
                      <hr>
                    </v-list-item-content>
                  </v-list-item>
                </v-list-group>

              </v-list>
            </v-list-group>
        </v-list>



      </v-navigation-drawer>

      <v-app-bar
          app
          clipped-left
          color="#e30b18"
          dark
          shrink-on-scroll
          height="-50"
      >

        <v-app-bar-nav-icon @click.stop="menu = !menu"></v-app-bar-nav-icon>


        <v-btn icon @click="busq=true">
          <v-icon>mdi-magnify</v-icon>
        </v-btn>
        <v-spacer></v-spacer>
        <img @click="$router.push('/market/inicio')" src="https://bonnsupermercados.com/bonnlogoB.png" style="width: 150px; margin: auto;">


        <v-spacer></v-spacer>

        <v-menu
            bottom
            min-width="200px"
            rounded
            offset-y
        >
          <template v-slot:activator="{ on }">
            <v-btn
                icon
                x-large
                v-on="on"
            >
              <v-avatar
                  color="#9bc220"
                  size="35"
              >
                <v-img :src="userc.images"></v-img>
              </v-avatar>
            </v-btn>
          </template>
          <v-card width="400">
            <v-list-item-content class="justify-center">
              <div class="mx-auto text-center">
                <v-avatar
                    color="brown"
                >
                  <v-img :src="userc.images"></v-img>
                </v-avatar>
                <h3>{{ userc.nombre }} <span> </span>{{userc.apellidos}}</h3>
                <p class="caption mt-3" style="font-size: 25px;">
                  {{ userc.correo }}
                </p>

                <v-divider class="my-3"></v-divider>
                <v-btn
                    depressed
                    rounded
                    text
                    color="info"
                    @click="editar=true"
                >
                  <v-icon>mdi-pencil</v-icon>
                  Editar Cuenta
                </v-btn>
                <v-divider class="my-3"></v-divider>
                <v-btn
                    depressed
                    rounded
                    text
                    color="error"
                    @click="exit()"
                >
                  <v-icon>mdi-power</v-icon>
                  Desconectar
                </v-btn>
              </div>
            </v-list-item-content>
          </v-card>
        </v-menu>


        <template v-slot:extension >
          <v-spacer></v-spacer>
          <v-menu
              bottom
              min-width="200px"
              rounded
              offset-y
          >
            <template v-slot:activator="{ on }">

              <v-badge
                  bottom
                  left
                  overlap
                  icon="mdi-cart-variant"
              >
                <v-btn
                    v-on="on"
                    outlined
                    color="white"
                    style=" text-transform: lowercase; font-size: 14px; position: relative"
                    block
                    small
                    @click="carrito()"
                >
                  {{cantidad}} <span style="text-transform: uppercase">A</span>rticulo(s)-{{precio}} <span style="text-transform: uppercase">B</span>s.
                </v-btn>
              </v-badge>

            </template>
            <v-card width="300">
              <v-list-item-content class="justify-center">
                <div>
                  <div class="text-center">
                    <h3>Productos</h3>
                  </div>
                  <v-divider></v-divider>
                  <div style="max-height: 40vh;overflow-y: auto">
                    <v-col cols="12" v-for="(p,x) in detallesprod" :key="x">
                      <v-row style="margin: 1%;">
                        <div>
                          <h4>{{ p.nombre }}</h4>
                          <h5>{{ p.codigo }}</h5>
                          <h4>{{ p.total }}</h4>
                        </div>
                        <v-spacer>
                        </v-spacer>
                        <v-img :src="'https://bonnsupermercados.com/'+p.img" :aspect-ratio="9/9" width="100" height="100"></v-img>

                      </v-row>
                      <v-divider ></v-divider>

                    </v-col>
                  </div>
                  <v-divider ></v-divider>
                  <v-row style="margin: 3%;">
                    <h3>Total</h3>
                    <v-spacer></v-spacer>
                    <h3>{{precio}} Bs.</h3>
                  </v-row>
                  <v-divider ></v-divider>
                  <div class="text-center">
                    <v-btn
                        depressed
                        rounded
                        text
                        color="success"
                        @click="pedido()"
                    >
                      <v-icon>mdi-cart-arrow-right</v-icon>
                      Hacer pedido
                    </v-btn>
                  </div>
                </div>
              </v-list-item-content>
            </v-card>
          </v-menu>
        </template>


      </v-app-bar>


    </div>

    <div style="background: #cbcbcb;">
      <router-view></router-view>
    </div>

    <v-footer
        dark
        padless
        rounded
    >
      <v-card
          flat
          tile
          color="black"
          class="lighten-1 white--text text-center"
          width="100%"
      >


        <v-card-text class="white--text pt-0 text-left">
          <v-row>
            <v-col cols="4">
              <div >
                <v-img src="https://bonnsupermercados.com/bonnlogoN.png" :aspect-ratio="18/7" width="200"></v-img>
              </div>
              <div>
                <v-row>
                  <v-col cols="2">
                    <v-icon color="error" size="60" style="margin-left: -25px;">mdi-map-marker</v-icon>
                  </v-col>
                  <v-col cols="9" class="h"
                  >
                    <h3><strong>Direccion</strong></h3>
                    <div>
                      <div>El Alto/Zona Ciudad Satelite</div>
                      <div> Plan 112 / Calle 30 B / Nº66</div>

                    </div>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="2">
                    <v-icon color="error" size="40" style="margin-left: -15px;">mdi-email</v-icon>
                  </v-col>
                  <v-col cols="9" class="h"
                  >
                    <h3><strong>Correos</strong></h3>
                    <div>
                      <div class="h">bonnsupermercados@gmail.com</div>
                    </div>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="2">
                    <v-icon color="error" size="40" style="margin-left: -15px;">mdi-phone</v-icon>
                  </v-col>
                  <v-col cols="9" class="h"
                  >
                    <h3><strong>Telefonos</strong></h3>
                    <div>
                      <div class="h">22815396 - 78760524</div>
                    </div>
                  </v-col>
                </v-row>
              </div>
            </v-col>
            <v-col cols="4">
              <div><h3><strong>NUESTRA TIENDA</strong></h3></div>
              <br><br><br>
              <div v-for="(x,n) in cat1" :key="n">
                <h4 class="h">{{x.titulo}}</h4>
              </div>
            </v-col>
            <v-col cols="4">
              <div><h3><strong>BONN</strong></h3></div>
              <br><br><br>
              <h4>Bonn Supermercados</h4>
              <h4 class="h" @click="$router.push('/market/ConoceBonns')">Conoce mas Sobre Bonn</h4>
              <h4 class="h" @click="$router.push('/market/FormasPago')">Formas de Pago</h4>
              <h4 class="h" @click="$router.push('/market/ComohacerCompra')">Como Hago Mi Compra</h4>
              <h4 class="h" @click="$router.push('/market/NuestroServicio')">Nuestros Servicios</h4>
              <h4 class="h" @click="$router.push('/market/PreguntasFrecuentes')">Preguntas Frecuentes</h4>
              <h4 class="h" @click="$router.push('/market/Cobertura')">Zonas de Reparto</h4>
              <h4 class="h" @click="$router.push('/market/Terminos')">Terminos y Condiciones</h4>
              <h4 class="h" @click="$router.push('/market/Politica')">Politica de Privacidad</h4>


            </v-col>
          </v-row>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-text class="white--text">
          &copy;2021 Bonn Supermercados Desarrollado por <strong class="h">CODE DESTINY</strong>
        </v-card-text>
      </v-card>
    </v-footer>
    <div id="fb-root"></div>
    <div class="fb-customerchat"
         attribution=setup_tool
         page_id="417719065511582"
         theme_color="#9bc220"
         logged_in_greeting="Hola! ¿en que podemos ayudarte?"
         logged_out_greeting="Hola! ¿en que podemos ayudarte?">
    </div>

    <v-overlay :value="load" >
      <v-row style="background: black;width: 100vmax;height: 100vh;" justify="center">
        <v-progress-circular
            :size="200"
            :width="10"
            color="#9bc220"
            indeterminate
            style="margin: auto"
        >
          <strong><h1>loading</h1></strong>
        </v-progress-circular>
      </v-row>

    </v-overlay>

    <v-dialog
        v-model="editar"
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
                <v-img :src="userc.images" width="100" height="100" style="border-radius: 50px; margin: 0 auto;">

                </v-img>
              </v-col>
              <v-col
                  cols="12"
                  sm="6"
                  md="4"
              >
                <v-text-field
                    label="Nombre"
                    v-model="userc.nombre"
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
                    v-model="userc.apellidos"
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
                    v-model="userc.carnet"
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
                    v-model="userc.telefono_1"
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
                    v-model="userc.telefono_2"
                    required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                    label="Correo electronico"
                    v-model="userc.correo"
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
              @click="editar = false"
          >
            Cancelar
          </v-btn>
          <v-btn
              color="green darken-1"
              text
              @click="edit(userc)"
          >
            Aceptar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog
        v-model="busq"
        width="500"
        persistent
    >
      <v-card>
        <v-card-title>
          <div>
            Busqueda
          </div>
          <v-spacer></v-spacer>
          <v-btn
              color="error"
              icon
              large
              @click="busq=false"
          >
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <hr>
        <v-card-text>
          <v-col cols="10" style="margin: auto">
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Buscar Producto"
                single-line
                hide-details
            ></v-text-field>
            <v-data-table
                :headers="headers"
                :items="bprod"
                :search="search"
                @click:row="busqueda"
                hide-default-header
                hide-default-footer
                :items-per-page="5"
                no-results-text="No se encontraron resultados"
                class="elevation-1"
            ></v-data-table>
          </v-col>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-snackbar
        v-model="snackbarV"
        color="error"
    >
      <h3><v-icon>mdi-alert</v-icon> Ningun campo puede estar vacio</h3>
    </v-snackbar>


    <v-btn
        elevation="2"
        fab
        bottom
        left
        fixed
        color="white"
        style="margin-left: 8px; margin-bottom: 78px;"
        @click="facebook()"
    >
      <v-icon color="info" size="68">mdi-facebook</v-icon>
    </v-btn>
    <v-btn
        elevation="2"
        fab
        bottom
        left
        fixed
        style="margin-bottom: 146px; margin-left: 8px;background: limegreen;"
        @click="whatsapp()"
    >
      <v-icon color="white" size="68">mdi-whatsapp</v-icon>
    </v-btn>


  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: "dash",
  data:()=>({
    menu:false,
    cat1:[],
    cat2:[],
    cat3:[],
    icons: [
      'mdi-facebook',
      'mdi-twitter',
      'mdi-linkedin',
      'mdi-instagram',
    ],
    userc:[],
    luser:{
      id:null,
      ingreso:null,
      script:null
    },
    load:true,
    editar:false,
    snackbarV:false,
    detallesprod:[],
    busq:false,
    bprod:[],
    headers:[
      {
        text: 'Producto Nombre', value: 'nombre'
      }
    ],
    dialogError:false,
    search:'',
  }),
  mounted() {
    this.categorias()
    this.loadchat()
    axios.get('dashcli.php?type=busqueda')
    .then((b)=>{
      this.bprod=b.data
    })
    this.idu =this.$route.params.id
    if (this.idu == undefined){
      this.$router.replace('/')
    }else{
      axios.get('clilog.php?id='+this.idu
      ).then((result)=>{
        if (result.data==false){
          this.$router.replace('/')
        }else{
          this.userc= result.data
          this.luser.ingreso='yes'
          this.luser.script=result.data.script
          this.luser.id=result.data.id
          const parsed = JSON.stringify(this.luser);
          localStorage.setItem('login', parsed);
          this.load=false
          this.$router.replace('/market/inicio')
        }
      })
    }

  },
  methods:{
    exit(){
      localStorage.removeItem('login')
      this.$router.replace('/')
    },
    loadchat(){
      window.fbAsyncInit = function() {
        window.FB.init({
          xfbml            : true,
          version          : 'v9.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/es_ES/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    },
    isMobile() {
      if(
          /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
              navigator.userAgent
          )
      ) {
        return true;
      } else {
        return false;
      }
    },
    categorias(){
      axios.get('dashcli.php?type=cat1'
      ).then((re)=>{
        this.cat1=re.data
      })
    },
    catt1(t){
      axios.get('dashcli.php?type=cat2&bus='+t
      ).then((re)=>{
        this.cat2=re.data
      })
    },
    catt2(t){
      axios.get('dashcli.php?type=cat3&bus='+t
      ).then((re)=>{
        this.cat3=re.data
      })
    },
    catt3(t){
      this.$router.push('/market/productos/'+t.id)
    },
    edit(e){
      if (e.nombre=='' || e.apellidos=='' || e.carnet=='' || e.telefono_1=='' || e.telefono_2==''){
        this.snackbarV=true
        return
      }
      const fd =new FormData()
      fd.append('ide',e.id)
      fd.append('nom',e.nombre)
      fd.append('ape',e.apellidos)
      fd.append('car',e.carnet)
      fd.append('te1',e.telefono_1)
      fd.append('te2',e.telefono_2)
      axios.post('dashcli.php',fd
      ).then((re)=>{
        console.log(re.data)
      })
    },
    carrito(){
      if (localStorage.getItem('prodetalles')) {
        try {
          this.detallesprod = JSON.parse(localStorage.getItem('prodetalles'));
        } catch(e) {
          localStorage.removeItem('prodetalles');
        }
      }
    },
    pedido(){
      this.$router.push('/market/pedido')
    },
    busqueda(b){
      this.$router.push('/market/productos/'+b.categoria)
      this.busq=false
    },
    facebook(){
      parent.open('https://www.facebook.com/Supermercados-Bonn-417719065511582')
    },
    whatsapp(){
      //Hola,bienvenido a Bonn ¿en que podemos ayudarte?

      parent.open('https://wa.me/+59178760524?text=Hola, quisiera mas informacion')
    }
  },
  computed:{
    precio(){
      return this.$store.state.precio
    },
    cantidad(){
      return this.$store.state.cantidad
    }
  }


}
</script>

<style scoped>
.h:hover{
  color: #e30d18;
  cursor: pointer;
}
</style>