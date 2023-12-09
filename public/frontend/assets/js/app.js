"use strict";

function _defineProperty(obj, key, value) {
    if (key in obj) {
        Object.defineProperty(obj, key, {
            value: value,
            enumerable: true,
            configurable: true,
            writable: true
        });
    } else {
        obj[key] = value;
    }
    return obj;
}

/*
* ----------------------------------------------------------------------------------------
    Template Name:  Paato - Job Portal Bootstrap 5 Template
    Template URI: https://themeforest.net/user/templatecookie/portfolio
    Description: It’s a High-Quality and well organized Job Board HTML Template.
    Author: templatecookie
    Author URI: https://themeforest.net/user/templatecookie/portfolio
    Version: 1.0.0

    1.0 Dropdown Menu
    1.01 Sticky Menu
    1.02 Main Menu
    1.03 Mobile Menu
    1.04 Counter
    1.05 Newestjob
    1.06 Testomonial
    1.07 Scrollup
    1.08 Select-2
    1.09 Filtering
    1.09 Map
    1.1 Map
    1.1.0 Filter
    1.1.1 Hide Tag
    1.1.2 Advanced Filter
    1.1.3 Custom
    1.1.4 Conditional Filter
    1.1.5 Menu Active
    1.1.6 Card
    1.1.8 Video Popup


* ----------------------------------------------------------------------------------------
*/
(function ($) {
    /* 1.0 Dropdown Menu  */
    $(".menu-item-has-children > a").on("click", function () {
        var element = $(this).parent("li");

        if (element.hasClass("open")) {
            element.removeClass("open");
            element.find("li").removeClass("open");
            element.find("ul").slideUp(500);
            element.find(".rt-mega-menu").slideUp(500);
        } else {
            element.addClass("open");
            element.children("ul").slideDown(500);
            element.children(".rt-mega-menu").slideDown(500);
            element.siblings("li").children("ul").slideUp();
            element.siblings("li").removeClass("open");
            element.siblings("li").find("li").removeClass("open");
            element.siblings("li").find("ul").slideUp();
        }
    });
    $(".has-children > .jobwidget_tiitle").on("click", function () {
        var element = $(this).parent("li");

        if (element.hasClass("open")) {
            element.removeClass("open");
            element.find("li").removeClass("open");
            element.find("ul").slideUp(200);
        } else {
            element.addClass("open");
            element.children("ul").slideDown(200);
            element.siblings("li").children("ul").slideUp();
            element.siblings("li").removeClass("open");
            element.siblings("li").find("li").removeClass("open");
            element.siblings("li").find("ul").slideUp();
        }
    });
    /* 1.01 Sticky Menu  */

    function stickyHeader() {
        var mainheader = $(".rt-sticky"),
            height = mainheader.outerHeight(),
            scroll = $(document).scrollTop();
        $(window).on("load", function () {
            if ($(document).scrollTop() > height) {
                if (mainheader.hasClass("rt-sticky-active")) {
                    mainheader.removeClass("rt-sticky-active");
                } else {
                    mainheader.addClass("rt-sticky-active");
                }
            }
        });
        $(window).on("scroll", function () {
            var scrolled = $(document).scrollTop(),
                header = $(".rt-sticky-active");

            if (scrolled > scroll) {
                header.addClass("sticky");
            } else {
                header.removeClass("sticky");
            }

            if (scrolled === 0) {
                mainheader.removeClass("rt-sticky-active");
            } else {
                mainheader.addClass("rt-sticky-active");
            }

            scroll = $(document).scrollTop();
        });
    }

    if ($(window).width() > 991.98) {
        stickyHeader();
    } // menu menu active link

    /* 1.02 Main Menu  */


    $(".main-menu ul li").on("click", function () {
        $(".main-menu ul li").removeClass("active");
        $(this).addClass("active");
    }); // mobile menu click

    /* 1.03 Mobile Menu */

    $(".menu-click").on("click", function () {
        $(".main-menu").toggleClass("active-mobile-menu");
        $(".rt-mobile-menu-overlay").toggleClass("active");
        return false;
    });
    $(".rt-mobile-menu-close, .rt-mobile-menu-overlay").on("click", function () {
        $(".main-menu").removeClass("active-mobile-menu");
        $(".rt-mobile-menu-overlay").removeClass("active");
        return false;
    }); // counter active

    /* 1.04 Counter */

    $(".counter").counterUp({
        delay: 10,
        time: 1000
    });

    /* 1.07 Scrollup */


    $.scrollUp({
        scrollText: '<i class="ph-caret-up-light"></i>'
    }); // select 2 active

    /* 1.08 Select-2 */

    $(".rt-selectactive").select2();
    $(".select2-taggable").select2({
        tags: true,
    });

    /* 1.1 Map */

    var Map1 = document.getElementById("mapid");

    if (Map1) {
        var mymap = L.map("mapid").setView([51.505, -0.09], 13);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: "mapbox/streets-v11",
            accessToken: "your.mapbox.access.token"
        }).addTo(mymap);
    }
    /* 1.1.0 Filter Sidebar */


    $(".toggle-filter-sidebar").on("click", function () {
        $(".sidebar-widget-overlay, .jobsidebar").toggleClass("active");
    });
    $(".sidebar-widget-overlay, .close-me").on("click", function () {
        $(".sidebar-widget-overlay, .jobsidebar").removeClass("active");
    });
    /* 1.1.1 Hide Tag */

    $(".close-tag").on("click", function () {
        $(this).parent(".single-tag").hide();
    }); // advanced fillter

    /* 1.1.2 Advanced Filter */

    $(".open-adf").on("click", function () {
        $(".jobsearchBox").toggleClass("active-adf");
        $(".job-filter-overlay").toggleClass("active");
        $(".advance-hidden-filter-menu").slideToggle(300);
        $("body").toggleClass("body-no-scrolling");
    });
    $(".job-filter-overlay").on("click", function () {
        $(".jobsearchBox").removeClass("active-adf");
        $(".job-filter-overlay").removeClass("active");
        $(".advance-hidden-filter-menu").slideUp(300);
        $("body").removeClass("body-no-scrolling");
    }); // custom scroll

    /* 1.1.3 Custom Scroll */

    $(".custom-scroll").overlayScrollbars({ //className: "os-theme-thick-dark",
    }); //conditional filter

    /* 1.1.4 Conditional Filter */

    var getToggleClass = document.getElementById("togglclass1");
    var toggleSidebar = document.getElementById("toggoleSidebar");
    var productCloumnClass = document.getElementsByClassName("condition_class");
    $(".toggole-colum-classes").on("click", function () {
        $(toggleSidebar).toggleClass("d-none");

        if (!toggleSidebar.classList.contains("d-none")) {
            getToggleClass.classList.add("col-lg-8");
            getToggleClass.classList.remove("col-xl-12");
        } else {
            getToggleClass.classList.add("col-xl-12");
            getToggleClass.classList.remove("col-lg-8");
        }

        if (getToggleClass.classList.contains("col-lg-8")) {
            $(productCloumnClass).removeClass("col-xl-4");
        } else {
            $(productCloumnClass).addClass("col-xl-4");
        }
    }); // menu active classes

    /* 1.1.5 Menu Active */

    $(".menu-active-classes li").on("click", function () {
        $(".menu-active-classes li").removeClass("active");
        $(this).addClass("active");
    });
    $(function () {
        $('.menu-active-classes li a[href^="/' + location.pathname.split("/")[1] + '"]').addClass("active");
    });

    /* 1.1.7 Chart */

    var options = {
        chart: {
            height: 340,
            type: "area",
            toolbar: {
                autoSelected: "pan",
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: "smooth",
            width: 2
        },
        series: [{
            name: "Series 1",
            data: [50, 75, 60, 80, 55, 70, 60]
        }],
        colors: ["#0066FF"],
        fill: {
            type: "gradient",
            colors: "#0066FF",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.1,
                opacityTo: 0.9,
                stops: [0, 100, 0]
            }
        },
        markers: {
            size: 5,
            colors: ["#fff"],
            strokeColor: "#0066FF",
            strokeWidth: 2
        },
        tooltip: {
            theme: "dark",
            x: {
                show: false
            },
            shared: false,
            style: {
                fontSize: '16px',
                fontFamily: "Inter"
            },
            marker: {
                show: false
            },
            custom: function custom(_ref) {
                var series = _ref.series,
                    seriesIndex = _ref.seriesIndex,
                    dataPointIndex = _ref.dataPointIndex,
                    w = _ref.w;
                return '<div class="arrow_box">' + '<span>' + series[seriesIndex][dataPointIndex] + '</span>' + '<span class="d-block">' + w.globals.labels[dataPointIndex] + ': ' + '</div>';
            }
        },
        xaxis: {
            borderColor: "red",
            categories: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
        }
    };

    if (document.getElementById("area-spaline")) {
        var chart = new ApexCharts(document.querySelector("#area-spaline"), options);
        chart.render();
    }

    $(window).Scrollax(); // video popup

    $(".togglepass").on("click", function () {
        var x = document.getElementById("myInput");

        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }); // toggle password

    $(".togglepass2").on("click", function () {
        var y = document.getElementById("myInput2");

        if (y.type === "password") {
            y.type = "text";
        } else {
            y.type = "password";
        }
    }); //sidbear toggle

    $(".sidebar-open-nav").on("click", function () {
        $(".d-sidebar, .d-page-content ").toggleClass("acitve");
    }); // pricing toggle

    $("#flexSwitchCheckDefault").on("change", function () {
        $("body").toggleClass("price-toggole");
    }); // notifications

    var $notification = $('.notification-icon');
    $(document).mouseup(function (e) {
        if (!$notification.is(e.target) && // if the target of the click isn't the container...
            $notification.has(e.target).length === 0) {
            // ... nor a descendant of the container
            $notification.removeClass('notification-visiable');
        }
    });
    $('.notification-icon').on('click', function (event) {
        event.preventDefault();
        $notification.toggleClass('notification-visiable');
    }); //end notification
    // switch profile

    var $profileSwitch = $('.switch-profile');
    $(document).mouseup(function (e) {
        if (!$profileSwitch.is(e.target) && // if the target of the click isn't the container...
            $profileSwitch.has(e.target).length === 0) {
            // ... nor a descendant of the container
            $profileSwitch.removeClass('profile-visiable');
        }
    });
    $('.switch-profile').on('click', function (event) {
        event.preventDefault();
        $profileSwitch.toggleClass('profile-visiable');
    }); // 6. input type changer

    function showPassword(input, icon) {
        icon.addEventListener('click', function (e) {
            // todo 1:  toggle eye show / hide
            icon.classList.toggle('ph-eye-slash'); // todo 2: input type

            input.type === 'password' ? input.type = 'text' : input.type = 'password';
        });
    }

    var input = document.querySelector("#password-hide_show");
    var inputIcon = document.querySelector(".has-badge i");
    var finputOne = document.querySelector("#password-hide_show1");
    var ficonOne = document.querySelector(".select-icon__one i"); // login & registration page

    if (input || inputIcon) {
        showPassword(input, inputIcon);
    }

    if (finputOne || ficonOne) {
        showPassword(finputOne, ficonOne);
    }

    // dataicker
    $("#datepicker").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast"
    });


})(jQuery);


