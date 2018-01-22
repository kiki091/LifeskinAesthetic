import Ftext from './../../views/components/text.vue';
import Fchosen from './../../views/components/chosen.vue';

module.exports = function menugroupmanager() {
    var split_url = facile.href_url.split('#')
    var identifier_url = split_url[1]

    var controller = new Vue({
    	el: '#template_group',
    	data: {
            selected : '',
            models: {
                id: '',
                group_name: '',
                icon: '',
                system_name: '',
                system_id: '',
            },
            data: {},
            system_manager: {},
            identifier: identifier_url,
            edit: false
        },
        components: {
            Ftext, Fchosen
        },
        methods: {
        	changeButton: function() {
                this.edit   = false
                this.models = { id: '', system_name: '', system_id: '', group_name: '' }
                this.refresh()
            },
            refresh: function() {
                $('#form_title').text('Add Group');
                $("#select").val('').trigger("change");
            },
            fetchData: function () {
                var domain  = laroute.route('facile.group.data', []);
                var vm = this;
                this.$http.get(domain).then(function (response) {
                    vm.data = response.data.data;
                });
                this.refresh()
            },
            fetchFormData: function()
            {
                var domain  = laroute.route('facile.system.data', []);
                var vm = this;
                this.$http.get(domain).then(function (response) {
                    vm.system_manager = response.data.data
                    if (response.data.status === false)
                        notify({type:'error'});
                });
            },
            addData: function () {
                var domain          = laroute.route('facile.group.store', []);
                var payload = new FormData();
	    		payload.append('system', this.selected);
                payload.append('icon', this.models.icon);
                payload.append('name', this.models.group_name);
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
                        if (resp.status === true) 
                        {
                            this.models = { id: '', system_name: '', system_id: '', group_name: '' }
                            this.refresh()
                            this.fetchData()
                            $('.close-toggle').click()
                        }
                        notify({type:'success'});
                    }
                });
            },
            editData: function (id) {
                var domain          = laroute.route('facile.group.edit', []);
                var data_managers   = this.models

                this.edit = true
                this.refresh()

                this.$http.get(domain+id).then(function (response) {
                    $.each(response.data, function(index, key) {
                        data_managers.id            = key.id
                        data_managers.group_name    = key.name
                        data_managers.system_id     = key.system_id
                        data_managers.icon          = key.icon
                        $("#select").val(key.system_id).trigger("change");
                        this.selected = key.system_id;
                    })
                    $("input[id='group_title']:first").focus()
                })

                $('.open-toggle').click();
                $('#form_title').text('Edit Group');
            },
            sortable: function() {
                var vm = this;
                var el = document.getElementById('sort')
                setTimeout(function(){
                    Sortable.create(el, {
                        draggable: 'li.sort-item',
                        ghostClass: "sort-ghost",
                        animation: 300,
                        onUpdate: function(evt) {
                            vm.reorder(evt.oldIndex, evt.newIndex);
                        }
                    });

                }, 100);
                console.log('Order Alert');
            },
            reorder: function(oldIndex, newIndex) {
                var ids = document.getElementsByClassName('sort-item');
                var id_from = ids[oldIndex].getAttribute('data-id');
                var id_to = ids[newIndex].getAttribute('data-id');


                var domain  = laroute.route('facile.group.order', []);
                var payload = new FormData();
                payload.append('id_from', id_from);
                payload.append('id_to', id_to);
                payload.append('_token', facile.token);

                this.$http.post(domain, payload, function (resp) {
                    if (resp.status === true) 
                    {
                        console.log('Order Success');
                    }
                    else
                        notify({type:'error'})
                    
                });
            },
        },
        mounted() {
            this.fetchData()
            this.fetchFormData()
            this.sortable()
        }
    })

}