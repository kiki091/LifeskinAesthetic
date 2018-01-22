window.onload = function () {
    const app = new Vue({
        el: '#mainApp',
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
//# sourceMappingURL=login.js.map
