(function( $, window, document, undefined ) {
    'use strict';

    function handleReceive() {
        $(".ui.slider.checkbox").change(function () {
            if ($(this).checkbox("is checked")){
                //sample labaratuvara ulaştı, statusu update
                alert("1");
            }   else {
                alert("2");
            }
        })
    }

    function handleSaveButton() {
        $("#save-button").click(function () {
            var child = $("#barcode-tracking-container .ui.slider.checkbox");
            $.each(child,function () {
                if ($(this).checkbox('is checked')){
                    var order_code = $(this).parent().prev().find('label').text();
                    //db update yap
                    updateOrderStatus(order_code,4);
                    updateOrderStatus(order_code,5);
                    alert("You confirm that you have the sample with code : " + order_code);
                    window.location.assign("/admin/barcode-tracking/index.php");
                }
            })
        })
    }

    function updateOrderStatus(order_code,status) {
        $.ajax({
            method: "GET",
            url: "ajax-update.php",
            datatype: JSON,
            data: {order_code:order_code,new_status:status}
        }).done(function () {
        });
    }

    function initialize() {
        handleSaveButton();
    }

    window.barcodeTrackingHandler= {
        init : initialize
    };

    //after the DOM is ready call our init function
    $(function(){
        barcodeTrackingHandler.init();
    });
})( jQuery, window, document );
