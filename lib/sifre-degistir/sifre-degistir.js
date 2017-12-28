(function( $, window, document, undefined ) {
    'use strict';

    function handleKeyUp() {
        $("#second-password-id").keyup(function () {
            compare();
        });

        $("#first-password-id").keyup(function () {
            compare();
        });
    }

    function compare() {
        var passFirst=$("#first-password-id").val();
        var passSecond=$("#second-password-id").val();

        if (passFirst==passSecond){
            $('#check_equal').css('display','block');
            $('#login-submit').removeClass("disabled");

        } else{
            $('#check_equal').css('display','none');
            $('#login-submit').addClass("disabled");
        }
    }
    
    function initialize() {
        handleKeyUp();

    }

    window.buyedHandler = {
        init : initialize
    };


    //after the DOM is ready call our init function
    $(function(){
        buyedHandler.init();
    });
})( jQuery, window, document );
