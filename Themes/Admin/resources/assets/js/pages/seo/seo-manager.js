import Ftext from './../../views/components/text.vue';
import Ftexteditor from './../../views/components/ckeditor.vue';

module.exports = function seomanager() {

    var split_url = facile.href_url.split('#')
    var identifier_url = split_url[1]

    var controller = new Vue({
        el: '#template_menu',
        data: {
            selected: '',
            models: {
                id: '',
                key_id: '',
                heading: {"en":"","id":""},
                meta_title  : {"en":"","id":""},
                meta_keyword: {"en":"","id":""},
                meta_description: {"en":"","id":""},
            },
            data: {},
            supported_language: facile.supported_language ,
            current_language : facile.current_language,
            last_language_key: '',
            identifier: identifier_url,
            edit: false
        },
        components: {
            Ftext, Ftexteditor
        },
        methods: {

            showElementByDefaultLang: function(langEn) {
                return this.current_language == langEn
            },

            changeButton: function() {
                var vm = this
                vm.resetForm();
                vm.clearErrorMessage();
            },
            refresh: function() {
               
            },
            clickButton: function(){
            	alert('run here');
            },

            fetchData: function () {
                var vm = this
                var domain  = laroute.route('facile.seo.getData', []);
                this.$http.get(domain).then(function (response) {
                    vm.data = response.data.data
                });

                for (var supported_lang in this.supported_language) {
                    this.last_language_key = supported_lang
                }

               // this.refresh()
            },
            

            editData: function (id) {
            	//console.log('run here'+ id);
                var payload = []
                payload['id'] = id
                payload['type'] = "Pages"
                var form = new FormData();

                form.append('_token', facile.token)
                for (var key in payload) {
                    form.append(key, payload[key])
                }

                this.edit   = true
                var domain  = laroute.route('facile.seo.edit', []);
                this.$http.post(domain, form).then(function(response) {
                    this.models         = response.data.data.translations
                    this.models.id      = response.data.data.id
                    this.models.key_id  = response.data.data.key_id
                    replaceToCkEditor()
                    $('.open-toggle').click();
                })
            },

           
            storeData: function(event) {

                var vm = this;
                var optForm      = {

                    dataType: "json",
                    uploadProgress: function (event, position, total, percentComplete){
                    },
                    beforeSerialize: function(form, options) {
                    },
                    beforeSend: function(){
                    },
                    success: function(response){
                        if (response.status == false) {
                            if(response.is_error_form_validation) {

                                var message_validation = ''
                                $.each(response.message, function(key, value){
                                    $('input[name="' + key.replace(".", "_") + '"]').focus();
                                    $('.field-'+key).addClass('has-error');
                                    console.log($('.field-'+key).addClass('has-error'));
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
                        }
                    },
                    complete: function(response){
                    }

                };
                $("#formSeo").ajaxForm(optForm);
                $("#formSeo").submit();
            },

            resetForm: function(setEditToFalse) {

                for (var supported_lang in this.supported_language)
                {
                    this.models.heading[supported_lang] = ''
                    this.models.meta_title[supported_lang] = ''
                    this.models.meta_keyword[supported_lang] = ''
                    this.models.meta_description[supported_lang] = ''
                }

                for(name in CKEDITOR.instances)
                {
                    CKEDITOR.instances[name].setData('');
                }

                this.models.id          = ''
                this.models.key_id          = ''

                if(setEditToFalse) {
                    this.edit = false
                }



            },

            clearErrorMessage: function()
            {
                $(".field").removeClass('has-error');
                $(".s9").text('');
            },

        },

        mounted() {
            this.fetchData()
            wizardSlide()
        }
    })
}