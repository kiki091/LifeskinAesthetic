<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 hidden-xs">
                <div class="header-left">
                    <div class="call-center">
                        <p><i class="zmdi zmdi-phone"></i>+{{ $web_information['phone_number'] or '' }}</p>
                    </div>
                    <div class="mail-address">
                        <p><i class="zmdi zmdi-email"></i>{{ $web_information['email'] or '' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                @if (Auth::guard('member')->check())

                    <div class="mini-cart">
                        <div class="cart-icon">
                            <a href="#">
                                <small>Welcome {{ DataHelper::userName() }} </small>
                            </a>
                        </div>
                        <!-- Mini Cart -->
                        <div class="mini-cart-box right">
                            <div class="mini-cart-product fix">
                                <a href="#" class="image"></a>
                                <div class="content fix">
                                    <a href="#" class="title">Change Password</a>
                                </div>
                            </div>
                            <div class="mini-cart-checkout text-center">
                                <a href="{{ route('LogoutMember') }}">Logout</a>
                            </div>
                        </div>
                        <!--mini cart end-->
                    </div>
                @else
                    <div class="social-icons">
                        <a target="__blank" href="{{ $web_information['facebook_link'] or '' }}"><i class="zmdi zmdi-facebook"></i></a>
                        <a target="__blank" href="{{ $web_information['twitter_link'] or '' }}"><i class="zmdi zmdi-twitter"></i></a>
                        <a target="__blank" href="{{ $web_information['instagram_link'] or '' }}"><i class="zmdi zmdi-instagram"></i></a>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>