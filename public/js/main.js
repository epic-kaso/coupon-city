/*
 * CouponCity internal website script
 * http://pricedis.com/
 * Copyright (c) 2014 Larry Oti
 * Date: Thu, Jan 9 2014 12:40:09 0000
 */

$(function () {

    $('.login-register').contents().hide();

    //Login/Registration
    $('.login, .register, .forgot').click(function () {

        $('.login-register').contents().hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).show();
        $('.login-register').modal();

        return false;
    });


    //Sticky nav
    $('.header').waypoint(function () {
        $(this).toggleClass('sticky');
    });

    //Datepicker
    $( ".from-dati" ).datepicker({
        minDate: 0,
        dateFormat: 'MM dd, yy',
        onClose: function( selectedDate ) {
            $( ".to-dati" ).datepicker( "option", "minDate", selectedDate );
        }
    });

    $( ".to-dati" ).datepicker({
        minDate: 1,
        dateFormat: 'MM dd, yy',
        onClose: function( selectedDate ) {
            $( ".from-dati" ).datepicker( "option", "maxDate", selectedDate );
        }
    });

    //Navigation width Setting
    var navWidth = $('nav').width();
    var linkWidth = navWidth / ($('nav').children().size());

    var activeWidth = parseInt(linkWidth / 2)

    $('nav').children('li').css({'width': linkWidth}).last().addClass('lastList');
    $('.sub-nav:before').css({'width': linkWidth});


    //Nav active
    $('nav').children('li').click(function () {
        $('nav').children('li').removeClass('active');
        $(this).addClass('active');

        return false;
    });


    //FAQ Cart
    $('.faq p').click(function () {
        $('.faq p').removeClass('active').next('div').removeClass('active');
        $(this).addClass('active').next('div').addClass('active');

        return false;
    });


    //Deal account section
    $('.my-deals').last().css({'border-bottom': '0'})


    //Account page nav
    $(".account-deals").hide(); //Hide all content
    $(".account-nav a:first").addClass("active").show(); //Activate first tab

    $(".account-deals:first").show(); //Show first tab content

    $(".account-nav a").click(function () {//On Click about
        $(".account-nav a").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $(".account-deals").hide(); //Hide all tab content
        var activeT = $(this).attr("href"); //Find the rel attribute value to identify the active tab + content

        $(activeT).fadeIn(); //Fade in the active content
        return false;
    });


    //Deal Vouchers
    $('.my-deals li a').click(function () {
        $('.v-border').modal();
        return false;
    });


    //Add funds
    $('.add-funds').click(function () {
        $('#add-funds').modal();
        return false;
    });


    //Price details
    $('.price-details').click(function () {
        $('#price-details').modal();
        return false;
    });


    //Redeem
    $('#redeem').click(function () {
        $('.redeem').modal();
        return false;
    });


    //Bank payment details
    function pay() {
        if ($('.bank-pay').is(':checked')) {
            $('.bank-pay-details').show();
            $('.bank-pay-details input').attr('required', 'required');
        } else {
            $('.bank-pay-details').hide();
            $('.bank-pay-details input').attr('required', '');
        }
    }

    $('.paye').click(function () {
        pay();
    });


    //Calculate cart prices
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

    //Subtotal add function
    function totalz() {
        //Get sub totals in array
        var subTotals = [];

        $('.subby').each(function () {
            subTotals.push($(this).text().replace(/\D/g, ''))
        });

        //take sub total array and add
        var total = 0;
        for (var i = 0; i < subTotals.length; i++) {
            total += subTotals[i] << 0;
        }

        //Get shipping cost
        var shipping = $('.ship').text().replace(/\D/g, '');

        //Total + shipping
        var gross = parseInt(total) + parseInt(shipping)

        //Output total with naira and comma function
        $('.total span').text('₦' + commaSeparateNumber(gross));
    }


    //After entering product quantity
    $('.qty').bind("change keyup input", function () {

        var units = $(this).val();
        var price = ($(this).closest('td').next('td').text()).replace(/\D/g, '');
        var subby = '₦' + price * units
        $(this).closest('td').next('td').next('td.subby').html(commaSeparateNumber(subby));

        totalz();

    });

    //Remove cart items
    $('a.remove').click(function () {
        if ($(this).closest('table').find('tr').length > 2) {
            $(this).closest('tr').remove();
        }
        else {
            $(this).closest('table').remove();
            $('.sub-total, .shipping, .faq').remove();
            $('.if-no-deal').show();
        }

        //Call function to recalc after removing cart item
        totalz();

        return false;
    });


    //Suggest movie swap
    function swap() {
        var $this = $(this);

        var thumb = $this.html();
        var deal =

            $('.deal-pictures').html(thumb);

        var current = $('.deal-pictures').html();


        if (thumb == current) {
            $('.thumbnails li').removeClass('currently');
            $this.parent('li').addClass('currently');
        }

        return false;
    }

    $('.thumbnails li:first a').each(swap); //First by default
    $('.thumbnails li a').click(swap);


    //Countdown
    var offerClose = new Date();
    var time = $('.deadline').text();
    var arr = time.split('/');
    offerClose = new Date(arr[0], arr[1] - 1, arr[2]);

    $('.time-left').countdown({until: offerClose,
        timezone: +1,
        compact: true,
        description: ''
    });


    //Slider
    $('.actual-slider').bjqs({
        height: 320,
        width: 650,
        responsive: true,
        showcontrols: false
    });


    //Slider responsive
    function markers() {
        if ($(".actual-slider").css("z-index") == "6") {

            var sw = $('.bjqs-markers').width();
            var mw = sw / 3

            $('.bjqs-markers li').width(mw);
            $('nav li').css('width', 'auto');

            console.log(mw);
        }
    }

    markers();


    //Resizing
    $('.category-deals li').addClass('clearfix');

    $(window).resize(function () {
        var h = $('.deal-img img').height();

        if (h < 130) {
            console.log('Alarm');
        }
        markers();

    });

    $('.mobile-nav').click(function () {

        //get height of main-contain
        //make it minimum height of header
        //no defined height from css for header so it can flow

        var fw = $('.footer').height();

        jQuery.fn.appendMinHeight = function (txt) {

            $(".header").css("min-height", function () {
                return parseInt($('.main-contain').height()) - fw - 40;
            });
        };

        $('.header').appendMinHeight();

        $(".header").toggleClass("navActive");

        return false;

    });


    //Preview image before upload
    var $photo = $('.business-logo');
    $photo.change(function () {
        var targ = $(this).parent('.file-upload').find('.target');

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    targ.attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        readURL(this); //show preview image
    });


    //Coupon Images
    $('.coupon-images .file-upload').each(function () {

        var pic = $(this).find('.upload');
        var _target = $(this).find('.target');

        pic.change(function () {

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        _target.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            readURL(this); //show preview image
        });

    });


    //Advanced Pricing
    function _type() {
        if ($('#pricing-type').is(':checked')) {
            $('.pricing-type + label').text('Turn Off Advanced Pricing');
            $('.basic-type-pricing').hide();
            $('.advanced-type-pricing').show();
            $('.advanced-type-pricing input[type="text"]').attr('required', 'required');
        } else {
            $('.pricing-type + label').text('Turn On Advanced Pricing');
            $('.basic-type-pricing').show();
            $('.advanced-type-pricing').hide();
            $('.advanced-type-pricing input[type="text"]').removeAttr('required');
        }
    }

    $('.pricing-type').click(function () {
        _type();
    });


    //Extras if advanced pricing
    //no of customers has to be less than max

    function pricing() {
        var _old = $('.old_price');
        var _max = $('.max_coupons');
        var _newp = $('.new_price');
        var _basic = $('.basic_discount');

        var old_price = parseInt(_old.val() || 0);
        var max = parseInt(_max.val() || 0);
        var new_price = parseInt(_newp.val() || 0);
        var discount = parseInt(_basic.val() || 0);

        var margin = 20

        $(_newp).bind("change keyup input", function () {
            var _input = parseInt($(this).val() || 0);
            var old_price = parseInt(_old.val() || 0);
            console.log(old_price);

            if (_input >= old_price) {
                //Dont allow passage
                console.log('Discounted price cant be higher');
            }

            var diff = Math.round(((old_price - _input) * 100) / old_price);

            $(_basic).val(diff);
        });

        $(_basic).bind("change keyup input", function () {
            var _input = parseInt($(this).val() || 0);
            var old_price = parseInt(_old.val() || 0);

            var diff = Math.round(old_price - ((_input / 100) * old_price));

            $(_newp).val(diff);
        });
    }

    pricing(); //Call function


    var opts = {
        lines: 12, // The number of lines to draw
        angle: 0.15, // The length of each line
        lineWidth: 0.44, // The line thickness
        pointer: {
            length: 0.9, // The radius of the inner circle
            strokeWidth: 0.035, // The rotation offset
            color: '#000000' // Fill color
        },
        limitMax: true,
        colorStart: '#6FADCF',   // Colors
        colorStop: '#0f75bc',    // just experiment with them
        strokeColor: '#E0E0E0',   // to see which ones work best for you
        generateGradient: true
    };

    var target = document.getElementById('sales-guage'); // your canvas element
    var gauge = new Gauge(target);
    var reach = 1000;
    gauge.setOptions(opts); // create sexy gauge!
    gauge.maxValue = 3000; // set max gauge value
    gauge.animationSpeed = 40; // set animation speed (32 is default value)
    gauge.set(reach);


});


(function(){
    $('form[data-remote]').on('submit',function(e){
        form = $(this);


        var submit = form.find('input[type="submit"]')
        var method = form.find('input[name="_method"]').val() || 'POST';
        var url = form.prop('action');

        var old_value = submit.prop('value');
        submit.prop('value','please wait...').addClass('disabled');
        $.ajax({
            type: method,
            url: url,
            data: form.serialize(),
            success: function(){
                submit.prop('value',submit.data('success-message'));
                var message = form.data('remote-success-message');

                if(message){
                    $('.flash').html(message).fadeIn(300).delay(3500).fadeOut(300);
                }
            },
            error: function($response,$xhr,$data){
                //console.log($response);
                submit.prop('value',old_value).removeClass('disabled');
                $('.flash').html($response.responseText).fadeIn(300).delay(3500).fadeOut(300);
            }
        });
        e.preventDefault();
    });

    $('input[data-confirm], button[data-confirm]').on('click',function(e){
        var input = $(this);

        input.prop('disabled','disabled');

        if(!confirm(input.data('confirm'))){
            e.preventDefault();
        }

            input.removeAttr('disabled')
    });


})();