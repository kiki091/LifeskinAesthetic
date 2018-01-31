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
                    <h2>our gallery</h2>
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

            @if(!empty($gallery_data) && isset($gallery_data))
            <div class="gallery-tab-content isotope-gallery">
                <div class="row">
                	@foreach($gallery_data as $key_gallery=> $value_gallery)
                    <div class="col-md-4 col-sm-6 col-xs-12 {{ $value_gallery['category_slug'] }} hair beauty gallery-item">
                        <div class="single-gallery">
                            <div class="gallery-img">
                                <img src="{{ $value_gallery['filename_url'] }}" alt="{{ $value_gallery['title'] }}">
                                <a href="{{ $value_gallery['thumbnail_url'] }}"><i class="zmdi zmdi-zoom-in"></i></a>
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