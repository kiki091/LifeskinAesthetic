/* http://vuejs.org/guide/ */
import Ftext from './../../views/components/text.vue';
import Fcheckbox from './../../views/components/checkbox.vue';

module.exports = function systemmanager() {

    //var identifier_url = split_url[1]

    var controller = new Vue({
        el: '#template_role',
        data: {
            models: {
                id: '',
                role_name: '',
                description: ''
            },
            data: {},
            //identifier: identifier_url,
            formTitle: 'Add Role',
            edit: false,
            selectedcheckbox: [],
        },
        components: {
            Ftext, Fcheckbox
        },
        methods: {
            changeButton: function() {
                this.edit   = false
                this.models = { id: '', role_name: '', description: '' }
                this.formTitle = 'Add Role'
                this.refresh()
            },
            refresh: function() {
                this.selectedcheckbox = []
            },
            fetchRole: function () {
                var domain  = laroute.route('facile.role.data', []);
                var vm = this;
                this.$http.get(domain).then(function (response) {
                    if(response.data.status == true) {
                        vm.data = response.data.data
                    } else {
                        notify({type:'error'})
                    }
                })
            },

            addRole: function () {
                var vm = this
                var domain          = laroute.route('facile.role.store', []);
                var role_managers   = this.models

                var name            = role_managers.role_name
                var description     = role_managers.description
                var privilege       = vm.selectedcheckbox
                
                var payload = { role_name: name, description: description, privilege:privilege, _token:facile.token }

                this.$http.post(domain, payload).then(function (response) {
                    if (response.data.status == '') {
                        var messages = []
                        $.each(response.data, function(index, obj){
                            if(index != 'status' && obj != '')
                                messages.push(obj)
                        })
                        notify({type:'error', message:messages})
                    } else {
                        if (response.data.status === true) 
                        {
                            this.models = { role_name: '', description: '' }
                            this.refresh()
                            this.fetchRole();
                            $('.close-toggle').click()
                        }
                        notify({type:'success'})
                    }
                });
            },

            editRole: function (id) {
                var domain          = laroute.route('facile.role.edit', []);
                var role_managers   = this.models
                var vm = this

                this.edit = true
                this.refresh()

                this.$http.get(domain+id).then(function (response) {
                    if(response.data.status == true) {
                        $.each(response.data.data.roles, function(index, key) {
                            role_managers.id             = key.id
                            role_managers.role_name      = key.role_name
                            role_managers.description    = key.desc
                        })

                        $.each(response.data.data.privileges, function(index, key) {
                            vm.selectedcheckbox.splice(vm.selectedcheckbox.length + 1, 0, key.privilege_id.toString());
                        })


                        $("input[name='role_name_rm']:first").focus()
                        vm.formTitle = 'Edit Role'
                        $('.open-toggle').click();
                    } else {
                        notify({type:'error'})
                    }
                })
            },

            updateRole: function (id) {
                var domain          = laroute.route('facile.role.update', []);
                var role_managers   = this.models
                
                var ids             = id;
                var name            = role_managers.role_name
                var description     = role_managers.description
                var privilege       = this.selectedcheckbox

                var payload = { ids: id, role_name: name, description: description, privilege:privilege, _token:facile.token }

                this.$http.post(domain+id, payload).then(function(response) {
                    if (response.data.status == '') {
                        var messages = []
                        $.each(response.data, function(index, obj){
                            if(index != 'status' && obj != '')
                                messages.push(obj)
                        })
                        notify({type:'error', message:messages})
                        this.edit = true
                    } else {
                        if (response.data.status === true) 
                        {
                            this.models = { role_name: '', description: '' }
                            this.refresh()
                            this.fetchRole();
                            $('.close-toggle').click()
                            this.edit = false
                        }
                        notify({type:'success'})
                    }
                });

                event.stopPropagation()
            },

        },
        mounted() {
            this.fetchRole()
        }

    });
}