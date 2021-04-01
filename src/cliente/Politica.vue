<template>
  <div style="background: #cbcbcb;">
    <br><br><br><br><br>

    <v-col cols="11" style="margin: auto;">
      <v-card>
        <v-card-title>
          <v-row>
            <v-spacer></v-spacer>
            <h2 style="color: #9bc220">POLITICA DE PRIVACIDAD</h2>
            <v-spacer></v-spacer>
          </v-row>
        </v-card-title>
      </v-card>
    </v-col>

    <v-col cols="11" style="margin: auto;">
      <v-card>
        <v-col>
          <v-card-title>
            <v-spacer></v-spacer>
            1. DATOS PERSONALES QUE TRATAMOS
            <v-spacer></v-spacer>
          </v-card-title>
          <hr>
          <v-card-text>
            <p class="text-justify" style="font-size: large">
              Nosotros tratamos los datos personales que usted nos proporciona, así como otros datos generados en el contexto de su actividad en nuestra web, como las operaciones que realice, siempre que dicha recogida se encuentre permitida por la Ley.
              <br>
              Tenga en cuenta que la información señalada como obligatoria es imprescindible para poder finalizar el pedido, cobrarle y enviarle el producto, según el método de entrega seleccionado por lo que, de no facilitarla, no será posible tramitar su pedido por nuestra parte o, en su caso, por los vendedores del Supermercado.
              <br><br>
              <strong>(a) Información que usted nos proporciona</strong><br>
              Nosotros podremos tratar las siguientes categorías de datos personales proporcionadas por usted al completar el formulario necesario para la compra online.
              <br>
              • datos de carácter identificativo, como nombre, apellidos, sexo, NIT/CI, teléfono, correo electrónico,
              <br>
              • datos relativos a la navegación. <br><br>
              <strong>(b) Otra información sobre usted</strong><br>
              Finalmente, también podremos recabar los datos a partir del uso que usted efectúe del Portal como navegación por la web así como cuando se ponga en contacto con nosotros a través del servicio de Atención al Cliente o adquiera algún producto a través del Sitio Web.
            </p>
          </v-card-text>
        </v-col>
        <v-col>
          <v-card-title>
            <v-spacer></v-spacer>
            2. CÓMO Y CON QUÉ BASE TRATAMOS SUS DATOS PERSONALES
            <v-spacer></v-spacer>
          </v-card-title>
          <hr>
          <v-card-text>
            <p class="text-justify" style="font-size: large">
              Sus datos personales serán tratados para las finalidades y con las bases legitimadoras que se indican a continuación:
              <br><br>• Para poder gestionar su pedido  y proceder al envío del mismo, incluido responder a sus dudas, quejas, sugerencias o preguntas, planteadas en relación con su compra, a través de los distintos medios ofrecidos al respecto).
              <br><br>• Para responder a sus dudas, quejas, sugerencias o preguntas, planteadas a través de los distintos medios ofrecidos al respecto, en aquellos casos en los que usted no haya realizado un pedido previamente y hubiera prestado su consentimiento. La finalidad principal (gestionar su pedido) no estará supeditada a que preste su consentimiento para este tratamiento específico de sus datos personales;
              <br><br>• Asimismo, el tratamiento de sus datos personales persigue satisfacer el interés legítimo que tiene Bonn Supermercado en lograr la centralización de las operaciones de tratamiento de los clientes (servicios de atención al cliente, respuesta a dudas, sugerencias y preguntas, etc.) con el fin de ofrecerle un mejor servicio y más personalizado.
              <br><br>• Para poder identificarle y poder contactar con Usted a efectos de informarle sobre acciones o cuestiones relacionadas con la Tienda Online y llevar a cabo cuantas gestiones resulten necesarias en relación con el servicio ofrecido por los vendedores a través de la Tienda Online de Bonn Supermercados.

            </p>
          </v-card-text>
        </v-col>
        <v-col v-for="(t,n) in politica" :key="n">
          <v-card-title>
            <v-spacer></v-spacer>
            {{ t.title }}
            <v-spacer></v-spacer>
          </v-card-title>
          <hr>
          <v-card-text>
            <p class="text-justify" style="font-size: large">
              {{ t.text }}
            </p>
          </v-card-text>
        </v-col>
      </v-card>
    </v-col>
  </div>

</template>

<script>
export default {
  name: "Politica",
  data:()=>({
    politica:[
      {title: '3. SUS DERECHOS',text: 'Usted tiene derecho a que Carrefour le confirme si se están tratando o no sus datos personales y, en su caso, a solicitar el acceso a los datos personales y a determinada información sobre el tratamiento (fines, categorías de datos tratados y destinatarios, entre otros aspectos) (derecho de acceso). Asimismo, tiene derecho a solicitar la rectificación de los datos inexactos (derecho de rectificación), así como la supresión de los mismos cuando, entre otros motivos, éstos ya no sean necesarios para los fines para los que fueron recogidos (derecho de supresión). En determinadas circunstancias (por ejemplo, en caso de que el interesado impugne la exactitud de sus datos, mientras se verifica la exactitud de los mismos), usted podrá solicitar que se limite el tratamiento de sus datos personales, siendo estos únicamente tratados para el ejercicio o la defensa de reclamaciones (derecho a la limitación del tratamiento). Finalmente, en aquellos casos en que el tratamiento de sus datos esté basado en su consentimiento, tendrá derecho a retirar el consentimiento en cualquier momento, sin que ello afecte a la licitud del tratamiento previo a la retirada.\n'},
      {title: '4. DESTINATARIOS DE SUS DATOS PERSONALES\n',text: 'Nosotros podremos compartir sus datos personales con terceros en las siguientes circunstancias:\n' +
            '• A las siguientes categorías de prestadores de servicios que Bonn Supermercados requiere para poder gestionar los pedidos de Clientes: prestadores de servicios de autenticación y gestión de accesos, marketing (incluyendo marketing en la nube), analíticas Web, digitalización y borrado de la información y reparto a domicilio.\n' +
            'En el contexto de la Tienda Online, comunicaremos sus datos a los vendedores de Bonn Supermercado para que estos puedan completar su pedido y proceder al envío del producto solicitado. \n'},
      {title: '5. CONSERVACIÓN DE SUS DATOS PERSONALES',text: 'Conservaremos sus datos personales durante los 24 meses posteriores a la entrega de su pedido, por si usted solicita determinada información que pueda requerir el acceso a los datos personales tratados en el contexto de su pedido. Una vez finalizado dicho plazo, sus datos personales serán debidamente cancelados, es decir, bloqueados durante el plazo de prescripción de las responsabilidades nacidas del tratamiento y finalmente borrados.'},
      {title: '6. TIENDA ONLINE',text: 'En el entorno de la Tienda Online de Bonn, la presente Política se aplica únicamente a la recogida y tratamiento de sus datos por parte de Bonn en el momento de registro y acceso a la Tienda Online. Una vez comunicados sus datos al vendedor del Supermercado con el objeto de tramitar su pedido y completar la compra, el vendedor como responsable del tratamiento de sus datos, deberá proceder a cumplir las obligaciones legales que le correspondan en materia de protección de datos de conformidad con la normativa aplicable en cada momento.'}
    ]
  })
}
</script>

<style scoped>

</style>