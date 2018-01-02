
$(document).ready(function () {
    test();

    function test() {

        var $inlineForm   = $('#top-content .ui.form'),handler;

        var customValidation = {

            email: {
                identifier: 'email',
                rules: [
                    {
                        type   : "empty",
                        prompt : 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type   : "email",
                        prompt : 'Lütfen geçerli bir email giriniz.'
                    }
                ]
            },

            password: {
                identifier: 'password',
                rules: [
                    {
                        type   : "empty",
                        prompt : 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type   : 'maxLength[20]',
                        prompt : 'Şifrenizin uzunluğu 20 karakteri geçmemelidir.'
                    },
                    {
                        type   : 'minLength[6]',
                        prompt : 'Şifreniz en az 6 karakter içermelidir.'
                    }
                ]
            }
        };

        $inlineForm.form(customValidation , {
            inline : true,
            on: 'blur'
        })
        ;
    }

});
