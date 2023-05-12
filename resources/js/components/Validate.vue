<template>
    <div class="col-lg-4 offset-lg-1">
        <div class="d-flex align-items-center m-b-20">
            <img src="flogin/img/logo-orange.png" class="m-r-15" width="200px" alt="">
            <h3 class="m-0">Customer</h3>
        </div>

        <div class="form-group mb-4">
            <textarea name="license" id="" cols="30" rows="5" class="form-control" placeholder="Enter your license" v-model="license"></textarea>
        </div>

        <button class="btn btn-info btn-lg btn-block btn-uppercase mb-4" @click="buscar(license)">Validate</button>


        <b-modal ref="modal" id="modal"
                 :header-bg-variant="headerBgVariant"
                 :header-text-variant="headerTextVariant"
        >
            <template v-slot:modal-title>
                {{title}}
            </template>
            <div v-if="array.find===1">
                <h6>Date Start:</h6>
                <div v-if="array.date_start!=='N/A'">
                    {{new Date(array.date_start).toLocaleString()}}
                </div>
                <div v-else>
                    {{array.date_start}}
                </div>

                <br>
                <h6>Date End:</h6>
                <div v-if="array.date_end!=='N/A'">
                    {{new Date(array.date_end).toLocaleString()}}
                </div>
                <div v-else>
                    {{array.date_end}}
                </div>
                <br>
                <h6>Time remaining :</h6>
                {{array.time}}
                <br>
                <br>
                <h6>Modules:</h6>

                <b-badge pill variant="primary" v-for="modulo in array.modulos" :key="modulo">{{modulo}}</b-badge>

                <br>
            </div>
            <div v-else>
                The typed license has no match in our system
            </div>

        </b-modal>




    </div>



</template>

<script>
    export default {

        data(){
            return{
                //variables globales
                show:false,
                license:'',
                title:'',
                headerBgVariant:'',
                headerTextVariant:'light',
                array:[],

            }
        },
        methods : {

            buscar(license){

                let me=this;
                axios.post('/UserLicencia',{
                    'license':license,
                    '_token':this.csrfToken

                }).then(function (response) {
                    // handle success
                    if (response.data.find===1){
                        me.title='Registered License to '+response.data.name;
                        me.headerBgVariant='success';
                    }else{
                        me.title='License Not Found';
                        me.headerBgVariant='danger';
                    }

                    me.array = response.data;
                    me.$refs['modal'].show();
                })
                .catch(function (error) {

                    console.log(error);
                })
            },
        },
        mounted() {




        },
        created () {

        },
    }
</script>

<style scoped>

</style>
