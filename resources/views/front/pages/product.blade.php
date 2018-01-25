@extends('front.layout.master')

@section('pageheadtitle')
    {{ $seo['meta_title'] or '' }} Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo')
    <meta name="keywords" content="{{ $seo['meta_keyword'] or '' }}" />
    <meta name="description" content="{{ $seo['meta_description'] or '' }}" />
@stop

@section('content')
<!--shop page start-->
<div class="shop-page ptb-100">
    <div class="container">
        <div class="row">
            <!--shop sidebar start-->
            <div class="col-md-8 col-md-offset-2">
                <div class="section-title text-center">
                    <h2>all lifskyclinic product</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                <div class="shop sidebar">
                    @if(isset($category_data) && !empty($category_data))
                    <aside class="widget categories grey-bg mb-30">
                        <div class="widget-title">
                            <h3>categories</h3>
                        </div>
                        <div class="widget-categories"> 
                            <!--Accordion item 1--> 
                            @foreach($category_data as $key_cat=> $category)
                                <h6>{{ $category['title'] }}</h6>
                                @if(isset($category['sub_category']) && !empty($category['sub_category']))
                                <ul>
                                    @foreach($category['sub_category'] as $key_sub_cat=> $sub_category)
                                        <li>
                                            <a href="{{ route('ProductPageCategory', $sub_category['slug']) }}">
                                                {{ $sub_category['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                @endif
                            @endforeach
                            <!--Accordion item 1 end--> 
                        </div>
                    </aside>
                    @endif
                    <aside class="widget offer mb-30 hidden-sm hidden-xs">
                        <div class="widget-offer-discount">
                            <div class="widget-img">
                                <img src="{{ asset('themes/front/images/blog/wiget-discount.jpg') }}" alt="">
                                <div class="widget-discount-text">
                                    <h1>50%</h1>
                                    <h2>off</h2>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
            @if(isset($product_data) && !empty($product_data))
            <div class="col-md-9 col-sm-12 col-xs-12">
                
                <div class="tab-content">
                    <div id="list" role="tabpanel">
                        <div class="row">
                        @foreach($product_data as $key_package=> $product_data)
                            <div class="shop-product-list col-md-12">
                                <div class="single-product">
                                    <div class="single-product-img">
                                        <a href="#">
                                            <img src="{{ $product_data['thumbnail_url'] }}" alt="{{ $product_data['title'] }}">
                                        </a>
                                    </div>
                                    <div class="single-product-info">
                                        <h3>
                                            <a href="{{ route('ProductPageDetail', $product_data['slug']) }}">{{ $product_data['title'] }}</a>
                                        </h3>
                                            <h5>CATEGORY : 
                                                {{ $product_data['sub_category'] }}
                                            </h5>
                                        <div class="singe-product-desc">
                                            {!! $product_data['introduction'] !!}
                                        </div>
                                        <ul class="product-action">
                                            <li>
                                                <a href="{{ route('ProductPageDetail', $product_data['slug']) }}" class="cd-signin add-to-cart">Read more</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>    
                </div>
            </div>
            <!--shop sidebar end-->
            @endif
        </div>
    </div>
</div>
<!--shop page end-->
@endsection
