<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click= "menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Dirección JJ.VV
                    </li>


                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-list"></i> Administrar</a>
                        <ul class="nav-dropdown-items">
                            <li @click= "menu=1" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-people"></i> Socios/Usuarios</a>
                            </li>
                            <li @click= "menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-doc"></i> Solicitudes cert.res.</a>
                            </li>
                            <li @click= "menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-speech"></i> Comunicados direc.</a>
                            </li>
                            <li @click= "menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-grid"></i> Pagos cuotas soc.</a>
                            </li>
                        </ul>
                    </li>

                    <li @click= "menu=3" class="nav-link nav-dropdown" href="#">
                        <i class="icon-user"></i> Datos personales
                    </li>

                    <li @click= "menu=6" class="nav-link nav-dropdown" href="#">
                        <i class="icon-grid"></i> Solicitar cert.res.
                    </li>

                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>