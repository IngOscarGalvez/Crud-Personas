<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->

        <a href="/" class="brand-link">
            <h1>ODIN</h1>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item " >
                        <router-link :to="{ name: 'users' }">
                            <a  class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>Admin de Usuarios</p>

                            </a>
                        </router-link>
                    </li>
                    <li class="nav-item " >

                        <router-link :to="{ name: 'personas' }">
                            <a  class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>Personas</p>

                            </a>
                        </router-link>
                        <router-link :to="{ name: 'personasCumple' }">
                            <a  class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>Personas Cumpleaños</p>

                            </a>
                        </router-link>
                        <router-link :to="{ name: 'barrioVereda' }">
                            <a  class="nav-link">
                                <i class="fas fa-book"></i>
                                <p>Barrio o Vereda</p>

                            </a>
                        </router-link>
                        <router-link :to="{ name: 'vehiculo' }">
                            <a  class="nav-link">
                                <i class="fas fa-book"></i>
                                <p>Vehiculo</p>

                            </a>
                        </router-link>
                        <router-link :to="{ name: 'puestoVotacion' }">
                            <a  class="nav-link">
                                <i class="fas fa-book"></i>
                                <p>Puesto Votacion</p>

                            </a>
                        </router-link>
                        <router-link :to="{ name: 'candidato' }">
                            <a  class="nav-link">
                                <i class="fas fa-book"></i>
                                <p>Candidato</p>

                            </a>
                        </router-link>
                        <router-link :to="{ name: 'responsable' }">
                            <a  class="nav-link">
                                <i class="fas fa-book"></i>
                                <p>Responsable</p>

                            </a>
                        </router-link>
                        <router-link :to="{ name: 'reuniones' }">
                            <a  class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>Reuniones</p>

                            </a>
                        </router-link>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

</template>



<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
    body{
        width: 99.4%;
    }

    .brand-link .brand-image {
        margin-left: 0.5rem;
        max-height: 38px;


    }

    .VueTables__table{
        width: 100% !important;
    }

    .VueTables__columns-dropdown{
        margin-right:70px;
    }





</style>
