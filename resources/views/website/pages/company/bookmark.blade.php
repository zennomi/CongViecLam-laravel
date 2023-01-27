@extends('website.layouts.app')

@section('title', __('bookmarks'))

@section('main')
    <div class="dashboard-wrapper">
        <div class="container">
            <div class="row">
                {{-- Sidebar --}}
                <x-website.company.sidebar />

                <div class="col-lg-9">
                    <div class="dashboard-right">
                        <div class="row d-flex justify-content-between p-2">
                            <div class="col-sm-12 col-md-6">
                                <h3 class="f-size-18 lh-1 mb-2 p-2">
                                    {{ __('bookmarks') }}
                                    <span class="text-gray-400">({{ $bookmarks->total() }})</span>
                                </h3>
                            </div>
                            <div class="col-sm-12 col-md-6 d-flex justify-content-between">
                                <form id="categoryForm" action="{{ route('company.bookmark') }}" method="GET">
                                    <div class="header-dropdown d-flex">
                                        <h3 class="f-size-18 lh-1 mb-2 p-2">
                                            {{ __('filter') }}
                                        </h3>
                                        <select onchange="CategoryForm()" name="category" class="rt-selectactive w-100-p">
                                            <option value="all">{{ __('all') }}</option>
                                            @foreach ($categories as $cat)
                                                <option {{ request('category') == $cat->id ? 'selected' : '' }}
                                                    value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                                <a href="{{ route('company.bookmark.category.index') }}">
                                    <button type="button" class="btn btn-outline-primary">
                                        {{ __('category') }}
                                    </button>
                                </a>
                                <div class="sidebar-open-nav">
                                    <i class="ph-list"></i>
                                </div>
                            </div>
                        </div>
                        @if ($bookmarks->count() > 0)
                            @foreach ($bookmarks as $candidate)
                                <div class="card jobcardStyle1 saved-candidate">
                                    <div class="card-body">
                                        <div class="rt-single-icon-box ">
                                            <div class="icon-thumb">
                                                <div class="profile-image">
                                                    <a
                                                    href="javascript:void(0)" onclick="showCandidateProfileModal('{{ $candidate->user->username }}')">
                                                        <img src="{{ asset($candidate->photo) }}" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="iconbox-content">
                                                <div class="post-info2">
                                                    <div class="post-main-title">
                                                        <a
                                                            href="javascript:void(0)" onclick="showCandidateProfileModal('{{ $candidate->user->username }}')">
                                                            {{ $candidate->user->name }}
                                                        </a>
                                                    </div>
                                                    <span class="loacton text-gray-400 ">
                                                        @if ($candidate->profession)
                                                            {{ ucfirst($candidate->profession->name) }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="iconbox-extra align-self-center">
                                                <div>
                                                    <form
                                                        action="{{ route('company.companybookmarkcandidate', $candidate->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="text-primary-500 hoverbg-primary-50 plain-button icon-button">
                                                            <x-svg.bookmark2-icon />
                                                        </button>
                                                    </form>
                                                </div>
                                                <div>
                                                    <a onclick="showCandidateProfileModal('{{ $candidate->user->username }}')"
                                                        class="btn btn-primary2-50" href="javascript:void(0)">
                                                        <span class="button-content-wrapper ">
                                                            <span class="button-icon align-icon-right">
                                                                <i class="ph-arrow-right"></i>
                                                            </span>
                                                            <span class="button-text">
                                                                {{ __('view_profile') }}
                                                            </span>
                                                        </span>
                                                    </a>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-icon hover:bg-gray-50"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12 13.125C12.6213 13.125 13.125 12.6213 13.125 12C13.125 11.3787 12.6213 10.875 12 10.875C11.3787 10.875 10.875 11.3787 10.875 12C10.875 12.6213 11.3787 13.125 12 13.125Z"
                                                                fill="#767F8C" stroke="#767F8C"></path>
                                                            <path
                                                                d="M12 6.65039C12.6213 6.65039 13.125 6.14671 13.125 5.52539C13.125 4.90407 12.6213 4.40039 12 4.40039C11.3787 4.40039 10.875 4.90407 10.875 5.52539C10.875 6.14671 11.3787 6.65039 12 6.65039Z"
                                                                fill="#767F8C" stroke="#767F8C"></path>
                                                            <path
                                                                d="M12 19.6094C12.6213 19.6094 13.125 19.1057 13.125 18.4844C13.125 17.8631 12.6213 17.3594 12 17.3594C11.3787 17.3594 10.875 17.8631 10.875 18.4844C10.875 19.1057 11.3787 19.6094 12 19.6094Z"
                                                                fill="#767F8C" stroke="#767F8C"></path>
                                                        </svg>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end company-dashboard-dropdown"
                                                        aria-labelledby="dropdownMenuButton1">
                                                        <li>
                                                            <a target="__blank" class="dropdown-item"
                                                                href="mailto:{{ $candidate->user->email }}">
                                                                <svg width="20" height="20" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76">
                                                                    </path>
                                                                </svg>
                                                                {{ __('send_email') }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card jobcardStyle1 saved-candidate">
                                <div class="card-body">
                                    <div class="text-center">
                                        <x-svg.not-found-icon />
                                        <p class="mt-4">{{ __('no_data_found') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if ($bookmarks->total() > $bookmarks->count())
                        <nav>
                            {{ $bookmarks->links('vendor.pagination.frontend') }}
                        </nav>
                    @endif
                </div>
            </div>
        </div>
        <!-- ============================= -->
        <!-- Modal -->
        <x-website.modal.candidate-profile-modal />
        <!-- ============================= -->
    </div>
@endsection

@section('frontend_links')
    <style>
        #categoryForm {
            width: 60% !important;
        }
    </style>
@endsection

@section('script')
    <script>
        function CategoryForm() {
            $('#categoryForm').on('change', function() {
                $(this).submit();
            })
        }


        function showCandidateProfileModal(username) {
            $.ajax({
                url: "{{ route('website.candidate.application.profile.details') }}",
                type: "GET",
                data: {
                    username: username
                },
                success: function(response) {
                    if (!response.success) {
                        if (response.redirect_url) {
                            return Swal.fire({
                                title: 'Oops...',
                                text: response.message,
                                icon: 'error',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: "{{ __('upgrade_plan') }}"
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = response.redirect_url;
                                }
                            })
                        } else {
                            return Swal.fire('Error', response.message, 'error');
                        }
                    }

                    let data = response.data;
                    let social = data.social_info

                    data.name ? $('.candidate-profile-info h2').html(data.name) : '';
                    data.candidate.photo ? $('#candidate_image').attr("src", data.candidate.photo) : '';
                    data.candidate.profession ? $('.candidate-profile-info h4').html(capitalizeFirstLetter(data
                        .candidate.profession.name)) : '';
                    data.candidate.bio ? $('.biography p').html(data.candidate.bio) : '';

                    // Social info
                    if (social.facebook || social.twitter || social.linkedin || social.youtube || social
                        .instagram) {
                        $('#candidate_social_profile_modal').show()
                        social.facebook ? $('.social-media ul li:nth-child(1)').attr("href", social.facebook) :
                            '';
                        social.twitter ? $('.social-media ul li:nth-child(2)').attr("href", social.twitter) :
                            '';
                        social.linkedin ? $('.social-media ul li:nth-child(3)').attr("href", social.linkedin) :
                            '';
                        social.instagram ? $('.social-media ul li:nth-child(4)').attr("href", social
                                .instagram) :
                            '';
                        social.youtube ? $('.social-media ul li:nth-child(5)').attr("href", social.youtube) :
                            '';

                    } else {
                        $('#candidate_social_profile_modal').hide()
                    }

                    // other info
                    data.candidate.birth_date ? $('#candidate_birth_date').html(data.candidate.birth_date) : '';
                    data.candidate.nationality.name ? $('#candidate_nationality').html(data.candidate.nationality.name) : ''
                    data.candidate.marital_status ? $('#candidate_marital_status').html(capitalizeFirstLetter(
                        data.candidate.marital_status)) : ''
                    data.candidate.gender ? $('#candidate_gender').html(capitalizeFirstLetter(data.candidate
                        .gender)) : ''
                    data.candidate.experience ? $('#candidate_experience').html(data.candidate.experience
                        .name) : ''
                    data.candidate.education ? $('#candidate_education').html(capitalizeFirstLetter(data
                        .candidate.education.name)) : ''

                    data.candidate.website ? $('#candidate_website').html(data.candidate.website) : ''
                    data.contact_info.country ? $('#candidate_location').html(data.contact_info.country
                        .name) : ''
                    data.contact_info.address ? $('#candidate_address').html(data.contact_info.address) : ''
                    data.contact_info.phone ? $('#candidate_phone').html(data.contact_info.phone) : ''
                    data.contact_info.secondary_phone ? $('#candidate_seconday_phone').html(data.contact_info
                        .secondary_phone) : ''
                    data.contact_info.email ? $('#contact_info_email').html(data.contact_info.email) : ''

                    $('#candidate-profile-modal').modal('show');
                    toastr.success(response.profile_view_limit, 'Success')
                },
                error: function(error) {
                    Swal.fire('Error', 'Something Went Wrong!', 'error');
                }
            });
        }

        function capitalizeFirstLetter(string) {
            return string[0].toUpperCase() + string.slice(1);
        }
    </script>
@endsection
