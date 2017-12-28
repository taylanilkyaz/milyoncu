;(function ($, window, document, undefined) {
    'use strict';

    function insertBasket(header) {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {name: header, type: "insert"}
        }).done(function (msg) {
            if (msg.localeCompare("false") != 0) {
                insertBasketInfo(header);
                viewBasket("");
            } else {
                handleNonRegisteredUser(header);
            }
        });
    }

    function deleteBasket(header) {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {name: header, type: "delete"}
        }).done(function (msg) {

        });
    }

    function viewBasket(header) {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {name: header, type: "view"}
        }).done(function (msg) {
            var buySidebar = $('#buy-sidebar-content');
            buySidebar.empty();
            buySidebar.append(msg);
            buySidebar.find('.remove-buy-item').click(function () {
                var parent = $(this).parent().parent();
                var header = parent.find(".header").text().trim();
                deleteBasket(header);
                viewBasket("");
            });
            if (msg.length > 5) {

            }
        });
    }

    function insertBasketInfo(header) {
        $.uiAlert({
            textHead: 'Sepete Eklendi !', // header
            text: header + " artık sepetinizde.", // Text
            bgcolor: '#f24320', // background-color
            textcolor: '#fff', // color
            position: 'top-right',// position . top And bottom ||  left / center / right
            icon: 'shopping bag icon', // icon in semantic-UI
            time: 1.3, // time
        });
    }

    function productButtonClickTask(jqueryObj,event) {
        var offsets = jqueryObj.offset();
        var segmentTop = offsets.top;
        var segmentBottom = segmentTop + jqueryObj.outerHeight(true);
        var clickY = event.pageY;
        var firstMax = (segmentBottom + segmentTop) / 2;
        /**
         * Sepete Ekle
         */
        if (clickY <= firstMax) {
            var header = jqueryObj.find(".name").text().trim();
            insertBasket(header);

            /**
             * Ürün incele
             */
        } else {
            /**
             * Buraya ürün incele kodunu ver.
             */
            var href = jqueryObj.parent().find(".urun-incele-button").attr("href");
            window.location.href = href;
        }

    }

    function handleNonRegisteredUser(header) {
        $("#error-dimmer").dimmer('show');
        setTimeout(function () {
            $('#error-dimmer').dimmer('hide');
        }, 10000);
        $("#error-dimmer").find('#href-id').attr('href','../product-description?name='+header);
        console.log("aa");

    }

    /**Buy form end**/

    function handleButtonClick() {
        var lastClickSegmentId;
        var sameSegmentClickCounter = 0;
        $('#buy-container').find('.ui.segment').click(function (event) {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                ++sameSegmentClickCounter;
                if ($(this).attr("data-id") === lastClickSegmentId && (sameSegmentClickCounter === 2 || sameSegmentClickCounter > 2)) {
                    productButtonClickTask($(this),event);
                } else {
                    sameSegmentClickCounter = 1
                }
                lastClickSegmentId = $(this).attr("data-id");


            } else {
                productButtonClickTask($(this),event);
            }


        });
    }

    function listItemHoverClick() {

    }

    function initialize() {
        viewBasket("");
        handleButtonClick();
        hoverItem();
        listItemHoverClick();
    }

    function hoverItem() {
        $('#buy-container').find('.ui.segment').hover(
            function () {
                $(this).parent().find(".add-basket-button").css({"display": "inherit"});
                $(this).parent().find(".urun-incele-button").css({"display": "inherit"});
            },
            function () {
                $(this).parent().find(".add-basket-button").css({"display": "none"});
                $(this).parent().find(".urun-incele-button").css({"display": "none"});
            }
        );
    }


    window.editProductHandler = {
        init: initialize
    };

    //after the DOM is ready call our init function
    $(function () {
        editProductHandler.init();
    });
})(jQuery, window, document);
