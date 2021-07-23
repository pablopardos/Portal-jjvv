<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
 
            <div class="container-fluid">

                <!-- Tabla nuevo socios Listado -->
                <div v-if="LargoNs > 0" class="card">
                    <div class="card-header" style="color:#FF8C00">
                        <h5 class="fa fa-align-justify">SOLICITUDES DE INGRESO - NUEVOS SOCIOS</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>RUT</th>
                                    <th>Nombre Completo</th>
                                    <th>Dirección</th>
                                    <th>Edad de solicitud</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="nuevosocio in arrayNuevosocio" :key="nuevosocio.id_nuevo">
                                    <td v-text="nuevosocio.rut"></td>
                                    <td >{{nuevosocio.nom_p}} {{nuevosocio.nom_s}} {{nuevosocio.ap_p}} {{nuevosocio.ap_s}}</td>
                                    <td>{{nuevosocio.ns_calle}} {{nuevosocio.ns_numero}}</td>
                                    <td v-text="nuevosocio.edad  + ' años'"></td>
                                    <td v-text="nuevosocio.email"></td>
                                    <td v-text="nuevosocio.telefono"></td> 
                                    <td>
                                        <button type="button" @click="abrirModal('socio','registrar',nuevosocio)" class="btn btn-primary btn-sm">
                                          <i class="icon-plus"></i>
                                        </button> &nbsp;
                                        <button type="button" @click="borrarNuevosocio(nuevosocio.id_nuevo)" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Fin tabla nuevo socios Listado -->


                <!-- Tabla socios Listado -->
                <div class="card">
                    <div class="card-header" style="color:#D2691E">
                        <h5 class="fa fa-align-justify">SOCIOS/USUARIOS DEL SISTEMA</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="num_socio">N° Socio</option>
                                      <option value="nom_p">Primer Nombre</option>
                                      <option value="nom_s">Segundo Nombre</option>
                                      <option value="ap_p">Apellido Paterno</option>
                                      <option value="ap_s">Apellido Materno</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarSocio(1,buscar,criterio)" class="form-control" placeholder="Escriba un texto de busqueda">
                                    <button type="submit" @click="listarSocio(1,buscar,criterio)" class="btn btn-secondary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Edad de inscripción</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="socio in arraySocio" :key="socio.id_socio">
                                    <td v-text="socio.num_socio"></td>
                                    <td v-text="socio.rut"></td>
                                    <td>{{socio.nom_p}} {{socio.nom_s}} {{socio.ap_p}} {{socio.ap_s}}</td>
                                    <td>{{socio.s_calle}} {{socio.s_numero}}</td>
                                    <td v-text="socio.edad + ' años'"></td>
                                    <td v-text="socio.email"></td>
                                    <td v-text="socio.telefono"></td>
                                    <td>
                                        <button type="button" @click="abrirModal('socio','actualizar',socio)" class="btn btn-warning btn-sm">
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

            <!--Inicio del modal registrar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modalRegistrar}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"> Agregar nuevo Socio/Usuario </h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                                <div v-show="errorValidador" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjValidador" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>

                                <div v-show="errorNuevosocio" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjNuevosocio" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Número de Socio</b>
                                    <div class="col-md-9">
                                        <input type="number" v-model="nsoc_num_socio" class="form-control" placeholder="(*) Ingrese el número de registro del libro de socio">                             
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">RUT</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nsoc_rut" class="form-control negrita" placeholder="">                             
                                    </div>
                                    <b class="col-md-3 form-control-label" for="text-input">Contraseña de Usuario</b>
                                    <div class="col-md-9">
                                        <input type="password" v-model="nsoc_password" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Primer Nombre</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nsoc_nom_p" class="form-control negrita" placeholder="">                             
                                    </div>
                                    <b class="col-md-3 form-control-label" for="text-input">Segundo Nombre</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nsoc_nom_s" class="form-control negrita" placeholder="">     
                                    </div>    
                                    <b class="col-md-3 form-control-label" for="text-input">Apellido Paterno</b>                    
                                    <div class="col-md-9">
                                        <input type="text" v-model="nsoc_ap_p" class="form-control negrita" placeholder="">                             
                                    </div>
                                    <b class="col-md-3 form-control-label" for="text-input">Apellido Materno</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nsoc_ap_s" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Edad de Inscripción</b>
                                    <div class="col-md-9">
                                        <input type="number" v-model="nsoc_edad" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Dirección</b>
                                    <div class="col-md-9">
                                        <select class="form-control negrita" v-model="nsoc_id_direc">
                                            <option value="" disabled>Seleccione una dirección</option>
                                            <option v-for="direccion in arrayDireccion" :key="direccion.id_direc" :value="direccion.id_direc" v-text="direccion.calle_direc +' #'+ direccion.num_direc"></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Profesión</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nsoc_prof" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="email-input">Email</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nsoc_email" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Teléfono</b>
                                    <div class="col-md-9">
                                        <input type="number" v-model="nsoc_telefono" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="registrarSocio()">Guardar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

            <!--Inicio del modal actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modalActualizar}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-warning modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"> Actualizar datos de Socio/Usuario </h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                                <div v-show="errorSocio" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjSocio" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Número de Socio</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="soc_num_socio" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">RUT</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="u_rut" class="form-control negrita" placeholder="">                             
                                    </div>
                                    <b class="col-md-3 form-control-label" for="text-input">Contraseña de Usuario</b>
                                    <div class="col-md-9">
                                        <input type="password" v-model="u_password" class="form-control" placeholder="(*) Ingrese una nueva contraseña para este usuario">                             
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Primer Nombre</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="soc_nom_p" class="form-control negrita" placeholder="">                             
                                    </div>
                                    <b class="col-md-3 form-control-label" for="text-input">Segundo Nombre</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="soc_nom_s" class="form-control negrita" placeholder="">     
                                    </div>    
                                    <b class="col-md-3 form-control-label" for="text-input">Apellido Paterno</b>                    
                                    <div class="col-md-9">
                                        <input type="text" v-model="soc_ap_p" class="form-control negrita" placeholder="">                             
                                    </div>
                                    <b class="col-md-3 form-control-label" for="text-input">Apellido Materno</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="soc_ap_s" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Edad de Inscripción</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="soc_edad" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Dirección</b>
                                    <div class="col-md-9">
                                        <select class="form-control negrita" v-model="soc_id_direc">
                                            <option value="" disabled>Seleccione una dirección</option>
                                            <option v-for="direccion in arrayDireccion" :key="direccion.id_direc" :value="direccion.id_direc" v-text="direccion.calle_direc +' #'+ direccion.num_direc"></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Profesión</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="soc_prof" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="email-input">Email</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="soc_email" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Teléfono</b>
                                    <div class="col-md-9">
                                        <input type="text" v-model="soc_telefono" class="form-control negrita" placeholder="">                             
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Estado civil</b>
                                    <div class="col-md-9">
                                        <select class="form-control negrita" v-model="soc_id_ecivil">
                                            <option value="" disabled>Seleccione un tipo de estado civil</option>
                                            <option v-for="ecivil in arrayEcivil" :key="ecivil.id_ecivil" :value="ecivil.id_ecivil" v-text="ecivil.descrip"></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <b class="col-md-3 form-control-label" for="text-input">Rol familiar</b>
                                    <div class="col-md-9">
                                        <select class="form-control negrita" v-model="soc_id_rolfam">
                                            <option value="" disabled>Seleccione un tipo de rol familiar</option>
                                            <option v-for="rolfamiliar in arrayRolfamiliar" :key="rolfamiliar.id_rolfam" :value="rolfamiliar.id_rolfam" v-text="rolfamiliar.descrip"></option>
                                        </select>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" @click="actualizarSocio()">Actualizar</button>
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
                usuario_id : 0,

                u_rut : '',
                u_password : '',
                
                soc_nom_p : '',
                soc_nom_s : '',
                soc_ap_p : '',
                soc_ap_s : '',
                soc_num_socio : 0,
                soc_edad : '',
                soc_prof : '',
                soc_email : '',
                soc_telefono : '',

                soc_id_direc : 0,
                soc_id_ecivil : 0,
                soc_id_rolfam : 0,

                nuevosocio_id : 0,

                nsoc_rut : '',
                nsoc_password : '',
                nsoc_nom_p : '',
                nsoc_nom_s : '',
                nsoc_ap_p : '',
                nsoc_ap_s : '',
                nsoc_num_socio : 0,
                nsoc_edad : '',
                nsoc_prof : '',
                nsoc_email : '',
                nsoc_telefono : '',

                nsoc_id_direc : 0,

                arraySocio: [],
                arrayNuevosocio: [],

                modalRegistrar : 0,
                modalActualizar : 0,
                tituloModal : '',
                tipoAccion : 0,
                LargoNs : '',

                errorSocio : 0,
                errorMostrarMsjSocio : [],

                errorNuevosocio : 0,
                errorMostrarMsjNuevosocio : [],

                errorValidador : 0,
                errorMostrarMsjValidador : [],

                pagination : { 
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'num_socio',
                buscar : '',

                arrayNumSocio: [],

                arrayEcivil : [],
                arrayRolfamiliar : [],
                arrayDireccion : []
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
            largoNuevosocio(){
                let me = this;
                this.LargoNs = this.arrayNuevosocio.length;
            },
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
            listarNuevosocio(){
                let me = this;
                var url = '/nuevosocio';
                axios.get(url).then(function (response) {
                    var respuesta2 = response.data;
                    me.arrayNuevosocio = respuesta2.nuevosocio;
                    me.largoNuevosocio();
                })
                .catch(function (error) {
                    console.log(error);
                });
                
            },
            selectEcivil(){
                let me = this;
                var url = '/ecivil';
                axios.get(url).then(function (response) {
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
                    var respuesta = response.data;
                    me.arrayRolfamiliar = respuesta.rolfamiliar;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
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
            registrarSocio (){
                if(this.validarNuevosocio()){
                    return;
                }
                let me = this; 
                axios.post('/socio/registrar',{
                    'id_direc' : this.nsoc_id_direc,
                    'num_socio' : this.nsoc_num_socio,
                    'nom_p' : this.nsoc_nom_p,
                    'nom_s' : this.nsoc_nom_s,
                    'ap_p' : this.nsoc_ap_p,
                    'ap_s' : this.nsoc_ap_s,
                    'prof' : this.nsoc_prof,
                    'email' : this.nsoc_email,
                    'telefono' : this.nsoc_telefono,
                    'edad' : this.nsoc_edad,

                    'rut' : this.nsoc_rut,
                    'password' : this.nsoc_password

                })
                axios.put('/nuevosocio/eliminar',{
                    'id_nuevo' : this.nuevosocio_id
                        
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarSocio(1,'','');
                    me.listarNuevosocio(1,'','');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            actualizarSocio(){
                if(this.validarSocio()){
                    return;
                }
                let me = this; 
                axios.put('/socio/actualizar',{
                    'id_socio' : this.socio_id,
                    'id_direc' : this.soc_id_direc,
                    'id_ecivil' : this.soc_id_ecivil,
                    'id_rolfam' : this.soc_id_rolfam,
                    'num_socio' : this.soc_num_socio,
                    'nom_p' : this.soc_nom_p,
                    'nom_s' : this.soc_nom_s,
                    'ap_p' : this.soc_ap_p,
                    'ap_s' : this.soc_ap_s,
                    'prof' : this.soc_prof,
                    'email' : this.soc_email,
                    'telefono' : this.soc_telefono,
                    'edad' : this.soc_edad,

                    'id_user' : this.usuario_id,
                    'rut' : this.u_rut,
                    'password' : this.u_password

                }).then(function (response) {
                    me.cerrarModal();
                    me.listarSocio(1,'','');
                    me.listarNuevosocio(1,'','');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            borrarNuevosocio(id){
                swal({
                title: 'Esta seguro de eliminar esta solicitud?',
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
                        axios.put('/nuevosocio/eliminar',{
                            'id_nuevo' : id
                        }).then(function (response) {
                            me.listarNuevosocio();
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
            borrarSocio(id){
                swal({
                title: 'Esta seguro de eliminar este Socio?',
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
                        axios.put('/socio/eliminar',{
                            'id_socio' : id
                        }).then(function (response) {
                            me.listarSocio(1,'','');
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
            validarSocio(){
                this.errorSocio = 0;
                this.errorMostrarMsjSocio = [];

                if( !this.u_rut             ||
                    !this.u_password        ||  
                    !this.soc_nom_p         ||
                    !this.soc_nom_s         ||
                    !this.soc_ap_p          ||
                    !this.soc_ap_s          ||
                    this.soc_num_socio == 0 ||
                    !this.soc_edad          ||
                    !this.soc_prof          ||
                    !this.soc_email         ||
                    !this.soc_telefono      
                    //this.soc_id_direc  == 0 ||
                    //this.soc_id_ecivil == 0 ||
                    //this.soc_id_rolfam == 0  
                    ) this.errorMostrarMsjSocio.push("Ingrese la totalidad de los datos del Socio/Usuario");

                if( !this.u_rut ) this.errorMostrarMsjSocio.push("(*) Ingrese un Rut");
                if( !this.u_password ) this.errorMostrarMsjSocio.push("(*) Ingrese una nueva contraseña");
                if( !this.soc_nom_p ) this.errorMostrarMsjSocio.push("(*) Ingrese un primer nombre");
                if( !this.soc_nom_s ) this.errorMostrarMsjSocio.push("(*) Ingrese un segundo nombre");
                if( !this.soc_ap_p ) this.errorMostrarMsjSocio.push("(*) Ingrese un apellido paterno");
                if( !this.soc_ap_s ) this.errorMostrarMsjSocio.push("(*) Ingrese un apellido materno");
                if( this.soc_num_socio == 0 ) this.errorMostrarMsjSocio.push("(*) Ingrese un número de socio ");
                if( !this.soc_edad ) this.errorMostrarMsjSocio.push("(*) Ingrese una edad");
                if( !this.soc_prof ) this.errorMostrarMsjSocio.push("(*) Ingrese una profesion");
                if( !this.soc_email) this.errorMostrarMsjSocio.push("(*) Ingrese un email");
                if( !this.soc_telefono ) this.errorMostrarMsjSocio.push("(*) Ingrese un número de télefono");
                //if( this.soc_id_direc  == 0 ) this.errorMostrarMsjSocio.push("(*) Seleccione una dirección");
                //if( this.soc_id_ecivil == 0 ) this.errorMostrarMsjSocio.push("(*) Seleccione un estado civil válido");
                //if( this.soc_id_rolfam == 0 ) this.errorMostrarMsjSocio.push("(*) Seleccione un rol válido");
                
                if(this.errorMostrarMsjSocio.length) this.errorSocio = 1;

                return this.errorSocio;
            },
            validarNuevosocio(){
                this.errorNuevosocio = 0;
                this.errorValidador = 0;
                this.errorMostrarMsjNuevosocio = [];
                this.errorMostrarMsjValidador = [];

                this.arraySocio.forEach(ns => {
                    if(this.nsoc_num_socio == ns.num_socio){
                        this.errorMostrarMsjValidador.push("Número de socio existente, ingrese un nuevo número");
                    }
                });

                if( !this.nsoc_rut           ||
                    !this.nsoc_password      ||  
                    !this.nsoc_nom_p         ||
                    !this.nsoc_nom_s         ||
                    !this.nsoc_ap_p          ||
                    !this.nsoc_ap_s          ||
                    this.nsoc_num_socio == 0 ||
                    !this.nsoc_edad          ||
                    !this.nsoc_prof          ||
                    !this.nsoc_email         ||
                    !this.nsoc_telefono      
                    //this.soc_id_direc  == 0 ||
                    //this.soc_id_ecivil == 0 ||
                    //this.soc_id_rolfam == 0  
                    ) this.errorMostrarMsjNuevosocio.push("Ingrese la totalidad de los datos del nuevo socio");

                if( !this.nsoc_rut ) this.errorMostrarMsjNuevosocio.push("(*) Ingrese un Rut");
                if( !this.nsoc_password ) this.errorMostrarMsjNuevosocio.push("(*) Ingrese una contraseña");
                if( !this.nsoc_nom_p ) this.errorMostrarMsjNuevosocio.push("(*) Ingrese un primer nombre");
                if( !this.nsoc_nom_s ) this.errorMostrarMsjNuevosocio.push("(*) Ingrese un segundo nombre");
                if( !this.nsoc_ap_p ) this.errorMostrarMsjNuevosocio.push("(*) Ingrese un apellido paterno");
                if( !this.nsoc_ap_s ) this.errorMostrarMsjNuevosocio.push("(*) Ingrese un apellido materno");
                if( this.nsoc_num_socio == 0 ) this.errorMostrarMsjNuevosocio.push("(*) Ingrese un número de socio");
                if( !this.nsoc_edad ) this.errorMostrarMsjNuevosocio.push("(*) Ingrese una edad");
                if( !this.nsoc_prof ) this.errorMostrarMsjSocio.push("(*) Ingrese una profesion");
                if( !this.nsoc_email) this.errorMostrarMsjSocio.push("(*) Ingrese un email");
                if( !this.nsoc_telefono ) this.errorMostrarMsjNuevosocio.push("(*) Ingrese un número de télefono");
                
                if(this.errorMostrarMsjNuevosocio.length) this.errorNuevosocio = 1;
                if(this.errorMostrarMsjValidador.length) this.errorValidador = 1;

                return this.errorNuevosocio, this.errorValidador;
            },
            cambiarPagina(page,buscar,criterio){
                let me =this;
                me.pagination.current_page = page;
                me.listarSocio(page,buscar,criterio);
            },
            cerrarModal(){
                this.modalRegistrar = 0;
                this.modalActualizar = 0;
                this.tituloModal = '';
                this.errorMostrarMsjSocio = [];
                this.errorMostrarMsjNuevosocio = [];
                this.errorMostrarMsjValidador = [];

                this.socio_id = 0,
                this.usuario_id = 0,
                this.u_rut = '';
                this.u_password = '';              
                this.soc_nom_p = '';
                this.soc_nom_s = '';
                this.soc_ap_p = '';
                this.soc_ap_s = '';
                this.soc_num_socio = 0;
                this.soc_edad = '';
                this.soc_prof = '';
                this.soc_email = '';
                this.soc_telefono = '';
                this.soc_id_direc = 0;
                this.soc_id_ecivil = 0;
                this.soc_id_rolfam = 0;

                this.nuevosocio_id = 0;

                this.nsoc_rut = '';
                this.nsoc_password = '';
                this.nsoc_nom_p = '';
                this.nsoc_nom_s = '';
                this.nsoc_ap_p = '';
                this.nsoc_ap_s = '';
                this.nsoc_num_socio = 0;
                this.nsoc_edad = '';
                this.nsoc_prof = '';
                this.nsoc_email = '';
                this.nsoc_telefono = '';

                this.nsoc_id_direc = 0;

            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case 'socio':
                    {
                        switch(accion)
                        {
                            case 'registrar' :
                            {
                                this.modalRegistrar = 1;
                                //this.tipoAccion = 1;
                                this.nsoc_rut = data ['rut'];
                                this.nsoc_password = data ['password'];
                                this.nuevosocio_id = data ['id_nuevo'];
                                this.nsoc_id_direc = data ['id_direc'];
                                this.nsoc_num_socio = '';
                                this.nsoc_nom_p = data ['nom_p'];
                                this.nsoc_nom_s = data ['nom_s'];
                                this.nsoc_ap_p = data ['ap_p'];
                                this.nsoc_ap_s = data ['ap_s'];
                                this.nsoc_prof = data ['prof'];
                                this.nsoc_email = data ['email'];
                                this.nsoc_telefono = data ['telefono'];
                                this.nsoc_edad = data ['edad'];
                                break;
                            }
                            case 'actualizar' :
                            {
                                this.modalActualizar = 1;
                                //this.tipoAccion = 1;
                                this.usuario_id = data ['id_user'];
                                this.u_rut = data ['rut'];
                                this.u_password = data ['password'];

                                this.socio_id = data ['id_socio'];
                                this.soc_id_direc = data ['s_direccion'];
                                this.soc_id_ecivil = data ['id_ecivil'];
                                this.soc_id_rolfam = data ['id_rolfam'];
                                this.soc_num_socio = data ['num_socio'];
                                this.soc_nom_p = data ['nom_p'];
                                this.soc_nom_s = data ['nom_s'];
                                this.soc_ap_p = data ['ap_p'];
                                this.soc_ap_s = data ['ap_s'];
                                this.soc_prof = data ['prof'];
                                this.soc_email = data ['email'];
                                this.soc_telefono = data ['telefono'];
                                this.soc_edad = data ['edad'];                      
                                break;
                            }
                        }
                    }
                }
                this.selectDireccion();
                this.selectRolfamiliar();
                this.selectEcivil();
            }
    },
    mounted() {
        this.listarNuevosocio();
        this.listarSocio(1,this.buscar,this.criterio);
        //this.largoNuevosocio();
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
    .negrita{
        color: grey !important;
        font-weight: bold;
    }
</style>



