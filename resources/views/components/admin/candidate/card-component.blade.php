<div class="card">
    <div class="card-header">
        <h3 class="card-title line-height-36">
            {{ $title }}
        </h3>
    </div>
    <table class="table table-hover text-nowrap table-bordered">
        <thead>
            <tr class="text-center">
                <th width="2%">#</th>
                <th width="5%">{{ __('title') }}</th>
                <th width="10%">{{ __('experience') }}</th>
                <th width="10%">{{ __('job_type') }}</th>
                <th width="10%">{{ __('deadline') }}</th>
                <th width="10%">{{ __('status') }}</th>
                <th width="10%">{{ __('action') }}</th>
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
                            {{ $job->title }}
                        </td>
                        <td class="text-center" tabindex="0">
                            {{ $job->experience ? $job->experience->name : '' }}
                        </td>
                        <td class="text-center" tabindex="0">
                            {{ $job->job_type ? $job->job_type->name : '' }}
                        </td>
                        <td class="text-center" tabindex="0">
                            {{ date('j F, Y', strtotime($job->deadline)) }}
                        </td>
                        <td class="text-center" tabindex="0">
                            <div class="d-flex justify-content-center input-group-prepend">
                                <button type="button"
                                    class="btn-sm btn-{{ $job->status == 'active' ? 'success' : ($job->status == 'pending' ? 'info' : 'danger') }} dropdown-toggle"
                                    data-toggle="dropdown">
                                    {{ __($job->status) }}
                                </button>
                                <ul class="dropdown-menu">
                                    <form action="{{ route('admin.job.status.change', $job->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="active">
                                        <button type="submit" class="btn bg-white text-left w-100-p"><span
                                                class="text-primary">{{ __('active') }}</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.job.status.change', $job->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit" class="btn bg-white text-left w-100-p"><span
                                                class="text-primary">{{ __('pending') }}</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.job.status.change', $job->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="expired">
                                        <button type="submit" class="btn bg-white text-left w-100-p"><span
                                                class="text-primary">{{ __('expired') }}</span>
                                        </button>
                                    </form>
                                </ul>
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('job.show', $job->slug) }}" class="btn bg-info ml-1"><i
                                    class="fas fa-eye"></i></a>
                            <a href="{{ route($link, $job->slug) }}"
                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                class="d-inline btn btn-danger"><i class="fas fa-trash"></i>
                            </a>
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
