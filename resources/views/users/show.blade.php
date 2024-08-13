@extends('layouts.master')
@section('title')
    Usuarios
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}">
@endsection
@section('content')
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ URL::asset('assets/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <img src="{{ asset('storage/' . $user->avatar) }}"
                        alt="user-img" class="img-thumbnail rounded-circle" />
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $user->name }} {{ $user->last_name }}</h3>
                    <p class="text-white-75">{{ $user->type }}</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i
                                class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{ $user->address }}
                        </div>
                        <div><i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>{{ $user->city }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content pt-4 text-muted">
                <div class="tab-pane active" id="overview-tab" role="tabpanel">
                    <div class="row">
                        <div class="col-xxl-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Información</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0 ">
                                            <tbody>
                                                <tr>
                                                    <th class="ps-0" scope="row">Nombre Completo :</th>
                                                    <td class="text-muted">{{ $user->name }}
                                                        {{ $user->last_name }}
                                                        {{ $user->motherlast_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Teléfono :</th>
                                                    <td class="text-muted">+(591) {{ $user->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Correo Electronico :</th>
                                                    <td class="text-muted">{{ $user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Dirección :</th>
                                                    <td class="text-muted">{{ $user->address }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Fecha de registro:</th>
                                                    <td class="text-muted">
                                                        {{ $user->created_at->format('Y-m-d') }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Altitud:</th>
                                                    <td class="text-muted">
                                                        {{ $user->longitude }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Latitud:</th>
                                                    <td class="text-muted">
                                                        {{ $user->latitude}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/profile.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
