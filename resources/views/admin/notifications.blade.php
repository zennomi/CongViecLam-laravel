@extends('admin.layouts.app')
@section('title')
    {{ __('notifications') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('notifications') }}</h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bell mr-2"></i>
                        {{ __('notifications') }}
                    </h3>
                </div>
                <div class="card-body">
                    @if ($notifications->count() > 0)
                        @foreach ($notifications as $notification)
                            @php
                                $class = ['callout-danger', 'callout-info', 'callout-warning', 'callout-success'];
                                $rand_keys = array_rand($class, 2);
                            @endphp
                            <div class="callout {{ $class[$rand_keys[0]] }}">
                                <h5>{{ $notification->data['title'] }}!</h5>
                                <a class="text-primary text-decoration-none" href="#" onclick="return false;">
                                    {{ $notification->data['title'] }}
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="empty py-5 d-flex justify-content-center text-ceter">
                            <x-not-found message="{{ __('no_data_found') }}" />
                        </div>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
