@extends('layouts.master')
@section('title')
    Roles & Permisos
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
    <div class="pt-4 mb-4 mb-lg-3">
        <div class="row g-4">
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">Editar rol</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content pt-4 text-muted">
                <div class="tab-pane active" id="overview-tab" role="tabpanel">
                    <div class="row">
                        <div class="card">
                            <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="POST"
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
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $role->name }}">
                                                <div class="invalid-feedback">
                                                    Por favor, rellene este campo.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Módulo</th>
                                                <th>Listado</th>
                                                <th>Crear</th>
                                                <th>Ver</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Usuarios</td>
                                                @foreach ($users as $user)
                                                    @php
                                                        $permissionExists = $permissions->contains('id', $user->id);
                                                    @endphp

                                                    <td>
                                                        <input type="checkbox" name="pages[]" value="{{ $user->id }}"
                                                            {{ $permissionExists ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Pacientes</td>
                                                @foreach ($patients as $user)
                                                    @php
                                                        $permissionExists = $permissions->contains('id', $user->id);
                                                    @endphp

                                                    <td>
                                                        <input type="checkbox" name="pages[]" value="{{ $user->id }}"
                                                            {{ $permissionExists ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Incidentes</td>
                                                @foreach ($incidents as $user)
                                                    @php
                                                        $permissionExists = $permissions->contains('id', $user->id);
                                                    @endphp

                                                    <td>
                                                        <input type="checkbox" name="pages[]" value="{{ $user->id }}"
                                                            {{ $permissionExists ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Llamadas</td>
                                                @foreach ($calls as $user)
                                                    @php
                                                        $permissionExists = $permissions->contains('id', $user->id);
                                                    @endphp

                                                    <td>
                                                        <input type="checkbox" name="pages[]" value="{{ $user->id }}"
                                                            {{ $permissionExists ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Conductores</td>
                                                @foreach ($conductors as $user)
                                                    @php
                                                        $permissionExists = $permissions->contains('id', $user->id);
                                                    @endphp

                                                    <td>
                                                        <input type="checkbox" name="pages[]" value="{{ $user->id }}"
                                                            {{ $permissionExists ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Ambulancias</td>
                                                @foreach ($ambulances as $user)
                                                    @php
                                                        $permissionExists = $permissions->contains('id', $user->id);
                                                    @endphp

                                                    <td>
                                                        <input type="checkbox" name="pages[]" value="{{ $user->id }}"
                                                            {{ $permissionExists ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Despachos</td>
                                                @foreach ($dispatches as $user)
                                                    @php
                                                        $permissionExists = $permissions->contains('id', $user->id);
                                                    @endphp

                                                    <td>
                                                        <input type="checkbox" name="pages[]" value="{{ $user->id }}"
                                                            {{ $permissionExists ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Hospitales</td>
                                                @foreach ($hospitals as $user)
                                                    @php
                                                        $permissionExists = $permissions->contains('id', $user->id);
                                                    @endphp

                                                    <td>
                                                        <input type="checkbox" name="pages[]" value="{{ $user->id }}"
                                                            {{ $permissionExists ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Páginas</td>
                                                @foreach ($pages as $user)
                                                    @php
                                                        $permissionExists = $permissions->contains('id', $user->id);
                                                    @endphp

                                                    <td>
                                                        <input type="checkbox" name="pages[]" value="{{ $user->id }}"
                                                            {{ $permissionExists ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Roles</td>
                                                @foreach ($roles as $user)
                                                    @php
                                                        $permissionExists = $permissions->contains('id', $user->id);
                                                    @endphp

                                                    <td>
                                                        <input type="checkbox" name="pages[]" value="{{ $user->id }}"
                                                            {{ $permissionExists ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Respuestas</td>
                                                @php
                                                    $permissionExists = $permissions->contains('id', $responses[0]->id);
                                                @endphp
                                                <td><input type="checkbox" name="pages[]" value="{{ $responses[0]->id }}"
                                                        {{ $permissionExists ? 'checked' : '' }}>
                                                </td>
                                                <td><input type="checkbox" disabled></td>
                                                @php
                                                    $permissionExists = $permissions->contains('id', $responses[1]->id);
                                                @endphp
                                                <td><input type="checkbox" name="pages[]" value="{{ $responses[1]->id }}"
                                                        {{ $permissionExists ? 'checked' : '' }}>
                                                </td>
                                                <td><input type="checkbox" disabled></td>
                                                <td><input type="checkbox" disabled></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-end">
                                        <button class="btn btn-primary" type="submit">Guardar</button>
                                    </div>
                                </div>
                            </form>
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
