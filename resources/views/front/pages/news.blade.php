@extends('front.layout.master')

@section('pageheadtitle')
    {{ $seo_data['meta_title'] or '' }} Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo')
    <meta name="keywords" content="{{ $seo_data['meta_keyword'] or '' }}" />
    <meta name="description" content="{{ $seo_data['meta_description'] or '' }}" />
@stop

@section('content')
<!--our gallery section start-->
<div class="our-blog blog-pages ptb-100 fix">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="section-title text-center">
                    <h2>{{ $information_data['blog_title'] }}</h2>
                    {!! $information_data['blog_introduction'] !!}
                    
                </div>
            </div>
        </div>
        <div class="row blog-list">
            @if(isset($news_data) && !empty($news_data))
                @foreach($news_data as $key=> $news)
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="single-blog">
                            <div class="single-blog-top fix">
                                <div class="blog-img">
                                    <a href="#">
                                        <img src="{{ $news['thumbnail_url'] }}" alt="{{ $news['title'] }}">
                                    </a>
                                </div>
                                <div class="blog-desc">
                                    <h6><a href="#">{{ $news['title'] }}</a></h6>
                                    {!! str_limit($news['introduction'], 300) !!}
                                    <a class="read-more" href="{{ route('NewsPageDetail', $news['slug'] ) }}">Read more <i class="zmdi zmdi-long-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="blog-bottom-action">
                                <div class="blog-publish">
                                    <p><i class="zmdi zmdi-time"></i> {{ $news['modified'] }} </p>
                                </div>
                                <div class="blog-action-box">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-favorite-outline"></i>{{ $news['like'] }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Like : {{ $news['views'] }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-share"></i>{{ $news['share'] }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    
</div>
<!--our gallery section end-->
@endsection