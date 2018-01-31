/* http://vuejs.org/guide/ */
import Ftext from '../../../../../Themes/Admin/resources/assets/js/views/components/text.vue';
import Fchosen from '../../../../../Themes/Admin/resources/assets/js/views/components/chosen.vue';
import Fimage from '../../../../../Themes/Admin/resources/assets/js/views/components/singleimage.vue';
import Ftexteditor from '../../../../../Themes/Admin/resources/assets/js/views/components/ckeditor.vue';
import Fdate from '../../../../../Themes/Admin/resources/assets/js/views/components/datepicker.vue';

module.exports = function about() {

    var split_url = facile.href_url.split('#')
    var identifier_url = split_url[1]
    var dimension = facile.dimension

    var controller = new Vue({
        el: '#template_about',
        data: {
            models: {
                id: '',
                section_one_title: '',
                section_one_description: '',
                contact_us_title: '',
                contact_us_introduction: '',
            },
            data: {},

            section_one_images: {
                image_url: '',
            },

            contact_us_images: {
                image_url: '',
            },

            supported_language: facile.supported_language,
            current_language : facile.current_language,
            last_language_key: '',
            identifier: identifier_url,
            formTitle: 'About Information',
            edit: false,
        },

        components: {
            Ftext, Fchosen, Fimage, Ftexteditor, Fdate
        },

        watch: {

        },

        methods: {

            fetchData: function () {
                var domain  = laroute.route('cms.about.data', []);
                var vm = this;
                this.$http.get(domain).then(function (response) {
                    if(response.data.status == true) {
                        vm.data = response.data.data.about
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
                var domain  = laroute.route('cms.about.edit', []);

                this.$http.post(domain, form).then(function (response) {
                    response = response.data
                    this.models = response.data
                    this.section_one_images.image_url = response.data.section_one_images_url
                    this.contact_us_images.image_url = response.data.contact_us_images_url
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
                $("#form-about").ajaxForm(optForm);
                $("#form-about").submit();
            },

            resetForm: function() {

                this.models.id = ''
                this.models.section_one_title = ''
                this.models.section_one_description = ''
                this.models.contact_us_title = ''
                this.models.contact_us_introduction = ''
                
                this.models.section_one_images_url = ''
                this.models.contact_us_images_url = ''  

                this.section_one_images.image_url = ''
                this.contact_us_images.image_url = ''

                this.$refs.section_one_images[0].clearImage();
                this.$refs.contact_us_images[0].clearImage();

                this.edit = false
                $("#select-category").val('').trigger("change");
                this.prepareImage()
            },

            prepareImage: function() {
                this.section_one_images.options = {
                    "width": dimension.SECTION_ONE_IMAGES_WIDTH,
                    "height": dimension.SECTION_ONE_IMAGES_HEIGHT,
                    "size": dimension.MAX_IMAGES_SIZE,
                }
                this.contact_us_images.options = {
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