@extends('layouts.master')
@section('title')
    Pacientes
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pacientes
        @endslot
        @slot('title')
            Listado de pacientes
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Pacientes</h4>
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
                    @if (session('warning'))
                        <br>
                        <div class="alert alert-warning alert-dismissible alert-label-icon rounded-label fade show"
                            role="alert">
                            <i class="ri-check-double-line label-icon"></i><strong>Info:
                            </strong>{{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    {{-- <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#addmodal"><i
                                            class="ri-add-line align-bottom me-1"></i> Añadir</button> --}}

                                    <a href="{{ route('patient.create') }}" class="btn btn-success add-btn"
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
                                    @foreach ($patients as $key => $patient)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $patient->name }}</td>
                                            <td>{{ $patient->lastname }}</td>
                                            <td>{{ $patient->age }}</td>
                                            <td>{{ $patient->phone }}</td>
                                            <td>{{ $patient->phone_family }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-info edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#showmodal{{ $patient->id }}">Ver
                                                            perfil</button>
                                                    </div>
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editmodal{{ $patient->id }}">Editar</button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deletemodal{{ $patient->id }}">Eliminar</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @if (canAccessPage(auth()->user()->role, 'patient.edit'))
                                            {{-- edit modal --}}
                                            <div class="modal fade" id="editmodal{{ $patient->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title">Editar</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close" id="close-modal"></button>
                                                        </div>
                                                        <form
                                                            action="{{ route('patient.update', ['patient' => $patient->id]) }}"
                                                            method="POST" enctype="multipart/form-data"
                                                            class="row g-3 needs-validation">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="customername-field"
                                                                        class="form-label">Nombre</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" value="{{ $patient->name }}"
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
                                                                        value="{{ $patient->lastname }}" required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="phone-field"
                                                                        class="form-label">Dirección</label>
                                                                    <input type="text" name="address"
                                                                        class="form-control"
                                                                        value="{{ $patient->address }}" required />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="phone-field"
                                                                        class="form-label">Teléfono</label>
                                                                    <input type="number" name="phone"
                                                                        class="form-control"
                                                                        value="{{ $patient->phone }}" required
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
                                                                        value="{{ $patient->phone_family }}" required
                                                                        min="60000000" />
                                                                    <div class="invalid-feedback">
                                                                        Por favor, rellene este campo.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="date-field"
                                                                        class="form-label">Edad</label>
                                                                    <input type="number" name="age"
                                                                        class="form-control" value="{{ $patient->age }}"
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
                                        @else
                                        <div class="modal fade zoomIn" id="editmodal{{ $patient->id }}"
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
                                        @endif
                                        @if (canAccessPage(auth()->user()->role, 'patient.destroy'))
                                            {{-- delete modal --}}
                                        <div class="modal fade zoomIn" id="deletemodal{{ $patient->id }}"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="btn-close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('patient.destroy', $patient->id) }}"
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
                                        <div class="modal fade zoomIn" id="deletemodal{{ $patient->id }}"
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
                                        @endif
                                        @if (canAccessPage(auth()->user()->role, 'patient.show'))
                                        {{-- show modal --}}
                                        <div class="modal fade" id="showmodal{{ $patient->id }}" tabindex="-1"
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
                                                                value="{{ $patient->name }}" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email-field" class="form-label">Apellido</label>
                                                            <input type="email" name="lastname" class="form-control"
                                                                value="{{ $patient->lastname }}" readonly />
                                                            <div class="invalid-feedback">
                                                                Por favor, rellene este campo.
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone-field" class="form-label">Dirección</label>
                                                            <input type="text" name="address" class="form-control"
                                                                value="{{ $patient->address }}" readonly />
                                                            <div class="invalid-feedback">
                                                                Por favor, rellene este campo.
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone-field" class="form-label">Teléfono</label>
                                                            <input type="text" name="phone" class="form-control"
                                                                value="{{ $patient->phone }}" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone-field" class="form-label">Teléfono
                                                                familiar</label>
                                                            <input type="text" name="phone_family"
                                                                class="form-control" value="{{ $patient->phone_family }}"
                                                                required readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="date-field" class="form-label">Edad</label>
                                                            <input type="text" name="age" class="form-control"
                                                                value="{{ $patient->age }}" readonly />
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="modal fade zoomIn" id="showmodal{{ $patient->id }}"
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
                                        @endif
                                        {{-- end show modal --}}
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- add modal --}}
                            <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title">Registrar paciente</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="{{ route('patient.store') }}" method="POST"
                                            enctype="multipart/form-data" class="row g-3 needs-validation">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Nombre</label>
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Introduzca su nombre" required
                                                        value="{{ old('name') }}" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email-field" class="form-label">Apellido</label>
                                                    <input type="text" name="lastname" class="form-control"
                                                        placeholder="Introduzca su apellido" required
                                                        value="{{ old('lastname') }}" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone-field" class="form-label">Dirección</label>
                                                    <input type="text" name="address" class="form-control"
                                                        placeholder="Av. 6 de agosto" required
                                                        value="{{ old('address') }}" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone-field" class="form-label">Teléfono</label>
                                                    <input type="number" name="phone" class="form-control"
                                                        placeholder="78965432" required min="60000000"
                                                        value="{{ old('phone') }}" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone-field" class="form-label">Teléfono
                                                        familiar</label>
                                                    <input type="number" name="phone_family" class="form-control"
                                                        placeholder="78965432" required min="60000000"
                                                        value="{{ old('phone_family') }}" />
                                                    <div class="invalid-feedback">
                                                        Por favor, rellene este campo.
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="date-field" class="form-label">Edad</label>
                                                    <input type="number" name="age" class="form-control"
                                                        placeholder="Introduzca su edad" required min="0"
                                                        value="{{ old('age') }}" />
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
                            {{-- end add modal --}}

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
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/list.js/list.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/list.pagination.js/list.pagination.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/listjs.init.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tables.js') }}"></script>
@endsection
