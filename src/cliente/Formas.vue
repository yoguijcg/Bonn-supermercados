<template>
  <div>
    <br><br><br><br><br>

    <v-row>
      <v-col cols="11" style="margin: auto;">
        <v-card>
          <v-card-title>
            <v-row>
              <v-spacer></v-spacer>
              <h2 style="color: #9bc220">FORMAS DE PAGO</h2>
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
              <v-avatar color="green" size="100">
                <v-icon dark size="70">
                  mdi-cash-100
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>
            <hr>
            <v-card-text>
              <h2>
                Podras pagarme en efectivo al repartidor al momento de recibir tu pedido o de retirarlo en tienda.
              </h2>
            </v-card-text>
          </v-card>
        </v-col>
      </v-col>
      <v-col cols="11" md="6" style="margin: auto;">
        <v-col>
          <v-card>
            <v-card-title>
              <v-spacer></v-spacer>
              <v-avatar color="blue" size="100">
                <v-icon dark size="70">
                  mdi-credit-card-check-outline
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>
            <hr>
            <v-card-text>
              <h2>
                Podras pagar  con  tarjeta de debito, tarjeta de credito al momento de recibir tu pedido o retirarlo en tienda.
              </h2>
            </v-card-text>
          </v-card>
        </v-col>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  name: "Formas"
}
</script>

<style scoped>

</style>