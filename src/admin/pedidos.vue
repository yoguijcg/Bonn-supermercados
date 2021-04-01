<template>
  <div>
    <v-col cols="12">
      <v-card>
        <v-card-title>
          <v-icon color="success" size="40">mdi-bike</v-icon> &nbsp;
          <h3>Pedidos Recientes</h3>
        </v-card-title>
        <v-card-text>
          <v-toolbar>
            <v-col cols="12">
              <v-text-field
                  v-model="search"
                  append-icon="mdi-magnify"
                  label="Search"
                  single-line
                  hide-details
              ></v-text-field>
            </v-col>
          </v-toolbar>
          <v-data-table
              :headers="headers"
              :items="pedidos"
              :search="search"
              sort-by="calories"
              class="elevation-1"
          >
            <template v-slot:item.cliente="{item}">
              {{item.nombre}} &nbsp; {{item.apellidos}}
            </template>
            <template v-slot:item.direccion="{item}">
              <v-btn color="info" outlined small @click="dir(item.direccion)">
                <v-icon>mdi-eye</v-icon>
              </v-btn>
            </template>
            <template v-slot:item.detalles="{item}">
              {{item.apellido}} {{item.nit}}
            </template>
            <template v-slot:item.prod="{item}">
              <v-btn color="success" outlined small @click="prod(item.id)">
                <v-icon>mdi-cart-variant</v-icon>
              </v-btn>
            </template>
            <template v-slot:item.actions="{ item }">
              <v-icon
                  color="success"
                  @click="yes(item)"
              >
                mdi-check
              </v-icon>
              <v-icon
                  color="error"
                  @click="not(item)"
              >
                mdi-close
              </v-icon>
            </template>


          </v-data-table>
        </v-card-text>
      </v-card>
      <br>
      <v-card>
        <v-card-title>
          <v-icon color="error">mdi-bicycle-penny-farthing</v-icon>
          <h3>Pedidos Entregados</h3>
        </v-card-title>
        <v-card-text>
          <v-toolbar>
            <v-row>
              <v-col cols="12" md="12">
                <v-text-field
                    v-model="searchI"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
              </v-col>
            </v-row>
          </v-toolbar>
          <v-data-table
              :headers="headersI"
              :items="pedidosV"
              :search="searchI"
              sort-by="calories"
              class="elevation-1"
          >
            <template v-slot:item.cliente="{item}">
              {{item.nombre}} &nbsp; {{item.apellidos}}
            </template>
            <template v-slot:item.direccion="{item}">
              <v-btn color="info" outlined small @click="dir(item.direccion)">
                <v-icon>mdi-eye</v-icon>
              </v-btn>
            </template>
            <template v-slot:item.detalles="{item}">
              {{item.apellido}} {{item.nit}}
            </template>
            <template v-slot:item.prod="{item}">
              <v-btn color="success" outlined small @click="prod(item.id)">
                <v-icon>mdi-cart-variant</v-icon>
              </v-btn>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>

    </v-col>
    <v-dialog
        v-model="dialogdir"
        width="700"
    >
      <v-card>
        <v-card-title>
          direccion  del cliente
        </v-card-title>
        <v-card-text style="max-height: 60vh; ">
          <v-row>
            <v-col cols="12" md="6">
              <v-text-field label="titulo" :value="direc.titulo"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field label="direccion" :value="direc.direccion"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field label="tipo" :value="direc.domicilio"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field label="numero de puerta" :value="direc.puerta"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field label="referencia" :value="direc.referencia"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field label="telefono" :value="direc.telefono"></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field label="ubicacion coordenadas" :value="direc.ubicacion"></v-text-field>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-col cols="4">
            <v-btn block color="error" @click="dialogdir=false">
              <v-icon>mdi-close</v-icon>
              <v-spacer></v-spacer>
              Cerrar
              <v-spacer></v-spacer>
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-col>
        </v-card-actions>
      </v-card>
    </v-dialog>


    <v-dialog
      v-model="dialogprod"
      width="800"
    >
    <v-card>
      <v-card-text>
        <v-row>
          <v-col cols="12" md="6">

            <v-card>
              <v-card-title>
                Productos
              </v-card-title>
              <v-card-text style="max-height: 60vh; overflow-y: scroll;">
                <v-col cols="12" v-for="(pr,x) in productos" :key="x">
                  <v-card>
                    <v-row style="margin: 1%;">
                      <div>
                        <h3>Nombre:</h3>
                        <h4>{{pr.nombre}}</h4>
                        <h3>Cantidad:</h3>
                        <h4>{{pr.cantidad}}</h4>
                      </div>
                      <v-spacer></v-spacer>
                      <v-img
                          :src="'https://bonnsupermercados.com/'+pr.imagen"
                          :aspect-ratio="16/9"
                          width="100"
                      ></v-img>
                    </v-row>
                  </v-card>
                </v-col>
              </v-card-text>
            </v-card>
          </v-col>

          <v-col cols="12" md="6">
            <v-card>
              <v-card-title>
                Promocion
              </v-card-title>
              <v-card-text style="max-height: 60vh; overflow-y: scroll;">
                <v-col cols="12" v-for="(pm,x) in promocion" :key="x">
                  <v-card>
                    <v-row style="margin: 1%;">
                      <div>
                        <h3>Nombre:</h3>
                        <h4>{{pm.nombre}}</h4>
                        <h3>Cantidad:</h3>
                        <h4>{{pm.cantidad}}</h4>
                      </div>
                      <v-spacer></v-spacer>
                      <v-img
                          :src="'https://bonnsupermercados.com/'+pm.imagen"
                          :aspect-ratio="16/9"
                          width="100"
                      ></v-img>
                    </v-row>
                  </v-card>
                </v-col>
              </v-card-text>
            </v-card>
          </v-col>

        </v-row>

      </v-card-text>
      <v-card-actions>
        <v-col cols="8">
          <v-btn block color="success">
            <v-icon>mdi-cart-variant</v-icon>
            <v-spacer></v-spacer>
            <h3>{{scant}} Articulos</h3>
            -----
            <h3>{{sprec}} Bs.</h3>
            <v-spacer></v-spacer>
            <v-icon>mdi-cart-variant</v-icon>
          </v-btn>
        </v-col>
        <v-col cols="4">
          <v-btn block color="error" @click="dialogprod=false">
            <v-icon>mdi-close</v-icon>
            <v-spacer></v-spacer>
            cerrar
            <v-spacer></v-spacer>
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-col>
      </v-card-actions>
    </v-card>
  </v-dialog>

  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: "pedidos",
  data:()=>({
    headers: [
      { text: 'Cliente', value: 'cliente' },
      { text: 'Direccion', value: 'direccion' },
      { text: 'Fecha', value: 'fecha' },
      { text: 'Hora de pedido', value: 'time' },
      { text: 'Hora de entrega', value: 'hora' },
      { text: 'Metodo', value: 'metodo' },
      { text: 'D. factura', value: 'detalles' },
      { text: 'Productos', value: 'prod' },
      { text: 'Entregado', value: 'actions', sortable: true },
    ],
    search:'',
    headersI: [
      { text: 'Cliente', value: 'cliente' },
      { text: 'Direccion', value: 'direccion' },
      { text: 'Fecha', value: 'fecha' },
      { text: 'Hora de pedido', value: 'time' },
      { text: 'Hora de entrega', value: 'hora' },
      { text: 'Metodo', value: 'metodo' },
      { text: 'D. factura', value: 'detalles' },
      { text: 'Productos', value: 'prod' },
    ],
    searchI:'',
    pedidos:[],
    pedidosV:[],
    dialogdir:false,
    dialogprod:false,
    direc:[],
    productos:[],
    promocion:[],
    scant:null,
    sprec:null,
  }),
  mounted() {
    this.ini()
  },
  methods:{
    ini(){
      axios.get('adminped.php?type=venta'
      ).then((re)=>{
        this.pedidos=re.data
      })
      axios.get('adminped.php?type=ventaR'
      ).then((re)=>{
        this.pedidosV=re.data
      })
    },
    dir(a){
      axios.get('adminped.php?type=dire&var='+a
      ).then((re)=>{
        this.direc=re.data
        this.dialogdir=true
        console.log(re.data)
      })
    },
    prod(b){
      axios.get('adminped.php?type=prodN&var='+b
      ).then((re)=>{
        this.productos=re.data
        axios.get('adminped.php?type=prodP&var='+b
        ).then((rr)=>{
          this.promocion=rr.data
          this.dialogprod=true
          this.sub()
        })
      })
    },
    sub(){
      var p=0
      var pr=this.productos
      var cp=0
      var pp=0
      while(p<pr.length){
        cp=cp+parseFloat(pr[p].cantidad)
        pp=pp+parseFloat(pr[p].precio)
        p++
      }
      var m=0
      var mr=this.promocion
      var cm=0
      var pm=0
      while(m<mr.length){
        cm=cm+parseFloat(mr[m].cantidad)
        pm=pm+parseFloat(mr[m].precio)
        m++
      }
      var cantidad=cm+cp
      var precio=pp+pm
      this.scant=cantidad
      this.sprec=precio

    },
    yes(i){
      axios.get('adminped.php?type=yes&var='+i.id
      ).then((r)=>{
        console.log(r.data)
        this.ini()
      })
    },
    not(i){
      axios.get('adminped.php?type=not&var='+i.id
      ).then((r)=>{
        console.log(r.data)
        this.ini()
      })
    }

  }
}
</script>

<style scoped>

</style>