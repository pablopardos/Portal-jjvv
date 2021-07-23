<template>
            <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">

                <div v-if="solicitud==1" class="card">
                    <div class="card-header" style="color:#D2691E">
                        <h5 class="fa fa-align-justify">FORMULARIO DE REGISTRO PARA NUEVO SOCIO/USUARIO</h5>
                    </div>
                    <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form-group row">
                            <b class="col-3 form-control-label" for="text-input">RUT</b>
                            <div class="col-9">
                                <input type="text" v-model="rut" class="form-control" placeholder="">                           
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Primer Nombre</b>
                            <div class="col-md-9">
                                <input type="text" v-model="nom_p" class="form-control" placeholder="">                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Segundo Nombre</b>
                            <div class="col-md-9">
                                <input type="text" v-model="nom_s" class="form-control" placeholder="">                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Apellido Paterno</b>
                            <div class="col-md-9">
                                <input type="text" v-model="ap_p" class="form-control" placeholder="">                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Apellido Materno</b>
                            <div class="col-md-9">
                                <input type="text" v-model="ap_s" class="form-control" placeholder="">                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Edad actual</b>
                            <div class="col-md-9">
                                <input type="text" v-model="edad" class="form-control" placeholder="">                                 
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Dirección</b>
                            <div class="col-md-9">
                                <select class="form-control" v-model="id_direc">
                                    <option value="" disabled>Seleccione</option>
                                    <option v-for="direccion in arrayDireccion" :key="direccion.id_direc" :value="direccion.id_direc" v-text="direccion.calle_direc +' #'+ direccion.num_direc"></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Profesión</b>
                            <div class="col-md-9">
                                <input type="text" v-model="prof" class="form-control" placeholder="">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="email-input">Email</b>
                            <div class="col-md-9">
                                <input type="text" v-model="email" class="form-control" placeholder="">                                 
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Teléfono</b>
                            <div class="col-md-9">
                                <input type="text" v-model="telefono" class="form-control" placeholder="">                                 
                            </div>
                        </div>

                        <div class="form-group row">
                            <b class="col-md-3 form-control-label" for="text-input">Contraseña de usuario</b>
                            <div class="col-md-9">
                                <input type="text" v-model="password" class="form-control" placeholder="">                                 
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" @click="registrarNuevo()">Enviar solicitud</button>
                        </div>

                    </form>
                    </div>
                </div>

                <div v-else class="card">
                    <div class="card-header">
                        <h3 class="fa fa-align-justify">SOLICITUD ENVIADA, POR FAVOR CIERRE ESTA VENTANA.</h3>
                    </div>
                </div>

            </div>
        </main>
</template>

<script>
    export default {
         data(){
            return{
                solicitud : 1,
                id_direc : '',
                rut : '',
                password: '',
                nom_p : '',
                nom_s : '',
                ap_p : '',
                ap_s : '',
                prof : '',
                email : '',
                telefono : '',
                edad : '',
                arrayDireccion : [],
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
            registrarNuevo (){
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
                        axios.post('/nuevosocio/registrar',{
                            'id_direc' : this.id_direc,
                            'rut' : this.rut,
                            'password' : this.password,
                            'nom_p' : this.nom_p,
                            'nom_s' : this.nom_s,
                            'ap_p' : this.ap_p,
                            'ap_s' : this.ap_s,
                            'prof' : this.prof,
                            'email' : this.email,
                            'telefono' : this.telefono,
                            'edad' : this.edad   
                        }).then(function (response) {
                            this.solicitud = 0,
                            //HACER ALGO PARA CERRAR LA VENTANA
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



