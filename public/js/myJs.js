$(document).ready(function() {
    var pageName = location.pathname.substring(1)
    pageName = pageName.split('/')
    pageName = pageName[0]
    if ( pageName != 'product' ){
        console.log(pageName)
        $('#compareBar').addClass('show')
    } else {
        $('#compareBar').removeClass('show')
    }
});