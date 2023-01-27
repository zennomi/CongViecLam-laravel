@extends('website.layouts.app')

@section('description')
    @php
        $data = metaData('faq');
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
<div class="breadcrumbs breadcrumbs-height">
    <div class="container">
      <div class="row align-items-center breadcrumbs-height">
        <div class="col-12 justify-content-center text-center">
          <div class="breadcrumb-title rt-mb-10">   {{ __('faq') }}</div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item"><a href="{{ route('website.home') }}">  {{ __('home') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">   {{ __('faq') }}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!--Faq Starts-->
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-8 mx-auto">
        @foreach ($faq_categories as $cat)
            <div class="rt-faq rt-pt-30 rt-pt-md-30">
                <h6 class="ft-wt-5 text-gray-900 text-capitalize rt-mb-24">{{$cat->name}}</h6>
                @foreach ($cat->faqs as $faq)
                    <div class="accordion rt-mb-24 ">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button accordion-pad body-font-2 text-gray-900 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                    {{$faq->question}}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}">
                                <div class="accordion-body accordion-pad">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- Faq End-->

{{-- Subscribe Newsletter  --}}
<x-website.subscribe-newsletter/>
@endsection
