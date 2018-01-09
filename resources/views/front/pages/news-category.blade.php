@extends('front.layout.master')

@section('pageheadtitle')
    {{ $seo_data['meta_title'] or '' }} Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo_data')
    <meta name="keywords" content="{{ $seo_data['meta_keyword'] or '' }}" />
    <meta name="description" content="{{ $seo_data['meta_description'] or '' }}" />
@stop

@section('content')
<!--shop page start-->
<div class="shop-page ptb-100">
    <div class="container">
        <div class="row">
            <!--shop sidebar start-->
            <div class="col-md-3 col-sm-12 col-xs-12">
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
                                            <a href="{{ route('NewsPageCategory', $sub_category['slug']) }}">
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
            @if(isset($news_data) && !empty($news_data))
            <div class="col-md-9 col-sm-12 col-xs-12">
                
                <div class="tab-content">
                    <div id="list" role="tabpanel">
                        <div class="row">
                        @foreach($news_data as $key_package=> $news_data)
                            <div class="shop-product-list col-md-12">
                                <div class="single-product">
                                    <div class="single-product-img">
                                        <a href="#">
                                            <img src="{{ $news_data['thumbnail_url'] }}" alt="{{ $news_data['title'] }}">
                                        </a>
                                    </div>
                                    <div class="single-product-info">
                                        <h3>
                                            <a href="{{ route('NewsPageDetail', $news_data['slug']) }}">{{ $news_data['title'] }}</a>
                                        </h3>
                                        @if(isset($news_data['product']) && !empty($news_data['product']))
                                        @endif
                                        <div class="singe-product-desc">
                                            {!! str_limit($news_data['introduction'], 300) !!}
                                        </div>
                                        <ul class="product-action">
                                            <li><a href="{{ route('NewsPageDetail', $news_data['slug']) }}" class="add-to-cart">View More</a></li>
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