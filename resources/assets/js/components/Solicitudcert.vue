<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Formulario cerificado residencia -->

                <div v-if="solicitud==0" class="card">
                    <div class="card-header" style="color:#0000FF">
                        <h6 class="fa fa-align-justify">Tipo de certificado</h6>
                    </div>
                    <div class="card-body" >
                        <div class="form-group row">
                            <input class="col-1" type="radio" :value=1 v-model="tipo" @click="igualarPropio()">      
                            <b class="col-5 form-control-label">Certificado Residencia Propio</b>  
                            <input class="col-1" type="radio" :value=2 v-model="tipo" @click="igualarFamiliar()">      
                            <b class="col-5 form-control-label">Certificado Residencia de Familiar domiciliado</b>                      
                        </div>
                    </div>
                </div>

                <div v-else class="card">
                    <div class="card-header">
                        <h3 class="fa fa-align-justify">SOLICITUD DE CERTIFICADO EN PROCESO, POR FAVOR VUELVA MÁS TARDE.</h3>
                    </div>
                </div>

                <div v-if="tipo==1" class="card">
                    <div class="card-header" style="color:#0000FF">
                        <h6 class="fa fa-align-justify">Datos del certificado</h6>
                    </div>
                    <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Dirección</b>
                            <div class="col-md-9">
                                <i class="negrita">{{calle}} # {{numero}}</i>                              
                            </div>
                        </div>

                        <div v-show="errorCertificado" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjCert" :key="error" v-text="error">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">RUT</b>
                            <div class="col-md-9">
                                <i class="negrita">{{rut}}</i>                          
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Nombre completo</b>
                            <div class="col-md-9">
                                <i class="negrita">{{nombre}}</i>                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Motivo de la solicitud</b>
                            <div class="col-md-9">
                                <input type="text" v-model="asunto" class="form-control" placeholder="(*) Ingrese el motivo del certificado">                             
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="registrarCertificado()" >Enviar solicitud</button>
                        </div>

                    </form>
                    </div>
                </div>

                <div v-if="tipo==2" class="card">
                    <div class="card-header" style="color:#0000FF">
                        <h6 class="fa fa-align-justify">Datos del certificado</h6>
                    </div>
                    <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Dirección</b>
                            <div class="col-md-9">
                                <i class="negrita">{{calle}} # {{numero}}</i>                              
                            </div>
                        </div>

                        <div v-show="errorCertificado" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjCert" :key="error" v-text="error">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">RUT</b>
                            <div class="col-md-9">
                                <input type="text" v-model="rut" class="form-control" placeholder="(*) Ingrese el RUT del solicitante">                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Nombre completo</b>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" class="form-control" placeholder="(*) Ingrese el nombre completo del solicitante">                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Motivo de la solicitud</b>
                            <div class="col-md-9">
                                <input type="text" v-model="asunto" class="form-control" placeholder="(*) Ingrese el motivo del certificado">                             
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="registrarCertificado()" >Enviar solicitud</button>
                        </div>

                    </form>
                    </div>
                </div>
                <!-- Fin formulario certificado residencia -->
                
            </div>

        </main>
</template>

<script>
    export default {
         data(){
            return{
                tipo : 0,
                rut : '',
                nombre : '',
                asunto : '',

                usuario_id : 0,
                rutPropio : '',
                solicitud : 0,

                id_direc : 0,
                calle : '',
                numero : 0,

                socio_id : 0,
                nom_p : '',
                nom_s : '',
                ap_p : '',
                ap_s : '',

                arrayDireccion : [],

                modalActualizar : 0,

                errorCertificado : 0,
                errorMostrarMsjCert : [],
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
            igualarPropio(){
                this.nombre = this.nom_p + ' ' + this.nom_s + ' ' + this.ap_p + ' ' + this.ap_s;
                this.rut = this.rutPropio;
                this.errorMostrarMsjCert = []
            },
            igualarFamiliar(){
                this.nombre = '';
                this.rut = '';
                this.errorMostrarMsjCert = []
            },
            selectUser(){
                let me = this;
                axios.get('/userlogin').then(function (response) {
                    var respuesta1 = response.data;
                    me.usuario_id = respuesta1 ['id_user'];
                    me.rutPropio = respuesta1 ['rut'];
                    me.solicitud = respuesta1 ['solicitud'];
                })
                .catch(function (error) {
                    console.log(error);
                });

                axios.get('/sociologin').then(function (response) {
                    var respuesta2 = response.data;
                    me.socio_id = respuesta2 ['id_socio'] ;
                    me.id_direc = respuesta2 ['id_direc'] ;
                    me.nom_p = respuesta2 ['nom_p'] ;
                    me.nom_s = respuesta2 ['nom_s'] ;
                    me.ap_p = respuesta2 ['ap_p'] ;
                    me.ap_s = respuesta2 ['ap_s'] ;
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
                    }
                });
            },
            selectDireccion(){
                let me = this;
                var url = '/direccion';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayDireccion = respuesta.direccion;
                    //console.log(me.arrayDireccion);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            validarDatos(){
                this.errorCertificado = 0;
                this.errorMostrarMsjCert = [];

                if( !this.rut        ||  
                    !this.nombre          ||
                    !this.asunto  
                    ) this.errorMostrarMsjCert.push("Ingrese la totalidad de los datos");

                if( !this.rut ) this.errorMostrarMsjCert.push("(*) Ingrese RUT para la solicitud");
                if( !this.nombre ) this.errorMostrarMsjCert.push("(*) Ingrese un nombre para la solicitud");
                if( !this.asunto ) this.errorMostrarMsjCert.push("(*) Ingrese un motivo de la solicitud");
                
                if(this.errorMostrarMsjCert.length) this.errorCertificado = 1;

                return this.errorCertificado;
            },
            registrarCertificado (){
                if(this.validarDatos()){
                    return;
                }
                
                swal({
                title: 'Esta seguro que desea enviar esta solicitud?',
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
                        axios.post('/certresidencia/registrar',{
                            'id_tipocert' : this.tipo,
                            'rut' : this.rut,
                            'nombre' : this.nombre,
                            'asunto' : this.asunto   
                        })
                        axios.put('/user/acsolicitud',{
                            'id_user' : this.usuario_id 

                        }).then(function (response) {
                            me.selectUser();
                            me.tipo = 0,
                            swal(
                            'Solicitud enviada!',
                            'Muchas gracias.',
                            'success'
                            )
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    
                }
                }) 
            }
    },
    mounted() {
        this.selectDireccion();
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
    .fondo{
        background-color: red !important;
    }
    .negrita{
        color: grey !important;
        font-weight: bold;
    }
</style>



