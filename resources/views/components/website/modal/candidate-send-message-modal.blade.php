<div class="modal fade" id="send_message_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('new_message') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('company.send.email') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="username" id="candidate_username">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">{{ __('subject') }}:</label>
                        <input name="subject" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">{{ __('message') }}:</label>
                        <textarea name="body" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('send_message') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('frontend_links')
    <style>
        #send_message_modal {
            z-index: 999999999 !important;
        }
    </style>
@endpush
