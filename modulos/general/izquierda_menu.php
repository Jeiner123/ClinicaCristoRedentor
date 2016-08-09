<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <div class="user-panel">
        <div class="pull-left image">
            <img src="../../img/doctor.JPG" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info" style="color:#245573 !important">
            <p><?= $full_name ?></p>
            <a href="#" style="color:#245573 !important"><i class="fa fa-circle text-success"></i>Online</a>
        </div>
    </div>

    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header"><strong>Menú principal</strong></li>

            <?php
            require '../bd/bd_conexion.php';

            $query = 'SELECT id, nombre, folder FROM modules';
            $result_set = mysqli_query($con, $query);
            $modules = $result_set->fetch_all();

            foreach ($modules as $module):
                $query = 'SELECT I.nombre, I.file FROM items I INNER JOIN permissions P ON P.item_id=I.id WHERE module_id = ' . $module[0];
                $result_set_items = mysqli_query($con, $query);
                $items = $result_set_items->fetch_all();
                if (sizeof($items) > 0) {
            ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-chevron-down"></i>
                            <span><?= $module[1] ?></span>
                        </a>
                        <ul class="treeview-menu">
                            <?php foreach ($items as $item): ?>
                                <li class="treeview">
                                    <a href="../<?= $module[2] ?>/<?= $item[1] ?>.php">
                                        <span><?= $item[0] ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
            <?php
                }
            endforeach;
            ?>

            <?php include 'izquierda_redes.php' ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
