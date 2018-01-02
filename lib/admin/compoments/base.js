;(function( $, window, document, undefined ) {
    'use strict';


    $('#cargos input').on('change', function() {
        var value = $('input[name=cargo]:checked', '#cargos').val();
            $.ajax({
                method: "POST",
                url: "/admin/buy/ajax.php",
                data: { name: "cargo" , value:value}
            }).
            done(function( msg ) {
                var buySidebar = $('#cargoPrice');
                buySidebar.empty();
                buySidebar.append(' <i class="lira  icon"></i>'+ msg);
                var total = $('#totalPrice');
                if (total.length) {
                    var str = $('#cartPrice')[0].innerText;
                    str = str.substring(1); //gets the substring from index position 3 to the end
                    str = Number(str); //converts to a number
                    total.empty();
                    msg = msg.substring(6);
                    total.append(' <i class="lira  icon"></i>'+ ( parseInt(str)+parseInt(msg)));
                }
            });

    });
    function initAccordion() {
        $('.ui.accordion').accordion();
    }

    function initialize() {
        initAccordion();
    }
    
    window.baseAdminHandler = {
        init : initialize
    };

    
    //after the DOM is ready call our init function
    $(function(){
        baseAdminHandler.init();
    });
})( jQuery, window, document );
