<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('assets/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('assets/images/logo-light.png')); ?>" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('root')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="ri-dashboard-line"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('roles.index')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="ri-pages-line"></i><span>Roles & Permisos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('users.index')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="ri-team-line"></i><span>Usuarios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('patient.index')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="ri-group-line"></i><span>Pacientes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('incident.index')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="ri-home-heart-line"></i><span>Incidentes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('calls.index')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="ri-phone-line"></i><span>Llamadas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('conductor.index')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="ri-car-line"></i><span>Conductores</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('ambulance.index')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="las la-ambulance"></i><span>Ambulancias</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('dispatch.index')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="ri-run-fill"></i><span>Despacho</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('hospital.index')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="las la-hospital"></i><span>Hospitales</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('response.index')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="lab la-replyd"></i><span>Respuestas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('pages.index')); ?>" role="button" aria-expanded="false"
                        aria-controls="sidebarUsers">
                        <i class="las la-exclamation"></i><span>Páginas</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
<?php /**PATH C:\Users\RAMIRO\Desktop\project\Laravel\default\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>