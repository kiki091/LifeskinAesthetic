@extends('front.layout.master')

@section('pageheadtitle')
    {{ $treatment_data['meta_title'] or '' }} Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo')
    <meta name="keywords" content="{{ $treatment_data['meta_keyword'] or '' }}" />
    <meta name="description" content="{{ $treatment_data['meta_description'] or '' }}" />
@stop

@section('content')
<!--Our blog detalis-->
<div class="our-blog-details ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="blog-left-sidebar">
                    <article class="articles-details">
                        <div class="article-thumbnail">
                            <img src="{{ $treatment_data['filename_url'] }} " alt="{{ $treatment_data['title'] }} ">
                        </div>
                        <div class="article-desc">
                            <div class="article-title">
                                <h3>{{ $treatment_data['title'] }}</h3>
                            </div>
                            <div class="article-text">
                                {!! $treatment_data['description'] !!}
                            </div>
                        </div>
                        @if(isset($gallery_data) && !empty($gallery_data))
                            <div class="article-desc">
                                <div class="article-title">
                                    <h3>Other Images</h3>
                                </div>
                            </div>
                            <div class="ur-gallery gallery-pages ptb-10 fix">
                                <div class="gallery-list fix">
                                    @foreach($gallery_data as $key_gallery=> $gallery)
                                    <div class="single-gallery">
                                        <div class="gallery-img">
                                            <img src="{{ $gallery['thumbnail_url'] }}" alt="{{ $gallery['title'] }}">
                                            <a href="{{ $gallery['filename_url'] }}"><i class="zmdi zmdi-zoom-in"></i></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                        @endif
                        <!-- Comment with fb plugins -->

                        <!-- End comment with fb plugins -->
                    </article>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12">
                
                @if(isset($treatment_recent) && !empty($treatment_recent))
                <aside class="widget mb-30 grey-bg">
                    <div class="widget-title">
                        <h3>recent treatment</h3>
                    </div>
                    <div class="recent-post">
                        @foreach($treatment_recent as $key_recent=> $treatment_recent)
                            <div class="single-recent-post mb-15">
                                <div class="recent-post-thumbnail">
                                    @if(file_exists(public_path($treatment_recent['thumbnail_url'])))
                                        <img src="$treatment_recent['thumbnail_url'] }}" alt="{{ $treatment_recent['title'] }}">
                                    @endif
                                </div>
                                <div class="post-detail">
                                    <div class="post-title">
                                        <h5>
                                            <a href="{{ route('TreatmentPageDetail', $treatment_recent['slug'] ) }}">
                                                {{ $treatment_recent['title'] }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                            </div> 
                        @endforeach
                    </div>    
                </aside>
                @endif

                <aside class="widget offer mb-30 hidden-sm">
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
        </div>
    </div>
</div>
<!--Our blog detalis end-->
@endsection