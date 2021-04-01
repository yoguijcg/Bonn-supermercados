<template>
  <div>
    <br><br><br><br><br>
    <v-row style="margin: 1%;">
      <v-col cols="11" style="margin: auto;">
        <v-card>
          <v-card-title>
            <v-row>
              <v-spacer></v-spacer>
              <h3 style="color: #9bc220">CONOCE  SOBRE BONN</h3>
              <v-spacer></v-spacer>
            </v-row>
          </v-card-title>
          <v-card-text>
            <h4>
              Bienvenidos a <strong>bonnsupermercados.com</strong> como  el supermercado online que trabaja dia a dia para hacerte la vida mas facil, convertiendo la aburrida rutina de hacer filas y cargar bolsas pesadas, en un verdadero placer y ahorrando tiempo para que lo disfrutes en lo que mas te guste hacer.
            </h4><br>
            <h4>
              <strong>bonnsupermercados.com</strong> nacio con un objetivo en poder mejorar la vida de las personas y es por eso que trabajamos dia a dia mejorando todos nuestros servicios de cara al cliente facilitando al maximo todo el proceso de compra.
            </h4>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="11" md="6" style="margin: auto;">
        <v-card>
          <v-card-title>
            <H3 style="color:#e30d18;">            VISIÓN
            </H3>
          </v-card-title>
          <hr>
          <v-card-text style="height: 300px">
            <h3>
              Nuestro objetivo es ser el lugar de compra preferido de los consumidores llegando a establecer una cadena agroalimentaria sostenible que la gente sienta orgullo de ella.
            </h3>
          </v-card-text>
        </v-card>

      </v-col>
      <v-col cols="11" md="6" style="margin: auto;">
        <v-card>
          <v-card-title>
            <H3 style="color:#e30d18;">MISIÓN</H3>
          </v-card-title>
          <hr>
          <v-card-text style="height: 300px">
            <h3>
              Ayudar a los consumidores a realizar su compra inteligente proporcionandole soluciones que cubran sus necesidades de comer, beber, cuidado personal, cuidado del hogar y cuidado de mascotas...
            </h3>
            <br>
            <h3>
              Asegurando siempre maxima calidad, maximo servicio, minimo presupuesto y minimo tiempo.
            </h3>
          </v-card-text>
        </v-card>

      </v-col>
      <v-col cols="11" style="margin: auto;">
        <v-img src="https://bonnsupermercados.com/bonnlogoN.png"
        >

        </v-img>
      </v-col>
      <v-col cols="11" md="6" style="margin: auto;">
        <v-col v-for="(a,x) in cau1" :key="x">
          <v-card>
            <v-card-title>
              {{ a.text }}
            </v-card-title>
          </v-card>
        </v-col>
      </v-col>
      <v-col cols="11" md="6" style="margin: auto;">
        <v-col v-for="(a,x) in cau2" :key="x">
          <v-card>
            <v-card-title>
              {{a.text}}
            </v-card-title>
          </v-card>
        </v-col>
      </v-col>
      <v-col cols="11" style="margin: auto;">
        <v-card>
          <v-card-title>
            <v-row>
              <v-spacer></v-spacer>
              <h3 style="color: #9bc220">QUE NOS DIFERENCIA DE OTROS SUPERMERCADOS</h3>
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
                  mdi-account-outline
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>
            <hr>
            <v-card-text>
              <h2>
                Nuestro servicio de atencion al cliente  esta a tu dispocision y respondera cualquier duda que puedas tener. Puedes contactarnos por telefono o por email.
              </h2>
            </v-card-text>
          </v-card>
        </v-col>
        <v-col>
          <v-card>
            <v-card-title>
              <v-spacer></v-spacer>
              <v-avatar color="orange" size="100">
                <v-icon dark size="70">
                  mdi-star-outline
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>
            <hr>
            <v-card-text>
              <h2>
                La calidad de nuestros productos es la garantia de tu satisfaccion y no hay mejor prueba de ello que la fidelidad de aquellos clientes que ya compran en <strong>Bonn Supermercados</strong>  de forma habitual. La calidad y el servicio es nuestra vocacion.
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
              <v-avatar color="#9bc220" size="100">
                <v-icon dark size="70">
                  mdi-cart-variant
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>
            <hr>
            <v-card-text>
              <h2>
                Nuestro surtido de mas de 4 mil productos de las primeras marcas esta en continuo crecimiento: alimentacion, frescos, higiene...  Continuamente estamos incorporando nuevas referencias con la mejor calidad y los mejores precios.
              </h2>
            </v-card-text>
          </v-card>
        </v-col>
        <v-col>
          <v-card>
            <v-card-title>
              <v-spacer></v-spacer>
              <v-avatar color="green" size="100">
                <v-icon dark size="70">
                  mdi-cash
                </v-icon>
              </v-avatar>
              <v-spacer></v-spacer>
            </v-card-title>
            <hr>
            <v-card-text>
              <h2>
                En <strong>Bonn Supermercados</strong> valoramos tu esfuerzo es por eso que aqui siempre contaras con nuestra politica de SPB(siempre precios bajos).
              </h2>
            </v-card-text>
          </v-card>
        </v-col>
      </v-col>
      <v-col cols="11" style="margin: auto;">
        <v-card>
          <v-card-title>
            <v-row>
              <v-spacer></v-spacer>
              <div style="color: #e30d18;" >
                <h1 style="width: 100%;">
                  <div class="text-justify">
                    ¡NUNCA NADIE TE LO HABIA PUESTO TAN FACIL!
                  </div>
                </h1>

              </div>
              <v-spacer></v-spacer>
            </v-row>
          </v-card-title>
        </v-card>
      </v-col>

    </v-row>
  </div>
</template>

<script>
export default {
  name: "Conoce",
  data:()=>({
    cau1:[
      {
        text:'Una web facil e intuitiva'
      },
      {text: 'Mas de 4 mil productos'},
      {text: 'Nuestro objetivo ahorrarte tiempo y dinero'},
      {text: 'La calidad de nuestros productos es nuestra garantia'}
    ],
    cau2:[
      {text:'Amplio horario de entrega'},
      {text: 'Haz la compra desde donde tu estes'},
      {text: 'Una tienda online que te permitira hacer la compra en 10 min.'},
      {text: '99% de los pedidos entregados en hora'}
    ]
  })
}
</script>

<style scoped>

</style>