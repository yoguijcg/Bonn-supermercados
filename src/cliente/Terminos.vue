<template>
  <div style="background: #cbcbcb;">
    <br><br><br><br><br>
    <v-col cols="11" style="margin: auto;">
      <v-card>
        <v-card-title>
          <v-row>
            <v-spacer></v-spacer>
            <h2 style="color: #9bc220">TERMINOS Y CONDICIONES DE USO</h2>
            <v-spacer></v-spacer>
          </v-row>
        </v-card-title>
      </v-card>
    </v-col>

    <v-col cols="11" style="margin: auto;">
      <v-card>
        <v-col v-for="(t,n) in terminos" :key="n">
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
name: "Terminos",
  data:()=>({
    terminos:[
      {title:'1. Aceptación y conocimiento de los Términos y Condiciones:',text:'Estos son los Términos y Condiciones de Uso y Política de Privacidad (en adelante, las “Condiciones de Uso”) aplicables a las personas que accedan a los contenidos y servicios que BONNSUPERMERCADOS S.R.L. (en adelante, “Bonn”) pone a disposición a través del sitio www.bonnsupermercados.com.bo (en adelante indistintamente, el “Sitio Web” o “bonn.com.bo”).\n' +
            'La visita, el suministro de datos, la utilización y la navegación en el Sitio Web implica que Ud. ha leído, entendido y aceptado, plena y expresamente, las Condiciones de Uso que aquí se establecen. Si no está de acuerdo con lo anterior, por favor absténgase de usar el Sitio Web y de proporcionar cualquier información personal a través del mismo.\n'},
      {title: '2. Modificaciones de los Términos y Condiciones y del Sitio Web:', text: 'Bonn podrá actualizar, modificar, alterar, agregar o eliminar partes de estas Condiciones de Uso en cualquier momento que lo considere conveniente, sin necesidad de aviso previo. Ud. será responsable de revisar las Condiciones de Uso para verificar si se ha producido alguna modificación. Al hacer uso del Sitio Web una vez producida la modificación de las presentes Condiciones de Uso, dicho uso implicará aceptación de su parte de los términos modificados.\n' +
            'Bonn, asimismo, podrá modificar o interrumpir el servicio ofrecido a su sola discreción, en cualquier momento, ya sea en forma permanente o transitoria, sin necesidad de aviso previo ni de consentimiento de los usuarios no generando ello responsabilidad alguna para Bonn.\n'},
      {title: '3. Fallas en el sistema – Exclusión de responsabilidad:',text: 'Bonn no garantiza la inexistencia de eventuales dificultades técnicas o fallas en los sistemas o en Internet. Bonn no garantiza el acceso y uso continuo del Sitio Web. El sistema puede no estar disponible debido a dificultades técnicas o fallas de Internet o por cualquier otra circunstancia ajena a Bonn. En tales casos Bonn procurará restablecerlo con la mayor celeridad posible.               \n' +
            'Bonn no garantiza que el sitio web se encuentre libre de virus, gusanos o cualquier otro elemento que pueda llegar a dañar o alterar el normal funcionamiento de un ordenador. Es responsabilidad y obligación exclusiva del Usuario contar con las herramientas adecuadas para detectar, desinfectar y/o prevenir cualquier tipo de elementos y/o posibles daños de esta naturaleza.\n' +
            'Bonn no se responsabiliza por cualquier daño que pueda producirse en los equipos informáticos de los Usuarios o de terceros como consecuencia de la navegación del presente sitio web.\n'},
      {title: '4. Registro de Usuarios a bonn.com.bo y uso del Sitio Web:',text: 'El acceso al Sitio Web o a alguno de los servicios y contenidos brindados por éste puede hallarse condicionado a su previo registro, para lo cual deberá proveer a Bonn cierta información que se encuentra detallada en el formulario electrónico disponible al efecto en el Sitio Web. Ud. debe tener 18 años de edad o más para registrarse en el Sitio Web.\n' +
            'Para navegar en bonn.com.bo no es necesario ser usuario. Para realizar compras a través del Sitio Web sí es necesario ser usuario del Sitio Web. Se entiende por usuario a cualquier persona física o jurídica que se haya registrado en bonn.com.bo.\n' +
            'El registro como usuario es libre y gratuito. La información personal que ingrese en el registro es confidencial y se mantiene, entre el usuario y Bonn.\n' +
            'Al registrase Ud. deberá brindar información veraz, completa y precisa. Usted será el único responsable por la información proporcionada y por la actividad que se desarrolle en el Sitio Web y deberá mantener seguro el acceso al mismo. Bonn podrá solicitar algún comprobante o dato adicional a efectos de corroborar los datos personales de los usuarios del Sitio Web, así como podrá suspender a aquellos usuarios cuyos datos no hayan podido ser confirmados. En ningún caso podrá usar la cuenta de otro usuario del Sitio Web, siendo usted responsable por los daños y perjuicios ocasionados por el uso de cualquier cuenta ajena.\n' +
            'No se permite la utilización del Sitio Web para: (I) Ninguna actividad contraria a la ley, a la moral o a las buenas costumbres, (II) Subir (“up load”), publicar, transmitir o poner a disposición por cualquier medio y forma, cualquier material o contenido que pudiera ser considerado ofensivo, difamatorio, injurioso, calumnioso, discriminatorio u objetable, (III) Publicar, transmitir o poner a disposición por cualquier medio y forma, contenidos violatorios de derechos de terceros, incluidos, pero no limitados a, derechos de propiedad intelectual o industrial, (IV) Modificar el Sitio Web, servidores o redes conectadas, así como interferirlo o interrumpirlo, (V) Divulgar o colectar datos personales de terceros sin su previa autorización escrita a tales fines, (VI) Elegir o utilizar la cuenta de otra persona con la intención de hacerse pasar por dicha persona; (VII) Utilizar la cuenta de otra persona; (VIII) Elegir un nombre de usuario que Bonn, a su sola discreción, considere ofensivo o ilegal; (IX) Hacer uso comercial del Sitio Web sin autorización previa, por escrito, de Bonn.\n'},
      {title: '5. Capacidad:',text: 'Usted declara y garantiza a Bonn: (I) que tiene plenos poderes y facultades, asi como también la capacidad legal para celebrar Contratos y cumplir las obligaciones derivadas de los mismos, y que si se esta registrando en representación de una compañía o de alguna otra entidad, que tiene la facultad de obligar a su mandante o a la compañía que lo emplea; (II) que le brindara información completa y precisa a Bonn, incluyendo, aunque no en forma taxativa, sus recomendaciones o requerimientos.  '},
      {title: '6. Política de Privacidad de los datos personales otorgados por el Usuario:',text: 'La información y datos que Ud. nos proporcione a través del Sitio Web se incluirán en una base de datos que quedará bajo la responsabilidad de Bonn, con el objetivo de proporcionarle un servicio personalizado, mejorando el canal de comunicación con el usuario. Sus datos también podrán utilizarse para elaborar estadísticas y estudios de mercado. Asimismo, el registro en el Sitio Web implicará su autorización para que Bonn le envíe boletines, newsletters o correspondencia sobre las novedades institucionales, comerciales y promocionales de Bonn. Si no desea recibir mensajes, podrá solicitar la cancelación del envío de mensajes de acuerdo con el procedimiento que más adelante se indica.\n' +
            'Su registro en el Sitio Web y la aceptación de estas Condiciones de Uso, implica que Ud. presta su consentimiento expreso, libre e informado para la inclusión, uso y tratamiento de sus datos personales por Bonn.\n'},
      {title: '7. Veracidad de la información suministrada:',text: 'En caso de que la información o los datos suministrados por el Usuario no sean verdaderos, éste será responsable por los daños que este hecho pudiera ocasionar.  '},
      {title: '8. Disponibilidad y precio de los productos anunciados en el Sitio Web:',text: 'La disponibilidad de los productos anunciados en el sitio web está sujeta al movimiento diario del inventario de la sucursal que recibe y prepara el pedido. Por lo tanto algunos de los productos seleccionados pueden no encontrarse en stock en la sucursal al momento de preparar la orden de pedido efectuada por el usuario. A su vez, es posible que no estén disponibles en el sitio web algunos artículos que sí lo están en la sucursal. Las órdenes de pedido cursadas por los usuarios deben contemplar cantidades compatibles para consumo familiar.\n' +
            'ESTÁ PROHIBIDA LA VENTA DE BEBIDAS ALCOHÓLICAS A MENORES DE 18 AÑOS.\n'},
      {title: '9. Opciones del Usuario ante productos agotados o demorados:',text: 'De acuerdo con el punto anterior, en caso de que el o los productos se encontrasen agotados o demorados, Bonn se comunicara con el Usuario para invitarlo a elegir una de las siguientes opciones:\n' +
            'Optar por un producto alternativo que remplace al producto en cuestión.\n' +
            'Proseguir a realizar el pedido excluyendo el producto faltante.\n' +
            'Cancelación total del pedido a tratar. \n'},
      {title: '10. Impuesto al valor agregado (IVA):',text: 'Todos los precios expresados en el sitio web incluyen IVA, salvo que se indique lo contrario.'},
      {title: '11. Garantía de los productos:',text: 'El sitio web de Bonn apunta a exhibir imágenes de productos con la mayor precisión posible. No obstante, no podemos garantizar que el color que usted ve coincida con el color del producto, ya que la visualización del color depende en parte, del monitor que utilice y la luz del ambiente en el que se encuentra.\n' +
            'La utilización por parte suya del servicio es a su exclusivo riesgo. El servicio se brinda “en el estado en el que se encuentra” y “en la medida que esta disponible”\n' +
            'Para los productos de la categoría congelados, particularmente en época festival, se recomienda consumir los mismos frescos, dentro de un período prudencial a haberlos adquirido y evitando congelarlos por segunda vez.\n'},
      {title: '12. Devolución de los productos:',text: 'Bonn se reserva el derecho de atender devoluciones única y exclusivamente si presentasen algún defecto de fabricación, hubiesen sufrido roturas o deterioros en transito, o fueren despachados equivocadamente, el Usuario deberá comunicarse con el centro de Atención al Cliente dentro de los 1 días corridos posteriores a la adquisición del producto, para que Bonn proceda, según corresponda, a gestionar el re-despacho de la compra. Los gastos de devolución al cliente por defectos o fallas de origen corren por cuenta y orden de Bonn.     '},
      {title: '13. Pago de los productos objeto de las órdenes de pedido:',text: 'El pago de la compra se podrá realizar únicamente en moneda nacional. Los medios de pago aceptados por bonn.com.bo son: (I) tarjeta de crédito, (II) tarjeta de débito, (III) efectivo. Para su seguridad y satisfacción todo pago se efectuará a contra entrega del pedido realizado en el sitio web.'},
      {title: '14. Envió de productos – Tiempo de entrega – Horarios de Entrega:',text: 'Los pedidos únicamente se atenderán si se encuentran dentro de nuestras zonas de Reparto (Ciudad Satélite y Zona Villa Tejada Rectangular, ambos de la Ciudad El Alto).\n' +
            'Las entregas se realizaran a la dirección del domicilio que el Usuario indique. La validez de la misma es de su exclusiva responsabilidad.\n' +
            'Referente al tiempo de entrega, usted podrá elegir la hora en que quiere recibir el pedido en su domicilio siempre y cuando la hora seleccionada este abierto a más pedidos en nuestro calendario.\n' +
            'Los pedidos serán entregados de lunes a domingo, comenzamos a entregar los pedidos a las 09:00 a.m. y el último pedido del día se entregara a las 21:00 p.m. incluyendo feriados nacionales, salvo que exista una restricción vehicular. (El sitio web estará abierto las 24hrs de esta manera, pasada las 21:00 p.m. usted podrá seguir realizando sus pedidos pero se le entregaran al día siguiente, de igual forma usted deberá elegir el horario en el que desea recibir su pedido). \n'},
      {title: '15. Monto mínimo de Compra y Costo de entrega de los productos objeto de pedidos:',text: 'En las órdenes del pedido efectuada en la sucursal, en cada orden de pedido deberá seleccionarse el día y rango horario en que el usuario desea recibir el pedido. El costo de la entrega a domicilio será gratuito para compras superiores a 81 Bs.  Y el costo para compras menores a 81 Bs. tendrá un cargo adicional de 10 Bs. El monto mínimo de compra a través del Sitio Web será de 30 Bs. '},
      {title: '16. Dirección de la entrega:',text: 'La dirección en donde se entregara el pedido será la que el Usuario indique. Podrá no coincidir con su domicilio. Es responsabilidad del Usuario completar y revisar cuidadosamente la información relacionada con la entrega, para que el envió de la compra se haga de manera efectiva y puntual.'},
      {title: '17. Facturación:',text: 'El Usuario recibirá junto al envió una factura con la información clara y precisa acerca de los productos comprados. El usuario deberá prestar su conformidad completando un recuadro con su firma, nombre y numero de carnet, como constancia de que usted recibió el pedido satisfechamente.  '},
      {title: '18. Cancelación de un pedido:',text: 'Sin perjuicio de lo establecido en el punto 12, el Usuario podrá cancelar un pedido siempre y cuando este no haya sido aun despachado y deberá comunicarse con el Centro de Atención al Cliente 1 hora antes del horario que eligió recibir el pedido para que se proceda a la cancelación total del pedido.'},
      {title: '19. Propiedad Intelectual:',text: 'Ud. reconoce y acepta que todo el material y contenidos publicados en el Sitio Web, incluidos - pero no limitado a - textos, software, gráficos, fotografías, audio, música, videos, contenidos interactivos y similares, pertenecen a Bonn o han sido otorgados a Bonn bajo licencia, encontrándose protegidos por derechos de propiedad intelectual.\n' +
            'Ud. sólo podrá utilizar la información y materiales contenidos en el Sitio Web exclusivamente con fines privados y no comerciales. Dicha información y materiales no podrán ser utilizados, copiados, reproducidos, modificados, alterados, vendidos, licenciados o explotados de cualquier otro modo, directa o indirectamente, en ningún medio o soporte, para un uso distinto del estrictamente personal, ni realizar cualquier otro acto que viole los derechos de propiedad intelectual de Bonn o de terceros.\n' +
            'Bonn.com.bo es marca registrada de BONNSUPERMERCADOS S.R.L. Asimismo, todos los signos distintivos, elementos corporativos, programas de software, bases de datos, música y audio, marcas, logotipos y diseños gráficos, están protegidos por derechos de propiedad intelectual e industrial de los que Bonn es propietaria o con legítima licencia. Queda terminantemente prohibida su utilización, reproducción o explotación en cualquier forma y por cualquier medio, sin la autorización previa y expresa de Bonn. \n'},
      {title: '20. Atención al Cliente – Soporte Técnico:',text: 'Por cualquier consulta comunícate con el CENTRO DE ATENCIÓN AL CLIENTE al 281 53 96 en días hábiles, de lunes a viernes, de 09:00 a 17:00 hs.\n' +
            'Para consultas técnicas comunícate con el centro de soporte técnico de Bonn supermercados enviándonos un e-mail a bonnsupermercado@gmail.com.\n'}
    ]
  })
}
</script>

<style scoped>

</style>