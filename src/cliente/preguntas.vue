<template>
  <div>
    <br><br><br><br><br>
    <v-row>
      <v-col cols="11" style="margin: auto;">
        <v-card>
          <v-row>
            <v-spacer></v-spacer>
            <h2>PREGUNTAS  FRECUENTES</h2>
            <v-spacer></v-spacer>
          </v-row>
        </v-card>
      </v-col>
      <v-col cols="11" md="5" style="margin: auto;">
        <v-card>
          <v-card-title>
            <H5>            PREGUNTAS FRECUENTES COMPRA
            </H5>
          </v-card-title>
          <hr>
          <v-card-text>

            <v-expansion-panels focusable>
              <v-expansion-panel
                  v-for="(item,i) in pfc"
                  :key="i"
              >
                <v-expansion-panel-header><strong>{{ item.title }}</strong></v-expansion-panel-header>
                <v-expansion-panel-content>
                  {{item.text}}
                </v-expansion-panel-content>
              </v-expansion-panel>
            </v-expansion-panels>

          </v-card-text>
        </v-card>

      </v-col>
      <v-col cols="11" md="5" style="margin: auto;">
        <v-card>
          <v-card-title>
            <H5>PREGUNTAS FRECUENTES ENTREGA</H5>
          </v-card-title>
          <hr>
          <v-card-text>

            <v-expansion-panels focusable>
              <v-expansion-panel
                  v-for="(item,i) in pfe"
                  :key="i"
              >
                <v-expansion-panel-header><strong>{{ item.title }}</strong></v-expansion-panel-header>
                <v-expansion-panel-content>
                  {{item.text}}
                </v-expansion-panel-content>
              </v-expansion-panel>
            </v-expansion-panels>

          </v-card-text>
        </v-card>

      </v-col>

    </v-row>
  </div>
</template>

