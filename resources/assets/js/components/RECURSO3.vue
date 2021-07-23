<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"> Volver al escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Tabla Nuevos socios listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> SOLICITUDES DE INGRESO
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                   <select class="form-control col-md-3" v-model="criterio">
                                      <option value="">Seleccione criterio</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarNuevosocio(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarNuevosocio(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>RUT</th>
                                    <th>Nombre Completo</th>
                                    <th>Dirección</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Estado civil</th>
                                    <th>Rol Familiar</th>
                                    <th>Profesión</th>
                                    <th>Email</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="nuevosocio in arrayNuevosocio" :key="nuevosocio.id_nuevo">
                                    <td v-text="nuevosocio.rut"></td>
                                    <td >{{nuevosocio.nom_p}} {{nuevosocio.nom_s}} {{nuevosocio.ap_p}} {{nuevosocio.ap_s}}</td>
                                    <td>{{nuevosocio.calle}} {{nuevosocio.numero}}</td>
                                    <td v-text="nuevosocio.nacimiento"></td>
                                    <td v-text="nuevosocio.id_ecivil"></td>
                                    <td v-text="nuevosocio.id_rolfam"></td>                                   
                                    <td v-text="nuevosocio.prof"></td>  
                                    <td v-text="nuevosocio.email"></td>
                                    <td>
                                        <button type="button" @click="'#'" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" @click="borrarNuevosocio(nuevosocio.id_nuevo)" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)" >Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pageNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page" ></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)" >Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin tabla nuevos socios listado -->
            </div>

            <div class="container-fluid">
                <!-- Tabla socios Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> SOCIOS INSCRITOS
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="">Seleccione criterio</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listasSocio(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listasSocio(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>N° Socio</th>
                                    <th>RUT</th>
                                    <th>Nombre Completo</th>
                                    <th>Dirección</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Email</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="socio in arraySocio" :key="socio.id_socio">
                                    <td v-text="socio.num_socio"></td>
                                    <td v-text="socio.rut"></td>
                                    <td>{{socio.nom_p}} {{socio.nom_s}} {{socio.ap_p}} {{socio.ap_s}}</td>
                                    <td>{{socio.calle}} {{socio.numero}}</td>
                                    <td v-text="socio.nacimiento"></td>
                                    <td v-text="socio.email"></td>
                                    <td>
                                        <button type="button" @click="'#'" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" @click="borrarSocio(socio.id_socio)" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)" >Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pageNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page" ></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)" >Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin tabla socios Listado -->
            </div>

            <!--Inicio del modal actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
         data(){
            return{
                socio_id : 0,
                id_direc : 0,
                id_ecivil : 0,
                id_rolfam : 0,
                num_socio : 0,
                nom_p : '',
                nom_s : '',
                ap_p : '',
                ap_s : '',
                prof : '',
                email : '',
                nacimiento : '',
                arraySocio: [],
                arrayNuevosocio: [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPublicacion : 0,
                errorMostrarMsjPublicacion : [],
                pagination : { 
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'id_socio',
                buscar : '',
                arrayEcivil : []
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pageNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods : {
            listarSocio (page,buscar,criterio){
                let me = this;
                var url = '/socio?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraySocio = respuesta.socio.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarNuevosocio (page,buscar,criterio){
                let me = this;
                var url = '/nuevosocio?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayNuevosocio = respuesta.nuevosocio.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectEcivil(){
                let me = this;
                var url = '/ecivil';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayEcivil = respuesta.ecivil;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectRolfamiliar(){
                let me = this;
                var url = '/rolfamiliar';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayEcivil = respuesta.rolfamiliar;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me =this;
                me.pagination.current_page = page;
                me.listarSocio(page,buscar,criterio);
            }
    },
    mounted() {
        this.listarSocio();
    }
}
</script>
<style>
    .modal-content {
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar {
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>





