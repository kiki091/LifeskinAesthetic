/* http://vuejs.org/guide/ */
import Ftext from '../../../../../Themes/Admin/resources/assets/js/views/components/text.vue';
import Fchosen from '../../../../../Themes/Admin/resources/assets/js/views/components/chosen.vue';
import Fimage from '../../../../../Themes/Admin/resources/assets/js/views/components/singleimage.vue';
import Ftexteditor from '../../../../../Themes/Admin/resources/assets/js/views/components/ckeditor.vue';
import Fdate from '../../../../../Themes/Admin/resources/assets/js/views/components/datepicker.vue';

module.exports = function transaction() {

    var split_url = facile.href_url.split('#')
    var identifier_url = split_url[1]
    var dimension = facile.dimension

    var controller = new Vue({
        el: '#template_transaction',
        data: {

            pagination: {
              total: 0,
              per_page: 2,
              from: 1,
              to: 0,
              current_page: 1
            },

            models: {
                id: '',
                registrasi_id: '',
                package_id: '',
                price: '',
                discount: '',
                book_date: '',
                transaction_id: '',
                book_date: '',
                package_title: '',
            },
            registrasi_id: '',
            data: {},

            supported_language: facile.supported_language,
            current_language : facile.current_language,
            last_language_key: '',
            identifier: identifier_url,
            formTitle: 'List Transaction',
            edit: false,
            offset: 4,
            pageNumberDefault : '1',
            list_status: [
                {id: '', text: 'All'},
                {id: '1', text: 'Success'},
                {id: '0', text: 'Pending'},
                {id: '2', text: 'Failed'},
            ],
            status_selector: '',
            booking_date: '',
        },

        components: {
            Ftext, Fchosen, Fimage, Ftexteditor, Fdate
        },

        watch: {
            registrasi_id: _.debounce(function(value) {

                var vm      = this
                var form = new FormData();
                var payload = []
                payload['registrasi_id'] = value
                
                form.append('_token', facile.token)
                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms.transaction.search', []);

                this.$http.post(domain, form).then(function (response) {
                    console.log(response)
                    if(response.data.status == true) {
                        vm.data = response.data.data.transaction.paginate.data
                        vm.pagination = response.data.data.transaction.paginate.pagination
                    } else {
                        notify({type:'error'})
                    }
                })
            },500),

            status_selector: _.debounce(function(value) {

                var vm      = this
                var form = new FormData();
                var payload = []
                payload['status'] = value
                
                form.append('_token', facile.token)
                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms.transaction.search', []);

                this.$http.post(domain, form).then(function (response) {
                    if(response.data.status == true) {
                        vm.data = response.data.data.transaction.paginate.data
                        vm.pagination = response.data.data.transaction.paginate.pagination
                    } else {
                        notify({type:'error'})
                    }
                })
            },500),
        },

        filters: {
            formatDate: function(value) {
                if (value) {
                    return moment(String(value)).format('DD/MM/YYYY')
                }
            }
        },

        computed: {

            isActived: function() {
                return this.pagination.current_page;
            },

            pagesNumber: function() {
              if (!this.pagination.to) {
                return [];
              }
              var from = this.pagination.current_page - this.offset;
              if (from < 1) {
                from = 1;
              }
              var to = from + (this.offset * 2);
              if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
              }
              var pagesArray = [];
              while (from <= to) {
                pagesArray.push(from);
                from++;
              }
              return pagesArray;
            }
        },

        methods: {

            changeStatus: function(params) {
                var vm      = this
                var valId = params;
                var form = new FormData();
                var valData = $('#status-'+params).val();

                var payload = []
                payload['id'] = valId
                payload['status'] = valData
                
                form.append('_token', facile.token)
                for (var key in payload) {
                    form.append(key, payload[key])
                }

                this.edit   = true
                var domain  = laroute.route('cms.transaction.status', []);

                this.$http.post(domain, form).then(function (response) {
                    if(response.data.status == true) {
                        notify({message: 'Success',type:'success'})
                    } else {
                        notify({type:'error'})
                    }
                });
            },

            changePage: function(page) {
              this.pagination.current_page = page;
              this.fetchData(page)
            },

            fetchData: function (page) {
                var domain  = laroute.route('cms.transaction.data', []);
                var vm = this;
                if( typeof page !== 'undefined' ) {
                    domain = domain + "?page=" + page  
                }else{
                    domain = domain + this.pageNumberDefault
                }

                this.$http.get(domain).then(function (response) {
                    if(response.data.status == true) {
                        vm.data = response.data.data.transaction.paginate.data
                        vm.pagination = response.data.data.transaction.paginate.pagination
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
                var domain  = laroute.route('cms.transaction.edit', []);

                this.$http.post(domain, form).then(function (response) {
                    response = response.data
                    this.models = response.data
                });

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
                $("#form-transaction").ajaxForm(optForm);
                $("#form-transaction").submit();
            },

            resetForm: function() {

                this.models.id = ''
                this.models.registrasi_id = ''
                this.models.member_id = ''
                this.models.status = ''
                this.models.package_id = ''
                this.models.price = ''
                this.models.discount = ''
                this.models.book_date = ''
                this.models.transaction_id = ''
                this.models.package_title = ''
                this.models.member_name = ''
                this.models.member_email = ''
                this.models.phone_number = ''

                this.edit = false

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
            wizardSlide();
            this.fetchData(this.pagination.current_page);
        }

    });
}