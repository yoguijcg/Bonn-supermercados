<template>
  <div>
    <v-col cols="12">
      <v-card>
        <v-card-title>
          <v-icon color="success">mdi-account</v-icon> &nbsp;
          <h3>Usuarios activos</h3>
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
                  mdi-account-plus
                  </v-icon> &nbsp;
                  <h4>NUEVO USUARIO</h4>
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
              :items="userac"
              :search="search"
              sort-by="calories"
              class="elevation-1"
          >
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
                mdi-account-remove
              </v-icon>
            </template>
            <template v-slot:item.apellidos="{item}">
              {{item.apellido_paterno}} &nbsp; {{item.apelido_materno}}
            </template>
            <template v-slot:item.status="{item}">
              <div v-if="item.cargo == 1">
                Administrador
              </div>
              <div  v-else>
                Delevery
              </div>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
      <br>
      <v-card>
        <v-card-title>
          <v-icon color="error">mdi-account-cancel</v-icon>
          <h3>Usuarios Inactivos</h3>
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
              :items="userin"
              :search="searchI"
              sort-by="calories"
              class="elevation-1"
          >
            <template v-slot:item.actions="{ item }">
              <v-btn
                  color="success"
                  @click="restaurar(item)"
              >
                <v-icon
                >
                  mdi-account-check
                </v-icon>
              </v-btn>
            </template>
            <template v-slot:item.apellidos="{item}">
              {{item.apellido_paterno}} &nbsp; {{item.apelido_materno}}
            </template>
            <template v-slot:item.status="{item}">
              <div v-if="item.cargo == 1">
                Adminitrador
              </div>
              <div  v-else>
                Delevery
              </div>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>

    </v-col>

    <v-dialog v-model="dialogCreate" max-width="700px">
      <v-card>
        <v-card-title>
          <v-icon color="success" large>mdi-account-plus</v-icon>
          <span class="headline">Crear Usuario</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
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
                    v-model="create.ap"
                    label="Apellido Paterno"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.am"
                    label="Apellido Materno"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.carnet"
                    label="Carnet"
                    counter
                    maxlength="10"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.celular"
                    label="Celular"
                    counter
                    maxlength="8"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.correo"
                    label="Correo"
                    :rules="[rules.cor]"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="create.direccion"
                    label="Direccion"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-select
                    :items="cargo"
                    v-model="create.cargo"
                    label="Cargo"
                ></v-select>
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
            Aceptar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialog" max-width="700px">
      <v-card>
        <v-card-title>
          <v-icon color="orange">mdi-account-edit</v-icon>
          <span class="headline">Editar usuario</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
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
                    v-model="editedItem.ap"
                    label="Apellido Paterno"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.am"
                    label="Apellido Materno"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.carnet"
                    label="Carnet"
                    counter
                    maxlength="10"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.celular"
                    label="Celular"
                    counter
                    maxlength="8"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.correo"
                    label="Correo"
                    :rules="[rules.cor]"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-text-field
                    v-model="editedItem.direccion"
                    label="Direccion"
                ></v-text-field>
              </v-col>
              <v-col
                  cols="12"
                  md="4"
              >
                <v-select
                    :items="cargo"
                    v-model="editedItem.cargo"
                    label="Cargo"
                ></v-select>
              </v-col>

            </v-row>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
              color="error"
              text
              @click="dialog=false"
          >
            Cancelar
          </v-btn>
          <v-btn
              color="success"
              text
              @click="edityes(editedItem)"
          >
            Guardar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialogDelete" max-width="700px">
      <v-card>
        <v-card-title>
          <v-spacer></v-spacer>
          <h5>¿Esta seguro que quiere restaurar al usuario {{del.n}} {{del.a}}?</h5>
          <v-spacer></v-spacer>
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="error" text @click="dialogDelete=false">Cancelar</v-btn>
          <v-btn color="success" text @click="delyes(del.i)">OK</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialogRes" max-width="700px">
      <v-card>
        <v-card-title >
          <v-spacer></v-spacer>
          <h5>¿Esta seguro que quiere restaurar al usuario {{res.n}} {{res.a}}?</h5>
          <v-spacer></v-spacer>
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="error" text @click="dialogRes=false">Cancelar</v-btn>
          <v-btn color="success" text @click="resyes(res.i)">OK</v-btn>
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

  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: "users",
  data: () => ({
    rules: {
      cor: value => {
        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        return pattern.test(value) || 'Invalid e-mail.'
      },
    },
    snackbar:false,
    search: '',
    searchI:'',
    dialog: false,
    dialogCreate:false,
    dialogDelete: false,
    dialogRes:false,
    headers: [
      { text: 'Nombre', value: 'nombre' },
      { text: 'Apellidos', value: 'apellidos' },
      { text: 'Carnet', value: 'carnet' },
      { text: 'Celular', value: 'celular' },
      { text: 'Correo', value: 'correo' },
      { text: 'Cargo', value: 'status' },
      { text: 'Acciones', value: 'actions', sortable: true },
    ],
    headersI: [
      { text: 'Nombre', value: 'nombre' },
      { text: 'Apellidos', value: 'apellidos' },
      { text: 'Carnet', value: 'carnet' },
      { text: 'Celular', value: 'celular' },
      { text: 'Correo', value: 'correo' },
      { text: 'Cargo', value: 'status' },
      { text: 'Restaurar', value: 'actions', sortable: true },
    ],
    userac:[],
    userin:[],
    editedItem: {
      id:'',
      nombre:'',
      ap:'',
      am:'',
      carnet:'',
      celular:'',
      correo:'',
      direccion:'',
      cargo:'',
    },
    res:{
      n:'',
      a:'',
      i:'',
    },
    del:{
      n:'',
      a:'',
      i:'',
    },
    cargo:[
        'Administrador',
        'Delevery'
    ],
    create:{
      nombre:'',
      ap:'',
      am:'',
      carnet:'',
      celular:'',
      correo:'',
      direccion:'',
      cargo:'',
    },
  }),

  computed: {

  },

  watch: {

  },

  created () {
  },
  mounted() {
    this.users()
  },
  methods: {
    users(){
      axios.get('users.php?e=1'
      ).then((res)=>{
        this.userac  = res.data
      })
      axios.get('users.php?e=0'
      ).then((res)=>{
        this.userin  = res.data
      })
    },
    restaurar(i){
      this.res.i=i.id
      this.res.a = i.apellido_paterno
      this.res.n = i.nombre
      this.dialogRes=true
    },
    resyes(id){
      axios.delete('users.php?r=r&id='+id
      ).then((res)=>{
        console.log(res.data)
        this.users()
        this.dialogRes=false
      })
    },
    deleteItem(it){
      this.del.i=it.id
      this.del.a = it.apellido_paterno
      this.del.n = it.nombre
      this.dialogDelete=true
    },
    delyes(id){
      axios.delete('users.php?r=e&id='+id
      ).then((res)=>{
        console.log(res.data)
        this.users()
        this.dialogDelete=false
      })
    },
    editItem(edit){
      this.editedItem.id = edit.id
      this.editedItem.nombre = edit.nombre
      this.editedItem.ap =  edit.apellido_paterno
      this.editedItem.am  = edit.apelido_materno
      this.editedItem.carnet = edit.carnet
      this.editedItem.celular = edit.celular
      this.editedItem.direccion = edit.direccion
      this.editedItem.correo= edit.correo
      if (edit.cargo== 1){
        this.editedItem.cargo = 'Administrador'
      }else{
        this.editedItem.cargo = 'Delevery'
      }
      this.dialog=true
    },
    edityes(e){
      let cargo;
      if (e.cargo=='Administrador'){
        cargo=1
      }else{
        cargo=0
      }
      axios.put(
          'users.php?id='+e.id+'&nombre='+e.nombre+'&apellido_paterno='+e.ap+'&apelido_materno='+e.am+'&carnet='+e.carnet+'&celular='+e.celular+'&correo='+e.correo+'&cargo='+cargo+'&direccion='+e.direccion
      ).then((res)=>{
        console.log(res.data)
        this.dialog=false
        this.users()
      })
    },
    createyes(c){
      console.log(c)
      if (c.nombre=='' || c.ap=='' || c.carnet=='' || c.celular=='' || c.correo=='' || c.direccion=='' || c.cargo==''){
        this.snackbar =  true
      }else{
        let cargo;
        if (c.cargo=='Administrador'){
          cargo=1
        }else{
          cargo=0
        }
        const fd = new FormData()
        fd.append('nombre',c.nombre)
        fd.append('ap',c.ap)
        fd.append('am',c.am)
        fd.append('carnet',c.carnet)
        fd.append('celular',c.celular)
        fd.append('correo',c.correo)
        fd.append('direccion',c.direccion)
        fd.append('cargo',cargo)

       axios.post('users.php',fd
       ).then((r)=>{
         this.dialogCreate = false
         this.users()
         console.log(r.data)
       })
      }
    }
  },
}
</script>

<style scoped>
.center{
  margin: 2%;
}
</style>