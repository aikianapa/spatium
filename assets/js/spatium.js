"use strict"
if (!wbapp._session.user || !wbapp._session.user.id || wbapp._session.user.id < ' ') {
    var uid = 'unknown';
} else {
    var uid = wbapp._session.user.id;
}
var hash = document.location.hash;
var __token = wbapp._session.token;

wbapp.on('ready', function() {

    setTimeout(function() {
        $('.parallax').each(function() {
            let img = $(this).attr('data-img');
            if (img !== undefined) $(this).css("background-image", "url(" + img + ")").removeAttr('data-img');
        })

        $('.img-caption').on('mouseover mouseout', function() {
            $(this).find('figcaption').toggleClass('op-0');
        });

        $('#faq-accordion').accordion({
            heightStyle: 'content',
            collapsible: true,
            active: false
        });

        // Animated Appear Element
        if ($(window).width() > 1024) {

            $('.animated').appear(function() {
                var element = $(this);
                var animation = element.data('animation');
                var animationDelay = element.data('delay');
                if (animationDelay) {
                    setTimeout(function() {
                        element.addClass(animation + " visible");
                        element.removeClass('hiding');
                    }, animationDelay);
                } else {
                    element.addClass(animation + " visible");
                    element.removeClass('hiding');
                }
            }, { accY: -150 });

        } else {

            $('.animated').css('opacity', 1);

        }

        wbapp.alive();

        $('loader').remove();
        $('body').removeClass('load');
    }, 1)

    setTimeout(function() {
        $('#cart').removeClass('d-none');
        if (strpos(document.location.href, 'cartclear')) {
            $('#cart .mod-cart-clear').trigger('click');
        }
    }, 1000)

    $('.scroll-top').on('click', function() {
        $('html,body').animate({
            scrollTop: 0
        }, 2000);
    });


    if (hash > '#') {
        $('.nav-item a[href="' + hash + '"]:eq(0)').trigger('click');
    }

    $(document).delegate('.lg-outer', 'mousewheel', function(e) {
        if (e.originalEvent.wheelDelta / 120 > 0) {
            $(this).find('.lg-prev').trigger('click');
        } else {
            $(this).find('.lg-next').trigger('click');
        }
        e.stopPropagation();
    });

    $('#shopping-cart .accordion').accordion({
        heightStyle: 'content'
    });

})

var getCartData = function() {
    let form = $('form#Details').serializeJson();
    let data = wbapp.storage('mod.cart.' + uid);
    if (form == undefined || data == undefined) return;
    data['user'] = form;
    return JSON.stringify(data);
}

$(document).delegate(".feedback-btn", wbapp.evClick, function(e) {
    let form = $(this).parents('form');
    if ($(form).verify()) {
        let formdata = {};
        $(form).find(':input').each(function(i, inp) {
            let label = null;
            $(this).attr('name') !== undefined ? label = $(this).attr('name') : null;
            $(this).attr('placeholder') !== undefined ? label = $(this).attr('placeholder') : null;
            $(this).attr('data-label') !== undefined ? label = $(this).attr('data-label') : null;
            label == null ? null : formdata[label] = $(this).val();
            $(form)[0].reset();
        })

        wbapp.post("/api/mail", { 'formdata': formdata }, function(data) {
            if (data.error == false) {
                $(form).find('.alert-info').removeClass('d-none');
            } else {
                $(form).find('.alert-warning').removeClass('d-none');
            }
            setTimeout(() => {
                $(form).find('.alert').addClass('d-none');
            }, 3000)
        });
    }
});




wbapp.on('mod-cart-update', function(ev, cart) {
    if (cart.total.sum !== undefined && cart.total.sum * 1 > 0) {
        $('#cart').find('.cart-payment, .mod-cart-clear, .checkout-btn, .checkin-btn').show();
    } else {
        $('#cart').find('.cart-payment, .mod-cart-clear, .checkout-btn, .checkin-btn').hide();
    }
});


$(document).delegate(".checkin-btn", wbapp.evClick, function(e) {
    e.stopPropagation();
    var data = getCartData();
    var token = "courier";
    setcookie('carttoken', token, time() + 1000);
    $.redirectPost("/orders/checkout", { 'data': data, 'token': token, '__token': __token });
})

$(document).delegate(".checkout-btn", wbapp.evClick, function(e) {
    e.stopPropagation();
    wbapp.mod.cloudpaywidget();
});


$(document).delegate('#deliveryCalendar .day .btn-delivery', wbapp.evClick, function(ev) {
    var type = null;
    var $that = $(this).parents('.day');
    if ($that.hasClass('wait')) return;
    if ($that.hasClass('past')) return;
    if ($that.hasClass('empty')) type = 'empty';
    if ($that.hasClass('deny')) type = 'deny';
    if (type) {
        $that.addClass('wait');
        var date = $that.data('date');
        var tid = '#deliveryCalendar';
        wbapp.post('/cms/ajax/form/users/delivery_decline', {
            type: type,
            date: date
        }, function(data) {
            $that.removeClass('wait');
            wbapp.render(tid, { 'result': data });
        })
    }
    ev.stopPropagation();
});

