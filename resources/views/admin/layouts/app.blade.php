@if ($setting->default_layout)
    @include('admin.layouts.left-nav')
@else
    @include('admin.layouts.top-nav')
@endif
