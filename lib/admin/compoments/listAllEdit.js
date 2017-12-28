(function( $, window, document, undefined ) {
    'use strict';


    function editDbByAdmin(attributes) {
        $.ajax({
            method: "GET",
            url: "ajax-update.php",
            data : {first_name:attributes[0], last_name:attributes[1], e_mail:attributes[2], phone_number:attributes[3], id:attributes[4]},
            success: function () {
                alert("Kişi Güncellendi.");
            }
        });
    }

    function handleEditButton() {
        $('#dbTableForList').on('click', '#editButton',function(){
            var id = $(this).parent().next().next().text();
            $.ajax({
                method: "GET",
                url: "ajax.php",
                data : {id:id}
            }).done(function( msg ) {
                $("#editMenuByAdmin").empty();
                $("#editMenuByAdmin").append(msg);
                $('.fullscreen.modal')
                    .modal('show');
            });
        });
    }

    function handleEditMenuKeyUp() {
        //kaydet butonu görünür olur
        $("#editMenuByAdmin").keyup(function (event) {
            if (event.keyCode!=17 && event.keyCode!=18){
                $('#okButtonForEditByAdmin').show();
            }
        });
    }

    function handleCancelButton() {
        $('#cancelButtonForEditByAdmin').click(function () {
            $('.fullscreen.modal')
                .modal('hide');
        });
    }

    function handleSearchWithValue(option,searchKey) {
        $.ajax({
            method: "GET",
            url: "ajax.php",
            data: {option:option,key:searchKey}
        }).
        done(function( msg ) {
            $("#db-table-for-list-tbody").empty();
            $("#db-table-for-list-tbody").append(msg);
        });
    }

    function handleModal(){
        $("#modal").modal({
            onHide: function () {
                var option=$('.ui.dropdown').dropdown('get value');
                var searchKey = document.getElementById("inputValueForSearch").value;
                handleSearchWithValue(option,searchKey);
            }
        });
    }

    function handleOkButton(){
        /**
         admin değişiklikleri kaydetmek isterse
         */
        $('#okButtonForEditByAdmin').click(function () {
            //değişiklikleri kaydetmemiz gerekir.
            var childs = $("#editMenuByAdmin").find("input");
            var attributes =[];
            $.each(childs, function (index) {

                attributes.push($(this).val());
            });
            editDbByAdmin(attributes);
        });
    }





    function initialize() {

        handleCancelButton();
        handleEditButton();
        handleEditMenuKeyUp();
        handleModal();
        handleOkButton();
    }


    window.listAllEditHandler = {
        init : initialize
    };


    $(function(){
        listAllEditHandler.init();
    });
})( jQuery, window, document );