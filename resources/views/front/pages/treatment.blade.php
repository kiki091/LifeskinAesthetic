@extends('front.layout.master')

@section('pageheadtitle')
    {{ $seo_data['meta_title'] or '' }} Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo')
    <meta name="keywords" content="{{ $seo_data['meta_keyword'] or '' }}" />
    <meta name="description" content="{{ $seo_data['meta_description'] or '' }}" />
@stop

@section('content')

<!--Gallery section start-->
<div class="galllery item2">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="section-title text-center">
                    <h2>our treatment</h2>
                    <p>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery-isotope-section">
        <div class="container">
        	@if(!empty($category_data))
            <div class="row">
                <div class="col-md-12">
                    <div class="gallery-tab-menu isotope-menu text-center">   
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach($category_data as $key_cat=> $value_cat)
								<li data-filter=".{{ $value_cat['slug'] }}">{{ $value_cat['title'] }}</li>
							@endforeach
						</ul>
                    </div>
                </div>
            </div>
            @endif

            @if(!empty($treatment_data) && isset($treatment_data))
            <div class="gallery-tab-content isotope-gallery">
                <div class="row">
                	@foreach($treatment_data as $key_treatment=> $value_treatment)
	                    <div class="shop-product-list col-md-6 col-sm-12 col-xs-12 {{ $value_treatment['category_slug'] }} gallery-item">
                            <div class="">
                                <div class="single-product-img">
                                    <a href="#">
                                        <img src="{{ $value_treatment['thumbnail_url'] }}" alt="{{ $value_treatment['title'] }}">
                                    </a>
                                </div>
                                <div class="single-product-info">
                                    <h3>
                                        <a href="{{ route('TreatmentPageDetail', $value_treatment['slug']) }}">{{ $value_treatment['title'] }}</a>
                                    </h3>
                                    <h5>PRICE : 
                                        IDR {{ $value_treatment['price'] }}
                                    </h5>
                                    <div class="singe-product-desc">
                                        {!! $value_treatment['description'] !!}
                                    </div>
                                    <ul class="product-action">
                                        <li>
                                            <a href="{{ route('TreatmentPageDetail', $value_treatment['slug']) }}" class="cd-signin add-to-cart">Read more</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!--Gallery section end-->
@endsection