<form action="{{ route('module.seo.update', $seo->page_slug) }}" class="form-horizontal" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label for="inputName" class="col-sm-2 col-form-label">{{ __('title') }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="title" value="{{ $seo->title }}" id="inputName"
                placeholder="{{ __('enter') }} {{ __('title') }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputExperience" class="col-sm-2 col-form-label">{{ __('description') }}</label>
        <div class="col-sm-10">
            <textarea class="form-control" cols="4" rows="4" name="description" id="description"
                placeholder="{{ __('enter') }} {{ __('description') }}">{{ $seo->description }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputName2" class="col-sm-2 col-form-label">{{ __('image') }}</label>
        <div class="col-sm-10">
            <input type="file" data-default-file="{{ asset($seo->image) }}" class="form-control dropify" name="image"
                id="image">
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-success">
                {{ __('update') }}
            </button>
        </div>
    </div>
</form>
