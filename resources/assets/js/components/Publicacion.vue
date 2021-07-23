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
                            <div class="col-3">
                                <button type="button" @click="abrirModal('publicacion','registrar')" class="btn btn-secondary">
                                    <i class="icon-plus"></i>&nbsp; Agregar comunicado
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Tipo de comunicado</th>
                                    <th>Ver</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Opciones</th>
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
                                    <!--<td v-text="publicacion.descrip"></td>-->
                                    <td>
                                        <button type="button" @click="abrirModal('publicacion','actualizar',publicacion)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" @click="borrarPublicacion(publicacion.id_pub)" class="btn btn-danger btn-sm">
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
                <!-- Fin tabla comunicados Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal1}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="imagen">Tipo de Comunicado</b>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="id_tipopub">
                                            <option value="0" disabled>(*) Seleccione un tipo de comunicado</option>
                                            <option v-for="publicacion in arrayTipopublicacion" :key="publicacion.id_tipopub" :value="publicacion.id_tipopub" v-text="publicacion.tipo"></option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Título</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="asunto" class="form-control" placeholder="(*) Escriba un título del comunicado">                             
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="email-input">Descripción</b>
                                    <div class="col-md-9">
                                        <textarea type="text" v-model="descrip" class="form-control" rows="10" placeholder="(*) Escriba el detalle del comunicado"></textarea>
                                    </div>
                                </div>
                                <div v-show="errorPublicacion" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPublicacion" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPublicacion()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-warning" @click="actualizarPublicacion()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

            <!--Inicio del modal actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal2}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-warning modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="imagen">Tipo de Comunicado</b>
                                    <div class="col-md-9">
                                        <select class="form-control negrita" v-model="id_tipopub">
                                            <option value="0" disabled>(*) Seleccione un tipo de comunicado</option>
                                            <option v-for="publicacion in arrayTipopublicacion" :key="publicacion.id_tipopub" :value="publicacion.id_tipopub" v-text="publicacion.tipo"></option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Título</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="asunto" class="form-control negrita" placeholder="(*) Escriba un título del comunicado">                             
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="email-input">Descripción</b>
                                    <div class="col-md-9">
                                        <textarea type="text" v-model="descrip" class="form-control negrita" rows="10" placeholder="(*) Escriba el detalle del comunicado"></textarea>
                                    </div>
                                </div>
                                <div v-show="errorPublicacion" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPublicacion" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPublicacion()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-warning" @click="actualizarPublicacion()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            
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
                publicacion_id : 0,
                id_tipopub : 0,
                asunto : '',
                descrip : '',
                arrayPublicacion : [],
                modal1 : 0,
                modal2 : 0,
                modalVer : 0,
                tituloModal : '',
                tituloVer : '',
                descripcionVer : '',
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
            registrarPublicacion (){
                if(this.validarPublicacion()){
                    return;
                }
                let me = this; 
                axios.post('/publicacion/registrar',{
                    'id_tipopub' : this.id_tipopub,
                    'asunto' : this.asunto,
                    'descrip' : this.descrip
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPublicacion(1,'','asunto');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            actualizarPublicacion(){
                if(this.validarPublicacion()){
                    return;
                }
                let me = this; 
                axios.put('/publicacion/actualizar',{
                    'id_pub' : this.publicacion_id,
                    'asunto' : this.asunto,
                    'descrip' : this.descrip,
                    'id_tipopub' : this.id_tipopub
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPublicacion(1,'','id_tipopub');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            borrarPublicacion(id){
                swal({
                title: 'Esta seguro de eliminar este comunicado?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this; 
                        axios.put('/publicacion/eliminar',{
                            'id_pub' : id
                        }).then(function (response) {
                            me.listarPublicacion(1,'','id_tipopub');
                            swal(
                            'Eliminado!',
                            'La informacion ha sido eliminada con éxito.',
                            'success'
                            )
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    
                }
                }) 
            },
            validarPublicacion(){
                this.errorPublicacion = 0;
                this.errorMostrarMsjPublicacion = [];

                if(!this.asunto||!this.descrip||this.id_tipopub==0) this.errorMostrarMsjPublicacion.push("Ingrese la totalidad de los datos del comunicado");
                if(this.id_tipopub==0) this.errorMostrarMsjPublicacion.push("(*) Seleccione un tipo");
                if(!this.asunto) this.errorMostrarMsjPublicacion.push("(*) Ingrese un título");
                if(!this.descrip) this.errorMostrarMsjPublicacion.push("(*) Ingrese una descripción");

                if(this.errorMostrarMsjPublicacion.length) this.errorPublicacion = 1;

                return this.errorPublicacion;
            },
            cerrarModal(){
                this.modal1 = 0;
                this.modal2 = 0;
                this.tituloModal = '';
                this.id_tipopub = 0,
                this.asunto = '';
                this.descrip = '';
                this.errorMostrarMsjPublicacion = [];
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
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case 'publicacion':
                    {
                        switch(accion)
                        {
                            case 'registrar' :
                            {
                                this.modal1 = 1;
                                this.tituloModal = 'Agregar Comunicado';
                                this.tipoAccion = 1;
                                this.id_tipopub = 0;
                                this.asunto = '';
                                this.descrip = '';
                                break;
                            }
                            case 'actualizar' :
                            {
                                this.modal2 = 1;
                                this.tituloModal = 'Actualizar Comunicado';
                                this.tipoAccion = 2;
                                this.publicacion_id = data ['id_pub'];
                                this.id_tipopub = data ['id_tipopub'];
                                this.asunto = data ['asunto'];
                                this.descrip = data ['descrip'];
                                break;
                            }
                        }
                    }
                }
                this.selectTipopublicacion();
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
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    .negrita{
        color: grey !important;
        font-weight: bold;
    }
</style>
