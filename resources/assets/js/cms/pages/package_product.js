/* http://vuejs.org/guide/ */
import Ftext from '../../../../../Themes/Admin/resources/assets/js/views/components/text.vue';
import Fchosen from '../../../../../Themes/Admin/resources/assets/js/views/components/chosen.vue';
import Fimage from '../../../../../Themes/Admin/resources/assets/js/views/components/singleimage.vue';
import Ftexteditor from '../../../../../Themes/Admin/resources/assets/js/views/components/ckeditor.vue';
import Fcheckbox from '../../../../../Themes/Admin/resources/assets/js/views/components/checkbox.vue';

module.exports = function package_product() {

    var split_url = facile.href_url.split('#')
    var identifier_url = split_url[1]
    var dimension = facile.dimension

    var controller = new Vue({
        el: '#template_package',
        data: {
            models: {
                id: '',
                title: '',
                description: '',
                price: '',
                product_id: '',
                packege_id: '',
            },
            data: {},

            thumbnail: {
                image_url: '',
            },

            list_product: [],
            product_selector: [],

            supported_language: facile.supported_language,
            current_language : facile.current_language,
            last_language_key: '',
            identifier: identifier_url,
            formTitle: 'Add Package',
            edit: false,
        },

        components: {
            Ftext, Fchosen, Fimage, Ftexteditor, Fcheckbox
        },

        watch: {

        },

        methods: {

            fetchData: function () {
                var domain  = laroute.route('cms.package.data', []);
                var vm = this;
                this.$http.get(domain).then(function (response) {
                    if(response.data.status == true) {
                        vm.data = response.data.data.package
                        vm.list_product = response.data.data.list_product
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
                var domain  = laroute.route('cms.package.edit', []);

                this.$http.post(domain, form).then(function (response) {
                    response = response.data
                    this.models = response.data
                    this.thumbnail.image_url = response.data.thumbnail_url
                    
                    $.each(response.data.package_product,function(value, key){
                        console.log(key)
                        vm.product_selector.splice(vm.product_selector.length + 1, 0, key.id.toString());
                    })
                });

                this.prepareImage()
                $('#toggle-open-content').slideDown('swing');

            },

            deleteData: function(id) {
                
                var payload = []
                payload['id'] = id
                payload['_token'] = facile.token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms.package.delete', []);
                this.$http.post(domain, form).then(function(response) {
                    response = response.data
                    if (response.status == false) {
                        this.fetchData()
                        notify({type: 'error', message : response.message});
                    } else{
                        this.fetchData()
                        notify({type: 'success'});
                    }
                })
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
                $("#form-package").ajaxForm(optForm);
                $("#form-package").submit();
            },

            resetForm: function() {

                this.models.id = ''
                this.models.title = ''
                this.models.slug = ''
                this.models.description = ''
                this.models.price = ''
                this.models.product_id = []
                this.models.package_id = []
                
                this.models.thumbnail_url = ''

                this.thumbnail.image_url = ''

                this.$refs.thumbnail[0].clearImage();

                this.edit = false
                this.product_selector = []

                $("#select-product").val('').trigger("change");
                this.prepareImage()
            },

            prepareImage: function() {
                this.thumbnail.options = {
                    "width": dimension.THUMBNAIL_PACKAGE_IMAGES_WIDTH,
                    "height": dimension.THUMBNAIL_PACKAGE_IMAGES_HEIGHT,
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

            showDeleteForm: function(id) {
                facileApp.showConfirmBox('delete', {'id': id})
            },

        },
        mounted() {
            wizardSlide()
            this.fetchData()
            this.prepareImage()
            Events.$on('deleteData', (id) => {
                this.deleteData(id)
            })
        }

    });
}