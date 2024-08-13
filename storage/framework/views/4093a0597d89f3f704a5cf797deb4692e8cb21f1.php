<?php $__env->startSection('title'); ?>
    Llamadas
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/libs/glightbox/glightbox.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Llamadas
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Listado de llamadas
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Llamadas</h4>
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
                                    
                                    <button class="btn btn-success add-btn" data-bs-toggle="modal"
                                        data-bs-target="#createmodal"><i class="ri-add-line align-bottom me-1"></i>
                                        Añadir</button>
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
                                        <th class="sort">Código</th>
                                        <th class="sort">Nombre</th>
                                        <th class="sort">Dirección</th>
                                        <th class="sort">Teléfono</th>
                                        <th class="sort">Tipo de llamada</th>
                                        <th class="sort">Institución</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php $__currentLoopData = $calls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $call): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="phone"><?php echo e($call->code); ?></td>
                                            <td class="customer_name">
                                                <?php echo e($call->full_name); ?></td>
                                            <td class="customer_name"><?php echo e($call->address); ?></td>
                                            <td class="customer_name"><?php echo e($call->phone); ?></td>
                                            <td class="customer_name"><?php echo e($call->type_of_call); ?></td>
                                            <td><?php echo e($call->institution ? $call->institution : 'Ninguna'); ?></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-info edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#showmodal<?php echo e($call->id); ?>">Ver</button>
                                                    </div>
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editmodal<?php echo e($call->id); ?>">Editar</button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deletemodal<?php echo e($call->id); ?>">Eliminar</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php if(canAccessPage(auth()->user()->role, 'calls.destroy')): ?>
                                            <div class="modal fade zoomIn" id="deletemodal<?php echo e($call->id); ?>"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close" id="btn-close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo e(route('calls.destroy', $call->id)); ?>"
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
                                            <div class="modal fade zoomIn" id="deletemodal<?php echo e($call->id); ?>"
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
                                                                permisos para eliminar las llamadas</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if(canAccessPage(auth()->user()->role, 'calls.show')): ?>
                                            <div class="modal fade" id="showmodal<?php echo e($call->id); ?>" tabindex="-2"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title">Información de la llamada</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"
                                                                id="close-modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="customername-field"
                                                                    class="form-label">Código</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo e($call->code); ?>" readonly />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="customername-field"
                                                                    class="form-label">Nombre</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo e($call->full_name); ?>" readonly />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="customername-field"
                                                                    class="form-label">Dirección</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo e($call->address); ?>" readonly />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email-field"
                                                                    class="form-label">Teléfono</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo e($call->phone); ?>" readonly />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email-field" class="form-label">Tipo</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo e($call->type_of_call); ?>" readonly />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone-field"
                                                                    class="form-label">Institución</label>
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo e($call->institution ? $call->institution : 'Ninguna'); ?>"
                                                                    readonly rows="1" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone-field"
                                                                    class="form-label">Descripción</label>
                                                                <textarea type="text" class="form-control" readonly rows="1"><?php echo e($call->description); ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="modal fade zoomIn" id="showmodal<?php echo e($call->id); ?>"
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
                                                                permisos para ver las llamadas</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if(canAccessPage(auth()->user()->role, 'calls.edit')): ?>
                                            <div class="modal fade" id="editmodal<?php echo e($call->id); ?>" tabindex="-2"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="<?php echo e(route('calls.update', ['call' => $call->id])); ?>"
                                                            method="POST" class="row g-3 needs-validation">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <div class="modal-header bg-light p-3">
                                                                <h5 class="modal-title">Editar información de la llamada
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"
                                                                    id="close-modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="customername-field"
                                                                        class="form-label">Nombre</label>
                                                                    <input type="text" class="form-control"
                                                                        name="full_name" value="<?php echo e($call->full_name); ?>"
                                                                        required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="customername-field"
                                                                        class="form-label">Dirección</label>
                                                                    <input type="text" class="form-control"
                                                                        name="address" value="<?php echo e($call->address); ?>"
                                                                        required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email-field"
                                                                        class="form-label">Teléfono</label>
                                                                    <input type="text" class="form-control"
                                                                        name="phone" value="<?php echo e($call->phone); ?>"
                                                                        required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email-field"
                                                                        class="form-label">Tipo</label>
                                                                    <input type="text" class="form-control"
                                                                        name="type_of_call"
                                                                        value="<?php echo e($call->type_of_call); ?>" required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="phone-field"
                                                                        class="form-label">Institución</label>
                                                                    <input type="text" class="form-control"
                                                                        name="institution"
                                                                        value="<?php echo e($call->institution); ?>" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="phone-field"
                                                                        class="form-label">Descripción</label>
                                                                    <textarea type="text" name="description" class="form-control" required rows="1"><?php echo e($call->description); ?></textarea>
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
                                            <div class="modal fade zoomIn" id="editmodal<?php echo e($call->id); ?>"
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
                                                                permisos para editar las llamadas</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
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
                        <?php if(canAccessPage(auth()->user()->role, 'calls.create')): ?>
                            
                            <div class="modal fade" id="createmodal" tabindex="-2" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title">Nueva llamada</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="<?php echo e(route('calls.store')); ?>" method="POST"
                                            class="row g-3 needs-validation" novalidate>
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" name="full_name" required
                                                        placeholder="Introduzca su nombre" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Dirección</label>
                                                    <input type="text" class="form-control" name="address" required
                                                        placeholder="Introduzca su dirección" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email-field" class="form-label">Teléfono</label>
                                                    <input type="text" class="form-control" name="phone" required
                                                        placeholder="Introduzca su teléfono" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email-field" class="form-label">Tipo</label>
                                                    
                                                    <select name="type_of_call" class="form-select">
                                                        <option disabled selected>Seleccione un tipo</option>
                                                        <option value="Emergencia">Emergencia</option>
                                                        <option value="Incidente">Incidente</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone-field" class="form-label">Institución</label>
                                                    <input type="text" class="form-control" name="institution"
                                                        placeholder="Introduzca la institución" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone-field" class="form-label">Descripción</label>
                                                    <textarea type="text" name="description" class="form-control" required rows="1"></textarea>
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
                        <?php else: ?>
                            <div class="modal fade zoomIn" id="createmodal" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h3><i class="las la-exclamation-circle"></i> No tienes permisos para crear llamadas</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon\www\sistememergency\resources\views/calls/index.blade.php ENDPATH**/ ?>