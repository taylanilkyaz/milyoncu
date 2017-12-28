(function ($, window, document, undefined) {
    'use strict';


    function attachDropdown() {
        $('.ui.dropdown')
            .dropdown();
    }

    function buttonHandler() {
        $("#login-submit").click(function () {
            $("#activation-modal").modal('show');
        });
    }

    /**
     * register form auto control
     */
    function inputControlHandler() {
        $('.ui.form')
            .form({
                fields: {
                    email: {
                        identifier: 'email',
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

                    password: {
                        identifier: 'password',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Parola alanı boş bırakılamaz.'
                            },
                            {
                                type: 'minLength[6]',
                                prompt: 'Parola uzunluğu 6 ile 20 karakter arasında olmalıdır.'
                            },
                            {
                                type: 'maxLength[99]',
                                prompt: 'Parola uzunluğu 6 ile 20 karakter arasında olmalıdır.'
                            }
                        ]
                    },

                    name: {
                        identifier: 'first_name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'İsim alanı boş bırakılamaz.'
                            },
                            {
                                type: 'minLength[2]',
                                prompt: 'İsim uzunluğu 2 ile 20 karakteri geçemez.'
                            },
                            {
                                type: 'maxLength[99]',
                                prompt: 'İsim uzunluğu 2 ile 20 karakteri geçemez.'
                            },
                            {
                                type: 'regExp[/^[a-zA-ZğüşöçİĞÜŞÖÇı ]+$/]',
                                prompt: 'İsim alanı sadece harflerden oluşmalıdır.'
                            }
                        ]
                    },

                    last_name: {
                        identifier: 'last_name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Soyisim alanı boş bırakılamaz.'
                            },
                            {
                                type: 'minLength[2]',
                                prompt: 'Soyisim uzunluğu 2 ile 20 karakteri geçemez.'
                            },
                            {
                                type: 'maxLength[99]',
                                prompt: 'Soyisim uzunluğu 2 ile 20 karakteri geçemez.'
                            },
                            {
                                type: 'regExp[/^[a-zA-ZğüşöçİĞÜŞÖÇı ]+$/]',
                                prompt: 'Soyisim alanı sadece harflerden oluşmalıdır.'
                            }
                        ]
                    },

                    mother_name: {
                        identifier: 'mother_name',
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
                        identifier: 'father_name',
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
                        identifier: 'tel_number',
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
                        identifier: 'mother_maiden',
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
                }
            })
        ;
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


    function initialize() {
        attachDropdown();
        createTcRule();
        createValidationRule();
        inputControlHandler();
        buttonHandler();
    }

    window.orderHandler = {
        init: initialize
    };


    //after the DOM is ready call our init function
    $(function () {
        orderHandler.init();
    });
})(jQuery, window, document);