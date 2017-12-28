;(function( $, window, document, undefined ) {
    'use strict';
    var resizeId;

    function viewSidebarDesktop() {
        setTimeout(function () {
            $('#admin-sidebar').sidebar('setting',{
                transition: 'overlay',
                dimPage: false,
                closable: false,
                duration : 400
            }).sidebar('toggle');
        },100);

    }
    
    function attachWindowSize() {
        resizeId = windowResize();
        if ($(window).width() > 1127) {
            viewSidebarDesktop();
        }
    }
    
    function handleSidebarMenuClick() {
        $('#menu-icon').click(function () {
            viewSidebarResponsive()
        });
    }
    
    function handleMenuButton() {
        $('#menu-icon').click(function () {
            viewSidebarResponsive();
        });

    }

    function deleteBasket(header) {
        $.ajax({
            method: "POST",
            url: "/admin/buy/ajax.php",
            data: { name: header , type:"delete"}
        }).
        done(function( msg ) {

        });
    }

    function viewBasket(header) {
        $.ajax({
            method: "POST",
            url: "/admin/buy/ajax.php",
            data: { name: header , type:"view"}
        }).
        done(function( msg ) {
            var buySidebar = $('#buy-sidebar-content');
            buySidebar.empty();
            buySidebar.append(msg);
            buySidebar.find('.remove-buy-item').click(function () {
                var parent = $(this).parent().parent();
                var header = parent.find(".header").text().trim();
                deleteBasket(header);
                viewBasket("");
            });
            if(msg.length > 5){

            }
        });
    }

    function handleShopButton() {
        $('#shop-icon').click(function () {
            var buySidebar = $('#buy-sidebar');

            if(buySidebar.sidebar("is visible")) {
                buySidebar.sidebar('hide');
            }
            else{
                buySidebar.sidebar('setting',{
                    transition: 'push',
                    dimPage: true,
                    closable: true,
                    duration : 400
                 }).sidebar('toggle');
                viewBasket("");
            }
        });
    }
    
    function hideSidebarDesktop() {
        if($('#admin-sidebar').sidebar("is visible"))
            $('#admin-sidebar').sidebar('hide');
    }
    
    function viewSidebarResponsive() {
        $('#admin-sidebar').sidebar('setting',{
            transition: 'overlay',
            dimPage: true,
            closable: true,
            duration : 400
        }).sidebar('toggle');
    }


    function windowResize() {
        $(window).resize(function() {
            if (parseInt($(window).width()) < 1127) {
                clearTimeout(resizeId);
                return setTimeout(hideSidebarDesktop(), 500);
            }
            else {
                clearTimeout(resizeId);
                return setTimeout(viewSidebarDesktop(), 500);

            }
        });
    }

    function initAccordion() {
        $('.ui.accordion').accordion();
    }

    function initialize() {
        initAccordion();
        attachWindowSize();
        handleShopButton();
        handleMenuButton();
        handleSidebarMenuClick();
    }
    
    window.baseAdminHandler = {
        init : initialize
    };

    
    //after the DOM is ready call our init function
    $(function(){
        baseAdminHandler.init();
    });
})( jQuery, window, document );
