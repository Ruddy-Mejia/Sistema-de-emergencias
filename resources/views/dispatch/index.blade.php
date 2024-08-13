@extends('layouts.master')
@section('title')
    Despachos
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Despachos
        @endslot
        @slot('title')
            Registro de despachos
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Despachos</h4>
                    @if (session('error'))
                        <br>
                        <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label fade show"
                            role="alert">
                            <i class="ri-error-warning-line label-icon"></i><strong>Error:
                            </strong>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('success'))
                        <br>
                        <div class="alert alert-success alert-dismissible alert-label-icon rounded-label fade show"
                            role="alert">
                            <i class="ri-check-double-line label-icon"></i><strong>Info:
                            </strong>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('dispatch.create') }}" class="btn btn-success add-btn"
                                        role="button"><i class="ri-add-line align-bottom me-1"></i> Añadir</a>
                                    {{-- <button class="btn btn-success add-btn" data-bs-toggle="modal"
                                        data-bs-target="#createmodal"><i class="ri-add-line align-bottom me-1"></i>
                                        Añadir</button> --}}
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
                                    @foreach ($dispatches as $dispatch)
                                        <tr>
                                            <td class="phone">{{ $dispatch->code_autizacion }}</td>
                                            <td class="customer_name">{{ $dispatch->ambulance->conductor->full_name }}</td>
                                            <td class="customer_name">{{ $dispatch->ambulance->number_plate }}</td>
                                            <td class="customer_name">
                                                {{ $dispatch->date }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <a href="{{ route('dispatch.show', ['dispatch' => $dispatch->id]) }}"
                                                            class="btn btn-sm btn-info" role="button">Ver</a>
                                                    </div>
                                                    <div class="edit">
                                                        {{-- <button class="btn btn-sm btn-success edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editmodal{{ $dispatch->id }}">Editar</button> --}}
                                                        <a href="{{ route('dispatch.edit', ['dispatch' => $dispatch->id]) }}"
                                                            class="btn btn-sm btn-success" role="button">Editar</a>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deletemodal{{ $dispatch->id }}">Eliminar</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @if (canAccessPage(auth()->user()->role, 'dispatch.destroy'))
                                        {{-- delete modal --}}
                                        <div class="modal fade zoomIn" id="deletemodal{{ $dispatch->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="btn-close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('dispatch.destroy', $dispatch->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
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
                                        @else
                                            <div class="modal fade zoomIn" id="deletemodal{{ $dispatch->id }}"
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
                                        @endif
                                        {{-- show modal --}}
                                        <div class="modal fade" id="showmodal{{ $dispatch->id }}" tabindex="-2"
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
                                                                value="{{ $dispatch->code }}" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="customername-field"
                                                                class="form-label">Nombre</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $dispatch->full_name }}" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="customername-field"
                                                                class="form-label">Color</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $dispatch->color }}" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email-field" class="form-label">Modelo</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $dispatch->model }}" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="customername-field" class="form-label">Fecha de
                                                                registro</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $dispatch->created_at->format('d/m/Y') }}"
                                                                readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- edit modal --}}
                                        <div class="modal fade" id="editmodal{{ $dispatch->id }}" tabindex="-2"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route('dispatch.update', ['dispatch' => $dispatch->id]) }}"
                                                        method="POST" class="row g-3 needs-validation">
                                                        @csrf
                                                        @method('PUT')
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
                                                                    value="{{ $dispatch->number_plate }}" required />
                                                                <div class="invalid-feedback">
                                                                    Por favor, rellene este campo.
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="customername-field"
                                                                    class="form-label">Conductor</label>
                                                                <select name="conductor_id" class="form-select" required>
                                                                    <option disabled>Elige un ambulance</option>
                                                                    @foreach ($ambulances as $ambulance)
                                                                        @if ($ambulance->id == $dispatch->conductor_id)
                                                                            <option value="{{ $ambulance->id }}" selected>
                                                                                {{ $ambulance->full_name }}
                                                                            </option>
                                                                        @else
                                                                            <option value="{{ $ambulance->id }}">
                                                                                {{ $ambulance->full_name }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Por favor, rellene este campo.
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email-field" class="form-label">Color</label>
                                                                <input type="text" class="form-control" name="color"
                                                                    value="{{ $dispatch->color }}" required />
                                                                <div class="invalid-feedback">
                                                                    Por favor, rellene este campo.
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email-field" class="form-label">Modelo</label>
                                                                <input type="text" class="form-control" name="model"
                                                                    value="{{ $dispatch->model }}" required />
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
                                    @endforeach
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
                        {{-- create modal --}}
                        <div class="modal fade" id="createmodal" tabindex="-2" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h5 class="modal-title">Nueva ambulancia</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form action="{{ route('dispatch.store') }}" method="POST"
                                        class="row g-3 needs-validation" novalidate>
                                        @csrf
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
                                                    @foreach ($ambulances as $ambulance)
                                                        <option value="{{ $ambulance->id }}">
                                                            {{ $ambulance->full_name }}
                                                        </option>
                                                    @endforeach
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
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/list.js/list.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/list.pagination.js/list.pagination.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/listjs.init.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tables.js') }}"></script>
@endsection
