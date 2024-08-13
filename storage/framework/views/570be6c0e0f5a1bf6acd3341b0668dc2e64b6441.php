<?php $__env->startSection('title'); ?>
    Pacientes
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Paciente
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Registrar
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Registrar</h4>
                </div>
                <div class="card-body form-steps">
                    <form action="<?php echo e(route('patient.store')); ?>" method="POST" enctype="multipart/form-data"
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
                        <div class="step-arrow-nav mb-4">
                            <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill"
                                        data-bs-target="#steparrow-gen-info" type="button" role="tab"
                                        aria-controls="steparrow-gen-info" aria-selected="true">Paciente</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-description-info-tab" data-bs-toggle="pill"
                                        data-bs-target="#steparrow-description-info" type="button" role="tab"
                                        aria-controls="steparrow-description-info" aria-selected="false">Incidente</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="steparrow-gen-info" role="tabpanel"
                                aria-labelledby="steparrow-gen-info-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="customername-field" class="form-label">Nombre</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Introduzca su nombre" required value="<?php echo e(old('name')); ?>" />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email-field" class="form-label">Apellido</label>
                                            <input type="text" name="lastname" class="form-control"
                                                placeholder="Introduzca su apellido" required
                                                value="<?php echo e(old('lastname')); ?>" />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone-field" class="form-label">Dirección</label>
                                            <input type="text" name="address" class="form-control"
                                                placeholder="Av. 6 de agosto" required value="<?php echo e(old('address')); ?>" />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone-field" class="form-label">Teléfono</label>
                                            <input type="number" name="phone" class="form-control" placeholder="78965432"
                                                required min="60000000" value="<?php echo e(old('phone')); ?>" />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone-field" class="form-label">Teléfono
                                                familiar</label>
                                            <input type="number" name="phone_family" class="form-control"
                                                placeholder="78965432" required min="60000000"
                                                value="<?php echo e(old('phone_family')); ?>" />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="date-field" class="form-label">Edad</label>
                                            <input type="number" name="age" class="form-control"
                                                placeholder="Introduzca su edad" required min="0"
                                                value="<?php echo e(old('age')); ?>" />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-description-info-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Continuar</button>
                                </div>
                            </div>

                            <div class="tab-pane fade active" id="steparrow-description-info" role="tabpanel"
                                aria-labelledby="steparrow-description-info-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email-field" class="form-label">Naturaleza</label>
                                            <input type="text" name="nature" class="form-control"
                                                placeholder="Ingresa la naturaleza del incidente" />
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
                                                placeholder="Introduce los detalles" />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone-field" class="form-label">Descripción</label>
                                            <textarea rows="1" type="text" name="description" class="form-control"></textarea>
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date-field" class="form-label">Evidencia</label>
                                            <input type="file" name="evidence" class="form-control" />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date-field" class="form-label">Latitud</label>
                                            <input type="text" name="latitude" id="latitude" class="form-control"
                                                readonly />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date-field" class="form-label">Longitud</label>
                                            <input type="text" name="longitude" id="longitude" class="form-control"
                                                readonly />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div id="maps" class="gmaps"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('assets/js/pages/form-wizard.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyD14FXg7RSqEAMXUW0_UzCsBbIc5UEFduU"></script>
    <script src="<?php echo e(URL::asset('assets/libs/gmaps/gmaps.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/maps.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/form-validation.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon\www\sistememergency\resources\views/patients/create.blade.php ENDPATH**/ ?>