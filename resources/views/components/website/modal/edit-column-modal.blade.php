<div class="modal fade" id="editColumnModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('edit_new_column') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" class="d-none" id="column_id" value="">
          <div>
            <div class="form-group">
                <label for="">{{ __('column_name') }}</label>
                <input type="text" name="name" value="" id="edit_name" placeholder="{{ __('name') }}" class="form-control col-name">
                <div class="text-danger" id="errnameupdate"></div>
            </div>
            <div class="d-flex justify-content-between mt-3 mb-5">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">{{ __('cancel') }}</button>
                <button class="btn btn-primary" onclick="UpdateColumn()">{{ __('edit_column') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
