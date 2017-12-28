(function ($, window, document, undefined) {
    'use strict';
    
    /**
     * register form auto control
     */
    function inputControlHandler() {
        $('.ui.form')
            .form({
                firstName: {
                    identifier: 'first-name',
                    rules: [
                        {
                            type: "empty",
                            prompt: 'Bu alanın doldurulması zorunludur.'
                        },
                        {
                            type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                            prompt: 'Lütfen geçerli bir isim giriniz.'
                        },
                        {
                            type: 'minLength[2]',
                            prompt: 'İsim uzunluğu 2 ile 51 karakteri arasında olmalıdır.'
                        }
                    ]
                },
                lastName: {
                    identifier: 'last-name',
                    rules: [
                        {
                            type: "empty",
                            prompt: 'Bu alanın doldurulması zorunludur.'
                        },
                        {
                            type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                            prompt: 'Lütfen geçerli bir soyisim giriniz.'
                        },
                        {
                            type: 'minLength[2]',
                            prompt: 'Soyisim uzunluğu 2 ile 51 karakteri arasında olmalıdır.'
                        }
                    ]
                },
                email: {
                    identifier: 'e-mail',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'E-Mail alanı boş bırakılamaz.'
                        },
                        {
                            type: 'maxLength[99]',
                            prompt: 'E-Mail uzunluğu 99 karakteri geçemez.'
                        },
                        {
                            type: 'email',
                            prompt: 'Geçerli bir e-mail hesabı girmelisiniz.'
                        }
                    ]
                },
                mother_name: {
                    identifier: 'mother-first',
                    rules: [
                        {
                            type: 'maxLength[99]',
                            prompt: 'Anne ismi uzunluğu 2 ile 20 karakteri geçemez.'
                        },

                        {
                            type: 'regExp[/^[a-zA-ZğüşöçİĞÜŞÖÇı ]*$/]',
                            prompt: 'Anne ismi alanı sadece harflerden oluşmalıdır.'
                        }
                    ]
                },
                father_name: {
                    identifier: 'father-first',
                    rules: [
                        {
                            type: 'maxLength[99]',
                            prompt: 'Baba ismi uzunluğu 2 ile 20 karakteri geçemez.'
                        },

                        {
                            type: 'regExp[/^[a-zA-ZğüşöçİĞÜŞÖÇı ]*$/]',
                            prompt: 'Baba ismi alanı sadece harflerden oluşmalıdır.'
                        }
                    ]
                },
                tel_number: {
                    identifier: 'phone-number',
                    rules: [
                        {
                            type: 'regExp[/^[0-9]*$/]',
                            prompt: 'Telefon numarası alanı sadece rakamlardan oluşmalıdır.'
                        },
                        {
                            type: 'phoneNumberRule',
                            prompt: 'Telefon numarası uzunluğu 11 karakter olmalı.'
                        }
                    ]
                },
                mother_maiden: {
                    identifier: 'mother-maiden',
                    rules: [
                        {
                            type: 'maxLength[99]',
                            prompt: 'Anne kızlık soyadı uzunluğu 2 ile 20 karakteri geçemez.'
                        },
                        {
                            type: 'regExp[/^[a-zA-ZğüşöçİĞÜŞÖÇı ]*$/]',
                            prompt: 'Anne kızlık soyadı alanı sadece harflerden oluşmalıdır.'
                        }
                    ]
                },
                tc: {
                    identifier: 'tc-no',
                    rules: [
                        {
                            type: 'regExp[/^[0-9]*$/]',
                            prompt: 'Telefon numarası alanı sadece rakamlardan oluşmalıdır.'
                        },
                        {
                            type: 'tcRule',
                            prompt: 'Telefon numarası uzunluğu 11 karakter olmalı.'
                        }
                    ]
                }
            });
    }

    function createValidationRule() {
        $.fn.form.settings.rules.phoneNumberRule = function (param) {
            // Your validation condition goes here
            if (param.length == 0) {
                return true;
            } else {
                return param.length == 11;
            }
        }
    }

    function createTcRule() {
        $.fn.form.settings.rules.tcRule = function (param) {
            // Your validation condition goes here
            if (param.length == 0) {
                return true;
            } else {
                return param.length == 11;
            }
        }
    }


    function initialize() {
        createTcRule();
        createValidationRule();
        inputControlHandler();
        //handleOkButton();
    }


    window.editUserHandler = {
        init: initialize
    };

    //after the DOM is ready call our init function
    $(function () {
        editUserHandler.init();
    });
})(jQuery, window, document);