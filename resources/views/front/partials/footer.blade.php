
<!--footer start-->
<div class="footer">
    <div class="footer-top ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="single-footer contact">
                        <div class="footer-title">
                            <h3>Contact us</h3>
                        </div>
                        <div class="contact-action mb-15">
                            <span><i class="zmdi zmdi-pin"></i></span>
                            {!! $web_information['address'] or '' !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-5 col-xs-12">
                    <div class="single-footer open-hours">
                        <div class="footer-title">
                            <h3>Open hours</h3>
                        </div>
                        {!! $web_information['address_introduction'] or '' !!}
                        {!! $web_information['open_hours'] or '' !!}
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div id="footer-content-js">
                        <div class="desktop-footer-block footer-block-03">
                            <div id="desktop-footer-mailing-list">
                                <h4>
                                    JOIN OUR MAILING LIST
                                </h4>
                                <p>
                                    Be the first to know about Our exclusive perks, events and promotions !
                                </p>
                                <form action="{{ route('SubscribeMail') }}" id="desktop-footer-mailing-list-form" method="post">
                                    <div class="form-group">
                                        <input name="email" id="footer-subscribe" type="text" class="required only-email" placeholder="Enter your email address">
                                        <br/>
                                        <span class="error-message" id="error-message-footer-email"></span>
                                    </div>
                                    {{ csrf_field() }}
                                    <input type="submit" id="form-submit-footer-subscribe" value=">">
                                </form>
                            </div>
                            <div id="desktop-footer-social-links">
                                <h4>
                                    FOLLOW US
                                </h4>
                                <ul>
                                    <li>
                                        <a href="{{ $web_information['instagram_link'] or '' }}" target="_blank">
                                            <span class="icon icon-instagram"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $web_information['facebook_link'] or '' }}" target="_blank">
                                            <span class="icon icon-facebook"></span>
                                        </a>
                                    </li>
                                      
                                    <li>
                                        <a href="{{ $web_information['twitter_link'] or '' }}" target="_blank">
                                            <span class="icon icon-twitter"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.youtube.com" target="_blank">
                                            <span class="icon icon-youtube"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="copyright">
                        <p>
                            Copyright© Beautyhouse 2018.All right reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer end-->