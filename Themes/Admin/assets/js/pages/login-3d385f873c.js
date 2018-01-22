window.onload = function () {
    if(document.getElementById('loginApp')) {
        const app = new Vue({
            el: '#loginApp',
            data: {
                models: {
                    email : '',
                    password: '',
                },
                error: '',
                loginText: 'Sign In',
                state : {
                    loading: false,
                },
            },
            methods: {
                login: function() {
                    var vm = this;
                    var form = new FormData();
                    form.append('email', this.models.email);
                    form.append('password', this.models.password);
                    form.append('_token', facile.token)
                    vm.loginText = 'Loading ...'
                    vm.state.loading = true
                    var options = {
                        headers : {'Accept': 'application/json'}
                    } 

                    axios.post(laroute.route('facile.login.post'), form, options)
                        .then(function (response) {
                            var data = response.data
                            if(data.status)
                            {
                                var url = ''
                                if(response.data.redirect_url && typeof response.data.redirect_url !== 'undefined')
                                    url = response.data.redirect_url
                                else if(login_success_url)
                                    url = laroute.route(login_success_url)
                                else
                                    url = laroute.route('facile.dashboard.index')
                                location.href = url;
                            }
                            else
                            {
                                vm.error = data.messages
                                vm.loginText = 'Sign In'
                                vm.state.loading = false
                            }

                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    


                },
            },
            mounted() {
                
            }
        });
    } 

    if(document.getElementById('forgotApp')) {
        const app = new Vue({
            el: '#forgotApp',
            data: {
                models: {
                    email : '',
                    password: '',
                },
                error: '',
                buttonText: 'Send Email',
                state : {
                    loading: false,
                },
            },
            methods: {
                forgot: function() {
                    var vm = this;
                    var form = new FormData();
                    form.append('email', this.models.email);
                    form.append('_token', facile.token)
                    vm.buttonText = 'Send email ...'
                    vm.state.loading = true
                    var options = {
                        headers : {'Accept': 'application/json'}
                    } 

                    axios.post(laroute.route('facile.forgot.post'), form, options)
                        .then(function (response) {
                            var data = response.data
                            if(data.status)
                            {
                                var url = ''
                                if(response.data.redirect_url && typeof response.data.redirect_url !== 'undefined')
                                    url = response.data.redirect_url
                                else if(forgot_success_url)
                                    url = laroute.route(forgot_success_url)
                                else
                                    url = laroute.route('facile.forgot')
                                location.href = url;
                            }
                            else
                            {
                                vm.error = data.messages
                                vm.buttonText = 'Send Email'
                                vm.state.loading = false
                            }

                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    


                },
            },
            mounted() {
                
            }
        });
    } 

    if(document.getElementById('resetApp')) {
        const app = new Vue({
            el: '#resetApp',
            data: {
                models: {
                    email : '',
                    password: '',
                    password_confirmation: '',
                    token: '',
                },
                error: '',
                buttonText: 'Reset Password',
                state : {
                    loading: false,
                },
            },
            methods: {
                reset: function() {
                    var vm = this;
                    var form = new FormData();
                    form.append('email', this.models.email);
                    form.append('password', this.models.password);
                    form.append('password_confirmation', this.models.password_confirmation);
                    form.append('token', $("[name='token']").val());
                    form.append('_token', facile.token)
                    vm.buttonText = 'Loading ...'
                    vm.state.loading = true
                    var options = {
                        headers : {'Accept': 'application/json'}
                    } 

                    axios.post(laroute.route('facile.forgot.reset'), form, options)
                        .then(function (response) {
                            var data = response.data
                            if(data.status)
                            {
                                var url = ''
                                if(response.data.redirect_url && typeof response.data.redirect_url !== 'undefined')
                                    url = response.data.redirect_url
                                else
                                    url = laroute.route('facile.login')
                                location.href = url;
                            }
                            else
                            {
                                vm.error = data.messages
                                vm.buttonText = 'Reset Password'
                                vm.state.loading = false
                            }

                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    


                },
            },
            mounted() {
                
            }
        });
    } 
}
//# sourceMappingURL=login.js.map
