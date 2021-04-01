<template>
  <div>
    <div>
      <gmap-map
          :center="center"
          :zoom="18"
          style="height: 350px; width: 100%;"
      >
        <gmap-marker
            :position="position"
            :title="title"

            :clickable="true"
            :draggable="true"
            @click="center=position"
            @dragend="update"
        ></gmap-marker>

      </gmap-map>
    </div>
    <br>
    <v-row>
      <v-spacer></v-spacer>
      <v-col cols="12" md="5">
        <v-btn outlined block color="success" @click="ubicacion()" small>
          <v-icon>mdi-crosshairs-gps</v-icon><span style="width: 10px;"></span>
          Ir a mi ubicacion real
        </v-btn>
      </v-col>
      <v-col  cols="12" md="5">
        <v-btn outlined block color="info" @click="market()" small>
          <v-icon>mdi-crosshairs-gps</v-icon><span style="width: 10px;"></span>
          ubicacion super mercado</v-btn>
      </v-col>
      <v-spacer></v-spacer>
      <v-col cols="12">
        <v-text-field
            outlined
            label="Direccion"
            v-model="direccion"
        ></v-text-field>
      </v-col>
    </v-row>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data () {
    return {
      direccion:'',
      center: {lat: -16.530175490848077, lng: -68.15638666226562},
      title: 'Este pedido se entregara aqui',
      position:null,
      lat:null,
      lng:null,
    }
  },
  mounted() {
    this.ini()

  },
  methods:{
    ini(){
      this.lat = localStorage.lat
      this.lng= localStorage.lng
      this.position={ lat:parseFloat(this.lat), lng:parseFloat(this.lng)}
    },
    ubicacion(){

      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition (this.getPosition);
      }
    },
    market(){
      localStorage.lat = -16.530175490848077
      localStorage.lng = -68.15638666226562
      this.ini()
      axios.get('https://maps.googleapis.com/maps/api/geocode/json?latlng='+localStorage.lat+','+ localStorage.lng+'&key=AIzaSyA1tqCOsaUEPD0LW1B_97RFlTQzUVkgl6w').then(
          (re) => {
            //console.log(re)
            this.direccion= re.data.results[0].formatted_address
            localStorage.direccion= this.direccion
          }
      )
    },
    getPosition(w){
      localStorage.lat = w.coords.latitude
      localStorage.lng = w.coords.longitude
      //this.position={ lat: w.coords.latitude, lng: w.coords.longitude}
      //console.log(this.position)
      this.ini()
      axios.get('https://maps.googleapis.com/maps/api/geocode/json?latlng='+localStorage.lat+','+ localStorage.lng+'&key=AIzaSyA1tqCOsaUEPD0LW1B_97RFlTQzUVkgl6w').then(
          (re) => {
            //console.log(re)
            this.direccion= re.data.results[0].formatted_address
            localStorage.direccion= this.direccion
          }
      )
    },
    update(lo){
      let l= lo.latLng.lat()
      let n = lo.latLng.lng()
      localStorage.lat = lo.latLng.lat()
      localStorage.lng = lo.latLng.lng()
      //console.log(lo.latLng.lat()+', '+lo.latLng.lng())
      axios.get('https://maps.googleapis.com/maps/api/geocode/json?latlng='+l+','+ n+'&key=AIzaSyA1tqCOsaUEPD0LW1B_97RFlTQzUVkgl6w').then(
          (re) => {
            //console.log(re)
            this.direccion= re.data.results[0].formatted_address
            localStorage.direccion= this.direccion
          }
      )
    },
    dire(){
      axios.get('https://maps.googleapis.com/maps/api/geocode/json?latlng=-16.53010477861731, -68.15634844078716&key=AIzaSyA1tqCOsaUEPD0LW1B_97RFlTQzUVkgl6w').then(
          (re) => {
            this.direccion= re.data.results[0].formatted_address
          }
      )
    }
  }


}
</script>

<style lang="scss" scoped></style>
