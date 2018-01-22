import Ftext from './../../views/components/text.vue';

module.exports = function controllermanager() {
    var split_url = facile.href_url.split('#')
    var identifier_url = split_url[1]

    var controller = new Vue({
    	el: '#template_controller',
    	data: {
            models: {
                id: '',
                controller_name: '',
                display_name: '',
            },
            data: {},
            identifier: identifier_url,
            edit: false
        },
        components : {
            Ftext
        },
        methods: {
        	changeButton: function() {
                this.edit   = false
                this.models = { id: '', controller_name: '', display_name:'' }
                this.refresh()
            },
            refresh: function() {
                $('#form_title').text('Add Controller');
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
                var domain  = laroute.route('facile.controller.data', []);
                this.$http.get(domain).then(function (response) {
                    vm.data = response.data.data
                });
                $('#error-name-title').text('Required')
                $('#error-display-title').text('Required')
            },
            addData: function () {
                var domain          = laroute.route('facile.controller.store', []);
                var payload = new FormData();
	    		payload.append('name', this.models.controller_name);
                payload.append('display_name', this.models.display_name);
	    		payload.append('id', this.models.id);
	    		payload.append('_token', facile.token)

                this.$http.post(domain, payload).then(function (resp) {
                    if (resp.status == '' || resp.status === undefined) {
                        var messages = []
                        $.each(resp, function(index, obj){
                            if(index != 'status' && obj != '')
                                messages.push(obj)
                        })
                        notify({type:'error', message:messages})
                    } else 
                    {
                        if (resp.status === true) 
                        {
                            this.models = { controller_name: '', display_name:'' }
                            this.refresh()
                            this.fetchData()
                            $('.close-toggle').click()
                        }
                        notify({type:'success'})
                    }
                });
                
            },
            editData: function (id) {
                var domain          = laroute.route('facile.controller.edit', []);
                var data_managers   = this.models

                this.edit = true
                this.refresh()

                this.$http.get(domain+id).then(function (response) {
                    $.each(response.data, function(index, key) {
                        data_managers.id              = key.id
                        data_managers.controller_name = key.name
                        data_managers.display_name    = key.display_name
                    })
                    $("input[id='controller_title']:first").focus()
                })

                $('.open-toggle').click();
                $('#form_title').text('Edit Controller');
            },
            deleteData: function(id) {
                var domain          = laroute.route('facile.controller.delete', []);
                var payload = new FormData();
                payload.append('id', id);
                payload.append('_token', facile.token)

                this.$http.post(domain, payload).then(function (resp) {
                    if (resp.status == true) 
                    {
                        this.models = { controller_name: '', display_name:'' }
                        this.fetchData()
                        
                    }
                    this.refresh()
                    this.showModal = false
                    notify({type: 'success'})
                });
            },
        },
        mounted() {
            this.fetchData()
            Events.$on('deleteData', (id) => {
                this.deleteData(id)
            })
        }
    })

}