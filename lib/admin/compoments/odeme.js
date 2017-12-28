(function ($, window, document, undefined) {
    'use strict';

    function cardCreator() {
        if ($("#top-content-2").length == 0)
            return;



        new Card({
            form: document.querySelector('#payment-information-form'),
            container: '.card-wrapper'
        });


        new Card({
            // a selector or DOM element for the form where users will
            // be entering their information
            form: document.querySelector('#payment-information-form'),
            // a selector or DOM element for the container
            // where you want the card to appear
            container: '.card-wrapper', // *required*

            formSelectors: {
                numberInput: 'input#number', // optional — default input[name="number"]
                expiryInput: 'input#expiry', // optional — default input[name="expiry"]
                cvcInput: 'input#cvc', // optional — default input[name="cvc"]
                nameInput: 'input#name' // optional - defaults input[name="name"]
            },

            width: 200, // optional — default 350px
            formatting: true, // optional - default true

            // Strings for translation - optional
            messages: {
                validDate: 'valid\ndate', // optional - default 'valid\nthru'
                monthYear: 'mm/yyyy' // optional - default 'month/year'
            },

            // Default placeholders for rendered fields - optional
            placeholders: {
                number: '•••• •••• •••• ••••',
                name: 'Ad Soyad',
                expiry: '••/••',
                cvc: '•••'
            },

            masks: {
                cardNumber: '•' // optional - mask card number
            },

            // if true, will log helpful messages for setting up Card
            debug: false // optional - default false
        });


    }

    function dropdownHandler() {
        $("#country-selector").dropdown();
        $("#country-selector").dropdown("set selected", "tr");
        $("#cargo-dropdown").dropdown();
        $("#cargo-dropdown").dropdown("set selected", "0");
        $("#bill-dropdown").dropdown();
        $("#bill-dropdown").dropdown("set selected", "0");
    }

    function controlButtonHandler() {
        /**
         * Başka türlü semantic ui butonun özelliğini bozuyor.
         */
        $("#payment-information-next-button-id").click(function () {
            var ccNumber = $("#credit-card-number").val();
            var ccSurname = $("#credit-card-name-surname").val();
            var ccDate = $("#last-date").val();
            var ccCode = $("#security-code").val();

            $.ajax({
                method: "POST",
                url: "installment-ajax.php",
                data: {
                    ccNumber: ccNumber,
                    ccSurname: ccSurname,
                    ccDate: ccDate, ccCode: ccCode,
                    type : "normalPay"}
            }).done(function (res) {
                $("#installment-detail").html(res);
                scrollBottom();
                payNowButtonHandler();
                saveCardHandler();
            });

        });
    }

    function keyboardHandler() {
        if (typeof $('#credit-card-number').keyboard !== "function") {
            return;
        }

        $('#inter-type').click(function(){
            var kb = $('#credit-card-number').getkeyboard();
            if ( kb.isOpen ) {
                kb.close();
            } else {
                kb.reveal();
            }
        });


        // target a specific keyboard, or use $('.ui-keyboard-input') to target all
        $('#credit-card-number')
            .keyboard({
                openOn: null,
                keyBinding: 'mousedown touchstart',
                alwaysOpen: false,
                layout: 'custom',
                customLayout: {
                    'normal': ['1 2 3', '4 5 6', '7 8 9', '{a} 0 {c}']
                },
                // Used by jQuery UI position utility
                position: {
                    // null = attach to input/textarea;
                    // use $(sel) to attach elsewhere
                    of: null,
                    my: 'center top',
                    at: 'center top',
                    // used when "usePreview" is false
                    at2: 'center bottom'
                },
                reposition: true,
                lockInput: false,
                appendLocally: true,
                initialized : function () {

                },
                visible : function () {

                },
                beforeClose : function () {

                }
            })
            // For a better idea of what the theme letters represent, try out the mobile
            // demo, or go directly to the jQuery Mobile theming overview page:
            // http://demos.jquerymobile.com/1.4.5/theme-classic/
            .addMobile({
                // keyboard wrapper theme
                container: {theme: 'b', cssClass: 'ui-body'},
                // keyboard duplicate input
                input: {theme: 'b', cssClass: ''},
                // theme added to all regular buttons
                buttonMarkup: {theme: 'b', cssClass: 'ui-btn', shadow: 'true', corners: 'true'},
                // theme added to all buttons when they are being hovered
                buttonHover: {theme: 'b', cssClass: 'ui-btn-hover'},
                // theme added to action buttons (e.g. tab, shift, accept, cancel);
                // parameters here will override the settings in the buttonMarkup
                buttonAction: {theme: 'b', cssClass: 'ui-btn-active'},
                // theme added to button when it is active (e.g. shift is down)
                // All extra parameters will be ignored
                buttonActive: {theme: 'b', cssClass: 'ui-btn-active'},
                // if more than 3 mobile themes are used, add them here
                allThemes: 'a b c'
            });
    }

    function copyPasteBlocker() {
        $(document).ready(function () {
            $('body').bind("cut copy paste", function (e) {
                e.preventDefault();
                insertInfo("Kopyala yapıştıra bu sayfada izin verilmez!")
            });
        });

        function insertInfo(msg) {
            $.uiAlert({
                textHead: 'Uyarı !', // header
                text: msg, // Text
                bgcolor: '#f24320', // background-color
                textcolor: '#fff', // color
                position: 'top-right',// position . top And bottom ||  left / center / right
                icon: 'shopping bag icon', // icon in semantic-UI
                time: 1.3, // time
            });
        }

    }

    function modalInputHandler() {
        // selector cache

        var billForm = $("#addBillForm"), handler;

        // event handlers
        handler = {};

        var customValidation = {

            firstName: {
                identifier: 'billFirstName',
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
                identifier: 'billLastName',
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

            addressName: {
                identifier: 'billingAddressName',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    }
                ]
            },

            billAddressName: {
                identifier: 'billAddressName',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    }
                ]
            },

            city: {
                identifier: 'billCity',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                        prompt: 'Lütfen geçerli bir şehir adı giriniz.'
                    },

                    {
                        type: 'maxLength[17]',
                        prompt: 'Şehir uzunluğu 17 karakteri geçmemelidir.'
                    }
                ]
            },

            state: {
                identifier: 'billState',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                        prompt: 'Lütfen geçerli bir ilçe ismi giriniz.'
                    },

                    {
                        type: 'maxLength[17]',
                        prompt: 'İlçe uzunluğu 17 karakteri geçmemelidir.'
                    }
                ]
            },

            district: {
                identifier: 'billDistrict',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                        prompt: 'Lütfen geçerli bir semt ismi giriniz.'
                    },

                    {
                        type: 'maxLength[20]',
                        prompt: 'Semt uzunluğu 20 karakteri geçmemelidir.'
                    }
                ]
            },

            postCode: {
                identifier: 'billPostCode',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[0-9 ]+$/]",
                        prompt: 'Lütfen geçerli bir posta kodu giriniz.'
                    },

                    {
                        type: 'maxLength[5]',
                        prompt: 'Posta kodu uzunluğu 5 karakteri geçmemelidir.'
                    }
                ]
            },

            phoneNumber: {
                identifier: 'billPhoneNumber',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Bu alanın doldurulması zorunludur. '
                    },
                    {
                        type: "regExp[/^[\+]?[(]?[0-9]{4}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4}$/]",
                        prompt: 'Lütfen 11 haneli geçerli bir telefon numarası giriniz. '
                    }
                ]
            },

            creditCardNumber: {
                identifier: 'number',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Bu alanın doldurulması zorunludur. '
                    }
                ]
            }
        };
        billForm.form(customValidation, {
            inline: true,
            on: 'blur'
        })
        ;
    }

    function cargoModalInputHandler() {
        // selector cache

        var cargoForm = $("#addCargoForm"), handler;

        // event handlers
        handler = {};

        var customValidation = {

            firstName: {
                identifier: 'cargoFirstName',
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
                identifier: 'cargoLastName',
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

            addressName: {
                identifier: 'cargoingAddressName',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    }
                ]
            },

            cargoAddressName: {
                identifier: 'cargoAddressName',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    }
                ]
            },

            city: {
                identifier: 'cargoCity',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                        prompt: 'Lütfen geçerli bir şehir adı giriniz.'
                    },

                    {
                        type: 'maxLength[17]',
                        prompt: 'Şehir uzunluğu 17 karakteri geçmemelidir.'
                    }
                ]
            },

            state: {
                identifier: 'cargoState',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                        prompt: 'Lütfen geçerli bir ilçe ismi giriniz.'
                    },

                    {
                        type: 'maxLength[17]',
                        prompt: 'İlçe uzunluğu 17 karakteri geçmemelidir.'
                    }
                ]
            },

            district: {
                identifier: 'cargoDistrict',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                        prompt: 'Lütfen geçerli bir semt ismi giriniz.'
                    },

                    {
                        type: 'maxLength[20]',
                        prompt: 'Semt uzunluğu 20 karakteri geçmemelidir.'
                    }
                ]
            },

            postCode: {
                identifier: 'cargoPostCode',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[0-9 ]+$/]",
                        prompt: 'Lütfen geçerli bir posta kodu giriniz.'
                    },

                    {
                        type: 'maxLength[5]',
                        prompt: 'Posta kodu uzunluğu 5 karakteri geçmemelidir.'
                    }
                ]
            },

            phoneNumber: {
                identifier: 'cargoPhoneNumber',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Bu alanın doldurulması zorunludur. '
                    },
                    {
                        type: "regExp[/^[\+]?[(]?[0-9]{4}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4}$/]",
                        prompt: 'Lütfen 11 haneli geçerli bir telefon numarası giriniz. '
                    },
                ]
            }
        };
        cargoForm.form(customValidation, {
            inline: true,
            on: 'blur'
        })
        ;
    }

    function checkBoxListener() {
        $('input:checkbox').change(
            function () {
                if ($(this).is(':checked')) {

                } else {
                    $("#billAddModal").modal('show');
                    $("#country-selector-2").dropdown();
                    $("#country-selector-2").dropdown("set selected", "tr");
                    modalInputHandler();
                }
            });
    }

    /**
     * add bill to dropdown
     */
    function addBillButtonHandler() {
        $("#add-new-bill-address").click(function () {
            $("#billAddModal").modal('show');
            $("#country-selector-2").dropdown();
            $("#country-selector-2").dropdown("set selected", "tr");
            modalInputHandler();
        });
    }

    function addBill(attributes, billingAddress,country) {
        $.ajax({
            method: "GET",
            url: "ajax-insert-bill.php",
            datatype: JSON,
            data: {
                billFirstName: attributes[0], billLastName: attributes[1], billCountry: country,
                billCity: attributes[5], billState: attributes[6], billDistrict: attributes[7],
                billAddressName: billingAddress, billPostCode: attributes[8], addressName: attributes[2],
                billPhoneNumber: attributes[9]
            },
            success: function (data) {
                var jsonObject = JSON.parse(data);
                addDynamicBill(jsonObject.address[0]);
                addDynamicCargo(jsonObject.address[1]);
                setEnabledCargo(jsonObject.address[1].id);
                setEnabledBill(jsonObject.address[0].id);
                $("#billAddModal input").val('');
                $("#billAddModal").modal('hide');

            }
        });
    }

    function addDynamicBill(data) {
        var str = "";
        str = '<div class="item" data-value=' + data.id + '>' + data.address_name + '<br>' +
            data.billingAddress + ' ' + data.county + '/' + data.city + '/' + data.country + '<br>' +
            data.firstname + ' ' + data.lastname + ' - ' + data.phoneNumber + '</div>';
        $("#bill-menu").append(str);
        setSelectedAddress(data.id, "bill");
    }

    function billAddressHandler() {
        $('#okButtonForAddBillAddress').click(function () {
            //değişiklikleri kaydetmemiz gerekir.
            var childs = $("#modal-segment-id input");
            var billingAddress = $("#billAddress").val();
            var country = $('#country-selector-2').dropdown('get text');
            var attributes = [];
            $.each(childs, function (index) {
                attributes.push(this.value);
            });
            addBill(attributes, billingAddress,country);
        });
    }

    function setEnabledBill(id) {
        $.ajax({
            method: "GET",
            url: "ajax-set-enabled.php",
            data: {option: "bill", id: id},
            success: function () {

            }
        })
    };

    /**
     * add bill sonu
     */

    /**
     * add cargo to dropdown
     */
    function addCargoButtonHandler() {
        $("#add-new-cargo-address").click(function () {
            $("#cargoAddModal").modal('show');
            $("#country-selector-3").dropdown();
            $("#country-selector-3").dropdown("set selected", "tr");
            cargoModalInputHandler();
        });
    }

    function cargoAddressHandler() {
        $('#okButtonForAddCargoAddress').click(function () {
            //değişiklikleri kaydetmemiz gerekir.
            var childs = $("#cargo-modal-segment-id input");
            var country = $('#country-selector-3').dropdown('get text');
            var cargoAddress = $("#cargoAddress").val();
            var attributes = [];
            $.each(childs, function (index) {
                attributes.push(this.value);
            });
            addCargo(attributes, cargoAddress,country);
        });
    }

    function addCargo(attributes, cargoAddress,country) {
        $.ajax({
            method: "GET",
            url: "ajax-insert-cargo.php",
            datatype: JSON,
            data: {
                cargoFirstName: attributes[0], cargoLastName: attributes[1], cargoCountry: country,
                cargoCity: attributes[5], cargoState: attributes[6], cargoDistrict: attributes[7],
                cargoAddressName: cargoAddress, cargoPostCode: attributes[8], addressName: attributes[2],
                cargoPhoneNumber: attributes[9]
            },
            success: function (data) {
                var jsonObject = JSON.parse(data);
                addDynamicBill(jsonObject.address[0]);
                addDynamicCargo(jsonObject.address[1]);
                setEnabledCargo(jsonObject.address[1].id);
                setEnabledBill(jsonObject.address[0].id);
                $("#cargoAddModal input").val('');
                $("#cargoAddModal").modal('hide');

            }
        });
    }

    function addDynamicCargo(data) {
        var str = "";
        str = '<div class="item" data-value=' + data.id + '>' + data.address_name + '<br>' +
            data.cargoAddress + ' ' + data.county + '/' + data.city + '/' + data.country + '<br>' +
            data.firstname + ' ' + data.lastname + ' - ' + data.phoneNumber + '</div>';
        $("#cargo-menu").append(str);
        setSelectedAddress(data.id, "cargo");
    }

    function setEnabledCargo(id) {
        $.ajax({
            method: "GET",
            url: "ajax-set-enabled.php",
            data: {option: "cargo", id: id},
            success: function () {

            }
        })
    }

    /**
     * add cargo to dropdown sonu
     */

    function inputHandler() {
        // selector cache

        var inlineForm = $("#shipping-information-form"), handler;

        // event handlers
        handler = {};

        var customValidation = {

            firstName: {
                identifier: 'firstName',
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
                identifier: 'lastName',
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

            addressName: {
                identifier: 'addressName',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    }
                ]
            },

            billAddressName: {
                identifier: 'billAddressName',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    }
                ]
            },

            cargoAddressName: {
                identifier: 'cargoAddressName',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    }
                ]
            },

            city: {
                identifier: 'city',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                        prompt: 'Lütfen geçerli bir şehir adı giriniz.'
                    },

                    {
                        type: 'maxLength[17]',
                        prompt: 'Şehir uzunluğu 17 karakteri geçmemelidir.'
                    }
                ]
            },

            state: {
                identifier: 'state',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                        prompt: 'Lütfen geçerli bir ilçe ismi giriniz.'
                    },

                    {
                        type: 'maxLength[17]',
                        prompt: 'İlçe uzunluğu 17 karakteri geçmemelidir.'
                    }
                ]
            },

            district: {
                identifier: 'district',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                        prompt: 'Lütfen geçerli bir semt ismi giriniz.'
                    },

                    {
                        type: 'maxLength[20]',
                        prompt: 'Semt uzunluğu 20 karakteri geçmemelidir.'
                    }
                ]
            },

            postCode: {
                identifier: 'postCode',
                rules: [
                    {
                        type: "empty",
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[0-9 ]+$/]",
                        prompt: 'Lütfen geçerli bir posta kodu giriniz.'
                    },

                    {
                        type: 'maxLength[5]',
                        prompt: 'Posta kodu uzunluğu 5 karakteri geçmemelidir.'
                    }
                ]
            },

            phoneNumber: {
                identifier: 'phoneNumber',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Bu alanın doldurulması zorunludur. '
                    },
                    {
                        type: "regExp[/^[\+]?[(]?[0-9]{4}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4}$/]",
                        prompt: 'Lütfen 11 haneli geçerli bir telefon numarası giriniz. '
                    }
                ]
            },

            creditCardNumber: {
                identifier: 'number',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Bu alanın doldurulması zorunludur. '
                    }
                ]
            },

            creditCardOwner: {
                identifier: 'name',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {
                        type: "regExp[/^[a-zA-ZşŞıİçÇöÖüÜĞğ ]+$/]",
                        prompt: 'Lütfen geçerli bir isim-soyisim giriniz.'
                    }
                ]
            },

            cardValidationValue: {
                identifier: 'cardValidationValue',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    },
                    {

                        type: 'length[3]',
                        prompt: 'Lütfen 3 haneli geçerli güvenlik kodunuzu giriniz.'
                    }
                ]
            },

            expiry: {
                identifier: 'expiry',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    }
                ]
            },

            cvc: {
                identifier: 'cvc',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Bu alanın doldurulması zorunludur.'
                    }
                ]
            }

        };

        inlineForm.form(customValidation, {
            inline: true,
            on: 'blur'
        })
        ;
    }

    function payNowButtonHandler() {
        $("#payment-information-pay-button-id").click(function () {
            var ccNumber = $("#credit-card-number").val();
            var ccSurname = $("#credit-card-name-surname").val();
            var ccDate = $("#last-date").val();
            var ccCode = $("#security-code").val();
            var selectedInstallment = $("#installment-radio-checkbox").val();

            selectedInstallment = parseInt($(".installment-checkbox:checked").next().text());

            setTimeout(function () {
                $.ajax({
                    method: "POST",
                    url: "pay-ajax.php",
                    data: {
                        selectedInstallmentNumber: selectedInstallment,
                        ccNumber: ccNumber,
                        ccSurname: ccSurname,
                        ccDate: ccDate,
                        ccCode: ccCode
                    }
                }).done(function (res) {
                    console.log(res);
                    if (res.indexOf("success") != -1) {
                        //TODO düzeltilmeli
                        window.location.replace("/admin/odeme/siparis-ozeti/index.php");
                    } else {
                        $("#installment-detail").html(res);
                    }
                });
            }, 500);

        });
    }


    function setSelectedAddress(id, which) {
        if (which.localeCompare("bill") == 0) {
            var selectedValue = id.toString();
            $('#bill-dropdown').dropdown('refresh');
            $('#bill-dropdown').dropdown('set selected', selectedValue);
        }
        else if (which.localeCompare("cargo") == 0) {
            var selectedValue = id.toString();
            $('#cargo-dropdown').dropdown('refresh');
            $('#cargo-dropdown').dropdown('set selected', selectedValue);
        }

    }


    function autoSelector(option) {
        $.ajax({
            method: "GET",
            url: "ajax-set-first-selection.php",
            data: {option: option},
            datatype: JSON,
            success: function (data) {
                setSelectedAddress(JSON.parse(data), option);
            }
        });
    }



    function dropdownInit() {
        $('.ui.dropdown')
            .dropdown()
        ;

    }

    function scrollBottom() {
        $('html,body').animate({ scrollTop: 9999 },"slow");
    }


    function installmentWithStoredCardHandler() {
        console.log("paywithstoredcardhandler")
        $("#top-content-2").find(".ui.celled.striped.table").find(".ui.button").click(
            function () {
                var cardId = $(this).attr("data-id");

                setTimeout(function () {
                    $.ajax({
                        method: "POST",
                        url: "installment-ajax.php",
                        data: {
                            cardId : cardId,
                            type : "storedPay"

                        }
                    }).done(function (res) {
                        $("#installment-detail").html(res);
                        payWithStoredCardHandler();
                    });
                }, 500);

            }
        );
    }

    function saveCardHandler() {
        $("#payment-information-save-button-id").click(function () {
            var ccNumber = $("#credit-card-number").val();
            var ccSurname = $("#credit-card-name-surname").val();
            var ccDate = $("#last-date").val();
            var ccCode = $("#security-code").val();
            var selectedInstallment = $("#installment-radio-checkbox").val();

            selectedInstallment = parseInt($(".installment-checkbox:checked").next().text());

            setTimeout(function () {
                $.ajax({
                    method: "POST",
                    url: "save-ajax.php",
                    data: {
                        selectedInstallmentNumber: selectedInstallment,
                        ccNumber: ccNumber,
                        ccSurname: ccSurname,
                        ccDate: ccDate,
                        ccCode: ccCode,
                        type : "store"
                    }
                }).done(function () {
                    $("#store-card-dimmer").dimmer('show');
                    $("#payment-information-save-button-id").hide();
                    setTimeout(function () {
                        $("#store-card-dimmer").dimmer('hide');
                    },15000);
                    /*
                    if (res.indexOf("success") != -1) {
                        //TODO düzeltilmeli
                        window.location.replace("http://localhost/admin/odeme/siparis-ozeti/index.php");
                    } else {
                        $("#installment-detail").html(res);
                    }
                    */
                });
            }, 250);

        });

    }

    function deleteStoredCardHandler() {

        $( "#top-content-2").find("table i" ).click(function() {
            console.log("asda");
            var cardId = $(this).attr("data-id");

            setTimeout(function () {
                $.ajax({
                    method: "POST",
                    url: "delete-card-ajax.php",
                    data: {
                        cardId : cardId
                    }
                }).done(function (res) {
                    location.reload();
                    console.log(res);
                    $("#list-card-detail").html(res);
                    /*
                     if (res.indexOf("success") != -1) {
                     //TODO düzeltilmeli
                     window.location.replace("http://localhost/admin/odeme/siparis-ozeti/index.php");
                     } else {
                     $("#installment-detail").html(res);
                     }
                     */
                });
            }, 50);

        });

    }


    function cancelButtonHandler() {
        $("#cancelButtonForAddBillAddress").click(function () {
            $("#billAddModal").modal('hide');
        });
        $("#cancelButtonForAddCargoAddress").click(function () {
            $("#cargoAddModal").modal('hide');
        });

    }

    function normalPayHandler() {
        $( "#normalPay").click(function() {

        });
    }

    function payWithStoredCardHandler() {
        $("#payment-information-stored-card-button-id").click(function () {
            var cardId = $(this).attr("data-cardId");
            var selectedInstallment = $("#installment-radio-checkbox").val();
            selectedInstallment = parseInt($(".installment-checkbox:checked").next().text());
            setTimeout(function () {
                $.ajax({
                    method: "POST",
                    url: "pay-ajax.php",
                    data: {
                        cardId : cardId,
                        selectedInstallmentNumber : selectedInstallment

                    }
                }).done(function (res) {
                    console.log(res);
                    if (res.indexOf("success") != -1) {
                        //TODO düzeltilmeli
                        window.location.replace("/admin/odeme/siparis-ozeti/index.php");
                    } else {
                        $("#installment-detail").html(res);
                    }
                });
            }, 500);

        });
    }


    function cancelButtonHandler() {
        $("#cancelButtonForAddBillAddress").click(function () {
            $("#billAddModal").modal('hide');
        });
        $("#cancelButtonForAddCargoAddress").click(function () {
            $("#cargoAddModal").modal('hide');
        });

    }

    function initialize() {
        deleteStoredCardHandler();
        installmentWithStoredCardHandler();
        normalPayHandler();
        cardCreator();
        //copyPasteBlocker();
        controlButtonHandler();
        saveCardHandler();
        keyboardHandler();
        dropdownInit();
        inputHandler();
        dropdownHandler();
        checkBoxListener();
        addBillButtonHandler();
        billAddressHandler();
        addCargoButtonHandler();
        cargoAddressHandler();
        autoSelector("bill");
        autoSelector("cargo");
        cancelButtonHandler();

    }

    window.odemeHandler = {
        init: initialize
    };


    //after the DOM is ready call our init function
    $(function () {
        odemeHandler.init();
    });


})(jQuery, window, document);
