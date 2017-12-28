(function( $, window, document, undefined ) {
    'use strict';


    function initialize() {

    }

    window.detailHandler = {
        init : initialize
    };


    //after the DOM is ready call our init function
    $(function(){
        detailHandler.init();
    });
})( jQuery, window, document );
