<template>
<div>
	<div class="dropdown--submenu message--list" v-show="showbox == false">
	    <div class="flex between vcenter message--header">
	    <small class="s10 d-block bold">Messages</small>
	        <a href="#" class="link d-block" @click="openbox"><small class="s10">New Message</small></a>
	    </div>
	    <ul>
	        <li v-for="message in messages">
	            <a href="#">
	                <div class="media">
	                    <div class="media-left media-middle">
	                        <div class="user__img">
	                            <img v-bind:src="message.from.photo" alt="">
	                        </div>
	                    </div>
	                    <div class="media-body widthfull">
	                        <div class="flex between">
	                            <h6 class="margin0 semibold">{{ message.from.name }}</h6>
	                            <small class="s10 margin-l5">{{ message.time }}</small>
	                        </div>
	                        <small class="s10 message--text">{{ message.header }}</small>
	                    </div>
	                </div>
	            </a>
	        </li>
	    </ul>
	</div>
	<div class="dropdown--submenu message--list new-message" v-show="showbox">
	    <div class="form">
	        <div class="form--top flex vcenter between">
	            <h6 class="bold margin0">New Message</h6>
	        </div>
	        <div class="form--middle">
	            <form action="">
	                <div class="field width-auto margin0">
	                    <label class="">{{ lblTitle.address }}</label>
	                    <div class="input--icon icon--left message--recipient">
	                        <input type="text" placeholder="Text placeholder" id="message-recipient">
	                    </div>
	                </div>
	                <div class="field width-auto margin0">
	                    <label class="">{{ lblTitle.message }}</label>
	                    <div class="">
	                        <textarea name="" id="text-editor" class=""></textarea>
	                    </div>
	                </div>
	            </form>
	        </div>
	        <div class="form--bottom flex vcenter between">
	            <button class="btn--primary2 d-block cancel-new-message">Cancel</button>
	            <input type="submit" class="btn--primary submit-message" value="Save and Close">
	        </div>
	    </div>
	</div>
    
</div>
</template>
<script>
	export default {
		data() {
			return {
				lblTitle : {},
				showbox: false,
				addressData: [],
			};
		},
		props: [ 'label', 'messages' ],
		mounted() {
			var vm = this;
			if(this.label)
			{
				this.lblTitle.address = this.label.address ? this.label.address : 'Recipient';
				this.lblTitle.message = this.label.message ? this.label.message : 'Message';
			}
			else
			{
				this.lblTitle.address = 'Recipient';
				this.lblTitle.message = 'Message';
			}
				
			this.prepareComponent();
			
		},
		watch: {

		},
		destroyed: function() {

		},
		methods: {
			openbox: function() {
				this.showbox = true
			},
			loadAddressBook: function(e) {
                var url = laroute.route('facile.admin.address', []);
				var vm = this;
				this.$http.get(url).then(function (response) {
				  vm.addressData = response.data.data;
				}); 
            },
            prepareComponent: function() {
            	var vm = this;
            	vm.loadAddressBook();

				$(this.$el).find('.cancel-new-message').on('click', function() {
					$('.dropdown--wrapper').removeClass('active');
					$(vm.$el).find("#message-recipient").tokenInput("clear");
					$(vm.$el).find("#text-editor").val('');
					vm.showbox = false
				})

				$(this.$el).find('.submit-message').on('click', function() {
					vm.sendmessage();
				})
            },
            sendmessage: function() {
            	var vm = this;
            	$('.dropdown--wrapper').removeClass('active');
				$(vm.$el).find("#message-recipient").tokenInput("clear");
				$(vm.$el).find("#text-editor").val('');
				vm.showbox = false
            },
		},
		watch: {
			addressData: function() {
				$(this.$el).find("#message-recipient").tokenInput(this.addressData, {
					propertyToSearch: "first_name",
					preventDuplicates: false,
					animateDropdown: false,
					resultsFormatter: function(item){ return "<li>" + "<img src='" + item.url + "' title='" + item.first_name + " " + item.last_name + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.first_name + " " + item.last_name + "</div><div class='email'>" + item.email + "</div></div></li>" },
					tokenFormatter: function(item) { return "<li><p>" + item.first_name + " " + item.last_name + "</p></li>" }
				});
			},
		}
	}
</script>