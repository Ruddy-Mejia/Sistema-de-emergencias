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
                                    <label for="customername-field" class="form-label">Hospital</label>
                                    <input type="text" name="nature" class="form-control"
                                        value="{{ $hospital->name }}"
                                        readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Nivel</label>
                                    <input type="text" name="nature" class="form-control"
                                        value="{{ $hospital->level }}" readonly />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phone-field" class="form-label">Fecha de registro</label>
                                    <input type="text" name="details" class="form-control"
                                        value="{{ $hospital->created_at->format('d/m/Y') }}" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date-field" class="form-label">Latitud</label>
                                    <input type="text" name="latitude" value="{{ $hospital->latitude }}" id="latitude"
                                        class="form-control" readonly readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date-field" class="form-label">Longitud</label>
                                    <input type="text" name="longitude" value="{{ $hospital->longitude }}"
                                        id="longitude" class="form-control" readonly readonly />
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
