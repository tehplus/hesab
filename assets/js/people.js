// جاوا اسکریپت برای مدیریت باز و بسته شدن منوها
$(document).ready(function() {
    $('.menu-item.has-submenu > .menu-link').on('click', function(e) {
        e.preventDefault();
        var $submenu = $(this).next('.submenu');
        $('.submenu').not($submenu).slideUp();
        $submenu.slideToggle();
        $('.menu-item.has-submenu').not($(this).parent()).removeClass('active');
        $(this).parent().toggleClass('active');
    });
});