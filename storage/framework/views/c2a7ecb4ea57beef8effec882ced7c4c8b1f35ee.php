
<?php $__env->startSection('title'); ?>
    Incidentes
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Incidentes
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Registrar nuevo incidente
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Nuevo incidente</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="<?php echo e(route('incident.store')); ?>" method="POST" enctype="multipart/form-data"
                            class="row g-3 needs-validation" novalidate>
                            <?php echo csrf_field(); ?>
                            <?php if(session('error')): ?>
                                <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label fade show"
                                    role="alert">
                                    <i class="ri-error-warning-line label-icon"></i><strong>Error:
                                    </strong><?php echo e(session('error')); ?>

                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Paciente</label>
                                        <select name="patient_id" required class="form-select">
                                            <option disabled>Selecciona un paciente</option>
                                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($patient->id); ?>">
                                                    <?php echo e($patient->name . ' ' . $patient->lastname); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email-field" class="form-label">Naturaleza</label>
                                        <input type="text" name="nature" class="form-control"
                                            placeholder="Ingresa la naturaleza del incidente" required />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone-field" class="form-label">Tipo</label>
                                        <select name="type" class="form-select">
                                            <option selected disabled>Selecciona un tipo</option>
                                            <option value="Accidente">Accidente</option>
                                            <option value="Incidente">Incidente</option>
                                            <option value="Incidente 1">Incidente 1</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone-field" class="form-label">Detalles</label>
                                        <input type="text" name="details" class="form-control"
                                            placeholder="Introduce los detalles" required />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="phone-field" class="form-label">Descripción</label>
                                        <textarea rows="1" type="text" name="description" class="form-control" required></textarea>
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date-field" class="form-label">Latitud</label>
                                        <input type="text" name="latitude"
                                            id="latitude" class="form-control" required readonly />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date-field" class="form-label">Longitud</label>
                                        <input type="text" name="longitude"
                                            id="longitude" class="form-control" required readonly />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date-field" class="form-label">Evidencia</label>
                                        <input type="file" name="evidence" class="form-control" required />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div id="maps" class="gmaps"></div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('assets/libs/prismjs/prismjs.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/form-validation.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/notifications.init.js')); ?>"></script>

    <!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyD14FXg7RSqEAMXUW0_UzCsBbIc5UEFduU"></script> -->
    <script src="https://maps.google.com/maps/api/js"></script>
    <script src="<?php echo e(URL::asset('assets/libs/gmaps/gmaps.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/maps.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon\www\sistememergency\resources\views/incidents/create.blade.php ENDPATH**/ ?>