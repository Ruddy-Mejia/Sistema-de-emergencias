@extends('layouts.master')
@section('title')
    Analíticas
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboards
        @endslot
        @slot('title')
            Analíticas
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xxl-5">
            <div class="d-flex flex-column h-100">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Usuarios</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $users }}">0</span></h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> {{ $avr_usr }} %
                                            </span> vs. el anterior mes</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                <i class="ri-team-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Pacientes</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $patients }}">0</span></h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i> {{ $avr_ptn }} %
                                            </span> vs. el anterior mes</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                <i class="ri-group-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Conductores</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $conductors }}">0</span></h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> {{ $avr_drv }} %
                                            </span> vs. el anterior mes</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                <i class="ri-car-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Ambulancias</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $ambulances }}">0</span></h2>
                                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i> {{ $avr_amb }} %
                                            </span> vs. el anterior mes</p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded-circle fs-2">
                                                <i class="ri-shield-cross-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>


            </div>
        </div> <!-- end col-->

        <div class="col-xxl-7">
            <div class="row h-100">
                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Ubicación de incidentes</h4>
                        </div>

                        <div class="card-body">

                            {{-- <div id="users-by-country" data-colors='["--vz-light"]' class="text-center"
                                style="height: 252px"></div> --}}
                            <div class="mb-3">
                                <div id="maps-dashboard" class="gmaps"></div>
                            </div>

                            {{-- <div class="table-responsive table-card mt-3">
                                <table
                                    class="table table-borderless table-sm table-centered align-middle table-nowrap mb-1">
                                    <thead
                                        class="text-muted border-dashed border border-start-0 border-end-0 bg-soft-light">
                                        <tr>
                                            <th>Duration (Secs)</th>
                                            <th style="width: 30%;">Sessions</th>
                                            <th style="width: 30%;">Views</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        <tr>
                                            <td>0-30</td>
                                            <td>2,250</td>
                                            <td>4,250</td>
                                        </tr>
                                        <tr>
                                            <td>31-60</td>
                                            <td>1,501</td>
                                            <td>2,050</td>
                                        </tr>
                                        <tr>
                                            <td>61-120</td>
                                            <td>750</td>
                                            <td>1,600</td>
                                        </tr>
                                        <tr>
                                            <td>121-240</td>
                                            <td>540</td>
                                            <td>1,040</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
                        </div>
                    </div>
                </div>
                {{-- incidentes por mes --}}
                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Incidentes por mes en {{ $th_year }}</h4>
                        </div>
                        <div class="card-body p-0 pb-2">
                            <script>
                                var data = @json($incidents);
                                var data1 = @json($ly_incidents);
                                var data_maps = @json($locations);
                            </script>
                            <div>
                                <div id="audiences_metrics_charts" data-colors='["--vz-success", "--vz-gray-300"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/libs/jsvectormap//world-merc.js') }}"></script> --}}

    <!-- dashboard init -->
    {{-- <script src="{{ URL::asset('/assets/js/pages/dashboard-analytics.init.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/js/charts.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyD14FXg7RSqEAMXUW0_UzCsBbIc5UEFduU"></script> -->
    <script src="https://maps.google.com/maps/api/js"></script>
    <script src="{{ URL::asset('assets/libs/gmaps/gmaps.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/maps.js') }}"></script>
@endsection
