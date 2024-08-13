@extends('layouts.master')
@section('title')
    Roles & Permisos
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Roles
        @endslot
        @slot('title')
            Nuevo Rol
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Nuevo Rol</h4>
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
                    <p class="text-muted">Crea un rol para determinar quienes podran acceder al sistema y con que permisos.
                    </p>
                    <div class="live-preview">
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre del Rol</label>
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre del rol"
                                            name="name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="permisos" class="form-label">@lang('translation.permissionss')</label>
                                        {{-- <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>@lang('translation.permissionss')</th>
                                                    <th>@lang('translation.select')</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($pages as $page)
                                                    <tr>
                                                        <td>{{ $page->name }}</td>
                                                        <td><input type="checkbox" name="pages[]"
                                                                value="{{ $page->id }}"></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table> --}}
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
                                                        <td><input type="checkbox" name="pages[]"
                                                                value="{{ $user->id }}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Pacientes</td>
                                                    @foreach ($patients as $user)
                                                        <td><input type="checkbox" name="pages[]"
                                                                value="{{ $user->id }}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Incidentes</td>
                                                    @foreach ($incidents as $user)
                                                        <td><input type="checkbox" name="pages[]"
                                                                value="{{ $user->id }}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Llamadas</td>
                                                    @foreach ($calls as $user)
                                                        <td><input type="checkbox" name="pages[]"
                                                                value="{{ $user->id }}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Conductores</td>
                                                    @foreach ($conductors as $user)
                                                        <td><input type="checkbox" name="pages[]"
                                                                value="{{ $user->id }}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Ambulancias</td>
                                                    @foreach ($ambulances as $user)
                                                        <td><input type="checkbox" name="pages[]"
                                                                value="{{ $user->id }}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Despachos</td>
                                                    @foreach ($dispatches as $user)
                                                        <td><input type="checkbox" name="pages[]"
                                                                value="{{ $user->id }}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Hospitales</td>
                                                    @foreach ($hospitals as $user)
                                                        <td><input type="checkbox" name="pages[]"
                                                                value="{{ $user->id }}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Páginas</td>
                                                    @foreach ($pages as $user)
                                                        <td><input type="checkbox" name="pages[]"
                                                                value="{{ $user->id }}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Roles</td>
                                                    @foreach ($roles as $user)
                                                        <td><input type="checkbox" name="pages[]"
                                                                value="{{ $user->id }}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Respuestas</td>
                                                    <td><input type="checkbox" name="pages[]"
                                                            value="{{ $responses[0]->id }}"></td>
                                                    <td><input type="checkbox" disabled></td>
                                                    <td><input type="checkbox" name="pages[]"
                                                            value="{{ $responses[1]->id }}"></td>
                                                    <td><input type="checkbox" disabled></td>
                                                    <td><input type="checkbox" disabled></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Guardar Rol</button>
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
@endsection
