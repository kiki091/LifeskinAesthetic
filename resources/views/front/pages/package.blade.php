@extends('front.layout.master')

@section('pageheadtitle')
    {{ $seo['meta_title'] or '' }} Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo')
    <meta name="keywords" content="{{ $seo['meta_keyword'] or '' }}" />
    <meta name="description" content="{{ $seo['meta_description'] or '' }}" />
@stop

@section('content')
<!--shop page start-->
<div class="shop-page ptb-100">
    <div class="container">
        <div class="row">
            <!--shop sidebar start-->
            <div class="col-md-8 col-md-offset-2">
                <div class="section-title text-center">
                    <h2>all lifskyclinic package</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                <div class="shop sidebar">
                    @if(isset($category_data) && !empty($category_data))
                    <aside class="widget categories grey-bg mb-30">
                        <div class="widget-title">
                            <h3>categories</h3>
                        </div>
                        <div class="widget-categories"> 
                            <!--Accordion item 1--> 
                            @foreach($category_data as $key_cat=> $category)
                                <h6>{{ $category['title'] }}</h6>
                                @if(isset($category['sub_category']) && !empty($category['sub_category']))
                                <ul>
                                    @foreach($category['sub_category'] as $key_sub_cat=> $sub_category)
                                        <li>
                                            <a href="{{ route('ProductPageCategory', $sub_category['slug']) }}">
                                                {{ $sub_category['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                @endif
                            @endforeach
                            <!--Accordion item 1 end--> 
                        </div>
                    </aside>
                    @endif
                    <aside class="widget offer mb-30 hidden-sm hidden-xs">
                        <div class="widget-offer-discount">
                            <div class="widget-img">
                                <img src="{{ asset('themes/front/images/blog/wiget-discount.jpg') }}" alt="">
                                <div class="widget-discount-text">
                                    <h1>50%</h1>
                                    <h2>off</h2>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
            @if(isset($package_data) && !empty($package_data))
            <div class="col-md-9 col-sm-12 col-xs-12">
                
                <div class="tab-content">
                    <div id="list" role="tabpanel">
                        <div class="row">
                        @foreach($package_data as $key_package=> $package_data)
                            <div class="shop-product-list col-md-12">
                                <div class="single-product">
                                    <div class="single-product-img">
                                        <a href="#">
                                            <img src="{{ $package_data['thumbnail_url'] }}" alt="{{ $package_data['title'] }}">
                                        </a>
                                    </div>
                                    <div class="single-product-info">
                                        <h3>
                                            <a href="#">{{ $package_data['title'] }}</a>
                                        </h3>
                                        <h4>ONLY IDR {{ $package_data['price'] }}</h4>
                                        @if(isset($package_data['product']) && !empty($package_data['product']))
                                            <h5>INCLUDE : 
                                                @foreach($package_data['product'] as $key_product=> $product)
                                                    <span>{{ $product['title'] }}, </span>
                                                @endforeach
                                            </h5>
                                        @endif
                                        <div class="singe-product-desc">
                                            {!! $package_data['description'] !!}
                                        </div>
                                        <ul class="product-action">
                                            @if (Auth::guard('member')->check())
                                                <li>
                                                    <input id="dp-5-{{$key_package+1}}" data-idx="{{$key_package+1}}" id="book_date_{{$key_package+1}}" name="book_date" class="datepicker-here dp-5" />
                                                    {{ csrf_field() }}
                                                </li>
                                                <li>
                                                    <a href="javascript:void();" onclick="bookData('{{ $package_data['id'] }}')" class="add-to-cart" id="add-to-cart-{{ $package_data['id'] }}" data-idx="{{ $package_data['id'] }}">Book now</a>
                                                </li>
                                            @else
                                                <li class="nav-menu"><a href="#top" class="cd-signin add-to-cart">Book now</a></li>
                                                @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>    
                </div>
            </div>
            <!--shop sidebar end-->
            @endif
        </div>
    </div>
</div>
<!--shop page end-->
@endsection

@section('scripts')
<script type="text/javascript">

    var book_date = "";
    var token = $('input[name="_token"]').val();
    var url = "{{ route('PackageBooking') }}"

    $('.dp-5').datepicker({
        language: 'en',
        minDate: new Date(),
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
        onSelect: function (fd) {
            book_date = fd

        }
    })

    function bookData(param)
    {
        var button_index = param
        console.log(button_index)
        $('#add-to-cart-'+button_index).prop('disabled', true)
        $('#add-to-cart-'+button_index).text('Please wait ...')

        $.ajax({

            type: 'POST',
            url: url,
            data: {package_id: param, book_date: book_date, _token: token},
        })
        .done(function(response) {
            
            $('#add-to-cart-'+button_index).prop('disabled', false)
            $('#add-to-cart-'+button_index).text('Book now')

            if(response.status == false)
            {
                $.each(response.message, function(v, k){
                    toastr.error(k[0], {timeOut: 5000})
                })
                
            } else {
                $('#dp-5-'+button_index).val('')
                $('#dp-5-'+button_index).text('')
                book_date = ''
                toastr.success(response.message, {timeOut: 5000})
            }
            
        })
        .fail(function(response) {
            
            $('#add-to-cart-'+button_index).prop('disabled', false)
            $('#add-to-cart-'+button_index).text('Book now')

            $('#dp-5-'+button_index).val('')
            $('#dp-5-'+button_index).text('')
            book_date = ''
            toastr.error('server not responding...', {timeOut: 5000})
        })
    }
</script>
@endsection