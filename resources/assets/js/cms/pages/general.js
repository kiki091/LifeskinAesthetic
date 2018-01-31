/* http://vuejs.org/guide/ */
import Ftext from '../../../../../Themes/Admin/resources/assets/js/views/components/text.vue';
import Fchosen from '../../../../../Themes/Admin/resources/assets/js/views/components/chosen.vue';
import Fimage from '../../../../../Themes/Admin/resources/assets/js/views/components/singleimage.vue';
import Ftexteditor from '../../../../../Themes/Admin/resources/assets/js/views/components/ckeditor.vue';
import Fdate from '../../../../../Themes/Admin/resources/assets/js/views/components/datepicker.vue';

module.exports = function general() {

    var split_url = facile.href_url.split('#')
    var identifier_url = split_url[1]
    var dimension = facile.dimension

    var controller = new Vue({
        el: '#template_general',
        data: {
            models: {
                id: '',
                web_title: '',
                og_title: '',
                og_description: '',
                latitude: '',
                longitude: '',
                address: '',
                address_introduction: '',
                contact_title: '',
                contact_introduction: '',
                email: '',
                phone_number: '',
                open_hours: '',
                facebook_link: '',
                twitter_link: '',
                instagram_link: '',
            },
            data: {},

            favicon: {
                image_url: '',
            },

            og_images: {
                image_url: '',
            },

            logo: {
                image_url: '',
            },

            contact_images: {
                image_url: '',
            },

            supported_language: facile.supported_language,
            current_language : facile.current_language,
            last_language_key: '',
            identifier: identifier_url,
            formTitle: 'General Information',
            edit: false,
        },

        components: {
            Ftext, Fchosen, Fimage, Ftexteditor, Fdate
        },

        watch: {

        },

        methods: {

            fetchData: function () {
                var domain  = laroute.route('cms.general.data', []);
                var vm = this;
                this.$http.get(domain).then(function (response) {
                    if(response.data.status == true) {
                        vm.data = response.data.data.general
                    } else {
                        notify({type:'error'})
                    }
                })
            },

            editData: function (id) {

                var vm      = this
                var form = new FormData();
                var payload = []
                payload['id'] = id
                
                form.append('_token', facile.token)
                for (var key in payload) {
                    form.append(key, payload[key])
                }

                this.edit   = true
                var domain  = laroute.route('cms.general.edit', []);

                this.$http.post(domain, form).then(function (response) {
                    response = response.data
                    this.models = response.data
                    this.favicon.image_url = response.data.favicon_url
                    this.logo.image_url = response.data.logo_url
                    this.og_images.image_url = response.data.og_images_url
                    this.contact_images.image_url = response.data.contact_images_url
                });

                this.prepareImage()
                $('#toggle-open-content').slideDown('swing');

            },

            saveData: function () {
                var vm = this;
                //var progressbar = $('.progress-label')
                var optForm      = {
                    dataType: "json",
                    beforeSend: function(){
                        vm.clearErrorMessage();
                    },
                    success: function(response){
                        if (response.status == false) {
                            if(response.is_error_form_validation) {

                                var message_validation = ''
                                $.each(response.message, function(key, value){
                                    $('input[name="' + key.replace(".", "_") + '"]').focus();
                                    $('.field-'+key).addClass('has-error');
                                    $(".label-" + key.replace(".", "_")).text(value)
                                });
                                notify({type: 'error', message : response.message});

                            } else {
                                notify({type: 'error', message : response.message});
                                
                            }
                        } else {
                           vm.fetchData()
                           notify({type: 'success'});
                           $('.close-toggle').click();
                           vm.resetForm()
                           vm.clearErrorMessage();
                        }
                    },
                    complete: function(response){
                        //hideLoading()
                    }

                };
                $("#form-general").ajaxForm(optForm);
                $("#form-general").submit();
            },

            resetForm: function() {

                this.models.id = ''
                this.models.web_title = ''
                this.models.og_title = ''
                this.models.og_description = ''
                this.models.latitude = ''
                this.models.longitude = ''
                this.models.address = ''
                this.models.address_introduction = ''
                this.models.contact_title = ''
                this.models.contact_introduction = ''
                this.models.email = ''
                this.models.phone_number = ''
                this.models.open_hours = ''
                this.models.facebook_link = ''
                this.models.twitter_link = ''
                this.models.instagram_link = ''
                
                this.models.logo_url = ''
                this.models.favicon_url = ''  
                this.models.og_images_url = ''
                this.models.contact_images_url = ''  

                this.logo.image_url = ''
                this.favicon.image_url = ''
                this.og_images.image_url = ''
                this.contact_images.image_url = ''

                this.$refs.logo[0].clearImage();
                this.$refs.favicon[0].clearImage();
                this.$refs.og_images[0].clearImage();
                this.$refs.contact_images[0].clearImage();

                this.edit = false
                $("#select-category").val('').trigger("change");
                this.prepareImage()
            },

            prepareImage: function() {
                this.logo.options = {
                    "width": dimension.FAVICON_IMAGES_WIDTH,
                    "height": dimension.FAVICON_IMAGES_HEIGHT,
                    "size": dimension.MAX_IMAGES_SIZE,
                }
                this.favicon.options = {
                    "width": dimension.LOGO_IMAGES_WIDTH,
                    "height": dimension.LOGO_IMAGES_HEIGHT,
                    "size": dimension.MAX_IMAGES_SIZE,
                }
                this.og_images.options = {
                    "width": dimension.OG_IMAGES_WIDTH,
                    "height": dimension.OG_IMAGES_HEIGHT,
                    "size": dimension.MAX_IMAGES_SIZE,
                }
                this.contact_images.options = {
                    "width": dimension.CONTACT_US_IMAGES_WIDTH,
                    "height": dimension.CONTACT_US_IMAGES_HEIGHT,
                    "size": dimension.MAX_IMAGES_SIZE,
                }
            },

            showElementByDefaultLang: function(langEn) {
                return this.current_language == langEn
            },

            changeButton: function() {
                this.edit   = false
                this.resetForm();
                this.clearErrorMessage();
            },
            
            clearErrorMessage: function()
            {
                $(".field").removeClass('has-error');
                $(".s9").text('');
            },

        },
        mounted() {
            wizardSlide()
            this.fetchData()
            this.prepareImage()
        }

    });
}