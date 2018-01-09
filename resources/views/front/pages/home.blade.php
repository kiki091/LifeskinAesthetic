@extends('front.layout.master')

@section('pageheadtitle')
    {{ $seo_data['meta_title'] or '' }} Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo')
    <meta name="keywords" content="{{ $seo_data['meta_keyword'] or '' }}" />
    <meta name="description" content="{{ $seo_data['meta_description'] or '' }}" />
@stop

@section('content')

<!--slider section start-->
<div class="slider-container">
    <div class="home-slider-list">
        @if(isset($main_banner))
            @foreach($main_banner as $banner_key=> $value_banner)
                <div class="single-slider">
                    <div class="slider-img">
                        <img src="{{ $value_banner['filename_url'] }}" alt="{{ $value_banner['title'] or '' }}">
                    </div>
                    <div class="slider-text-tablecell">
                        <div class="middle-text">
                            <div class="title-1 wow rotateInDownRight" data-wow-duration="0.9s" data-wow-delay="0s">
                                <h1>{{ $value_banner['title'] or '' }}</h1>
                            </div>  
                            <div class="desc wow slideInRight" data-wow-duration="1.2s" data-wow-delay="0.2s">
                                {!! $value_banner['introduction'] or '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
<!--slider section end-->

<!--welcome section start-->
<div class="welcome-about">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section home__subscribe">
                    <h2 class="margin0 spacing0 light">Subscribe &amp; <b>Get 10% OFF</b> On Your First Purchase</h2>
                    <form class="form--homesubscribe" method="post" action="" id="homesubscribe">
                        <div class="input__wrapper email_mid">
                            <input type="text" name="email" class="small" id="email_mid" placeholder="Enter your email address">
                            <button class="btn--main__small float-left margin0" id="button_subcribe_mid" type="submit">GO</button>
                            <small class="info--error clear left" id="error_info_mid_subscribe"></small>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="about-img">
                    <img src="{{ $about_data['section_one_images_url'] or '' }}" alt="">
                    <div class="col__box">
                        <div class="col__box__wrapper">
                            <h1 class="col__title spacing0">
                                {{ $about_data['section_one_title'] or '' }}
                            </h1>
                            <a href="#" class="btn--box__small">MORE</a>
                        </div>                      
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <aside class="widget flicker grey-bg mb-15">
                    <div class="widget-title">
                        <h3>Gallery Images</h3>
                    </div>
                    <div class="widget-filcker fix">
                        <ul>
                            @if(isset($gallery))
                                @foreach($gallery as $key=> $gallery_data)

                                    <li>
                                        <a href="#">
                                            <img src="{{ $gallery_data['thumbnail_url'] or '' }}" alt="{{ $gallery_data['title'] or '' }}">
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </aside>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="img-banner-promotion">
                    <img src="{{ asset('bin/images/small/breadcrumbs.jpg') }}" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
</div>
<!--welcome section end-->

<!--Offer section start-->
<div class="special-offer">
   <div class="bg-img">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="section-title bg_grey text-center">
                        <h2>{{ $information_data['offers_title'] or '' }}</h2>
                        {!! $information_data['offers_introduction'] or '' !!}
                    </div>
                </div>
            </div>
        </div>

        <!--Our feature section-->
        <div class="our-feature">
            <div class="gallery-tab-section">
                <div class="container">
                    <div class="gallery-tab-content">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane" id="all" style="display: block;">
                                <div class="single-gallery-list owl_pagination">
                                    @if(isset($package))
                                        @foreach($package as $key_package=> $val_package)
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="pricing-table text-center">
                                                    <div class="pricing-title">
                                                        <h3>{{ $val_package['title'] }}</h3>
                                                    </div>
                                                    <div class="pricing-desc">
                                                        <h2><span class="currency">IDR</span>{{ $val_package['price'] }}</h2>
                                                        <ul>
                                                            @if(isset($val_package['product']))
                                                                @foreach($val_package['product'] as $key_product=> $val_product)
                                                                    <li>{{ $val_product['title'] }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                        <div class="book-now">
                                                            @if (Auth::guard('member')->check())
                                                                <a href="#">Book now</a>
                                                            @else
                                                                <a href="{{ route('LoginPages') }}">Book now</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-8 col-md-offset-2 margin-top20">
                                    <div class="section-title bg_grey text-center">

                                        <a href="{{ route('PackagePage') }}" class="btn--main">VIEW ALL PROMOTIONS</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Our feature section end-->
    
    </div>
</div>
<!--Offer section end-->
@endsection