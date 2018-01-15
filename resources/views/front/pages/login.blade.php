@extends('front.layout.master')

@section('pageheadtitle')
    Login Member Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo')
    <meta name="keywords" content="Login Member" />
    <meta name="description" content="Login Member" />
@stop

@section('content')
<!--Login form start-->
<div class="contact-form ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="section-title text-center">
                    <h2>Login Your Account</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="contact-form-img text-center">
                    <img src="{{ asset('themes\front\images\common\contact.jpg') }}" alt="">
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="contact-form">
                    
                    @if (count($errors) > 0)
                      	@foreach ($errors->all() as $error)
                          	<p style="text-align: center;  color: red" class="form-messege">{{ $error }}</p>
                      	@endforeach
                	@else
                    	<p style="text-align: center;">Please enter your username and password to login</p>
                	@endif
                    <form id="contact-form" action="{{ route('LoginAuthenticate') }}" method="post">
                        <input name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email') }}" required="required">
                        <input name="password" type="password" class="form-control" placeholder="Password" required="required">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection