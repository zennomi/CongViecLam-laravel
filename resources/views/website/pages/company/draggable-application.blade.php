@extends('website.layouts.app')

@section('title', __('applications'))

@section('main')
    <div class="dashboard-wrapper">
        <div class="container">
            <div class="row">
                <x-website.company.sidebar />
                <div class="col-lg-9">
                    <div class="dashboard-right">
                        <div class="custom-breadcrumb">
                            <p>
                                <span class="inactive">{{ __('home') }}</span>
                                <span>/</span>
                                <span class="inactive">{{ __('my_jobs') }}</span>
                                <span>/</span>
                                <span class="inactive">{{ $job->title }}</span>
                                <span>/</span>
                                <span class="active">{{ __('applications') }}</span>
                            </p>
                        </div>
                        <div class="application-wrapper">
                            <div class="application-wrapper-top">
                                <h2 class="title">{{ __('applications') }}</h2>
                                <div class="filter-sort">
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#newColumnModal">
                                        Create New
                                    </button>
                                </div>
                            </div>
                            <div id="app">
                                <application-kanban-board :application-groups="{{ $application_groups }}">
                                </application-kanban-board>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-footer text-center body-font-4 text-gray-500">
            <x-website.footer-copyright />
        </div>
    </div>


    <!-- Modal -->
    <!-- ===================================== -->

    <div class="modal fade cadidate-modal" id="aemploye-profile" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-modal="true" role="dialog">
        <div class="modal-dialog  modal-wrapper">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="text-center">
                        {{ __('save_to') }}
                    </h5>
                    <div class="row mb-5 border-top">
                        <div class="col-md-12" id="categoryList">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('close') }}"></button>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <x-website.modal.candidate-profile-modal />
    <x-website.modal.candidate-send-message-modal />
    <x-website.modal.new-column-modal />

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
    <script type="text/javascript">
        function createColumn() {
            var name = $('#name').val();
            $.ajax({
                url: "{{ route('company.applications.column.store') }}",
                type: "POST",
                data: {
                    name: name,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        $('#newColumnModal').modal('hide')
                        window.location.reload()
                    }
                },
                error: function(response) {
                    for (const [key, value] of Object.entries(response.responseJSON.errors)) {
                        $('#err' + key).text(value);
                        $(`input[name="${key}"]`).addClass('is-invalid');
                    }
                }
            });
        }
        $(document).ready(function() {
            function showCandidateProfileModal(username) {
                $.ajax({
                    url: "{{ route('website.candidate.application.profile.details') }}",
                    type: "GET",
                    data: {
                        username: username
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

                        data.name ? $('.candidate-profile-info h2').html(data.name) : '';
                        data.candidate.photo ? $('#candidate_image').attr("src", data.candidate.photo) :
                            '';
                        data.candidate.profession ? $('.candidate-profile-info h4').html(
                            capitalizeFirstLetter(data
                                .candidate.profession.name)) : '';
                        data.candidate.bio ? $('.biography p').html(data.candidate.bio) : '';

                        // Social info
                        if (social.facebook || social.twitter || social.linkedin || social.youtube ||
                            social
                            .instagram) {
                            $('#candidate_social_profile_modal').show()
                            social.facebook ? $('.social-media ul li:nth-child(1)').attr("href", social
                                    .facebook) :
                                '';
                            social.twitter ? $('.social-media ul li:nth-child(2)').attr("href", social
                                    .twitter) :
                                '';
                            social.linkedin ? $('.social-media ul li:nth-child(3)').attr("href", social
                                    .linkedin) :
                                '';
                            social.instagram ? $('.social-media ul li:nth-child(4)').attr("href", social
                                    .instagram) :
                                '';
                            social.youtube ? $('.social-media ul li:nth-child(5)').attr("href", social
                                    .youtube) :
                                '';

                        } else {
                            $('#candidate_social_profile_modal').hide()
                        }

                        // other info
                        data.candidate.birth_date ? $('#candidate_birth_date').html(data.candidate
                            .birth_date) : '';
                        data.candidate.nationality.name ? $('#candidate_nationality').html(data.candidate.nationality.name) : ''
                        data.candidate.marital_status ? $('#candidate_marital_status').html(capitalizeFirstLetter(data.candidate.marital_status)) : ''
                        data.candidate.gender ? $('#candidate_gender').html(capitalizeFirstLetter(data
                            .candidate
                            .gender)) : ''
                        data.candidate.experience ? $('#candidate_experience').html(data.candidate
                            .experience
                            .name) : ''
                        data.candidate.education ? $('#candidate_education').html(capitalizeFirstLetter(
                            data
                            .candidate.education.name)) : ''

                        data.candidate.website ? $('#candidate_website').html(data.candidate.website) :
                            ''
                        data.contact_info.country ? $('#candidate_location').html(data.contact_info
                            .country
                            .name) : ''
                        data.contact_info.address ? $('#candidate_address').html(data.contact_info
                            .address) : ''
                        data.contact_info.phone ? $('#candidate_phone').html(data.contact_info.phone) :
                            ''
                        data.contact_info.secondary_phone ? $('#candidate_seconday_phone').html(data
                            .contact_info
                            .secondary_phone) : ''
                        data.contact_info.email ? $('#contact_info_email').html(data.contact_info.email) : ''
                        if (data.candidate.cv_url) {
                            data.candidate.cv_url ? $('#candidate_cv').attr('href', data.candidate
                                .cv_url) : ''
                        } else {
                            $('#download_cv').hide();
                        }

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

            function sendEmailCandidate(username) {
                $('#candidate_username').val(username)
                $('#send_message_modal').modal('show');
            }
        });
    </script>

    <script src="{{ asset('js/app.js') }}"></script>

@endsection
