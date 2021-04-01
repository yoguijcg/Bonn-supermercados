<template>
  <div>
    <br><br><br><br>

    <v-col cols="12" >
      <v-carousel
          cycle
          hide-delimiter-background
          show-arrows-on-hover
          height="auto"
      >
        <v-carousel-item
            v-for="(caru, i) in caruO"
            :key="i"
            :src="'https://bonnsupermercados.com/'+caru.img"
        >
        </v-carousel-item>
      </v-carousel>
    </v-col>


    <div v-if="!isMobile()">
      <v-col cols="12">
        <v-card>
          <v-card-title>
            <h1 style="margin: auto;">Los Mas Vendidos</h1>
          </v-card-title>
          <v-card-text>
            <v-sheet
                class="mx-auto"
                elevation="8"
                height="500"
            >
              <v-slide-group

                  class="pa-4"
                  active-class="success"
                  show-arrows
              >
                <v-slide-item
                    v-for="(ma,n) in masvend"
                    :key="n"
                >
                  <div>
                    <v-hover v-slot="{ hover }">
                      <v-card
                          class="ma-4"
                          color="grey lighten-4"
                          height="420"
                          width="300"
                      >
                        <v-img
                            :aspect-ratio="16/9"
                            :src="'https://bonnsupermercados.com/'+ma.imagen"
                        >
                          <v-expand-transition>
                            <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out darken-2 display-3 white--text"
                                style="height: 100%;align-items: center;bottom: 0;justify-content: center;opacity: .7;position: absolute;width: 100%; background: #dedc03;"
                            >
                              <v-btn icon large dark color="black" @click="mostrarma(ma)">
                                <v-icon>mdi-eye</v-icon>
                              </v-btn>
                            </div>
                          </v-expand-transition>
                        </v-img>
                        <v-card-text
                            class="pt-6"
                            style="height: 200px; overflow-y: auto;"
                        >
                          <h3>Nombre:</h3>
                          <h4>
                            {{ma.nombre}}
                          </h4>
                          <br>
                          <h3>Barcode:</h3>
                          <h4>
                            {{ ma.codigoBarras }}
                          </h4>
                        </v-card-text>
                        <v-divider></v-divider>
                        <div style="height: 50px;">
                          <div >
                            <h1 style="text-align: end; padding-top: 8px; margin-right: 5%;"
                            >
                              Bs. {{ma.precioV}}
                            </h1>
                          </div>
                          <v-expand-transition>
                            <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out darken-2 v-card--reveal  white--text"
                                style="height: 50px;align-items: center;bottom: 0;justify-content: center;position: absolute;width: 100%;background:#9bc220;"
                            >
                              <div style="background: white;">
                                <input
                                    style="width: 40px; border: black solid 2px; border-radius: 5px; text-align: center"
                                    type="number"
                                    value="1"
                                    min="1"
                                    id="cprodma"
                                >
                              </div>
                              <div style="width: 50px;"></div>
                              <v-btn icon dark large @click="agregarma(ma)">
                                <v-icon>
                                  mdi-cart-plus
                                </v-icon>
                              </v-btn>

                            </div>
                          </v-expand-transition>
                        </div>
                      </v-card>
                    </v-hover>

                  </div>
                </v-slide-item>
              </v-slide-group>
            </v-sheet>
          </v-card-text>
        </v-card>

      </v-col>

      <v-col cols="12">
        <v-card>
          <v-card-title>
            <h1 style="margin: auto;">Aproveche las ofertas</h1>
          </v-card-title>
          <v-card-text>
            <v-sheet
                class="mx-auto"
                elevation="8"
                height="500"
            >
              <v-slide-group

                  class="pa-4"
                  active-class="success"
                  show-arrows
              >
                <v-slide-item
                    v-for="(pm,n) in promo"
                    :key="n"
                >
                  <div>
                    <v-hover v-slot="{ hover }">
                      <v-card
                          class="ma-4"
                          color="grey lighten-4"
                          height="420"
                          width="300"

                      >
                        <v-img
                            :aspect-ratio="16/9"
                            :src="'https://bonnsupermercados.com/'+pm.imagen"
                        >
                          <v-expand-transition>
                            <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out darken-2 display-3 white--text"
                                style="height: 100%;align-items: center;bottom: 0;justify-content: center;opacity: .7;position: absolute;width: 100%; background: #dedc03;"
                            >
                              <v-btn icon large dark color="black" @click="mostrar(pm)">
                                <v-icon>mdi-eye</v-icon>
                              </v-btn>
                            </div>
                          </v-expand-transition>
                        </v-img>
                        <v-card-text
                            class="pt-6"
                            style="height: 200px; overflow-y: auto;"
                        >
                          <h3>Nombre:</h3>
                          <h4>
                            {{pm.nombre}}
                          </h4>
                          <br>
                          <h3>Descuento:</h3>
                          <h4>
                            {{ pm.descuento }}%
                          </h4>
                          <br>
                          <h3>Barcode:</h3>
                          <h4>
                            {{ pm.codigoBarras }}
                          </h4>
                        </v-card-text>
                        <v-divider></v-divider>
                        <div style="height: 50px;">
                          <div >
                            <h1 style="text-align: end; padding-top: 8px; margin-right: 5%;"
                            >
                              Bs. {{pm.total}}
                            </h1>
                          </div>
                          <v-expand-transition>
                            <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out darken-2 v-card--reveal  white--text"
                                style="height: 50px;align-items: center;bottom: 0;justify-content: center;position: absolute;width: 100%;background:#9bc220;"
                            >
                              <div style="background: white;">
                                <input
                                    style="width: 40px; border: black solid 2px; border-radius: 5px; text-align: center"
                                    type="number"
                                    value="1"
                                    min="1"
                                    id="cprod"
                                >
                              </div>
                              <div style="width: 50px;"></div>
                              <v-btn icon dark large @click="agregar(pm)">
                                <v-icon>
                                  mdi-cart-plus
                                </v-icon>
                              </v-btn>

                            </div>
                          </v-expand-transition>
                        </div>
                      </v-card>
                    </v-hover>

                  </div>
                </v-slide-item>
              </v-slide-group>
            </v-sheet>
          </v-card-text>
        </v-card>


      </v-col>

      <v-col cols="12">
        <v-card>
          <v-card-title>
            <h1 style="margin: auto;">Lo Ultimo En Llegar</h1>
          </v-card-title>
          <v-card-text>
            <v-sheet
                class="mx-auto"
                elevation="8"
                height="500"
            >
              <v-slide-group

                  class="pa-4"
                  active-class="success"
                  show-arrows
              >
                <v-slide-item
                    v-for="(re,n) in reciente"
                    :key="n"
                >
                  <div>

                    <v-hover v-slot="{ hover }">
                      <v-card
                          class="ma-4"
                          color="grey lighten-4"
                          height="420"
                          width="300"

                      >
                        <v-img
                            :aspect-ratio="16/9"
                            :src="'https://bonnsupermercados.com/'+re.imagen"
                        >
                          <v-expand-transition>
                            <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out darken-2 display-3 white--text"
                                style="height: 100%;align-items: center;bottom: 0;justify-content: center;opacity: .7;position: absolute;width: 100%; background: #dedc03;"
                            >
                              <v-btn icon large dark color="black" @click="mostrarre(re)">
                                <v-icon>mdi-eye</v-icon>
                              </v-btn>
                            </div>
                          </v-expand-transition>
                        </v-img>
                        <v-card-text
                            class="pt-6"
                            style="height: 200px; overflow-y: auto;"
                        >
                          <h3>Nombre:</h3>
                          <h4>
                            {{re.nombre}}
                          </h4>
                          <br>
                          <h3>Barcode:</h3>
                          <h4>
                            {{ re.codigoBarras }}
                          </h4>
                        </v-card-text>
                        <v-divider></v-divider>
                        <div style="height: 50px;">
                          <div >
                            <h1 style="text-align: end; padding-top: 8px; margin-right: 5%;"
                            >
                              Bs. {{re.precioV}}
                            </h1>
                          </div>
                          <v-expand-transition>
                            <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out darken-2 v-card--reveal  white--text"
                                style="height: 50px;align-items: center;bottom: 0;justify-content: center;position: absolute;width: 100%;background:#9bc220;"
                            >
                              <div style="background: white;">
                                <input
                                    style="width: 40px; border: black solid 2px; border-radius: 5px; text-align: center"
                                    type="number"
                                    value="1"
                                    min="1"
                                    id="cprodre"
                                >
                              </div>
                              <div style="width: 50px;"></div>
                              <v-btn icon dark large @click="agregarre(re)">
                                <v-icon>
                                  mdi-cart-plus
                                </v-icon>
                              </v-btn>

                            </div>
                          </v-expand-transition>
                        </div>
                      </v-card>
                    </v-hover>

                  </div>
                </v-slide-item>
              </v-slide-group>
            </v-sheet>
          </v-card-text>
        </v-card>
      </v-col>
    </div>
    <div v-else>




      <v-col cols="12">
        <v-card>
          <v-card-title>
            <h3 style="margin: auto;">Los Mas Vendidos</h3>
          </v-card-title>
          <v-card-text>
            <section id="main">
              <aside id="horizontal-scroll">
                <v-col v-for="(ma,x) in masvend" :key="x">
                  <v-hover v-slot="{ hover }">
                    <v-card
                        color="grey lighten-4"
                        width="250"
                    >
                      <v-img
                          :aspect-ratio="16/9"
                          :src="'https://bonnsupermercados.com/'+ma.imagen"
                      >
                        <v-expand-transition>
                          <div
                              v-if="hover"
                              class="d-flex transition-fast-in-fast-out darken-2 display-3 white--text"
                              style="height: 100%;align-items: center;bottom: 0;justify-content: center;opacity: .7;position: absolute;width: 100%; background: #dedc03;"
                          >
                            <v-btn icon large dark color="black" @click="mostrarma(ma)">
                              <v-icon>mdi-eye</v-icon>
                            </v-btn>
                          </div>
                        </v-expand-transition>
                      </v-img>
                      <v-card-text
                          class="pt-6"
                          style="height: 200px; overflow-y: auto;"
                      >
                        <h3>Nombre:</h3>
                        <h4>
                          {{ma.nombre}}
                        </h4>
                        <br>
                        <h3>Barcode:</h3>
                        <h4>
                          {{ ma.codigoBarras }}
                        </h4>
                      </v-card-text>
                      <v-divider></v-divider>
                      <div style="height: 50px;">
                        <div >
                          <h1 style="text-align: end; padding-top: 8px; margin-right: 5%;"
                          >
                            Bs. {{ma.precioV}}
                          </h1>
                        </div>
                        <v-expand-transition>
                          <div
                              v-if="hover"
                              class="d-flex transition-fast-in-fast-out darken-2 v-card--reveal  white--text"
                              style="height: 50px;align-items: center;bottom: 0;justify-content: center;position: absolute;width: 100%;background:#9bc220;"
                          >
                            <div style="background: white;">
                              <input
                                  style="width: 40px; border: black solid 2px; border-radius: 5px; text-align: center"
                                  type="number"
                                  value="1"
                                  min="1"
                                  id="cprodma"
                              >
                            </div>
                            <div style="width: 50px;"></div>
                            <v-btn icon dark large @click="agregarma(ma)">
                              <v-icon>
                                mdi-cart-plus
                              </v-icon>
                            </v-btn>

                          </div>
                        </v-expand-transition>
                      </div>
                    </v-card>
                  </v-hover>

                </v-col>
              </aside>
            </section>
          </v-card-text>
        </v-card>

      </v-col>

      <v-col cols="12">
        <v-card>
          <v-card-title>
            <h3 style="margin: auto;">Aproveche las ofertas</h3>
          </v-card-title>
          <v-card-text>
            <section id="main">
              <aside id="horizontal-scroll">
                <v-col v-for="(pm,x) in promo" :key="x">
                  <v-hover v-slot="{ hover }">
                    <v-card
                        color="grey lighten-4"
                        width="250"
                    >
                      <v-img
                          :aspect-ratio="16/9"
                          :src="'https://bonnsupermercados.com/'+pm.imagen"
                      >
                        <v-expand-transition>
                          <div
                              v-if="hover"
                              class="d-flex transition-fast-in-fast-out darken-2 display-3 white--text"
                              style="height: 100%;align-items: center;bottom: 0;justify-content: center;opacity: .7;position: absolute;width: 100%; background: #dedc03;"
                          >
                            <v-btn icon large dark color="black" @click="mostrar(pm)">
                              <v-icon>mdi-eye</v-icon>
                            </v-btn>
                          </div>
                        </v-expand-transition>
                      </v-img>
                      <v-card-text
                          class="pt-6"
                          style="height: 200px; overflow-y: auto;"
                      >
                        <h3>Nombre:</h3>
                        <h4>
                          {{pm.nombre}}
                        </h4>
                        <br>
                        <h3>Descuento:</h3>
                        <h4>
                          {{ pm.descuento }}%
                        </h4>
                        <br>
                        <h3>Barcode:</h3>
                        <h4>
                          {{ pm.codigoBarras }}
                        </h4>
                      </v-card-text>
                      <v-divider></v-divider>
                      <div style="height: 50px;">
                        <div >
                          <h1 style="text-align: end; padding-top: 8px; margin-right: 5%;"
                          >
                            Bs. {{pm.total}}
                          </h1>
                        </div>
                        <v-expand-transition>
                          <div
                              v-if="hover"
                              class="d-flex transition-fast-in-fast-out darken-2 v-card--reveal  white--text"
                              style="height: 50px;align-items: center;bottom: 0;justify-content: center;position: absolute;width: 100%;background:#9bc220;"
                          >
                            <div style="background: white;">
                              <input
                                  style="width: 40px; border: black solid 2px; border-radius: 5px; text-align: center"
                                  type="number"
                                  value="1"
                                  min="1"
                                  id="cprod"
                              >
                            </div>
                            <div style="width: 50px;"></div>
                            <v-btn icon dark large @click="agregar(pm)">
                              <v-icon>
                                mdi-cart-plus
                              </v-icon>
                            </v-btn>

                          </div>
                        </v-expand-transition>
                      </div>
                    </v-card>
                  </v-hover>
                </v-col>
              </aside>
            </section>
          </v-card-text>


        </v-card>


      </v-col>

      <v-col cols="12">

        <v-card>
          <v-card-title>
            <h3 style="margin: auto;">Lo Ultimo En Llegar</h3>
          </v-card-title>

          <v-card-text>
            <section id="main">
              <aside id="horizontal-scroll">
                <v-col v-for="(re,x) in reciente" :key="x">
                  <v-hover v-slot="{ hover }">
                    <v-card
                        color="grey lighten-4"
                        width="250"
                    >
                      <v-img
                          :aspect-ratio="16/9"
                          :src="'https://bonnsupermercados.com/'+re.imagen"
                      >
                        <v-expand-transition>
                          <div
                              v-if="hover"
                              class="d-flex transition-fast-in-fast-out darken-2 display-3 white--text"
                              style="height: 100%;align-items: center;bottom: 0;justify-content: center;opacity: .7;position: absolute;width: 100%; background: #dedc03;"
                          >
                            <v-btn icon large dark color="black" @click="mostrarre(re)">
                              <v-icon>mdi-eye</v-icon>
                            </v-btn>
                          </div>
                        </v-expand-transition>
                      </v-img>
                      <v-card-text
                          class="pt-6"
                          style="height: 200px; overflow-y: auto;"
                      >
                        <h3>Nombre:</h3>
                        <h4>
                          {{re.nombre}}
                        </h4>
                        <br>
                        <h3>Barcode:</h3>
                        <h4>
                          {{ re.codigoBarras }}
                        </h4>
                      </v-card-text>
                      <v-divider></v-divider>
                      <div style="height: 50px;">
                        <div >
                          <h1 style="text-align: end; padding-top: 8px; margin-right: 5%;"
                          >
                            Bs. {{re.precioV}}
                          </h1>
                        </div>
                        <v-expand-transition>
                          <div
                              v-if="hover"
                              class="d-flex transition-fast-in-fast-out darken-2 v-card--reveal  white--text"
                              style="height: 50px;align-items: center;bottom: 0;justify-content: center;position: absolute;width: 100%;background:#9bc220;"
                          >
                            <div style="background: white;">
                              <input
                                  style="width: 40px; border: black solid 2px; border-radius: 5px; text-align: center"
                                  type="number"
                                  value="1"
                                  min="1"
                                  id="cprodre"
                              >
                            </div>
                            <div style="width: 50px;"></div>
                            <v-btn icon dark large @click="agregarre(re)">
                              <v-icon>
                                mdi-cart-plus
                              </v-icon>
                            </v-btn>

                          </div>
                        </v-expand-transition>
                      </div>
                    </v-card>
                  </v-hover>
                </v-col>
              </aside>
            </section>
          </v-card-text>
        </v-card>
      </v-col>
    </div>


    <v-col cols="12">
      <v-row>
        <v-col cols="12" md="6" sm="12">
          <v-carousel
              cycle
              height="auto"
              hide-delimiter-background
              show-arrows-on-hover
          >
            <v-carousel-item
                v-for="(caru, i) in caruU"
                :key="i"
                :src="'https://bonnsupermercados.com/'+caru.img"
            >
            </v-carousel-item>
          </v-carousel>
        </v-col>
        <v-col cols="12" md="6" sm="12">
          <v-carousel
              cycle
              height="auto"
              hide-delimiter-background
              show-arrows-on-hover
          >
            <v-carousel-item
                v-for="(caru, i) in caruD"
                :key="i"
                :src="'https://bonnsupermercados.com/'+caru.img"

            >
            </v-carousel-item>
          </v-carousel>
        </v-col>
      </v-row>
    </v-col>

    <v-col cols="12">
      <v-card>

        <v-card-text>
          <v-row>
            <v-col cols="6" md="4" sm="6">
              <v-container @click="$router.push('/market/ConoceBonns')" class="hov">
                <v-avatar color="orange" size="70">
                  <v-icon dark size="40">
                    mdi-magnify
                  </v-icon>
                </v-avatar>
                <br><br>
                <h3>Conoce Sobre Bonn</h3><br>
              </v-container>
            </v-col>
            <v-col cols="6" md="4" sm="6">
              <v-container @click="$router.push('/market/FormasPago')" class="hov">
                <v-avatar color="red" size="70">
                  <v-icon dark size="40">
                    mdi-cash-multiple
                  </v-icon>
                </v-avatar>
                <br><br>
                <h3>Formas de Pago</h3><br>
              </v-container>
            </v-col>
            <v-col cols="6" md="4" sm="6">
              <v-container @click="$router.push('/market/ComohacerCompra')" class="hov">
                <v-avatar color="green" size="70">
                  <v-icon dark size="40" >
                    mdi-cart-arrow-right
                  </v-icon>
                </v-avatar>
                <br><br>
                <h3>Como Hacer mi Compra</h3><br>
              </v-container>
            </v-col>
            <v-col cols="6" md="4" sm="6" >
              <v-container @click="$router.push('/market/NuestroServicio')" class="hov">
                <v-avatar color="blue" size="70">
                  <v-icon dark size="40">
                    mdi-shopping
                  </v-icon>
                </v-avatar>
                <br><br>
                <h3>Nuestros Servicios</h3><br>
              </v-container>
            </v-col>
            <v-col cols="6" md="4" sm="6" >
              <v-container @click="$router.push('/market/PreguntasFrecuentes')" class="hov">
                <v-avatar color="brown" size="70">
                  <v-icon dark size="40">
                    mdi-account-question-outline
                  </v-icon>
                </v-avatar>
                <br><br>
                <h3>Preguntas Frecuentes</h3><br>
              </v-container>
            </v-col>
            <v-col cols="6" md="4"  >
              <v-container @click="$router.push('/market/Cobertura')" class="hov">
                <v-avatar color="black" size="70">
                  <v-icon dark size="40">
                    mdi-map-search-outline
                  </v-icon>
                </v-avatar>
                <br><br>
                <h3>Zonas de Cobertura</h3><br>
              </v-container>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-col>


    <v-dialog
        v-model="previewma"
        persistent
        width="600"
    >
      <v-card>
        <v-card-title>
          <h3>{{predatma.nombre}}</h3>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text style="max-height: 60vh; overflow-y: auto">
          <v-row>
            <v-col cols="6">
              <v-img :src="'https://bonnsupermercados.com/'+predatma.imagen" :aspect-ratio="9/9"> <!--:aspect-ratio="16/9"-->
              </v-img>
            </v-col>
            <v-col cols="6">

              <h3>Precio:</h3>
              <h4>{{predatma.precioV}} Bs.</h4><br>
              <h3>Distribuidor:</h3>
              <h4>{{predatma.empresa}}</h4><br>
              <h3>Descripcion:</h3>
              <h4>{{predatma.descripcion}}</h4><br>
              <h3>Barcode: </h3>
              <h4>{{predatma.codigoBarras}}</h4><br>

            </v-col>
          </v-row>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions
            class=""
            style="align-items: center;justify-content: center;width: 100%;"
        >
          <v-spacer></v-spacer>

          <div style="background: white;">

            <input
                style="width: 70px; border: black solid 2px; border-radius: 5px; text-align: center"
                type="number"
                :value="1"
                min="1"
                id="cprod2ma"
            >
          </div>
          <div style="width: 50px;"></div>
          <v-btn x-large icon dark color="success" @click="agregar2ma(predatma)">
            <v-icon>mdi-cart-plus</v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn text color="error" @click="previewma=false">
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>

    </v-dialog>

    <v-dialog
        v-model="preview"
        persistent
        width="600"
    >
      <v-card>
        <v-card-title>
          <h3>{{predat.nombre}}</h3>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text style="max-height: 60vh; overflow-y: auto">
          <v-row>
            <v-col cols="6">
              <v-img :src="'https://bonnsupermercados.com/'+predat.imagen" :aspect-ratio="9/9"> <!--:aspect-ratio="16/9"-->
              </v-img>
            </v-col>
            <v-col cols="6">
              <h3>Precio antes:</h3>
              <h4>{{predat.precio}} Bs.</h4><br>
              <h3>Descuento:</h3>
              <h4>{{ predat.descuento }}%</h4><br>
              <h3>Precio ahora:</h3>
              <h4>{{ predat.total }} Bs.</h4><br>
              <h3>Distribuidor:</h3>
              <h4>{{predat.empresa}}</h4><br>
              <h3>Descripcion:</h3>
              <h4>{{predat.descripcion}}</h4><br>
              <h3>Barcode: </h3>
              <h4>{{predat.codigoBarras}}</h4><br>


            </v-col>
          </v-row>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions
            class=""
            style="align-items: center;justify-content: center;width: 100%;"
        >
          <v-spacer></v-spacer>

          <div style="background: white;">

            <input
                style="width: 70px; border: black solid 2px; border-radius: 5px; text-align: center"
                type="number"
                :value="1"
                min="1"
                id="cprod2"
            >
          </div>
          <div style="width: 50px;"></div>
          <v-btn x-large icon dark color="success" @click="agregar2(predat)">
            <v-icon>mdi-cart-plus</v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn text color="error" @click="preview=false">
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>

    </v-dialog>

    <v-dialog
        v-model="previewre"
        persistent
        width="600"
    >
      <v-card>
        <v-card-title>
          <h3>{{predatre.nombre}}</h3>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text style="max-height: 60vh; overflow-y: auto">
          <v-row>
            <v-col cols="6">
              <v-img :src="'https://bonnsupermercados.com/'+predatre.imagen" :aspect-ratio="9/9"> <!--:aspect-ratio="16/9"-->
              </v-img>
            </v-col>
            <v-col cols="6">

              <h3>Precio:</h3>
              <h4>{{predatre.precioV}} Bs.</h4><br>
              <h3>Distribuidor:</h3>
              <h4>{{predatre.empresa}}</h4><br>
              <h3>Descripcion:</h3>
              <h4>{{predatre.descripcion}}</h4><br>
              <h3>Barcode: </h3>
              <h4>{{predatre.codigoBarras}}</h4><br>

            </v-col>
          </v-row>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions
            class=""
            style="align-items: center;justify-content: center;width: 100%;"
        >
          <v-spacer></v-spacer>

          <div style="background: white;">

            <input
                style="width: 70px; border: black solid 2px; border-radius: 5px; text-align: center"
                type="number"
                :value="1"
                min="1"
                id="cprod2re"
            >
          </div>
          <div style="width: 50px;"></div>
          <v-btn x-large icon dark color="success" @click="agregar2re(predatre)">
            <v-icon>mdi-cart-plus</v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn text color="error" @click="previewre=false">
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>

    </v-dialog>


    <v-snackbar
        v-model="snack"
        color="error"
    >
      <h3><v-icon>mdi-alert</v-icon> Ya tiene este producto en su carrito </h3>
    </v-snackbar>

  </div>
