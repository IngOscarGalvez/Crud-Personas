<template>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Personas</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Principal</a></li>
                            <li class="breadcrumb-item active">Personas</li>
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
                            <router-link :to="{name:'personas-create'}">
                                <b-button size="sm" variant="primary" ><i class="fas fa-plus"></i> Crear Persona</b-button>
                            </router-link>

                            <b-button @click="exportToExcel" size="sm" variant="success">
                                <i class="fas fa-file-excel"></i> Exportar a Excel
                            </b-button>


                        </div>
                        <div class="card-body">
                            <vue-good-table
                            mode="remote"
                            @on-page-change="onPageChange"
                            @on-sort-change="onSortChange"
                            @on-column-filter="onColumnFilter"
                            @on-per-page-change="onPerPageChange"
                            :totalRows="totalRecords"
                            :isLoading.sync="isLoading"
                            :pagination-options="{
                                enabled: true,
                            }"
                            :rows="rows"
                            :columns="columns">
                                <template slot="table-row" slot-scope="props">
                                    <span v-if="props.column.field == 'id'">
                                        <router-link :to="{name:'personas-edit',params:{id:props.formattedRow[props.column.field]}}">
                                            <b-button size="sm" variant="warning" ><i class="fas fa-edit"></i></b-button>
                                        </router-link>
                                    </span>
                                </template>
                            </vue-good-table>
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
//   import axios from 'axios';
//   import VueGoodTable from 'vue-good-table';
import ExcelJS from "exceljs";

  export default {

    name: 'Personas',
    data() {
      return {
        link : '' ,
        totalRecords : 0,
        isLoading: false,
        columns: [
          {
            label: 'Apellido Nombre',
            field: 'nombre_apellido',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por Nombre y Apellido',
            },
          },
          {
            label: 'Cedula',
            field: 'cedula',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por Cedula',
            },
          },
          {
            label: 'Celular 1',
            field: 'celular_1',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por celular_1',
            },
          },
          {
            label: 'Celular 2',
            field: 'celular_2',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por celular_2',
            },
          },

          {
            label: 'Departamento',
            field: 'departamenToString',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por Departamento',
            },
          },
          {
            label: 'Municipio',
            field: 'municipioToString',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por Municipio',
            },
          },
          {
            label: 'Barrio o Vereda',
            field: 'barrioVeredaToString',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por Barrio',
            },
          },
          {
            label: 'Direccion',
            field: 'direccion',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por Direccion',
            },
          },
          {
            label: 'Puesto de Votacion',
            field: 'puestoVotacionToString',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por Puesto de Votacion',
            },
          },
          {
            label: 'Mesa de Votacion',
            field: 'mesa_votacion',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por Mesa de Votacion',
            },
          },
          {
            label: 'Vehiculo',
            field: 'vehiculoToString',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por Vehiculo',
            },
          },

          {
            label: 'Lider',
            field: 'lider',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por lider',
            },
          },
          {
            label: 'Responsable',
            field: 'resposableToString',
            filterOptions: {
                enabled: true,
                placeholder: 'Buscar por Reponsable',
            },
          },

          {
            label: "Opciones",
            field: "id",
            slot: "modify",
          },


        ],
        rows: [],
        serverParams: {
            columnFilters: {
            },
            sortKey: '',
            sortOrder: '',
            page: 1,
            perPage: 10
        },
        paginationOptions: {
          enabled: true,
          perPage: 10,
          perPageDropdown: [10, 20, 50, 100]
        },
        sortOptions: {
          enabled: true
        },

      }
    },
    methods: {
        fetchData() {
            axios.post('/personas/getdata', this.serverParams).then(response => {
                this.rows = response.data.data;
            });
        },
        updateParams(newProps) {
            this.serverParams = Object.assign({}, this.serverParams, newProps);
            this.fetchData()
        },
        onPageChange(params) {
            this.updateParams({page: params.currentPage});
            console.log('onPageChange',params)
            this.fetchData()
        },
        onPerPageChange(params){
            this.updateParams({perPage: params.currentPerPage});
            console.log('onPerPageChange',params)
            this.fetchData()
        },
        onSortChange(params) {
            console.log('onFilterChange',params)
            this.updateParams({
                sortKey : params[0].field,
                sortOrder : params[0].type,
            });
            this.fetchData()

        },
        onColumnFilter(params){
            this.updateParams(params);
            console.log('onColumnFilter',params)
            this.fetchData()
        },
        exportToExcel() {
            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet("Datos");

            // Agregar encabezados de columna
            worksheet.columns = this.columns.map((column) => {
                return {
                header: column.label,
                key: column.field,
                };
            });

            // Agregar datos de la tabla
            this.rows.forEach((row) => {
                worksheet.addRow(row);
            });

            // Descargar el archivo Excel
            workbook.xlsx.writeBuffer().then((buffer) => {
                const blob = new Blob([buffer], { type: "application/vnd.ms-excel" });
                const link = document.createElement("a");
                link.href = window.URL.createObjectURL(blob);
                link.download = "datos.xlsx";
                link.click();
            });
        },
    },
    mounted() {
      this.fetchData();
    }
  }
  </script>
