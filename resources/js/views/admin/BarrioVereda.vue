<template>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Barrio o Vereda</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Principal</a></li>
                            <li class="breadcrumb-item active">Barrio o Vereda</li>
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

                            <b-button v-b-modal.modal @click="modal(1,'Barrio o Vereda','')" size="sm" variant="primary">
                                <i class="fas fa-plus"></i> Crear Barrio o Vereda
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
                                    <b-button v-b-modal.modal @click="modal(2,'Barrio o Vereda',props.row)"
                                              
                                              size="sm" variant="warning" >
                                        <i class="fas fa-pen"></i>
                                    </b-button>

                                    <b-button @click="eliminar(props.row.id)"
                                              
                                              size="sm" variant="danger" >
                                        <i class="fas fa-trash"></i>
                                    </b-button>

                                    <b-button @click="estado(props.row.id)"
                                              
                                              size="sm" variant="primary" >
                                        <i class="fas fa-undo"></i>
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
                <label class="col-form-label" for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" v-model="nombre" >
            </div>

        </b-modal>
        <!--/. Modal-crear-->
    </div>
    <!-- /.content-wrapper -->


</template>

<script>
    export default {

        data(){
            return{
                //variables globales
                nombre:'',
                id:0,
                modal_text:'',
                array:[],
                tipo:0,
                csrfToken:'',
                columns:['number','nombre','estado','created_at','updated_at','options'],

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
                        nombre:'Nombre',
                        estado:'Estado',
                        created_at:'created_at',
                        updated_at:'updated_at',
                        options:'Opciones'
                    },
                    sortable:['number','nombre','estado','created_at','updated_at'],
                    filterable:['number','nombre','estado','created_at','updated_at'],

                }

            }
        },
        methods : {

            listar(){

                let me=this;
                var url= '/barrioVereda';
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
                switch (this.tipo) {
                    case 1:
                        axios.post('/barrioVereda',{
                            'nombre':this.nombre,
                            '_token':this.csrfToken
                        })
                            .then(function (response) {
                                // handle success
                                me.listar();
                                me.nombre='';
                            })
                            .catch(function (error) {

                                console.log(error);
                            })
                        break;

                    case 2:
                        axios.put('/barrioVereda/'+this.id,{
                            'nombre':this.nombre,
                            '_token':this.csrfToken
                        })
                            .then(function (response) {
                                // handle success
                                me.listar();

                            })
                            .catch(function (error) {

                                console.log(error);
                            });
                        break;
                }
            },

            eliminar(row){


                let me=this;
                this.$bvModal.msgBoxConfirm('Deseas Eliminar la Dependencia?')
                    .then(value => {
                        if(value){
                            axios.delete('/barrioVereda/'+row,{
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
                        this.modal_text='Crear Dependencia';
                        this.tipo=1;
                        this.nombre='';

                        break;
                    case 2:
                        this.modal_text='Editar Dependencia';
                        this.nombre=data['nombre'];
                        this.id=data['id'];

                        this.tipo=2;
                        break;
                }
            },

            estado(id){
                let me=this;
                axios.post('/barrioVereda/estado',{
                    'id':id,
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


        },
        mounted() {
            this.listar();

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
