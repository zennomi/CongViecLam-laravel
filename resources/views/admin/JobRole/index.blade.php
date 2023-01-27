@extends('admin.layouts.app')
@section('title')
    {{ __('job_role_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('job_role_list') }}</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('jobs') }}</th>
                                    @if (userCan('job_role.update') || userCan('job_role.delete'))
                                        <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jobRoles as $key => $jobrole)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $jobrole->name }}</td>
                                        <td>{{ $jobrole->jobs_count }} {{ __('jobs') }}</td>
                                        <td>
                                            @if (userCan('job_role.update'))
                                                <a href="{{ route('jobRole.edit', $jobrole->slug) }}" class="btn bg-info"><i
                                                        class="fas fa-edit"></i></a>
                                            @endif
                                            @if (userCan('job_role.delete'))
                                                <form action="{{ route('jobRole.destroy', $jobrole->slug) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                                        class="btn bg-danger"><i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            {{ __('no_data_found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="col-3 m-auto">
                            {{ $jobRoles->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if (!empty($jobRole) && userCan('job_role.update'))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title line-height-36">{{ __('edit') }}</h3>
                            <a href="{{ route('jobRole.index') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-plus mr-1"></i>{{ __('create') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="pt-3 pb-4">
                                <form class="form-horizontal" action="{{ route('jobRole.update', $jobRole->slug) }}"
                                    method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group row">
                                        <x-forms.label name="name" for="name" :required="true" />
                                        <div class="col-sm-10">
                                            <input id="name" type="text" name="name"
                                                value="{{ old('name', $jobRole->name) }}"
                                                class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row m-auto">
                                        <button type="submit" class="btn btn-success offset-sm-2">
                                            <i class="fas fa-sync mr-1"></i>
                                            {{ __('save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                @if (empty($jobRole) && userCan('job_role.create'))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title line-height-36">{{ __('create') }}</h3>
                        </div>
                        <div class="card-body">
                            @if (userCan('job_role.create'))
                                <form class="form-horizontal" action="{{ route('jobRole.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <x-forms.label name="name" for="name" :required="true" />
                                        <div class="col-sm-10">
                                            <input id="name" type="text" name="name"
                                                placeholder="{{ __('enter') }} {{ __('name') }}"
                                                value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row m-auto">
                                        <button type="submit" class="btn btn-success offset-sm-2">
                                            <i class="fas fa-plus mr-1"></i>
                                            {{ __('save') }}
                                        </button>
                                    </div>
                                </form>
                            @else
                                <p>{{ __('dont_have_permission') }}</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
