<template>
  <div>
    <br><br><br><br><br>

    <div>
      <div >
        <h1 style="text-align: center;">Mi Pedido</h1>
      </div>
      <v-row style="margin: 1%;">
        <v-col cols="12" md="7" style="max-height: 85vh;overflow-y: auto;">
          <v-col cols="12">
            <v-card>
              <v-card-title>
                Entrega detalle
              </v-card-title>
              <div v-if="reve==false">
                <v-card-text style="max-height: 40vh; overflow-y: auto;">
                  <v-btn color="primary" small @click="drawer=true, width=600">
                    <v-icon>mdi-map-marker</v-icon>
                    Añadir Dirección
                  </v-btn>
                  <br><br>
                  <v-row>
                    <v-col md="5" cols="11" class="hov center" v-for="(d,n) in direcciones" :key="n">
                      <v-row>
                        <v-icon small>mdi-map-marker</v-icon>
                        <h4> {{ d.titulo }}</h4>
                        <v-spacer></v-spacer>
                        <v-btn small color="error" icon @click="deletedirec(d.id)">
                          <v-icon >mdi-delete</v-icon>
                        </v-btn>
                      </v-row>
                      <br>
                      <h5>Calle: {{d.direccion}}</h5>
                      <h5>Tel: {{d.telefono}}</h5>
                      <br>
                      <v-btn small block color="orange" dark @click="reve=true,entregaaqui(d)">
                        Entregar Aqui
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-card-text>
              </div>
              <div v-else>

                <v-card-text style="max-height: 30vh; overflow-y: auto;">
                  <v-row>
                    <v-icon color="info">mdi-map-marker-check-outline</v-icon>
                    <h2> Direccion Actual</h2>
                  </v-row>
                  <v-col cols="12" md="7" class="hov center">

                    <v-row>
                      <v-spacer></v-spacer>
                      <h4> {{ entrega.tit }}</h4>
                      <v-spacer></v-spacer>
                    </v-row>
                    <br>
                    <h5>Calle: {{entrega.dir}}</h5>
                    <h5>Tel: {{entrega.tel}}</h5>
                    <br>
                    <v-btn small color="orange" dark @click="reve=false">
                      Cambiar direccion
                    </v-btn>
                  </v-col>
                </v-card-text>
              </div>

            </v-card>
          </v-col>
          <v-col cols="12">
            <v-card>
              <v-card-title>
                Informacion adicional Para la factura
              </v-card-title>
              <v-card-text>
                <v-row>

                  <v-col md="5" cols="11" class="center">
                    <h4>Metodo de entrega</h4>
                    <v-select
                        :items="valos"
                        label="Seleccióne uno"
                        outlined
                        dense
                        v-model="factura.met"
                    ></v-select>
                  </v-col>

                  <v-col md="5" cols="11" class="center">
                    <h4>Hora de entrega</h4>
                    <v-select
                        :items="hora"
                        label="Seleccióne uno"
                        outlined
                        dense
                        v-model="factura.hor"
                    ></v-select>
                  </v-col>

                  <v-col md="5" cols="11" class="center">
                    <h4>Apellido - Razon Social</h4>
                    <v-text-field
                        placeholder="Apellido - Razon Social"
                        outlined
                        v-model="factura.ape"
                    >
                    </v-text-field>
                  </v-col>

                  <v-col md="5" cols="11" class="center">
                    <h4>CI/NIT</h4>
                    <v-text-field
                        placeholder="CI/NIT"
                        outlined
                        v-model="factura.nit"
                    >
                    </v-text-field>
                  </v-col>

                </v-row>

              </v-card-text>
            </v-card>
          </v-col>
        </v-col>

        <v-col cols="12" md="5" style="max-height: 85vh;">
          <v-col cols="12">
            <v-card>
              <v-card-title>
                <h4>Tu Carrito esta listo</h4>
                <v-row>
                  <v-spacer></v-spacer>
                  <v-btn
                      outlined
                      color="primary"
                      text
                      height="30"
                      x-small
                      @click="back()"
                  >
                    <v-icon>mdi-undo-variant</v-icon>
                    volver
                  </v-btn>

                  <v-btn
                      outlined
                      color="error"
                      height="30"
                      text
                      x-small
                      @click="deleteall()"
                  >
                    <v-icon>mdi-delete</v-icon>
                    Limpiar
                  </v-btn>
                </v-row>

              </v-card-title>
              <hr>
              <v-card-text style="max-height: 50vh; overflow-y: auto;">
                <v-col cols="12" v-for="(p,n) in detallesprod" :key="n">
                  <v-row>
                    <div style="width: 105px;">
                      <v-img :src="'https://bonnsupermercados.com/'+p.img" :aspect-ratio="16/9" >
                      </v-img>
                    </div>
                    <div style="width: 15px;"></div>
                    <div>
                      <h4>{{ p.nombre }}</h4>
                      <h5>{{ p.codigoBarras }}</h5>
                      <h4>{{ p.total }}</h4>
                    </div>


                    <v-spacer></v-spacer>
                    <v-btn x-small color="error" icon @click="restar(p,n)">
                      <v-icon
                      >mdi-minus-thick</v-icon>
                    </v-btn>
                    <input
                        type="number"
                        v-model="p.cantidad"
                        id="cart"
                        @keyup="input(p,n)"
                        min="1"
                    >
                    <v-btn x-small color="success" icon @click="sumar(p)">
                      <v-icon
                      >
                        mdi-plus-thick</v-icon>
                    </v-btn>
                  </v-row>
                </v-col>
              </v-card-text>
              <hr>
              <v-card-actions>
                <v-row class="centrear">
                  <h2>Total</h2>
                  <v-spacer></v-spacer>
                  <h2>Bs. {{ total }}</h2>
                </v-row>
              </v-card-actions>
            </v-card>

          </v-col>
        </v-col>
      </v-row>
    </div>

    <v-col cols="12" style="max-height: 10vh;">
      <v-col cols="12" md="3" style="margin: auto;">
        <v-btn block x-large color="success" @click="pago(factura)">
          Continuar
        </v-btn>
      </v-col>
    </v-col>

    <v-overlay :value="drawer"></v-overlay>
    <v-navigation-drawer
        v-model="drawer"
        absolute
        right
        temporary
        :width="width"
        hide-overlay
    >
      <div style="max-height: 97vh;">
        <v-row class="centrear">
          <v-spacer></v-spacer>
          <v-btn @click="drawer=false, width=0" icon color="error">
            <v-icon>
              mdi-close-circle
            </v-icon>
          </v-btn>
        </v-row>
        <v-row>
          <v-spacer></v-spacer>
          <h2>Agregar nueva dirección</h2>
          <v-spacer></v-spacer>
        </v-row>
        <v-row class="centrear">
          <v-col cols="12">
            <v-text-field
                outlined
                label="Numero de celular"
                type="number"
                prepend-inner-icon="mdi-phone"
                v-model="gps.tel"
            ></v-text-field>
          </v-col>
        </v-row>
        <div>
          <v-col cols="12">
            <div>
              <GoogleMap :title="'El pedido se entregara aqui'" />
            </div>
          </v-col>
        </div>
        <v-row class="centrear">

          <v-col cols="12" md="6">
            <v-text-field
                outlined
                id="cart"
                label="numero de puerta"
                type="number"
                placeholder="Numero de puerta"
                prepend-inner-icon="mdi-pound-box "
                v-model="gps.num"
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-text-field
                outlined
                label="Domicilio"
                prepend-inner-icon="mdi-home"
                v-model="gps.dom"
                placeholder="ej. casa, vivienda, edificio etc."
            ></v-text-field>
          </v-col>

          <v-col cols="12">
            <v-text-field
                outlined
                label="Punto de referecia"
                prepend-inner-icon="mdi-map-marker"
                v-model="gps.ref"
            ></v-text-field>
            <h4>Etiquetar para la direccion</h4>
            <v-radio-group v-model="gps.tipo" row>
              <h5>Casa</h5>
              <v-radio value="casa"></v-radio>
              <h5>Trabajo</h5>
              <v-radio value="trabajo"></v-radio>
              <h5>Otros</h5><br>
              <v-radio value="otros"></v-radio>
            </v-radio-group>
          </v-col>
          <v-spacer></v-spacer>
          <v-col cols="7">
            <v-btn block color="success" @click="guardar(gps)">
              Guardar
            </v-btn>
          </v-col>
          <v-spacer></v-spacer>
          <v-col cols="4" >

            <v-btn block color="info" outlined @click="drawer=false">
              Cancelar
            </v-btn>
          </v-col>
          <v-spacer></v-spacer>
        </v-row>

      </div>


    </v-navigation-drawer>

    <v-snackbar
        v-model="snack"
        color="info"
    >
      <h3><v-icon>mdi-alert</v-icon> Alguno de los datos esta mal</h3>
    </v-snackbar>

    <v-snackbar
        v-model="snackV"
        color="error"
    >
      <h3><v-icon>mdi-alert</v-icon> Ningun Campo puede estar vacio</h3>
    </v-snackbar>

    <v-snackbar
        v-model="snackM"
        color="info"
    >
      <h3><v-icon>mdi-alert</v-icon> Compras superiores a Bs. 50</h3>
    </v-snackbar>

    <v-dialog
        v-model="dialog"
        persistent
        width="500"
    >
      <v-card>
        <v-card-title>
          <v-spacer></v-spacer>
          <h2><v-icon x-large color="orange">mdi-emoticon-cry-outline</v-icon> Ya cerramos <br>vuelva mañana <v-icon x-large color="success">mdi-emoticon-wink-outline</v-icon></h2>
          <v-spacer></v-spacer>
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="success" text large @click="dialog=false"><h2>OK</h2></v-btn>
        </v-card-actions>
      </v-card>

    </v-dialog>

    <br><br><br>
  </div>
