<div class="flex-grow-1 rt-mb-20 mt-3">
    <div class="filtertags">
        @if (request('keyword'))
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="Keyword">
                {{ request('keyword') }}
                <span class="close-tag pointer" onclick="closeField('keyword')">
                    <x-svg.cross-round-icon />
                </span>
            </div>
        @endif
        @if (request('category'))
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="Category">
                {{ request('category') }}
                <span class="close-tag pointer" onclick="closeField('category')">
                    <x-svg.cross-round-icon />
                </span>
            </div>
        @endif
        @if (request('job_role'))
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="role">
                {{ request('job_role') }}
                <span class="close-tag pointer" onclick="closeField('role')">
                    <x-svg.cross-round-icon />
                </span>
            </div>
        @endif
        @php
            $selected_country = session('selected_country');
        @endphp
        @if ($selected_country)
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="Country">
                {{ selected_country()->name }}
                <a href="{{ route('website.remove.country') }}" class="close-tag pointer"
                    onclick="closeField('country')">
                    <x-svg.cross-round-icon />
                </a>
            </div>
        @endif
        @if (request('experience'))
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="Experience">
                {{ request('experience') }}
                <span class="close-tag pointer" onclick="closeField('experience')">
                    <x-svg.cross-round-icon />
                </span>
            </div>
        @endif
        @if (request('education'))
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="Education">
                {{ request('education') }}
                <span class="close-tag pointer" onclick="closeField('education')">
                    <x-svg.cross-round-icon />
                </span>
            </div>
        @endif
        @if (request('is_remote'))
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="Remote Work">
                {{ request('is_remote') ? 'Remote' : '' }}
                <span class="close-tag pointer" onclick="closeField('is_remote')">
                    <x-svg.cross-round-icon />
                </span>
            </div>
        @endif
        @if (request('job_type'))
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="Job Type">
                {{ request('job_type') }}
                <span class="close-tag pointer" onclick="closeField('job_type')">
                    <x-svg.cross-round-icon />
                </span>
            </div>
        @endif
        @if (request('level'))
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="Level">
                {{ request('level') }}
                <span class="close-tag pointer" onclick="closeField('level')">
                    <x-svg.cross-round-icon />
                </span>
            </div>
        @endif
        @if (request('gender'))
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="Gender">
                {{ request('gender') }}
                <span class="close-tag pointer" onclick="closeField('gender')">
                    <x-svg.cross-round-icon />
                </span>
            </div>
        @endif
        @if (request('price_min'))
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="Min Salary">
                ${{ number_format((float) request('price_min'), 0, '.', '') }}
                <span class="close-tag pointer" onclick="closeField('price_min')">
                    <x-svg.cross-round-icon />
                </span>
            </div>
        @endif
        @if (request('price_max'))
            <div class="single-tag" data-bs-toggle="tooltip" data-bs-placement="top" title="Max Salary">
                ${{ number_format((float) request('price_max'), 0, '.', '') }}
                <span class="close-tag pointer" onclick="closeField('price_max')">
                    <x-svg.cross-round-icon />
                </span>
            </div>
        @endif
    </div>
</div>

@push('frontend_scripts')
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        function closeField(field) {
            switch (field) {
                case 'role':
                    $("select[name='job_role']").val('');
                    formSubmit();
                    break;
                case 'keyword':
                    $("input[name='keyword']").val('');
                    formSubmit();
                    break;
                case 'category':
                    $("select[name='category']").val('');
                    formSubmit();
                    break;
                case 'country':
                    $("select[name='country']").val('');
                    formSubmit();
                    break;
                case 'experience':
                    $("input[name*='experience']").val('');
                    formSubmit();
                    break;
                case 'education':
                    $("input[name*='education']").val('');
                    formSubmit();
                    break;
                case 'is_remote':
                    $("input[name='is_remote']").val('');
                    formSubmit();
                    break;
                case 'job_type':
                    $("input[name*='job_type']").val('');
                    formSubmit();
                    break;
                case 'level':
                    $("input[name*='level']").val('');
                    formSubmit();
                    break;
                case 'salary':
                    $("input[name*='salary']").val('');
                    formSubmit();
                    break;
                case 'gender':
                    $("input[name*='gender']").val('');
                    formSubmit();
                    break;
            }
        }

        // Form Submit
        function formSubmit() {
            $('#job_search_form').submit();
        }
    </script>
@endpush
