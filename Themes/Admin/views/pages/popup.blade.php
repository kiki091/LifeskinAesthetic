@extends('layouts.facile_master')
@section('content')

<div class="main--content" id="app">
    <h3 class="main--content__title">Pop-up</h3>
    <small class="main--content__desc">Here is the pop-up style, please click the button for demo.</small>
    <br><br>
    <a href="#" class="btn--primary" id="show-modal" onClick="facileApp.showConfirmBox('delete')">Pop-up Demo</a>

    {{-- <modal v-if="showModal" @close="showModal = false">
        <div class="modal-container">
          <div class="modal-header center-align">
            <h6 class="margin0 bold">Surprise! This is a Pop-up</h6>
            <a href="javascript:void(0);" class="close-popup" @click.prevent="closePopup"></a>
          </div>
          <div class="modal-body">
            <form action="">
                <div class="field widthfull">
                    <label class="">Email Input</label>
                    <div class="input--icon icon--left">
                        <input type="email" class="" placeholder="Email Address">
                        <i class="ico-email"></i>
                    </div>
                </div>
                <div class="field widthfull">
                    <label class="">Password Input</label>
                    <div class="input--icon icon--left button-inside show-password">
                        <input type="password" class="" placeholder="Password" id="password">
                        <i class="ico-password"></i>
                        <a href="#" id="show-hide-pass">SHOW</a>
                    </div>
                </div>
                <div class="flex vcenter between">
                    <a href="#" class="link d-block">Forgot password?</a>
                    <button class="btn--primary">Login</button>
                </div>
            </form>
          </div>
        </div>
    </modal> --}}


    {{-- <modal v-if="showModal" @close="showModal = false">
        <div class="modal-container">
          <div class="modal-header center-align">
            <h6 class="margin0 bold">Change Password</h6>
            <a href="javascript:void(0);" class="close-popup" @click.prevent="closePopup"></a>
          </div>
          <div class="modal-body">
            <form action="" class="change-pass-form">
                <div class="field widthfull">
                    <label class="">Old Password</label>
                    <div class="input--icon icon--left">
                        <input type="password" class="" placeholder="Old password">
                        <i class="ico-password"></i>
                    </div>
                </div>
                <div class="field widthfull has-error">
                    <label class="">New Password</label>
                    <div class="input--icon icon--left">
                        <input type="password" class="" placeholder="New password">
                        <i class="ico-password"></i>
                    </div>
                    <small class="s9">Password didn't match</small>
                </div>
                <div class="field widthfull has-error">
                    <label class="">Confirm Password</label>
                    <div class="input--icon icon--left">
                        <input type="password" class="" placeholder="Old password">
                        <i class="ico-password"></i>
                    </div>
                    <small class="s9">Password didn't match</small>
                </div>
                <div class="flex vcenter right">
                    <button class="btn--primary change-pass-save">Save</button>
                </div>
            </form>
          </div>
        </div>

        <div class="modal-container">
          <div class="modal-header center-align">
            <h6 class="margin0 bold">Password Updated</h6>
            <a href="javascript:void(0);" class="close-popup" @click.prevent="closePopup"></a>
          </div>
          <div class="modal-body">
            <div class="change-pass-success center-align">
                <br>
                <p>You just updated your password. Please login with your new password.</p>
                <br>
                <a href="#" class="btn--primary change-pass-close" @click.prevent="closePopup">Okay</a>
            </div>
          </div>
        </div>
    </modal> --}}


</div>

<script type="text/x-template" id="modal-template">
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <slot></slot>
      </div>
    </div>
  </transition>
</script>

@endsection

@section('js_script')
<script src="{{ elixir('js/facile_main.js', 'themes/admin')}}"></script>
@endsection