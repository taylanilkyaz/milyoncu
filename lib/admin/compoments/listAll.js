(function( $, window, document, undefined ) {
    'use strict';

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

    function handleSearchKeyUp() {
        $("#inputValueForSearch").keyup(function (event) {
            if (event.keyCode != 17 && event.keyCode!=18){
                var option=$('.ui.dropdown').dropdown('get value');
                var searchKey = document.getElementById("inputValueForSearch").value;
                if (event.keyCode == 8){
                    if (searchKey.length>=4)
                        handleSearchWithValue(option,searchKey);
                    return;
                }
                if (searchKey.length >= 4){
                    handleSearchWithValue(option,searchKey);
                }
            }
        });
    }

    function handleSearchButtonClick() {
        $( "#buttonForSearch" ).click(function() {
            var option=$('.ui.dropdown').dropdown('get value');
            var searchKey = document.getElementById("inputValueForSearch").value;
            handleSearchWithValue(option,searchKey);
        });
    }
    
    function handleFirstLoad() {
        $.ajax({
            method: "GET",
            url: "ajax.php",
            data: {option:3}
        }).
        done(function( msg ) {
            $("#db-table-for-list-tbody").append(msg);
        });
    }

    function handleDropdown() {
        $('.ui.dropdown').dropdown();
    }



    function initialize() {
        handleFirstLoad();
        handleDropdown();
        handleSearchButtonClick();
        handleSearchKeyUp();

    }


    window.listAllHandler= {
        init : initialize
    };

    //after the DOM is ready call our init function
    $(function(){
        listAllHandler.init();
    });

})( jQuery, window, document );

