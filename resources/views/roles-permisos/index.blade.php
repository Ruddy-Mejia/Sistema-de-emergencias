@extends('layouts.master')
@section('title')
    Roles & Permisos
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Lista de Roles
        @endslot
        @slot('title')
            Roles
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Roles de usuario</h4>
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
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('roles.create') }}" class="btn btn-success add-btn"
                                        role="button"><i class="ri-add-line align-bottom me-1"></i> Añadir</a>
                                </div>
                            </div>
                        </div>
                {{-- <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Listado de Roles</h4>
                </div> --}}

                <div class="card-body">
                    <div class="live-preview">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nombre</th>
                                    <th>Nombre de guardia</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->guard_name }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('roles.show', $role->id) }}">Ver
                                                Detalles</a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('roles.edit', $role->id) }}">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
