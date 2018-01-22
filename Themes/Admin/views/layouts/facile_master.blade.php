<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" lang="en">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@if(config('facile.core.core.title')){{ config('facile.core.core.title') }}@else Facile @endif</title>
    <meta name="author" content="PT. Qeon Interactive">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @component('slot.favicon')
    @endcomponent
    <!-- css -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ elixir('css/facile_plugins.css', 'themes/admin') }}">
    <link rel="stylesheet" href="{{ elixir('css/facile_styles.css', 'themes/admin') }}">
    @component('slot.header_css')
    <!-- fill another css here -->
    @endcomponent
</head>

<body class="" id="body">       
    @include('partials.sidebar')

    <div class="main--wrapper">
        @include('partials.facile_header')

        <!-- content -->
        <div class="main__wrapper__content">
        @yield('content')
        </div>

    </div> 

</body>
@include('partials.vars')
<!-- js -->
<script type="text/javascript" src="{{ asset('vendor/vue/vue.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/vue/vue-resource.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

<!--<script type="text/javascript" src="http://sdk.ckeditor.com/vendor/ckeditor/ckeditor.js"></script>-->
<script src="{{ elixir('js/facile_plugins.js', 'themes/admin') }}"></script>
{{-- <script src="{{ elixir('js/facile_main.js', 'themes/admin') }}"></script> --}}
<script type="text/javascript" src="{{ asset('js/laroute.js') }}"></script>
<script src="{{ elixir('js/facile_core.js', 'themes/admin')}}"></script>
<script type="text/javascript" src="{{ asset('themes/admin/js/app-header.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/admin/js/menu.js') }}"></script>
@include('partials.facile_footer')

<script>
    var assetBaseUrl = "{{ Theme::url() }}";
</script>

<!-- main -->
@yield('js_script')




</html>