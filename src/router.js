import Vue from 'vue';

import Router from 'vue-router';

    //clientes

//import coo from './components/storage'
import logcli from './cliente/index'
import dashcli from './cliente/dash'
import inicli from './cliente/inicio'
import prodcli from './cliente/productos'
import pedcli from './cliente/pedido'
import pagocli from './cliente/pago'

    //admin

import logadmin from './admin/index'
import iniadmin from './admin/inicio'
import repoadmin from './admin/reportes'
import usersadmin from './admin/users'
import cliadmin from './admin/clientes'
import prodadmin from './admin/productos'
import catadmin from './admin/categorias'
import pedadmin from './admin/pedidos'
import proadmin from './admin/promocion'
import carrusel from "./admin/carrusel";
import Conoce from "./cliente/Conoce";
import Formas from "./cliente/Formas";
import Como from "./cliente/Como";
import Nuestro from "./cliente/Nuestro";
import preguntas from "./cliente/preguntas";
import cobertura from "./cliente/cobertura";
import Politica from "./cliente/Politica";
import Terminos from "./cliente/Terminos";

    //delevery


Vue.use(Router);

export default new Router({
    mode:'history',
    base: __dirname,
    //base: process.env.BASE_URL,
    routes: [
            //clientes

        {
            path: "/",
            component: logcli,
        },
        {
            path: '/market/:id',
            name:'market',
            component: dashcli,
            children: [
                {
                    path: "/market/inicio",
                    component: inicli
                },
                {
                    path: "/market/productos/:prod",
                    name:'productoscli',
                    component: prodcli
                },
                {
                    path: "/market/pedido",
                    component: pedcli
                },
                {
                    path:"/market/pago",
                    component: pagocli
                },
                {
                    path:"/market/ConoceBonns",
                    component: Conoce
                },
                {
                    path:"/market/FormasPago",
                    component: Formas
                },
                {
                    path:"/market/ComohacerCompra",
                    component: Como
                },
                {
                    path:"/market/NuestroServicio",
                    component: Nuestro
                },
                {
                    path:"/market/PreguntasFrecuentes",
                    component: preguntas
                },
                {
                    path:"/market/Cobertura",
                    component: cobertura
                },
                {
                    path:"/market/Terminos",
                    component: Terminos
                },
                {
                    path:"/market/Politica",
                    component: Politica
                },
            ]
        },
        {
            path:"/politica",
            component: Politica
        },
        {
            path:"/Terminos",
            component: Terminos
        },


            //admin

        {
            path: "/admin",
            component: logadmin
        },
        {
            path:"/administrador/:id",
            name:'dashboards',
            component: iniadmin,
            children:[
                {
                    path: "/admin/reportes",
                    component: repoadmin
                },
                {
                    path: '/admin/users',
                    component: usersadmin,
                },
                {
                    path:"/admin/clientes",
                    component: cliadmin
                },
                {
                    path:'/admin/productos',
                    component: prodadmin
                },
                {
                    path: "/admin/categorias",
                    component: catadmin
                },
                {
                    path: "/admin/pedidos",
                    component: pedadmin
                },
                {
                    path: "/admin/promocion",
                    component: proadmin
                },
                {
                    path: "/admin/carrusel",
                    component: carrusel
                },
            ]
        }
    ]
})
