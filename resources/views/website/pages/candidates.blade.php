@extends('website.layouts.app')

@section('description')
    @php
    $data = metaData('candidates');
    @endphp
    {{ $data->description }}
@endsection
@section('og:image')
    {{ asset($data->image) }}
@endsection
@section('title')
    {{ $data->title }}
@endsection

@section('main')
    <!-- Filter Component -->
    <x-website.candidate.candidate-filter :countries="$countries" :professions="$professions" :experiences="$experiences" :educations="$educations" />

    <!--  canidates   -->
    <div class="@if (request('education') || request('gender') || request('experience')) col-lg-8 @else col-xl-12 @endif" id="togglclass1">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane  show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                @if ($candidates->count() > 0)
                    <div class="row">
                        @foreach ($candidates as $candidate)
                            <div
                                class="@if (request('education') || request('gender') || request('experience')) col-md-6 fade-in-bottom  condition_class rt-mb-24 @else col-md-6 fade-in-bottom  condition_class rt-mb-24 col-xl-4 @endif">
                                <div class="card jobcardStyle1 body-24">
                                    <div class="card-body">
                                        <div class="rt-single-icon-box icb-clmn-lg">
                                            <div class="icon-thumb">
                                                <div class="profile-image">
                                                    <img src="{{ asset($candidate->photo) }}"
                                                        alt="{{ __('candidate_image') }}">
                                                </div>
                                            </div>
                                            @php
                                                $option = auth('user')->check() ? '' : '';
                                            @endphp
                                            <div class="iconbox-content">
                                                <div class="job-mini-title">
                                                    @if (auth('user')->check())
                                                        <a onclick="showCandidateProfileModal('{{ $candidate->user->username }}')"
                                                            href="javascript:void(0);">
                                                            {{ $candidate->user->name }}
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0);" class="login_required">
                                                            {{ $candidate->user->name }}
                                                        </a>
                                                    @endif
                                                </div>
                                                <span class="loacton text-gray-400 ">
                                                    {{ $candidate->profession ? $candidate->profession->name : '' }}
                                                </span>
                                                <div class="bottom-link rt-pt-30">
                                                    @if (auth('user')->check())
                                                        <a onclick="showCandidateProfileModal('{{ $candidate->user->username }}')"
                                                            href="javascript:void(0);"
                                                            class="body-font-4 text-primary-500">{{ __('view_resume') }}
                                                            <span>
                                                                <x-svg.arrow-right-icon />
                                                            </span>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0);"
                                                            class="body-font-4 text-primary-500 login_required">{{ __('view_resume') }}
                                                            <span>
                                                                <x-svg.arrow-right-icon />
                                                            </span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- @if (auth()->user() ? auth()->user()->role == 'company' : '')
                                                <div class="iconbox-extra">
                                                    @if ($candidate->bookmarked)
                                                        <form
                                                            action="{{ route('company.companybookmarkcandidate', $candidate->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="text-primary-500 hoverbg-primary-50 plain-button icon-button">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M19 21L12 16L5 21V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H17C17.5304 3 18.0391 3.21071 18.4142 3.58579C18.7893 3.96086 19 4.46957 19 5V21Z"
                                                                        fill="var(--primary-500)"
                                                                        stroke="{{ $setting->frontend_primary_color }}"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button type="button"
                                                            onclick="CompanyBookmark('{{ $candidate->id }}')"
                                                            class="hoverbg-primary-50 text-primary-500 plain-button icon-button">
                                                            <svg width="16" height="20" viewBox="0 0 16 20"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M15 19L8 14L1 19V3C1 2.46957 1.21071 1.96086 1.58579 1.58579C1.96086 1.21071 2.46957 1 3 1H13C13.5304 1 14.0391 1.21071 14.4142 1.58579C14.7893 1.96086 15 2.46957 15 3V19Z"
                                                                    stroke="{{ $setting->frontend_primary_color }}"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                        </button>
                                                    @endif
                                                </div>
                                            @endif --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="card text-center">
                            <x-not-found message="{{ __('no_data_found') }}" />
                        </div>
                    </div>
                @endif

                @if (request('perpage') != 'all' && $candidates->total() > $candidates->count())
                    <div class="rt-pt-30">
                        <nav>
                            {{ $candidates->links('vendor.pagination.frontend') }}
                        </nav>
                    </div>
                @endif
            </div>
            <!-- For List -->
            <x-website.candidate.candidate-view-list :candidates="$candidates" />
        </div>
    </div>
    </div>
    </div>
    </div>

    <div class="rt-spacer-100 rt-spacer-md-50"></div>

    {{-- Subscribe Newsletter --}}
    <x-website.subscribe-newsletter />

    <!-- ===================================== -->
    <div class="modal fade cadidate-modal" id="aemploye-profile" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-modal="true" role="dialog">
        <div class="modal-dialog modal-wrapper modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="text-center">
                        {{ __('save_to') }}
                    </h5>
                    <div class="row mb-5 border-top">
                        <div class="col-md-12" id="categoryList">
                        </div>
                        <div class="col-md-12">
                            <div class="card jobcardStyle1 saved-candidate border-0 mt-3">
                                <div class="card-body">
                                    <div class="rt-single-icon-box ">
                                        <div class="iconbox-content">
                                            <div class="post-info2">
                                            <div class="post-main-title">
                                                <a target="_blank" href="{{ route('company.bookmark.category.index') }}">
                                                    <span class="text-primary">{{ __('create_category') }}</span>
                                                </a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <x-website.modal.candidate-profile-modal />


