<template>
<div>
  <div style="margin-top: 15px;">
    <h3>
      ¿No estas registrado?
      <a @click.stop="dialog=true" id="regis">
        Regístrate Aquí
      </a>
    </h3>
  </div>
  <v-app style="background: red; height: 1px;">
    <v-row justify="center">


      <v-dialog
          v-model="dialog"
          max-width="790"
      >
        <v-card>
          <v-card-title class="headline">
            Use Google's location service?
          </v-card-title>

          <v-card-text>
            Let Google help apps determine location. This means sending anonymous location data to Google, even when no apps are running.
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn
                color="green darken-1"
                text
                @click="dialog = false"
            >
              Disagree
            </v-btn>

            <v-btn
                color="green darken-1"
                text
                @click="dialog = false"
            >
              Agree
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </v-app>

</div>
</template>

<script>
export default {
name: "registrar",
  data:()=>({
    dialog:false,
  })
}
</script>

<style scoped>

</style>