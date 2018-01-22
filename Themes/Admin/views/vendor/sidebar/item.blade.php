<li class="@if($item->hasItems()) has-child @endif">
    <!--<a href="javascript:void(0);" class=""><i class="ico-dashboard">@include('partials.icon.ico-dashboard')</i>Dashboard</a>-->
    <a href="#" data-uri="@if(!$item->hasItems()){{ $item->getUrl() }}@endif" data-js="@if(!$item->hasItems()){{ $item->getFunctionJs() }}@endif" class="@if($item->hasItems()) isparent @else menu--link @endif">@if($item->getIcon())<i class="{{ $item->getIcon() }}">@if($item->hasItems())@include("partials.icon.".$item->getIcon())@endif</i>@endif{{ $item->getName() }}</a>

    @if(count($items) > 0)
    <ul class="submenu">
        @foreach($items as $item)
            {!! $item !!}
        @endforeach
    </ul>
    @endif
</li>


{{-- <li class="has-child active">
	<a href="javascript:void(0);" class="isparent"><i class="ico-dashboard">@include('partials.icon.ico-dashboard')</i>Dashboard</a>
	<ul class="submenu">
		<li class="">
			<a href="#" class="menu--link "><i class="fa fa-angle-double-right"></i>Menu Group Manager</a>
		</li>
		<li class="">
			<a href="#" class="menu--link "><i class="fa fa-angle-double-right"></i>Menu Manager</a>
		</li>
		<li class="">
			<a href="#" class="menu--link "><i class="fa fa-angle-double-right"></i>Role Manager</a>
		</li>
	</ul>
</li>
<li class="has-child">
	<a href="javascript:void(0);" class="isparent"><i class="ico-account">@include('partials.icon.ico-account')</i>Account</a>
	<ul class="submenu">
		<li class="">
			<a href="#" class="menu--link "><i class="fa fa-angle-double-right"></i>Menu Group Manager</a>
		</li>
		<li class="">
			<a href="#" class="menu--link "><i class="fa fa-angle-double-right"></i>Menu Manager</a>
		</li>
		<li class="">
			<a href="#" class="menu--link "><i class="fa fa-angle-double-right"></i>Role Manager</a>
		</li>
	</ul>
</li>
<li class="">
	<a href="javascript:void(0);" class="isparent menu--link"><i class="ico-reports">@include('partials.icon.ico-reports')</i>Reports</a>
</li>
<li class="">
	<a href="javascript:void(0);" class="isparent menu--link"><i class="ico-seo">@include('partials.icon.ico-seo')</i>SEO</a>
</li> --}}