@endsection

@section('frontend_links')
    <style>
        #aemploye-profile .modal-wrapper {
            width: 30% !important;
        }

        #aemploye-profile .modal-body {
            overflow-x: hidden !important;
            overflow-y: scroll !important;
        }
    </style>
@endsection

@section('script')
    <script>
        function Filter() {
            $('#form').submit();
        }

        $('#sortby').on('change', function() {
            $('#form').submit();
        })

        $('#perpage').on('change', function() {
            $('#form').submit();
        })

        function FilterClose(name) {

            $('[name="' + name + '"]').val('');
            $('#form').submit();
        }

        var style = localStorage.getItem("candidate_style") == null ? 'box' : localStorage.getItem("candidate_style");
        setStyle(style);

        function styleSwitch(style) {
            localStorage.setItem("candidate_style", style);
            setStyle(style);
        }

        function setStyle(style) {
            if (style == 'box') {
                $('#nav-home-tab').addClass('active');
                $('#nav-home').addClass('show active');
                $('#nav-profile-tab').removeClass('active');
                $('#nav-profile').removeClass('show active');
            } else {
                $('#nav-home-tab').removeClass('active');
                $('#nav-home').removeClass('show active');
                $('#nav-profile-tab').addClass('active');
                $('#nav-profile').addClass('show active');
            }
        }

        function showCandidateProfileModal(username) {
            $.ajax({
                url: "{{ route('website.candidate.profile.details') }}",
                type: "GET",
                data: {
                    username: username,
                    count_view: 1
                },
                success: function(response) {
                    console.log(response)

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

                    $('#candidate_id').val(data.candidate.id)
                    if (data.candidate.bookmarked) {
                        $('#removeBookmakCandidate').removeClass('d-none')
                        $('#bookmakCandidate').addClass('d-none')
                    } else {
                        $('#bookmakCandidate').removeClass('d-none')
                        $('#removeBookmakCandidate').addClass('d-none')
                    }

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
                    $('#candidate_location').html(data.candidate.full_address)
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

        function CompanyBookmark(candidate) {
            $.ajax({
                url: "{{ route('company.bookmark.category.index', ['ajax' => 1]) }}",
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {

                    $('#categoryList').html('');
                    if (data.length > 0) {
                        $.each(data, function(key, value) {
                            $('#categoryList').append(`
                                <div class="card jobcardStyle1 saved-candidate">
                                    <div class="card-body">
                                        <div class="rt-single-icon-box ">
                                            <div class="iconbox-content cursor-pointer ">
                                                <div class="post-info2 cursor-pointer ">
                                                    <label for="exampleRadios${value.id}" class="post-main-title cursor-pointer ">
                                                        <div class="form-check d-flex justify-content-between from-radio-custom">
                                                            ${value.name}
                                                            <input onclick="BookmarkCanidate(${candidate},${value.id})" class="cursor-pointer  form-check-input" type="radio" name="experience" value="6" id="exampleRadios${value.id}">
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    }
                }
            });

            $('#aemploye-profile').modal('show');
        };

        function BookmarkCanidate(id, cat) {
            var url = "{{ route('company.companybookmarkcandidate', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    cat: cat,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response)
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

                    // location.reload();
                },
                error: function(data) {
                    location.reload();
                }
            });
        }



        $('#bookmakCandidate').on('click', function(){
            CompanyBookmark($('#candidate_id').val())
            $('#candidate-profile-modal').modal('hide');
        });

        $('#removeBookmakCandidate').on('click', function(){
            var url = "{{ route('company.companybookmarkcandidate', ':id') }}";
            url = url.replace(':id', $('#candidate_id').val());

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#removeBookmakCandidate').addClass('d-none')
                    $('#bookmakCandidate').removeClass('d-none')
                    toastr.success('Candidate removed from bookmark list', 'Success')
                },
                error: function(data) {
                    alert('Something went wrong')
                }
            });
        });

        function capitalizeFirstLetter(string) {
            return string[0].toUpperCase() + string.slice(1);
        }
    </script>
@endsection
