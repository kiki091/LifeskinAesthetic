@extends('layouts.facile_master')
@section('content')

<div class="main--content" id="app">
    <h3 class="main--content__title">Toastr</h3>
    <small class="main--content__desc">Here is the Toastr style, please click the button for demo.</small>
    <br><br>
    <a href="javascript:void(0);" onClick="notify({type:'info'})" class="btn--primary toastr-info">Toastr Info</a>
    <a href="javascript:void(0);" onClick="notify({type:'success'})" class="btn--primary toastr-success">Toastr Success</a>
    <a href="javascript:void(0);" onClick="notify({type:'error'})" class="btn--primary toastr-error">Toastr Error</a>


@endsection

@section('js_script')
@endsection