$(function () {
    $(document).ready(function () {
        var ContactControl = function () {
            var all = $('.head-office .links a');

            var constructor = function ContactControl() {
            };

            constructor.Change = function (dom) {
                var id = dom.data("id");
                all.removeClass("current");
                dom.addClass("current");
                $(".head-office .area").removeClass("active");
                $(".head-office .area[data-id=" + id + "]").addClass("active");
                $(".section-map .map").removeClass("active");
                $(".section-map .map[data-id=" + id + "]").addClass("active");
            };

            return constructor;
        }();
        $('.head-office .links a').click(function () {
            ContactControl.Change($(this));
            return false;
        });
        var SliderControl = function () {
            var constructor = function SliderControl() {
            };

            var active = 1;
            var all = $(".slider .slide").size();

            constructor.Init = function(){
                $(".slider .slide").width($(window).width());
                $(".slider .area").width($(window).width()*all);
            };

            var move = function (index) {
                var slide = $(".slider .slide[data-id=" + index + "]");
                slide.addClass("active");
                active = index;

                var left = $(".slider .slide").width()*(active-1);
                $('.slider .area').css("left",-left+"px");
            };

            constructor.Arrow = function (dir) {
                if (dir === true) {
                    if (active == all) {
                        move(1);
                    } else {
                        move(active + 1);
                    }
                }
                if (dir !== true) {
                    if (active == 1) {
                        move(all);
                    } else {
                        move(active - 1);
                    }
                }
            };

            return constructor;
        }();
        var time = 5000;
        var timer = setInterval(function () {
            SliderControl.Arrow(true);
        }, time);
        $('.slider #next').click(function () {
            SliderControl.Arrow(true);
            clearInterval(timer);
            timer = setInterval(function () {
                SliderControl.Arrow(true);
            }, time);
        });
        $('.slider #prev').click(function () {
            SliderControl.Arrow(false);
            clearInterval(timer);
            timer = setInterval(function () {
                SliderControl.Arrow(true);
            }, time);
        });
        SliderControl.Init();

        $("#go-down").click(function () {
            $('html, body').animate({
                scrollTop: $("#main-section").offset().top
            }, 500);
            return false;
        });

        var vw = innerWidth;
        var graphCenter = (vw/2)-(127/2);
        $(".graf").css("background-position-x", graphCenter+"px").css("width", 2014+graphCenter*2+"px").find(".item").css("left", graphCenter+"px");

        if (window.orientation == undefined || window.orientation == null) {
            $(window).scroll(function(){
                var offset = $(this).scrollTop();
                var graphStart = $('.graph-scroll').offset().top;
                var scrollNav = $('.scroll');
                var vw = innerWidth;
                var circleWidth = $('.item').width();
                var graphWidth = $('.graf').outerWidth();
                var graphMultiple = graphWidth / ( (vw/2)-(circleWidth/2));

                if (offset > graphStart) {
                    scrollNav.animate({
                        scrollLeft: ( (offset - graphStart) * graphMultiple)
                    }, 10);
                } else if (offset < graphStart) {
                    scrollNav.animate({
                        scrollLeft: 0
                    }, 10);
                }
            });
        }
    });
});