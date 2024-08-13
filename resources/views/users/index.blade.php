@extends('layouts.master')
@section('title')
    Usuarios
@endsection
@section('css')
    <link href="{{ URL::asset('new_assets/css/customizations.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Usuarios
        @endslot
        @slot('title')
            Listado de usuarios
        @endslot
    @endcomponent
    <div class="card">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-sm-4">
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Buscar">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <div class="col-sm-auto ms-auto">
                    <div class="list-grid-nav hstack gap-1">
                        <a href="{{ route('users.create') }}" type="button" class="btn btn-success add-btn"><i
                                class="ri-add-line align-bottom me-1"></i> @lang('translation.add')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="team-list grid-view-filter row">
                    <div id="col">
                        @foreach ($users as $user)
                            <div class="card team-box col-item">
                                <div class="team-cover">
                                    <img src="{{ URL::asset('storage/' . $user->photo) }}"
                                        onerror="this.onerror=null; this.src='{{ URL::asset('new_assets/images/small/img-9.jpg') }}';"
                                        alt="" class="img-fluid" />
                                </div>
                                <div class="card-body p-4">
                                    <div class="row align-items-center team-row">
                                        <div class="col team-settings">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="bookmark-icon flex-shrink-0 me-2">
                                                        <input type="checkbox" id="favourite1"
                                                            class="bookmark-input bookmark-hide">
                                                        <label for="favourite1" class="btn-star">
                                                            <svg width="20" height="20">
                                                                <use xlink:href="#icon-star" />
                                                            </svg>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col text-end dropdown">
                                                    <a href="javascript:void(0);" id="dropdownMenuLink2"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill fs-17"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="dropdownMenuLink2">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('users.show', ['user' => $user->id]) }}"><i
                                                                    class="ri-eye-line me-2 align-middle"></i>Ver</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('users.edit', ['user' => $user->id]) }}"><i
                                                                    class="ri-quill-pen-fill me-2 align-middle"></i>Editar</a>
                                                        </li>
                                                        <li><button class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#deleteRecordModal{{ $user->id }}"><i
                                                                    class="ri-delete-bin-5-line me-2 align-middle"></i>Eliminar</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col">
                                            <div class="team-profile-img">
                                                <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                    <img src="{{ URL::asset('storage/' . $user->avatar) }}" alt=""
                                                        class="img-fluid d-block rounded-circle" />
                                                </div>
                                                <div class="team-content">
                                                    <a data-bs-toggle="offcanvas" href="#offcanvasExample"
                                                        aria-controls="offcanvasExample">
                                                        <h5 class="fs-16 mb-1">
                                                            {{ $user->name . ' ' . $user->last_name . ' ' . $user->motherlast_name }}
                                                        </h5>
                                                    </a>
                                                    <p class="text-muted mb-0">{{ $user->type }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col">
                                            <div class="row text-muted text-center">
                                                <div class="col-6 border-end border-end-dashed">
                                                    <h5 class="mb-1">{{ $user->city }}</h5>
                                                    <p class="text-muted mb-0">Ciudad</p>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="mb-1">{{ $user->phone }}</h5>
                                                    <p class="text-muted mb-0">Teléfono</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col">
                                            <div class="text-end">
                                                <a class="btn btn-light view-btn" href="{{ route('users.show', ['user' => $user->id]) }}">Ver perfil</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (canAccessPage(auth()->user()->role, 'users.destroy'))
                            <div class="modal fade zoomIn" id="deleteRecordModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width:100px;height:100px"></lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>@lang('translation.are_you_sure')</h4>
                                                </div>
                                            </div>
                                            <form id="deleteForm{{ $user->id }}" method="POST"
                                                action="{{ route('users.destroy', ['user' => $user->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                    <button type="button" class="btn w-sm btn-light"
                                                        data-bs-dismiss="modal">@lang('translation.cancel')</button>
                                                    <button type="submit" class="btn w-sm btn-danger"
                                                        id="delete-record">@lang('translation.yes')</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="modal fade zoomIn" id="deleteRecordModal{{ $user->id }}"
                                tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close"
                                                id="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h3><i class="las la-exclamation-circle"></i> No tienes
                                                permisos para eliminar usuarios</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('new_assets/js/pages/team.init.js') }}"></script>

    <script src="{{ URL::asset('new_assets/js/app.min.js') }}"></script>
@endsection
