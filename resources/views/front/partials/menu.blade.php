<div class="header-bottom sticky-header">
    <div class="container">
        <div class="mgea-full-width">
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-5">
                    <div class="logo">
                        <a href="{{ route('HomePage') }}"><img src="{{ $web_information['logo'] or '' }}" alt="{{ $web_information['web_title'] or '' }}"></a>
                    </div>
                </div>
                <div class="col-md-8 hidden-sm hidden-xs">
                    <div class="menu">
                        <nav>
                            <ul>
                                <li>
                                    <a href="{{ route('HomePage') }}">Home</a>
                                </li>
                                <li>
                                    <a href="#">Our Product</a>
                                </li>
                                <li>
                                    <a href="#">News</a>
                                </li>
                                <li>
                                    <a href="#">About</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
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
                <nav id="dropdown">
                    <ul>
                        <li>
                            <a href="{{ route('HomePage') }}">Home</a>
                        </li>
                        <li>
                            <a href="#">Our Product</a>
                        </li>
                        <li>
                            <a href="#">News</a>
                        </li>
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Mobile menu end -->
</div>