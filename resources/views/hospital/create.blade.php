@extends('layouts.master')
@section('title')
    Hospitales
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link rel="stylesheet"
        href="{{ URL::asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Hospitales
        @endslot
        @slot('title')
            @lang('translation.create')
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
                        <div class="row">
                            <form action="{{ route('hospital.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
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
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email-field" class="form-label">Nombre</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Ingrese el nombre del hospital" required />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone-field" class="form-label">Nivel</label>
                                            <select name="level" class="form-select">
                                                <option disabled selected>Seleccione el nivel</option>
                                                <option value="1er nivel">1er nivel</option>
                                                <option value="2do nivel">2do nivel</option>
                                                <option value="3er nivel">3er nivel</option>
                                                <option value="4to nivel">4to nivel</option>
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
                                            <label for="phone-field" class="form-label">Estado</label>
                                            <select name="statu" class="form-select">
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="date-field" class="form-label">Latitud</label>
                                            <input type="text" name="latitude"
                                                id="latitude" class="form-control" required readonly />
                                            <div class="invalid-feedback">
                                                Por favor, rellene este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="date-field" class="form-label">Longitud</label>
                                            <input type="text" name="longitude"
                                                id="longitude" class="form-control" required readonly />
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
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
    <!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyD14FXg7RSqEAMXUW0_UzCsBbIc5UEFduU"></script> -->
    <script src="https://maps.google.com/maps/api/js"></script>
    <script src="{{ URL::asset('assets/libs/gmaps/gmaps.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/maps.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/notifications.init.js') }}"></script>

    <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/form-file-upload.init.js') }}"></script>
@endsection
