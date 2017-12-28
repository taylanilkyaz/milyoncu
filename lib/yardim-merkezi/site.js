(function( $, window, document, undefined ) {
    'use strict';

    function handleDropdown() {
        $(".dropdown").dropdown();
    }


    function handleFormValidation() {
        $('.ui.form')
            .form({
                fields: {
                    skills: {
                        identifier: 'skills',
                        rules: [
                            {
                                type   : 'minCount[1]',
                            }
                        ]
                    },

                    email: {
                        identifier  : 'email',
                        rules: [
                            {
                                type   : 'email',
                            }
                        ]
                    },

                    İsimVeSoyisim: {
                        identifier: 'İsimVeSoyisim',
                        rules: [
                            {
                                type   : 'empty',
                            }
                        ]
                    },

                    mesaj: {
                        identifier: 'mesaj',
                        rules: [
                            {
                                type   : 'empty',
                            }
                        ]
                    }
                }
            })
        ;
    }

    function handleClickSubmit() {
        $("#submit-contact").click(function () {
            var subject=$('.ui.dropdown').dropdown('get value');
            var email = $("#email").val();
            var name = $("#user_name").val();
            var message = $("#msjtext").text();
            handleSubmitMessage(subject,email,name,message);
        });
    }

    function handleSubmitMessage(subject,email,name,message) {
        $.ajax({
            url:"ajax.php",
            data:{subject:subject,email:email,name:name,message:message}
        }).done(function (msg) {

        })
    }

    function initialize() {
        handleSubmitMessage();
        handleDropdown();
        handleFormValidation();
    }

    window.buyedHandler = {
        init : initialize
    };


    //after the DOM is ready call our init function
    $(function(){
        buyedHandler.init();
    });
})( jQuery, window, document );
