import Ftext from './../../views/components/text.vue';
import Fchosen from './../../views/components/chosen.vue';

module.exports = function menumanager() {
    var split_url = facile.href_url.split('#')
    var identifier_url = split_url[1]

    var controller = new Vue({
        el: '#template_menu',
        data: {
            selected: '',
            models: {
                id: '',
                menu_name: '',
                group_name: '',
                group_id: '',
                uri: '',
                function_js: '',
            },
            data: {},
            group_manager: [{ id: 1, text: 'Hello' },
              { id: 2, text: 'World' }],
            identifier: identifier_url,
            options: [],
            edit: false
        },
        components: {
            Fchosen, Ftext
        },
        methods: {
            changeButton: function() {
                this.edit   = false
                this.models = { id: '', menu_name: '', group_name: '', group_id: '', uri: '', function_js: '' }
                this.refresh()
            },
            refresh: function() {
                $('#form_title').text('Add Menu');
                //$("#select").val('').trigger("change");
            },
            fetchData: function () {
                var vm = this
                var domain  = laroute.route('facile.menu.data', []);
                this.$http.get(domain).then(function (response) {
                    vm.data = response.data.data
                });
                this.refresh()
            },
            fetchFormData: function()
            {
                var domain  = laroute.route('facile.group.data', []);
                var vm = this
                
                this.$http.get(domain).then(function (response) {
                    vm.group_manager = response.data.data
                });
            },
            addData: function () {
                var domain          = laroute.route('facile.menu.store', []);
                var payload = new FormData();
                payload.append('group', this.selected);
                payload.append('name', this.models.menu_name);
                payload.append('uri', this.models.uri);
                payload.append('id', this.models.id);
                payload.append('function_js', this.models.function_js);
                payload.append('_token', facile.token)

                this.$http.post(domain, payload, function (resp) {
                    if (resp.status === '' || resp.status === undefined) {
                        var messages = []
                        $.each(resp, function(index, obj){
                            if(index != 'status' && obj != '')
                                messages.push(obj)
                        })
                        notify({type:'error', message:messages})
                    } else if (resp.status === true) 
                    {
                        this.models = { id: '', menu_name: '', group_name: '', group_id: '', uri: '' }
                        this.refresh()
                        this.fetchData()
                        $('.close-toggle').click()
                        notify({type: 'success'});
                    }
                    else if (resp.status === false)
                    {

                    }
                });
            },
            editData: function (id) {
                var domain          = laroute.route('facile.menu.edit', []);
                var data_managers   = this.models

                this.edit = true
                this.refresh()

                this.$http.get(domain+id).then(function (response) {
                    $.each(response.data, function(index, key) {
                        data_managers.id            = key.id
                        data_managers.menu_name     = key.name
                        data_managers.uri           = key.uri
                        data_managers.group_id      = key.group_id
                        data_managers.function_js   = key.function
                        $("#select").val(key.group_id).trigger("change");
                        this.selected = key.group_id;
                    })
                    $("input[id='menu_title']:first").focus()
                })

                $('.open-toggle').click();
                $('#form_title').text('Edit Menu');
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


                var domain  = laroute.route('facile.menu.order', []);
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
};