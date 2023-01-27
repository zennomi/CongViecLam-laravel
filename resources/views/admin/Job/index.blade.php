@extends('admin.layouts.app')
@section('title')
    {{ __('job_list') }}
@endsection
@section('content')
    @php
    $userr = auth()->user();
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('job_list') }}</h3>
                        <div>
                            <a href="{{ route('job.create') }}"
                                class="btn bg-primary"><i
                                    class="fas fa-plus mr-1"></i> {{ __('create') }}
                            </a>
                            @if (request('title') || request('job_category') || request('job_type') || request('experience') || request('sort_by') || request('filter_by'))
                                <a href="{{ route('job.index') }}"
                                    class="btn bg-danger"><i
                                        class="fas fa-times"></i> &nbsp;{{ __('clear') }}
                                </a>
                            @endif
                       </div>
                    </div>
                </div>

                 {{-- Filter  --}}
                 <form id="formSubmit"  action="{{ route('job.index') }}" method="GET" onchange="this.submit();">
                    <div class="card-body border-bottom row">
                        <div class="col-2">
                            <label>{{ __('search') }}</label>
                            <input name="title" type="text" placeholder="{{ __('search') }}" class="form-control" value="{{ request('title') }}">
                        </div>
                        <div class="col-2">
                            <label>{{ __('job_category') }}</label>
                            <select name="job_category" class="form-control w-100-p">
                                <option value="">
                                    {{ __('all') }}
                                </option>
                                @foreach ($job_categories as $job_category)
                                    <option {{ request('job_category') == $job_category->slug ? 'selected' : '' }} value="{{ $job_category->slug }}">
                                        {{ $job_category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <label>{{ __('job_type') }}</label>
                            <select name="job_type" class="form-control w-100-p">
                                <option value="">
                                    {{ __('all') }}
                                </option>
                                @foreach ($job_types as $job_type)
                                    <option {{ request('job_type') == $job_type->slug ? 'selected' : '' }} value="{{ $job_type->slug }}">
                                        {{ $job_type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <label>{{ __('experience') }}</label>
                            <select name="experience" class="form-control w-100-p">
                                <option value="">
                                    {{ __('all') }}
                                </option>
                                @foreach ($experiences as $experience)
                                    <option {{ request('experience') == $experience->slug ? 'selected' : '' }} value="{{ $experience->slug }}">
                                        {{ $experience->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <label>{{ __('sort_by') }}</label>
                            <select name="sort_by" class="form-control w-100-p">
                                <option {{ !request('sort_by') || request('sort_by') == 'latest' ? 'selected' : '' }}
                                    value="latest" selected>
                                    {{ __('latest') }}
                                </option>
                                <option {{ request('sort_by') == 'oldest' ? 'selected' : '' }} value="oldest">
                                    {{ __('oldest') }}
                                </option>
                            </select>
                        </div>
                        <div class="col-2">
                            <label>{{ __('filter_by') }}</label>
                            <select name="filter_by" class="form-control w-100-p">
                                <option {{ request('filter_by') ? '' : 'selected' }}
                                    value="">
                                    {{ __('all') }}
                                </option>
                                <option {{ request('filter_by') == 'active' ? 'selected' : '' }}
                                    value="active">
                                    {{ __('active') }}
                                </option>
                                <option {{ request('filter_by') == 'pending' ? 'selected' : '' }}
                                    value="pending">
                                    {{ __('pending') }}
                                </option>
                                <option {{ request('filter_by') == 'expired' ? 'selected' : '' }}
                                    value="expired">
                                    {{ __('expired') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0 m-0">
                    @include('admin.layouts.partials.message')
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th width="2%">#</th>
                                        <th width="5%">{{ __('title') }}</th>
                                        <th width="10%">{{ __('experience') }}</th>
                                        <th width="10%">{{ __('job_type') }}</th>
                                        <th width="10%">{{ __('deadline') }}</th>
                                        <th width="10%">{{ __('status') }}</th>
                                        @if (userCan('job.update') || userCan('job.delete'))
                                            <th width="10%">{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($jobs->count() > 0)
                                        @foreach ($jobs as $job)
                                            <tr>
                                                <td class="text-center" tabindex="0">
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td class="text-center" tabindex="0">
                                                    <a href="{{ route('job.show', $job->id) }}">
                                                        {{ $job->title }}
                                                    </a>
                                                </td>
                                                <td class="text-center" tabindex="0">
                                                    {{ $job->experience->name }}
                                                </td>
                                                <td class="text-center" tabindex="0">
                                                    {{ $job->job_type ? $job->job_type->name : '' }}
                                                </td>
                                                <td class="text-center" tabindex="0">
                                                    {{ date('j F, Y', strtotime($job->deadline)) }}
                                                </td>
                                                @if (userCan('job.update'))
                                                    <td class="text-center" tabindex="0">
                                                        <div class="d-flex justify-content-center input-group-prepend">
                                                            <button type="button"
                                                                class="btn-sm btn-{{ $job->status == 'active' ? 'success' : ($job->status == 'pending' ? 'info' : 'danger') }} dropdown-toggle"
                                                                data-toggle="dropdown">
                                                                {{ __($job->status) }}
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <form
                                                                    action="{{ route('admin.job.status.change', $job->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="status" value="active">
                                                                    <button type="submit"
                                                                        class="btn bg-white text-left w-100-p"><span
                                                                            class="text-primary">{{ __('active') }}</span>
                                                                    </button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('admin.job.status.change', $job->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="status" value="pending">
                                                                    <button type="submit"
                                                                        class="btn bg-white text-left w-100-p"><span
                                                                            class="text-primary">{{ __('pending') }}</span>
                                                                    </button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('admin.job.status.change', $job->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="status" value="expired">
                                                                    <button type="submit"
                                                                        class="btn bg-white text-left w-100-p"><span
                                                                            class="text-primary">{{ __('expired') }}</span>
                                                                    </button>
                                                                </form>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                @endif
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('clone') }}"
                                                        href="{{ route('admin.job.clone', $job->slug) }}"
                                                        class="btn bg-warning ml-1"><i class="fas fa-clone"></i>
                                                    </a>
                                                    <a data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('details') }}"
                                                        href="{{ route('job.show', $job->id) }}"
                                                        class="btn bg-info ml-1"><i class="fas fa-eye"></i>
                                                    </a>
                                                    @if (userCan('job.update'))
                                                        <a data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('edit') }}"
                                                            href="{{ route('job.edit', $job->id) }}"
                                                            class="btn bg-primary ml-1"><i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    @if (userCan('job.delete'))
                                                        <form action="{{ route('job.destroy', $job->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button data-toggle="tooltip" data-placement="top" title="{{ __('delete') }}"
                                                                onclick="return confirm('Are you sure you want to delete this item?');"
                                                                class="btn bg-danger ml-1"><i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">{{ __('no_data_found') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($jobs->total() > $jobs->perPage())
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $jobs->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            validate();
            $('#title').keyup(validate);
        });

        function validate() {
            if (
                $('#title').val().length > 0) {
                $('#crossB').removeClass('d-none');
            } else {
                $('#crossB').addClass('d-none');
            }
        }

        function RemoveFilter(id) {
            $('#' + id).val('');
            $('#formSubmit').submit();
        }
    </script>
@endsection
