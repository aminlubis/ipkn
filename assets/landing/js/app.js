! function($) {
    "use strict";

    var Invoza = function() {};

    Invoza.prototype.initStickyMenu = function() {
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
        
            if (scroll >= 50) {
                $(".sticky").addClass("nav-sticky");
            } else {
                $(".sticky").removeClass("nav-sticky");
            }

            if (scroll >= 700) {
                $('#backToTop').removeClass('backToTop-hidden');
            } else {
                $('#backToTop').addClass('backToTop-hidden');
            }
        });
    },

    Invoza.prototype.initSmoothLink = function() {
        $('.navbar-nav a').on('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 0
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });

        $('#backToTop').on('click', function (e) {
            $('html, body').stop().animate({
                scrollTop: 0
            }, 1500, 'easeInOutExpo');
            e.preventDefault();
        });
    },

    Invoza.prototype.initScrollspy = function() {
        $("#navbarCollapse").scrollspy({
            offset:20
        });
    },

    Invoza.prototype.initTesticarousel = function() {
        $('#testi-carousel').owlCarousel({
            items: 1,
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                576:{
                    items:2
                },
     
            }
        });
    },

    Invoza.prototype.initCounter = function() {
        // Counter Number
        var a = 0;
        $(window).scroll(function() {
            var oTop = $('#counter').offset().top - window.innerHeight;
            if (a == 0 && $(window).scrollTop() > oTop) {
                $('.counter-value').each(function() {
                    var $this = $(this),
                        countTo = $this.attr('data-count');
                    $({
                        countNum: $this.text()
                    }).animate({
                            countNum: countTo
                        },

                        {

                            duration: 2000,
                            easing: 'swing',
                            step: function() {
                                $this.text(Math.floor(this.countNum));
                            },
                            complete: function() {
                                $this.text(this.countNum);
                                //alert('finished');
                            }

                        });
                });
                a = 1;
            }
        });

    },

    Invoza.prototype.initTable = function () {
        $(".fold-table tr.view").on("click", function(){
            $(this).toggleClass("open").next(".fold").toggleClass("open");
        });
    },

    Invoza.prototype.initSelect2 = function () {
        $('.select-type').select2({
            theme: 'bootstrap4',
        });
    },


    feather.replace()

    Invoza.prototype.init = function() {
        this.initStickyMenu();
        this.initSmoothLink();
        this.initScrollspy();
        this.initTable();
        this.initSelect2();
        // this.initTesticarousel();
        // this.initCounter();
    },
    //init
    $.Invoza = new Invoza, $.Invoza.Constructor = Invoza
}(window.jQuery),


//initializing
function($) {
    "use strict";
    $.Invoza.init();
}(window.jQuery);