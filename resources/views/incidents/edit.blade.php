@extends('layouts.master')
@section('title')
    Incidentes
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Incidentes
        @endslot
        @slot('title')
            Editar información de incidentes
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Editar</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('incident.update', ['incident' => $incident->id]) }}" method="POST"
                            enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label fade show"
                                    role="alert">
                                    <i class="ri-error-warning-line label-icon"></i><strong>Error:
                                    </strong>{{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Paciente</label>
                                        <select name="patient_id" required class="form-select">
                                            <option disabled>Selecciona un paciente</option>
                                            @foreach ($patients as $patient)
                                                @if ($patient->id == $incident->patient->id)
                                                    <option value="{{ $patient->id }}" selected>
                                                        {{ $patient->name . ' ' . $patient->lastname }}
                                                    </option>
                                                @else
                                                    <option value="{{ $patient->id }}">
                                                        {{ $patient->name . ' ' . $patient->lastname }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email-field" class="form-label">Naturaleza</label>
                                        <input type="text" name="nature" class="form-control"
                                            value="{{ $incident->nature }}" required />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone-field" class="form-label">Tipo</label>
                                        <select name="type" class="form-select">
                                            <option value="{{ $incident->type }}" selected>{{ $incident->type }}</option>
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
                                            value="{{ $incident->details }}" required />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="phone-field" class="form-label">Descripción</label>
                                        <textarea rows="1" type="text" name="description" class="form-control" required>{{ $incident->description }}</textarea>
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date-field" class="form-label">Latitud</label>
                                        <input type="text" name="latitude" value="{{ $incident->latitude }}"
                                            id="latitude" class="form-control" required readonly />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date-field" class="form-label">Longitud</label>
                                        <input type="text" name="longitude" value="{{ $incident->longitude }}"
                                            id="longitude" class="form-control" required readonly />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date-field" class="form-label">Evidencia</label>
                                        <input type="file" name="evidence" class="form-control" />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div id="maps-edit" class="gmaps"></div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/notifications.init.js') }}"></script>
    <!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyD14FXg7RSqEAMXUW0_UzCsBbIc5UEFduU"></script> -->
    <script src="https://maps.google.com/maps/api/js"></script>
    <script src="{{ URL::asset('assets/libs/gmaps/gmaps.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/maps.js') }}"></script>
@endsection