</template>

<script>
import GoogleMap from "./GoogleMap"
import axios from 'axios'
export default {
  name: "pedido",
  components: {
    GoogleMap
  },
  data:()=>({
    width:0,
    dialog:false,
    drawer:false,
    title:'',
    valos:[
      'Entrega a domicilio',
      'Recoger en tienda'
    ],
    hora:[],
    detallesprod:[],
    total:null,
    radios:'casa',
    direcciones:[],
    reve:false,
    gps:{
      tel:'',
      dir:'',
      num:'',
      dom:'',
      ref:'',
      tipo:'casa'
    },
    snack:false,
    snackV:false,
    snackM:false,
    entrega:{
      id:'',
      tit:'',
      dir:'',
      tel:''
    },
    factura:{
      met:'',
      hor:'',
      ape:'',
      nit:'',
      dir:''
    },
    cliente:[],
  }),
  mounted() {
    this.horad()
    this.cliente=JSON.parse(localStorage.getItem('login'))
    if (localStorage.getItem('prodetalles')) {
      try {
        this.detallesprod = JSON.parse(localStorage.getItem('prodetalles'));
      } catch(e) {
        localStorage.removeItem('prodetalles');
      }
    }
    this.totall()
    this.dire()
    this.valores()
  },
  methods:{
    dire(){
      axios.get('cliped.php?type=dir&id='+this.cliente.id
      ).then((re)=>{
        this.direcciones=re.data
      })
    },
    deleteall(){
      this.detallesprod.splice(0);
      const parsed = JSON.stringify(this.detallesprod);
      localStorage.setItem('prodetalles', parsed);
    },
    back(){
      this.$router.go(-1)
    },
    input(d,n){
      var vacio  = parseInt(document.getElementById('cart').value)
      if (vacio==0){
        this.detallesprod.splice(n, 1);
        this.savePro();
      }else{
        if (d.cantidad<0){
          document.getElementById('cart').value = 1
          let precio = d.precio * 1
          this.detallesprod.find(file => file.id === d.id).cantidad = 1
          this.detallesprod.find(file => file.id === d.id).total = precio
          this.savePro()
        }else{
          let precio = d.precio * d.cantidad
          this.detallesprod.find(file => file.id === d.id).cantidad = d.cantidad
          this.detallesprod.find(file => file.id === d.id).total = precio
          this.savePro()
        }
      }
    },
    horad(){
      var h = new Date()
      var time = 21-h.getHours()
      var i
      var es
      if (h.getHours()<9){
        i=9-h.getHours()
      }else{
        i=1
      }
      while (i<=time){
        es=h.getHours()+i
        this.hora.push(es+':00 hrs.')
        i++
      }

    },
    pago(f){
      if (this.total>50){
        var h = new Date()

        if(h.getHours()>=25){
          this.dialog=true
        }else{
          f.dir=this.entrega.id
          if (f.dir=='' || f.met=='' || f.ape=='' || f.nit=='' || f.hor==''){//
            this.snackV=true
            return
          }
          const parsed = JSON.stringify(f);
          localStorage.setItem('factura', parsed);
          this.$router.replace('/market/pago')
        }

      }else{
        this.snackM=true
      }

    },
    totall(){
      var d = this.detallesprod
      var i = 0
      var subtotal = 0
      while (i<d.length){
        subtotal = subtotal + d[i].total
        i++
      }
      this.total=subtotal
    },
    savePro() {
      const parsed = JSON.stringify(this.detallesprod);
      localStorage.setItem('prodetalles', parsed);
      this.totall()
      this.valores()
    },
    sumar(r){
      var sum = parseInt(r.cantidad)
      sum = sum+1
      let precio = r.precio * sum
      this.detallesprod.find(file => file.id === r.id).cantidad = sum
      this.detallesprod.find(file => file.id === r.id).total = precio
      this.savePro()

    },
    restar(r,n){
      var res =parseInt(r.cantidad)
      res = res-1
      if (res==0){
        this.detallesprod.splice(n, 1);
        this.savePro();
      }else{
        let precio = r.precio * res
        this.detallesprod.find(file => file.id === r.id).cantidad = res
        this.detallesprod.find(file => file.id === r.id).total = precio
        this.savePro()
      }
    },
    guardar(g){
      g.dir= localStorage.direccion
      let ubi=localStorage.lat+','+localStorage.lng
      if (g.tel=='' || g.ref=='' || g.dom=='' || g.num=='' || g.dir==''){
        this.snackV=true
      }else{
        const fd= new FormData()

        fd.append('idcli',this.cliente.id)
        fd.append('tel',g.tel)
        fd.append('ref',g.ref)
        fd.append('dom',g.dom)
        fd.append('num',g.num)
        fd.append('dir',g.dir)
        fd.append('tipo',g.tipo)
        fd.append('ubi',ubi)

        axios.post('cliped.php', fd
        ).then((r)=>{
          if(r.data=='success'){
            this.dire()
            this.drawer=false
          }else{
            this.snack=true
          }
        })
      }
    },
    entregaaqui(a){
      this.entrega.id=a.id
      this.entrega.tit=a.titulo
      this.entrega.dir=a.direccion
      this.entrega.tel=a.telefono
    },
    deletedirec(id){
      axios.get('cliped.php?type=deldir&id='+id
      ).then((re)=>{
        console.log(re.data)
        this.dire()
      })
    },
    valores(){
      let p =this.detallesprod
      let i = 0
      let sub=0
      let can=0
      while (i<p.length){
        sub=sub + p[i].total
        can=can + parseInt(p[i].cantidad)
        i++
      }
      this.$store.state.cantidad=can
      this.$store.state.precio=sub
    }
  }
}
</script>

<style scoped>
#cart{
  width: 35px;
  border-radius: 5px;
  height: 20px;
  text-align: center;
  border: black solid  2px;
}

#cart::-webkit-inner-spin-button,
#cart::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

#cart { -moz-appearance:textfield; }
.hov:hover{
  cursor: pointer;
  border: #9bc220 solid 2px;
}
.center{
  margin: auto;
}
.centrear{margin: 1%;}
#cart input[type='number'] {
  -moz-appearance:textfield;
}
#cart input::-webkit-outer-spin-button,
#cart input::-webkit-inner-spin-button {
  -webkit-appearance: none;
}
</style>