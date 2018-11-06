(function($) {
    "use strict";
    var animation;
    var width = 0;
    var resizeId;
    var show_float = 0;
    var check_in, check_out = 0;

    $(document).ready(function() {


        $(document).on('click', 'a:not([target="_blank"],[href^="#"],.map_link,[href^="javascript:void(0)"],.thumb-wrap,[rel="nofollow"],._hj-f5b2a1eb-9b07_action_toggle_widget,.ui-datepicker-next,.ui-datepicker-prev,.ui-state-disabled,.sbp_form_wrapper a,.sbp_title a,.hasDatepicker a)', function(event) {
            if (!(event.ctrlKey || event.shiftKey || event.metaKey || event.which == 2)) {
                $('body').fadeOut('450');
            }
        });

        setTimeout(function() {
            if ($('.gmap-wrapper #map').length > 0) {
                $('.gmap-wrapper #map').attr('id', 'sbp_map');
            }
        }, 1500);


        if ($('ul.accommodation_categories_list li  a input[data-slug="featured"]').length > 0) {
            $('ul.accommodation_categories_list li  a input[data-slug="featured"]').closest('li').hide();
        }
        if ($('.dom_single_title_container').length > 0) {
            $('.dom_single_title_container h1').appendTo('.hero-section-inner');
        }

        if (($('#carousel0 .filter_item[data-name="filter_156"]').length > 0) && ($('#carousel0 .filter_item[data-name="all"]').length > 0)) {
            $('#carousel0 .filter_item[data-name="all"]').hide();
            $('#carousel0 .filter_item[data-name="filter_156"] a').text('All');
            $('#carousel0 .filter_item[data-name="filter_156"] a').trigger("click");
        }

        /*Code for general contact form country select box*/
        if ($('#sbp_cf7_country').length > 0) {
            $("#sbp_cf7_country").intlTelInput();
            /*function to get json data from ip*/
            $.getJSON('https://ipinfo.io', function(data) {
                $("#sbp_cf7_country").intlTelInput("setCountry", data.country.toLowerCase());
                $('#sbp_cf7_country').val(data.country.toLowerCase());

                var current_country = $('.selected-flag').attr('title').split(':')[0];
                $('#country_style input').val(current_country);
            });
            $('.country').on('click', function() {
                var selected_title = $(this).find('.country-name').text();
                $('#country_style input').val(selected_title);
                //$('#sbp_cf7_country').val(selected_title);
                $('#country_style ul').append('<li class="active selected"><span>' + selected_title + '</span></div>');
            });
        }

        if ($('body.archive').length > 0) {
            
            if  ($('body.transparent-sticky').length == 0) {
                $('body').addClass('transparent-sticky');
            }
            if ($('body.header-transparent').length == 0) {
                $('body').addClass('header-transparent');
            }
            
            if ($('body.sticky-header').length > 0) {
                $('body').removeClass('sticky-header');
            }
            
        }

        /*Contact form optgroup code*/
        if ($('select#cf7opt').length > 0) {
            if ($('.opt_hidden').length > 0) {
                $('.opt_hidden').contents().appendTo('select#cf7opt');
                $('select#cf7opt').material_select();
            }
        }
        if ($('select#cf7opt2').length > 0) {
            if ($('.opt_hidden2').length > 0) {
                $('.opt_hidden2').contents().appendTo('select#cf7opt2');
                $('select#cf7opt2').material_select();
            }
        }
        if ($('select#cf7opt3').length > 0) {
            if ($('.opt_hidden3').length > 0) {
                $('.opt_hidden3').contents().appendTo('select#cf7opt3');
                $('select#cf7opt3').material_select();
            }
        }
        /*Code to preload select box choices when from pages*/
        if ($('.from_post').length > 0) {
            var service_id = $('.from_post').first().text();
            if ($('.custom_opt').length > 0) {
                $('.custom_opt').each(function() {
                    if ($(this).has('ul li img.circle.' + service_id).length > 0) {
                        $('.custom_opt ul li img.circle.' + service_id).parent().addClass('active selected');
                        $('.custom_opt li.active.selected span').addClass('activename');
                        var name = $('.activename').text();
                        $(this).find('input.select-dropdown').val(name);
                    }
                });
            }
        }
        /*Careers fill in jobs select box */
        if ($('select#position').length > 0) {
            if ($('h3.accordion-head').length > 0) {
                $('h3.accordion-head').each(function() {
                    $('select#position').append($("<option></option>").attr("value", $(this).text()).text($(this).text()));
                })
            }
        }

        /*On click review scroll top to review title*/

        $('.accordion-head').on('click', function() {
            if ($('.accordion-head.selected_accordion').length > 0) {
                $('.accordion-head').removeClass('selected_accordion');
            }
            $(this).addClass('selected_accordion');
            setTimeout(
                function() {
                    if (!(isVisible($('.selected_accordion')))) {
                        $('html, body').animate({
                            scrollTop: $('.selected_accordion').offset().top - 190
                        }, 600);
                    }
                }, 300);
        });

        if ($('.sbp_scroll_down').length > 0 && $('.sbp_scroll_down').attr('data-to')) {

            $(document).on('click', '.sbp_scroll_down span', function() {
                $('html, body').animate({
                    scrollTop: $($('.sbp_scroll_down').attr('data-to')).offset().top
                }, 800);
            });
        }

        if (($('input.dom_services_check').length > 0) && ($('input.dom_events_check').length > 0)) {
            $('.dom_services_check').click(function() {
                if ($('input.dom_services_check').is(':checked')) {
                    $('.dom_events_check').attr('checked', false);
                    if (!($('.dom_select_event.dom_hidden').length > 0)) {
                        $('.dom_select_event').addClass('dom_hidden');
                        $('select#cf7opt3').val("");

                        $("select#cf7opt3").material_select();
                    }

                    if ($('.dom_select_service.dom_hidden').length > 0) {
                        $('.dom_select_service').removeClass('dom_hidden');
                    }
                } else {
                    $('.dom_select_service').addClass('dom_hidden');

                    $('select#cf7opt2').val("");
                    $("select#cf7opt2").material_select();

                }
            });
            $('.dom_events_check').click(function() {
                if ($('input.dom_events_check').is(':checked')) {
                    $('.dom_services_check').attr('checked', false);
                    if (!($('.dom_select_service.dom_hidden').length > 0)) {
                        $('.dom_select_service').addClass('dom_hidden');
                        $('select#cf7opt2').val("");

                        $("select#cf7opt2").material_select();
                        if ($('.dom_select_service li.active.selected').length > 0) {
                            $('.dom_select_service li.active.selected').removeClass('active selected');
                        };
                    }
                    if ($('.dom_select_event.dom_hidden').length > 0) {
                        $('.dom_select_event').removeClass('dom_hidden');
                    }
                } else {
                    $('.dom_select_event').addClass('dom_hidden');
                    $('select#cf7opt3').val("");
                    $("select#cf7opt3").material_select();
                }

            });


        }



        if ($('.sbp_carousel').length > 0) {
            $('.sbp_carousel').closest('.be-wrap').addClass('no-max-width');
        }
        if ($('.sbp_carousel .carousel_element').length > 0) {
            $('.sbp_carousel .carousel_element').closest('.be-wrap').addClass('amenities-wrapper-width');
        }

        var items = ['.header-hero-section', '#header-inner-wrap > div', 'div:not(.widget) .sbp_cnt_div', '.be-section', '#right-sidebar .widget'];
        var i = 0;
        $.each(items, function() {
            if ($(this).length > 0) {
                $(this).each(function() {
                    i++;
                    $(this).delay(i * 100).animate({
                        opacity: 1
                    }, 150);

                })
            }
        })

        myresize();
        datepicker_init();

        $(window).resize(function() {
            myresize();
        });




        $('<div class="mr_copied_wrapper"><div class="mr_copied"></div></div>').appendTo($('#sb-slidebar-content'));
        if ($('.tocopy').length > 0) {
            $('.tocopy').each(function() {
                $($(this).html()).appendTo($($(this).attr('data-to')));
            });
        }

        /*function for review slider*/

        if ($('.sbp_slider').length > 0) {
            var i = 0;

            /*check if subheader exist*/
            if ($('.sbp_small_header').length > 0) {
                i++;
                $('.sbp_small_header').delay(i * 500).animate({ opacity: 1 }, i * 1000);
            }
            /*check if big header exist*/
            if ($('.sbp_big_header_container').length > 0) {
                i++;
                var headers_length = $('.sbp_big_header_container .sbp_review_loop').length;
                $('.sbp_big_header_container .sbp_review_loop').delay(i * 500).animate({ opacity: 1 }, i * 1000);
                $('.sbp_big_header_container .sbp_review_loop h1').eq(0).delay(i * 500).fadeIn(1000, function () {


                    if (headers_length > 1) {
                        /*check if multiple reviews*/
                        var imgNum = parseInt(headers_length);
                        var element = '.sbp_big_header_container .sbp_review_loop h1';
                        nextFadeIn(0, 1, element, imgNum);
                    }
                });
            }
            /*check if ota loop exists*/
            if ($('.sbp_ota_container').length > 0) {
                i++;
                $('.sbp_ota_container .sbp_ota_loop').delay(i * 500).animate({ opacity: 1 }, i * 1000);
                $('.sbp_ota_loop h3').eq(0).delay(i * 500).fadeIn(1000, function () {


                    var headers_length = $('.sbp_ota_loop').length;
                    if (headers_length > 1) {
                        var imgNum = parseInt(headers_length);
                        var element = '.sbp_ota_container .sbp_ota_loop h3';
                        nextFadeIn(0, 1, element, imgNum);
                    }
                });
            }
            /*check if button exists*/
            if ($('.sbp_book_now').length > 0) {
                i++;
                $('.sbp_book_now').delay(i * 500).animate({ opacity: 1 }, i * 1000);
            }

            /*check if button exists*/
            if ($('.sbp_scroll_down').length > 0) {
                i++;
                $('.sbp_scroll_down').delay(i * 500).animate({ opacity: 1 }, i * 1000, function () {
                    $(this).addClass('animate-flicker')
                });
            }
        }


    });

    function myresize() {

    }


    function datepicker_init() {
        if ($('.datepicker').length > 0) {
            var htmll = '';
            $('body').prepend('<div id="sbp_datepicker_container">' + htmll + '</div>');
            $('.datepicker').each(function() {
                var d_id = $(this).attr('id');
                $('#' + d_id).pickadate({
                    container: '#sbp_datepicker_container',
                    close: "Close",
                    firstDay: 1,
                    closeOnSelect: false,
                    onClose: function() {
                        $('.datepicker').blur();
                        $('.picker').blur();
                        $('html').attr('style', '');
                    }
                })
            })
        }


        $(document).on('change', '.datepicker', 'change click', function(e) {

            var idd = $(this).attr('id');
            var vll = $(this).val();
            if (idd === 'check_in') {

                check_in = timestamp(vll);
                var datee = get_date(vll, 1);
                if (timestamp(datee) >= check_out) {

                    $('#check_out').pickadate('picker').set('min', datee).set('select', datee);
                }
            } else {
                check_out = timestamp(vll);
            }
            $('#' + idd + '_send').val(vll);



        });
    }




    function timestamp(d) {
        d = new Date(d);
        d = d.setUTCHours(24, 0, 0, 0);
        return (d / 1000);
    }


    function get_date(date, days) {
        var datee = new Date(date);
        datee.setHours(0, 0);
        datee.setDate(datee.getDate() + days);
        return datee;
    }

    function nextFadeIn(current, next, element, imgNum) {
        //make image fade in and fade out at one time, without splash vsual;
        var interval = 4000;
        var fadeTime = 700;
        $(element).eq(current).delay(interval).fadeOut(fadeTime)
            .end().eq(next).delay(interval).hide().delay(1000).fadeIn(fadeTime, function () {
                if (next < imgNum - 1) { next++; } else { next = 0; }
                if (current < imgNum - 1) { current++; } else { current = 0; }
                nextFadeIn(current, next, element, imgNum);
            });

    };


})(jQuery);