</template>

<script>

import axios from "axios";



export default {
  components:{
  },
  name: "inicio",
  data: ()=> ({
    slides: [
      'First',
      'Second',
      'Third',
      'Fourth',
      'Fifth',
    ],
    items: [
      { title: 'Click Me' },
      { title: 'Click Me' },
      { title: 'Click Me' },
      { title: 'Click Me 2' },
    ],
    cat:[
      {t:'bebes'},
      {t:'bebidas'},
      {t:'despensa'},
      {t:'farmacia'},
      {t:'higiene'},
      {t:'kiosco bonn'},
      {t:'libreria'},
      {t:'limpieza'},
      {t:'mascotas'},
      {t:'mercado'},
      {t:'navidad'},
      {t:'ofertas y promociones'},
    ],
    promo:[],
    snack:false,
    detallesprod:[],
    preview:false,
    predat:[],
    masvend:[],
    previewma:false,
    predatma:[],
    reciente:[],
    previewre:false,
    predatre:[],
    caruO:[],
    caruU:[],
    caruD:[],
  }),
  mounted() {
    axios.get('carrusel.php?type=caruo'
    ).then((r)=>{
      this.caruO=r.data
    })
    axios.get('carrusel.php?type=caruu'
    ).then((r)=>{
      this.caruU=r.data
    })
    axios.get('carrusel.php?type=carud'
    ).then((r)=>{
      this.caruD=r.data
    })
    axios.get('cliprod.php?type=prom'
    ).then((r)=>{
      this.promo=r.data
    })
    axios.get('cliini.php?type=masven'
    ).then((r)=>{
      this.masvend=r.data
    })
    axios.get('cliini.php?type=reciente'
    ).then((r)=>{
      this.reciente=r.data
    })
    if (localStorage.getItem('prodetalles')) {
      try {
        this.detallesprod = JSON.parse(localStorage.getItem('prodetalles'));
      } catch(e) {
        localStorage.removeItem('prodetalles');
      }
    }
    this.valores()
  },
  methods:{
    isMobile() {
      if(
          /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
              navigator.userAgent
          )
      ) {
        return true;
      } else {
        return false;
      }
    },
    p(){
    },
    agregar(c){
      let cantidad =document.getElementById('cprod').value
      let tot = cantidad* c.total
      if (this.detallesprod.find(file => file.id === c.id && file.type==='promo')==undefined){
        this.detallesprod.push({
          id:c.id,
          nombre:c.nombre,
          codigo:c.codigoBarras,
          precio:c.total,
          cantidad:cantidad,
          total:tot,
          img:c.imagen,
          type:'promo',
        });
        this.savePro();
      }else{
        this.snack=true
      }
    },
    agregar2(c){
      let cantidad =document.getElementById('cprod2').value
      let tot = cantidad* c.total
      if (this.detallesprod.find(file => file.id === c.id && file.type==='promo')==undefined){
        this.detallesprod.push({
          id:c.id,
          nombre:c.nombre,
          codigo:c.codigoBarras,
          precio:c.total,
          cantidad:cantidad,
          total:tot,
          img:c.imagen,
          type:'promo',
        });
        this.savePro();
      }else{
        this.snack=true
      }
    },
    agregarma(c){
      let cantidad =document.getElementById('cprodma').value
      let tot = cantidad* c.precioV
      if (this.detallesprod.find(file => file.id === c.id && file.type==='normal')==undefined ){
        this.detallesprod.push({
          id:c.id,
          nombre:c.nombre,
          codigo:c.codigoBarras,
          precio:c.precioV,
          cantidad:cantidad,
          total:tot,
          img:c.imagen,
          type:'normal',
        });
        this.savePro();
      }else{
        this.snack=true
      }
    },
    agregar2ma(c){
      let cantidad =document.getElementById('cprod2ma').value
      let tot = cantidad* c.precioV
      if (this.detallesprod.find(file => file.id === c.id && file.type==='normal')==undefined ){
        this.detallesprod.push({
          id:c.id,
          nombre:c.nombre,
          codigo:c.codigoBarras,
          precio:c.precioV,
          cantidad:cantidad,
          total:tot,
          img:c.imagen,
          type:'normal',
        });
        this.savePro();
      }else{
        this.snack=true
      }
    },
    agregarre(c){
      let cantidad =document.getElementById('cprodre').value
      let tot = cantidad* c.precioV
      if (this.detallesprod.find(file => file.id === c.id && file.type==='normal')==undefined ){
        this.detallesprod.push({
          id:c.id,
          nombre:c.nombre,
          codigo:c.codigoBarras,
          precio:c.precioV,
          cantidad:cantidad,
          total:tot,
          img:c.imagen,
          type:'normal',
        });
        this.savePro();
      }else{
        this.snack=true
      }
    },
    agregar2re(c){
      let cantidad =document.getElementById('cprod2re').value
      let tot = cantidad* c.precioV
      if (this.detallesprod.find(file => file.id === c.id && file.type==='normal')==undefined ){
        this.detallesprod.push({
          id:c.id,
          nombre:c.nombre,
          codigo:c.codigoBarras,
          precio:c.precioV,
          cantidad:cantidad,
          total:tot,
          img:c.imagen,
          type:'normal',
        });
        this.savePro();
      }else{
        this.snack=true
      }
    },
    savePro() {
      const parsed = JSON.stringify(this.detallesprod);
      localStorage.setItem('prodetalles', parsed);
      this.valores()
    },
    mostrar(e){
      this.preview=true
      this.predat=e
    },
    mostrarma(e){
      this.previewma=true
      this.predatma=e
    },
    mostrarre(e){
      this.previewre=true
      this.predatre=e
    },
    valores(){
      let p =this.detallesprod
      let i = 0
      let sub=0
      let can=0
      while (i<p.length){
        sub=sub + p[i].total
        can=can + parseInt(p[i].cantidad)
        i++
      }
      this.$store.state.cantidad=can
      this.$store.state.precio=sub
    }
  },


}
//https://www.ingenieroperales.com/como-crear-un-contenedor-con-scroll-horizontal/
//para hacer scroll horizontal
</script>

<style scoped>
.hov{
  text-align: center;
  border-radius: 20px;
  color: black;
}
.hov:hover{
  cursor: pointer;
  background-color:#424242;
  color: whitesmoke;
}
#main {
  overflow-x:scroll;
  width:100%;
}
#horizontal-scroll {
  display : inline-flex;
  padding:1px;
}
.item {
  border:1px solid black;
  margin: 0px 10px;
  min-width:150px;
  min-height:113px;
  padding: 0px;
}

</style>
