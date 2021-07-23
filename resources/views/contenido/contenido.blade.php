    @extends('principal')
    @section('contenido')

    @if(Auth::check())
        @if (Auth::user()->id_perm == 1)
                <template v-if="menu==0">
                    <main class="main">
                        <!-- Breadcrumb -->
                        <ol class="breadcrumb">
                            
                        </ol>
                        <div class="container-fluid">
                            <h3 class="text-center">OPCIONES DE ACCESO RÁPIDO</h3>
                            <div class="row">
                                
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <button @click="menu=3" class="btn-lg btn-light" style="color:#D2691E; font-weight: bold;" type="button"
                                            > Administrar - Datos personales</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <button @click="menu=6" class="btn-lg btn-light" style="color:#0000FF; font-weight: bold;" type="button"
                                            > Solicitar - Certificado Residencia</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <button @click="menu=7" class="btn-lg btn-light" style="color:#8B008B; font-weight: bold;" type="button"
                                            > Visualizar - Comunicados directiva</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>        
                    </main>
                </template>

                <template v-if="menu==3">
                    <datospersonales></datospersonales>
                </template>

                <template v-if="menu==6">
                    <solicitudcert></solicitudcert>
                </template>

                <template v-if="menu==7">
                    <publicacion2></publicacion2>
                </template>

                <template v-if="menu==8">
                    <ns></ns>
                </template>
        @elseif (Auth::user()->id_perm == 2)
                <template v-if="menu==0">
                    <main class="main">
                        <!-- Breadcrumb -->
                        <ol class="breadcrumb">
                            
                        </ol>
                        <div class="container-fluid">
                            <h3 class="text-center">OPCIONES DE ACCESO RÁPIDO</h3>
                            <div class="row">
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <button @click="menu=1" class="btn-lg btn-light" style="color:#FF8C00; font-weight: bold;" type="button"
                                            > Administrar - Socios/Usuarios</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <button @click="menu=3" class="btn-lg btn-light" style="color:#D2691E; font-weight: bold;" type="button"
                                            > Administrar - Datos personales</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <button @click="menu=2" class="btn-lg btn-light" style="color:#00008B; font-weight: bold;" type="button"
                                            > Administrar - Solicitudes Cert.Res.</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <button @click="menu=6" class="btn-lg btn-light" style="color:#0000FF; font-weight: bold;" type="button"
                                            > Solicitar - Certificado Residencia</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <button @click="menu=4" class="btn-lg btn-light" style="color:#008000; font-weight: bold;" type="button"
                                            > Administrar - Pagos Cuotas Soc.</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <button @click="menu=5" class="btn-lg btn-light" style="color:#8B008B; font-weight: bold;" type="button"
                                            > Administrar - Comunicados directiva</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </main>
                </template>

                <template v-if="menu==1">
                    <socio></socio>
                </template>

                <template v-if="menu==2">
                    <certresidencia></certresidencia>
                </template>

                <template v-if="menu==3">
                    <datospersonales></datospersonales>
                </template>

                <template v-if="menu==4">
                    <cuotassociales></cuotassociales>
                </template>

                <template v-if="menu==5">
                    <publicacion></publicacion>
                </template>

                <template v-if="menu==6">
                    <solicitudcert></solicitudcert>
                </template>

                <template v-if="menu==7">
                    <publicacion2></publicacion2>
                </template>

                <template v-if="menu==8">
                    <ns></ns>
                </template>
        @else

        @endif

    @endif

    @endsection