wbapp.on('mod-cart-add', function() {
    $('#cart #ui-id-1.cart').trigger('click');
    setTimeout(() => { $('#cart').addClass('show') });
})

$(document).delegate('#cart #Details [name=date][type=hidden]', 'change', function(e) {
    e.stopPropagation();
    if (wbapp._session.user == undefined) return;
    if (wbapp._session.user.id == undefined) return;
    let data = wbapp.postSync('/orders/get_date_dlvrs', { date: $(this).val() });
    if (data == null || data.result == undefined) return;
    if (data.result.length) {
        wbapp.storage('tmp.crossdelivery', data.result);
        $('#Details .cross-delivery p > span').html(data.freedate);
        $('#Details .cross-delivery').removeClass('d-none');
        $('#Details .cross-delivery p > span').off(wbapp.evClick);
        $('#Details .cross-delivery p > span').on(wbapp.evClick, function() {
            $('#Details [name=date]:not([type=hidden])').val(data.freedate);
            $('#Details [name=date][type=hidden]').trigger('change');
        });
    } else {
        $('#Details .cross-delivery').addClass('d-none');
    }
})
$('#Details [name=date][type=hidden]').trigger('change');


var cartCheckPhone = function() {
    wbapp.post('/module/phonecheck/getcode/', {
        'phone': $('#cart input.checkphone').val(),
        'type': 'login'
    }, function(data) {
        if (data.code !== undefined) {
            $('#cart .checkcode').removeClass('d-none');
            if (wbapp._settings.modules.phonecheck.testmode == 'on' || data.phone == '71111111111') {
                $('#cart input.checkcode').val(data.code);
            }
            $('#cart input.token').val(data.check);
            $('#cart input.checkcode + .input-group-append > span').attr('onclick', 'cartLogin()');

        } else if (data.error && data.data) {
            cartRegPhone(data.data);
        }
    });
}

var cartRegPhone = function(data = null) {
    let viewReg = function(data) {
        if (wbapp._settings.modules.phonecheck.testmode == 'on' || data.phone == '71111111111') {
            $('#cartLogin input.checkcode').val(data.code);
        }
        $('#cartLogin input.token').val(data.check);
        $('#cart #Details input[name=id]').val(data.check);
        $('#cart .checkcode').removeClass('d-none');
        $('#cartLogin input.checkcode + .input-group-append > span').attr('onclick', 'cartReg()');
    }

    if (!data) {
        wbapp.post('/module/phonecheck/getcode/', {
            'phone': $('#cart input.checkphone').val(),
            'type': 'reg'
        }, function(data) {
            if (data.code !== undefined && !data.error) {
                viewReg(data)
            } else if (data.error) {
                console.log("cartRegPhone - Error");
            }
        });
    } else {
        viewReg(data);
    }
    return false;
}


var cartReg = function(form = false) {
    if (!form) {
        let code = $('#cartLogin input.checkcode').val();
        if ($('#cart #Details [name=code]').length) {
            $('#cart #Details [name=code]').val(code);
        } else {
            $('#cart #Details').prepend('<input type="hidden" name="code" value="' + code + '">');
        }
        $('#cart #Details [readonly]').removeAttr('readonly').prop('readonly', false);
        $('#cart #Details input[name=phone]').val($('#cartLogin input.checkphone').val()).prop('readonly', true).attr('readonly', true);
        $('#cart #Details :input[name!=phone]').attr('required', true).prop('required', true);
        $('#cart #cartLogin').hide();
        $('#cart #cartButtons').addClass('d-none');
        $('#cart #Details p.tx-secondary').remove();
        $('#cart #cartRegButton').removeClass('d-none');
        $('#cart #Details').removeClass('d-none');
    } else {
        $('#cart #cartRegButton').attr('disabled', true);
        if ($('#cart #Details').verify()) {
            wbapp.post('/cms/ajax/form/users/reguser/', $('#cart #Details').serializeJson(), function(data) {
                $('#cart #cartRegButton').removeAttr('disabled');
                if (!data.error) {
                    cartLogin();
                }
            });
        }
    }
}

var cartLogin = function() {
    wbapp.post('/cms/ajax/form/users/checkphone/', {
        'phone': $('#cartLogin input.checkphone').val(),
        'check': $('#cartLogin input.token').val()
    }, function(data) {
        if (data.login == true) {
            $(document).on('wb-ajax-done', function(ev, param) {
                let cart = wbapp.storage('mod.cart.unknown');
                uid = wbapp._session.user.id;
                wbapp.storage('mod.cart', null);
                wbapp.storage('mod.cart.' + uid, cart);
                $(document).trigger('modCartInit');
                if (param.html !== undefined && param.html == '#cartdev') {
                    setTimeout(function() {
                        $('#cart input[name=qty]:eq(0)').trigger('change');
                    }, 10)
                }
            })
            wbapp._session.user = data.user;
            $('#cart #cartdev').html(data.cart);
            wbapp.ajaxAuto();
        }
    })
}

$.extend({
    redirectPost: function(location, args) {
        var form = '';
        $.each(args, function(key, value) {
            value == undefined ? value = "" : value = value.split('"').join('\"');
            form += '<textarea style="display:none;" name="' + key + '">' + value + '</textarea>';
        });
        $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo($(document.body)).submit();
    }
});