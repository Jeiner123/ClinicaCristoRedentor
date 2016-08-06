  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
	<div class="user-panel">
		<div class="pull-left image">
		  <img src="../../img/doctor.JPG" class="img-circle" alt="User Image">
		</div>
		<div class="pull-left info" style="color:#245573 !important">
		  <p><?php echo $usuario; ?></p>
		  <a href="#" style="color:#245573 !important"><i class="fa fa-circle text-success"></i>Online</a>
		</div>
	</div>

	<section class="sidebar">
	  <ul class="sidebar-menu">
		<li class="header">Menú principal</li>

          <li class="treeview" id="menu_documentos">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Documentos
                  <ul class="treeview-menu">
                      <li class="treeview" id="m_doc_control">
                          <a href="../documentos/control_documentos.php">
                              Control de documentos
                          </a>
                      </li>
                      <li class="treeview" id="m_registro_requerido">
                          <a href="../documentos/registro_requerido.php">
                              Formatos del SG
                          </a>
                      </li>
                      <li class="treeview" id="m_doc_registros">
                          <a href="../documentos/control_registros.php">
                              Registros generados
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview" id="menu_citas">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Gestión de citas
                  <ul class="treeview-menu">
                      <li class="treeview" id="m_listar_citas">
                          <a href="../citas/listar_citas.php">
                              Listar citas
                          </a>
                      </li>
                      <li class="treeview" id="m_registrar_cita">
                          <a href="../citas/registrar_cita_medica.php">
                              Registrar cita médica
                          </a>
                      </li>
                      <li class="treeview" id="m_registrar_lab">
                          <a href="../citas/registrar_cita_laboratorio.php">
                              Registrar cita laboratorio
                          </a>
                      </li>
                      <li class="treeview" id="m_cita_referencias">
                          <a href="../citas/referencias.php">
                              Referencias
                          </a>
                      </li>
                      <li class="treeview" id="m_registrar_lab">
                          <a href="../citas/atender_cita_medica.php">
                              Atender cita médica
                          </a>
                      </li>
                      <li class="treeview" id="m_registrar_lab">
                          <a href="../citas/atender_cita_laboratorio.php">
                              Atender cita laboratorio
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview" id="menu_facturacion">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Facturación
                  <ul class="treeview-menu">
                      <li class="treeview" id="m_listado_pagos">
                          <a href="../facturacion/listado_pagos.php">
                              Listado de pagos
                          </a>
                      </li>
                      <li class="treeview" id="m_pendiente_facturar">
                          <a href="../facturacion/pendiente_facturar.php">
                              Pendientes de facturar
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview" id="menu_clinica">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Clínica
                  <ul class="treeview-menu">
                      <li class="treeview" id="m_clinica_especialidades">
                          <a href="../clinica/especialidades.php">
                              Especialidades médicas
                          </a>
                      </li>
                      <li class="treeview" id="m_clinica_servicios">
                          <a href="../clinica/servicios.php">
                              Servicios médicos
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview" id="menu_pacientes">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Pacientes
                  <ul class="treeview-menu">
                      <li class="treeview" id="m_listado_pacientes">
                          <a href="../pacientes/listado_pacientes.php">
                              Listado de Pacientes
                          </a>
                      </li>
                      <li class="treeview" id="m_nuevo_paciente">
                          <a href="../pacientes/nuevo_paciente.php">
                              Nuevo Paciente
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview" id="menu_planilla">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Personal
                  <ul class="treeview-menu">
                      <li class="treeview" id="m_planilla_personal">
                          <a href="../planilla/personal.php">
                              Gestión del personal
                          </a>
                      </li>
                      <li class="treeview" id="m_asignar_especialidades">
                          <a href="../planilla/asignar_especialidades.php">
                              Asignar especialidades
                          </a>
                      </li>
                      <li class="treeview" id="m_recibos_honorario">
                          <a href="../planilla/recibos_por_honorario.php">
                              Recibos por honorario
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview" id="menu_ventas">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Ventas
                  <ul class="treeview-menu">
                      <li class="treeview" id="m_listado_ventas">
                          <a href="../ventas/listado_ventas.php">
                              Listado de  ventas
                          </a>
                      </li>
                      <li class="treeview" id="m_nuevo_venta">
                          <a href="../ventas/nuevo_venta.php">
                              Nueva venta
                          </a>
                      </li>
                      <li class="treeview" id="m_nuevo_cliente">
                          <a href="../ventas/nuevo_cliente.php">
                              Nuevo Cliente
                          </a>
                      </li>
                      <li class="treeview" id="m_listado_clientes">
                          <a href="../ventas/listado_clientes.php">
                              Listado de  clientes
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview" id="menu_compras">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Gestión de compras
                  <ul class="treeview-menu">
                      <li class="treeview" id="m_para_proveedores">
                          <a href="../compras/listado_proveedores.php">
                              Listado de proveedores
                          </a>
                      </li>
                      <li class="treeview" id="m_nuevo_proveedor">
                          <a href="../compras/nuevo_proveedor.php">
                              Nuevo proveedor
                          </a>
                      </li>
                      <li class="treeview" id="orden_compra">
                          <a href="../compras/orden_compra.php">
                              Orden de compra
                          </a>
                      </li>
                      <li class="treeview" id="compras">
                          <a href="../compras/compras.php">
                              Nota de ingreso
                          </a>
                      </li>
                      <li class="treeview" id="listado_facturas">
                          <a href="../compras/listado_facturas.php">
                              Cuenta corriente por pagar
                          </a>
                      </li>
                      <li class="treeview" id="facturas">
                          <a href="../compras/facturas.php">
                              Provisiones por pagar
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

		<li class="treeview" id="menu_parametros">
			<a href="#">
				<i class="fa fa-chevron-down"></i>
				Parámetros
				<ul class="treeview-menu">
					<li class="treeview" id="m_para_tipo_servicio">
						<a href="../parametros/tipo_servicio.php">
							Tipo de servicio
						</a>
					</li>
					<li class="treeview" id="m_para_tipo_personal">
						<a href="../parametros/tipo_personal.php">
							Tipo de personal
						</a>
					</li>
					<li class="treeview" id="m_para_tipo_compra">
						<a href="../parametros/tipo_compra.php">
							Tipo de compa
						</a>
					</li>
					<li class="treeview" id="m_para_tipo_venta">
						<a href="../parametros/tipo_venta.php">
							Tipo de venta
						</a>
					</li>
					<li class="treeview" id="m_para_tipo_adquisicion">
						<a href="../parametros/tipo_adquisicion.php">
							Tipo de adquisición
						</a>
					</li>
					<li class="treeview" id="m_para_tipo_adquisicion">
						<a href="#">
							Forma de pago
						</a>
					</li>
					<li class="treeview" id="m_para_tipo_documento">
						<a href="../parametros/tipo_documento.php">
							Tipo de documento
						</a>
					</li>
					<li class="treeview" id="m_para_comprobante">
						<a href="../parametros/comprobante_pago.php">
							Comprobante de pago
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