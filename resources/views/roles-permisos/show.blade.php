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
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
        <div class="row g-4">
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">Acerca del Rol</h3>
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
                                                    <th class="ps-0" scope="row">Nombre del rol:</th>
                                                    <td class="text-muted">{{ $role->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Fecha de creación:</th>
                                                    <td class="text-muted">
                                                        {{ $role->created_at->format('d/m/Y') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Permisos del rol</h5>
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
                                                            {{ $permissionExists ? 'checked' : '' }} disabled >
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
                                                            {{ $permissionExists ? 'checked' : '' }} disabled>
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
                                                            {{ $permissionExists ? 'checked' : '' }} disabled>
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
                                                            {{ $permissionExists ? 'checked' : '' }} disabled>
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
                                                            {{ $permissionExists ? 'checked' : '' }} disabled>
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
                                                            {{ $permissionExists ? 'checked' : '' }} disabled>
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
                                                            {{ $permissionExists ? 'checked' : '' }} disabled>
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
                                                            {{ $permissionExists ? 'checked' : '' }} disabled>
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
                                                            {{ $permissionExists ? 'checked' : '' }} disabled>
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
                                                            {{ $permissionExists ? 'checked' : '' }} disabled>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Respuestas</td>
                                                @php
                                                    $permissionExists = $permissions->contains('id', $responses[0]->id);
                                                @endphp
                                                <td><input type="checkbox" name="pages[]" value="{{ $responses[0]->id }}"
                                                        {{ $permissionExists ? 'checked' : '' }} disabled>
                                                </td>
                                                <td><input type="checkbox" disabled></td>
                                                @php
                                                    $permissionExists = $permissions->contains('id', $responses[1]->id);
                                                @endphp
                                                <td><input type="checkbox" name="pages[]" value="{{ $responses[1]->id }}"
                                                        {{ $permissionExists ? 'checked' : '' }} disabled>
                                                </td>
                                                <td><input type="checkbox" disabled></td>
                                                <td><input type="checkbox" disabled></td>
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
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/profile.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
