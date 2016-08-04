  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <div class="user-panel">
        <div class="pull-left image">
          <img src="../../img/doctor.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info" style="color:#245573 !important">
          <p><?php echo $usuario; ?></p>
          <a href="#" style="color:#245573 !important"><i class="fa fa-circle text-success"></i>Online</a>
        </div>
    </div>
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu principal</li>
        <li class="treeview" id="menu_documentos">
          <a href="#">
            <i class="fa fa-chevron-down"></i>
            <span>Documentos</span>
            <ul class="treeview-menu">
              <li class="treeview" id="m_doc_control">
                <a href="../documentos/control_documentos.php">
                  <span>Control de documentos</span>
                </a>
              </li>
              <li class="treeview" id="m_registro_requerido">
                <a href="../documentos/registro_requerido.php">
                  <span>Formatos del SG</span>
                </a>
              </li>
              <li class="treeview" id="m_doc_registros">
                <a href="../documentos/control_registros.php">
                  <span>Registros generados</span>
                </a>
              </li>
            </ul>
          </a>
        </li>
        <li class="treeview" id="menu_citas">
          <a href="#">
            <i class="fa fa-chevron-down"></i>
            <span>Gestión de citas</span>
            <ul class="treeview-menu">
              <li class="treeview" id="m_listar_citas">
                <a href="../citas/listar_citas.php">
                  <span>Listar citas</span>
                </a>
              </li>
              <li class="treeview" id="m_registrar_cita">
                <a href="../citas/registrar_cita_medica.php">
                  <span>Registrar cita médica</span>
                </a>
              </li>
              <li class="treeview" id="m_registrar_lab">
                <a href="../citas/registrar_cita_laboratorio.php">
                  <span>Registrar cita laboratorio</span>
                </a>
              </li>
              <li class="treeview" id="m_registrar_lab">
                <a href="../citas/atender_cita_medica.php">
                  <span>Atender cita médica</span>
                </a>
              </li>
              <li class="treeview" id="m_registrar_lab">
                <a href="../citas/atender_cita_laboratorio.php">
                  <span>Atender cita laboratorio</span>
                </a>
              </li>
            </ul>
          </a>
        </li>
        <li class="treeview" id="menu_facturacion">
          <a href="#">
            <i class="fa fa-chevron-down"></i>
            <span>Facturación</span>
            <ul class="treeview-menu">
              <li class="treeview" id="m_listado_facturas">
                <a href="../facturacion/listado_facturas.php">
                  <span>Listado de facturas / recibos</span>
                </a>
              </li>
              <li class="treeview" id="m_pendiente_facturar">
                <a href="../facturacion/pendiente_facturar.php">
                  <span>Pendientes de facturar</span>
                </a>
              </li>
            </ul>
          </a>
        </li>
        <li class="treeview" id="menu_clinica">
          <a href="#">
            <i class="fa fa-chevron-down"></i>
            <span>Clínica</span>
            <ul class="treeview-menu">
              <li class="treeview" id="m_clinica_especialidades">
                <a href="../clinica/especialidades.php">
                  <span>Especialidades médicas</span>
                </a>
              </li>
              <li class="treeview" id="m_clinica_servicios">
                <a href="../clinica/servicios.php">
                  <span>Servicios médicos</span>
                </a>
              </li>
            </ul>
          </a>
        </li>
        <li class="treeview" id="menu_pacientes">
          <a href="#">
            <i class="fa fa-chevron-down"></i>
            <span>Pacientes</span>
            <ul class="treeview-menu">
              <li class="treeview" id="m_listado_pacientes">
                <a href="../pacientes/listado_pacientes.php">
                  <span>Listado de Pacientes</span>
                </a>
              </li>
              <li class="treeview" id="m_nuevo_paciente">
                <a href="../pacientes/nuevo_paciente.php">
                  <span>Nuevo Paciente</span>
                </a>
              </li>
            </ul>
          </a>
        </li>
        <li class="treeview" id="menu_planilla">
          <a href="#">
            <i class="fa fa-chevron-down"></i>
            <span>Personal</span>
            <ul class="treeview-menu">  
              <li class="treeview" id="m_planilla_personal">
                <a href="../planilla/personal.php">
                  <span>Personal</span>
                </a>
              </li>
              <li class="treeview" id="m_asignar_especialidades">
                <a href="../planilla/asignar_especialidades.php">
                  <span>Asignar especialidades</span>
                </a>
              </li>
            </ul>
          </a>
        </li>
        <li class="treeview" id="menu_ventas">
          <a href="#">
            <i class="fa fa-chevron-down"></i>
            <span>Ventas</span>
            <ul class="treeview-menu">
              <li class="treeview" id="m_nuevo_venta">
                <a href="../ventas/nuevo_venta.php">
                  <span>Nueva venta</span>
                </a>
              </li>
              <li class="treeview" id="m_listado_ventas">
                <a href="../ventas/listado_ventas.php">
                  <span>Listado de  ventas</span>
                </a>
              </li>
              <li class="treeview" id="m_nuevo_cliente">
                <a href="../ventas/nuevo_cliente.php">
                  <span>Nuevo Cliente</span>
                </a>
              </li>
              <li class="treeview" id="m_listado_clientes">
                <a href="../ventas/listado_clientes.php">
                  <span>Listado de  clientes</span>
                </a>
              </li>
            </ul>
          </a>
        </li>
        <li class="treeview" id="menu_compras">
          <a href="#">
            <i class="fa fa-chevron-down"></i>
            <span>Compras</span>
            <ul class="treeview-menu">
              <li class="treeview" id="m_para_proveedores">
                <a href="../compras/listado_proveedores.php">
                  <span>Proveedores</span>
                </a>
              </li>
            </ul>
            <ul class="treeview-menu">
              <li class="treeview" id="orden_compra">
                <a href="../compras/orden_compra.php">
                  <span>Orden de compra</span>
                </a>
              </li>
            </ul>
            <ul class="treeview-menu">
              <li class="treeview" id="compras">
                <a href="../compras/compras.php">
                  <span>Nota de ingreso</span>
                </a>
              </li>
            </ul>
          </a>
        </li>
        <li class="treeview" id="menu_parametros">
          <a href="#">
            <i class="fa fa-chevron-down"></i>
            <span>Parámetros</span>
            <ul class="treeview-menu">
              <li class="treeview" id="m_para_tipo_servicio">
                <a href="../parametros/tipo_servicio.php">
                  <span>Tipo de servicio</span>
                </a>
              </li>
              <li class="treeview" id="m_para_tipo_personal">
                <a href="../parametros/tipo_personal.php">
                  <span>Tipo de personal</span>
                </a>
              </li>
            </ul>
          </a>
        </li>


        <?php include 'izquierda_redes.php' ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>