<script>
export default {
name: "preguntas",
  data:()=>({
    pfe:[
      {
        title:'¿PUEDO REALIZAR UN PEDIDO Y RECIBIRLO O RETIRARLO DURANTE EL MISMO DIA?',
        text:'Si, de hecho todos los pedidos que realizes se te entregaran en el mismo dia, tú deberas elegir la hora aproximada en la que quieres recibir tu pedido. Pero deberas realizar tu pedido minimo 1 hora antes del horario que quieras recibirlo.'

      },
      {
        title: 'EL ENVIO A DOMICILIO ¿TIENE COSTO?',
        text:'Si, se adicionara una tarifa estandar al importe de tu pedido.'
      },
      {
        title:'¿CUAL ES EL COSTO DE RETIRAR UN PEDIDO EN TIENDA?',
        text:'Por armar el pedido, el retiro en tienda tendra un costo minimo de Bs. 1.'

      },
      {
        title: '¿PUEDE UN TERCERO RETIRAR MI PEDIDO?',
        text: 'Si, en caso de que la persona que hizo el pedido no pueda venir a retirarlo puede venir un tercero, sin embargo antes nos debera mandar un mensaje al whatsapp 78760524 indicandonos el nombre de la persona que retirara el pedido por esta ocasión.'
      },
      {
        title:'LUEGO DE FINALIZAR MI PEDIDO ¿RECIBO ALGUNA CONFIRMACIÓN?',
        text:'Si, despues de realizar el pedido recibira un mail de confirmación al correo registrado en la pagina, el correo podria llegarle de 5 a 15 min despues de hacer el pedido, el mail tendra la información de entrega y detalle del pedido. '

      },
      {
        title: '¿PUEDO AGREGAR, QUITAR PRODUCTOS O CAMBIAR EL HORARIO DE ENTREGA DE MI PEDIDO?',
        text:'No, una vez hecho el pedido no pueden realizarse modificaciones.'
      },
      {
        title:'¿PUEDO CANCELAR MI PEDIDO?',
        text:'Si, tienes que comunicarte con nosotros al centro de Atención al cliente 2815396, mandar un mensaje al whatsapp 78760524 o mandarnos un mensaje por nuestro centro de mensajes que se encuentra en nuestra pagina bonnsupermercados.com, deberas indicarnos tu nombre con el que realizaste el pedido y listo. Deberas cancelar como minimo 1 hora antes del horario de entrega que elegiste.'

      },
      {
        title: 'EL HORARIO DE ENTREGA DE MI PEDIDO YA CONCLUYO Y TODAVIA NO LLEGA ¿QUÉ PUEDO HACER?',
        text:'Le recordamos que si varias personas eligieron la misma hora de entrega se les atendera por orden de llegada del pedido. Esto podria demorar hasta 1 hora despues de la hora de entrega elegida, Le rogamos comprensión. Si ya paso el tiempo por favor comunicate con nosotros al 78760524 o envianos un mensaje por nuestro centro de mensajes de la pagina.'
      },
      {
        title: 'SI NO ESTOY CONFORME CON UN PRODUCTO RECIBIDO ¿PUEDO SOLICITAR UN CAMBIO O DEVOLUCIÓN?',
        text:'No, los cambios o devoluciones solo podran efectuarse si el producto tuviera un defecto (Rotura de envase, producto defectuoso). Si el motivo fuera otro no podemos realizar ni la devolución ni el cambio.'
      }
    ],
    pfc:[
      {
        title: 'DIRECCIÓN BONN SUPERMERCADOS',
        text:'Ciudad Satelite Calle 30 B Nº 66.'
      },
      {
        title: 'CONTACTOS BONN SUPERMERCADOS',
        text:'Ciudad Satelite Calle 30 B Nº 66. Telf. 2815396 Cel. 78760524. Correo: bonnsupermercados@gmail.com.'
      },
      {
        title: 'HORARIOS DE ATENCIÓN',
        text:'Tienda Fisica abierto de 09:00 a 21:00. Horario de las entregas a domicilio desde las 09:00 a 21:00.'
      },
      {
        title: 'METODOS DE PAGO',
        text:'Efectivo, Tarjeta de débito, tarjeta de credito. Realizaras el pago al momento de recibir tu pedido.'
      },
      {
        title: '¿QUÉ PASA SI NO ESTOY DENTRO DE LA ZONA DE COBERTURA?',
        text:'El pedido se enviara de igual manera pero se cobrara por el envío dependiendo la zona.'
      },
      {
        title: 'TIEMPOS DE ENTREGA',
        text:'Podra elegir la hora aproximada en la que desea recibir el pedido, si varias personas eligen el mismo horario de entrega se les atendera por orden de llegada.'
      },
      {
        title: '¿QUÉ ES EL SERVICIO DE DELIVERY?',
        text:'Es el servicio en el que un cliente puede llamar por telefono o via web y hacer sus compras desde su casa, nosotros nos encargamos de alistar la compra y enviarlo hasta la dirección del cliente.'
      },
      {
        title: '¿CUÁL ES EL MONTO MINIMO DE COMPRA?',
        text:'El monto minimo es de Bs 50, sin embargo se puede enviar por un monto menor pero se cobrara el envío.'
      },
      {
        title: '¿QUÉ PRODUCTOS PUEDO COMPRAR EN BONNSUPERMERCADOS.COM?',
        text:'Los mismos productos que encuentras en nuestro local estan disponibles en bonnsupermercados.com (incluidos ofertas y promociones). Actualmente contamos con mas de 4 mil productos activos online a tú disposición. Para nosotros es importante cumplir con tus expectativas por ello ampliamos nuestro surtido cada semana.'
      },
      {
        title: '¿POR QUÉ COMPRAR EN BONNSUPERMERCADOS.COM?',
        text:'En Bonn valoramos tu tiempo y entendemos el esfuerzo que lleva conseguir cada billete. Es por eso que nuestra prioridad es ofrecerte productos de calidad, con una amplia variedad, al menor precio posible con nuestra politica SPB (Siempre Precios Bajos), brindandote siempre un servicio de calidad.'
      },
      {
        title: '¿QUÉ PASA SI NO HAY ALGÚN PRODUCTO QUE NECESITO?',
        text:'En caso de no tener un producto que elegiste en stock, nos comunicaremos contigo por mensaje o llamada consultandote si deseas reemplazar el producto, descartar el producto o cancelar todo el pedido'
      },
      {
        title: '¿PUEDO HACER PEDIDOS PARA MI EMPRESA?',
        text:'Si, los pedidos pueden ser registrados tanto a nombre de una empresa o a nombre de una persona particular solo deberas colocar el NIT y nombre de tu empresa para la factura y la dirección de entrega para la empresa.'
      },
      {
        title: '¿LOS PRECIOS DE LA PAGINA DIFIEREN DE LOS PRECIOS DEL LOCAL?',
        text:'No, los precios en bonnsupermercados.com son los mismos precios que los que manejamos en nuestro local'
      },
      {
        title: '¿CÓMO BUSCO PRODUCTOS EN BONNSUPERMERCADOS.COM?',
        text:'En bonnsupermercados.com tienes 2 formas para buscar tus productos. 1. Busqueda por categorias: En el menú podras encontrar las principales categorias de nuestro productos y navegar por ellas. 2. Busqueda por el Buscador: En el buscador poniendo el nombre del producto que quieres el sistema te arrojara una lista de productos correspondientes a la palabra ingresada.'
      },
      {
        title: '¿CÓMO FUNCIONA MI CARRITO?',
        text:'En la esquina superior derecha se encuentra el carrito de compras, en el cual apareceran todos los productos que hayas agregado a lo largo de tú pedido. Para aumentar la cantidad de productos desde el carrito deberas presionar los signos que se encuentran al lado de cada producto. Si quieres eliminar algún producto de tu carrito deberas reducir la cantidad a 0. Si decidiste salir de la pagina y volver mas tarde, al reingresar al sitio, tu carrito va a seguir armado para que continues tu compra.'
      },
      {
        title: '¿CÓMO SE ARMA MI PEDIDO?',
        text:'En Bonn Supermercados tenemos personal especialmente entrenado, quienes seleccionaran todos los productos de tú pedido con el mismo cuidado y atención como lo harias tú mismo. En caso de productos congelados los mismos son seleccionados al final del armado del pedido con la refrigeración adecuada para que no pierdan la cadena de frio. Estas son guardados hasta su retiro en heladeras especialmente acondicionadas. En caso de que los productos sean enviados a tu domicilio los mismos iran en contenedores termicos que cuenten con la refrigeración acorde.'
      },

    ]
  })
}
</script>

<style scoped>

</style>