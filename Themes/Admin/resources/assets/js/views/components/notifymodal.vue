<template>
<div>
	<transition name="modal">
	    <div class="modal-mask" v-if="showConfirm">
	  		<div class="modal-wrapper">
	    		<div @close="showConfirm==false">
			        <div class="modal-container">
			          <div class="modal-header center-align">
			            <h6 class="margin0 bold">Notification</h6>
			            <a href="javascript:void(0);" class="close-popup" @click.prevent="closePopup"></a>
			          </div>
			          <div class="modal-body">
			            <div class="change-pass-success center-align">
			                <p>{{ title }}</p>
			                <br>
			                <div class="flex center">
			                    <a href="#" class="btn--primary2" @click.prevent="closeNoPopup">No</a>
			                    <a href="#" class="btn--primary" @click.prevent="closeYesPopup">Yes</a>
			                </div>
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
		  showConfirm: false,
		  title: '',
		}
	},
	props: ['value', 'type', 'data'],
    mounted: function () {
      var vm = this
      this.showConfirm = this.value;
      this.setTitle()
    },
    watch: {
      showConfirm: function() {
      	this.$emit('input', this.showConfirm);
      },
      value: function() {
      	this.showConfirm = this.value;
      },
      type: function() {
      	this.setTitle()
      },
    },
    destroyed: function () {
      
    },
    methods: {
    	setTitle: function() {
    		if(this.type=='default')
	      		this.title = 'Title default'
	      	else if(this.type=='delete')
	      		this.title = 'Are sure that you want to delete this ?'
	      	else if(this.type=='save')
	      		this.title = 'Are sure that you want to save this ?'
    	},
    	showPopup: function(e) {
			this.showConfirm = true
			try {
                this.$parent.setIsConfirm(false)
            }
            catch(err) {}
			// add class di container saat popup
			$(this.$el).addClass('show-popup');
		},

		closePopup: function() {
			this.showConfirm = false
			// remove class di container saat popup
			setTimeout(function() {
			  $(this.$el).removeClass('show-popup');
			}, 300);
		},
		closeNoPopup: function() {
			this.closePopup();
			try {
                this.$parent.setIsConfirm(false)
            }
            catch(err) {}
			return false;
		},
		closeYesPopup: function() {
			this.closePopup();
			try {
                this.$parent.setIsConfirm(true)
                Events.$emit('deleteData', this.data.id);
            }
            catch(err) {}
			return true;
		}
    }
}
</script>
