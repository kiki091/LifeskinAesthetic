<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="PT. Asia Resource System">
<title>@yield('pageheadtitle','Beautyhouse')</title>
<meta name="author" content="Beautyhouse" />
<meta name="publisher" content="www.lifeskin.com" />
<meta name="copyright" content="www.lifeskin.com" />
<meta name="host" content="www.lifeskin.com" />
<meta name="geo.position" content="{{ $web_information['latitude'] or '' }}.{{ $web_information['longitude'] or '' }}" />    
<meta name="geo.region" content="ID-JB" />
<meta name="geo.country" content="ID"/>
<meta name="geo.placename" content="Jakarta, Indonesia" />
<meta name="ICBM" content="{{ $web_information['latitude'] or '' }}.{{ $web_information['longitude'] or '' }}" />    
<meta name="DC.title" content="{{ $web_information['web_title'] or '' }}" />

<meta Http-Equiv="Cache-Control" Content="no-cache">
<meta Http-Equiv="Pragma" Content="no-cache">
<meta Http-Equiv="Expires" Content="0">
<!-- OG CONTENT -->
<meta property="og:url" content="http://thelifskynclinic.com/" />
<meta property="og:title" content="{{ $web_information['og_title'] or '' }}" />
<meta property="og:description" content="{{ $web_information['og_description'] or '' }}" />
<meta property="og:image" content="{{ $web_information['og_images'] or '' }}" />
<meta property="og:type"  content="article" />

@section('seo')
    <meta name="title" content="Beautyhouse" />
    <meta name="keywords" content="LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA" />
    <meta name="description" content=" " />
@show

<link href="{{ $web_information['favicon'] or '' }}" type="images/x-icon" rel="shortcut icon">
<link href="{{ elixir('css/core.css') }}" rel="stylesheet">
<link href="{{ elixir('css/plugins.css') }}" rel="stylesheet">