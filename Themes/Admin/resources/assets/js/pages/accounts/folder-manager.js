/* http://vuejs.org/guide/ */

function crudFolder() {
    var url      = window.location.href; 
    var split_url = qcms.href_url.split('#')
    var identifier_url = split_url[1]

    var controller = new Vue({
        el: '#template_folder',
        data: {
            models: {
                id: '',
                folder_name: '',
                folder_group: '',
                function_js: '',
                is_visible: ''
            },
            data: {},
            identifier: identifier_url,
            edit: false,
            showModal: false
        },

        methods: {

            changeButton: function() {
                this.edit   = false
                this.models = { id: '', folder_name: '', folder_group: '', function_js: '', is_visible: '' }
                setTimeout(function() {
                  this.refresh()
                }, 400);
            },

            showDeleteForm: function(id) {
                this.showModal = true;
                this.models.id = id;

                $('.popup__mask__alert').addClass('is-visible');

                // add class di container saat popup
                $('.container__main').addClass('popupContainer');
            },

            closeForm: function() {
                this.showModal = false;

                // remove class di container saat popup
                setTimeout(function() {
                  $('.popup__mask__alert').removeClass('is-visible');
                }, 300);
            },

            refresh: function() {
                $('#error-name-fm').text('')
                $('#error-group-fm').text('')
                $('#error-functionjs-fm').text('')
                $('#error-isvisible-fm').text('')
            },

            fetchFolder: function () {
                var domain  = laroute.url('accounts/folder-manager/data', []);

                this.$http.get(domain).then(function (response) {
                    if(response.data.status == true) {
                        this.$set('data', response.data.data)
                    } else {
                        pushNotif(response.data.status, response.data.message)
                    }
                })
            },

            addFolder: function () {
                var domain              = laroute.url('accounts/folder-manager/submit', []);
                var folder_managers     = this.models
                
                var folder_name     = folder_managers.folder_name
                var folder_group    = folder_managers.folder_group
                var function_js     = folder_managers.function_js
                var is_visible      = folder_managers.is_visible

                var payload = { folder_name: folder_name, folder_group: folder_group, is_visible: is_visible
                    , function_js: function_js, _token:qcms.token }

                this.$http.post(domain, payload).then(function (response) {
                    if (response.data.status == '') {
                        if (response.data.folder_name) {
                            $('#error-name-fm').text(response.data.folder_name)
                        } else {
                            $('#error-name-fm').text('')
                        };
                        if (response.data.folder_group) {
                            $('#error-group-fm').text(response.data.folder_group)
                        } else {
                            $('#error-group-fm').text('')
                        };
                        if (response.data.function_js) {
                            $('#error-functionjs-fm').text(response.data.function_js)
                        } else {
                            $('#error-functionjs-fm').text('')
                        };
                        if (response.data.is_visible) {
                            $('#error-isvisible-fm').text(response.data.is_visible)
                        } else {
                            $('#error-isvisible-fm').text('')
                        };
                    } else {
                        if (response.data.status === true)
                        {
                            this.models = { folder_name: '', folder_group: '', function_js: '', is_visible: '' }
                            this.refresh()
                            this.fetchFolder()
                            pushNotif(response.status, response.data.message)
                            $('.btn__add__cancel').click()
                        }
                    }
                });
            },

            editFolder: function (id) {
                var domain              = laroute.url('accounts/folder-manager/edit', []);
                var folder_managers     = this.models

                this.edit = true
                this.refresh()

                this.$http.get(domain+id).then(function (response) {
                    $("#folder_title").focus()
                    if(response.data.status == true) {
                        $.each(response.data.data, function(index, key) {
                            folder_managers.id              = key.id
                            folder_managers.folder_name     = key.folder_name
                            folder_managers.folder_group    = key.folder_group
                            folder_managers.function_js     = key.function_js
                            folder_managers.is_visible      = key.is_visible
                        })
                        
                    } else {
                        pushNotif(response.data.status, response.data.message)
                    }
                    
                    $('.btn__toggle').click();
                })
            },

            updateFolder: function (id) {
                var domain          = laroute.url('accounts/folder-manager/update', []);
                var folder_managers   = this.models
                
                var ids             = id;
                var folder_name     = folder_managers.folder_name
                var folder_group    = folder_managers.folder_group
                var function_js     = folder_managers.function_js
                var is_visible     = folder_managers.is_visible

                var payload = { ids: id, folder_name: folder_name, folder_group: folder_group, function_js: function_js, is_visible:is_visible, _token:qcms.token }

                this.$http.post(domain+id, payload).then(function(response) {
                    if (response.data.status == '') {
                        if (response.data.folder_name) {
                            $('#error-name-fm').text(response.data.folder_name)
                        } else {
                            $('#error-name-fm').text('')
                        };
                        if (response.data.folder_group) {
                            $('#error-group-fm').text(response.data.folder_group)
                        } else {
                            $('#error-group-fm').text('')
                        };
                        if (response.data.function_js) {
                            $('#error-functionjs-fm').text(response.data.function_js)
                        } else {
                            $('#error-functionjs-fm').text('')
                        };
                        if (response.data.is_visible) {
                            $('#error-isvisible-fm').text(response.data.is_visible)
                        } else {
                            $('#error-isvisible-fm').text('')
                        };
                        this.edit = true
                    } else {
                        if (response.data.status === true)
                        {
                            this.models = { folder_name: '', folder_group: '', function_js: '', is_visible: '' }
                            this.refresh()
                            pushNotif(response.status, response.data.message)
                            this.fetchFolder()
                            this.edit = false
                            $('.btn__add__cancel').click()
                        }
                    }
                });

                event.stopPropagation()
            },

            deleteFolder: function (id) {
                var domain  = laroute.url('accounts/folder-manager/delete', []);

                var payload = { id:id, _token:qcms.token }

                this.$http.post(domain+id, payload).then(function (response) {
                    if (response.data.status == true) {
                        this.fetchFolder()
                    }
                    setTimeout(function() {
                        $('.popup__mask__alert').removeClass('is-visible')
                    }, 300);
                    pushNotif(response.data.status, response.data.message)
                    this.showModal = false
                });
            },

            sortable: function() {
                var vm = this;

                setTimeout(function(){
                    Sortable.create(document.getElementById('sort'), {
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
                //get id list
                var ids = document.getElementsByClassName('sort-item'),
                id_order  = [].map.call(ids, function(input) {
                    return input.id;
                });
                //end get id list

                var domain  = laroute.url('accounts/folder-manager/order', []);

                var payload = {list_order: id_order, _token:qcms.token };

                this.$http.post(domain, payload).then(function(response) {
                    console.log(response);
                });
            },

        },

        ready: function () {
            this.sortable();
            this.fetchFolder();
        }

    });
}