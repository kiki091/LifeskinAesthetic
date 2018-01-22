@extends('layouts.facile_html_master')
@section('content')
    
    <div class="main--content" id="app">
        <h3 class="main--content__title">Content Cards</h3>
        <small class="main--content__desc">Here are several content card styles for your content management</small>
        
        <div class="card form" id="toggle-open-content">
            <form action="" method="POST">
                <div class="form--top flex vcenter between">
                    <h6 class="bold margin0">Layout 1</h6>
                    <a href="javascript:void(0);" class="btn--primary2 close-toggle">Cancel</a>
                </div>
                <div class="form--middle">
                    <div class="field">
                        <label class="">Text Input</label>
                        <div class="">
                            <input type="text">
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
                <div class="form--bottom flex vcenter right">
                    <input type="submit" class="btn--primary" value="Save and Close">
                </div>
            </form>
        </div>

        <div class="card form" id="toggle-open-content-2">
            <form action="" method="POST">
                <div class="form--top flex vcenter between">
                    <h6 class="bold margin0">Layout 2</h6>
                    <a href="javascript:void(0);" class="btn--primary2 close-toggle">Cancel</a>
                </div>
                <div class="form--middle">
                    <h5 class="form--title">Section A</h5>
                    <div class="field">
                        <label class="">Text Input</label>
                        <div class="">
                            <input type="text">
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
                    <hr>
                    <h5 class="form--title">Section B</h5>
                    <div class="field">
                        <label class="">Text Input</label>
                        <div class="">
                            <input type="text">
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
                <div class="form--bottom flex vcenter right">
                    <input type="submit" class="btn--primary" value="Save and Close">
                </div>
            </form>
        </div>

        <div class="card form" id="toggle-open-content-3-content" style="display: none;">
            <form action="" method="POST">
                <div class="form--top flex vcenter between">
                    <h6 class="bold margin0">Layout 3</h6>
                    <a href="javascript:void(0);" class="btn--primary2 close-toggle">Cancel</a>
                </div>
                <!-- FORM WIZARD -->
                <div class="wizard--tab" id="menu">
                    <ul class="wizard--tab--ul" >
                        <li class="wizard--tab--li firstTab">
                            <a href="#lang-en" class="wizard--tab--link">English</a>
                        </li>
                        <li class="wizard--tab--li lastTab">
                            <a href="#lang-ko" class="wizard--tab--link">Korea</a>
                        </li>
                    </ul>
                </div>
                <div class="form--middle">
                    <div class="create__form content__tab active__content" id="lang-en">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-id">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-zh">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-ja">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-ko">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                </div>
                <div class="form--bottom flex vcenter between">
                    <div class="">
                        <a href="#" class="btn--primary2 prev-button margin-r10" id="prev1"><</a>
                        <a href="#" class="btn--primary next-button" id="next1">Next</a>
                    </div>
                    <input type="submit" class="btn--primary" value="Save and Close">
                </div>
            </form>
        </div>

        <div class="card">
            <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-2"></a>
            <div class="card__header flex between vend">
                <h6 class="bold">Building</h6>
            </div>
            <div class="card__body collapse in" id="collapse-2">
                <div class="media--accordion">
                    <div class="media--accordion__body">
                        <ul class="media__wrapper margin0 sortable">
                            <li class="media sort-item">
                                <div class="media__group flex">
                                    <div class="media__thumb">
                                        <img src="#" alt="">
                                    </div>
                                    <div class="media__text">
                                        <a href="#" class="content__edit__hover"><h6 class="s14">Text</h6></a>
                                    </div>
                                </div>
                                <div class="media__control">
                                    <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open-content-3">Floor Plans Category</a>
                                </div>
                            </li>
                        </ul>  
                    </div>
                </div>
            </div>
        </div>

        <div class="card form" id="toggle-open-content-4-content" style="display: none;">
            <form action="" method="POST">
                <div class="form--top flex vcenter between">
                    <h6 class="bold margin0">Layout 3</h6>
                    <a href="javascript:void(0);" class="btn--primary2 close-toggle">Cancel</a>
                </div>
                <!-- FORM WIZARD -->
                <div class="wizard--tab" id="menu2">
                    <ul class="wizard--tab--ul" >
                        <li class="wizard--tab--li firstTab">
                            <a href="#lang-en-2" class="wizard--tab--link">English</a>
                        </li>
                        <li class="wizard--tab--li">
                            <a href="#lang-id-2" class="wizard--tab--link">Indonesia</a>
                        </li>
                        <li class="wizard--tab--li">
                            <a href="#lang-zh-2" class="wizard--tab--link">China</a>
                        </li>
                        <li class="wizard--tab--li">
                            <a href="#lang-ja-2" class="wizard--tab--link">Japan</a>
                        </li>
                        <li class="wizard--tab--li lastTab">
                            <a href="#lang-ko-2" class="wizard--tab--link">Korea</a>
                        </li>
                    </ul>
                </div>
                <div class="form--middle">
                    <div class="create__form content__tab active__content" id="lang-en-2">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-id-2">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-zh-2">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-ja-2">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-ko-2">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                </div>
                <div class="form--bottom flex vcenter between">
                    <div class="">
                        <a href="#" class="btn--primary2 prev-button margin-r10" id="prev2"><</a>
                        <a href="#" class="btn--primary next-button" id="next2">Next</a>
                    </div>
                    <input type="submit" class="btn--primary" value="Save and Close">
                </div>
            </form>
        </div>

        <div class="card">
            <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-2"></a>
            <div class="card__header flex between vend">
                <h6 class="bold">Building</h6>
            </div>
            <div class="card__body collapse in" id="collapse-2">
                <div class="media--accordion">
                    <div class="media--accordion__body">
                        <ul class="media__wrapper margin0 sortable">
                            <li class="media sort-item">
                                <div class="media__group flex">
                                    <div class="media__thumb">
                                        <img src="#" alt="">
                                    </div>
                                    <div class="media__text">
                                        <a href="#" class="content__edit__hover"><h6 class="s14">Text</h6></a>
                                    </div>
                                </div>
                                <div class="media__control">
                                    <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open-content-4">Floor Plans Category</a>
                                </div>
                            </li>
                        </ul>  
                    </div>
                </div>
            </div>

        </div>


        <div class="card form" id="toggle-open-content-5-content" style="display: none;">
            <form action="" method="POST">
                <div class="form--top flex vcenter between">
                    <h6 class="bold margin0">Layout 3</h6>
                    <a href="javascript:void(0);" class="btn--primary2 close-toggle">Cancel</a>
                </div>
                <!-- FORM WIZARD -->
                <div class="wizard--tab" id="menu2">
                    <ul class="wizard--tab--ul" >
                        <li class="wizard--tab--li firstTab">
                            <a href="#lang-en-3" class="wizard--tab--link">English</a>
                        </li>
                        <li class="wizard--tab--li">
                            <a href="#lang-id-3" class="wizard--tab--link">Indonesia</a>
                        </li>
                        <li class="wizard--tab--li">
                            <a href="#lang-zh-3" class="wizard--tab--link">China</a>
                        </li>
                        <li class="wizard--tab--li">
                            <a href="#lang-ja-3" class="wizard--tab--link">Japan</a>
                        </li>
                        <li class="wizard--tab--li lastTab">
                            <a href="#lang-ko-3" class="wizard--tab--link">Korea</a>
                        </li>
                    </ul>
                </div>
                <div class="form--middle">
                    <div class="create__form content__tab active__content" id="lang-en-3">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-id-3">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-zh-3">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-ja-3">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                    <div class="create__form content__tab" id="lang-ko-3">
                        <h5 class="form--title">Section A</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                        <hr>
                        <h5 class="form--title">Section B</h5>
                        <div class="field">
                            <label class="">Text Input</label>
                            <div class="">
                                <input type="text">
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
                </div>
                <div class="form--bottom flex vcenter between">
                    <div class="">
                        <a href="#" class="btn--primary2 prev-button margin-r10" id="prev3"><</a>
                        <a href="#" class="btn--primary next-button" id="next3">Next</a>
                    </div>
                    <input type="submit" class="btn--primary" value="Save and Close">
                </div>
            </form>
        </div>

        <div class="card">
            <a href="javascript:void(0);" class="minimize" data-toggle="collapse" data-target="#collapse-3"></a>
            <div class="card__header flex between vend">
                <h6 class="bold">Building</h6>
            </div>
            <div class="card__body collapse in" id="collapse-3">
                <div class="media--accordion">
                    <div class="media--accordion__body">
                        <ul class="media__wrapper margin0 sortable">
                            <li class="media sort-item">
                                <div class="media__group flex">
                                    <div class="media__thumb">
                                        <img src="#" alt="">
                                    </div>
                                    <div class="media__text">
                                        <a href="#" class="content__edit__hover"><h6 class="s14">Text</h6></a>
                                    </div>
                                </div>
                                <div class="media__control">
                                    <a href="javascript:void(0);" class="btn--primary open-toggle" id="toggle-open-content-5">Floor Plans Category</a>
                                </div>
                            </li>
                        </ul>  
                    </div>
                </div>
            </div>

        </div>


@endsection

@section('js_script')

@endsection