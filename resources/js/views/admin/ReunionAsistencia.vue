<template>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <b-button v-b-modal.modal @click="back()" size="sm" variant="success"><i class="fas fa-backward"></i> Atras</b-button>
                        <h1 class="m-0 text-dark">Reunion Asistencia: {{reunion.nombre}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Principal</a></li>
                            <li class="breadcrumb-item active">Reunion Asistencia: {{reunion.nombre}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                            <b-button v-b-modal.modal @click="modal(1,'Reunion Asistencia','')" size="sm" variant="primary">
                                <i class="fas fa-plus"></i> Crear Asistencia
                            </b-button>


                        </div>
                        <div class="card-body">
                            <v-client-table :columns="columns" :data="array" :options="options" >

                                <div slot="estado" slot-scope="props">
                                    <div v-if="props.row.estado">
                                        <b-badge variant="success" >Activo</b-badge>
                                    </div>
                                    <div v-else>
                                        <b-badge variant="danger" >Desactivado</b-badge>
                                    </div>
                                </div>

                                <div slot="created_at" slot-scope="props">
                                    {{new Date(props.row.created_at).toLocaleString()}}
                                </div>

                                <div slot="updated_at" slot-scope="props">
                                    {{new Date(props.row.updated_at).toLocaleString()}}
                                </div>


                                <div slot="options" slot-scope="props">

                                    <b-button @click="eliminar(props.row.id)"
                                              size="sm" variant="danger" >
                                        <i class="fas fa-trash"></i>
                                    </b-button>
                                </div>


                            </v-client-table>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.content -->
        <!--Modal-crear-->
        <b-modal id="modal" size="lg"  ref="modal" @ok="enviar()">
            <template v-slot:modal-title>
                {{modal_text}}
            </template>
            <div class="form-group">
                <label class="col-form-label" for="identificacion">Identificacion:</label>
                <input type="text" class="form-control" id="identificacion" v-model="identificacion" >
                <button class="btn btn-success" @click="getPersona()"><i class="fas fa-search"></i> Buscar</button>
            </div>
            <table class="table" v-if="persona.id != null">
                <tr>
                    <td><b>Nombre y Apellido:</b></td>
                    <td>{{persona.nombre_apellido}}</td>
                </tr>
            </table>
            <div v-if="persona.id == null && buscarPersona">
                <h5>No existe la Persona!</h5>
                <router-link :to="{name:'personas-create'}">
                    <b-button size="sm" variant="primary" ><i class="fas fa-plus"></i> Crear Persona</b-button>
                </router-link>
            </div>
        </b-modal>
        <!--/. Modal-crear-->
    </div>
    <!-- /.content-wrapper -->


</template>

<script>
import Swal from 'sweetalert2'
    export default {
        props:['id'],
        data(){
            return{
                //variables globales
                identificacion:'',
                id:0,
                modal_text:'',
                array:[],
                tipo:0,
                csrfToken:'',
                columns:['number','cedula','nombre_apellido','options'],

                options:{
                    skin:'table-striped table-bordered table-hover table-sm',
                    columnsDropdown:true,
                    perPage:10,
                    perPageValues:[5,10,15,20],
                    columnsClasses:{
                        'key':'mod'
                    },
                    headings:{
                        number:'#',
                        cedula:'Cedula',
                        nombre_apellido:'Apellido y Nombre',
                        options:'Opciones'
                    },
                    sortable:['number','cedula','nombre_apellido'],
                    filterable:['number','cedula','nombre_apellido'],

                },
                buscarPersona: false,
                reunion : [],
                persona: [],

            }
        },
        methods : {

            getReunion(){
                let me=this;
                var url= '/admin/reuniones/'+this.id;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        var respuesta= response.data;
                        me.reunion = respuesta;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })

            },

            getPersona(){
                let me=this;
                var url= '/admin/reuniones-personas/'+this.identificacion;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        me.buscarPersona = true;
                        var respuesta= response.data;
                        me.persona = respuesta;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })

            },

            listar(){

                let me=this;
                var url= '/admin/reuniones-asistencia/personas/'+me.id;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        var respuesta= response.data;
                        me.array = respuesta;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })

            },

            enviar(){

                let me=this;
                if(this.persona.id != null){
                    axios.post('/admin/reuniones-asistencia/create',{
                    'persona_id':this.persona.id,
                    'reunion_id':this.id,
                    '_token':this.csrfToken
                })
                    .then(function (response) {
                        // handle success
                        me.listar();
                        Swal.fire('Hecho!','Se Creo la Asistencia','success')
                    })
                    .catch(function (error) {
                        Swal.fire('Error!',error.response.data.message,'error')
                    })
                }else{
                    Swal.fire('Error!','Usuario No encontrado!','error')
                }

            },

            eliminar(row){


                let me=this;
                this.$bvModal.msgBoxConfirm('Deseas Eliminar la Asistencia?')
                    .then(value => {
                        if(value){
                            axios.delete('/admin/reuniones-asistencia/personas/'+row,{
                                'id':row,
                                '_token':this.csrfToken
                            })
                                .then(function (response) {
                                    // handle success
                                    me.listar();
                                })
                                .catch(function (error) {
                                    console.log(error);
                                })
                        }
                    })
                    .catch(err => {
                        // An error occurred
                    })


            },

            modal(caso,modelo,data=[]){
                switch (caso) {
                    case 1:
                        this.modal_text='Crear Asistencia';
                        this.tipo=1;
                        this.nombre='';

                        break;
                    case 2:
                        this.modal_text='Editar Asistencia';
                        this.nombre=data['nombre'];
                        this.id=data['id'];

                        this.tipo=2;
                        break;
                }
            },

            back(){
                return this.$router.go(-1);
            }


        },
        mounted() {
            this.listar();
            this.getReunion();

            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content

        }
    }
</script>

<style>
    .mod{
        width: 400px;
    }
    .custom-checkbox.b-custom-control-sm, .input-group-sm .custom-checkbox {

        width: 30%;
    }

    .VueTables__columns-dropdown{
        padding-top: 24px;
        padding-right: 16px;
    }
</style>
