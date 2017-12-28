(function ($, window, document, undefined) {
    'use strict';

    /**
     * Orjinal değerler.
     */
    var orgValVintage1;
    var orgValVintage2;
    var orgValVintage3;
    var orgValVintage4;
    var orgValVintage5;

    /**
     * Resim containerları
     */
    var vintage1;
    var vintage2;
    var vintage3;
    var vintage4;
    var vintage5;
    var windowObj;
    var vintageContainer;


    function initVintages() {
        vintage1 = $("#vintage-1");
        vintage2 = $("#vintage-2");
        vintage3 = $("#vintage-3");
        vintage4 = $("#vintage-4");
        vintage5 = $("#vintage-5");
        windowObj = $(window);
        vintageContainer = $("#sixth-content");
    }

    function changeVal(vintageObj, val) {
        var orgVal = parseInt(getOrginalVintageByObj(vintageObj));
        var leftStr = parseInt(orgVal + val) + "px";
        vintageObj.css({left: leftStr});
    }

    function setOrginalVal() {
        orgValVintage1 = parseInt(vintage1.css("left"));
        orgValVintage2 = parseInt(vintage2.css("left"));
        orgValVintage3 = parseInt(vintage3.css("left"));
        orgValVintage4 = parseInt(vintage4.css("left"));
        orgValVintage5 = parseInt(vintage4.css("left"));
    }

    function resetVitanges() {
        vintage1.css({left: orgValVintage1});
        vintage2.css({left: orgValVintage2});
        vintage3.css({left: orgValVintage3});
        vintage4.css({left: orgValVintage4});
        vintage5.css({left: orgValVintage5})
    }

    function getOrginalVintageByObj(obj) {
        switch (obj) {
            case vintage1:
                return orgValVintage1;
            case vintage2:
                return orgValVintage2;
            case vintage3:
                return orgValVintage3;
            case vintage4:
                return orgValVintage4;
            case vintage5:
                return orgValVintage5;
        }
    }

    function accordionInit() {
        $(".ui.accordion").accordion();
    }

    function slickInit() {
        $(".regular").slick({
            dots: true,
            infinite: true,
            centerMode: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 700,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
        });
    }

    function resizeHandler() {
        windowObj.resize(function () {
            var width = windowObj.width();
            console.log(width);

            orgValVintage1 = width * 26 / 100;
            orgValVintage2 = width * 33 / 100;
            orgValVintage3 = width * 41 / 100;
            orgValVintage4 = width * 46 / 100;
            orgValVintage5 = width * 57 / 100;
            resetVitanges();

            console.log(width);
            if (width < 600) {
                vintage1.css({width: "100px", height: "auto"});
                vintage2.css({width: "100px", height: "auto"});
                vintage3.css({width: "100px", height: "auto"});
                vintage4.css({width: "100px", height: "auto"});
                vintage5.css({width: "100px", height: "auto"});
            }
        });
    }

    function handleTestProgress() {
        $("#test-sureci").click(function () {

            $('html,body').animate({
                    scrollTop: $("#bilgi-seventh").offset().top-50
                },
                'slow');

        })
    }

    function handleDetailButton() {
        $("#detail-button").click(function () {

            $('html,body').animate({
                    scrollTop: $("#slick-content").offset().top-100
                },
                'slow');

        })
    }


    function initialize() {
        handleDetailButton();
        handleTestProgress();
        initVintages();
        resizeHandler();
        setOrginalVal();
        scrollListener();
        accordionInit();
        popupInit();
        slickInit();
    }

    function popupInit() {
        $("#sha-512-info").popup();
    }

    function scrollListener() {
        windowObj.scroll(function () {
            var myTop = vintageContainer.offset().top;  // the top (y) location of your element

            var windowTop = windowObj.scrollTop();           // the top of the window
            var windowBottom = windowTop + windowObj.height();
            var vintageContainerHeight = vintageContainer.outerHeight();
            var myBottom = myTop + vintageContainerHeight;

            var whereis = windowTop - myTop + 1200;
            if (windowBottom - vintageContainerHeight / 4 > myTop && windowTop < myBottom) {
                whereis = whereis * 1 / 6;
                changeVal(vintage1, -1 * (whereis + whereis * 30 / 100));
                changeVal(vintage2, -1 * (whereis + whereis * 5 / 100));
                //changeVal(vintage3,0);
                changeVal(vintage4, whereis / 2 + whereis * 15 / 100);
                changeVal(vintage5, whereis + whereis * 15 / 100);
            } else {
                resetVitanges();
            }

        });

    }

    window.homeHandler = {
        init: initialize
    };


    //after the DOM is ready call our init function
    $(function () {
        homeHandler.init();
    });

})(jQuery, window, document);
