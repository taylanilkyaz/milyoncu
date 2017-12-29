(function ($, window, document, undefined) {
    'use strict';

    /**
     * Orjinal değerler.
     */

    /**
     * Resim containerları
     */

    function initialize() {
        popupInit();

    }

    function popupInit() {
        $("#sha-512-info").popup();
    }

    window.homeHandler = {
        init: initialize
    };


    //after the DOM is ready call our init function
    $(function () {
        homeHandler.init();
    });

})(jQuery, window, document);
