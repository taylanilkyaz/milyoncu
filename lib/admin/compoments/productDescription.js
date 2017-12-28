/**
 * Created by sefa on 28.7.2017.
 */
(function( $, window, document, undefined ) {
    'use strict';

    function increaseDecreaseHandler() {
        $(".incr-btn").on("click", function (e) {
            var $button = $(this);
            var grandParent = $button;
            for (i = 0; i < 4; i++) {
                grandParent = grandParent.parent();
            }
            var i;
            var oldValue = $button.parent().find('.quantity').val();
            $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
            if ($button.data('action') == "increase") {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below 1
                if (parseFloat(oldValue) > 1) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 1;
                    $button.addClass('inactive');
                }
            }
            $button.parent().find('.quantity').val(newVal + " adet");
            e.preventDefault();
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

    function handleAddBasket() {
        $("#add-basket-button").click(function () {
            var product_name = ($("#product-name-field")).text().trim();
            var unit = parseFloat($(".quantity").val());
            var i;
            for (i=0 ; i<unit ; i++){
                insertBasket(product_name);
                insertBasketInfo(product_name);
            }

        });
    }

    function insertBasket(header) {
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {name: header, type: "insert"}
        }).done(function (msg) {

        });
    }


    function productDescriptionZoomHandler(){
        $('#zoom_01').elevateZoom({
            zoomType: "inner",
            cursor: "crosshair",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750
        });
    }
    function tabHandler(){
        $('#tab-id .item')
            .tab()
        ;
    }

    function addDynamicComments(){
        var product_name = ($("#product-name-field")).text().trim();
        $("#comment-tbody").empty();
        $.ajax({
            method: "GET",
            url: "ajax-get-comments.php",
            datatype: String,
            data: {product_name:product_name},
            success: function (data) {
                finishProcess(data);
                //yorumların starları
                $(".content .ui.tiny.star.rating").rating(
                    'disable'
                );
                dynamicRateHandler();
                commentCountHandler();
                deleteCommentHandler();
                $("#comment-rate").rating('set rating',0);
                $("#content-id").val('');
                $("#description-title-id").val('');
            }
        });
    }

    function finishProcess(data) {
        $("#comment-tbody").append(data);
        $("#comment-table").DataTable();
    }

    function updateCommentDatabase(title,content,bool,rating) {
        var product_id = parseFloat($("#product-id-field").text());
        $.ajax({
            method: "GET",
            url: "ajax-insert-comment.php",
            datatype: String,
            data: {title:title,content:content,bool:bool,product_id:product_id,rating:rating},
            success: function (data) {
                addDynamicComments();
            }
        });
    }

    function submitCommentHandler() {
        $("#submit-comment").click(function () {
            var rating = $("#comment-rate").rating('get rating');
            var title = $("#description-title-id").val();
            var content = $("#content-id").val();
            if ($("#anonymous-id").is(':checked')) {
                var bool = true;
            } else {
                var bool = false;
            }
            updateCommentDatabase(title,content,bool,rating);
        })
    }

    function rateHandler() {
        //her puan için verilen oy yıldızı
        $("#all-five-star .ui.star.rating").rating(
            'disable'
        );
        //ortalama puanın yıldızı
        $("#averageStar").rating(
            'disable'
        )
        //yorum yapacak insanın seçeceği star
        $("#comment-rate").rating(
            'enable'
        );
        $("#product-rate").rating(
            'disable'
        )

    }

    function progressHandler() {
        $('.ui.progress')
            .progress({
                text: {
                    active  : '%{percent}',
                    success : '%100'
                }
            })
        ;
    }

    function scrollCommentHandler(){
        $("#comment").click(function () {
            $('#tab-id').find('.item').tab('change tab', 'second');
            $("#yorum-yap-button").show();
            $("#form-click-submit").hide();
            scrollHandler();
        });
    }

    function makeCommentHandler() {
        $("#product-comment-button").click(function () {
            $('#tab-id').find('.item').tab('change tab', 'second');
            $("#yorum-yap-button").hide();
            $("#form-click-submit").show();

            $('html,body').animate({
                    scrollTop: $("#form-click-submit").offset().top - 50},
                'slow');
        });

        $("#product-description-button").click(function () {
            $('#tab-id').find('.item').tab('change tab', 'second');
            $("#yorum-yap-button").hide();
            $("#form-click-submit").show();

            $('html,body').animate({
                    scrollTop: $("#form-click-submit").offset().top - 50},
                'slow');
        });

    }

    function scrollHandler() {
        $('html,body').animate({
                scrollTop: $("#tab-id").offset().top},
            'slow');
    }

    function displayHandler() {
        $("#yorum-yap-button").click(function (e) {
            e.preventDefault();
            $(this).hide();
            $("#form-click-submit").show();
        });

        $("#form-cancel-button").click(function (e) {
            e.preventDefault();
            $("#form-click-submit").hide();
            $("#yorum-yap-button").show();
        })
    }

    function dynamicRateHandler() {
        var product_name = ($("#product-name-field")).text().trim();
        $("#rating-bar-container").empty();
        $.ajax({
            method: "GET",
            url: "ajax-get-rating.php",
            datatype: String,
            data: {product_name:product_name},
            success: function (data) {
                $("#rating-bar-container").append(data);
                rateHandler();
                progressHandler();
            }
        });
    }

    function commentCountHandler() {
        var product_name = ($("#product-name-field")).text().trim();
        $.ajax({
            method: "GET",
            url: "ajax-get-comments.php",
            datatype: String,
            data: {product_name:product_name,count:"count"},
            success: function (data) {
                $("#comment").find("span").text(data);
            }
        });
    }

    function pathController() {
        $(".section").click(function () {
            var category = $(this).text();
            if (category == "Köken") {
                window.location.assign("/admin/buy/index.php?value=13");
            }
            else {
                window.location.assign("/detail/index.php?category="+category);

            }
        })
    }

    function deleteComment(commentID) {
        $.ajax({
            method: "GET",
            url: "ajax-delete-comment.php",
            data: {commentID:commentID},
            success: function () {
                location.reload();
            }
        })
    }

    function deleteCommentHandler() {
        $(document).on('click','#delete-comment',function () {
           deleteComment($(this).data('value'))
        });
    }



    function initialize() {
        scrollCommentHandler();
        commentCountHandler();
        displayHandler();
        handleAddBasket();
        increaseDecreaseHandler();
        productDescriptionZoomHandler();
        tabHandler();
        submitCommentHandler();
        addDynamicComments();
        makeCommentHandler();
        pathController();
    }

    window.addProductDescriptionHandler = {
        init : initialize
    };


    //after the DOM is ready call our init function
    $(function(){
        addProductDescriptionHandler.init();
    });
})( jQuery, window, document );
