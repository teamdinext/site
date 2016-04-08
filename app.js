angular.module('login', [])
.controller('loginController', function() {
    var page = this;
    page.login = true;
    page.registering = false;
    page.action = 'login/';
    page.toggleText = 'Don\'t have an account? Create one!';
    page.submitText = "Log In";
    page.toggleRegister = function() {
        if (page.login === true) {
            page.login = false;
            page.registering = true;
            page.action = 'register/';
            page.toggleText = 'Already have an account? Log in!';
            page.submitText = "Register";
        } else {
            page.login = true;
            page.registering = false;
            page.action = 'login/';
            page.toggleText = 'Don\'t have an account? Create one!';
            page.submitText = "Log In";
        }
    }

    page.pass = '';
    page.passVerify = '';
    page.verify = function()
    {
        if(page.pass == page.passVerify || (page.pass == undefined || page.passVerify == undefined))
        {
            page.action = page.login?'login/':'register/';
            return true;
        }
        else if(page.login)
        {
            page.action = page.login?'login/':'register/';
            return true;
        }
        else
        {
            page.action = null;
            return false;
        }
    }
});
