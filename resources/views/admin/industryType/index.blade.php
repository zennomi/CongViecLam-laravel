@extends('admin.layouts.app')
@section('title')
    {{ __('industry_types_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('industry_types_list') }}
                            ({{ $industrytypes ? $industrytypes->total() : '0' }})</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }}</th>
                                    @if (userCan('industry_types.update') || userCan('industry_types.delete'))
                                        <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($industrytypes as $key => $industrytype)
                                    <tr>
                                        <td>{{ $industrytype->id }}</td>
                                        <td>{{ $industrytype->name }}</td>
                                        <td>
                                            @if (userCan('industry_types.update'))
                                                <a href="{{ route('industryType.edit', $industrytype->slug) }}"
                                                    class="btn bg-info"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if (userCan('industry_types.delete'))
                                                <form action="{{ route('industryType.destroy', $industrytype->slug) }}"
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
                        <div class="col-3 m-auto pt-3">
                            {{ $industrytypes->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if (!empty($industry_type) && userCan('industry_types.update'))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title line-height-36">{{ __('edit') }}</h3>
                            <a href="{{ route('industryType.index') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-plus mr-1"></i>{{ __('create') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="pt-3 pb-4">
                                <form class="form-horizontal"
                                    action="{{ route('industryType.update', $industry_type->slug) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group row">
                                        <x-forms.label name="name" for="name" :required="true" />
                                        <div class="col-sm-10">
                                            <input id="name" type="text" name="name"
                                                value="{{ old('name', $industry_type->name) }}"
                                                placeholder="{{ __('name') }}"
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
                @if (empty($industry_type) && userCan('industry_types.create'))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title line-height-36">{{ __('create') }}</h3>
                        </div>
                        <div class="card-body">
                            @if (userCan('industry_types.create'))
                                <form class="form-horizontal" action="{{ route('industryType.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <x-forms.label name="name" for="name" :required="true" />
                                        <div class="col-sm-10">
                                            <input id="name" type="text" name="name"
                                                placeholder="{{ __('name') }}" value="{{ old('name') }}"
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
