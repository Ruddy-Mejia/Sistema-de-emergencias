@extends('layouts.master')
@section('title')
    Respuestas
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        Respuestas
        @endslot
        @slot('title')
            Listado de respuestas
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Respuestas</h4>
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
                                        <th class="sort">Paciente</th>
                                        <th class="sort">Edad</th>
                                        <th class="sort">Tipo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($responses as $key => $response)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $response->patient->name . ' ' . $response->patient->lastname }}</td>
                                            <td>{{ $response->patient->age }}</td>
                                            <td>{{ $response->type }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-info edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#showmodal{{ $response->id }}">Ver</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @if (canAccessPage(auth()->user()->role, 'response.show'))
                                        {{-- Show modal --}}
                                        <div class="modal fade" id="showmodal{{ $response->id }}" tabindex="-2"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light p-3">
                                                        <h5 class="modal-title">Información de la respuesta</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="close-modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="customername-field"
                                                                class="form-label">Paciente</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $response->patient->name . ' ' . $response->patient->lastname }}" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="customername-field"
                                                                class="form-label">Edad</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $response->patient->age }}" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email-field" class="form-label">Dirección</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $response->patient->address }}" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email-field" class="form-label">Fecha de registro</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $response->created_at->format('d/m/Y') }}" readonly />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone-field"
                                                                class="form-label">Respuesta</label>
                                                            <textarea type="text" class="form-control" readonly rows="1">{{ $response->response }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            <div class="modal fade zoomIn" id="showmodal{{ $response->id }}"
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
                                                                permisos para ver las respuestas</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
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
    {{-- <script src="{{ URL::asset('assets/libs/list.pagination.js/list.pagination.js.min.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/js/pages/listjs.init.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

    <!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyD14FXg7RSqEAMXUW0_UzCsBbIc5UEFduU"></script> -->
    <script src="https://maps.google.com/maps/api/js"></script>
    <script src="{{ URL::asset('assets/libs/gmaps/gmaps.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/maps.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/glightbox/glightbox.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/isotope-layout/isotope-layout.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/gallery.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tables.js') }}"></script>
@endsection
