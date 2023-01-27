@props(['column'])
<div class="w-100 all-application-column column">
    <div class="column-title d-flex justify-content-between align-items-center">
        <h4>{{ $column->name }}</h4>
        <div class="dot-icon">
            <button class="btn" id="col-dropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="5.5" cy="12" r="1.5" fill="#18191C" />
                    <circle cx="12" cy="12" r="1.5" fill="#18191C" />
                    <circle cx="18.5" cy="12" r="1.5" fill="#18191C" />
                </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-end company-dashboard-dropdown"
                aria-labelledby="col-dropdown">
                <li>
                    <a onclick="EditColumn('{{ $column->id }}','{{ $column->name }}')" class="dropdown-item" href="javascript:void(0)">
                        <x-svg.edit-icon />
                        <span>Edit Column</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="dropdown-item"
                            onclick="if (confirm('{{ __('are_you_sure') }}')){event.preventDefault();document.getElementById('column-delete-form').submit()}else{return false}">
                        <x-svg.trash-icon />
                        <span>{{ __('delete') }}</span>
                    </a>
                    <form id="column-delete-form" action="{{ route('company.applications.column.destroy', $column->id) }}" method="POST"
                        class="d-none invisible">
                        @csrf
                        @method('DELETE')
                    </form>
                </li>
            </ul>
        </div>
    </div>
        <div class="application-card-wrapper">
            <div class="application-card" draggable="true" data-toggle="modal"
                onclick="showCandidateProfileModal('1')">
                <div class="appliaction-card-top">
                    {{-- <div class="profile-img">
                        <img width="48px" height="48px"
                            src="{{ asset($application->candidate->photo) }}" alt="">
                    </div> --}}
                    {{-- <div class="profile-info">
                        <a href="{{ route('website.candidate.details', $application->candidate->user->username) }}"
                            class="name">{{ $application->candidate->user->name }}</a href="">
                        <h4 class="designation">@if ($application->candidate->profession)
                            {{ ucfirst($application->candidate->profession->name) }}
                            @endif</h4>
                    </div> --}}
                </div>
                <hr>
                <div class="application-card-bottom">
                    <ul class="lists">
                        <li>7 Years Experience</li>
                        <li>Education: Master Degree</li>
                        <li>Applied: Jan 23, 2022</li>
                    </ul>
                    <div class="download-cv-btn">
                        <button class="btn">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.71875 8.59375L10 11.8741L13.2812 8.59375"
                                    stroke="#0A65CC" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M10 3.125V11.8727" stroke="#0A65CC" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16.875 11.875V16.25C16.875 16.4158 16.8092 16.5747 16.6919 16.6919C16.5747 16.8092 16.4158 16.875 16.25 16.875H3.75C3.58424 16.875 3.42527 16.8092 3.30806 16.6919C3.19085 16.5747 3.125 16.4158 3.125 16.25V11.875"
                                    stroke="#0A65CC" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            <span>Download Cv</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
</div>
