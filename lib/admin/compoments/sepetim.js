(function ($, window, document, undefined) {
    'use strict';

    function increaseDecreaseHandler() {
        $(".incr-btn").on("click", function (e) {
            var $button = $(this);
            var grandParent = $(this).parent().parent().parent().parent().parent();
            var i;
            var oldValue = $button.parent().find('.quantity').val();
            $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
            if ($button.data('action') == "increase") {
                var newVal = parseFloat(oldValue) + 1;
                handleAddBasket(grandParent);
            } else {
                // Don't allow decrementing below 1
                if (parseFloat(oldValue) > 1) {
                    var newVal = parseFloat(oldValue) - 1;
                    handleRemoveButton(grandParent);
                } else {
                    newVal = 1;
                    //$(".btn-delete").click();
                    //controllEmptyness();
                }
            }
            $button.parent().find('.quantity').val(newVal + " Adet");
            e.preventDefault();
            priceHandler(grandParent, parseFloat(oldValue), newVal);
            handleCount(grandParent.parent());
        });
    }

    function controllEmptyness(type) {
        var str = '<div id="bos-sepet" class="ui fluid container">' +
            '<form class="ui large form" action="odeme/siparis-özeti/index.php">' +
            '<div class="ui stackable centered grid">'+
            '<div class="ui segment center aligned eight wide column ">'+
            '<img src="/assets/images/shopping-basket.png"></img>'+
            '<h1 class="h1">Sepetin şu an boş.</h1>'+
            '<div class="ui divider"></div>'+
            '<span><a href="../buy" class="ui button" id="alisverise-geri-don"><i class="chevron left icon"></i><b>Alisverise Devam Et</b></a></span>'+
            '</div> </div> </form> </div>';

        if (type.localeCompare("delete")==0) {
            var child = $("#sepet-id").find(".ui.grid");
            if (child.length == 2) {
                $("#sepetim-segment").empty();
                $("#sepetim-segment").append(str);
            }
        }   else {
            var child = $("#sepet-id").find(".ui.grid");
            if (child.length == 2) {
                $("#sepetim-segment").empty();
                $("#sepetim-segment").append(str);
            }
        }
    }

    function handleAddBasket(parent) {
        var child = parent.find(".product-name");
        var header = child.find("a").text().trim();
        insertBasket(header);
    }

    function insertBasket(header) {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {name: header, type: "insert"}
        }).done(function (msg) {

        });
    }

    function handleRemoveButton(parent) {
        var child = parent.find(".product-name");
        var header = child.find("a").text().trim();
        deleteBasket(header);
    }

    function deleteBasket(header) {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {name: header, type: "delete"}
        }).done(function (msg) {

        });
    }

    function handleDeleteProductFromBasket() {
        $(".btn-delete").click(function () {
            var parent = $(this).parent().parent().parent();
            var child = parent.find(".product-name");
            var header = child.find("a").text().trim();
            emptyProductFromBasket(header);
            initializeProducts();
        });
    }

    function emptyProductFromBasket(header) {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {name: header, type: "empty"}
        }).done(function (msg) {

        });
    }

    function priceHandler(grandParent, oldValue, newVal) {
        var price = grandParent.find('.col-total-sepetim').get(0).innerText;
        var unitPrice = price / oldValue;
        var newPrice = newVal * unitPrice;
        grandParent.find('span').text(newPrice);
        totalPriceHandler(grandParent.parent());
    }

    function totalPriceHandler(row_parent) {
        var child = row_parent.find('.price-span');
        var totalPrice = 0;
        child.each(function (index) {
            totalPrice = +totalPrice + +$(this).text();
        });
        $("#price").find('span').text(totalPrice);
    }
    
    function handleCount(row_parent) {
        var child = row_parent.find('.quantity');
        var totalCount = 0;
        child.each(function (index) {
            totalCount = +totalCount + +parseFloat($(this).val());
        });
        $("#count-container").find('span').text(totalCount+ " ürün");
    }

    function initializeProducts() {
        $("#product-container").empty();
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {type: "view"}
        }).done(function (msg) {
            var products = msg;
            $("#product-container").empty();
            $("#product-container").append(products);
            controllEmptyness("first");
            increaseDecreaseHandler();
            handleDeleteProductFromBasket();
            var totalPrice = $("#total-price-container").find('span').text();
            $("#price").find('span').text(totalPrice);
            var totalCount = $("#total-count-container").find('span').text();
            $("#count-container").find('span').text(totalCount+ " ürün");
        });
    }

    function initialize() {
        initializeProducts();
        increaseDecreaseHandler();
        handleDeleteProductFromBasket();
        //controllEmptyness("first");
    }


    window.sepetHandler = {
        init: initialize
    };

    //after the DOM is ready call our init function
    $(function () {
        sepetHandler.init();
    });
})(jQuery, window, document);
