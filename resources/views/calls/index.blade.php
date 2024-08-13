@extends('layouts.master')
@section('title')
    Llamadas
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Llamadas
        @endslot
        @slot('title')
            Listado de llamadas
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Llamadas</h4>
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
                                    {{-- <a href="{{ route('incident.create') }}" class="btn btn-success add-btn"
                                        role="button"><i class="ri-add-line align-bottom me-1"></i> Añadir</a> --}}
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
                                    @foreach ($calls as $call)
                                        <tr>
                                            <td class="phone">{{ $call->code }}</td>
                                            <td class="customer_name">
                                                {{ $call->full_name }}</td>
                                            <td class="customer_name">{{ $call->address }}</td>
                                            <td class="customer_name">{{ $call->phone }}</td>
                                            <td class="customer_name">{{ $call->type_of_call }}</td>
                                            <td>{{ $call->institution ? $call->institution : 'Ninguna' }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-info edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#showmodal{{ $call->id }}">Ver</button>
                                                    </div>
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editmodal{{ $call->id }}">Editar</button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deletemodal{{ $call->id }}">Eliminar</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- delete modal --}}
                                        @if (canAccessPage(auth()->user()->role, 'calls.destroy'))
                                            <div class="modal fade zoomIn" id="deletemodal{{ $call->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close" id="btn-close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('calls.destroy', $call->id) }}"
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
                                            <div class="modal fade zoomIn" id="deletemodal{{ $call->id }}"
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
                                        @endif
                                        {{-- show modal --}}
                                        @if (canAccessPage(auth()->user()->role, 'calls.show'))
                                            <div class="modal fade" id="showmodal{{ $call->id }}" tabindex="-2"
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
                                                                    value="{{ $call->code }}" readonly />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="customername-field"
                                                                    class="form-label">Nombre</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $call->full_name }}" readonly />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="customername-field"
                                                                    class="form-label">Dirección</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $call->address }}" readonly />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email-field"
                                                                    class="form-label">Teléfono</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $call->phone }}" readonly />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email-field" class="form-label">Tipo</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $call->type_of_call }}" readonly />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone-field"
                                                                    class="form-label">Institución</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $call->institution ? $call->institution : 'Ninguna' }}"
                                                                    readonly rows="1" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone-field"
                                                                    class="form-label">Descripción</label>
                                                                <textarea type="text" class="form-control" readonly rows="1">{{ $call->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="modal fade zoomIn" id="showmodal{{ $call->id }}"
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
                                        @endif
                                        {{-- edit modal --}}
                                        @if (canAccessPage(auth()->user()->role, 'calls.edit'))
                                            <div class="modal fade" id="editmodal{{ $call->id }}" tabindex="-2"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="{{ route('calls.update', ['call' => $call->id]) }}"
                                                            method="POST" class="row g-3 needs-validation">
                                                            @csrf
                                                            @method('PUT')
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
                                                                        name="full_name" value="{{ $call->full_name }}"
                                                                        required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="customername-field"
                                                                        class="form-label">Dirección</label>
                                                                    <input type="text" class="form-control"
                                                                        name="address" value="{{ $call->address }}"
                                                                        required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email-field"
                                                                        class="form-label">Teléfono</label>
                                                                    <input type="text" class="form-control"
                                                                        name="phone" value="{{ $call->phone }}"
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
                                                                        value="{{ $call->type_of_call }}" required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="phone-field"
                                                                        class="form-label">Institución</label>
                                                                    <input type="text" class="form-control"
                                                                        name="institution"
                                                                        value="{{ $call->institution }}" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="phone-field"
                                                                        class="form-label">Descripción</label>
                                                                    <textarea type="text" name="description" class="form-control" required rows="1">{{ $call->description }}</textarea>
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
                                        @else
                                            <div class="modal fade zoomIn" id="editmodal{{ $call->id }}"
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
                                        @endif
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
                        @if (canAccessPage(auth()->user()->role, 'calls.create'))
                            {{-- create modal --}}
                            <div class="modal fade" id="createmodal" tabindex="-2" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title">Nueva llamada</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="{{ route('calls.store') }}" method="POST"
                                            class="row g-3 needs-validation" novalidate>
                                            @csrf
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
                                                    {{-- <input type="text" class="form-control" name="type_of_call"
                                                    required /> --}}
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
                        @else
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
                        @endif
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
