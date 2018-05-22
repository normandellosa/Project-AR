$(document).ready(function() {

    var $grid = $("#grid-content").isotope({
        itemSelector    : '.grid-item',
        percentPosition : true,
        stagger         : 30,
        masonry         : {
            columnWidth : '.grid-sizer',
            gutter      : 15
        }
    });

    $grid.imagesLoaded().progress(function(){
        $grid.isotope('layout');
    });
 
    $('.ws-filter li').click(function(){
        if (!$(this).hasClass('disabled')) {
            $('.ws-filter li').removeClass('active');
            $(this).addClass('active');
     
            var selector = $(this).attr('data-filter');
            $("#grid-content").isotope({
                filter           : selector,
                itemSelector     : '.grid-item',
                percentPosition  : true,
                stagger          : 30,
                animationOptions : {
                    duration     : 750,
                    easing       : 'swing',
                    queue        : false
                },
                masonry          : {
                    columnWidth  : '.grid-sizer',
                    gutter       : 15
                }
             });
             return false;   
        }
    });

   /* $('#grid-content').infiniteScroll({
        // options
        path: '.pagination__next',
        append: '.grid-item',
        history: false,
    });*/
	
});