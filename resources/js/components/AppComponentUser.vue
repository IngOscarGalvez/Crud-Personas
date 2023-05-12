<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->

        <a href="/" class="brand-link">
            <img src="/img/Logo.png" alt="Universoft" class="brand-image ">
            <span class="brand-text font-weight-light"></span>
            <br>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item " >

                            <a  class="nav-link" href="#">
                                <i class="fas fa-list-alt"></i>
                                <p>Survey Form</p>

                            </a>

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

</style>
