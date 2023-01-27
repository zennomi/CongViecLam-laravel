<div class="modal fade" id="newColumnModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('add_new_group') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <div class="form-group">
                <label for="name">{{ __('group_name') }}</label>
                <input type="text" name="name" id="name" placeholder="{{ __('name') }}" class="form-control col-name">
                <div class="text-danger" id="errname"></div>
            </div>
            <div class="d-flex justify-content-between mt-3 mb-5">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">{{ __('cancel') }}</button>
                <button class="btn btn-primary" onclick="createColumn()">{{ __('create') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
