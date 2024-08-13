<?php $__env->startSection('title'); ?>
    Analíticas
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboards
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Analíticas
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-xxl-5">
            <div class="d-flex flex-column h-100">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Usuarios</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="<?php echo e($users); ?>">0</span></h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> <?php echo e($avr_usr); ?> %
                                            </span> vs. el anterior mes</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                <i class="ri-team-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Pacientes</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="<?php echo e($patients); ?>">0</span></h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i> <?php echo e($avr_ptn); ?> %
                                            </span> vs. el anterior mes</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                <i class="ri-group-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Conductores</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="<?php echo e($conductors); ?>">0</span></h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> <?php echo e($avr_drv); ?> %
                                            </span> vs. el anterior mes</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                <i class="ri-car-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Ambulancias</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="<?php echo e($ambulances); ?>">0</span></h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> <?php echo e($avr_amb); ?> %
                                            </span> vs. el anterior mes</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                <i class="ri-shield-cross-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>


            </div>
        </div> <!-- end col-->

        <div class="col-xxl-7">
            <div class="row h-100">
                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Ubicación de incidentes</h4>
                        </div>

                        <div class="card-body">

                            
                            <div class="mb-3">
                                <div id="maps-dashboard" class="gmaps"></div>
                            </div>

                            
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Incidentes por mes en <?php echo e($th_year); ?></h4>
                        </div>
                        <div class="card-body p-0 pb-2">
                            <script>
                                var data = <?php echo json_encode($incidents, 15, 512) ?>;
                                var data1 = <?php echo json_encode($ly_incidents, 15, 512) ?>;
                                var data_maps = <?php echo json_encode($locations, 15, 512) ?>;
                            </script>
                            <div>
                                <div id="audiences_metrics_charts" data-colors='["--vz-success", "--vz-gray-300"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- apexcharts -->
    <script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/libs/jsvectormap/jsvectormap.min.js')); ?>"></script>
    

    <!-- dashboard init -->
    
    <script src="<?php echo e(URL::asset('assets/js/charts.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyD14FXg7RSqEAMXUW0_UzCsBbIc5UEFduU"></script>
    <script src="<?php echo e(URL::asset('assets/libs/gmaps/gmaps.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/maps.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Backup\Development\Proyectos desocom\sistememergency\resources\views/index.blade.php ENDPATH**/ ?>