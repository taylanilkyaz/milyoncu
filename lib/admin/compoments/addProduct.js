(function( $, window, document, undefined ) {
    'use strict';


    function initialize() {

    }
    
    function dataTable() {

    }

    window.addProductHandler = {
        init : initialize
    };


    //after the DOM is ready call our init function
    $(function(){
        addProductHandler.init();
    });
})( jQuery, window, document );
