(function( $, window, document, undefined ) {
    'use strict';


    function handleTableSort() {
        $('#buyed-table').tablesort();
    }

    function initialize() {
        handleTableSort();
    }

    window.buyedHandler = {
        init : initialize
    };


    //after the DOM is ready call our init function
    $(function(){
        buyedHandler.init();
    });
})( jQuery, window, document );
