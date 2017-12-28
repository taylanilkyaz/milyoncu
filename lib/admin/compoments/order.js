(function( $, window, document, undefined ) {
    'use strict';


    function handleCopyButton() {
        $(".ui.icon.button").click(function () {
            $("#copy-dimmer").dimmer('show');
            setTimeout(function () {
                $('#copy-dimmer').dimmer('hide');
            }, 3000);
        })
    }



    function initialize() {
        handleCopyButton();
    }

    window.orderHandler = {
        init : initialize
    };


    //after the DOM is ready call our init function
    $(function(){
        orderHandler.init();
    });
})( jQuery, window, document );
