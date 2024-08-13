
<?php $__env->startSection('title'); ?>
    Usuarios
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/css/customizations.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Usuarios
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Listado de usuarios
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="card">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-sm-4">
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Buscar">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <div class="col-sm-auto ms-auto">
                    <div class="list-grid-nav hstack gap-1">
                        <a href="<?php echo e(route('users.create')); ?>" type="button" class="btn btn-success add-btn"><i
                                class="ri-add-line align-bottom me-1"></i> <?php echo app('translator')->get('translation.add'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="team-list grid-view-filter row">
                    <div id="col">
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card team-box col-item">
                                <div class="team-cover">
                                    <img src="<?php echo e(URL::asset('storage/' . $user->photo)); ?>"
                                        onerror="this.onerror=null; this.src='<?php echo e(URL::asset('assets/images/small/img-9.jpg')); ?>';"
                                        alt="" class="img-fluid" />
                                </div>
                                <div class="card-body p-4">
                                    <div class="row align-items-center team-row">
                                        <div class="col team-settings">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="bookmark-icon flex-shrink-0 me-2">
                                                        <input type="checkbox" id="favourite1"
                                                            class="bookmark-input bookmark-hide">
                                                        <label for="favourite1" class="btn-star">
                                                            <svg width="20" height="20">
                                                                <use xlink:href="#icon-star" />
                                                            </svg>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col text-end dropdown">
                                                    <a href="javascript:void(0);" id="dropdownMenuLink2"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill fs-17"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="dropdownMenuLink2">
                                                        <li><a class="dropdown-item"
                                                                href="<?php echo e(route('users.show', ['user' => $user->id])); ?>"><i
                                                                    class="ri-eye-line me-2 align-middle"></i>Ver</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="<?php echo e(route('users.edit', ['user' => $user->id])); ?>"><i
                                                                    class="ri-quill-pen-fill me-2 align-middle"></i>Editar</a>
                                                        </li>
                                                        <li><button class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#deleteRecordModal<?php echo e($user->id); ?>"><i
                                                                    class="ri-delete-bin-5-line me-2 align-middle"></i>Eliminar</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col">
                                            <div class="team-profile-img">
                                                <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                    <img src="<?php echo e(URL::asset('storage/' . $user->avatar)); ?>" alt=""
                                                        class="img-fluid d-block rounded-circle" />
                                                </div>
                                                <div class="team-content">
                                                    <a data-bs-toggle="offcanvas" href="#offcanvasExample"
                                                        aria-controls="offcanvasExample">
                                                        <h5 class="fs-16 mb-1">
                                                            <?php echo e($user->name . ' ' . $user->last_name . ' ' . $user->motherlast_name); ?>

                                                        </h5>
                                                    </a>
                                                    <p class="text-muted mb-0"><?php echo e($user->type); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col">
                                            <div class="row text-muted text-center">
                                                <div class="col-6 border-end border-end-dashed">
                                                    <h5 class="mb-1"><?php echo e($user->city); ?></h5>
                                                    <p class="text-muted mb-0">Ciudad</p>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="mb-1"><?php echo e($user->phone); ?></h5>
                                                    <p class="text-muted mb-0">Teléfono</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col">
                                            <div class="text-end">
                                                <a class="btn btn-light view-btn" href="<?php echo e(route('users.show', ['user' => $user->id])); ?>">Ver perfil</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade zoomIn" id="deleteRecordModal<?php echo e($user->id); ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width:100px;height:100px"></lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4><?php echo app('translator')->get('translation.are_you_sure'); ?></h4>
                                                </div>
                                            </div>
                                            <form id="deleteForm<?php echo e($user->id); ?>" method="POST"
                                                action="<?php echo e(route('users.destroy', ['user' => $user->id])); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                    <button type="button" class="btn w-sm btn-light"
                                                        data-bs-dismiss="modal"><?php echo app('translator')->get('translation.cancel'); ?></button>
                                                    <button type="submit" class="btn w-sm btn-danger"
                                                        id="delete-record"><?php echo app('translator')->get('translation.yes'); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('assets/js/pages/team.init.js')); ?>"></script>

    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RAMIRO\Desktop\project\Laravel\default\resources\views/users/index.blade.php ENDPATH**/ ?>