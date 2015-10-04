(function($){
    $.fn.isVisible = function(){
        var $elem = this;
        $elem.each(function(){
            var elementTop = $(this).offset().top,
                elementHeight = $(this).height(),
                containerTop = $(window).scrollTop(),
                containerHeight = $(window).height();

            if((((elementTop - containerTop) + elementHeight) > 0) && ((elementTop - containerTop) < containerHeight)) {
                $(this).addClass('visible animated fadeIn');
            }
        });
    };
})(jQuery);

$(function(){
    $(window).scroll(function() {
        $('.post').addClass('hidden').isVisible();
    });
});