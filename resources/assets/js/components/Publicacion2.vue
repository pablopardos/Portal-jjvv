<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Tabla Comunicados Listado -->
                <div class="card">
                    <div class="card-header" style="color:#8B008B">
                        <h5 class="fa fa-align-justify">COMUNICADOS DE DIRECTIVA DE LA JUNTA DE VECINOS</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-6">
                                <div class="input-group">
                                    <select class="form-control col-3" v-model="criterio">
                                      <option value="asunto">Título</option>
                                      <option value="descrip">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPublicacion(1,buscar,criterio)" class="form-control" placeholder="Escriba un texto de busqueda">
                                    <button type="submit" @click="listarPublicacion(1,buscar,criterio)" class="btn btn-secondary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Tipo de comunicado</th>
                                    <th>Ver</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="publicacion in arrayPublicacion" :key="publicacion.id_pub">
                                    
                                    <td v-if="publicacion.id_tipopub==1" ><span class="badge badge-pill badge-success">Beneficio municipal</span></td>
                                    <td v-if="publicacion.id_tipopub==2" ><span class="badge badge-pill badge-dark">Proyecto de JJ.VV.</span></td>
                                    <td v-if="publicacion.id_tipopub==3" ><span class="badge badge-pill badge-info">Cuotas sociales</span></td>
                                    <td v-if="publicacion.id_tipopub==4" ><span class="badge badge-pill badge-secondary">Citación asamblea</span></td>
                                    <td v-if="publicacion.id_tipopub==5" ><span class="badge badge-pill badge-danger">Urgencia</span></td>

                                    <td>
                                        <button type="button" @click="abrirPublicacion(publicacion)" class="btn btn-info btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td v-text="publicacion.asunto"></td>
                                    <td v-if="publicacion.descrip.length >= 100" v-text="publicacion.descrip.substr(0,100) + '...'"></td>
                                    <td v-else v-text="publicacion.descrip"></td>
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
                <!-- Fin tabla comunicados Listado -->
            </div>
            
            <!-- Inicio del modal Ver -->
            <div class="modal fade" tabindex="-1" :class="{'mostrarVer' : modalVer}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-info" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloVer" ></h4>
                            <button type="button" class="close" @click="cerrarPublicacion()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p v-text="descripcionVer"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarPublicacion()" >Volver</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal Ver -->
        </main>
</template>

<script>
    export default {
        data() {
            return {
                id_tipopub : 0,
                asunto : '',
                descrip : '',
                arrayPublicacion : [],
                modalVer : 0,
                tituloVer : '',
                descripcionVer : '',
                pagination : { 
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'asunto',
                buscar : '',
                arrayTipopublicacion : []
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
        methods: {
            listarPublicacion (page,buscar,criterio){
                let me = this;
                var url = '/publicacion?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPublicacion = respuesta.publicacion.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectTipopublicacion(){
                let me = this;
                var url = '/tipopublicacion';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayTipopublicacion = respuesta.tipopublicacion;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me =this;
                me.pagination.current_page = page;
                me.listarPublicacion(page,buscar,criterio);
            },
            abrirPublicacion(data = []){
                this.modalVer = 1;
                this.tituloVer = data ['asunto'];
                this.descripcionVer = data ['descrip'];
            },
            cerrarPublicacion(data = []){
                this.modalVer = 0;
                this.tituloVer = '';
                this.descripcionVer = '';
            }
        },
        mounted() {
            this.listarPublicacion(1,this.buscar,this.criterio);
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
    .mostrarVer {
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
</style>
