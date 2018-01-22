import Ftext from './../../views/components/text.vue';
import Ftexteditor from './../../views/components/ckeditor.vue';
import Fchosen from './../../views/components/chosen.vue';

module.exports = function functionmanager() {
    var split_url = facile.href_url.split('#')
    var identifier_url = split_url[1]

    var controller = new Vue({
        el: '#template_function',
        data: {
            selected : '',
            models: {
                id: '',
                name: '',
                description: '',
                controller_id: '',
                controller_name: '',
            },
            data: {},
            controller_manager: {},
            identifier: identifier_url,
            edit: false,
        },
        components : {
            Ftext, Ftexteditor, Fchosen
        },
        methods: {
            changeButton: function() {
                this.edit   = false
                this.models = { id: '', controller_name: '', controller_id: ''
                    , name: '', description: '' }
                this.refresh()
            },
            refresh: function() {
                $('#form_title').text('Add Function');
            },
            showDeleteForm: function(id) {
                facileApp.showConfirmBox('delete', {'id': id})
            },
            closeForm: function() {
                this.showModal = false;

                // remove class di container saat popup
                setTimeout(function() {
                  $('.popup__mask__alert').removeClass('is-visible');
                }, 300);
            },
            fetchData: function () {
                var vm = this
                var domain  = laroute.route('facile.function.data', []);
                this.$http.get(domain).then(function (response) {
                    vm.data = response.data.data
                });
                this.refresh()
            },
            fetchFormData: function()
            {
                var vm = this
                var domain  = laroute.route('facile.controller.data', []);
                this.$http.get(domain).then(function (response) {
                    vm.controller_manager = response.data.data
                });
            },
            addData: function () {
                var domain          = laroute.route('facile.function.store', []);
                var payload = new FormData();

                payload.append('controller', this.selected);
                payload.append('name', this.models.name);
                payload.append('description', this.models.description);
                payload.append('id', this.models.id);
                payload.append('_token', facile.token)

                this.$http.post(domain, payload).then(function (resp) {
                    var resp = resp.data
                    if (resp.status == false) {
                        var messages = []
                        $.each(resp.message, function(index, obj){
                            if(obj != '')
                                messages.push(obj)
                        })
                        notify({type:'error', message:messages})
                    } else if (resp.status === true) 
                    {
                        this.models = { controller_name: '', display_name:'' }
                        this.refresh()
                        this.fetchData()
                        $('.close-toggle').click()
                        notify({type:'success'})
                    }
                });
                
            },
            editData: function (id) {
                $('.open-toggle').click();
                $('#form_title').text('Edit Controller');

                var domain          = laroute.route('facile.function.edit', []);
                var data_managers   = this.models

                this.edit = true
                this.refresh()

                this.$http.get(domain+id).then(function (response) {
                    $.each(response.data, function(index, key) {
                        data_managers.id            = key.id
                        data_managers.name          = key.name
                        data_managers.description   = key.description
                        data_managers.controller_id = key.controller_id
                        $("#select").val(key.controller_id).trigger("change");
                        this.selected = key.controller_id;
                    })
                    $("input[id='function_title']:first").focus()
                })

                $('.btn__toggle').click();
                $('#form_title').text('Edit Function');
                focusForm();
            },
            deleteData: function(id) {
                var domain          = laroute.route('facile.function.delete', []);
                var payload = new FormData();
                payload.append('id', id);
                payload.append('_token', facile.token)

                this.$http.post(domain, payload, function (resp) {
                    if (resp.status === true) 
                    {
                        this.models = { id: '', controller_name: '', controller_id: ''
                            , name: '', description: '' }
                        this.fetchData()
                    }
                    this.refresh()
                    notify({type: 'success'})
                });
            },
        },
        mounted() {
            this.fetchData()
            this.fetchFormData()
            Events.$on('deleteData', (id) => {
                this.deleteData(id)
            })
        }
    })

}