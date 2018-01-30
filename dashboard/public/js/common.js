$(document).ajaxStart(function() {
    $( "#loading" ).show();
    NProgress.start();
});

$(document). ajaxComplete(function() {
    $( "#loading" ).hide();
    NProgress.done();
});