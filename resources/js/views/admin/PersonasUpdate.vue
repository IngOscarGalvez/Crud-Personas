<template>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <b-button v-b-modal.modal @click="back()" size="sm" variant="success"><i class="fas fa-backward"></i> Atras</b-button>
                        <h1 class="m-0 text-dark">Editar Persona</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Principal</a></li>
                            <li class="breadcrumb-item active">Editar Persona</li>
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
                        <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card ">
                                                    <div class="card-header text-white bg-danger mb-3">
                                                      <h4>Foto de Perfil</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <center><img :src=form.foto_perfil class="rounded-circle img-thumbnail foto_perfil" alt=""></center>
                                                        <form @submit.prevent="subirFoto">
                                                            <input type="file" class="form-control" ref="fileInput">
                                                            <br>
                                                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-file-upload"></i> Subir foto</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card ">
                                            <div class="card-header text-white bg-primary mb-3">
                                                <h4>Datos Personales</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="nombre_apellido">Apellido y Nombre</label>
                                                        <input type="text" class="form-control" id="nombre_apellido" v-model="form.nombre_apellido" disabled>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="cedula">Cedula</label>
                                                        <input type="number" class="form-control" id="cedula" v-model="form.cedula" disabled>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="celular_1">Celular 1</label>
                                                        <input type="number" class="form-control" id="celular_1" v-model="form.celular_1">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="celular_2">Celular 2</label>
                                                        <input type="number" class="form-control" id="celular_2" v-model="form.celular_2">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="fecha_nacimiento">Fecha Nacimiento</label>
                                                        <input type="date" class="form-control" id="fecha_nacimiento" v-model="form.fecha_nacimiento">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" v-model="form.email">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="profesion">Profesion</label>
                                                        <input type="text" class="form-control" id="profesion" v-model="form.profesion">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="card ">
                                            <div class="card-header text-white bg-success mb-3">
                                              <h4>Ubicacion</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="departamento">Departamento</label>
                                                        <vue-tags-input
                                                            v-model="form.departamento"
                                                            :tags="departamentoTags"
                                                            :readonly="departamentoTags.length >= 1"
                                                            :autocomplete-items="listDepartamentos"
                                                            :add-only-from-autocomplete="true"
                                                            @tags-changed="updateDepartamento"
                                                            :max-tags=1
                                                        />
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="municipio">Municipio</label>
                                                        <vue-tags-input
                                                            v-model="form.municipio"
                                                            :tags="municipioTags"
                                                            :readonly="municipioTags.length >= 1"
                                                            :autocomplete-items="listmunicipios"
                                                            :add-only-from-autocomplete="true"
                                                            @tags-changed="updateMunicipio"
                                                            :max-tags=1
                                                        />
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="departamento">Barrio o vereda</label>
                                                        <vue-tags-input
                                                            v-model="form.barrioVereda"
                                                            :tags="barrioVeredaTags"
                                                            :readonly="barrioVeredaTags.length >= 1"
                                                            :autocomplete-items="listbarrioVereda"
                                                            :add-only-from-autocomplete="true"
                                                            @tags-changed="updatebarrioVereda"
                                                            :max-tags=1
                                                        />
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="direccion">Direccion</label>
                                                        <textarea class="form-control" id="direccion" v-model="form.direccion"></textarea>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="observaciones_direccion">Observaciones Direccion</label>
                                                        <textarea class="form-control" id="observaciones_direccion" v-model="form.observaciones_direccion"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="card ">
                                            <div class="card-header text-white bg-info mb-3">
                                              <h4>Otros Datos</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="municipio">Vehiculo</label>
                                                        <vue-tags-input
                                                            v-model="form.vehiculo"
                                                            :tags="vehiculoTags"
                                                            :autocomplete-items="listvehiculo"
                                                            :add-only-from-autocomplete="true"
                                                            @tags-changed="updatevehiculo"
                                                        />
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="departamento">Puesto de Votacion</label>
                                                        <vue-tags-input
                                                            v-model="form.puestoVotacion"
                                                            :tags="puestoVotacionTags"
                                                            :readonly="puestoVotacionTags.length >= 1"
                                                            :autocomplete-items="listpuestoVotacion"
                                                            :add-only-from-autocomplete="true"
                                                            @tags-changed="updatepuestoVotacion"
                                                            :max-tags=1
                                                        />
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="mesa_votacion">Mesa de Votacion</label>
                                                        <input type="text" class="form-control" id="mesa_votacion" v-model="form.mesa_votacion">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="lugar_trabajo">Lugar de Trabajo</label>
                                                        <input type="text" class="form-control" id="lugar_trabajo" v-model="form.lugar_trabajo">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="municipio">Candidato</label>
                                                        <vue-tags-input
                                                            v-model="form.candidato"
                                                            :tags="candidatoTags"
                                                            :readonly="candidatoTags.length >= 1"
                                                            :autocomplete-items="listcandidato"
                                                            :add-only-from-autocomplete="true"
                                                            @tags-changed="updatecandidato"
                                                            :max-tags=1
                                                        />
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="lider">Es Lider ?</label>
                                                        <select name="lider" id="lider" class="form-control" v-model="form.lider">
                                                            <option value="NO" selected>NO</option>
                                                            <option value="SI">SI</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="departamento">Responsables</label>
                                                        <vue-tags-input
                                                            v-model="form.resposable"
                                                            :tags="resposableTags"
                                                            :autocomplete-items="listresposable"
                                                            :add-only-from-autocomplete="true"
                                                            @tags-changed="updateresposable"
                                                            :max-tags=1
                                                        />
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="ayuda">¿En que lo he Ayudado?</label>
                                                        <textarea class="form-control" id="ayuda" v-model="form.ayuda"></textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="observaciones">Observaciones</label>
                                                        <textarea class="form-control" id="observaciones" v-model="form.observaciones"></textarea>
                                                    </div>
                                                </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="card ">
                                            <div class="card-header text-white bg-warning mb-3">
                                              <h4>Asistencia de Reuniones</h4>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped table-bordered">
                                                    <tr v-for="asistencia in form.asistencias" :key="asistencia">
                                                        <td>{{ asistencia }}</td>
                                                    </tr>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" @click="guardar()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
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
                form: {
                    nombre_apellido: '',
                    cedula : '',
                    celular_1 : '',
                    celular_2 : '',
                    fecha_nacimiento :  '',
                    email : '',
                    departamento : '',
                    departamenToString : '',
                    municipio : '',
                    municipioToString : '',
                    direccion : '',
                    observaciones_direccion : '',
                    barrioVereda : '',
                    barrioVeredaToString : '',
                    vehiculo : '',
                    vehiculoToString : '',
                    puestoVotacion : '',
                    puestoVotacionToString : '',
                    candidato : '',
                    candidatoToString : '',
                    resposable : '',
                    resposableToString : '',
                    ayuda : '',
                    observaciones : '',
                    profesion: '',
                    mesa_votacion : '',
                    lugar_trabajo : '',
                    lider : '',
                    foto_perfil : '',
                    asistencias : []

                },
                listDepartamentos: [],
                departamentoTags : [],
                listmunicipios: [],
                municipioTags : [],
                listbarrioVereda: [],
                barrioVeredaTags : [],
                listvehiculo: [],
                vehiculoTags : [],
                listpuestoVotacion: [],
                puestoVotacionTags : [],
                listcandidato: [],
                candidatoTags : [],
                listresposable: [],
                resposableTags : [],

            }
        },
        watch: {
            'form.departamento': 'listarDepartamento',
            'form.municipio': 'listarMunicipio',
            'form.barrioVereda': 'listarbarrioVereda',
            'form.vehiculo': 'listarvehiculo',
            'form.puestoVotacion': 'listarpuestoVotacion',
            'form.candidato': 'listarcandidato',
            'form.resposable': 'listarresponsable',
        },
        methods : {
            updateDepartamento(newTags) {
                this.listDepartamentos = [];
                this.departamentoTags = newTags;
                this.form.departamenToString = this.formatjsonstring(this.departamentoTags);
            },
            updateMunicipio(newTags) {
                this.listmunicipios = [];
                this.municipioTags = newTags;
                this.form.municipioToString = this.formatjsonstring(this.municipioTags);
            },
            updatebarrioVereda(newTags) {
                this.listbarrioVereda = [];
                this.barrioVeredaTags = newTags;
                this.form.barrioVeredaToString = this.formatjsonstring(this.barrioVeredaTags);
            },
            updatevehiculo(newTags) {
                this.listvehiculo = [];
                this.vehiculoTags = newTags;
                this.form.vehiculoToString = this.formatjsonstring(this.vehiculoTags);
            },
            updatepuestoVotacion(newTags) {
                this.listpuestoVotacion = [];
                this.puestoVotacionTags = newTags;
                this.form.puestoVotacionToString = this.formatjsonstring(this.puestoVotacionTags);
            },
            updatecandidato(newTags) {
                this.listcandidato = [];
                this.candidatoTags = newTags;
                this.form.candidatoToString = this.formatjsonstring(this.candidatoTags);
            },
            updateresposable(newTags) {
                this.listresposable = [];
                this.resposableTags = newTags;
                this.form.resposableToString = this.formatjsonstring(this.resposableTags);
            },

            listarDepartamento(){
                let me=this;
                if (me.form.departamento.length < 2) return;
                const url = `/listarDepartamentos/${me.form.departamento}`;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        me.listDepartamentos = response.data;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },
            listarMunicipio(){
                let me=this;
                if (me.form.municipio.length < 2) return;
                const url = `/listarMunicipios/${me.departamentoTags[0]['text']}/${me.form.municipio}`;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        me.listmunicipios = response.data;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },
            listarbarrioVereda(){
                let me=this;
                if (me.form.barrioVereda.length < 2) return;
                const url = `/listarbarrioVereda/${me.form.barrioVereda}`;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        me.listbarrioVereda = response.data;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },
            listarvehiculo(){
                let me=this;
                if (me.form.vehiculo.length < 2) return;
                const url = `/listarVehiculo/${me.form.vehiculo}`;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        me.listvehiculo = response.data;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },
            listarpuestoVotacion(){
                let me=this;
                if (me.form.puestoVotacion.length < 2) return;
                const url = `/listarpuestoVotacion/${me.form.puestoVotacion}`;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        me.listpuestoVotacion = response.data;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },
            listarcandidato(){
                let me=this;
                if (me.form.candidato.length < 2) return;
                const url = `/listarCandidatos/${me.form.candidato}`;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        me.listcandidato = response.data;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },
            listarresponsable(){
                let me=this;
                const url = `/listarResponsables/${me.form.resposable}`;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        me.listresposable = response.data;

                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },
            formatjsonstring(json){
                const texts = json.map(obj => obj.text).join(',');
                return texts;
            },

            guardar(){
                const url = `/persona/${this.id}`;
                axios.put(url,{
                    'nombre_apellido': this.form.nombre_apellido,
                    'cedula' : this.form.cedula,
                    'celular_1' : this.form.celular_1,
                    'celular_2' : this.form.celular_2,
                    'fecha_nacimiento' :  this.form.fecha_nacimiento,
                    'email': this.form.email,
                    'departamenToString' : this.form.departamenToString,
                    'municipioToString' : this.form.municipioToString,
                    'direccion' : this.form.direccion,
                    'observaciones_direccion' : this.form.observaciones_direccion,
                    'barrioVeredaToString' : this.form.barrioVeredaToString,
                    'vehiculoToString' : this.form.vehiculoToString,
                    'puestoVotacionToString' : this.form.puestoVotacionToString,
                    'candidatoToString' : this.form.candidatoToString,
                    'resposableToString' : this.form.resposableToString,
                    'ayuda' : this.form.ayuda,
                    'observaciones' : this.form.observaciones,
                    'profesion' : this.form.profesion,
                    'mesa_votacion' : this.form.mesa_votacion,
                    'lugar_trabajo' : this.form.lugar_trabajo,
                    'lider': this.form.lider,
                    '_token':this.csrfToken
                })
                    .then(function (response) {
                        // handle success
                        Swal.fire('Hecho!','Se Actualizó la Persona','success');
                        this.edit();
                    })
            },
            edit(){
                let me=this;
                const url = `/persona/${me.id}`;
                axios.get(url)
                    .then(function (response) {
                        // handle success
                        // me.listresposable = response.data;
                        setTimeout(() => {
                            console.log(response.data);
                            me.form.ayuda = response.data.ayuda;
                            me.barrioVeredaTags = response.data.barrioVeredaTags;
                            me.candidatoTags = response.data.candidatoTags;
                            me.form.cedula = response.data.cedula;
                            me.form.celular_1 = response.data.celular_1;
                            me.form.celular_2 = response.data.celular_2;
                            me.departamentoTags = response.data.departamentoTags;
                            me.form.direccion = response.data.direccion;
                            me.form.email = response.data.email;
                            me.form.fecha_nacimiento = response.data.fecha_nacimiento;
                            me.municipioTags = response.data.municipioTags;
                            me.form.nombre_apellido = response.data.nombre_apellido;
                            me.form.observaciones = response.data.observaciones;
                            me.form.observaciones_direccion = response.data.observaciones_direccion;
                            me.puestoVotacionTags = response.data.puestoVotacionTags;
                            me.resposableTags = response.data.resposableTags;
                            me.vehiculoTags = response.data.vehiculoTags;
                            me.form.departamenToString = response.data.departamenToString;
                            me.form.municipioToString = response.data.municipioToString;
                            me.form.barrioVeredaToString = response.data.barrioVeredaToString;
                            me.form.vehiculoToString = response.data.vehiculoToString;
                            me.form.puestoVotacionToString = response.data.puestoVotacionToString;
                            me.form.candidatoToString = response.data.candidatoToString;
                            me.form.resposableToString = response.data.resposableToString;
                            me.form.profesion = response.data.profesion;
                            me.form.mesa_votacion = response.data.mesa_votacion;
                            me.form.lugar_trabajo = response.data.lugar_trabajo;
                            me.form.lider = response.data.lider;
                            me.form.foto_perfil = response.data.foto_perfil;
                            me.form.asistencias = response.data.asistencias;

                            if(me.form.foto_perfil == null){
                                me.form.foto_perfil = '/img/sin_foto.jpg';
                            }
                        }, 1000);

                    })
                    .catch(function (error) {

                        console.log(error);
                    })
            },

            back(){
                return this.$router.go(-1);
            },
            subirFoto() {
                let formData = new FormData();
                formData.append("foto_perfil", this.$refs.fileInput.files[0]);

                axios.post(`/personas/foto_perfil/${this.id}`, formData, {
                    headers: {
                    "Content-Type": "multipart/form-data",
                    },
                }).then(response => {
                    Swal.fire('Hecho!','Se Subio la Foto de Perfil','success');
                    this.edit();
                }).catch(error => {
                    console.log(error);
                });
            }

        },
        mounted() {
            this.edit();
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
    .foto_perfil{
        width: 186px !important;
        margin: auto;
    }
</style>
