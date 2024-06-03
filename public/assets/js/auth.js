function authTimeout()
{
    if (typeof $.cookie('user') == 'undefined') {
        window.location = webRoutes.login
    }
}

$(function () {
    authTimeout()

    setTimeout(function() {
        authTimeout()
    }, 3000);
});

