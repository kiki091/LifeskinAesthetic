@extends('layouts.facile_master')
@section('content')
    
    <div class="main--content" id="app">
        <div class="grid">
            <div class="span9">
                <h3 class="main--content__title">Content Cards</h3>
                <small class="main--content__desc">Here are several content card styles for your content management</small>
            </div>
            <div class="span3 right-align">
                <br>
                <a href="javascript:void(0);" class="btn--primary2">Additional Button</a>
            </div>
        </div>

        <div class="card form detail">
            <div class="form--top flex vcenter between">
                <h6 class="bold margin0">#AYN0123456</h6>
                <a href="javascript:void(0);" class="btn--primary2 close-toggle">Cancel</a>
            </div>
            <div class="form--middle">
                <div class="grid">
                    <div class="span2">
                        <small class="s10 detail--color-main">Created:</small>
                    </div>
                    <div class="span6">
                        <small class="s10">November 30, 2016 on 09.15</small>
                    </div>
                </div>
                <div class="grid">
                    <div class="span2">
                        <small class="s10 detail--color-main">Status:</small>
                    </div>
                    <div class="span6">
                        <small class="s10">Paid</small>
                    </div>
                </div>
                <div class="grid">
                    <div class="span2">
                        <small class="s10 detail--color-main">Transaction ID:</small>
                    </div>
                    <div class="span6">
                        <small class="s10">11245535</small>
                    </div>
                </div>
                <hr>
                <div class="grid">
                    <div class="span4">
                        <h6 class="detail--color-main">Contact Information</h6>
                        <div class="">
                            <small class="s11 margin-b5 d-block">Salutation: <b>Mr.</b></small>
                            <small class="s11 margin-b5 d-block">Fullname: <b>Dunnie Lamb</b></small>
                            <small class="s11 margin-b5 d-block">Email Address: <b>dunnie.lamb@gmail.com</b></small>
                            <small class="s11 margin-b5 d-block">Contact Number: <b>+5246583485</b></small>
                        </div>
                    </div>
                    <div class="span4">
                        <h6 class="detail--color-main">Order</h6>
                        <ul class="margin0 disc">
                            <li class="margin-b5">
                                <small class="s11 d-block">Transportation</small>
                                <small class="s11 d-block"><b>
                                    Innova (Two Way) <br>
                                    1 Unit
                                </b></small>
                            </li>
                            <li class="margin-b5">
                                <small class="s11 d-block">Wellness & Recreation</small>
                                <small class="s11 d-block"><b>
                                    Aquatonic <br>
                                    1 Pax
                                </b></small>
                            </li>
                            <li class="margin-b5">
                                <small class="s11 d-block">Transportation</small>
                                <small class="s11 d-block"><b>
                                    Kampoeng Cultural Dinner (Adult) 2 Pax <br>
                                    Kampoeng Cultural Dinner (Children) 1 Pax
                                </b></small>
                            </li>
                        </ul>
                    </div>
                    <div class="span4"></div>
                </div>
            </div>
        </div>
        
        <div class="card form" id="toggle-open-content">
            <form action="" method="POST">
                <div class="form--top flex vcenter between">
                    <h6 class="bold margin0">FORM CONTROL</h6>
                    <a href="javascript:void(0);" class="btn--primary2 close-toggle">Cancel</a>
                </div>
                <div class="form--middle">
                    <h5 class="form--title">Text Input</h5>
                    <div class="row">
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text" class="mini">
                            </div>
                        </div>
                        <div class="field">
                            <label class="">Text Input with Placeholder</label>
                            <div class="">
                                <input type="text" placeholder="Text placeholder">
                            </div>
                        </div>
                        <div class="field">
                            <label class="">Read Only Text Input</label>
                            <div class="">
                                <input type="text" placeholder="Input text here" disabled>
                            </div>
                        </div>
                        <div class="field width-auto">
                            <label class="">Text Input with Limitation</label>
                            <div class="flex">
                                <input type="text" placeholder="Input text here" class="width-default limit-char" data-length="100" maxlength="100">
                                <span class="tips">Maximum <span class="chars">100</span> character</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field">
                            <label class="">Email Input</label>
                            <div class="input--icon icon--left">
                                <input type="email" class="" placeholder="Email Address">
                                <i class="ico-email"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label class="">Password Input</label>
                            <div class="input--icon icon--left button-inside show-password">
                                <input type="password" class="" placeholder="Password" id="password">
                                <i class="ico-password"></i>
                                <a href="#" id="show-hide-pass">SHOW</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field has-error">
                            <label class="">Empty Text Input</label>
                            <div class="">
                                <input type="text" value="2-3 pax">
                            </div>
                        </div>
                        <div class="field has-error">
                            <label class="">Empty Text Input (Error)</label>
                            <div class="">
                                <input type="text" placeholder="Input text here">
                            </div>
                        </div>
                        <div class="field has-error">
                            <label class="">Incorrect Text Input (Error)</label>
                            <div class="">
                                <input type="text" placeholder="Input text here" value="@%^$">
                                <small class="s9">Invalid text format</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field width-auto">
                            <label class="">Text Editor</label>
                            <div class="">
                                <textarea name="" id="text-editor" class="ckeditor" cols="300" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="field width-auto">
                            <label class="">Text Editor with Limitation</label>
                            <div class="flex">
                                <textarea name="" id="text-editor2" class="ckeditor-withlimit" data-length="320"></textarea>
                                <span class="tips">Maximum <span class="chars">280</span> character</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="form--title">Dropdown and Picker</h5>
                    <div class="row">
                        <div class="field">
                            <label class="">Select</label>
                            <select name="" id="" class="chosen">
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                                <option value="">Option 3</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                                <option value="">Option 3</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                                <option value="">Option 3</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                                <option value="">Option 3</option>
                            </select>
                        </div>
                        <div class="field">
                            <label class="">Read-only Selection</label>
                            <select name="" id="" class="chosen" disabled>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                                <option value="">Option 3</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                                <option value="">Option 3</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                                <option value="">Option 3</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                                <option value="">Option 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <label class="">Date Picker</label>
                        <div class="input--icon icon--right input--date">
                            <input type="text" placeholder="DD-MM-YYYY" class="datepick">
                            <i class="icon-date"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field">
                            <label class="">Duration</label>
                            <div class="input--icon icon--left">
                                <select name="" id="" class="chosen">
                                    <option value="">01.00</option>
                                    <option value="">02.00</option>
                                    <option value="">03.00</option>
                                    <option value="">04.00</option>
                                    <option value="">05.00</option>
                                    <option value="">06.00</option>
                                    <option value="">07.00</option>
                                    <option value="">08.00</option>
                                    <option value="">09.00</option>
                                    <option value="">10.00</option>
                                    <option value="">11.00</option>
                                    <option value="">12.00</option>
                                </select>
                                <i class="ico-clock"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label class="">&nbsp;</label>
                            <div class="input--icon icon--left">
                                <select name="" id="" class="chosen">
                                    <option value="">01.00</option>
                                    <option value="">02.00</option>
                                    <option value="">03.00</option>
                                    <option value="">04.00</option>
                                    <option value="">05.00</option>
                                    <option value="">06.00</option>
                                    <option value="">07.00</option>
                                    <option value="">08.00</option>
                                    <option value="">09.00</option>
                                    <option value="">10.00</option>
                                    <option value="">11.00</option>
                                    <option value="">12.00</option>
                                </select>
                                <i class="ico-clock"></i>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5 class="form--title">Others</h5>
                    <div class="field width-auto">
                        <label class="">Checkboxes and Radios</label>
                        <div class="">
                            <p class="d-inline-block margin-r20">
                                <input type="checkbox" class="check" id="check-1">
                                <label for="check-1">Default</label>
                            </p>
                            <p class="d-inline-block margin-r20">
                                <input type="checkbox" class="check" id="check-2" checked>
                                <label for="check-2">Checked</label>
                            </p>
                            <p class="d-inline-block margin-r20">
                                <input type="checkbox" class="check" id="check-3" disabled>
                                <label for="check-3">Disabled</label>
                            </p>
                            <p class="d-inline-block margin-r20">
                                <input type="radio" name="radio" class="radio" id="radio-1">
                                <label for="radio-1">Default</label>
                            </p>
                            <p class="d-inline-block margin-r20">
                                <input type="radio" name="radio" class="radio" id="radio-2" checked>
                                <label for="radio-2">Checked</label>
                            </p>
                            <p class="d-inline-block">
                                <input type="radio" name="radio" class="radio" id="radio-3" disabled>
                                <label for="radio-3">Disabled</label>
                            </p>
                        </div>
                    </div>
                    <div class="field">
                        <label class="">Two Layers Checkboxes</label>
                        <div class="checkbox__two-layers">
                            <p class="d-block">
                                <input type="checkbox" class="check" id="check-layer-1">
                                <label class="bold" for="check-layer-1">Controller 1</label>
                            </p>
                            <p class="d-block">
                                <input type="checkbox" class="check" id="check-layer-2">
                                <label for="check-layer-2">Function 1</label>
                            </p>
                            <p class="d-block">
                                <input type="checkbox" class="check" id="check-layer-3">
                                <label for="check-layer-3">Function 2</label>
                            </p>
                        </div>
                    </div>
                    <div class="field width-auto">
                        <label class="">Switches</label>
                        <div class="flex vcenter">
                            <div class="flex vcenter margin-r20">
                                <label class="switch">
                                    <input class="switch-input" id="check_1" type="checkbox" checked>
                                    <span class="switch-label"></span><span class="switch-handle"></span>
                                </label>
                                <small class="margin-x10">Active (Content)</small>
                            </div>
                            <div class="flex vcenter margin-r20">
                                <label class="switch">
                                    <input class="switch-input" id="check_1" type="checkbox">
                                    <span class="switch-label"></span><span class="switch-handle"></span>
                                </label>
                                <small class="margin-x10">Inactive (Content)</small>
                            </div>
                            <div class="flex vcenter margin-r20">
                                <label class="switch-line">
                                    <input class="switch-input" id="check_1" type="checkbox" checked>
                                    <span class="switch-label"></span><span class="switch-handle"></span>
                                </label>
                                <small class="margin-x10">Active (Category)</small>
                            </div>
                            <div class="flex vcenter margin-r20">
                                <label class="switch-line">
                                    <input class="switch-input" id="check_1" type="checkbox">
                                    <span class="switch-label"></span><span class="switch-handle"></span>
                                </label>
                                <small class="margin-x10">Inactive (Category)</small>
                            </div>
                        </div>
                    </div>
                    <div class="field width-auto">
                        <label>Single Image Uploader</label>
                        <div class="flex">
                            <div class="upload--img">
                                <input class="" type="file" id="input-img-single">
                                <label for="input-img-single" class=""></label>
                                <img src="#" id="upload--img--preview">
                                {{-- <a href="javascript:void(0);" class="upload--img--remove"></a> --}}
                            </div>
                            <small class="s10 tips big"><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpeg. (With maximum width of 750px on landscape)</small>
                        </div>
                    </div>
                    <div class="field width-auto">
                        <label>Multiple Image Uploader</label>
                        <div class="upload--img--multiple">
                            <small class="s11">Drop <b>Main image</b> in this area. Sort images by "draging and droping" in the desired position</small>
                            <div class="flex flex-align-center">
                                <ul class="img-sortable" id="html-card-photo-uploader-en">

                                    <!-- CARD UPLOAD -->
                                    <li class="">
                                        <div class="handle">
                                            @include('svg-logo.handle-drag')
                                        </div>
                                        <div class="img--multiple__group">
                                            <div class="upload--img--card">
                                                <div class="upload--img">
                                                    <input class="" type="file" id="input-img-single">
                                                    <label for="input-img-single" class=""></label>
                                                    <img src="#" id="upload--img--preview">
                                                    <a href="javascript:void(0);" class="upload--img--remove"></a>
                                                    <a href="javascript:void(0);" class="preview--show" id="img-preview"></a>
                                                </div>
                                                <span class="img--multiple__title">Desktop</span>
                                            </div>
                                            <div class="upload--img--card">
                                                <div class="upload--img">
                                                    <input class="" type="file" id="input-img-single">
                                                    <label for="input-img-single" class=""></label>
                                                    <img src="#" id="upload--img--preview">
                                                    {{-- <a href="javascript:void(0);" class="upload--img--remove"></a> --}}
                                                    {{-- <a href="javascript:void(0);" class="preview--show" id="img-preview"></a> --}}
                                                </div>
                                                <span class="img--multiple__title">Mobile</span>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="img--card__remove"></a>

                                        <!-- POPUP UPLOAD PREVIEW LARGE -->
                                        <div class="upload--img--preview">
                                            <div class="preview--overlay" id="img-preview-popup">
                                                <div class="preview--popup">
                                                    <div class="preview--popup--inner">
                                                        <a href="javascript:void(0);" class="preview--close">&times;</a>
                                                        <img class="preview--image" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                                <!-- PLACEHOLDER FOR ADD NEW CARD PHOTO UPLOADER -->
                                <a href="javascript:void(0);" class="img--multiple__placeholder" id="add-card-photo-uploader-en"><i>&plus;</i><span>Add New</span></a>
                            </div>

                            <small class="s11"><b>Upload tip:</b> Please upload high resolution photo only with format of *jpeg.(With maximum width of 750px on landscape)</small>
                        </div>
                    </div>
                    <div class="field width-auto">
                        <label class="">File Input</label>
                        <div class="">
                            <div class="upload--file__wrapper flex vcenter">
                                <input type="file" class="upload--file" id="file-upload">
                                <label for="file-upload" class="upload--button">Upload file</label>
                                <small class="s11 upload--placeholder">No file Chosen</small>
                            </div>
                            <small class="s10 tips textonly"><b>Upload tip: </b>Acceptable files format are pdf, docx, pptx and xls</small>
                        </div>
                    </div>
                    <div class="field width-auto">
                        <label class="">Related Item Selector</label>
                        <div class="checkbox--item-select">
                            <div class="item-selected">
                                <div class="item-selected__header"><h6 class="margin0">Selected Item</h6></div>
                                <div class="item-selected__body">
                                    <div class="item-selected__placeholder">
                                        @include('svg-logo.ico-max3')
                                        <p>Select three related venues from the list</p>
                                    </div>
                                    <ul id="item-checked">
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="item-list">
                                <div class="item-list__header"><h6 class="margin0">Item List</h6></div>
                                <div class="item-list__body">
                                    <ul>
                                        <li id="1">
                                            <div class="checkbox__wrapper d-inline-block margin-r20">
                                                <input type="checkbox" id="checkbox-en-1" class="check">
                                                <label for="checkbox-en-1" class="">Ah Yat Abalone Seafood</label>
                                                <span class="handle"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form--bottom flex vcenter right">
                    <input type="submit" class="btn--primary" value="Save and Close">
                </div>
            </form>
        </div>

        <div class="card">
            <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-1"></a>
            <div class="card__header flex between vend">
                <h6 class="bold">Content With Category</h6>
                <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open">Add Content1</a>
            </div>
            <div class="card__body collapse in" id="collapse-1">

                <ul class="media__wrapper margin0 sortable">
                    <li class="media">
                        <div class="media__group flex">
                            <div class="media__drag">
                                <div class="handle">@include('svg-logo.handle-drag')</div>
                            </div>
                            <div class="media__thumb">
                                <img src="{{URL::asset('facile/images/thumb/img-thumb.png')}}">
                            </div>
                            <div class="media__text">
                                <a href="#" class="content__edit__hover"><h6 class="s14">Content Title</h6></a>
                                <div class="">
                                    <div class="media__text--item">
                                        <small class="s10">Link to Page: <b>Registration</b></small>
                                    </div>
                                    <div class="media__text--item">
                                        <a href="javascript:void(0);" class="pin-item"><i class="ico-pin">@include('svg-logo.ico-pin')</i>Pin to landing page</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="media__control">
                            <label class="switch margin-x5">
                                <input class="switch-input" id="check_1" type="checkbox">
                                <span class="switch-label"></span><span class="switch-handle"></span>
                            </label>
                            <a href="#" class="ico-delete margin-x5">@include('svg-logo.ico-delete')</a>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media__group flex">
                            <div class="media__drag">
                                <div class="handle">@include('svg-logo.handle-drag')</div>
                            </div>
                            <div class="media__thumb">
                                <img src="{{URL::asset('facile/images/thumb/img-thumb.png')}}">
                            </div>
                            <div class="media__text">
                                <a href="#" class="content__edit__hover"><h6 class="s14">Content Title</h6></a>
                                <small class="s10">Link to Page: <b>Registration</b></small>
                            </div>
                        </div>
                        <div class="media__control">
                            <label class="switch margin-x5">
                                <input class="switch-input" id="check_1" type="checkbox">
                                <span class="switch-label"></span><span class="switch-handle"></span>
                            </label>
                            <a href="#" class="ico-delete margin-x5">@include('svg-logo.ico-delete')</a>
                        </div>
                    </li>
                </ul>

            </div>
        </div>

        <div class="card">
            <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-2"></a>
            <div class="card__header flex between vend">
                <h6 class="bold">Content With Category</h6>
                <a href="javascript:void(0);" class="btn--primary">Add Content</a>
            </div>
            <div class="card__body collapse in" id="collapse-2">
                <div class="media--accordion">
                    <div class="media--accordion__header flex between">
                        <div class="flex vcenter">
                            <div class="handle accordion-inner-handle">
                                @include('svg-logo.handle-drag-mini')
                            </div>
                            <small class="medium">Category Title 1</small>
                        </div>
                        <div class="flex vcenter">
                            <label class="switch-line margin-x10">
                                <input class="switch-input check-category" id="check_1" type="checkbox" checked>
                                <span class="switch-label"></span><span class="switch-handle"></span>
                            </label>
                            <a href="javascript:void(0);" class="ico-circle-chevron flex">@include('svg-logo.ico-circle-chevron')
                            </a>
                        </div>
                    </div>
                    <div class="media--accordion__body">

                        <ul class="media__wrapper margin0 sortable">
                            <li class="media">
                                <div class="media__group flex">
                                    <div class="media__drag">
                                        <div class="handle">@include('svg-logo.handle-drag')</div>
                                    </div>
                                    <div class="media__thumb">
                                        {{ Theme::image('images/thumb/img-thumb.png') }}
                                    </div>
                                    <div class="media__text">
                                        <a href="#" class="content__edit__hover"><h6 class="s14">Content Title</h6></a>
                                        <small class="s10">Link to Page: <b>Registration</b></small>
                                    </div>
                                </div>
                                <div class="media__control">
                                    <label class="switch margin-x5">
                                        <input class="switch-input" id="check_1" type="checkbox" checked>
                                        <span class="switch-label"></span><span class="switch-handle"></span>
                                    </label>
                                    <a href="#" class="ico ico-preview margin-x5">@include('svg-logo.ico-preview')</a>
                                    <a href="#" class="ico ico-delete margin-x5">@include('svg-logo.ico-delete')</a>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media__group flex">
                                    <div class="media__drag">
                                        <div class="handle">@include('svg-logo.handle-drag')</div>
                                    </div>
                                    <div class="media__thumb">
                                        {{ Theme::image('images/thumb/img-thumb.png') }}
                                    </div>
                                    <div class="media__text">
                                        <a href="#" class="content__edit__hover"><h6 class="s14">Content Title</h6></a>
                                        <small class="s10">Link to Page: <b>Registration</b></small>
                                    </div>
                                </div>
                                <div class="media__control">
                                    <label class="switch margin-x5">
                                        <input class="switch-input" id="check_2" type="checkbox">
                                        <span class="switch-label"></span><span class="switch-handle"></span>
                                    </label>
                                    <a href="#" class="ico ico-delete margin-x5">@include('svg-logo.ico-delete')</a>
                                </div>
                            </li>
                        </ul>  

                    </div>
                </div>
            </div>
        </div>

        <div class="pagination">
            <ul>
                <li><a href="#" class="first"></a></li>
                <li><a href="#" class="prev"></a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#" class="next"></a></li>
                <li><a href="#" class="last"></a></li>
            </ul>
        </div>

    </div>


@endsection


@section('js_script')

@endsection