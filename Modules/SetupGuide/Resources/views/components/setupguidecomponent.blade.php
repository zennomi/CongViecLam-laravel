<div class="mb-4 py-3">
    <div class="card rounded shadow-none border setup-guide-sizing">
        <div class="text-left py-2 px-4 alert alert-warning mb-0">
            <h5>{{ __('warning') }}</h5>
            <h2>{{ __('complete_your_project_setup') }}!</h2>
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($data as $item)
                <li class="list-group-item">
                    <div class="p-2">
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <div class="d-flex align-items-center">
                                @if ($item->status)
                                    <div class="mr-4 text-success">
                                        <svg viewBox="0 0 24 24" width="50" height="50" stroke="currentColor"
                                            stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            class="css-i6dzq1">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                @else
                                    <div class="mr-4 text-warning">
                                        <svg viewBox="0 0 24 24" width="50" height="50" stroke="currentColor"
                                            stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            class="css-i6dzq1">
                                            <path
                                                d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                                            </path>
                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <h5> {{ $item->title }} </h5>
                                    <p class="mb-0">{{ $item->description }}</p>
                                </div>
                            </div>
                            @if (!$item->status)
                                <a href="{{ route($item->action_route) }}" class="btn btn-success">
                                    {{ $item->action_label }}
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
