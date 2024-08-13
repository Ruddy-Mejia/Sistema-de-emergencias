<?php $__env->startSection('title'); ?>
    Despachos
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/libs/glightbox/glightbox.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Despachos
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Registro de despachos
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Despachos</h4>
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
                </div>

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="<?php echo e(route('dispatch.create')); ?>" class="btn btn-success add-btn"
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
                                        <th class="sort">Código de autorización</th>
                                        <th class="sort">Conductor</th>
                                        <th class="sort">Placa ambulancia</th>
                                        <th class="sort">Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php $__currentLoopData = $dispatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dispatch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="phone"><?php echo e($dispatch->code_autizacion); ?></td>
                                            <td class="customer_name"><?php echo e($dispatch->ambulance->conductor->full_name); ?></td>
                                            <td class="customer_name"><?php echo e($dispatch->ambulance->number_plate); ?></td>
                                            <td class="customer_name">
                                                <?php echo e($dispatch->date); ?></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <a href="<?php echo e(route('dispatch.show', ['dispatch' => $dispatch->id])); ?>"
                                                            class="btn btn-sm btn-info" role="button">Ver</a>
                                                    </div>
                                                    <div class="edit">
                                                        
                                                        <a href="<?php echo e(route('dispatch.edit', ['dispatch' => $dispatch->id])); ?>"
                                                            class="btn btn-sm btn-success" role="button">Editar</a>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deletemodal<?php echo e($dispatch->id); ?>">Eliminar</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php if(canAccessPage(auth()->user()->role, 'dispatch.destroy')): ?>
                                        
                                        <div class="modal fade zoomIn" id="deletemodal<?php echo e($dispatch->id); ?>" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="btn-close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?php echo e(route('dispatch.destroy', $dispatch->id)); ?>"
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
                                            <div class="modal fade zoomIn" id="deletemodal<?php echo e($dispatch->id); ?>"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"
                                                                id="btn-close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h3><i class="las la-exclamation-circle"></i> No tienes
                                                                permisos para eliminar despachos</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="modal fade" id="showmodal<?php echo e($dispatch->id); ?>" tabindex="-2"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light p-3">
                                                        <h5 class="modal-title">Información de la ambulancia</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="close-modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="customername-field"
                                                                class="form-label">Código</label>
                                                            <input type="text" class="form-control"
                                                                value="<?php echo e($dispatch->code); ?>" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="customername-field"
                                                                class="form-label">Nombre</label>
                                                            <input type="text" class="form-control"
                                                                value="<?php echo e($dispatch->full_name); ?>" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="customername-field"
                                                                class="form-label">Color</label>
                                                            <input type="text" class="form-control"
                                                                value="<?php echo e($dispatch->color); ?>" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email-field" class="form-label">Modelo</label>
                                                            <input type="text" class="form-control"
                                                                value="<?php echo e($dispatch->model); ?>" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="customername-field" class="form-label">Fecha de
                                                                registro</label>
                                                            <input type="text" class="form-control"
                                                                value="<?php echo e($dispatch->created_at->format('d/m/Y')); ?>"
                                                                readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal fade" id="editmodal<?php echo e($dispatch->id); ?>" tabindex="-2"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form
                                                        action="<?php echo e(route('dispatch.update', ['dispatch' => $dispatch->id])); ?>"
                                                        method="POST" class="row g-3 needs-validation">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title">Editar información de la llamada</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"
                                                                id="close-modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="customername-field"
                                                                    class="form-label">Placa</label>
                                                                <input type="text" class="form-control"
                                                                    name="number_plate"
                                                                    value="<?php echo e($dispatch->number_plate); ?>" required />
                                                                <div class="invalid-feedback">
                                                                    Por favor, rellene este campo.
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="customername-field"
                                                                    class="form-label">Conductor</label>
                                                                <select name="conductor_id" class="form-select" required>
                                                                    <option disabled>Elige un ambulance</option>
                                                                    <?php $__currentLoopData = $ambulances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ambulance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if($ambulance->id == $dispatch->conductor_id): ?>
                                                                            <option value="<?php echo e($ambulance->id); ?>" selected>
                                                                                <?php echo e($ambulance->full_name); ?>

                                                                            </option>
                                                                        <?php else: ?>
                                                                            <option value="<?php echo e($ambulance->id); ?>">
                                                                                <?php echo e($ambulance->full_name); ?>

                                                                            </option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Por favor, rellene este campo.
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email-field" class="form-label">Color</label>
                                                                <input type="text" class="form-control" name="color"
                                                                    value="<?php echo e($dispatch->color); ?>" required />
                                                                <div class="invalid-feedback">
                                                                    Por favor, rellene este campo.
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email-field" class="form-label">Modelo</label>
                                                                <input type="text" class="form-control" name="model"
                                                                    value="<?php echo e($dispatch->model); ?>" required />
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
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
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
                        
                        <div class="modal fade" id="createmodal" tabindex="-2" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h5 class="modal-title">Nueva ambulancia</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form action="<?php echo e(route('dispatch.store')); ?>" method="POST"
                                        class="row g-3 needs-validation" novalidate>
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Placa</label>
                                                <input type="text" class="form-control" name="number_plate"
                                                    required />
                                                <div class="invalid-feedback">
                                                    Por favor, rellene este campo.
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Conductor</label>
                                                <select name="conductor_id" class="form-select" required>
                                                    <option disabled selected>Elige un ambulance</option>
                                                    <?php $__currentLoopData = $ambulances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ambulance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($ambulance->id); ?>">
                                                            <?php echo e($ambulance->full_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Por favor, rellene este campo.
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email-field" class="form-label">Color</label>
                                                <input type="text" class="form-control" name="color" required
                                                    placeholder="Introduzca el color de la ambulancia" />
                                                <div class="invalid-feedback">
                                                    Por favor, rellene este campo.
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email-field" class="form-label">Modelo</label>
                                                <input type="text" class="form-control" name="model"
                                                    placeholder="Introduzca el modelo de la ambulancia" required />
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
    <script src="<?php echo e(URL::asset('assets/js/pages/form-validation.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/tables.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon\www\sistememergency\resources\views/dispatch/index.blade.php ENDPATH**/ ?>