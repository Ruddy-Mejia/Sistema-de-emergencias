<?php $__env->startSection('title'); ?>
    Pacientes
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Pacientes
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Listado de pacientes
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Pacientes</h4>
                    <?php if(session('error')): ?>
                        <br>
                        <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label fade show"
                            role="alert">
                            <i class="ri-error-warning-line label-icon"></i><strong>Error:
                            </strong><?php echo e(session('error')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if(session('success')): ?>
                        <br>
                        <div class="alert alert-success alert-dismissible alert-label-icon rounded-label fade show"
                            role="alert">
                            <i class="ri-check-double-line label-icon"></i><strong>Info:
                            </strong><?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if(session('warning')): ?>
                        <br>
                        <div class="alert alert-warning alert-dismissible alert-label-icon rounded-label fade show"
                            role="alert">
                            <i class="ri-check-double-line label-icon"></i><strong>Info:
                            </strong><?php echo e(session('warning')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    

                                    <a href="<?php echo e(route('patient.create')); ?>" class="btn btn-success add-btn"
                                        role="button"><i class="ri-add-line align-bottom me-1"></i> Añadir</a>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <button id="resetButton" class="btn btn-success add-btn"> <i
                                            class="ri-refresh-line"></i></button>
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" id="searchInput"
                                            placeholder="Buscar">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="datatable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort">Nro.</th>
                                        <th class="sort">Nombre</th>
                                        <th class="sort">Apellido</th>
                                        <th class="sort">Edad</th>
                                        <th class="sort">Teléfono</th>
                                        <th class="sort">Teléfono familiar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($patient->name); ?></td>
                                            <td><?php echo e($patient->lastname); ?></td>
                                            <td><?php echo e($patient->age); ?></td>
                                            <td><?php echo e($patient->phone); ?></td>
                                            <td><?php echo e($patient->phone_family); ?></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-info edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#showmodal<?php echo e($patient->id); ?>">Ver
                                                            perfil</button>
                                                    </div>
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editmodal<?php echo e($patient->id); ?>">Editar</button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deletemodal<?php echo e($patient->id); ?>">Eliminar</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php if(canAccessPage(auth()->user()->role, 'patient.edit')): ?>
                                            
                                            <div class="modal fade" id="editmodal<?php echo e($patient->id); ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title">Editar</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close" id="close-modal"></button>
                                                        </div>
                                                        <form
                                                            action="<?php echo e(route('patient.update', ['patient' => $patient->id])); ?>"
                                                            method="POST" enctype="multipart/form-data"
                                                            class="row g-3 needs-validation">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="customername-field"
                                                                        class="form-label">Nombre</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" value="<?php echo e($patient->name); ?>"
                                                                        required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email-field"
                                                                        class="form-label">Apellido</label>
                                                                    <input type="text" name="lastname"
                                                                        class="form-control"
                                                                        value="<?php echo e($patient->lastname); ?>" required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="phone-field"
                                                                        class="form-label">Dirección</label>
                                                                    <input type="text" name="address"
                                                                        class="form-control"
                                                                        value="<?php echo e($patient->address); ?>" required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="phone-field"
                                                                        class="form-label">Teléfono</label>
                                                                    <input type="number" name="phone"
                                                                        class="form-control"
                                                                        value="<?php echo e($patient->phone); ?>" required
                                                                        min="60000000" />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="phone-field" class="form-label">Teléfono
                                                                        familiar</label>
                                                                    <input type="number" name="phone_family"
                                                                        class="form-control"
                                                                        value="<?php echo e($patient->phone_family); ?>" required
                                                                        min="60000000" />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="date-field"
                                                                        class="form-label">Edad</label>
                                                                    <input type="number" name="age"
                                                                        class="form-control" value="<?php echo e($patient->age); ?>"
                                                                        required min="1" />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <button type="button" class="btn btn-light"
                                                                        data-bs-dismiss="modal">Cerrar</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success">Guardar</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                        <div class="modal fade zoomIn" id="editmodal<?php echo e($patient->id); ?>"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="btn-close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3><i class="las la-exclamation-circle"></i> No tienes permisos para editar pacientes</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(canAccessPage(auth()->user()->role, 'patient.destroy')): ?>
                                            
                                        <div class="modal fade zoomIn" id="deletemodal<?php echo e($patient->id); ?>"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="btn-close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?php echo e(route('patient.destroy', $patient->id)); ?>"
                                                            method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <div class="mt-2 text-center">
                                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                                    trigger="loop"
                                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                                    style="width:100px;height:100px"></lord-icon>

                                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                    <h4>¿Estás seguro?</h4>
                                                                </div>

                                                            </div>
                                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                                <button type="button" class="btn w-sm btn-light"
                                                                    data-bs-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn w-sm btn-danger "
                                                                    id="delete-record">Eliminar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="modal fade zoomIn" id="deletemodal<?php echo e($patient->id); ?>"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="btn-close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3><i class="las la-exclamation-circle"></i> No tienes permisos para eliminar pacientes</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(canAccessPage(auth()->user()->role, 'patient.show')): ?>
                                        
                                        <div class="modal fade" id="showmodal<?php echo e($patient->id); ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light p-3">
                                                        <h5 class="modal-title">Perfil del paciente</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="close-modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="customername-field"
                                                                class="form-label">Nombre</label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="<?php echo e($patient->name); ?>" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email-field" class="form-label">Apellido</label>
                                                            <input type="email" name="lastname" class="form-control"
                                                                value="<?php echo e($patient->lastname); ?>" readonly />
                                                            <div class="invalid-feedback">
                                                                Por favor, rellene este campo.
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone-field" class="form-label">Dirección</label>
                                                            <input type="text" name="address" class="form-control"
                                                                value="<?php echo e($patient->address); ?>" readonly />
                                                            <div class="invalid-feedback">
                                                                Por favor, rellene este campo.
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone-field" class="form-label">Teléfono</label>
                                                            <input type="text" name="phone" class="form-control"
                                                                value="<?php echo e($patient->phone); ?>" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone-field" class="form-label">Teléfono
                                                                familiar</label>
                                                            <input type="text" name="phone_family"
                                                                class="form-control" value="<?php echo e($patient->phone_family); ?>"
                                                                required readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="date-field" class="form-label">Edad</label>
                                                            <input type="text" name="age" class="form-control"
                                                                value="<?php echo e($patient->age); ?>" readonly />
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="modal fade zoomIn" id="showmodal<?php echo e($patient->id); ?>"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="btn-close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3><i class="las la-exclamation-circle"></i> No tienes permisos para ver pacientes</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            
                            <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title">Registrar paciente</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="<?php echo e(route('patient.store')); ?>" method="POST"
                                            enctype="multipart/form-data" class="row g-3 needs-validation">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Nombre</label>
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Introduzca su nombre" required
                                                        value="<?php echo e(old('name')); ?>" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email-field" class="form-label">Apellido</label>
                                                    <input type="text" name="lastname" class="form-control"
                                                        placeholder="Introduzca su apellido" required
                                                        value="<?php echo e(old('lastname')); ?>" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone-field" class="form-label">Dirección</label>
                                                    <input type="text" name="address" class="form-control"
                                                        placeholder="Av. 6 de agosto" required
                                                        value="<?php echo e(old('address')); ?>" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone-field" class="form-label">Teléfono</label>
                                                    <input type="number" name="phone" class="form-control"
                                                        placeholder="78965432" required min="60000000"
                                                        value="<?php echo e(old('phone')); ?>" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
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
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start">
                            <span id="paginationInfo" class="page-info"></span>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <button id="paginationPrev" class="page-item pagination-prev">
                                    Anterior
                                </button>
                                <button id="paginationNext" class="page-item pagination-next">
                                    Siguiente
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('assets/libs/prismjs/prismjs.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/libs/list.js/list.js.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/libs/list.pagination.js/list.pagination.js.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/listjs.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/tables.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon\www\sistememergency\resources\views/patients/index.blade.php ENDPATH**/ ?>