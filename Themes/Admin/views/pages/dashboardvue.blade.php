@extends('layouts.facile_master')
@section('content')
    
    <div class="main--content" id="mainApp">
        <h3 class="main--content__title">Content Cards</h3>
        <small class="main--content__desc">Here are several content card styles for your content management</small>
        
        <div class="card form" id="toggle-open-content">
            <form action="" method="POST">
                <div class="form--top flex vcenter between">
                    <h6 class="bold margin0">FORM CONTROL</h6>
                    <a href="javascript:void(0);" class="btn--primary2 close-toggle">Cancel</a>
                </div>
                <div class="form--middle">
                    <h5 class="form--title">Text Input</h5>
                    <div class="row">
                        <ftext id="abcssd" name="kiminonawa" label="Title Text" classname="ininama" v-model="objs.xxx" app={{@app }} placeholder="Text placeholder" type="text" error="aduh ini error" ></ftext>
                        Options : <br>
                        id, name, label, classname, placeholder, limit (using limit automatic change text type to text) <br>
                        type : email, text (default), password) <br>
                        error : define error <br>
                        v-model :  send vue data <br>
                    </div>
                    <div class="row">
                        <ftexteditor v-model="fillItem.description" limit="20" label="texteditor"></ftexteditor>
                        Options : <br>
                        v-model :  send vue data <br>
                    </div>

                    <div class="row">
                        <ftextarea v-model="fillItemTxtArea.description" limit="2000" name="txt" label="textarea"></ftextarea>
                        Options : <br>
                        v-model :  send vue data <br>
                    </div>
                    <hr>
                    <h5 class="form--title">Dropdown and Picker</h5>
                    <div class="row">
                        <!-- <fselect :options="options" v-model="selected">
                          <option disabled value="0">Select one</option>
                        </fselect>
 -->
                        <fchosen :options="options" v-model="selected" label="ini option">
                        </fchosen>
                        Options : <br>
                        label : define label value <br>
                        :options : define options value <br>
                        v-model :  define selected value  <br>

                        <fdate label="datepicker" v-model="selecteddate" label="tanggal" placeholder="dd-mm-yyyy" timepicker="1"></fdate>

                        Options : <br>
                        label : define label value <br>
                        placeholder : default placeholder <br>
                        v-model :  define selected date value  <br>
                    </div>
                    <!-- <div class="field">
                        <fdate label="datepicker" v-model="selecteddate" placeholder="dd-mm-yyyy"></fdate>
                    </div> -->
                    <div class="row">
                        <fchosen :options="timeoptions" v-model="selectedtime" type="time" label="ini waktu">
                        </fchosen>

                        Options : <br>
                        label : define label value <br>
                        :options : define options value <br>
                        v-model :  define selected value  <br>
                        type : "time"
                    </div>

                    <hr>
                    <h5 class="form--title">Others</h5>
                    <div class="field width-auto">
                        <fcheckbox v-model="selectedcheckbox" :choices="checkboxchoices" id="ck" label="checkbox ini"></fcheckbox>
                        Options : <br>
                        label : define label value <br>
                        :choices : define choices value <br>
                        v-model :  define selected value  <br>


                        <fradio v-model="selectedradio" :choices="radiochoices" id="rd" label="radio ini"></fradio>
                        Options : <br>
                        label : define label value <br>
                        :choices : define choices value <br>
                        v-model :  define selected value  <br>


                        
                    </div>

                    <div class="row">
                        <fvcheckbox v-model="vselectedcheckbox" :choices="vcheckboxchoices" id="ck" label="2 layered checkbox"></fvcheckbox>

                        Options : <br>
                        label : define label value <br>
                        :choices : define choices value <br>
                        v-model :  define selected value  <br>
                        <pre>
                                        {
                                            id : 'h1',
                                            text : 'header',
                                            data : [
                                                { id: '7', text: 'v07:00', disabled: 0 },
                                                { id: '8', text: 'v08:00', disabled: 0 },
                                                { id: '9', text: 'v09:00', disabled: 1 }
                                            ]
                                        }
                        </pre>
                    </div>

                    <div class="row">
                        <fswitch v-model="switchobject.value" :object="switchobject" label="This is Switch" id="xSwitch" name="name" ></fswitch>

                        <fswitch v-model="switchobject.value" :object="switchobject" label="This is Switch" id="xSwitch" name="name" type="line"></fswitch>

                        Options : <br>
                        label : define label value <br>
                        :object : define switchobject value <br>
                        v-model :  define selected value  <br>
                        type :  define type of switch (line)  <br>
                    </div>
                    <div class="row">
                        <fimage id="img" name="img" v-model="image.image" :options="image.options" label="Single Image" ref="imagefield"></fimage>
                        Options : <br>
                        v-model : image.image
                        options : 
                            width :
                            height :
                        <pre>
                        image : {
                            id: '1',
                            name: 'Image 1',
                            options : {
                                height: '100px',
                                width: '100px'
                            },
                            image: '',
                            image_url: '',
                        },
                        </pre><br>
                        use <i>removeImageFromServer()</i> in parent to handle delete image from server
                    </div>

                    <div class="row">
                        <fmultipleimage id="fimg" name="fimg" label="multiple image" v-model="multipleimage"></Fmultipleimage>
                    </div>
                    
                    <div class="row">
                        <fupload accept="xls,doc" name="xxxFile" id="xxxFile" label="Title File"></fupload>
                    </div>

                    <div class="row">
                        <fselector v-model="itemselected" id="idini" :items="items" label="Item Selector"></fselector>
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
                <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open">Add Content</a>
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
                                <input class="switch-input" id="check_1" type="checkbox">
                                <span class="switch-label"></span><span class="switch-handle"></span>
                            </label>
                            <a href="javascript:void(0);" class="ico-circle-chevron flex">@include('svg-logo.ico-circle-chevron')
                            </a>
                        </div>
                    </div>
                    <div class="media--accordion__body">
                      <ul class="media__wrapper margin0">
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
                                    <input class="switch-input" id="check_1" type="checkbox">
                                    <span class="switch-label"></span><span class="switch-handle"></span>
                                </label>
                                <a href="#" class="ico-delete margin-x5">@include('svg-logo.ico-delete')</a>
                            </div>
                        </li>
                    </ul>  
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection



@section('js_script')
<script type="text/javascript" src="{{ Theme::url('js/app-vue.js') }}"></script>
@endsection