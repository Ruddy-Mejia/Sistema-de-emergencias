@extends('layouts.master')
@section('title')
    Despachos
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Despachos
        @endslot
        @slot('title')
            Nuevo despacho
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">@lang('translation.create')</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('dispatch.store') }}" method="POST" enctype="multipart/form-data"
                            class="row g-3 needs-validation" novalidate>
                            @csrf
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
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Placa ambulancia</label>
                                        <select name="ambulance_id" required class="form-select">
                                            <option disabled>Selecciona una ambulancia</option>
                                            @foreach ($ambulances as $ambulance)
                                                <option value="{{ $ambulance->id }}">
                                                    {{ $ambulance->number_plate }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email-field" class="form-label">Fecha</label>
                                        <input type="date" name="date" class="form-control"
                                            placeholder="Ingresa la naturaleza del incidente" required
                                            min="{{ date('Y-m-d') }}" />

                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date-field" class="form-label">Latitud</label>
                                        <input type="text" name="latitude" id="latitude" class="form-control" required
                                            readonly />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date-field" class="form-label">Longitud</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control" required
                                            readonly />
                                        <div class="invalid-feedback">
                                            Por favor, rellene este campo.
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div id="maps" class="gmaps"></div>
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

    <script src="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-pickers.init.js') }}"></script>
@endsection
