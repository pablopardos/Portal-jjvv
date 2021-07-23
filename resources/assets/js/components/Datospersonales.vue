<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
               
            </ol>
            <div class="container-fluid">
                <!-- Formulario de datos personales -->
                <div class="card">
                    <div class="card-header" style="color:#D2691E">
                        <h5 class="fa fa-align-justify">DATOS PERSONALES</h5>
                    </div>
                    <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Número de Socio</b>
                            <div class="col-md-9">
                                <i>{{num_socio}}</i>                           
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-3 form-control-label" for="text-input">RUT</b>
                            <div class="col-9">
                                <i>{{rut}}</i>                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Nombre Completo</b>
                            <div class="col-md-9">
                                <i>{{nom_p}} {{nom_s}} {{ap_p}} {{ap_s}}</i>                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Edad de Inscripción</b>
                            <div class="col-md-9">
                                <i>{{edad}} años</i>                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Dirección</b>
                            <div class="col-md-9">
                                <i>{{calle}} # {{numero}}</i>                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Profesión</b>
                            <div class="col-md-9">
                                <i>{{prof}}</i>                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="email-input">Email</b>
                            <div class="col-md-9">
                                <i>{{email}}</i>                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Teléfono</b>
                            <div class="col-md-9">
                                <i>{{telefono}}</i>                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Estado civil</b>
                            <div class="col-md-9">
                                <i>{{estadocivil}}</i>                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Rol familiar</b>
                            <div class="col-md-9">
                                <i>{{rolfamiliar}}</i>                                
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" @click="abrirModal('usuario','actualizar')">Editar</button>
                        </div>

                    </form>
                    </div>
                </div>
                <!-- Fin formulario de Estado de pago -->
                <div class="card">
                    <div class="card-header" style="color:#D2691E">
                        <h5 class="fa fa-align-justify">ESTADO DE PAGO</h5>
                    </div>
                    <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Estado de pago de cuotas sociales</b>
                            <div class="col-md-9">
                                <div v-if="ep">
                                    <span class="badge badge-success">Al dia</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Meses sin pagar</span>
                                </div>                             
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <!-- Fin formulario de Estado de pago -->
            </div>

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

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Nombre Completo</b>
                            <div class="col-md-9">
                                <i class="negrita">{{nom_p}} {{nom_s}} {{ap_p}} {{ap_s}}</i>                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Dirección</b>
                            <div class="col-md-9">
                                <i class="negrita">{{calle}} # {{numero}}</i>                              
                            </div>
                        </div>

                        <div v-show="errorUsuario" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjUsuario" :key="error" v-text="error">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Nueva Contraseña</b>
                            <div class="col-md-9">
                                <input type="text" v-model="password" class="form-control" placeholder="(*) Ingrese una nueva contraseña">                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Profesión</b>
                            <div class="col-md-9">
                                <input type="text" v-model="prof" class="form-control negrita" placeholder="">                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="email-input">Email</b>
                            <div class="col-md-9">
                                <input type="text" v-model="email" class="form-control negrita" placeholder="">                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Teléfono</b>
                            <div class="col-md-9">
                                <input type="text" v-model="telefono" class="form-control negrita" placeholder="">                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Estado civil</b>
                            <div class="col-md-9">
                                <select class="form-control negrita" v-model="id_ecivil">
                                    <option value="" disabled>Seleccione</option>
                                    <option v-for="ecivil in arrayEcivil" :key="ecivil.id_ecivil" :value="ecivil.id_ecivil" v-text="ecivil.descrip"></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Rol familiar</b>
                            <div class="col-md-9">
                                <select class="form-control negrita" v-model="id_rolfam">
                                    <option value="" disabled>Seleccione</option>
                                    <option v-for="rolfamiliar in arrayRolfamiliar" :key="rolfamiliar.id_rolfam" :value="rolfamiliar.id_rolfam" v-text="rolfamiliar.descrip"></option>
                                </select>
                            </div>
                        </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-warning" @click="actualizarDatos()">Actualizar</button>
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
                usuario_id : 0,
                rut : '',
                password: '',

                id_ecivil : 0,
                estadocivil : '',

                id_rolfam : 0,
                rolfamiliar : '',

                id_direc : 0,
                calle : '',
                numero : 0,

                socio_id : 0,
                num_socio : 0,
                nom_p : '',
                nom_s : '',
                ap_p : '',
                ap_s : '',
                prof : '',
                email : '',
                telefono : '',
                edad : '',

                ep : 0,
                año : 2021,

                arrayEcivil : [],
                arrayRolfamiliar : [],
                arrayDireccion : [],
                arrayEstadopago : [],

                modalActualizar : 0,

                errorUsuario : 0,
                errorMostrarMsjUsuario : [],
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
            selectUser(){
                let me = this;
                axios.get('/userlogin').then(function (response) {
                    var respuesta1 = response.data;
                    me.usuario_id = respuesta1 ['id_user'];
                    me.rut = respuesta1 ['rut'];
                })
                axios.get('/sociologin').then(function (response) {
                    var respuesta2 = response.data;
                    me.socio_id = respuesta2 ['id_socio'] ;
                    me.id_ecivil = respuesta2 ['id_ecivil'] ;
                    me.id_rolfam = respuesta2 ['id_rolfam'] ;
                    me.id_direc = respuesta2 ['id_direc'] ;
                    me.num_socio = respuesta2 ['num_socio'] ;
                    me.nom_p = respuesta2 ['nom_p'] ;
                    me.nom_s = respuesta2 ['nom_s'] ;
                    me.ap_p = respuesta2 ['ap_p'] ;
                    me.ap_s = respuesta2 ['ap_s'] ;
                    me.prof = respuesta2 ['prof'] ;
                    me.email = respuesta2 ['email'] ;
                    me.telefono = respuesta2 ['telefono'] ;
                    me.edad = respuesta2 ['edad'] ;
                }).then(function (response) {
                    me.datosUsuario();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            datosUsuario(){
                this.arrayDireccion.forEach(d => {
                    if(d.id_direc==this.id_direc){
                        this.calle = d ['calle_direc'] ;
                        this.numero = d ['num_direc'] ;
                        console.log(this.calle);
                    }
                });
                this.arrayEcivil.forEach(ec => {
                    if(ec.id_ecivil==this.id_ecivil){
                        this.estadocivil = ec ['descrip'] ;
                    }
                });
                this.arrayRolfamiliar.forEach(rf => {
                    if(rf.id_rolfam==this.id_rolfam){
                        this.rolfamiliar = rf ['descrip'] ;
                    }
                });
                this.arrayEstadopago.forEach(recorre => {
                    if(recorre.id_direc==this.id_direc){
                        if(recorre.id_year==this.año){
                            this.ep = recorre ['estadopago'] ;
                        }
                    }
                });
            },
            selectEstadopago(){
                let me = this;
                var url = '/estadopago/consulta';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEstadopago = respuesta;
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
            actualizarDatos(){
                if(this.validarDatos()){
                    return;
                }
                let me = this; 
                axios.put('/user/actualizar',{
                    'id_socio' : this.socio_id,
                    'id_ecivil' : this.id_ecivil,
                    'id_rolfam' : this.id_rolfam,
                    'prof' : this.prof,
                    'email' : this.email,
                    'telefono' : this.telefono,

                    'id_user' : this.usuario_id,
                    'password' : this.password

                }).then(function (response) {
                    me.cerrarModal();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            validarDatos(){
                this.errorUsuario = 0;
                this.errorMostrarMsjUsuario = [];

                if( !this.password        ||  
                    !this.edad          ||
                    !this.prof          ||
                    !this.email         ||
                    !this.telefono      
                    ) this.errorMostrarMsjUsuario.push("Ingrese la totalidad de los datos del Socio/Usuario");

                if( !this.password ) this.errorMostrarMsjUsuario.push("(*) Ingrese una nueva contraseña");
                if( !this.edad ) this.errorMostrarMsjUsuario.push("(*) Ingrese una edad");
                if( !this.prof ) this.errorMostrarMsjUsuario.push("(*) Ingrese una profesion");
                if( !this.email) this.errorMostrarMsjUsuario.push("(*) Ingrese un email");
                if( !this.telefono ) this.errorMostrarMsjUsuario.push("(*) Ingrese un número de télefono");
                
                if(this.errorMostrarMsjUsuario.length) this.errorUsuario = 1;

                return this.errorUsuario;
            },
            cerrarModal(){
                this.modalActualizar = 0;
                this.errorMostrarMsjUsuario = [];

                this.usuario_id = 0;
                this.rut = '';
                this.password= '';

                this.id_ecivil = 0;
                this.estadocivil = '';

                this.id_rolfam = 0;
                this.rolfamiliar = '';

                this.id_direc = 0;
                this.calle = '';
                this.numero = 0;

                this.socio_id = 0;
                this.num_socio = 0;
                this.nom_p = '';
                this.nom_s = '';
                this.ap_p = '';
                this.ap_s = '';
                this.prof = '';
                this.email = '';
                this.telefono = '';
                this.edad = '';

                this.selectUser();
            },
            abrirModal(modelo, accion){
                switch(modelo){
                    case 'usuario':
                    {
                        switch(accion)
                        {
                            case 'actualizar' :
                            {
                                this.modalActualizar = 1;                   
                                break;
                            }
                        }
                    }
                }
            }
    },
    mounted() {
        this.selectDireccion();
        this.selectRolfamiliar();
        this.selectEstadopago();
        this.selectEcivil();
        this.selectUser();
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



