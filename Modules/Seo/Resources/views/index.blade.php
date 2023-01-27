@extends('admin.settings.setting-layout')
@section('title') {{ __('seo') }} @endsection
@section('website-settings')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            @foreach ($seos as $seo)
                                <li class="nav-item" onclick="Tab('{{ $seo->page_slug }}')">
                                    <a id="tabli{{ $seo->page_slug }}" class="{{ $loop->index == 0 ? 'active' : '' }} nav-link" href="#{{ $seo->page_slug }}" data-toggle="tab">
                                        {{ __($seo->page_slug) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            @foreach ($seos as $seo)
                                <div class="{{ $loop->index == 0 ? 'active' : '' }} tab-pane" id="{{ $seo->page_slug }}">
                                    @include('seo::pages.form', ['seo' => $seo])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('style')
    {{-- Image upload and Preview --}}
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css">
@endsection

@section('script')
    {{-- Image upload and Preview --}}
    <script src="{{ asset('backend') }}/plugins/dropify/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Add a Picture',
                'replace': 'New picture',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        var oldTab = localStorage.getItem('Tab');
        if(oldTab){
            $('#tablihome').removeClass('active');
            $('#home').removeClass('active');

            $('#tabli'+oldTab).addClass('active');
            $('#'+oldTab).addClass('active');
        }
        function Tab(id){
            localStorage.setItem('Tab', id);
        }

    </script>
@endsection
