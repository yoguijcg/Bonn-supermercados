<template>
  <div>
    <v-col cols="12">
      <v-card>
        <v-card-title>
          <v-icon color="success" size="40">mdi-image-outline</v-icon> &nbsp;
          <h3>Imagenes de Carrusel</h3>
        </v-card-title>
        <v-card-text>
          <v-toolbar>
            <v-col cols="4">
              <v-btn text color="success" @click="dialogC=true">
                <v-icon>mdi-image-plus</v-icon>
                agregar imagen
              </v-btn>
            </v-col>
            <v-col cols="8">
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
              :items="carrusel"
              :search="search"
              sort-by="calories"
              class="elevation-1"
          >
            <template v-slot:item.imagen="{item}">
              <v-img></v-img>
              <img :src="'https://bonnsupermercados.com/'+item.img" :aspect-ratio="16/9" height="100">
            </template>
            <template v-slot:item.actions="{ item }">

              <v-icon
                  color="error"
                  @click="delet(item)"
              >
                mdi-delete
              </v-icon>
            </template>


          </v-data-table>
        </v-card-text>
      </v-card>
      <br>

    </v-col>
    <v-dialog
        v-model="dialogC"
        width="600"
    >
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
          Crear nueva imagen para carusel
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                  cols="12"
              >
                <v-select
                    v-model="create.car"
                    :items="car"
                    item-text="titulo"
                    label="Carrusel"
                >
                </v-select>
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


            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
              color="error"
              text
              @click="dialogC=false"
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

    <v-snackbar
        v-model="snackbarDATOS"
        color="error"
    >
      <v-row>
        <v-spacer></v-spacer>
        <h4>No cargues una imagen mas de 2Mb</h4>
        <v-spacer></v-spacer>
      </v-row>
    </v-snackbar>

  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: "carrusel",
  data:()=>({
    headers:[
      {text: 'Nombre de carrusel', value:'titulo'},
      {text: 'Imagen de carrusel', value: 'imagen'},
      {text: 'Acciones', value: 'actions'}
    ],
    carrusel:[],
    search:'',
    headersI:[
      {text: 'Nombre del carrusel', value:'titulo'},
      {text: 'Imagen del carrusel', value: 'imagen'},
      {text: 'Acciones', value: 'actions'}
    ],
    carruselI:[],
    searchI:'',
    dialogC:false,
    overlay:false,
    create:{
      car:''
    },
    image: '',
    imagedit:'',
    imgtxt:'Seleccionar una imagen',
    imgtxte:'Seleccionar una imagen',
    car:[],
    snackbarDATOS:false,
  }),
  mounted() {
    this.ini()
  },
  methods:{
    ini(){
      axios.get('carrusel.php?type=get'
      ).then((a)=>{
        this.carrusel=a.data
      })
      axios.get('carrusel.php?type=car'
      ).then((b)=>{
        this.car=b.data
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
      if (c.car=='' || i=='Seleccionar una imagen'){
        this.snackbar =  true
      }else{
        const fd = new FormData()
        var up =document.getElementById('filesd')
        fd.append("fileToUpload", up.files[0], up.files[0].name)
        axios.post("carruimg.php" , fd
        ).then((result)=> {
          if (result.data.message == 'success'){
            const fr = new FormData();
            var id=this.car.find(file => file.titulo === c.car).id
            fr.append('type','create')
            fr.append('car',id)
            fr.append('img',result.data.ubicacion)
            axios.post('carrusel.php',fr
            ).then((r)=>{
              this.dialogC = false
              this.ini()
              console.log(r.data)
              this.overlay=false
            })
          }else{
            this.snackbarDATOS = true
          }
        }).catch((re)=>{
          console.log(re)
          this.overlay=false
        })
      }

    },
    delet(d){
      axios.get('carrusel.php?type=delete&var='+d.id
      ).then((re)=>{
        console.log(re.data)
        this.ini()
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