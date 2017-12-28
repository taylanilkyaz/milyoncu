(function ($, window, document, undefined) {
    'use strict';


    function handleSave() {
        $(".ui.green.button").click(function () {
            var order_code = $(this).parent().prev().prev().prev();
            order_code = order_code.find(".order-code-container").val();
            updateOrderStatus(order_code,6);
        });
    }

    function updateOrderStatus(order_code,status) {
        $.ajax({
            method: "GET",
            url: "ajax-update.php",
            datatype: JSON,
            data: {order_code:order_code,new_status:status}
        }).done(function () {
            alert("You have uploaded sample result with order code : " + order_code);
        });
    }

    function initialize() {
        handleSave();
    }




    window.uploadPDFHandler = {
        init: initialize
    };

    //after the DOM is ready call our init function
    $(function () {
        uploadPDFHandler.init();
    });
})(jQuery, window, document);