//  Range Slider
var sliderRange = document.querySelector(".sliderrange");
var output = document.querySelector("#value-range");

if (output) {
    output.innerHTML = "".concat(sliderRange.value, " miles");
}

if (sliderRange) {
    sliderRange.oninput = function () {
        output.innerHTML = "".concat(this.value, " miles");
    };

    sliderRange.addEventListener("mousemove", function () {
        var x = sliderRange.value;
        var color = "linear-gradient(\n        90deg,\n        #0066FF ".concat(x, "%,\n        rgb(218, 221, 229) ").concat(x, "%\n      )");
        sliderRange.style.background = color;
    });
}

var current_fs, next_fs, previous_fs; //fieldsets

var opacity;
var current = 1;
var steps = $("fieldset").length;
// setProgressBar(current);
$(".next").on('click', function () {
    current_fs = $(this).parent();
    next_fs = $(this).parent().next(); //Add Class Active

    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active"); //show the next fieldset

    next_fs.show(); //hide the current fieldset with style

    current_fs.animate({
        opacity: 0
    }, {
        step: function step(now) {
            // for making fielset appear animation
            opacity = 1 - now;
            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            next_fs.css({
                'opacity': opacity
            });
        },
        duration: 500
    });
    // setProgressBar(++current);
});


$(".previous").on('click', function () {
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev(); //Remove class active

    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active"); //show the previous fieldset

    previous_fs.show(); //hide the current fieldset with style

    current_fs.animate({
        opacity: 0
    }, {
        step: function step(now) {
            // for making fielset appear animation
            opacity = 1 - now;
            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            previous_fs.css({
                'opacity': opacity
            });
        },
        duration: 500
    });
    // setProgressBar(--current);
});


var hideMenuBtn = document.querySelector('.hide-menu-btn');
var hideMenu = document.getElementById('progressbar');

if (hideMenuBtn) {
    hideMenuBtn.addEventListener('click', function () {
        hideMenu.classList.add('hide-menu');
    });
}


