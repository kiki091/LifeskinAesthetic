@extends('front.layout.master')

@section('pageheadtitle')
    {{ $treatment_data['meta_title'] or '' }} Beautyhouse | LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA
@stop

@section('seo')
    <meta name="keywords" content="{{ $treatment_data['meta_keyword'] or '' }}" />
    <meta name="description" content="{{ $treatment_data['meta_description'] or '' }}" />
@stop

@section('content')
<!--Our blog detalis-->
<div class="our-blog-details ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="blog-left-sidebar">
                    <article class="articles-details" style="margin-bottom: 10px">
                        <div class="article-thumbnail">
                            <img src="{{ $treatment_data['filename_url'] }} " alt="{{ $treatment_data['title'] }} ">
                        </div> 
                        <div class="article-desc">
                            <div class="article-title">
                                <h3>{{ $treatment_data['title'] }}</h3>
                                <hr/>
                                <h6>ONLY : IDR {{$treatment_data['price']}}</h6>
                            </div>
                            <div class="article-text">
                                {!! $treatment_data['description'] !!}
                                
                                <ul class="product-action">
                                    @if (Auth::guard('member')->check())
                                        <li style="float: right;">
                                            <a href="javascript:void();" onclick="bookData('{{ $treatment_data['id'] }}')" class="add-to-cart" id="add-to-cart-{{ $treatment_data['id'] }}" data-idx="{{ $treatment_data['id'] }}">Book now</a>
                                        </li>
                                        <li style="float: right;">
                                            <input id="dp-5-{{$treatment_data['id']}}" data-idx="{{$treatment_data['id']}}" id="book_date_{{$treatment_data['id']}}" name="book_date" class="datepicker-here dp-5 form-control" />
                                            {{ csrf_field() }}
                                        </li>
                                    @else
                                        <li style="float: right;" class="nav-menu"><a href="#top" class="cd-signin add-to-cart">Book now</a></li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                        @if(isset($gallery_data) && !empty($gallery_data))
                            <div class="article-desc">
                                <div class="article-title">
                                    <h3>Other Images</h3>
                                </div>
                            </div>
                            <div class="ur-gallery gallery-pages ptb-10 fix">
                                <div class="gallery-list fix">
                                    @foreach($gallery_data as $key_gallery=> $gallery)
                                    <div class="single-gallery">
                                        <div class="gallery-img">
                                            <img src="{{ $gallery['thumbnail_url'] }}" alt="{{ $gallery['title'] }}">
                                            <a href="{{ $gallery['filename_url'] }}"><i class="zmdi zmdi-zoom-in"></i></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                        @endif
                        <!-- Comment with fb plugins -->

                        <!-- End comment with fb plugins -->
                    </article>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12">
                
                @if(isset($treatment_recent) && !empty($treatment_recent))
                <aside class="widget mb-30 grey-bg hidden-sm hidden-xs">
                    <div class="widget-title">
                        <h3>recent treatment</h3>
                    </div>
                    <div class="recent-post">
                        @foreach($treatment_recent as $key_recent=> $treatment_recent)
                            <div class="single-recent-post mb-15">
                                <div class="recent-post-thumbnail">
                                    @if(file_exists(public_path($treatment_recent['thumbnail_url'])))
                                        <img src="$treatment_recent['thumbnail_url'] }}" alt="{{ $treatment_recent['title'] }}">
                                    @endif
                                </div>
                                <div class="post-detail">
                                    <div class="post-title">
                                        <h5>
                                            <a href="{{ route('TreatmentPageDetail', $treatment_recent['slug'] ) }}">
                                                {{ $treatment_recent['title'] }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                            </div> 
                        @endforeach
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
        </div>
    </div>
</div>
<!--Our blog detalis end-->
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
            data: {package_id: param, book_date: book_date, type:'treatment', _token: token},
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