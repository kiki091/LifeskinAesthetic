(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://lifeskin.dev',
            routes : [
    {
        "uri": "core",
        "name": null
    },
    {
        "uri": "_debugbar\/open",
        "name": "debugbar.openhandler"
    },
    {
        "uri": "_debugbar\/clockwork\/{id}",
        "name": "debugbar.clockwork"
    },
    {
        "uri": "_debugbar\/assets\/stylesheets",
        "name": "debugbar.assets.css"
    },
    {
        "uri": "_debugbar\/assets\/javascript",
        "name": "debugbar.assets.js"
    },
    {
        "uri": "api\/user",
        "name": null
    },
    {
        "uri": "\/",
        "name": "HomePage"
    },
    {
        "uri": "login",
        "name": "LoginPages"
    },
    {
        "uri": "login\/authenticate",
        "name": "LoginAuthenticate"
    },
    {
        "uri": "register\/store",
        "name": "RegisterAuthenticate"
    },
    {
        "uri": "logout",
        "name": "LogoutMember"
    },
    {
        "uri": "news",
        "name": "NewsPage"
    },
    {
        "uri": "news\/{slug}",
        "name": "NewsPageDetail"
    },
    {
        "uri": "news\/category\/{slug}",
        "name": "NewsPageCategory"
    },
    {
        "uri": "package",
        "name": "PackagePage"
    },
    {
        "uri": "package\/{slug}",
        "name": "PackagePageDetail"
    },
    {
        "uri": "product",
        "name": "ProductPage"
    },
    {
        "uri": "product\/{slug}",
        "name": "ProductPageDetail"
    },
    {
        "uri": "product\/category\/{slug}",
        "name": "ProductPageCategory"
    },
    {
        "uri": "about",
        "name": "AboutPage"
    },
    {
        "uri": "about\/subscribe",
        "name": "SubscribeMail"
    },
    {
        "uri": "about\/contact-us",
        "name": "ContactUs"
    },
    {
        "uri": "booking\/store",
        "name": "PackageBooking"
    },
    {
        "uri": "gallery",
        "name": "GalleryPage"
    },
    {
        "uri": "treatment",
        "name": "TreatmentPage"
    },
    {
        "uri": "treatment\/{slug}",
        "name": "TreatmentPageDetail"
    },
    {
        "uri": "cms\/account\/change-password",
        "name": "facile.changepassword"
    },
    {
        "uri": "cms\/account",
        "name": "facile.account.index"
    },
    {
        "uri": "cms\/account\/test",
        "name": "facile.account.index"
    },
    {
        "uri": "cms\/account\/role-manager",
        "name": "facile.role.index"
    },
    {
        "uri": "cms\/account\/role-manager\/data",
        "name": "facile.role.data"
    },
    {
        "uri": "cms\/account\/role-manager\/submit",
        "name": "facile.role.store"
    },
    {
        "uri": "cms\/account\/role-manager\/edit\/{id}",
        "name": "facile.role.edit"
    },
    {
        "uri": "cms\/account\/role-manager\/update\/{id}",
        "name": "facile.role.update"
    },
    {
        "uri": "cms\/account\/folder-manager",
        "name": "facile.folder.index"
    },
    {
        "uri": "cms\/account\/folder-manager\/data",
        "name": "facile.folder.data"
    },
    {
        "uri": "cms\/account\/folder-manager\/submit",
        "name": "facile.folder.store"
    },
    {
        "uri": "cms\/account\/folder-manager\/edit\/{id}",
        "name": "facile.folder.edit"
    },
    {
        "uri": "cms\/account\/folder-manager\/update\/{id}",
        "name": "facile.folder.update"
    },
    {
        "uri": "cms\/account\/folder-manager\/delete\/{id}",
        "name": "facile.folder.delete"
    },
    {
        "uri": "cms\/account\/folder-manager\/order",
        "name": "facile.folder.order"
    },
    {
        "uri": "cms\/account\/system-manager",
        "name": "facile.system.index"
    },
    {
        "uri": "cms\/account\/system-manager\/data",
        "name": "facile.system.data"
    },
    {
        "uri": "cms\/account\/system-manager\/edit\/{id}",
        "name": "facile.system.edit"
    },
    {
        "uri": "cms\/account\/system-manager\/submit",
        "name": "facile.system.store"
    },
    {
        "uri": "cms\/account\/menu-manager",
        "name": "facile.menu.index"
    },
    {
        "uri": "cms\/account\/menu-manager\/data",
        "name": "facile.menu.data"
    },
    {
        "uri": "cms\/account\/menu-manager\/edit\/{id}",
        "name": "facile.menu.edit"
    },
    {
        "uri": "cms\/account\/menu-manager\/submit",
        "name": "facile.menu.store"
    },
    {
        "uri": "cms\/account\/menu-manager\/order",
        "name": "facile.menu.order"
    },
    {
        "uri": "cms\/account\/group-manager",
        "name": "facile.group.index"
    },
    {
        "uri": "cms\/account\/group-manager\/data",
        "name": "facile.group.data"
    },
    {
        "uri": "cms\/account\/group-manager\/edit\/{id}",
        "name": "facile.group.edit"
    },
    {
        "uri": "cms\/account\/group-manager\/submit",
        "name": "facile.group.store"
    },
    {
        "uri": "cms\/account\/group-manager\/order",
        "name": "facile.group.order"
    },
    {
        "uri": "cms\/account\/function-manager",
        "name": "facile.function.index"
    },
    {
        "uri": "cms\/account\/function-manager\/data",
        "name": "facile.function.data"
    },
    {
        "uri": "cms\/account\/function-manager\/search",
        "name": "facile.function.search"
    },
    {
        "uri": "cms\/account\/function-manager\/edit\/{id}",
        "name": "facile.function.edit"
    },
    {
        "uri": "cms\/account\/function-manager\/submit",
        "name": "facile.function.store"
    },
    {
        "uri": "cms\/account\/function-manager\/delete",
        "name": "facile.function.delete"
    },
    {
        "uri": "cms\/account\/controller-manager",
        "name": "facile.controller.index"
    },
    {
        "uri": "cms\/account\/controller-manager\/data",
        "name": "facile.controller.data"
    },
    {
        "uri": "cms\/account\/controller-manager\/edit\/{id}",
        "name": "facile.controller.edit"
    },
    {
        "uri": "cms\/account\/controller-manager\/submit",
        "name": "facile.controller.store"
    },
    {
        "uri": "cms\/account\/controller-manager\/delete",
        "name": "facile.controller.delete"
    },
    {
        "uri": "cms\/account\/privilege-manager",
        "name": "facile.privilege.index"
    },
    {
        "uri": "cms\/account\/privilege-manager\/data",
        "name": "facile.privilege.data"
    },
    {
        "uri": "cms\/account\/privilege-manager\/edit\/{id}",
        "name": "facile.privilege.edit"
    },
    {
        "uri": "cms\/account\/privilege-manager\/submit",
        "name": "facile.privilege.store"
    },
    {
        "uri": "cms\/account\/admin-manager",
        "name": "facile.admin.index"
    },
    {
        "uri": "cms\/account\/admin-manager\/data",
        "name": "facile.admin.data"
    },
    {
        "uri": "cms\/account\/admin-manager\/submit",
        "name": "facile.admin.store"
    },
    {
        "uri": "cms\/account\/admin-manager\/address",
        "name": "facile.admin.address"
    },
    {
        "uri": "cms\/account\/admin-manager\/edit\/{id}",
        "name": "facile.admin.edit"
    },
    {
        "uri": "cms\/account\/admin-manager\/update\/{id}",
        "name": "facile.admin.update"
    },
    {
        "uri": "cms\/account\/admin-manager\/delete\/{id}",
        "name": "facile.admin.delete"
    },
    {
        "uri": "cms\/account\/admin-manager\/change-status",
        "name": "facile.admin.changestatus"
    },
    {
        "uri": "cms\/html\/{view}",
        "name": "facile.account.html"
    },
    {
        "uri": "auth\/login",
        "name": "facile.login"
    },
    {
        "uri": "auth\/login",
        "name": "facile.login.post"
    },
    {
        "uri": "auth\/forgot",
        "name": "facile.forgot"
    },
    {
        "uri": "auth\/forgot\/email",
        "name": "facile.forgot.post"
    },
    {
        "uri": "auth\/forgot\/success",
        "name": "facile.forgot.success"
    },
    {
        "uri": "auth\/forgot\/reset\/{token}",
        "name": "facile.forgot.resetForm"
    },
    {
        "uri": "auth\/forgot\/reset",
        "name": "facile.forgot.reset"
    },
    {
        "uri": "auth\/logout",
        "name": "facile.logout"
    },
    {
        "uri": "cms\/mod",
        "name": "mod.index"
    },
    {
        "uri": "cms\/general",
        "name": "cms.general.index"
    },
    {
        "uri": "cms\/general\/data",
        "name": "cms.general.data"
    },
    {
        "uri": "cms\/general\/edit",
        "name": "cms.general.edit"
    },
    {
        "uri": "cms\/general\/store",
        "name": "cms.general.store"
    },
    {
        "uri": "cms\/about",
        "name": "cms.about.index"
    },
    {
        "uri": "cms\/about\/data",
        "name": "cms.about.data"
    },
    {
        "uri": "cms\/about\/edit",
        "name": "cms.about.edit"
    },
    {
        "uri": "cms\/about\/store",
        "name": "cms.about.store"
    },
    {
        "uri": "cms\/transaction",
        "name": "cms.transaction.index"
    },
    {
        "uri": "cms\/transaction\/data",
        "name": "cms.transaction.data"
    },
    {
        "uri": "cms\/transaction\/search",
        "name": "cms.transaction.search"
    },
    {
        "uri": "cms\/transaction\/edit",
        "name": "cms.transaction.edit"
    },
    {
        "uri": "cms\/transaction\/store",
        "name": "cms.transaction.store"
    },
    {
        "uri": "cms\/transaction\/status",
        "name": "cms.transaction.status"
    },
    {
        "uri": "cms\/news",
        "name": "cms.news.index"
    },
    {
        "uri": "cms\/news\/data",
        "name": "cms.news.data"
    },
    {
        "uri": "cms\/news\/edit",
        "name": "cms.news.edit"
    },
    {
        "uri": "cms\/news\/store",
        "name": "cms.news.store"
    },
    {
        "uri": "cms\/news\/delete",
        "name": "cms.news.delete"
    },
    {
        "uri": "cms\/category",
        "name": "cms.category.index"
    },
    {
        "uri": "cms\/category\/data",
        "name": "cms.category.data"
    },
    {
        "uri": "cms\/category\/edit",
        "name": "cms.category.edit"
    },
    {
        "uri": "cms\/category\/store",
        "name": "cms.category.store"
    },
    {
        "uri": "cms\/category\/delete",
        "name": "cms.category.delete"
    },
    {
        "uri": "cms\/sub_category",
        "name": "cms.sub_category.index"
    },
    {
        "uri": "cms\/sub_category\/data",
        "name": "cms.sub_category.data"
    },
    {
        "uri": "cms\/sub_category\/edit",
        "name": "cms.sub_category.edit"
    },
    {
        "uri": "cms\/sub_category\/store",
        "name": "cms.sub_category.store"
    },
    {
        "uri": "cms\/sub_category\/delete",
        "name": "cms.sub_category.delete"
    },
    {
        "uri": "cms\/product",
        "name": "cms.product.index"
    },
    {
        "uri": "cms\/product\/data",
        "name": "cms.product.data"
    },
    {
        "uri": "cms\/product\/edit",
        "name": "cms.product.edit"
    },
    {
        "uri": "cms\/product\/store",
        "name": "cms.product.store"
    },
    {
        "uri": "cms\/product\/delete",
        "name": "cms.product.delete"
    },
    {
        "uri": "cms\/package",
        "name": "cms.package.index"
    },
    {
        "uri": "cms\/package\/data",
        "name": "cms.package.data"
    },
    {
        "uri": "cms\/package\/edit",
        "name": "cms.package.edit"
    },
    {
        "uri": "cms\/package\/store",
        "name": "cms.package.store"
    },
    {
        "uri": "cms\/package\/delete",
        "name": "cms.package.delete"
    },
    {
        "uri": "cms\/gallery",
        "name": "cms.gallery.index"
    },
    {
        "uri": "cms\/gallery\/data",
        "name": "cms.gallery.data"
    },
    {
        "uri": "cms\/gallery\/edit",
        "name": "cms.gallery.edit"
    },
    {
        "uri": "cms\/gallery\/store",
        "name": "cms.gallery.store"
    },
    {
        "uri": "cms\/gallery\/delete",
        "name": "cms.gallery.delete"
    },
    {
        "uri": "cms\/banner",
        "name": "cms.main_banner.index"
    },
    {
        "uri": "cms\/banner\/data",
        "name": "cms.main_banner.data"
    },
    {
        "uri": "cms\/banner\/edit",
        "name": "cms.main_banner.edit"
    },
    {
        "uri": "cms\/banner\/store",
        "name": "cms.main_banner.store"
    },
    {
        "uri": "cms\/banner\/delete",
        "name": "cms.main_banner.delete"
    },
    {
        "uri": "cms\/treatment",
        "name": "cms.treatment.index"
    },
    {
        "uri": "cms\/treatment\/data",
        "name": "cms.treatment.data"
    },
    {
        "uri": "cms\/treatment\/edit",
        "name": "cms.treatment.edit"
    },
    {
        "uri": "cms\/treatment\/store",
        "name": "cms.treatment.store"
    },
    {
        "uri": "cms\/treatment\/delete",
        "name": "cms.treatment.delete"
    },
    {
        "uri": "cms\/core",
        "name": "facile.core.index"
    },
    {
        "uri": "cms\/message\/list\/{to}",
        "name": "facile.message.list"
    },
    {
        "uri": "cms\/message\/count\/{to}",
        "name": "facile.message.count"
    },
    {
        "uri": "cms\/notification\/list",
        "name": "facile.notification.list"
    },
    {
        "uri": "cms\/dashboard",
        "name": "facile.dashboard.index"
    }
],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

