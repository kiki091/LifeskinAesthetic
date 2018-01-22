import Ftext from './../../views/components/text.vue';

module.exports = function systemmanager() {

    var split_url = facile.href_url.split('#')
    var identifier_url = split_url[1]

    var controller = new Vue({
    	el: '#template_system',
    	data: {
            models: {
                id: '',
                system_name: '',
            },
            data: {},
            identifier: identifier_url,
            formTitle: 'Add System',
            edit: false
        },
        components: {
            Ftext
        },
        methods: {
        	changeButton: function() {
                this.edit   = false
                this.models = { id: '', system_name: '' }
                this.formTitle = 'Add System'
                this.refresh()
            },
            refresh: function() {
                $('#error-title').text('Required')
            },
            fetchData: function () {
                var vm = this;
                var domain  = laroute.route('facile.system.data', []);
                this.$http.get(domain).then(function (response) {
                    vm.data = response.data.data
                });
            },
            addData: function () {
                var domain          = laroute.route('facile.system.store', []);
                var payload = new FormData();
	    		payload.append('name', this.models.system_name);
	    		payload.append('id', this.models.id);
	    		payload.append('_token', facile.token)

                this.$http.post(domain, payload, function (resp) {
                    if (resp.status === '' || resp.status === undefined) {
                        var messages = []
                        $.each(resp, function(index, obj){
                            if(index != 'status' && obj != '')
                                messages.push(obj)
                        })
                        notify({type:'error', message:messages})
                    } else 
                    {
                        if (resp.status == true) 
                        {
                            this.models = { system_name: '' }
                            this.refresh()
                            this.fetchData()
                            $('.close-toggle').click()
                        }
                        notify({type:'success'});

                    }
                });
                
            },
            editData: function (id) {
                var domain          = laroute.route('facile.system.edit', []);
                var data_managers   = this.models
                var vm = this

                this.edit = true
                this.refresh()

                this.$http.get(domain+id).then(function (response) {
                    $.each(response.data, function(index, key) {
                        data_managers.id             = key.id
                        data_managers.system_name    = key.name
                    })
                    $("input[id='system_title']:first").focus()
                    vm.formTitle = 'Edit System'
                })

                $('.open-toggle').click();
                
            },
        },

        mounted(){
            this.fetchData()
        }
    })

}