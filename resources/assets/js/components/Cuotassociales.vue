<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Tabla Comunicados Listado -->
                <div class="card">
                    <div class="card-header" style="color:#008000">
                        <h5 class="fa fa-align-justify">REGISTRO DE PAGO DE CUOTAS SOCIALES</h5>
                    </div> 
                        
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-6">
                                <div class="input-group">
                                    <select class="form-control col-3" v-model="criterio">
                                      <option value="id_year">Año</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarCuotassociales(1,buscar,criterio)" class="form-control" placeholder="Escriba un texto de busqueda">
                                    <button type="submit" @click="listarCuotassociales(1,buscar,criterio)" class="btn btn-secondary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="button" @click="abrirModal('estadopago','registrar')" class="btn btn-secondary">
                                    <i class="icon-plus"></i>&nbsp; Agregar nuevo año
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Año</th>
                                    <th>Dirección</th>
                                    <th>Ene.</th>
                                    <th>Feb.</th>
                                    <th>Mar.</th>
                                    <th>Abr.</th>
                                    <th>May.</th>
                                    <th>Jun.</th>
                                    <th>Jul.</th>
                                    <th>Ago.</th>
                                    <th>Sep.</th>
                                    <th>Oct.</th>
                                    <th>Nov.</th>
                                    <th>Dic.</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="estadopago in arrayCuotassociales" :key="estadopago.id_estpag">
                                    <td v-text="estadopago.id_year"></td>
                                    <td>{{estadopago.calle}} {{estadopago.numero}}</td>
                                    <td>
                                        <div v-if="estadopago.ene">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="estadopago.feb">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="estadopago.mar">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="estadopago.abr">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="estadopago.may">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="estadopago.jun">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="estadopago.jul">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="estadopago.ago">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="estadopago.sep">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="estadopago.oct">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="estadopago.nov">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="estadopago.dic">
                                            <span class="badge badge-success">Pagado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">No pagado</span>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" @click="abrirModal('estadopago','actualizar',estadopago)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
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
                <!--<div v-if="tipoAccion==2" class="modal-dialog modal-warning modal-lg" role="document">-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar año de registro</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nuevo año</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="id_year">
                                            <option value="0" disabled>(*) Seleccione un nuevo año de registro</option>
                                            <option v-for="year in activarYear" :key="year.id_year" :value="year.id_year" v-text="year.id_year"></option>
                                        </select>
                                    </div>
                                </div> 
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="registrarCuotassociales()">Agregar</button>
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
                <!--<div v-if="tipoAccion==2" class="modal-dialog modal-warning modal-lg" role="document">-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar registros</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Dirección</b>
                                    <div class="col-md-9">
                                        <i class="negrita" v-text="calle + ' # ' + numero"></i>
                                    </div>
                                </div>
                                <table class="table table-bordered table-responsive table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Año</th>
                                    <th>Ene.</th>
                                    <th>Feb.</th>
                                    <th>Mar.</th>
                                    <th>Abr.</th>
                                    <th>May.</th>
                                    <th>Jun.</th>
                                    <th>Jul.</th>
                                    <th>Ago.</th>
                                    <th>Sep.</th>
                                    <th>Oct.</th>
                                    <th>Nov.</th>
                                    <th>Dic.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{id_year}}</td>
                                    <td><input type="checkbox" v-model="ene" ></td>
                                    <td><input type="checkbox" v-model="feb" ></td>
                                    <td><input type="checkbox" v-model="mar" ></td>
                                    <td><input type="checkbox" v-model="abr" ></td>
                                    <td><input type="checkbox" v-model="may" ></td>
                                    <td><input type="checkbox" v-model="jun" ></td>
                                    <td><input type="checkbox" v-model="jul" ></td>
                                    <td><input type="checkbox" v-model="ago" ></td>
                                    <td><input type="checkbox" v-model="sep" ></td>
                                    <td><input type="checkbox" v-model="oct" ></td>
                                    <td><input type="checkbox" v-model="nov" ></td>
                                    <td><input type="checkbox" v-model="dic" ></td>
                                </tr>
                            </tbody>
                        </table>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                            <button type="button" class="btn btn-warning" @click="actualizarEstadopago()">Actualizar</button>
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
        data() {
            return {

                estadopago_id : 0,
                id_direc : 0,
                id_year : 0,
                ene : 0,
                feb : 0,
                mar : 0,
                abr : 0,
                may : 0,
                jun : 0,
                jul : 0,
                ago : 0,
                sep : 0,
                oct : 0,
                nov : 0,
                dic : 0,

                calle : '',
                numero : '',

                arrayCuotassociales : [],
                arrayYear : [],
                arrayDireccion : [],

                modal1 : 0,
                modal2 : 0,
                modalVer : 0,
                
                pagination : { 
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'id_year',
                buscar : ''
            } 
        },
        computed:{
            activarYear: function() {
                return _.pickBy(this.arrayYear, function(y) {
                return y.condicion;
                });
            },
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
            selectDireccion(){
                let me = this;
                var url = '/direccion';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayDireccion = respuesta.direccion;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectYear(){
                let me = this;
                var url = '/year';
                axios.get(url).then(function (response) {
                    var respuesta1 = response.data;
                    me.arrayYear = respuesta1.year;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarCuotassociales (page,buscar,criterio){
                let me = this;
                var url = '/estadopago?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCuotassociales = respuesta.estadopago.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me =this;
                me.pagination.current_page = page;
                me.listarCuotassociales(page,buscar,criterio);
            },
            registrarCuotassociales (){
                this.arrayDireccion.forEach(direccion => {
                    axios.post('/estadopago/registrar',{
                        'id_year' : this.id_year,
                        'id_direc' : direccion.id_direc
                    });
                });
                this.desactivarYear(this.id_year);
                this.listarCuotassociales(1,'','');
                this.selectYear();
                this.cerrarModal();
            },
            actualizarEstadopago(){
                let me = this; 
                if(this.ene == 1 && this.feb == 1 && this.mar == 1){
                    axios.put('/estadopago/acestado',{
                        'id_estpag' : this.estadopago_id,                    
                    })
                }else{
                    axios.put('/estadopago/desestado',{
                        'id_estpag' : this.estadopago_id, 
                    })
                };
                axios.put('/estadopago/actualizar',{
                    'id_estpag' : this.estadopago_id,
                    'ene' : this.ene,
                    'feb' : this.feb,
                    'mar' : this.mar,
                    'abr' : this.abr,
                    'may' : this.may,
                    'jun' : this.jun,
                    'jul' : this.jul,
                    'ago' : this.ago,    
                    'sep' : this.sep,
                    'oct' : this.oct,
                    'nov' : this.nov,
                    'dic' : this.dic                        
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCuotassociales(1,'','');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            desactivarYear(id){
                axios.put('/year/desactivar',{
                    'id_year' : id     
                });
            },
            cerrarModal(){
                this.modal1 = 0;
                this.modal2 = 0;
                this.estadopago_id = 0;
                this.id_direc = 0;
                this.id_year = 0;
                this.ene = 0;
                this.feb = 0;
                this.mar = 0;
                this.abr = 0;
                this.may = 0;
                this.jun = 0;
                this.jul = 0;
                this.ago = 0;
                this.sep = 0;
                this.oct = 0;
                this.nov = 0;
                this.dic = 0;
                this.calle = '';
                this.numero = '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case 'estadopago':
                    {
                        switch(accion)
                        {
                            case 'actualizar' :
                            {
                                this.modal2 = 1;
                                this.estadopago_id = data ['id_estpag'];
                                this.id_year = data ['id_year'];
                                this.id_direc = data ['id_direc'];
                                this.ene = data ['ene'];
                                this.feb = data ['feb'];
                                this.mar = data ['mar'];
                                this.abr = data ['abr'];
                                this.may = data ['may'];
                                this.jun = data ['jun'];
                                this.jul = data ['jul'];
                                this.ago = data ['ago'];
                                this.sep = data ['sep'];
                                this.oct = data ['oct'];
                                this.nov = data ['nov'];
                                this.dic = data ['dic'];
                                this.calle = data ['calle'];
                                this.numero = data ['numero'];
                                break;
                            }
                            case 'registrar' :
                            {
                                this.modal1 = 1;
                                this.id_year = 0;
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.selectDireccion();
            this.selectYear();
            this.listarCuotassociales(1,this.buscar,this.criterio);
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
