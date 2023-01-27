@extends('admin.layouts.app')
@section('title')
    {{ __('profession_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('profession_list') }}
                            ({{ $professions ? $professions->total() : '0' }})</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }}</th>
                                    @if (userCan('professions.update') || userCan('professions.delete'))
                                        <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($professions as $profession)
                                    <tr>
                                        <td>{{ $profession->id }}</td>
                                        <td>{{ $profession->name }}</td>
                                        <td>
                                            @if (userCan('professions.update'))
                                                <a href="{{ route('profession.edit', $profession->slug) }}"
                                                    class="btn bg-info"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if (userCan('professions.delete'))
                                                <form action="{{ route('profession.destroy', $profession->slug) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button
                                                        onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
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
                            {{ $professions->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if (!empty($prof) && userCan('professions.update'))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title line-height-36">{{ __('edit') }}</h3>
                            <a href="{{ route('profession.index') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-plus mr-1"></i>{{ __('create') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="pt-3 pb-4">
                                <form class="form-horizontal" action="{{ route('profession.update', $prof->slug) }}"
                                    method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group row">
                                        <x-forms.label name="name" for="name" :required="true" class="col-sm-2 col-form-label"/>
                                        <div class="col-sm-10">
                                            <input id="name" type="text" name="name"
                                                value="{{ old('name', $prof->name) }}"
                                                placeholder="Enter Profession Name"
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
                                            {{ __('update') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                @if (empty($prof) && userCan('professions.create'))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title line-height-36">{{ __('create') }}</h3>
                        </div>
                        <div class="card-body">
                            @if (userCan('job_role.create'))
                                <form class="form-horizontal" action="{{ route('profession.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <x-forms.label name="name" for="name" :required="true" class="col-sm-2 col-form-label"/>
                                        <div class="col-sm-10">
                                            <input id="name" type="text" name="name" placeholder="{{ __('name') }}"
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
