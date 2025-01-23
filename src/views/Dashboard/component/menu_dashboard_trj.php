 <!-- /.navbar -->
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="../Trabajador/trabajador.php" class="brand-link">
         <img src="../../../../assets/logos/SWEVEN-ADVISOR.png" alt="SWEVEN-ADVISOR Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light"><?php echo APP_NAME ?></span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <i class="fas fa-user-tie fa-lg img-circle elevation-2" style="color: #ffffff;"></i>
             </div>
             <div class="info">
                 <a href="#" class="d-block"><?php echo $_SESSION['usuario'];  ?></a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item">
                     <a href="#" class="nav-link active menu-item">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             MI PERFIL
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="../Trabajador/mi_perfil.php" class="nav-link active menu-item">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Mi información</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link active menu-item">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             GESTIÓN SOLICITUDES
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="../Trabajador/solicitudes_vacaciones_trj.php" class="nav-link active menu-item">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Mis Vacaciones</p>
                             </a>
                         </li>

                     </ul>
                 </li>


             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>

 <!-- Content Wrapper. Contains page content -->