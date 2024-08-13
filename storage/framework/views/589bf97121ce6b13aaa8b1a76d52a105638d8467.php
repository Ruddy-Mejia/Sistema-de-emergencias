
<?php $__env->startSection('title'); ?>
    Usuarios
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            <?php echo app('translator')->get('translation.users'); ?>
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            <?php echo app('translator')->get('translation.create'); ?>
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"><?php echo app('translator')->get('translation.create'); ?></h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form action="<?php echo e(route('users.store')); ?>" method="POST" enctype="multipart/form-data"
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
                                        <label for="firstNameinput" class="form-label"><?php echo app('translator')->get('translation.name'); ?></label>
                                        <input type="text" class="form-control" placeholder="Introduce tu nombre(s)"
                                            id="name" name="name" required value="<?php echo e(old('name')); ?>">
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="lastNameinput" class="form-label"><?php echo app('translator')->get('translation.lastname'); ?></label>
                                        <input type="text" class="form-control"
                                            placeholder="Introduce tu apellido paterno" id="last_name" name="last_name"
                                            required value="<?php echo e(old('last_name')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="motherlastnameinput" class="form-label"><?php echo app('translator')->get('translation.motherlastname'); ?></label>
                                        <input type="text" class="form-control"
                                            placeholder="Introduce tu apellido materno" id="motherlast_name"
                                            name="motherlast_name" required value="<?php echo e(old('motherlast_name')); ?>">
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label"><?php echo app('translator')->get('translation.phone'); ?></label>
                                        <input type="number" class="form-control" placeholder="76543210" id="phone"
                                            name="phone" required min="60000000" value="<?php echo e(old('phone')); ?>">
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="emailidInput" class="form-label"><?php echo app('translator')->get('translation.email'); ?></label>
                                        <input type="email" class="form-control" placeholder="ejemplo@gmail.com"
                                            id="email" name="email" required value="<?php echo e(old('email')); ?>">
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address1ControlTextarea" class="form-label"><?php echo app('translator')->get('translation.address'); ?></label>
                                        <input type="text" class="form-control" placeholder="Av. 6 de Agosto"
                                            id="address" name="address" required value="<?php echo e(old('address')); ?>">
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="citynameInput" class="form-label">Foto</label>
                                        <input type="file" class="form-control" name="avatar"
                                            accept="image/*" required />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address1ControlTextarea" class="form-label"><?php echo app('translator')->get('translation.password'); ?></label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address1ControlTextarea" class="form-label"><?php echo app('translator')->get('translation.confirm_password'); ?></label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            name="confirm_password" required>
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="ForminputState" class="form-label">Cargo</label>
                                        <select class="form-select" data-choices data-choices-sorting="true"
                                            id="type" name="type">
                                            <option selected disabled><?php echo app('translator')->get('translation.choose'); ?></option>
                                            <option value="Informante">Informante</option>
                                            <option value="Divulgador">Divulgador</option>
                                        </select>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="ForminputState" class="form-label"><?php echo app('translator')->get('translation.city'); ?></label>
                                        <select class="form-select" data-choices data-choices-sorting="true"
                                            id="city" name="city">
                                            <option selected disabled><?php echo app('translator')->get('translation.choose'); ?></option>
                                            <option value="Cochabamba">Cochabamba</option>
                                            <option value="La Paz">La Paz</option>
                                        </select>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="citynameInput" class="form-label"><?php echo app('translator')->get('translation.status'); ?></label>
                                        <select class="form-select" data-choices data-choices-sorting="true"
                                            name="status">
                                            <option selected disabled><?php echo app('translator')->get('translation.choose'); ?></option>
                                            <option value="1"><?php echo app('translator')->get('translation.active'); ?></option>
                                            <option value="0"><?php echo app('translator')->get('translation.inactive'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="citynameInput" class="form-label">Latitud</label>
                                        <input type="text" class="form-control" id="latitude" name="latitude"
                                            required value="<?php echo e(old('latitude')); ?>" readonly>
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="citynameInput" class="form-label">Longitud</label>
                                        <input type="text" class="form-control" id="longitude" name="longitude"
                                            required value="<?php echo e(old('longitude')); ?>" readonly>
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div id="maps" class="gmaps"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('translation.save'); ?></button>
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
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyD14FXg7RSqEAMXUW0_UzCsBbIc5UEFduU"></script>
    <script src="<?php echo e(URL::asset('assets/libs/gmaps/gmaps.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/maps.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/form-validation.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/notifications.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RAMIRO\Desktop\project\Laravel\default\resources\views/users/create.blade.php ENDPATH**/ ?>