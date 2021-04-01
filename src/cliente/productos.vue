<template>
  <div>
    <br>
    <div v-if="!isMobile()">
      <v-main>
        <div style="background: darkred; height: 300px; width: 40%; z-index: 2; position: absolute; top: 50%; margin-top: -150px; border-radius: 50px; margin-left: 1%;">
          <v-container>
            <v-col cols="9" style="margin: auto; text-align: center;">
              <br><br><br>
              <h2 class="dis">usted  esta en el almacen de :</h2>
              <h1 class="dis">{{ cat1.titulo_tres }}</h1>
            </v-col>
          </v-container>
        </div>
        <v-img style="border-radius:50px; z-index: 1; width: 65%; margin-left: 34%; height: auto;" :src="img"></v-img>
        <br>
      </v-main>
    </div>
    <div v-else>
      <v-main>

        <v-img style="border-radius:50px; z-index: 2; height: auto;" :src="img"></v-img>
        <div style="background: black; border-radius: 0px 0px 20px 20px; margin-top: -40px;">
            <v-col cols="12" style="text-align: center;">
              <br>
              <h3 class="dis">usted  esta en el almacen de :</h3>
              <h4 class="dis">{{ cat1.titulo_tres }}</h4>
            </v-col>
        </div>
        <br>
      </v-main>
    </div>

    <div>
      <v-row style="margin: 1%;">
        <v-col cols="12" md="3"><!--style="width: 22%;"-->
          <v-card>
            <v-card-title>
              <h3>Menú de {{cat1.titulo}}</h3>
            </v-card-title>
            <hr>
            <v-card-text>
              <div style="max-height: 65vh; overflow-y: auto;">
                <v-list>
                  <v-list-group
                      v-for="(t,i) in cat2"
                      :key="i"
                      @click="catt(t.titulo_dos)"
                  >
                    <template v-slot:activator>
                      <v-list-item-content >
                        <v-list-item-title v-text="t.titulo_dos"></v-list-item-title>
                      </v-list-item-content>
                    </template>
                    <v-list-item
                        v-for="(i,x) in cat3"
                        :key="x"
                        dark
                        style="background: darkgrey;"
                    >
                      <v-list-item-content>
                        <v-list-item-title v-text="i.titulo_tres" @click="update(i)" ></v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>


                  </v-list-group>
                </v-list>
              </div>
            </v-card-text>
          </v-card>
        </v-col>

        <v-col cols="12"  md="6" ><!-- style="width: 56%; background: whitesmoke; ""-->
          <v-card>
            <v-card-title>
              <h3>Productos de {{cat1.titulo_tres}}</h3>
              <v-spacer></v-spacer>
              <v-icon color="#9bc220" large>mdi-cart</v-icon>
            </v-card-title>
            <hr>
            <v-card-text>
              <v-row style="overflow-y: auto;max-height: 65vh">
                <v-col
                    v-for="(p,x) in prod"
                    :key="x"
                    class="d-flex child-flex"
                    cols="6"
                    md="4"
                >

                  <v-hover v-slot="{ hover }">
                    <v-card
                        color="grey lighten-4"
                    >

                      <v-img
                          :src="'https://bonnsupermercados.com/'+p.imagen"
                          :aspect-ratio="16/9"
                      >
                        <v-expand-transition>
                          <div
                              v-if="hover"
                              class="d-flex transition-fast-in-fast-out darken-2 display-3 white--text"
                              style="height: 100%;align-items: center;bottom: 0;justify-content: center;opacity: .7;position: absolute;width: 100%; background: #dedc03;"
                          >
                            <v-btn icon large dark color="black" @click="mostrar(p)">
                              <v-icon>mdi-eye</v-icon>
                            </v-btn>
                          </div>
                        </v-expand-transition>
                      </v-img>
                      <v-card-text
                          style="height: 100px; overflow-y: auto;"
                      >
                        <h4>
                          {{p.nombre}}
                        </h4>
                        <br>
                        <h5>
                          <v-icon>mdi-barcode</v-icon>
                          {{ p.codigoBarras }}
                        </h5>
                      </v-card-text>
                      <v-divider></v-divider>
                      <div style="height: 40px;">
                        <div >
                          <h3 style="text-align: end; padding-top: 8px; margin-right: 5%;"
                          >
                            Bs. {{p.precioV}}
                          </h3>
                        </div>
                        <v-expand-transition>
                          <div
                              v-if="hover"
                              class="d-flex transition-fast-in-fast-out darken-2 v-card--reveal  white--text"
                              style="height: 40px;align-items: center;bottom: 0;justify-content: center;position: absolute;width: 100%;background:#9bc220;"
                          >
                            <div style="background: white;">
                              <input
                                  style="width: 40px; border: black solid 2px; border-radius: 5px; text-align: center"
                                  type="number"
                                  value="1"
                                  min="1"
                                  id="cprod"
                              >
                            </div>
                            <v-btn icon dark @click="agregar(p)">
                              <v-icon>
                                mdi-cart-plus
                              </v-icon>
                            </v-btn>

                          </div>
                        </v-expand-transition>
                      </div>
                    </v-card>

                  </v-hover>
                </v-col>
              </v-row>

            </v-card-text>
          </v-card>
        </v-col>

        <v-col cols="12" md="3" ><!--  style="width: 22%; background: green;" -->
          <v-card>
            <v-card-title>
              Carrito
              <v-spacer></v-spacer>
              <v-btn color="error" icon @click="deleteprod()">
                <v-icon>mdi-delete</v-icon>
              </v-btn>
            </v-card-title>
            <hr>
            <v-card-text>
              <div style="max-height: 65vh; overflow-y: auto;">
                <v-col cols="12" v-for="(p,n) in detallesprod" :key="n" >
                  <v-row style="margin:2%;">
                    <div>
                      <h4>{{ p.nombre }}</h4>
                      <h5>{{ p.codigo }}</h5>
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
                  <hr>
                </v-col>

              </div>
            </v-card-text>
            <hr>
            <v-card-actions>
              <v-btn block color="success" @click="mipedido()">Mi Pedido</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </div>

    <v-dialog
        v-model="preview"
        width="95%"
    >
      <v-row>
        <v-col md="3" cols="12">
          <v-card>
            <v-card-title>
              Promociones
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text style="height: 70vh; overflow-y: auto;">
              <v-col
                  v-for="(pr,a) in promo"
                  :key="a"
                  class="d-flex child-flex"
                  cols="12"
              >

                <v-hover v-slot="{ hover }">
                  <v-card
                      color="grey lighten-4"
                  >

                    <v-img
                        :src="'https://bonnsupermercados.com/'+pr.imagen"
                        :aspect-ratio="16/9"
                    >
                    </v-img>
                    <v-card-text
                        class="pt-6"
                        style="height: 100px; overflow-y: auto;"
                    >
                      <h4>
                        {{pr.nombre}}
                      </h4>
                      <br>
                      <h5>
                        <v-icon>mdi-barcode</v-icon>
                        {{ pr.codigoBarras }}
                      </h5>
                    </v-card-text>
                    <v-divider></v-divider>
                    <div style="height: 40px;">
                      <div >
                        <h3 style="text-align: end; padding-top: 8px; margin-right: 5%;"
                        >
                          Bs. {{pr.total}}
                        </h3>
                      </div>
                      <v-expand-transition>
                        <div
                            v-if="hover"
                            class="d-flex transition-fast-in-fast-out darken-2 v-card--reveal  white--text"
                            style="height: 40px;align-items: center;bottom: 0;justify-content: center;position: absolute;width: 100%;background:#9bc220;"
                        >
                          <v-btn text dark @click="promoe(pr.id)">
                            <v-icon>
                              mdi-cart-arrow-right
                            </v-icon>
                            ver producto
                          </v-btn>

                        </div>
                      </v-expand-transition>
                    </div>
                  </v-card>

                </v-hover>
              </v-col>

            </v-card-text>
          </v-card>
        </v-col>

        <v-col md="6" cols="12">
          <v-card>
            <v-card-title>
              <h3>{{predat.nombre}}</h3>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text style="max-height: 60vh; overflow-y: auto">
              <v-row>
                <v-col cols="6">
                  <v-img :src="'https://bonnsupermercados.com/'+predat.imagen" :aspect-ratio="9/9"> <!--:aspect-ratio="16/9"-->
                  </v-img>
                </v-col>
                <v-col cols="6">
                  <h3>Precio:</h3>
                  <h4>{{predat.precioV}}</h4><br>
                  <h3>Distribuidor:</h3>
                  <h4>{{predat.empresa}}</h4><br>
                  <h3>Descripcion:</h3>
                  <h4>{{predat.descripcion}}</h4><br>
                  <h3>Barcode: </h3>
                  <h4>{{predat.codigoBarras}}</h4><br>


                </v-col>
              </v-row>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions
                class=""
                style="align-items: center;justify-content: center;width: 100%;"
            >
              <v-spacer></v-spacer>

              <div style="background: white;">

                <input
                    style="width: 70px; border: black solid 2px; border-radius: 5px; text-align: center"
                    type="number"
                    :value="1"
                    min="1"
                    id="cprod2"
                >
              </div>
              <div style="width: 12px;"></div>
              <v-btn x-large icon dark color="success" @click="agregar2(predat)">
                <v-icon>mdi-cart-plus</v-icon>
              </v-btn>
              <v-spacer></v-spacer>
              <v-btn text color="error" @click="preview=false">
                Cancelar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>

        <v-col md="3" cols="12">
          <v-card>
            <v-card-title>
              Lo Mas Vendido
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text style="height: 70vh; overflow-y: auto;">
              <v-col
                  v-for="(p,x) in masvend"
                  :key="x"
                  class="d-flex child-flex"
                  cols="12"
              >

                <v-hover v-slot="{ hover }">
                  <v-card
                      color="grey lighten-4"
                  >

                    <v-img
                        :src="'https://bonnsupermercados.com/'+p.imagen"
                        :aspect-ratio="16/9"
                    >
                    </v-img>
                    <v-card-text
                        class="pt-6"
                        style="height: 100px; overflow-y: auto;"
                    >
                      <h4>
                        {{p.nombre}}
                      </h4>
                      <br>
                      <h5>
                        <v-icon>mdi-barcode</v-icon>
                        {{ p.codigoBarras }}
                      </h5>

                    </v-card-text>
                    <v-divider></v-divider>
                    <div style="height: 40px;">
                      <div >
                        <h3 style="text-align: end; padding-top: 8px; margin-right: 5%;"
                        >
                          Bs. {{p.precioV}}
                        </h3>
                      </div>
                      <v-expand-transition>
                        <div
                            v-if="hover"
                            class="d-flex transition-fast-in-fast-out darken-2 v-card--reveal  white--text"
                            style="height: 40px;align-items: center;bottom: 0;justify-content: center;position: absolute;width: 100%;background:#9bc220;"
                        >
                          <v-btn text dark @click="masvendido(p)">
                            <v-icon>
                              mdi-cart-arrow-right
                            </v-icon>
                            ver producto
                          </v-btn>

                        </div>
                      </v-expand-transition>
                    </div>
                  </v-card>

                </v-hover>
              </v-col>

            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-dialog>

    <v-snackbar
        v-model="snack"
        color="error"
    >
      <h3><v-icon>mdi-alert</v-icon> Ya tiene este producto en su carrito </h3>
    </v-snackbar>

    <v-snackbar
        v-model="snackV"
        color="info"
    >
      <h3><v-icon>mdi-alert</v-icon> Compras superiores a Bs. 50</h3>
    </v-snackbar>

  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: "productos",
  data: ()=>({
    idu:null,
    title:'1',
    ver: '',
    cat1:[],
    cat2:[],
    cat3:[],
    prod:[],
    masvend:[],
    img:'',
    preview:false,
    predat:[],
    promo:[],
    cantidad:'1',
    cantida:'',
    detallesprod:[],
    snack:false,
    snackV:false,

  }),
  watch:{
    '$route.params.prod':function (val){
      //console.log('watch: '+val)
      if (val == this.idu){
        console.error('misma varible')
      }else{
        this.idu=val
        this.cargarprod()
      }
    }
  },
  mounted() {
    this.cargarprod()
    if (localStorage.getItem('prodetalles')) {
      try {
        this.detallesprod = JSON.parse(localStorage.getItem('prodetalles'));
      } catch(e) {
        localStorage.removeItem('prodetalles');
      }
    }
    this.valores()
    axios.get('cliini.php?type=masven'
    ).then((r)=>{
      this.masvend=r.data
    })
  },
  methods:{
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
    cargarprod(){
      this.idu =this.$route.params.prod
      if (this.idu== null){
        console.log('esto no esta definido')
      }else{
        axios.get('cliprod.php?type=prod&bus='+this.idu
        ).then((d)=>{
          this.prod=d.data
        })
        axios.get('cliprod.php?type=cat1&bus='+this.idu
        ).then((res)=>{
          if (res.data==''){
            console.log('')
          }else{
            axios.get('cliprod.php?type=prom'
            ).then((r)=>{
              this.promo=r.data
            })
            this.cat1 = res.data
            this.img='https://bonnsupermercados.com/'+this.cat1.img
            axios.get('cliprod.php?type=cat2&bus='+this.cat1.titulo
            ).then((re)=>{
              this.cat2 = re.data
            })
          }
        })
      }
    },

    catt(t){
      axios.get('cliprod.php?type=cat3&bus='+t
      ).then((res)=>{
        this.cat3 = res.data
      })
    },
    promoe(e){
      console.warn(e)
    },
    masvendido(i){
      axios.get('cliprod.php?type=mas&id='+i.id
      ).then((r)=>{
        this.$router.push('/market/productos/'+r.data.categoria)
        this.preview=false
      })
    },
    agregar(c){
      let cantidad =document.getElementById('cprod').value
      let tot = cantidad* c.precioV
      if (this.detallesprod.find(file => file.id === c.id)==undefined){
        this.detallesprod.push({
          id:c.id,
          nombre:c.nombre,
          codigo:c.codigoBarras,
          precio:c.precioV,
          cantidad:cantidad,
          total:tot,
          img:c.imagen,
          type:'normal',
        });
        this.savePro();
      }else{
        this.snack=true
      }

    },
    agregar2(c){
      let cantidad =document.getElementById('cprod2').value
      let tot = cantidad* c.precioV
      if (this.detallesprod.find(file => file.id === c.id)==undefined){
        this.detallesprod.push({
          id:c.id,
          nombre:c.nombre,
          codigo:c.codigoBarras,
          precio:c.precioV,
          cantidad:cantidad,
          total:tot,
          img:c.imagen,
          type:'normal',
        });
        this.savePro();
      }else{
        this.snack=true
      }
    },
    removeCat(x) {
      this.detallesprod.splice(x, 1);
      this.savePro();
    },
    savePro() {
      const parsed = JSON.stringify(this.detallesprod);
      localStorage.setItem('prodetalles', parsed);
      this.valores()
    },
    deleteprod(){
      this.detallesprod.splice(0);
      const parsed = JSON.stringify(this.detallesprod);
      localStorage.setItem('prodetalles', parsed);
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
    update(d){
      this.$router.push('/market/productos/'+d.id)
    },
    mostrar(e){
      this.preview=true
      this.predat=e
      //console.log(e)
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
    mipedido(){
      var d = this.detallesprod
      var i = 0
      var subtotal = 0
      while (i<d.length){
        subtotal = subtotal + d[i].total
        i++
      }
      if (subtotal<='50'){
        this.snackV=true
      }else{
        this.$router.push('/market/pedido')
      }
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
  },

}
</script>

<style scoped>
.dis{
  color: #9bc220;
  text-shadow:
      3px 3px 2px black,
      7px 7px 3px #9bc220;
}
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
</style>