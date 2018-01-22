<template>
<div>
	<transition name="modal">
	    <div class="modal-mask" v-if="showModal">
	  		<div class="modal-wrapper">
	    		<div @close="showModal==false">
			        <div class="modal-container">
			          <div class="modal-header center-align">
			            <h6 class="margin0 bold">Change Password</h6>
			            <a href="javascript:void(0);" class="close-popup" @click.prevent="closePopup"></a>
			          </div>
			          <div class="modal-body">
			            <form action="" class="change-pass-form" id="changePasswordForm" v-on:submit.prevent="changepass">
			                <div class="field widthfull old_password">
			                    <label class="">Old Password</label>
			                    <div class="input--icon icon--left">
			                        <input type="password" v-model="models.old_pass" class="" placeholder="Old password">
			                        <i class="ico-password"></i>
			                    </div>
			                    <small class="s9" v-if="error.old_password">{{ error.old_password }}</small>
			                </div>
			                <div class="field widthfull new_password">
			                    <label class="">New Password</label>
			                    <div class="input--icon icon--left">
			                        <input type="password" v-model="models.pass" class="" placeholder="New password">
			                        <i class="ico-password"></i>
			                    </div>
			                    <small class="s9" v-if="error.new_password">{{ error.new_password }}</small>
			                </div>
			                <div class="field widthfull confirm_password">
			                    <label class="">Confirm Password</label>
			                    <div class="input--icon icon--left">
			                        <input type="password" v-model="models.confirm_pass" class="" placeholder="Old password">
			                        <i class="ico-password"></i>
			                    </div>
			                    <small class="s9" v-if="error.confirm_password">{{ error.confirm_password }}</small>
			                </div>
			                <div class="flex vcenter right">
			                    <button class="btn--primary change-pass-save">Save</button>
			                </div>
			            </form>
			          </div>
			        </div>

			        <div class="modal-container" v-if="success">
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
			    </div>
	  		</div>
		</div>
	</transition>
</div>
</template>

<script>
export default {
	data () {
		return {
		  success: false,
		  error : {
		  	confirm_password: '',
		  	old_password: '',
		  	new_password: '',
		  },
		  models : {
		  	pass: '',
		  	old_pass: '',
		  	confirm_pass: '',
		  },
		  showModal: false,
		}
	},
	props: ['id', 'name', 'value'],
    mounted: function () {
      var vm = this
      this.showModal = this.value;
    },
    watch: {
      showModal: function() {
      	this.$emit('input', this.showModal);
      },
      value: function() {
      	this.showModal = this.value;
      }
    },
    destroyed: function () {
      
    },
    methods: {
    	resetForgotPasswordForm: function() {
    		this.models.pass = ''
    		this.models.old_pass = ''
    		this.models.confirm_pass = ''
    	},
    	clearError: function() {
    		this.error.confirm_password = ''
    		this.error.new_password = ''
    		this.error.old_password = ''
    		$('.confirm_password').removeClass('has-error')
    		$('.old_password').removeClass('has-error')
    		$('.new_password').removeClass('has-error')
    	},
    	showPopup: function(e) {
			this.showModal = true
			// add class di container saat popup
			$(this.$el).addClass('show-popup');
		},

		closePopup: function() {
			this.showModal = false
			// remove class di container saat popup
			setTimeout(function() {
			  $(this.$el).removeClass('show-popup');
			}, 300);

			this.resetForgotPasswordForm()
			this.clearError()
		},
		changepass: function() {
			var vm = this
			var domain = laroute.route('facile.changepassword', []);
			var payload = new FormData()
            payload.append('old_password', this.models.old_pass)
            payload.append('new_password', this.models.pass)
            payload.append('confirm_password', this.models.confirm_pass)
            payload.append('_token', facile.token)
            
            this.clearError()

            this.$http.post(domain, payload, function (resp) {
                if (resp.status === '' || resp.status === undefined) {
                 
                } else if (resp.status === true) 
                {
                    this.resetForgotPasswordForm();
                    notify({type: 'success'});
                    this.showModal = false
                }
                else if (resp.status === false)
                {
                	if(resp.error)
                	{
                		$.each(resp.error, function(index, value){
	                		if(index != 'status' && value != '')
	                		{
	                			vm.error[index] = value
	                			$('.'+index).addClass('has-error')
	                		}
	                	})
	
                	}
                	

                	if(resp.message)
                	{
	                	$('.old_password').addClass('has-error')
                		vm.error['old_password'] = resp.message
                	}
                }
            });
		},
    }
}
</script>
