@extends('admin.layouts.app')
@section('title')
    {{ __('contact_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('contact_list') }}</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            @if ($contacts->count() > 0)
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>{{ __('name') }}</th>
                                        <th>{{ __('email') }}</th>
                                        <th>{{ __('subject') }}</th>
                                        <th>{{ __('date') }}</th>
                                        @if (userCan('contact.delete'))
                                            <th width="10%">{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($contacts as $contact)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ $contact->created_at }}</td>
                                        @if (userCan('contact.delete') || userCan('contact.view'))
                                            <td class="d-flex justify-content-center align-items-center">
                                                @if (userCan('contact.view'))
                                                    <button contact_id="{{ $contact->id }}" type="submit"
                                                        onclick="contactDetail({{ json_encode($contact) }})"
                                                        title="{{ __('view_message') }}"
                                                        class="btn btn-sm bg-info mr-1 msgBtn"><i
                                                            class="far fa-envelope-open"></i></button>
                                                @endif
                                                @if (userCan('contact.delete'))
                                                    <form action="{{ route('module.contact.destroy', $contact->id) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button title="{{ __('delete_contact') }}"
                                                            onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                            class="btn btn-sm bg-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Message Modal --}}
    <div class="modal fade" id="contactModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('contact_details') }}</h5>
                    <button type="button" class="close" onclick="HideModal()" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('full_name') }}</label>
                        <input class="form-control" id="contact-modal-name" readonly>
                    </div>
                    <div class="form-group">
                        <label>{{ __('email') }}</label>
                        <input type="text" class="form-control" id="contact-modal-email" readonly>
                    </div>
                    <div class="form-group">
                        <label>{{ __('subject') }}</label>
                        <input type="text" class="form-control" id="contact-modal-subject" readonly>
                    </div>
                    <div class="form-group">
                        <label>{{ __('message') }}</label>
                        <textarea class="form-control" rows="3" id="contact-modal-message" readonly></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function HideModal() {
            $("#contactModal").modal('hide');
        }

        function contactDetail(contact) {
            $('#contact-modal-name').val(contact.name);
            $('#contact-modal-email').val(contact.email);
            $('#contact-modal-subject').val(contact.subject);
            $('#contact-modal-message').val(contact.message);
            $('#contactModal').modal('show');
        }
    </script>
@endsection
