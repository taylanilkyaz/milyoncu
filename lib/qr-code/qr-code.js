(function( $, window, document, undefined ) {
    'use strict';
    
    function handleClick() {
        $('#show-L-code').click(function () {
            $('#image-container').empty();
            createQrCodes('L');
        });
        $('#show-M-code').click(function () {
            $('#image-container').empty();
            createQrCodes('M');
        });
        $('#show-Q-code').click(function () {
            $('#image-container').empty();
            createQrCodes('Q');
        });
        $('#show-H-code').click(function () {
            $('#image-container').empty();
            createQrCodes('H');
        });
    }

    function createQrCodes(type) {
        var context = $("#qr-code").val();
        $.ajax({
            method: "GET",
            url: "ajax.php",
            data: { context:context},
            success: function(data){
                if (type.localeCompare('L')==0){
                    showLImage(data);
                }   else if (type.localeCompare('M')==0){
                    showMImage(data);
                }   else if (type.localeCompare('Q')==0){
                    showQImage(data)
                }   else{
                    showHImage(data);
                }
            }
        });
    }

    function showLImage(data) {
        $('#image-container').append('<img src="/assets/images/qr-codes/'+data+'_L.png">');
    }
    function showMImage(data) {
        $('#image-container').append('<img src="/assets/images/qr-codes/'+data+'_M.png">');
    }
    function showQImage(data) {
        $('#image-container').append('<img src="/assets/images/qr-codes/'+data+'_Q.png">');
    }
    function showHImage(data) {
        $('#image-container').append('<img src="/assets/images/qr-codes/'+data+'_H.png">');
    }
    
    function initialize() {
        handleClick();

    }

    window.buyedHandler = {
        init : initialize
    };


    //after the DOM is ready call our init function
    $(function(){
        buyedHandler.init();
    });
})( jQuery, window, document );
