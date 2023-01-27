@extends('admin.layouts.app')
@section('title')
    {{ __('dashboard') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('dashboard') }}</h1>
        </div>
    </div>
@endsection
@section('content')
    @if($appSetup->where('status', 0)->count())
        <x-setup-guide />
    @endif
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('earnings') }}</span>
                    <span class="info-box-number">
                        {{ currencyPosition($data['earnings']) }} @if($data['earnings'] == null || $data['earnings'] == 0) 0 @endif
                        <span data-toggle="tooltip"
                            title="All the earnings are converted to '{{ config('jobpilot.currency') }}' currency">
                            <x-svg.info-icon />
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('total_candidates') }}</span>
                    <span class="info-box-number"> {{ $data['candidates'] }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('total_employers') }}</span>
                    <span class="info-box-number">{{ $data['companies'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('total_verified_users') }}</span>
                    <span class="info-box-number">{{ $data['verified_users'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-briefcase"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('active_jobs') }}</span>
                    <span class="info-box-number">{{ $data['active_jobs'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-briefcase"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('expired_jobs') }}</span>
                    <span class="info-box-number">{{ $data['expire_jobs'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-briefcase"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('pending_jobs') }}</span>
                    <span class="info-box-number">{{ $data['pending_jobs'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-briefcase"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('all_jobs') }}</span>
                    <span class="info-box-number">{{ $data['all_jobs'] }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <!-- BAR CHART -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('your_earnings_overview_of_this_year') }}</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" class="chart-design"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('popular_location') }}</h3>
                </div>
                @if (count($popular_countries->pluck('country')->all()) == 0)
                <div class="card-body">
                    <table class="table table-vcenter mb-0">
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <div class="empty py-5">
                                            <x-not-found message="{{ __('no_data_found') }}" />
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <div class="card-body">
                    <canvas id="locationChart" class="chart-design"></canvas>
                </div>
                @endif
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ __('recently_published_jobs') }}</h3>
                        <a href="{{ route('job.index') }}" class="btn btn-dark">{{ __('view_all') }}</a>
                    </div>
                </div>
                <div class="card-table table-responsive p-0">
                    <table class="table table-vcenter mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('title') }}</th>
                                <th>{{ __('experience') }}</th>
                                <th>{{ __('job_type') }}</th>
                                <th>{{ __('action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($latest_jobs->count() > 0)
                                @foreach ($latest_jobs as $latest)
                                    <tr>
                                        <td>
                                            <a href="{{ route('job.show', $latest->slug) }}">
                                                {{ $latest->title }}
                                            </a>
                                        </td>
                                        <td class="text-muted">
                                            {{ $latest->experience ? $latest->experience->name : '' }}</td>
                                        <td class="text-muted">{{ $latest->job_type ? $latest->job_type->name : '' }}
                                        </td>
                                        <td class="text-muted">
                                            <a href="{{ route('job.show', $latest->slug) }}" class="btn bg-info ml-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <div class="empty py-5">
                                            <x-not-found message="{{ __('no_data_found') }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ __('recently_purchased_orders') }}</h3>
                        <a href="{{ route('order.index') }}" class="btn btn-dark">{{ __('view_all') }}</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('order_no') }}</th>
                                <th>{{ __('amount') }}</th>
                                <th>{{ __('plan_name') }}</th>
                                <th>{{ __('payment_provider') }}</th>
                                <th>{{ __('payment_status') }}</th>
                                <th>{{ __('created_time') }}</th>
                                <th></th>
                                <th class="text-center">{{ __('actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($latest_earnings->count() > 0)
                                @foreach ($latest_earnings as $earning)
                                    <tr>
                                        <td>
                                            #{{ $earning->order_id }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $earning->currency_symbol }}{{ $earning->amount }}
                                        </td>
                                        <td class="text-muted">
                                            <span class="badge badge-primary">
                                                {{ $earning->plan->label }}
                                            </span>
                                        </td>
                                        <td class="text-muted">
                                            @if ($earning->payment_provider == 'offline')
                                                Offline
                                                @if (isset($earning->manualPayment->name))
                                                    (<b>{{ $earning->manualPayment->name }}</b>)
                                                @endif
                                            @else
                                                {{ ucfirst($earning->payment_provider) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($earning->payment_status == 'paid')
                                                <span class="badge badge-pill bg-success">{{ __('paid') }}</span>
                                            @else
                                                <span class="badge badge-pill bg-warning">{{ __('unpaid') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-muted">
                                            {{ $earning->created_at->diffForHumans() }}
                                        </td>
                                        <td class="text-muted">
                                        <td class="d-flex">
                                            <a href="{{ route('order.show', $earning->id) }}"
                                                class="btn bg-primary mr-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.transaction.invoice.download', $earning->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-info">
                                                    <i class=" fas fa-download"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="empty py-5">
                                            <x-not-found message="{{ __('no_data_found') }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ __('latest_users') }}</h3>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('candidate.index') }}" class="btn btn-success mr-1">
                                {{ __('view_all_candidates') }}</a>
                            <a href="{{ route('company.index') }}" class="btn btn-info">{{ __('view_all_company') }}</a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('email') }}</th>
                                    <th>{{ __('role') }}</th>
                                    <th>{{ __('status') }}</th>
                                    @if ($data['email_verification'])
                                        <th>{{ __('email_verification') }}</th>
                                    @endif
                                    <th>{{ __('created_time') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count() > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $user->name }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $user->email }}
                                            </td>
                                            <td class="text-muted">
                                                @if ($user->role == 'company')
                                                    <span class="badge badge-info">
                                                        {{ ucfirst($user->role) }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-success">
                                                        {{ ucfirst($user->role) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-muted">
                                                {{ $user->status ? __('active') : __('inactive') }}
                                            </td>
                                            @if (userCan('candidate.update') && $data['email_verification'])
                                                <td class="text-center" tabindex="0">
                                                    {{ $user->email_verified_at ? __('verified') : __('not_verified') }}
                                                </td>
                                            @endif
                                            <td class="text-muted">
                                                {{ $user->created_at->diffForHumans() }}
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ $user->role == 'company' ? route('company.show', $user->company->id) : route('candidate.show', $user->candidate->id) }}"
                                                    class="btn bg-primary mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="7">
                                            <div class="empty py-5">
                                                <x-not-found message="{{ __('no_data_found') }}" />
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script src="{{ asset('backend') }}/plugins/chart.js/Chart.min.js"></script>
        <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script>
            var areaChartData = {
                // labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: {!! json_encode($earnings['months']) !!},
                datasets: [{
                    label: 'Earnings',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    // data: {!! json_encode($earnings) !!}
                    data: {!! json_encode($earnings['amount']) !!}
                }, ]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp = areaChartData.datasets
            barChartData.datasets = temp

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                display: false
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            var locationChart = $('#locationChart').get(0).getContext('2d')
            var locationData = {
                labels: {!! json_encode($popular_countries->pluck('country')->all()) !!},
                datasets: [{
                    data: {!! json_encode($popular_countries->pluck('total')->all()) !!},
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#AE4CCF',
                        '#FF5F7E', '#99FEFF', '#000000', '#FB3640'
                    ],
                }]
            }
            var locationChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(locationChart, {
                type: 'pie',
                data: locationData,
                options: locationChartOptions
            })
        </script>
    @endsection

    @section('style')
        <style>
            .chart-design {
                height: 230px;
                min-height: 230px
            }
        </style>
    @endsection
