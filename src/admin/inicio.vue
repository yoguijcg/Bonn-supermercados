<template>
  <div>
    <v-navigation-drawer
        app
        clipped
        permanent
        expand-on-hover
        color="#9bc220"
        dark
        width="300"
    >
      <v-list dense>
        <v-list-group
            v-for="(item, i) in itema"
            :key="i"
            v-model="item.active"
            :prepend-icon="item.action"
            no-action
            @click="menudi(item.title)"
        >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title v-text="item.title"></v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
              v-for="(subItem, a) in item.items" :key="a" link @click="moveritem(subItem.title)"
          >
            <v-list-item-icon><v-icon>{{subItem.icon}}</v-icon></v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title v-text="subItem.title"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-group>
      </v-list>


    </v-navigation-drawer>

    <v-app-bar app clipped-left color="#9bc220" dark>
      <v-app-bar-nav-icon ></v-app-bar-nav-icon>
      <v-toolbar-title>Menu</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn color="error" @click="exit()">
        Salir
      </v-btn>
      <!--
      <div style="right: 0;margin-left: auto;">
        <div class="text-center">
          <v-menu v-model="menu" :close-on-content-click="false" :nudge-width="200" offset-x>
            <template v-slot:activator="{ on }">
              <v-btn color="blue" dark v-on="on" outlined>
                <v-icon>mdi-account</v-icon>
              </v-btn>
            </template>

            <v-card>
              <v-list>
                <v-list-item>
                  <v-list-item-avatar>
                    <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John">
                  </v-list-item-avatar>

                  <v-list-item-content>
                    <v-list-item-title>{{userd.nombre}}</v-list-item-title>
                    <v-list-item-subtitle>{{ userd.apellido_paterno }} &nbsp; {{userd.apelido_materno}} </v-list-item-subtitle>
                  </v-list-item-content>


                </v-list-item>
              </v-list>

              <v-list>
                <v-list-item>
                  <v-list-item-action>
                    <v-switch v-model="message" color="purple"></v-switch>
                  </v-list-item-action>
                  <v-list-item-title>Enable messages</v-list-item-title>
                </v-list-item>

                <v-list-item>
                  <v-list-item-action>
                    <v-switch v-model="hints" color="purple"></v-switch>
                  </v-list-item-action>
                  <v-list-item-title>Enable hints</v-list-item-title>
                </v-list-item>
              </v-list>

              <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn text @click="menu = false">Cancel</v-btn>
                <v-btn color="primary" text @click="menu = false">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-menu>
        </div>
      </div>
      -->
    </v-app-bar>

    <v-main>
      <router-view></router-view>
    </v-main>

    <v-dialog
        v-model="dialogA"
        width="500"
    >
      <v-card>
        <v-card-title>
          <v-icon>mdi-truck-fast</v-icon>
          Costo de Envio
        </v-card-title>
        <hr>
        <v-card-text>
          <v-row >
            <v-col cols="5" class="text-right">
              <h4>Precio del costo de envio</h4>
            </v-col>
            <v-col cols="6">
              <v-text-field v-model="costo"></v-text-field>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="error" text @click="dialogA=false">
            Cancelar
          </v-btn>
          <v-btn color="success" text @click="cambiar(costo)">
            CAmbiar costo
          </v-btn>
        </v-card-actions>
      </v-card>

    </v-dialog>

    <v-footer app :inset="false" color="#9bc220" dark>
      <span>Super Mercado Boon &copy; 2021</span>
    </v-footer>
  </div>
</template>

<script>
import axios from 'axios'
export default {
name: "inicio",
  data: () => ({
    idu:null,
    userd:[],
    fav: true,
    menu: false,
    message: false,
    hints: true,
    itema: [
     /* {
        action: 'mdi-chart-timeline-variant-shimmer',
        title: 'Reportes',
        active: true,
        items: [
          { title: 'List Item' },
        ],
      },*/
      {
        action: 'mdi-account-circle',
        title: 'Usuarios',
        items: [
          { title: 'Usuarios Activos', icon:'mdi-account-check' },
          { title: 'Usuarios Inactivos',icon:'mdi-account-remove' },
        ],
      },
      /*{
        action: 'mdi-account-cash-outline',
        title: 'Clientes',
        items: [
          { title: 'List Item' },
        ],
      },*/
      {
        action: 'mdi-cart-arrow-right',
        title: 'Productos',
        items: [
          { title: 'Productos ', icon:'mdi-cart' },
          { title: 'Productos Inactivos', icon: 'mdi-cart-minus' },
        ],
      },
      {
        action: 'mdi-sale',
        title: 'Promocion',
        items: [
          { title: 'Promocion  Vigentes ', icon:'mdi-star-check-outline' },
          { title: 'Promociones Caducadas', icon: 'mdi-star-off-outline' },
        ],
      },
      {
        action: 'mdi-clipboard-edit-outline',
        title: 'Categorias',
        items: [
          { title: 'Categorias Activas', icon: 'mdi-clipboard-check' },
          { title: 'Categorias Inactivas', icon: 'mdi-clipboard-remove' },
        ],
      },

      {
        action: 'mdi-bike',
        title: 'Pedidos',
        items: [
          { title: 'Pedidos Recientes', icon: 'mdi-bike-fast' },
        ],
      },
      {
        action: 'mdi-image-multiple-outline',
        title: 'Carrusel',

      },
      {
        action: 'mdi-currency-usd-circle-outline',
        title: 'Costo de envio',

      },
    ],
    logadmin:{
      id:null,
      ingreso:null,
    },
    dialogA:false,
    costo:null,
  }),
  created (){

  },
  mounted() {
    axios.get('costo.php'
    ).then((r)=>{
      console.log(r.data)
      this.costo=r.data.costo
    })
    this.idu =this.$route.params.id
    if (this.idu == undefined){
      this.$router.replace('/admin')
    }else{
      axios.get('loginadmin.php?id='+this.idu
      ).then((result)=>{

        this.logadmin.id=this.idu
        this.logadmin.ingreso='yes'
        this.userd= result.data
        const parsed = JSON.stringify(this.logadmin);
        localStorage.setItem('adminL', parsed);
        this.$router.replace('/admin/users')
      })
    }
  },
  methods:{
    cambiar(c){
      console.log(c)
      const fd = new FormData()
      fd.append('costo',c)
      axios.post('costo.php', fd)
      .then((re)=>{
        console.log(re.data)
        this.dialogA=false
      })
    },
    exit(){
      localStorage.removeItem('adminL')
      this.$router.replace('/admin')
    },
    menudi(title){
      if (title=='Reportes'){
        return this.$router.push('/admin/reportes')
      }
      if (title=='Usuarios'){
        return this.$router.push('/admin/users')
      }
      if (title=='Clientes'){
        return this.$router.push('/admin/clientes')
      }
      if (title=='Productos'){
        return this.$router.push('/admin/productos')
      }
      if (title=='Categorias'){
        return this.$router.push('/admin/categorias')
      }
      if (title=='Pedidos'){
        return this.$router.push('/admin/pedidos')
      }
      if (title=='Promocion'){
        return this.$router.push('/admin/promocion')
      }
      if (title=='Carrusel'){
        return this.$router.push('/admin/carrusel')
      }
      if (title=='Costo de envio'){
        this.dialogA=true
      }
    },
    moveritem(title){
      console.log(title);
      if (title == 'Usuarios Inactivos'){
       // scroller('#uin', {offset: -70})
      }
      if(title == 'Usuarios Activos'){
     //   scroller('#uac',{offset: -70})
      }
    }

  }
}
</script>

<style scoped>

</style>