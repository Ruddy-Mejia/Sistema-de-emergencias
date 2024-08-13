@extends('layouts.master')
@section('title')
    Incidentes
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Incidentes
        @endslot
        @slot('title')
            Detalle de incidentes
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Información sobre incidentes</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
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
                                    <input type="text" name="nature" class="form-control"
                                        value="{{ $incident->patient->name . ' ' . $incident->patient->lastname }}"
                                        readonly />

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Naturaleza</label>
                                    <input type="text" name="nature" class="form-control"
                                        value="{{ $incident->nature }}" readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phone-field" class="form-label">Tipo</label>
                                    <input type="text" name="nature" class="form-control" value="{{ $incident->type }}"
                                        readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phone-field" class="form-label">Detalles</label>
                                    <input type="text" name="details" class="form-control"
                                        value="{{ $incident->details }}" readonly />
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="phone-field" class="form-label">Descripción</label>
                                    <textarea rows="1" type="text" name="description" class="form-control" readonly>{{ $incident->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="date-field" class="form-label">Latitud</label>
                                    <input type="text" name="latitude" value="{{ $incident->latitude }}" id="latitude"
                                        class="form-control" readonly readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="date-field" class="form-label">Longitud</label>
                                    <input type="text" name="longitude" value="{{ $incident->longitude }}"
                                        id="longitude" class="form-control" readonly readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="date-field" class="form-label">Evidencia</label>
                                    {{-- <div class="gallery-box card"> --}}
                                        {{-- <div class="gallery-container"> --}}
                                            <a class="image-popup" href="{{ asset('storage/' . $incident->evidence) }}"
                                                title=""><br>
                                                <button class="btn btn-primary">Ver Evidencia</button>
                                            </a>
                                        {{-- </div> --}}
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <div id="maps-show" class="gmaps"></div>
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
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/notifications.init.js') }}"></script>
    <!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyD14FXg7RSqEAMXUW0_UzCsBbIc5UEFduU"></script> -->
    <script src="https://maps.google.com/maps/api/js"></script>
    <script src="{{ URL::asset('assets/libs/gmaps/gmaps.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/maps.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/glightbox/glightbox.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/isotope-layout/isotope-layout.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/gallery.init.js') }}"></script>
@endsection
