(function ($, window, document, undefined) {
    'use strict';

    var idMap = new Map();
    idMap.set("detail-test", "detail-test-info");
    idMap.set("detail-aile-test", "detail-aile-info");
    idMap.set("detail-hayvan-test", "detail-hayvan-info");
    idMap.set("detail-saglik-test", "detail-saglik-info");

    function firstMode() {
        idMap.forEach(function (value, key) {
            /**
             * @var value String
             */
            if (!key.startsWith("detail-test")) {
                $("#" + key).hide();
                $("#" + value).hide();
            } else {
                $("#" + key).show();
                $("#" + value).show();
            }

            console.log(key + ' = ' + value);
        });
    }

    function hideExcept(id) {
        idMap.forEach(function (value, key) {
            /**
             * @var value String
             */
            if (key.startsWith(id)) {
                $("#" + key).show();
                $("#" + value).show();
            } else {
                $("#" + key).hide();
                $("#" + value).hide();
            }

            console.log(key + ' = ' + value);
        });

    }

    function showByAttr(attr) {
        switch (attr) {
            case "aile":
                hideExcept("detail-aile-test");
                break;
            case "hayvan":
                hideExcept("detail-hayvan-test");
                break;
            case "sağlık":
                hideExcept("detail-saglik-test");
                break;
        }
    }

    function segmentClickListener() {
        $("#detail-container .ui.segment").click(function () {
            var attr = $(this).attr("data-click-job");
            showByAttr(attr);
        });
    }

    function redirect() {
        $(".ui.segment").click(function () {
            var value = $(this).attr('data-value');
            if (value != undefined) {
                window.location.assign("/admin/buy/index.php?value=" + value);
            }
        });
    }

    function pathUrlHandler() {
        var path = window.location.href;
        var index = path.indexOf("=");
        var getUrl = path.substr(index + 1);
        if (index != -1) {


            if (getUrl.localeCompare("Aile") == 0) {
                showByAttr("aile");
            } else if (getUrl.localeCompare("Hayvan") == 0) {
                showByAttr("hayvan");
            } else {
                showByAttr("sağlık");
            }
        }
    }

    function initialize() {
        firstMode();
        pathUrlHandler();
        redirect();
        segmentClickListener();
    }

    window.detailHandler = {
        init: initialize,
        firstMode: firstMode,
        hideExcept: hideExcept
    };


    //after the DOM is ready call our init function
    $(function () {
        detailHandler.init();
    });

})(jQuery, window, document);
