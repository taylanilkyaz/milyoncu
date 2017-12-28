(function( $, window, document, undefined ) {
    'use strict';

    var currentPage;
    var ticketContent = $('#ticket-content');

    function openTicketButtonHandler() {
        $('#open-ticket').click(function () {
            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: { type:"open-ticket"}
            }).
            done(function( msg) {
                ticketContent.empty();
                ticketContent.append(msg);
                initTicketDetailHandler();
                currentPage = "open-ticket";
            });
        });
    }

    function closeTicketButtonHandler() {

        $('#close-ticket').click(function () {
            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: { type:"closed-ticket"}
            }).
            done(function( msg) {
                ticketContent.empty();
                ticketContent.append(msg);
                initTicketDetailHandler();
                currentPage = "closed-ticket";
            });

        });

    }

    function initTicketDetailHandler() {
        $('.ticket-summary').click(function () {
            var ticketId = $(this).find("[data-id]").data("id");
            $.ajax({
                method: "POST",
                url: "getTicketDetail.php",
                data: { ticketId: ticketId, type:currentPage},
                success: function(msg){
                    $("#detail-container").empty();
                    $("#detail-container").append(msg);
                }
            });
        });
    }

    function printTicketDetailById(ticketId, submitType){
        $.ajax({
            method: "POST",
            url: "getTicketDetail.php",
            data: { ticketId: ticketId , type: submitType},
            success: function(msg){
                var detailContainer = $("#detail-container");
                detailContainer.empty();
                detailContainer.append(msg);
                currentPage = submitType;
            }
        });
    }

    function submitTicketButtonHandler() {

        $('#submit-ticket').click(function () {
            $.ajax({
                method: "POST",
                url: "ajax.php",
                data: { type:"submit-ticket"}
            }).
            done(function( msg) {
                ticketContent.empty();
                ticketContent.append(msg);
                initTicketDetailHandler();
                currentPage = "submit-ticket";
                initSubmitTicketSendButton();
            });
        });
    }

    function initSubmitTicketSendButton() {
        $('#sendTicket').click(function () {
            console.log("hi baby");
        });
    }


    function initialize() {
        initTicketDetailHandler();
        submitTicketButtonHandler();
        closeTicketButtonHandler();
        openTicketButtonHandler();
    }

    window.ticketHandler = {
        init : initialize,
        printTicketDetailById : printTicketDetailById,
        initTicketDetailHandler : initTicketDetailHandler

    };


    //after the DOM is ready call our init function
    $(function(){
        ticketHandler.init();
    });
})( jQuery, window, document );
