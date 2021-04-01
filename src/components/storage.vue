<template>
  <div>
    <v-app id="inspire">


    <h2>Gatos</h2>
    <div v-for="(cat, n) in cats" :key="n">
      <p>
        <span class="cat">{{ cat.cat }}</span>
        <span style="margin-left: 100px;"></span>
        <span class="cat">{{ cat.name }}</span>
        <span style="margin-left: 10px;"></span>
        <span class="cat">{{ cat.ape }}</span>
        <span style="margin-left: 10px;"></span>


        <v-btn color="error" @click="removeCat(n)" small><v-icon>mdi-delete</v-icon>Eleminar</v-btn>
      </p>
      <hr>
    </div>

    <p>
      <input type="text" v-model="newCat" style="border: #9bc220 solid 2px; width: 100px;">
      <span style="margin-left: 50px;"></span>
      <input type="text" v-model="nombre" style="border: #9bc220 solid 2px; width: 100px;">
      <span style="margin-left: 50px;"></span>
      <input type="text" v-model="ape" style="border: #9bc220 solid 2px; width: 100px;">
      <span style="margin-left: 50px;"></span>
      <v-btn color="success" @click="addCat" small>agregar</v-btn>
    </p>



    </v-app>
  </div>
</template>

<script>
export default {
  name: "storage",
  data: ()=> ({
    cats: [],
    newCat:null,
    nombre:null,
    ape:null,
  }),
  mounted() {
    this.pru()
    if (localStorage.getItem('cats')) {
      try {
        this.cats = JSON.parse(localStorage.getItem('cats'));
      } catch(e) {
        localStorage.removeItem('cats');
      }
    }
  },
  methods: {
    pru(){
      let k = JSON.parse(localStorage.getItem('cats'))
      console.warn(k.splice('0',1))
    },
    addCat() {
      // asegurarse que el usuario efectivamente ha escrito algo
      if (!this.newCat) {
        return;
      }
      if (!this.nombre) {
        return;
      }
      if (!this.ape) {
        return;
      }

      this.cats.push({
        cat:this.newCat,
        name: this.nombre,
        ape: this.ape
      });

      this.newCat = '';
      this.saveCats();
    },
    removeCat(x) {
      this.cats.splice(x, 1);
      this.saveCats();
    },
    saveCats() {
      const parsed = JSON.stringify(this.cats);
      localStorage.setItem('cats', parsed);
    }
  }
}
</script>

<style scoped>

</style>