<template>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Administrador de Usuarios</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Principal</a></li>
                            <li class="breadcrumb-item active">Administrador de Usuarios</li>
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


                            <b-button  v-b-modal.modal @click="modal(1,'users','')" size="sm" variant="primary"><i class="fas fa-plus"></i> Crear Usuario</b-button>


                            <div >

                                <b-modal ref="modalUserUpdate" id="modalUserUpdate"
                                         size="lg"

                                         :header-bg-variant="headerBgVariant"
                                         :header-text-variant="headerTextVariant"
                                         @ok="UpdateUser()"
                                >
                                    <template v-slot:modal-title>
                                        <span class="fas fa-cogs"></span> Editar Usuario {{nameUpdate}}
                                    </template>


                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Nombre:</label>
                                        <input type="text" class="form-control"  v-model="nameUpdate" >
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Correo Electronico:</label>
                                        <input type="email" class="form-control"  v-model="emailUpdate" >
                                    </div>

                                    <div class="form-group">
                                        <label for="pass" class="col-form-label">Nueva Contraseña:</label>
                                        <div class="input-group mb-3">
                                            <input :type="passwordFieldType" class="form-control"  v-model="passwordUpdate">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button"  @click="switchVisibility()">Mostrar/Ocultar</button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group" v-if="roleUpdate==='User'">
                                        <label for="supervisorUpdate" class="col-form-label">Re asign Supervisor:</label>
                                        <select name="supervisor" id="supervisorUpdate" v-model="supervisorUpdate" class="form-control">
                                            <option value="0" disabled>Select a role</option>
                                            <option v-for="supervisor in supervisores" :key="supervisor.id" :value="supervisor.id" >{{ supervisor.name }}</option>



                                        </select>
                                    </div>



                                </b-modal>


                                <!--Modal-crear-->
                                <b-modal id="modal" size="lg"  ref="modal" @ok="enviar()">
                                    <template v-slot:modal-title>
                                        {{modal_text}}
                                    </template>
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Nombre:</label>
                                        <input type="text" class="form-control" id="name" v-model="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Correo Electronico:</label>
                                        <input type="email" class="form-control" id="email" v-model="email">
                                    </div>

                                    <div class="form-group">
                                        <label for="pass" class="col-form-label">Contraseña:</label>
                                        <div class="input-group mb-3">
                                            <input :type="passwordFieldType" class="form-control" id="pass" v-model="password">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="button-addon2" @click="switchVisibility()">Mostrar/Ocultar</button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="rol" class="col-form-label">Rol:</label>
                                        <select name="rol" id="rol" v-model="rol" class="form-control">
                                            <option value="0" disabled>Seleccione un Rol</option>
                                            <option v-for="role in arrayrole" :key="role.id" :value="role.id" >{{ role.name }}</option>



                                        </select>
                                    </div>



                                </b-modal>
                                <!--/. Modal-crear-->

                            </div>



                        </div>
                        <div class="card-body">
                            <v-client-table :columns="columns" :data="array" :options="options">
                                <!--                                <div slot="status" slot-scope="props">-->
                                <!--                                    <div v-if="props.row.active==1">-->
                                <!--                                        <span class="badge badge-success">Enabled</span>-->
                                <!--                                    </div>-->
                                <!--                                    <div v-else>-->
                                <!--                                        <span class="badge badge-danger">Disabled</span>-->
                                <!--                                    </div>-->

                                <!--                                </div>-->

                                <div slot="options" slot-scope="props">
                                    <b-button-group size="sm">


                                        <b-button  @click="selectUpdateUser(props.row.id)"  size="sm" variant="primary" ><i class="fas fa-pen-alt"></i></b-button>
                                        <b-button  @click="eliminar(props.row.id)"  size="sm" variant="danger" ><i class="fas fa-trash"></i></b-button>





                                    </b-button-group>

                                </div>

                                <div slot="created_at" slot-scope="props">
                                    {{new Date(props.row.created_at).toLocaleString()}}
                                </div>

                                <div slot="rol" slot-scope="props">
                                    {{props.row.roles[0].name}}
                                </div>


                            </v-client-table>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->


</template>

<script>
    export default {

        data(){
            return{
                //variables globales
                name:'',
                email:'',
                password:'',
                nameUpdate:'',
                emailUpdate:'',
                passwordUpdate:'',
                supervisorUpdate:0,
                roleUpdate:'',
                user_id:0,
                rol:0,
                supervisor:0,
                csrfToken:'',
                modal_text:'',
                array:[],
                arrayrole:[],
                supervisores:[],
                tipo:0,
                role_s:'',
                headerBgVariant:'primary',
                headerTextVariant:'light',
                columns:['name','email','rol','created_at','options'],
                options:{
                    skin:'table-striped table-bordered table-hover table-sm',
                    columnsDropdown:true,
                    perPage:10,
                    perPageValues:[5,10,15,20,-1],
                    headings:{
                        name:'Nombre',
                        email:'Correo Electronico',
                        rol:'Rol',
                        created_at:'Fecha de Creación',
                        options:'Opciones'
                    },
                    sortable:['name','email','rol'],
                    filterable:['name','email','rol'],

                },
                passwordFieldType: 'password'

            }
        },
        methods : {

            listar(){

                let me=this;
                var url= '/users';
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


            role(){

                let me=this;
                var url= '/user/getrole';
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        var respuesta= response.data;
                        me.role_s = respuesta;

                        if(me.rol==='Admin'){
                            this.listarRoles();

                        }

                    })
                    .catch(function (error) {

                        console.log(error);
                    })

            },


            listarRoles(){

                let me=this;
                var url= '/listarroles';
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        var respuesta= response.data;
                        me.arrayrole = respuesta;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })

            },
            enviar(){
                switch (this.tipo) {
                    case 1:
                        let me=this;
                        if (this.rol!==2){
                            this.supervisor=0;
                        }
                        axios.post('/users',{
                            'name':this.name,
                            'email':this.email,
                            'rol':this.rol,
                            'password':this.password,
                            '_token':this.csrfToken,

                        })
                            .then(function (response) {
                                // handle success
                                me.listar();

                            })
                            .catch(function (error) {

                                console.log(error);
                            })
                        break;
                }
            },
            eliminar(row){


                let me=this;
                this.$bvModal.msgBoxConfirm('Do you want to delete this user?')
                    .then(value => {
                        if(value){
                            axios.delete('/users/'+row,{
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
                        this.modal_text='Crear Usuario';
                        this.name='';
                        this.email='';
                        this.password='';
                        this.rol=0;
                        this.tipo=1;
                        break;
                    case 2:
                        this.modal_text='Update API';
                        this.name=data['name'];
                        this.api_key=data['api_key'];
                        this.n_scan=data['n_scan'];
                        this.server=data['server'];
                        this.tipo=2;
                        break;
                }
            },
            switchVisibility() {
                this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password'
            },
            selectUpdateUser(id){
                let me=this;
                axios.post('/user/select',{
                    'id':id,
                    '_token':this.csrfToken
                })
                    .then(function (response) {
                        // handle success
                        me.nameUpdate=response.data.name;
                        me.emailUpdate=response.data.email;
                        me.passwordUpdate='';
                        me.user_id=response.data.id;


                        me.$refs['modalUserUpdate'].show()

                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },
            UpdateUser(){
                let me=this;
                axios.post('/user/updateUser',{
                    'name':this.nameUpdate,
                    'email':this.emailUpdate,
                    'password':this.passwordUpdate,
                    'id':this.user_id,
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
            this.role();
            this.listar();
            this.listarRoles();

            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content





        }
    }
</script>
