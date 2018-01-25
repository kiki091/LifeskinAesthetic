@extends('front.layout.master')

@section('pageheadtitle')
    {{ $product_data['meta_title'] or '' }} Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo')
    <meta name="keywords" content="{{ $product_data['meta_keyword'] or '' }}" />
    <meta name="description" content="{{ $product_data['meta_description'] or '' }}" />
@stop

@section('content')

<!-- product details start -->
<div class="product-details-area  ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
               <div class="zoomWrapper clearfix">
                    <div id="img-1" class="zoomWrapper single-zoom">
                        <a href="#">
                            <img id="zoom1" src="{{ $product_data['filename_url'] }}" alt="{{ $product_data['title'] }}">
                        </a>
                    </div>
                    <div class="product-thumb">
                        <ul class="details-slider" id="gallery_01">
                        	@if(!empty($gallery_data))
                        	@foreach($gallery_data as $key_img=> $val)
                            <li>
                                <a class="elevatezoom-gallery" href="#" data-image="{{ $val['thumbnail_url'] }}" data-zoom-image="{{ $val['filename_url'] }}"><img src="{{ $val['thumbnail_url'] }}" alt="{{ $val['title'] }}"></a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="product-detail single-product-info">
                    <h3>{{ $product_data['title'] }}</h3>
                    <h4>IDR {{ $product_data['price'] }}</h4>
                    <h5>AVAILABILITY: <span>{{ $product_data['availability'] }}</span></h5>
                    <h5 class="overview">OVERVIEW:</h5>
                    {!! $product_data['introduction'] !!}
                    
                    <div class="share mt-30">
                       <p>share:</p>
                       <ul>
                           <li class="facebook"><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                           <li class="twitter"><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                       </ul>
                    </div>
                </div>
            </div>   
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="product-description-tab mt-60">
                        <div class="description-tab-menu">
                            <ul class="clearfix" role="tablist">
                                <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
                                <li role="presentation"><a href="#specification" aria-controls="specification" role="tab" data-toggle="tab">information</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="description">
                               {!! $product_data['description'] !!}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="specification">
                                {!! $product_data['information'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
</div>
<!-- product details end -->
@endsection