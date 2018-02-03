@extends('front.layout.master')

@section('pageheadtitle')
    {{ $seo_data['meta_title'] or '' }} Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo')
    <meta name="keywords" content="{{ $seo_data['meta_keyword'] or '' }}" />
    <meta name="description" content="{{ $seo_data['meta_description'] or '' }}" />
@stop

@section('content')

<!--About us start-->
<div class="about-us ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="about-desc">
                    <h2>{{ $about_data['section_one_title'] or '' }}</h2>
                    {!! $about_data['section_one_description'] or '' !!}
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="about-us-img">
                    <img src="{{ $about_data['section_one_images_url'] or '' }}" alt="{{ $about_data['section_one_title'] or '' }}">
                </div>
            </div>
        </div>
    </div>
</div>
<div id="contact-map" class="map-area grey-bg">
    <div id="googleMap" style="width:100%;height:500px;"></div>
</div> 
<!--About us end-->

<!--Contact form start-->
<div class="contact-form ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="section-title text-center">
                    <h2>{{ $about_data['contact_us_title'] or '' }}</h2>
                    {!! $about_data['contact_us_introduction'] or '' !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="contact-form">
                    <p class="form-messege">
                    <form id="contact-form" action="{{ route('ContactUs') }}" class="about-contact-form" method="post">
                        <input id="fullname" name="fullname" type="text" placeholder="Enter your name here">
                        <br/>
                        <span class="error-message" id="error-message-fullname"></span>
                        <input id="email" name="email" type="text" placeholder="Enter your email here">
                        <br/>
                        <span class="error-message" id="error-message-email"></span>
                        <textarea id="messages" name="messages" placeholder="Enter your messages here"></textarea>
                        <br/>
                        <span class="error-message" id="error-message-messages"></span>

                        <button type="submit">Send</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="contact-form-img text-center">
                    <img src="{{ $about_data['contact_us_images_url'] or '' }}" alt="{{ $about_data['contact_us_title'] or '' }}">
                </div>
            </div>
        </div>
    </div>
</div>
<!--Contact form end-->
@endsection

@section('scripts')
<script type="text/javascript">
    window.latitude = "{{ $web_information['latitude'] }}"
    window.longitude = "{{ $web_information['longitude'] }}"
</script>



@endsection