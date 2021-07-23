<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Tabla Comunicados Listado -->
                <div v-if="LargoCr > 0" class="card">
                    <div class="card-header" style="color:#00008B">
                        <h5 class="fa fa-align-justify"> SOLICITUDES DE CERTIFICADOS</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="rut">RUT</option>
                                      <option value="nombre">Nombre</option>
                                      <option value="asunto">Motivo del certificado</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarCertificado(1,buscar,criterio)" class="form-control" placeholder="Escriba un texto de busqueda">
                                    <button type="submit" @click="listarCertificado(1,buscar,criterio)" class="btn btn-secondary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Tipo de certificado</th>
                                    <th>RUT</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Motivo del certificado</th>
                                    <th>Estado de pago</th>
                                    <th>Teléfono de contacto</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="certresidencia in arrayCertificado" :key="certresidencia.id_cert">
                                    <td v-text="certresidencia.tipo"></td>
                                    <td v-text="certresidencia.rut"></td>
                                    <td v-text="certresidencia.nombre"></td>
                                    <td >{{certresidencia.calle}} {{certresidencia.numero}}</td>
                                    <td v-text="certresidencia.asunto"></td>
                                    <td v-if="certresidencia.estado==1" ><span class="badge badge-pill badge-success">Al dia</span></td>
                                    <td v-else><span class="badge badge-pill badge-danger">Meses sin pagar</span></td>
                                    <td v-text="certresidencia.telefono"></td>
                                    <td>
                                        <button type="button" @click="borrarCertificado(certresidencia.id_cert,certresidencia.id_socio)" class="btn btn-danger btn-sm">
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

                <div v-else class="card">
                    <div class="card-header">
                        <h3 class="fa fa-align-justify">NO HAY SOLICITUDES DISPONIBLES, POR FAVOR VUELVA MÁS TARDE.</h3>
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
                certificado_id : 0,
                id_tipocert : 0,
                //id_socio : 0,
                rut : '',
                nombre : '',
                asunto : '',
                arrayCertificado : [],
                modalVer : 0,
                tituloModal : '',
                tituloVer : '',
                descripcionVer : '',
                tipoAccion : 0,
                pagination : { 
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                LargoCr : '',
                criterio : 'rut',
                buscar : ''
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
            largoCertresidencia(){
                let me = this;
                this.LargoCr = this.arrayCertificado.length;
            },
            listarCertificado (page,buscar,criterio){
                let me = this;
                var url = '/certresidencia?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCertificado = respuesta.certresidencia.data;
                    me.pagination = respuesta.pagination;
                    me.largoCertresidencia();
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
                me.listarCertificado(page,buscar,criterio);
            },
            borrarCertificado(id1,id2){
                swal({
                title: 'Esta seguro que desea despachar esta solicitud?',
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
                        axios.put('/certresidencia/eliminar',{
                            'id_cert' : id1
                        })
                        axios.put('/user/desolicitud',{
                            'id_socio' : id2

                        }).then(function (response) {
                            me.listarCertificado(1,'','id_tipocert');
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
            abrirCertificado(data = []){
                this.modalVer = 1;
                this.tituloVer = '';
                this.descripcionVer = '';
            },
            cerrarCertificado(data = []){
                this.modalVer = 0;
                this.tituloVer = '';
                this.descripcionVer = '';
            },
        },
        mounted() {
            this.listarCertificado(1,this.buscar,this.criterio);
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
</style>
