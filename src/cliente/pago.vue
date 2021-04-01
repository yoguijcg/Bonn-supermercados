<template>
  <div>

    <div>
      <br><br><br><br>
      <div style="text-align: center;">
        <h1>Último Paso</h1>
        <v-col cols="12" md="7" class="center">
          <v-card>
            <v-card-title>
              <v-icon x-large color="green">mdi-cash</v-icon>
              <h3>COSTOS</h3>
            </v-card-title>
            <hr>
            <v-card-text >
              <v-col cols="11" class="center">
                <v-row>
                  <h4>Total Parcial</h4>
                  <v-spacer></v-spacer>
                  <h4>Bs. {{stotal}}</h4>
                </v-row>
                <hr>
              </v-col>
              <v-col cols="11" class="center">
                <v-row>
                  <h4>Costo De Envío</h4>
                  <v-spacer></v-spacer>
                  <h4>Bs. {{ delevery }}</h4>
                </v-row>
                <hr>
              </v-col>
              <v-col cols="11" class="center">
                <v-row>
                  <h4>Total</h4>
                  <v-spacer></v-spacer>
                  <h4>Bs. {{ total }}</h4>
                </v-row>
                <hr>
              </v-col>
            </v-card-text>
            <hr>
            <!--
            <v-card-title>
              <v-row class="centro">
                <v-icon>mdi-map</v-icon>
                <h3> Promoción</h3>
                <v-spacer></v-spacer>
                <h4 class="promocion"> Añadir un código de promoción / referencia</h4>
              </v-row>
            </v-card-title>
-->

          </v-card>
          <v-col cols="11" md="4" class="center">
            <v-btn
                color="success"
                @click="final(total)"
            >
              Enviar Pedido Bs. {{total}}
            </v-btn>
          </v-col>
        </v-col>
      </div>
    </div>

    <v-dialog
        v-model="dialog"
        max-width="500"
        persistent
    >
      <v-card>
        <v-card-title>
          <v-spacer></v-spacer>
          <h4>¿Estas seguro de hacer la compra?</h4>
          <v-spacer></v-spacer>
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="error" text @click="dialog=false"
          >
            <h2>NO</h2>
          </v-btn>
          <v-btn color="success" text @click="comprar()"
          >
            <h2>SI</h2>
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-snackbar
        v-model="snackM"
        color="info"
    >
      <h3><v-icon>mdi-alert</v-icon> Compras superiores a Bs. 50</h3>
    </v-snackbar>


  </div>
</template>

<script>
import axios from 'axios'
export default {
name: "pago",
  data:()=>({
    prod:[],
    delevery:'',
    stotal:'',
    total:'',
    snackM:false,
    dialog:false,
    factura:[],
    cliente:[],
  }),
  mounted() {
    this.cliente=JSON.parse(localStorage.getItem('login'))

    if (localStorage.getItem('prodetalles')) {
      try {
        this.prod = JSON.parse(localStorage.getItem('prodetalles'));
      } catch(e) {
        localStorage.removeItem('prodetalles');
      }
    }
    this.totall()
    this.tod()
  },
  methods:{
    totall(){
      var d = this.prod
      var i = 0
      var subtotal = 0
      while (i<d.length){
        subtotal = subtotal + d[i].total
        i++
      }
      this.stotal=subtotal
    },
    tod(){
      axios.get('clipag.php?type=delevery').then((r)=>{
        this.delevery=r.data.costo
        var a = this.stotal
        var b = this.delevery
        this.total=parseFloat(a)+parseFloat(b)
      })
    },
    final(t){
      if (t<50){
        this.snackM=true
        return
      }
      this.dialog=true
    },
    comprar(){
      this.factura=JSON.parse(localStorage.getItem('factura'))
      let f =this.factura
      var fe = new Date();
      var fec=fe.getFullYear() + "-" + (fe.getMonth() +1) + "-" +fe.getDate()
      var time= fe.getHours()+':'+fe.getMinutes()
      //console.error(time)
      const fd = new FormData()
      fd.append('type','venta')
      fd.append('cli',this.cliente.id)
      fd.append('dir',f.dir)
      fd.append('cos','1')
      fd.append('hor',f.hor)
      fd.append('met',f.met)
      fd.append('ape',f.ape)
      fd.append('nit',f.nit)
      fd.append('fec',fec)
      fd.append('tot',this.total)
      fd.append('tim',time)

      axios.post('clipag.php', fd
      ).then((r)=>{
        var det = this.prod
        var i = 0
        while (i<det.length){
          const fr = new FormData()
          fr.append('type','detall')
          fr.append('vet',r.data)
          fr.append('pro',det[i].id)
          fr.append('can',det[i].cantidad)
          fr.append('pre',det[i].total)
          fr.append('typ',det[i].type)
          axios.post('clipag.php',fr
          ).then((re)=>{
            console.log(re.data)
          })
          i++
        }
        if(i==det.length){
          this.dialog=false
          localStorage.removeItem('prodetalles');
          localStorage.removeItem('factura')
          this.$router.replace('/market/inicio')
        }
      })
    },

  }
}
</script>

<style scoped>
.center{
  margin: auto;
}
.centro{
  margin: 1%;
}
.promocion{
  color: #e30d18;
  border-bottom: #e30d18 solid 2px;
}
.promocion:hover{
  cursor: pointer;
  color: #9bc220;
  border: #9bc220 solid 2px;
}
</style>