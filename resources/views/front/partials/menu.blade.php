<div class="header-bottom sticky-header">
    <div class="container">
        <div class="mgea-full-width">
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-5">
                    <div class="logo">
                        <a href="{{ route('HomePage') }}"><img src="{{ $web_information['logo'] or '' }}" alt="{{ $web_information['web_title'] or '' }}"></a>
                    </div>
                </div>
                <div class="col-md-10 hidden-sm hidden-xs">
                    <div class="menu">
                        <nav class="nav-menu">
                            <ul>
                                <li>
                                    <a href="{{ route('HomePage') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('PackagePage') }}">Package</a>
                                </li>
                                <li>
                                    <a href="{{ route('ProductPage') }}">Product List</a>
                                </li>
                                <li>
                                    <a href="{{ route('TreatmentPage') }}">Treatment</a>
                                </li>
                                <li>
                                    <a href="{{ route('NewsPage') }}">News</a>
                                </li>
                                <li>
                                    <a href="{{ route('GalleryPage') }}">Gallery</a>
                                </li>
                                @if (!Auth::guard('member')->check())
                                <li>
                                    <a class="cd-signin" href="javascript::void();">Login</a>
                                    
                                </li>
                                @endif
                                <li>
                                    <a href="{{ route('AboutPage') }}">About</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile menu start -->
    <div class="mobile-menu-area hidden-lg hidden-md">
        <div class="container container-menu">
            <div class="col-md-12">
                <nav id="dropdown" class="nav-menu">
                    <ul>
                        <li>
                            <a href="{{ route('HomePage') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('PackagePage') }}">Package</a>
                        </li>
                        <li>
                            <a href="{{ route('ProductPage') }}">Product List</a>
                        </li>
                        <li>
                            <a href="{{ route('TreatmentPage') }}">Treatment</a>
                        </li>
                        <li>
                            <a href="{{ route('NewsPage') }}">News</a>
                        </li>
                        <li>
                            <a href="{{ route('GalleryPage') }}">Gallery</a>
                        </li>

                        @if (!Auth::guard('member')->check())
                        <li>
                            <a class="cd-signin" href="javascript::void();">Login</a>
                            
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('AboutPage') }}">About</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Mobile menu end -->
</div>
