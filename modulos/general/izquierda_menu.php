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

      <?php
        require '../bd/bd_conexion.php';

        $query = 'SELECT id, nombre, folder FROM modules';
        $result_set = mysqli_query($con, $query);
        $modules = $result_set->fetch_all();

        foreach ($modules as $module):
            $query = 'SELECT nombre, file FROM items WHERE module_id = '.$module[0];
            $result_set_items = mysqli_query($con, $query);
            $items = $result_set_items->fetch_all();
      ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-chevron-down"></i>
                    <?= $module[1] ?>
                    <ul class="treeview-menu">
                        <?php foreach ($items as $item): ?>
                        <li class="treeview">
                            <a href="../<?= $module[2] ?>/<?= $item[1] ?>.php">
                                <?= $item[0] ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </a>
            </li>
      <?php endforeach; ?>
          <!--
          <li class="treeview">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Documentos
                  <ul class="treeview-menu">
                      <li class="treeview">
                          <a href="../documentos/control_documentos.php">
                              Control de documentos
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../documentos/registro_requerido.php">
                              Formatos del SG
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../documentos/control_registros.php">
                              Registros generados
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Gestión de citas
                  <ul class="treeview-menu">
                      <li class="treeview">
                          <a href="../citas/listar_citas.php">
                              Listar citas
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../citas/registrar_cita_medica.php">
                              Registrar cita médica
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../citas/registrar_cita_laboratorio.php">
                              Registrar cita laboratorio
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../citas/referencias.php">
                              Referencias
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../citas/atender_cita_medica.php">
                              Atender cita médica
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../citas/atender_cita_laboratorio.php">
                              Atender cita laboratorio
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Facturación
                  <ul class="treeview-menu">
                      <li class="treeview">
                          <a href="../facturacion/listado_pagos.php">
                              Listado de pagos
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../facturacion/pendiente_facturar.php">
                              Pendientes de facturar
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Clínica
                  <ul class="treeview-menu">
                      <li class="treeview">
                          <a href="../clinica/especialidades.php">
                              Especialidades médicas
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../clinica/servicios.php">
                              Servicios médicos
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Pacientes
                  <ul class="treeview-menu">
                      <li class="treeview">
                          <a href="../pacientes/listado_pacientes.php">
                              Listado de Pacientes
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../pacientes/nuevo_paciente.php">
                              Nuevo Paciente
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Personal
                  <ul class="treeview-menu">
                      <li class="treeview">
                          <a href="../planilla/personal.php">
                              Gestión del personal
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../planilla/asignar_especialidades.php">
                              Asignar especialidades
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../planilla/recibos_por_honorario.php">
                              Recibos por honorario
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Ventas
                  <ul class="treeview-menu">
                      <li class="treeview">
                          <a href="../ventas/listado_ventas.php">
                              Listado de ventas
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../ventas/nueva_venta.php">
                              Nueva venta
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../ventas/nuevo_cliente.php">
                              Nuevo Cliente
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../ventas/listado_clientes.php">
                              Listado de  clientes
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-chevron-down"></i>
                  Gestión de compras
                  <ul class="treeview-menu">
                      <li class="treeview">
                          <a href="../compras/listado_proveedores.php">
                              Listado de proveedores
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../compras/nuevo_proveedor.php">
                              Nuevo proveedor
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../compras/orden_compra.php">
                              Orden de compra
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../compras/compras.php">
                              Nota de ingreso
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../compras/listado_facturas.php">
                              Cuenta corriente por pagar
                          </a>
                      </li>
                      <li class="treeview">
                          <a href="../compras/facturas.php">
                              Provisiones por pagar
                          </a>
                      </li>
                  </ul>
              </a>
          </li>

		<li class="treeview">
			<a href="#">
				<i class="fa fa-chevron-down"></i>
				Parámetros
				<ul class="treeview-menu">
					<li class="treeview">
						<a href="../parametros/tipo_servicio.php">
							Tipo de servicio
						</a>
					</li>
					<li class="treeview">
						<a href="../parametros/tipo_personal.php">
							Tipo de personal
						</a>
					</li>
					<li class="treeview">
						<a href="../parametros/tipo_compra.php">
							Tipo de compa
						</a>
					</li>
					<li class="treeview">
						<a href="../parametros/tipo_venta.php">
							Tipo de venta
						</a>
					</li>
					<li class="treeview">
						<a href="../parametros/tipo_adquisicion.php">
							Tipo de adquisición
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							Forma de pago
						</a>
					</li>
					<li class="treeview">
						<a href="../parametros/tipo_documento.php">
							Tipo de documento
						</a>
					</li>
					<li class="treeview">
						<a href="../parametros/comprobante_pago.php">
							Comprobante de pago
						</a>
					</li>
				</ul>
			</a>
		</li>-->

		<?php include 'izquierda_redes.php' ?>
	  </ul>
	</section>
	<!-- /.sidebar -->
  </aside>