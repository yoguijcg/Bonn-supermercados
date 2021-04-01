<template>
  <div>
    <v-col cols="12">
      <v-card>
        <v-card-title>
          <v-icon color="success" large>mdi-clipboard-edit-outline</v-icon> &nbsp;
          <h3> Categorias Activas</h3>
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
                    mdi-clipboard-plus-outline
                  </v-icon> &nbsp;
                  <h4>nueva categoria</h4>
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
              :items="catac"
              :search="search"
              sort-by="calories"
              class="elevation-1"
          >
            <template v-slot:item.imgs="{item}">
              <v-img width="200" height="100" :src="'https://bonnsupermercados.com/'+item.img"></v-img>
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
                mdi-clipboard-remove-outline
              </v-icon>
            </template>

          </v-data-table>
        </v-card-text>
      </v-card>
      <br>
      <v-card>
        <v-card-title>
          <v-icon color="error" large>mdi-clipboard-remove-outline</v-icon>
          <h3>Categorias Inactivos</h3>
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
              :items="catin"
              :search="searchI"
              sort-by="calories"
              class="elevation-1"
          >
            <template v-slot:item.imgs="{item}">
              <v-img width="200" height="100" :src="'https://bonnsupermercados.com/'+item.img"></v-img>
            </template>
            <template v-slot:item.actions="{ item }">
              <v-btn
                  color="success"
                  @click="restaurar(item)"
              >
                <v-icon
                >
                  mdi-clipboard-check-outline
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
          <v-icon color="success" large>mdi-clipboard-plus-outline</v-icon>
          <span class="headline">Crear Categoria</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.catu"
                    label="Categoria 1"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.catd"
                    label="Categoria 2"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.catt"
                    label="Categoria 3"
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
          <v-icon color="success" large>mdi-clipboard-edit-outline</v-icon>
          <span class="headline">Editar Categoria</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.catu"
                    label="Categoria 1"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.catd"
                    label="Categoria 2"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.catt"
                    label="Categoria 3"
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
                <v-progress-linear height="20" :value="percente" color="#9bc220" rounded striped >{{percente}} %</v-progress-linear>
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
          <h5>¿Esta seguro que quiere eleminar la categoria {{del.catu}} {{del.catd}} {{del.catt}}?</h5>
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
          <h5>¿Esta seguro que quiere restaurar la categoria {{res.catu}} {{res.catd}} {{res.catt}}?</h5>
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
        <h4>No pudo cargar los archivos intente nuevamente</h4>
        <v-spacer></v-spacer>
      </v-row>
    </v-snackbar>

  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "categorias",
  data:()=>({
    overlay:false,
    image: '',
    imagedit:'',
    imgtxt:'Seleccionar una imagen',
    imgtxte:'Seleccionar una imagen',
    percent:1,
    percente:1,
    dialogCreate:false,
    dialogEdit:false,
    dialogDelete:false,
    dialogRes:false,
    snackbar:false,
    snackbarDATOS:false,
    create:{
      catu:'',
      catd:'',
      catt:'',
    },
    search:'',
    searchI:'',
    headers: [
      { text: 'imagen', value: 'imgs'},
      { text: 'Categoria', value: 'titulo' },
      { text: 'Categoria 2', value: 'titulo_dos' },
      { text: 'Categoria 3', value: 'titulo_tres' },
      { text: 'Acciones', value: 'actions', sortable: true },
    ],
    headersI: [
      { text: 'imagen', value: 'imgs'},
      { text: 'Categoria', value: 'titulo' },
      { text: 'Categoria 2', value: 'titulo_dos' },
      { text: 'Categoria 3', value: 'titulo_tres' },
      { text: 'Acciones', value: 'actions', sortable: true },
    ],
    catac:[],
    catin:[],
    editedItem: {
      id:'',
      img:'',
      catu:'',
      catd:'',
      catt:'',
    },
    del:{
      catu:'',
      catd:'',
      catt:'',
      id:'',
    },
    res:{
      catu:'',
      catd:'',
      catt:'',
      id:'',
    }
  }),
  mounted() {
    this.cat()
  },
  methods:{
    cat(){
      axios.get('categoria.php?e=1'
      ).then((res)=>{
        this.catac = res.data
      })
      axios.get('categoria.php?e=0'
      ).then((res)=>{
        this.catin = res.data
      })
    },
    files(event){
      //console.log(event.target.files[0])
      if(event.target.files[0] == null){
        console.log('esta vacio')
      }else{
        const file = event.target.files[0]
        this.image= URL.createObjectURL(file)
        this.imgtxt = event.target.files[0].name
      }
    },
    createyes(c){
      this.overlay = true
      if (c.catu=='' || c.catd=='' || c.catt==''){
        this.snackbar =  true
      }else{
        var up =document.getElementById('filesd')
        const fd = new FormData()
        fd.append("fileToUpload", up.files[0], up.files[0].name)
        axios.post("imgcat.php" , fd
        ).then((result)=> {
          if (result.data.message == 'success'){
            const fr = new FormData();
            fr.append('type','create')
            fr.append('cate',c.catu)
            fr.append('cated',c.catd)
            fr.append('catet',c.catt)
            fr.append('img',result.data.ubicacion)
            axios.post('categoria.php',fr
            ).then((r)=>{
              this.dialogCreate = false
              this.cat()
              console.log(r.data)
              this.overlay = false
            })
          }else{
            this.snackbarDATOS = true
          }
        }).catch((re)=>{
          console.warn(re)
          this.overlay = false
          this.snackbarDATOS = true
        })
      }
    },
    editItem(e){
      this.editedItem.catu = e.titulo
      this.editedItem.catd = e.titulo_dos
      this.editedItem.catt = e.titulo_tres
      this.imagedit = 'https://bonnsupermercados.com/'+e.img
      this.editedItem.id = e.id
      this.dialogEdit = true
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
    edityer(e){
      this.overlay = true
      if (e.catu=='' || e.catd=='' || e.catt==''){
        this.snackbar =  true
      }else{
        if (this.imgtxte=='Seleccionar una imagen'){
          const fd = new FormData()
          fd.append('type','nimg')
          fd.append('id',e.id)
          fd.append('titulo',e.catu)
          fd.append('titulo_dos',e.catd)
          fd.append('titulo_tres',e.catt)
          axios.post('categoria.php',fd
          ).then((r)=>{
            this.imagedit= ''
            this.imgtxte = 'Seleccionar una imagen'
            this.dialogEdit = false
            this.cat()
            console.log(r.data)
            this.overlay = false

          })
        }else{
          const fd = new FormData()
          var up =document.getElementById('filessd')
          fd.append("fileToUpload", up.files[0], up.files[0].name)
          axios.post("imgcat.php" , fd
          ).then((result)=> {
            if (result.data.message == 'success'){
              let img = result.data.ubicacion
              const fr = new FormData()
              fr.append('type','yimg')
              fr.append('id',e.id)
              fr.append('titulo',e.catu)
              fr.append('titulo_dos',e.catd)
              fr.append('titulo_tres',e.catt)
              fr.append('img',img)
              axios.post('categoria.php',fr
              ).then((r)=>{
                this.imagedit= ''
                this.imgtxte = 'Seleccionar una imagen'
                this.dialogEdit = false
                this.cat()
                console.log(r.data)
                this.overlay = false

              }).catch((r)=>{
                console.warn(r)
                this.snackbarDATOS = true
                this.overlay = false
              })
            }else{
              this.snackbarDATOS = true
              this.overlay = false

            }
          }).catch((r)=>{
            console.warn(r)
            this.overlay = false
            this.snackbarDATOS = true

          })
        }
      }
    },
    deleteItem(d){
      this.del.catu = d.titulo
      this.del.catd = d.titulo_dos
      this.del.catt = d.titulo_tres
      this.del.id  = d.id
      this.dialogDelete = true
    },
    delyes(id){
      const fd = new FormData()
      fd.append('type','delete')
      fd.append('id',id)
      axios.post('categoria.php',fd
      ).then((r)=>{
        console.log(r.data)
        this.dialogDelete=false
        this.cat()
      })
    },
    restaurar(res){
      this.res.catu = res.titulo
      this.res.catd = res.titulo_dos
      this.res.catt = res.titulo_tres
      this.res.id  = res.id
      this.dialogRes = true
    },
    resyes(id){
      const fd = new FormData()
      fd.append('type','restart')
      fd.append('id',id)
      axios.post('categoria.php',fd
      ).then((r)=>{
        console.log(r.data)
        this.dialogRes=false
        this.cat()
      }).catch((re)=>{
        console.warn(re)
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
  width: 100%;
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
  width: 100%;
}
</style>