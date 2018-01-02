(function ($, window, document, undefined) {
    'use strict';
    var clipboard = new Clipboard('.btn');

    function handleCopyButton() {
        clipboard.on('success', function (e) {
            $(e.trigger).parent().parent().dimmer('show');
            setTimeout(function () {
                $(e.trigger).parent().parent().dimmer('hide');
            }, 1000);
            e.clearSelection();
        });
    }

    function checkBoxes() {
        $.ajax({
            method: "GET",
            url: "ajax.php",
            datatype: JSON,
            data: {option: "check"}
        }).done(function (data) {
            checkBoxesWithData(JSON.parse(data));
        });
    }

    function checkBoxesWithData(data) {
        var i = 0;
        var j = 0;

        $.each(data, function (index, element) {
            var outerDiv = $("#" + element.sipariş_kodu);

            for (i = 0; i <= element.sipariş_durumu; i++) {
                var searchQuery = "div[data-status=\'" + i + "\']";
                var childs = outerDiv.children(searchQuery);
                var inputChild = childs.children("input");
                if (inputChild != undefined)
                    inputChild.attr("checked", "checked");
            }
        })
    }

    function handleSaveCargoNo() {
        $(".submit-cargo-no").click(function () {
            var input = $(this).prev();
            var cargo_no = input.val();
            var order_code = input.parent().parent().attr('id');
            insertCargoNo(cargo_no, order_code);
        });
    }

    function insertCargoNo(cargo_no, order_code) {
        $.ajax({
            method: "GET",
            url: "ajax-cargo-no.php",
            data: {cargo_no: cargo_no, order_code: order_code}
        }).done(function () {
            $('#success-dimmer').dimmer('show');
            setTimeout(function () {
                $('#success-dimmer').dimmer('hide');
            }, 3000);
        })
    }

    function updateDatabase(gridId, status) {
        $.ajax({
            method: "GET",
            url: "ajax-update.php",
            datatype: JSON,
            data: {order_code: gridId, new_status: status}
        }).done(function (data) {
            handleStringStatus(status, gridId)
        });
    }

    function handleStringStatus(status, gridId) {
        var segment = $("#" + gridId);
        var contentParent = segment.parent().parent().parent().parent();
        var titleParent = contentParent.prev();
        updateStringStatus(status, titleParent);
    }

    function updateStringStatus(status, titleParent) {
        $.ajax({
            method: "GET",
            url: "order-string-ajax.php",
            datatype: String,
            data: {status: status}
        }).done(function (data) {
            titleParent.find('.order-status-string-container').empty();
            titleParent.find('.order-status-string-container').append(data);
        });
    }

    function handleOrderPlusRules() {
        $('#orderplus-container').find('.checkbox').checkbox({
            onChecked: function () {
                var prev = $(this).parent().prev();
                if (prev.attr("data-status").localeCompare("input") == 0) {
                    prev = prev.prev();
                }
                var parent = $(this).parent();
                var grandParent = parent.parent();
                var gridId = grandParent.attr("id");

                if (!prev.checkbox("is checked")) {
                    parent.checkbox("set unchecked");
                    $('#error-dimmer').dimmer('show');
                    setTimeout(function () {
                        $('#error-dimmer').dimmer('hide');
                    }, 2000);
                } else {
                    /*status değeri database'e eklenmeli*/
                    var status = parent.attr("data-status");
                    updateDatabase(gridId, status);
                    //handleContent(status);
                }
                if (status == 2) {
                    $('.shipping').show();
                }
            },
            onUnchecked: function () {
                var prev = $(this).parent().prev();
                var parent = $(this).parent();
                var grandParent = parent.parent();
                var gridId = grandParent.attr("id");
                if (!$(this).parent().next().checkbox("is unchecked")) {
                    $(this).parent().checkbox("set checked");
                    $('#error-dimmer').dimmer('show');
                    setTimeout(function () {
                        $('#error-dimmer').dimmer('hide');
                    }, 2000);
                } else {
                    /*status değerinin 1 eksiği database'e eklenmeli*/
                    var status = parent.attr("data-status");
                    updateDatabase(gridId, status - 1);
                    //handleContent(status-1);
                }
                if (status == 2) {
                    $('.shipping').hide();
                }
            },
            onChange: function () {
                /*veri tabanı*/
                /*maximum check edilen data-status bulmamız lazım*/

                console.log('onChange called<br>');
            }
        });

    }

    function handleAccordion() {
        $('.ui.accordion')
            .accordion()
        ;
        $("#header-title").click(function (event) {
            event.stopPropagation();
        })
    }

    function handleFirst() {
        var active_title = $("#orderplus-container").find('.active.title');
    }


    function handleInputClick() {
        $(".shipping").click(function (event) {
            event.preventDefault();
        })
    }

    function initialize() {
        handleSaveCargoNo();
        handleInputClick();
        handleAccordion();
        handleOrderPlusRules();
        handleCopyButton();
        checkBoxes();
        handleFirst();
    }

    window.orderPlusHandler = {
        init: initialize
    };


    //after the DOM is ready call our init function
    $(function () {
        orderPlusHandler.init();
    });
})(jQuery, window, document);
