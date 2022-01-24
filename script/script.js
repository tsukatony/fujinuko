$(document).ready(function(){
    $('.submenu p').on('click', function(){
        $(this).next().toggleClass("hidden");
    });
});
