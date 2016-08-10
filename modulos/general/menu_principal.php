<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>CR</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b style="font-size:14px;">CLÍNICA CRISTO REDENTOR</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Navegación</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <!-- Messages -->
            <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <span class="label label-success">3</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">Tienes 3 mensajes</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li><!-- start message -->
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="../../img/doctor.jpg" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                        Equipo de soporte
                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Problemas con la pagina web</p>
                                </a>
                            </li><!-- end message -->
                            <li>
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="../../img/doctor.jpg" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                        Contador
                                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                    </h4>
                                    <p>Necesito configuraciones</p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="../../img/doctor.jpg" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                        Desarrolladores
                                        <small><i class="fa fa-clock-o"></i> Today</small>
                                    </h4>
                                    <p>Nuevo team</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer"><a href="#">Ver todos los mensajes</a></li>
                </ul>
            </li>

            <?php
            require '../bd/bd_conexion.php';
            $query = "SELECT 1 FROM permissions P INNER JOIN items I ON P.item_id=I.id WHERE I.file='asignar_permisos' AND P.username='".$_SESSION['usuario']."'";
            $result_set = mysqli_query($con, $query);
            if (mysqli_num_rows($result_set) > 0) {
            ?>

            <!-- Notifications -->
            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning">2</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">Tienes 2 notificaciones</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li>
                                <a href="../admin/asignar_permisos.php">
                                    <i class="fa fa-users text-aqua"></i> Nuevo registro: Juan Ramos
                                </a>
                            </li>
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-warning text-yellow"></i> 2 citas canceladas-->
<!--                                </a>-->
<!--                            </li>-->
                        </ul>
                    </li>
                </ul>
            </li>
            <?php } ?>

            <!-- Tasks -->
            <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-danger">4</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">Tienes 4 tareas</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Design some buttons
                                        <small class="pull-right">20%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                             role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                             aria-valuemax="100">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Create a nice theme
                                        <small class="pull-right">40%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div class="progress-bar progress-bar-green" style="width: 40%"
                                             role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                             aria-valuemax="100">
                                            <span class="sr-only">40% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Some task I need to do
                                        <small class="pull-right">60%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                            <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        Make beautiful transitions
                                        <small class="pull-right">80%</small>
                                    </h3>
                                    <div class="progress xs">
                                        <div class="progress-bar progress-bar-yellow" style="width: 80%"
                                             role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                             aria-valuemax="100">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#">Ver todas las tareas</a>
                    </li>
                </ul>
            </li>

            <!-- User Account -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="../../img/doctor.JPG" class="user-image" alt="User Image">
              <span class="hidden-xs">
                <?= $full_name ?>
              </span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="../../img/doctor.JPG" class="img-circle" alt="User Image">
                        <p>
                            <?= $full_name ?>
                            <small>Administrador</small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="../general/perfil.php" class="btn btn-default btn-flat">Perfil</a>
                        </div>
                        <div class="pull-right">
                            <a href="../bd/bd_cerrar_sesion.php" class="btn btn-default btn-flat">Salir</a>
                        </div>
                    </li>
                </ul>
            </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
</header>