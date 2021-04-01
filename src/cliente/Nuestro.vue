<template>
  <div>
    <br><br><br><br><br>

    <v-row>
      <v-col cols="11" style="margin: auto;">
        <v-card>
          <v-card-title>
            <v-row>
              <v-spacer></v-spacer>
              <h2 style="color: #9bc220">NUESTROS SERVICIOS</h2>
              <v-spacer></v-spacer>
            </v-row>
          </v-card-title>
        </v-card>
      </v-col>

      <v-col cols="11" md="6" style="margin: auto;">
        <v-col>
          <v-card>
            <v-card-title>
              <v-spacer></v-spacer>
              <v-avatar color="blue" size="100">
                <v-icon dark size="70">
                  mdi-truck-fast
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>
            <hr>
            <v-card-text>
              <h2 style="text-transform: uppercase;color: dodgerblue;">
                Compra  online y recibe en tu casa
              </h2>
              <h3>
                Podras realizar tu compra online en  minutos, elegir la hora de entrega y recibirlo en la comodidad  de  tu hogar.
              </h3>
            </v-card-text>
          </v-card>
        </v-col>
      </v-col>
      <v-col cols="11" md="6" style="margin: auto;">
        <v-col>
          <v-card>
            <v-card-title>
              <v-spacer></v-spacer>
              <v-avatar color="red" size="100">
                <v-icon dark size="70">
                  mdi-storefront
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>
            <hr>
            <v-card-text>
              <h2 style="color:red;">
                COMPRA ONLINE Y RETIRA EN TIENDA
              </h2>
              <H3>
                Tendras la  opcion de  hacer tu compra online, elegir el  horario de entrega y retirarlo en nuestra tienda.
              </H3>
            </v-card-text>
          </v-card>
        </v-col>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  name: "Nuestro"
}
</script>

<style scoped>

</style>