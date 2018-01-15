@extends('front.layout.master')

@section('pageheadtitle')
    {{ $news_data['meta_title'] or '' }} Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo')
    <meta name="keywords" content="{{ $news_data['meta_keyword'] or '' }}" />
    <meta name="description" content="{{ $news_data['meta_description'] or '' }}" />
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
                            <img src="{{ $news_data['filename_url'] }} " alt="{{ $news_data['title'] }} ">
                            
                            <div class="blog-bottom-action">
                                <div class="blog-publish">
                                    <p>
                                        <i class="zmdi zmdi-time"></i>{{ $news_data['modified'] }} 
                                    </p>
                                </div>
                                <div class="blog-action-box">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-favorite-outline"></i>
                                                {{ $news_data['like'] }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-share"></i>
                                                {{ $news_data['share'] }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div> 
                        </div>
                        <div class="article-desc">
                            <div class="article-title">
                                <h3>{{ $news_data['title'] }}</h3>
                            </div>
                            <div class="article-text">
                                {!! $news_data['introduction'] !!}
                                
                                {!! $news_data['description'] !!}
                                <blockquote>
                                    {!! $news_data['quotes'] !!}
                                </blockquote>
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
                                        <a href="{{ route('NewsPageCategory',$sub_category['slug']) }}">
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
                @if(isset($news_recent) && !empty($news_recent))
                <aside class="widget mb-30 grey-bg">
                    <div class="widget-title">
                        <h3>recent post</h3>
                    </div>
                    <div class="recent-post">
                        @foreach($news_recent as $key_recent=> $news_recent)
                            <div class="single-recent-post mb-15">
                                <div class="recent-post-thumbnail">
                                    @if(file_exists(public_path($news_recent['thumbnail_url'])))
                                        <img src="$news_recent['thumbnail_url'] }}" alt="{{ $news_recent['title'] }}">
                                    @endif
                                </div>
                                <div class="post-detail">
                                    <div class="post-title">
                                        <h5>
                                            <a href="{{ route('NewsPageDetail', $news_recent['slug'] ) }}">
                                                {{ $news_recent['title'] }}
                                            </a>
                                        </h5>
                                    </div>
                                    <div class="post-publish">
                                        <p class="post-date">
                                            On {{ $news_recent['modified'] }}
                                        </p>
                                    </div>
                                </div>
                            </div> 
                        @endforeach
                    </div>    
                </aside>
                @endif

                @if(isset($news_data['video_url']) && !empty($news_data['video_url']))
                <aside class="widget video mb-30">
                    <div class="widget-video">
                        <img src="{{ asset('themes/front/images/blog/widget-video.jpg') }}" alt="">
                        <div class="widget-video-icon">
                            <a href="{{ $news_data['video_url'] or '' }}">
                                <i class="zmdi zmdi-play"></i>
                            </a>
                        </div>
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