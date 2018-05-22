function initHeader() {
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 50;

        if (distanceY > shrinkOn) {
            $("#sticky-header").addClass('smaller');
        } else {
            if ($("#sticky-header").hasClass('smaller')) {
                $("#sticky-header").removeClass('smaller');
            }
        }
    });
}

$(document).ready(function(){
    initHeader();

    $(".open-search, #mobile-search-btn").click(function(){
        $(".overlay").fadeIn('fast');
        $("#search-form input[type='search']").focus();
    });

    $(".cancel-btn").click(function(){
        $(".overlay").fadeOut('fast');
    });

    $("#mobile-nav-btn").click(function(){
        $("#mobile-nav").toggleClass('active')
    });
});