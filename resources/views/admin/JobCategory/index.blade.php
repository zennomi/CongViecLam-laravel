@extends('admin.layouts.app')
@section('title')
    {{ __('job_category_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('job_category_list') }}</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>{{ __('image') }}</th>
                                    <th>{{ __('icon') }}</th>
                                    <th>{{ __('name') }}</th>
                                    @if (userCan('job_category.update') || userCan('job_category.delete'))
                                        <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jobCategories as $category)
                                    <tr>
                                        <td><img src="{{ $category->image_url }}" alt="" height="50px" width="50px"></td>
                                        <td>
                                            <i class="{{ $category->icon }}"></i>
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            @if (userCan('job_category.update'))
                                                <a href="{{ route('jobCategory.edit', $category->slug) }}"
                                                    class="btn bg-info"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if (userCan('job_category.delete'))
                                                <form action="{{ route('jobCategory.destroy', $category->slug) }}"
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
                            {{ $jobCategories->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if (!empty($jobCategory) && userCan('job_category.update'))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title line-height-36">{{ __('edit') }}</h3>
                            <a href="{{ route('jobCategory.index') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-plus mr-1"></i>{{ __('create') }}
                            </a>
                        </div>
                        <div class="card-body m-auto">
                            <div class="pt-3 pb-4">
                                <form class="form-horizontal"
                                    action="{{ route('jobCategory.update', $jobCategory->slug) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name">
                                            {{ __('name') }} <x-forms.required />
                                        </label>
                                        <input id="name" type="text" name="name"
                                            value="{{ old('name', $jobCategory->name) }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label>{{ __('image') }}</label>
                                        <input name="image" class="form-control-file" autocomplete="image" type="file"
                                            id="image">
                                    </div>
                                    <div class="form-group row">
                                        <div>
                                            <label>{{ __('icon') }}</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="hidden" name="icon" id="icon"
                                                value="{{ $jobCategory->icon }}" />
                                            <div id="target"></div>
                                            @error('icon')
                                                <span class="invalid-feedback d-block"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row m-auto">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sync mr-1"></i>
                                            {{ __('save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                @if (empty($jobCategory) && userCan('job_category.create'))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title line-height-36">{{ __('create') }}</h3>
                        </div>
                        <div class="card-body m-auto">
                            <div class="pt-3 pb-4">
                                @if (userCan('job_category.create'))
                                    <form class="form-horizontal" action="{{ route('jobCategory.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name">
                                                {{ __('name') }} <x-forms.required />
                                            </label>
                                            <input id="name" type="text" name="name" placeholder="{{ __('name') }}"
                                                value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label>{{ __('image') }}</label>
                                            <input name="image" class="form-control-file" autocomplete="image" type="file"
                                                id="image">
                                        </div>
                                        <div class="form-group row">
                                            <div>
                                                <label>{{ __('icon') }} <x-forms.required /></label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="hidden" name="icon" id="icon" value="{{ old('icon') }}" />
                                                <div id="target"></div>
                                                @error('icon')
                                                    <span class="invalid-feedback d-block"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row m-auto">
                                            <button type="submit" class="btn btn-success">
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
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('style')
    <!-- Bootstrap-Iconpicker -->
    <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css" />
@endsection

@section('script')
    <!-- Bootstrap-Iconpicker Bundle -->
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.min.js"></script>

    <script>
        $('#target').iconpicker({
            align: 'left', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 8,
            footer: true,
            header: true,
            icon: '{{ $jobCategory->icon ?? 'fas fa-bomb' }}',
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 4,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });

        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });
    </script>
@endsection
