function crudPrivilege() {
    var split_url = qcms.href_url.split('#')
    var identifier_url = split_url[1]

    var controller = new Vue({
    	el: '#template_privilege',
    	data: {
            selected_system: '',
            selected_menu: '',
            models: {
                id: '',
                name: '',
                description: '',
                menu_id: '',
                menu_name: '',
                system_id: '',
                system_name: '',
            },
            data: {},
            system_manager: {},
            menu_manager: {},
            controller_manager: {},
            checkFunctions: [],
            identifier: identifier_url,
            edit: false
        },
        methods: {
        	changeButton: function() {
                this.edit   = false
                this.models = { id: '', name: '', description:'',
                    system_id: '', menu_id: '' }
                this.refresh()
                $('.grid-check').masonry('destroy');
                masonryAdminPrivilege(2000);
            },
            refresh: function() {
                $('#error-name-title').text('Required');
                $('#error-system-title').text('Required');
                $('#error-menu-title').text('Required');
                $('#form_title').text('Add Privilege');

                $("#select_menu").val('').trigger("change");
                this.selected_menu = '';

                $("#select_system").val('').trigger("change");
                this.selected_system = '';

            },
            closeForm: function() {
                this.showModal = false;

                // remove class di container saat popup
                setTimeout(function() {
                  $('.popup__mask__alert').removeClass('is-visible');
                }, 300);
            },
            fetchData: function () {
                var domain  = laroute.url('accounts/privilege-manager/data', []);
                this.$http.get(domain).then(function (response) {
                    return_data = response.data
                    this.$set('data', return_data.data)
                    //pushNotif(return_data.status, return_data.message)
                });
                this.refresh()
            },
            fetchSystemForm: function() {
                var domain  = laroute.url('accounts/system-manager/data', []);
                this.$http.get(domain).then(function (response) {
                    return_data = response.data
                    this.$set('system_manager', return_data.data)
                });
            },
            fetchMenuForm: function() {
                var domain  = laroute.url('accounts/menu-manager/data', []);
                this.$http.get(domain).then(function (response) {
                    return_data = response.data
                    this.$set('menu_manager', return_data.data)
                });
            },
            fetchControllerForm: function() {
                var domain  = laroute.url('accounts/controller-manager/data', []);
                this.$http.get(domain).then(function (response) {
                    return_data = response.data
                    this.$set('controller_manager', return_data.data)
                });
            },
            addData: function () {
                var domain          = laroute.url('accounts/privilege-manager/submit', []);
                var payload = new FormData();
	    		payload.append('name', this.models.name);
                payload.append('description', this.models.description);
	    		payload.append('id', this.models.id);
                payload.append('system', this.selected_system);
                payload.append('menu', this.selected_menu);
                payload.append('privilege', this.checkFunctions);
	    		payload.append('_token', qcms.token)


                this.$http.post(domain, payload, function (resp) {
                    if (resp.status === '' || resp.status === undefined) {
                        if (resp.name) $('#error-name-title').text(resp.name)
                        else $('#error-name-title').text('')

                        if (resp.system) $('#error-system-title').text(resp.system)
                        else $('#error-system-title').text('')

                        if (resp.menu) $('#error-menu-title').text(resp.menu)
                        else $('#error-menu-title').text('')

                    } else 
                    {
                        if (resp.status === true) 
                        {
                            this.models = { id: '', name: '', description:'',
                                system_id: '', menu_id: '' }
                            this.refresh()
                            this.fetchData()
                            $('.btn__add__cancel').click()
                        }
                        pushNotif(resp.status, resp.message)
                    }
                });
                
            },
            editData: function (id) {
                var vm = this;
                var domain          = laroute.url('accounts/privilege-manager/edit', []);
                var data_managers   = this.models

                this.edit = true
                this.refresh()  
                $('.grid-check').masonry('destroy')
                this.checkFunctions = []              
                this.fetchControllerForm()
                this.$http.get(domain+id).then(function (response) {
                    var obj = this

                    $.each(response.data, function(index, key) {
                        data_managers.id            = key.id
                        data_managers.name          = key.name
                        data_managers.description   = key.description
                        data_managers.system_id     = key.system_id
                        data_managers.menu_id       = key.menu_id

                        $("#select_menu").val(key.menu_id).trigger("change");
                        this.selected_menu = key.menu_id;

                        $("#select_system").val(key.system_id).trigger("change");
                        this.selected_system = key.system_id;

                        cont = key.controllers
                        if(cont.length)
                            obj.$set('controller_manager', cont)

                    })
                    $("input[id='name_title']:first").focus()
                    $('.grid-check').masonry('destroy');
                    masonryAdminPrivilege(2000);
                })

                $('.btn__toggle').click();
                $('#form_title').text('Edit Privilege');
            },
            combobox: function() {
                var vm = this;
                setTimeout(function(){
                    $("#select_system").select2({ minimumResultsForSearch: -1 })
                    .on('change', function () { vm.selected_system = this.value })

                    $("#select_menu").select2({ minimumResultsForSearch: -1 })
                    .on('change', function () { vm.selected_menu = this.value })

                }, 100);
            },
        },


        ready: function () {
            this.fetchSystemForm()
            this.fetchMenuForm()
            this.fetchData()
            this.combobox()
            this.fetchControllerForm()

        }
    })

}