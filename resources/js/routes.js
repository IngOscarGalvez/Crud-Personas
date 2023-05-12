import Vue from 'vue'
import Router from 'vue-router'
import excel from 'vue-excel-export'



// vistas de Administrador
import Users from "./views/admin/Users";
import Dependencias from "./views/admin/Dependencias";
import Personas from "./views/admin/Personas";
import PersonasCreate from "./views/admin/PersonasCreate";
import PersonasUpdate from "./views/admin/PersonasUpdate";
import BarrioVereda from "./views/admin/BarrioVereda";
import Vehiculo from "./views/admin/Vehiculo";
import PuestoVotacion from "./views/admin/PuestoVotacion";
import Candidato from "./views/admin/Candidato";
import Responsable from "./views/admin/Responsable";
import Reunion from "./views/admin/Reunion";
import ReunionAsistencia from "./views/admin/ReunionAsistencia";
import personasCumple from "./views/admin/personasCumple";

Vue.use(Router)
Vue.use(excel)

export default new Router({
    routes: [

        // Routes Admin
        {
            path: '/admin/dependencias',
            name: 'dependencias',
            component: Dependencias
        },
        {
            path: '/admin/barrioVereda',
            name: 'barrioVereda',
            component: BarrioVereda
        },
        {
            path: '/admin/vehiculo',
            name: 'vehiculo',
            component: Vehiculo
        },
        {
            path: '/admin/puestoVotacion',
            name: 'puestoVotacion',
            component: PuestoVotacion
        },
        {
            path: '/admin/candidato',
            name: 'candidato',
            component: Candidato
        },
        {
            path: '/admin/personas',
            name: 'personas',
            component: Personas
        },
        {
            path: '/admin/personas/cumple',
            name: 'personasCumple',
            component: personasCumple
        },

        {
            path: '/admin/responsable',
            name: 'responsable',
            component: Responsable
        },

        {
            path: '/admin/personas/create',
            name: 'personas-create',
            component: PersonasCreate
        },
        {
            path: '/admin/personas/edit/:id',
            name: 'personas-edit',
            component: PersonasUpdate,
            props: true
        },

        {
            path: '/admin/users',
            name: 'users',
            component: Users
        },

        {
            path: '/admin/reuniones',
            name: 'reuniones',
            component: Reunion
        },
        {
            path: '/admin/reuniones/asistencia/:id',
            name: 'reunion-asistencia',
            component: ReunionAsistencia,
            props: true
        },


        //Usuarios


    ],
    mode: 'history',

})
