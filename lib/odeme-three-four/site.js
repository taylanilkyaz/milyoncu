
$(document).ready(function () {
    $(".dropdown").dropdown();

    var userInformationVar = userInformationControl();

    $("#user-information-button-id").click(function () {
        userInformationControl();
    });

    function userInformationControl() {
        $('.ui.form')
            .form({
                fields: {
                    terms1: {
                        identifier: 'terms-on-bilgilendirme',
                        rules: [
                            {
                                type   : 'checked',
                                prompt : 'Siparişi tamamlamak için Ön Bilgilendirme sözleşmesini kabul etmelisiniz.'
                            }
                        ]
                    },

                    terms2: {
                        identifier: 'terms-satis-sozlesmesi',
                        rules: [
                            {
                                type   : 'checked',
                                prompt : 'Siparişi tamamlamak için Mesafeli Satış sözleşmesini kabul etmelisiniz.'
                            }
                        ]
                    }
                }
            })
        ;
    }

});