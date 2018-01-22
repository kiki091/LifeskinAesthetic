import Ftext from './../../views/components/text.vue';
import Fcheckbox from './../../views/components/checkbox.vue';

module.exports = function crudAdmin() {
    var controller = new Vue({
        el: '#template_admin',
        data: {
            models: {
                id: '',
                admin_name: '',
                admin_email: '',
                password: '',
                confirm_password: ''
            },
            data: [],
            selectedrole: [],
            roles: [],
            formTitle: 'Add Admin',
            edit: false,
            showModal: false
        },
        components: {
            Ftext, Fcheckbox
        },
        methods: {
            changeButton: function() {
                this.edit   = false
                this.models = { id: '', admin_name: '', admin_email: '', password: '', confirm_password: '' }
                this.formTitle = 'Add Admin'
                $("#email-field").removeAttr('disabled', 'disabled')
                this.refresh()
            },

            showDeleteForm: function(id) {
                this.showModal = true
                this.models.id = id

                $('.popup__mask__alert').addClass('is-visible')

                // add class di container saat popup
                $('.container__main').addClass('popupContainer')
            },

            closeForm: function() {
                this.showModal = false

                // remove class di container saat popup
                setTimeout(function() {
                  $('.popup__mask__alert').removeClass('is-visible')
                }, 300);
            },

            refresh: function() {
                this.selectedrole = []
            },

            fetchAdmin: function () {
                var domain  = laroute.route('facile.admin.data', []);
                var vm = this
                this.$http.get(domain).then(function (response) {
                    var resp = response.data.data
                    vm.data = resp.admins
                    vm.roles = resp.roles
                    
                })
            },

            addAdmin: function () {
                var domain              = laroute.route('facile.admin.store', []);
                var folder_managers     = this.models

                var admin_name     = folder_managers.admin_name
                var admin_email    = folder_managers.admin_email
                var password       = folder_managers.password
                var confirm_password     = folder_managers.confirm_password

                var role = this.selectedrole

                var payload = { admin_name: admin_name, admin_email: admin_email, password: password, confirm_password: confirm_password, roles: role, _token:facile.token }

                this.$http.post(domain, payload).then(function (response) {
                    if (response.data.status === '') {
                        var messages = []
                        $.each(response.data, function(index, obj){
                            if(index != 'status' && obj != '')
                                messages.push(obj)
                        })
                        notify({type:'error', message:messages})
                    }
                    else {
                        if (response.data.status === true)
                        {
                            this.models = { id: '', admin_name: '', admin_email: '', password: '', confirm_password: '' }
                            $('.btn__toggle').click();
                            this.refresh()
                            this.fetchAdmin();
                        }
                        notify({type:'success'})
                        $('.close-toggle').click()
                    }
                });
            },
            editAdmin: function (id) {
                var domain          = laroute.route('facile.admin.edit', []);
                var admin_managers  = this.models
                var vm = this

                $("#email-field").attr('disabled', 'disabled')

                this.edit = true
                this.refresh()

                this.$http.get(domain+id).then(function (response) {
                    if(response.data.status == true) {
                        $.each(response.data.data.users, function(index, key) {
                            admin_managers.id              = key.id
                            admin_managers.admin_name      = key.admin_name
                            admin_managers.admin_email     = key.admin_email
                            admin_managers.password        = key.password
                            admin_managers.confirm_password= key.confirm_password
                        })

                        $.each(response.data.data.roles, function(index, key) {
                            vm.selectedrole.splice(vm.selectedrole.length + 1, 0, key.role_id.toString());
                        })

                        $("input[name='name']:first").focus()
                        vm.formTitle = 'Edit Admin'
                    } else {
                        pushNotif(response.data.status, response.data.message)
                    }
                })

                $('.open-toggle').click();
            },
            updateAdmin: function (id) {
                var domain            = laroute.route('facile.admin.update', []);
                var folder_managers   = this.models

                var ids             = id;
                var admin_name      = folder_managers.admin_name
                var admin_email     = folder_managers.admin_email
                var password        = folder_managers.password
                var confirm_password    = folder_managers.confirm_password
                var role = this.selectedrole
                
                var payload = { ids: id, admin_name: admin_name, admin_email: admin_email, password: password, confirm_password: confirm_password, location_coverage: location, roles: role, _token:facile.token }

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
                            this.models = { id: '', admin_name: '', admin_email: '', password: '', confirm_password: '' }
                            this.refresh()
                            this.fetchAdmin()
                            this.edit = false
                            notify({type:'success'})
                            $("#email-field").removeAttr('disabled', 'disabled')
                            $('.close-toggle').click()
                        }


                    }
                });

                event.stopPropagation()
            },

            deleteAdmin: function (id) {
                var domain  = laroute.route('facile.admin.delete', []);

                var payload = { id:id, _token:facile.token }

                this.$http.post(domain+id, payload).then(function(response) {
                    if (response.status == true) {
                        this.fetchAdmin()
                        notify({type:'success'})
                        this.showModal = false
                    } else {
                        notify({type:'error', message: response.data.message})
                    }
                })
            },
            changeStatus: function (id) {
                if ($('#check_'+id).prop("checked"))
                {
                    // it is checked
                    var domain    = laroute.route('facile.admin.changestatus', []);
                    var id        = id
                    var checked   = 1
                    var payload = {id: id, status: checked, _token:facile.token}

                    this.$http.post(domain, payload).then(function(response) {
                        //pushNotif(response.status, response.data.message)
                    })
                } else {
                    var domain    = laroute.route('facile.admin.changestatus', []);
                    var id        = id
                    var checked   = 0

                    var payload = {id: id, status: checked, _token:facile.token}

                    this.$http.post(domain, payload).then(function (response) {
                        //pushNotif(response.status, response.data.message)
                    })
                }
            },

        },
        mounted() {
            this.fetchAdmin();
        }
    });
}