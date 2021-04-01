<template>
  <div>

    <v-col cols="12">
      <v-card>
        <v-card-title>
          <v-icon color="success" large>mdi-star-check-outline</v-icon> &nbsp;
          <h3>Promociones Vigentes</h3>
        </v-card-title>
        <v-card-text>
          <v-toolbar>
            <v-row>
              <v-col cols="5" md="3" >
                <v-btn
                    color="success"
                    block
                    @click="dialogCreate=true"
                >
                  <v-icon
                  >
                    mdi-star-plus-outline
                  </v-icon> &nbsp;
                  <h4>nueva promocion</h4>
                </v-btn>
              </v-col>
              <v-col cols="7" md="9">
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
              </v-col>
            </v-row>
          </v-toolbar>
          <v-data-table
              :headers="headers"
              :items="promac"
              :search="search"
              sort-by="calories"
              class="elevation-1"
          >
            <template v-slot:item.imgs="{item}">
              <v-img width="200" height="100" :src="'https://bonnsupermercados.com/'+item.imagen"></v-img>
            </template>
            <template v-slot:item.actions="{ item }">
              <v-icon
                  color="orange"
                  @click="editItem(item)"
              >
                mdi-pencil
              </v-icon>
              <v-icon
                  color="error"
                  @click="deleteItem(item)"
              >
                mdi-cart-remove
              </v-icon>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
      <br>

      <v-card>
        <v-card-title>
          <v-icon color="error" large>mdi-cart-remove</v-icon>
          <h3>Promociones Caducadas</h3>
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
              :items="promin"
              :search="searchI"
              sort-by="calories"
              class="elevation-1"
          >
            <template v-slot:item.imgs="{item}">
              <v-img width="200" height="100" :src="'https://bonnsupermercados.com//'+item.imagen"></v-img>
            </template>
            <template v-slot:item.actions="{ item }">
              <v-btn
                  color="success"
                  @click="restaurar(item)"
              >
                <v-icon
                >
                  mdi-cart-check
                </v-icon>
              </v-btn>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>

    </v-col>

    <v-dialog v-model="dialogCreate" max-width="700px">
      <v-overlay v-model="overlay">
        <v-progress-circular
            indeterminate
            size="150"
            width="10"
            color="primary"
            style="z-index: 1000;"
        >
          <h2>subiendo</h2>
        </v-progress-circular>
      </v-overlay>

      <v-card>
        <v-card-title>
          <v-icon color="success" large>mdi-star-plus</v-icon>
          <span class="headline">Crear Promocion</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-select
                    v-model="create.catu"
                    :items="cat1"
                    item-text="titulo"
                    label="Categoria 1"
                    @change="catd"
                >
                </v-select>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-select
                    v-model="create.catd"
                    :items="cat2"
                    item-text="titulo_dos"
                    label="Categoria 2"
                    @change="catt"
                >
                </v-select>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-select
                    v-model="create.catt"
                    :items="cat3"
                    item-text="titulo_tres"
                    label="Categoria 3"
                >
                </v-select>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.nombre"
                    label="Nombre"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.empresa"
                    label="Empresa"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.precio"
                    label="Precio"
                    prefix="Bs."
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="6"
              >
                <v-select
                    v-model="create.tipo"
                    :items="tipo"
                    label="Tipo de promocion"
                >
                </v-select>
              </v-col>
              <v-col
                  cols="12"
                  md="6"
              >
                <v-text-field
                    v-model="create.des"
                    prefix="%"
                    label="descuento"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.dias"
                    label="Dias Promocion"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.codigo"
                    label="Codigo de barras"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.descripcion"
                    label="descripcion"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="6"
              >
                <input type="file" @change="files" id="filesd" accept="image/*">
                <div>
                  <label for="filesd">
                    <v-icon dark>mdi-upload</v-icon>
                    <h4>{{imgtxt}}</h4>
                  </label>
                </div>
              </v-col>
              <v-col
                  cols="12"
                  md="6"
              >
                <div>
                  <v-img :src="image" width="300" ></v-img>
                </div>
              </v-col>
              <v-col
                  cols="12"
                  md="12"
              >
                <v-progress-linear height="20" :value="percent" color="#9bc220" rounded striped >{{percent}} %</v-progress-linear>
              </v-col>

            </v-row>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
              color="error"
              text
              @click="dialogCreate=false"
          >
            Cancelar
          </v-btn>
          <v-btn
              color="success"
              text
              @click="createyes(create)"
          >
            Crear
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>


    <v-dialog v-model="dialogEdit" max-width="700px">
      <v-overlay v-model="overlay">
        <v-progress-circular
            indeterminate
            size="150"
            width="10"
            color="primary"
            style="z-index: 1000;"
        >
          <h2>subiendo</h2>
        </v-progress-circular>
      </v-overlay>

      <v-card>
        <v-card-title>
          <v-icon color="success" large>mdi-cart-check</v-icon>
          <span class="headline">Editar Promocion</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-select
                    v-model="editedItem.catu"
                    :items="cat1"
                    item-text="titulo"
                    label="Categoria 1"
                    @change="catd"
                >
                </v-select>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-select
                    v-model="editedItem.catd"
                    :items="cat2"
                    item-text="titulo_dos"
                    label="Categoria 2"
                    @change="catt"
                >
                </v-select>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-select
                    v-model="editedItem.catt"
                    :items="cat3"
                    item-text="titulo_tres"
                    label="Categoria 3"
                >
                </v-select>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.nombre"
                    label="Nombre"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.empresa"
                    label="Empresa"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.precio"
                    label="Precio"
                    prefix="Bs."
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="6"
              >
                <v-select
                    v-model="editedItem.tipo"
                    :items="tipo"
                    label="Tipo de promocion"
                >
                </v-select>
              </v-col>
              <v-col
                  cols="12"
                  md="6"
              >
                <v-text-field
                    v-model="editedItem.des"
                    prefix="%"
                    label="descuento"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.dias"
                    label="Dias Promocion"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.codigo"
                    label="Codigo de barras"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.descripcion"
                    label="descripcion"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="6"
              >
                <input type="file" @change="filess" id="filessd" accept="image/*">
                <div>
                  <label for="filessd">
                    <v-icon dark>mdi-upload</v-icon>
                    <h4>{{imgtxte}}</h4>
                  </label>
                </div>
              </v-col>
              <v-col
                  cols="12"
                  md="6"
              >
                <div>
                  <v-img :src="imagedit" width="300" ></v-img>
                </div>
              </v-col>
              <v-col
                  cols="12"
                  md="12"
              >
                <v-progress-linear height="20" :value="percent" color="#9bc220" rounded striped >{{percent}} %</v-progress-linear>
              </v-col>

            </v-row>

          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
              color="error"
              text
              @click="dialogEdit=false"
          >
            Cancelar
          </v-btn>
          <v-btn
              color="success"
              text
              @click="edityer(editedItem)"
          >
            Editar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialogDelete" max-width="700px">

      <v-card>
        <v-card-title>
          <v-spacer></v-spacer>
          <h5>¿Esta seguro que quiere eleminar la promocion {{del.nombre}}?</h5>
          <v-spacer></v-spacer>
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="error" text @click="dialogDelete=false">No</v-btn>
          <v-btn color="success" text @click="delyes(del.id)">Si</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialogRes" max-width="700px">
      <v-card>
        <v-card-title >
          <v-spacer></v-spacer>
          <h5>¿Esta seguro que quiere restaurar la promocion {{res.nombre}}?</h5>
          <v-spacer></v-spacer>
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="error" text @click="dialogRes=false">Cancelar</v-btn>
          <v-btn color="success" text @click="resyes(res.id)">OK</v-btn>
          <v-spacer></v-spacer>
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
        v-model="snackbarDATOS"
        color="error"
    >
      <v-row>
        <v-spacer></v-spacer>
        <h4>No se pudo cargar vuelve a intentarlo</h4>
        <v-spacer></v-spacer>
      </v-row>
    </v-snackbar>


  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: "promocion",
  data:()=>({
    overlay:false,
    image: '',
    imagedit:'',
    imgtxt:'Seleccionar una imagen',
    imgtxte:'Seleccionar una imagen',
    snackbarDATOS:false,
    snackbar:false,
    dialogCreate: false,
    dialogEdit:false,
    dialogRes:false,
    dialogDelete:false,
    percent:50,
    percente:50,
    headers: [
      { text: 'Imagen', value: 'imgs' },
      { text: 'Categoria', value: 'titulo' },
      { text: 'Categoria 2', value: 'titulo_dos' },
      { text: 'Categoria 3', value: 'titulo_tres' },
      { text: 'Nombre', value: 'nombre' },
      { text: 'Empresa', value: 'empresa' },
      { text: 'Precio', value: 'precio' },
      { text: 'Tipo descuentpo', value: 'tipo' },
      { text: 'Descuento', value: 'descuento' },
      { text: 'Codigo de barras', value: 'codigoBarras' },
      { text: 'Descripcion', value: 'descripcion' },
      { text: 'Acciones', value: 'actions', sortable: true },
    ],
    headersI: [
      { text: 'Imagen', value: 'imgs' },
      { text: 'Categoria', value: 'titulo' },
      { text: 'Categoria 2', value: 'titulo_dos' },
      { text: 'Categoria 3', value: 'titulo_tres' },
      { text: 'Nombre', value: 'nombre' },
      { text: 'Empresa', value: 'empresa' },
      { text: 'Precio', value: 'precio' },
      { text: 'Tipo descuentpo', value: 'tipo' },
      { text: 'Descuento', value: 'descuento' },
      { text: 'Codigo de barras', value: 'codigoBarras' },
      { text: 'Descripcion', value: 'descripcion' },
      { text: 'Acciones', value: 'actions', sortable: true },
    ],
    tipo:[
      'Cantidad','Descuento porcentaje'
    ],
    promac:[],
    search:'',
    searchI:'',
    promin:[],
    create:{
      catu:'',
      catd:'',
      catt:'',
      nombre:'',
      empresa:'',
      precio:'',
      des:'',
      codigo:'',
      dias:'',
      tipo:'',
      descripcion:'',
    },
    editedItem:{
      catu:'',
      catd:'',
      catt:'',
      nombre:'',
      empresa:'',
      precio:'',
      des:'',
      codigo:'',
      dias:'',
      tipo:'',
      descripcion:'',
      id:''
    },
    cat1:[],
    cat2:[],
    cat3:[],
    del:{
      nombre:'',
      id:'',
    },
    res:{
      nombre:'',
      id:'',
    }

  }),
  components:{
  },
  mounted() {
    this.cat()
    this.promocion()
  },
  methods:{
    cat(){
      axios.get('promocion.php?cat=catu'
      ).then((r)=>{
        this.cat1 = r.data
      })
      axios.get('promocion.php?cat=catdg'
      ).then((r)=>{
        this.cat2 = r.data
      })
      axios.get('promocion.php?cat=cattg'
      ).then((r)=>{
        this.cat3 = r.data
      })
    },
    catd(event){
      axios.get('promocion.php?cat=catd&var='+event
      ).then((r)=>{
        this.cat2 = r.data
      })
    },
    catt(event){
      axios.get('promocion.php?cat=catt&var='+event
      ).then((r)=>{
        this.cat3 = r.data
      })
    },
    promocion(){
      axios.get('promocion.php?e=1&cat=0'
      ).then((res)=>{
        this.promac = res.data
      })
      axios.get('promocion.php?e=0&cat=0'
      ).then((res)=>{
        this.promin = res.data
      })
    },
    files(event){
      if(event.target.files[0] == null){
        console.log('esta vacio')
      }else{
        const file = event.target.files[0]
        this.image= URL.createObjectURL(file)
        this.imgtxt = event.target.files[0].name
      }
    },
    createyes(c){
      this.overlay=true
      var i = this.imgtxt
      if (c.catu=='' || c.des=='' || c.nombre=='' || c.empresa=='' || c.dias=='' || c.precio=='' || c.codigo=='' || c.tipo=='' || i=='Seleccionar una imagen'){
        this.snackbar =  true
      }else{
        const fd = new FormData()
        var up =document.getElementById('filesd')
        fd.append("fileToUpload", up.files[0], up.files[0].name)
        axios.post("promimg.php" , fd
        ).then((result)=> {
          if (result.data.message == 'success'){
            const fr = new FormData();
            var ganana = c.precio * c.des
            var ganancia= c.precio - ganana/100
            fr.append('type','create')
            fr.append('cate',c.catu)
            fr.append('cated',c.catd)
            fr.append('catet',c.catt)
            fr.append('nombre',c.nombre)
            fr.append('empresa',c.empresa)
            fr.append('precio',c.precio)
            fr.append('total',ganancia)
            fr.append('dias',c.dias)
            fr.append('codigo',c.codigo)
            fr.append('img',result.data.ubicacion)
            fr.append('tipo',c.tipo)
            fr.append('des',c.des)
            fr.append('descripcion',c.descripcion)
            axios.post('promocion.php',fr
            ).then((r)=>{
              this.dialogCreate = false
              this.promocion()
              console.log(r.data)
              this.overlay=false
            }).catch((r)=>{
              console.warn(r)
              this.overlay=false

            })
          }else{
            this.snackbarDATOS = true
          }
        }).catch((r)=>{
          console.warn(r)
          this.overlay=false
          this.snackbarDATOS=true
        })
      }

    },
    filess(event){
      if(event.target.files[0] == null){
        console.log('esta vacio')
      }else{
        const file = event.target.files[0]
        this.imagedit= URL.createObjectURL(file)
        this.imgtxte = event.target.files[0].name
      }
    },
    editItem(e){
      this.editedItem.catu = e.titulo
      this.editedItem.catd = e.titulo_dos
      this.editedItem.catt = e.titulo_tres
      this.editedItem.nombre = e.nombre
      this.editedItem.empresa = e.empresa
      this.editedItem.precio = e.precio
      this.editedItem.tipo = e.tipo
      this.editedItem.des = e.descuento
      this.editedItem.dias = e.dias
      this.editedItem.codigo = e.codigoBarras
      this.editedItem.descripcion = e.descripcion
      this.imagedit = 'https://bonnsupermercados.com/'+e.imagen
      this.editedItem.id = e.id
      this.dialogEdit = true
      console.warn(this.imagedit)
    },
    edityer(e){
      this.overlay=true
      if (e.catu=='' || e.des=='' || e.descripcion=='' || e.nombre=='' || e.empresa=='' || e.dias=='' || e.precio=='' || e.codigo=='' || e.tipo=='' ){
        this.snackbar =  true
      }else{
        var ganana = e.precio * e.des
        var ganancia= e.precio - ganana/100
        if (this.imgtxte=='Seleccionar una imagen'){
          const fu = new FormData()
          fu.append('type','update')
          fu.append('res','nocambiar')
          fu.append('id',e.id)
          fu.append('titulo',e.catu)
          fu.append('titulo_dos',e.catd)
          fu.append('titulo_tres',e.catt)
          fu.append('nombre',e.nombre)
          fu.append('empresa',e.empresa)
          fu.append('precio',e.precio)
          fu.append('tipo',e.tipo)
          fu.append('codigo',e.codigo)
          fu.append('descripcion',e.descripcion)
          fu.append('total',ganancia)
          fu.append('descuento',e.des)
          fu.append('dias',e.dias)
          axios.post('promocion.php', fu
          ).then((r)=>{
            this.imagedit= ''
            this.imgtxte = 'Seleccionar una imagen'
            this.dialogEdit = false
            this.promocion()
            console.log(r.data)
            this.overlay=false

          }).catch((r)=>{
            console.log(r)
            this.overlay=false
            this.snackbarDATOS=true
          })
        }else{
          const fd = new FormData()
          var up =document.getElementById('filessd')
          fd.append("fileToUpload", up.files[0], up.files[0].name)
          axios.post("imgcat.php" , fd
          ).then((result)=> {
            if (result.data.message == 'success'){
              const fu = new FormData()
              let img = result.data.ubicacion
              fu.append('type','update')
              fu.append('res','cambiar')
              fu.append('id',e.id)
              fu.append('titulo',e.catu)
              fu.append('titulo_dos',e.catd)
              fu.append('titulo_tres',e.catt)
              fu.append('nombre',e.nombre)
              fu.append('empresa',e.empresa)
              fu.append('precio',e.precio)
              fu.append('tipo',e.tipo)
              fu.append('codigo',e.codigo)
              fu.append('descripcion',e.descripcion)
              fu.append('total',ganancia)
              fu.append('descuento',e.des)
              fu.append('dias',e.dias)
              fu.append('img',img)
              axios.post('promocion.php', fu
              ).then((r)=>{
                this.imagedit= ''
                this.imgtxte = 'Seleccionar una imagen'
                this.dialogEdit = false
                this.promocion()
                console.log(r.data)
                this.overlay=false
              })
            }else{
              this.overlay=false
              this.snackbarDATOS = true
            }
          }).catch((r)=>{
            console.log(r)
            this.overlay=false
            this.snackbarDATOS=false
          })
        }
      }
    },
    deleteItem(d){
      this.del.nombre = d.nombre
      this.del.id  = d.id
      this.dialogDelete = true
    },
    delyes(id){
      console.log(id)
      const fd = new FormData()
      fd.append('type','delete')
      fd.append("id",id)
      axios.post("promocion.php" , fd
      ).then((r)=>{
        console.log(r.data)
        this.dialogDelete = false
        this.promocion()
      })
    },
    restaurar(res){
      this.res.nombre = res.nombre
      this.res.id  = res.id
      this.dialogRes = true
    },
    resyes(id){
      const fd = new FormData()
      fd.append('type','restart')
      fd.append('id',id)
      axios.post('promocion.php',fd
      ).then((r)=>{
        console.log(r.data)
        this.dialogRes=false
        this.promocion()
      })
    }
  }
}
</script>

<style scoped>
input[type='file']{
  display: none;
}
label[for="filesd"] {
  font-size: 14px;
  font-weight: 600;
  color: #fff;
  background-color: #106BA0;
  display: inline-block;
  transition: all .5s;
  cursor: pointer;
  padding: 15px 40px !important;
  text-transform: uppercase;
  width: fit-content;
  text-align: center;
}
label[for="filessd"] {
  font-size: 14px;
  font-weight: 600;
  color: #fff;
  background-color: #106BA0;
  display: inline-block;
  transition: all .5s;
  cursor: pointer;
  padding: 15px 40px !important;
  text-transform: uppercase;
  width: fit-content;
  text-align: center;
}
</style>