window.menumanager = require('./pages/accounts/menu-manager');
window.menugroupmanager = require('./pages/accounts/group-manager');
window.controllermanager = require('./pages/accounts/controller-manager');
window.functionmanager = require('./pages/accounts/function-manager');
window.systemmanager = require('./pages/accounts/system-manager');
window.rolemanager = require('./pages/accounts/role-manager');
window.adminmanager = require('./pages/accounts/admin-manager');
window.seomanager = require('./pages/seo/seo-manager');
window.subscribermanager = require('./pages/newsletter/subscriber-manager');

$(document).ready(function() {
	
    $('.menu--link').on('click', function() {
        var func = $(this).attr('data-js')
        var uri = $(this).attr('data-uri')
        if(typeof func !== "undefined")
        {
            $('.main__wrapper__content').load(uri, function()
            {
                window.Events = new Vue({});
                window[func]();
            });
        }
        else
            window.location.href = uri
        
    })
    
})
