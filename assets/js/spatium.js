"use strict"

wbapp.loadStyles([
  "https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;500;600;700&subset=latin,cyrillic"
]);


if (!wbapp._session.user || !wbapp._session.user.id || wbapp._session.user.id < ' ') {
  var uid = 'unknown';
} else {
  var uid = wbapp._session.user.id;
}
var hash = document.location.hash;
var __token = wbapp._session.token;

wbapp.on('ready', function () {

  setTimeout(function () {
    $('.parallax').each(function () {
      let img = $(this).attr('data-img');
      if (img !== undefined) $(this).css("background-image", "url(" + img + ")").removeAttr('data-img');
    })

    $('.img-caption').on('mouseover mouseout', function () {
      $(this).find('figcaption').toggleClass('op-0');
    });

    $('#faq-accordion').accordion({
      heightStyle: 'content'
      , collapsible: true
      , active: false
    });
    $('loader').hide();
  }, 1)

  setTimeout(function () {
    $('#cart').removeClass('d-none');
  }, 1000)

  $('.scroll-top').on('click', function () {
    $('html,body').animate({
      scrollTop: 0
    }, 2000);
  });


  if (hash > '#') {
    $('.nav-item a[href="' + hash + '"]:eq(0)').trigger('click');
  }

  $(document).delegate('.lg-outer', 'mousewheel', function (e) {
    if (e.originalEvent.wheelDelta / 120 > 0) {
      $(this).find('.lg-prev').trigger('click');
    }
    else {
      $(this).find('.lg-next').trigger('click');
    }
    e.stopPropagation();
  });

  $('#shopping-cart .accordion').accordion({
    heightStyle: 'content'
  });

})

var getCartData = function () {
  let form = $('form#Details').serializeJson();
  let data = wbapp.storage('mod.cart.' + uid);
  if (form == undefined || data == undefined) return;
  data['user'] = form;
  return JSON.stringify(data);
}

$(document).delegate(".feedback-btn", wbapp.evClick, function (e) {
  let form = $(this).parents('form');
  if ($(form).verify()) {
    let formdata = {};
    $(form).find(':input').each(function (i, inp) {
      let label = null;
      $(this).attr('name') !== undefined ? label = $(this).attr('name') : null;
      $(this).attr('placeholder') !== undefined ? label = $(this).attr('placeholder') : null;
      $(this).attr('data-label') !== undefined ? label = $(this).attr('data-label') : null;
      label == null ? null : formdata[label] = $(this).val();
      $(form)[0].reset();
    })

    wbapp.post("/api/mail", { 'formdata': formdata }, function (data) {
      console.log(data);
    });
  }
});

$(document).delegate(".checkin-btn", wbapp.evClick, function (e) {
  e.stopPropagation();
  var data = getCartData();
  var token = "courier";
  setcookie('carttoken', token, time() + 1000);
  $.redirectPost("/orders/checkout", { 'data': data, 'token': token, '__token': __token });
})

$(document).delegate(".checkout-btn", wbapp.evClick, function (e) {
  e.stopPropagation();
  wbapp.loadScripts(["https://widget.cloudpayments.ru/bundles/cloudpayments"], 'cloudpayment', function () {
    var widget = new cp.CloudPayments();
    var iid = Object.keys(wbapp.storage('mod.cart'))[0];
    var sum = wbapp.storage('mod.cart.' + uid + '.total.sum') * 1;
    var data = getCartData();
    var token = md5(data + uid + time());
    var options = { //options
      publicId: 'test_api_00000000000000000000001', //id из личного кабинета
      description: 'Оплата товаров в Spatium Detox', //назначение
      amount: sum, //сумма
      currency: 'RUB', //валюта
      accountId: uid, //идентификатор плательщика (необязательно)
      invoiceId: uid, //номер заказа  (необязательно)
      skin: "modern", //дизайн виджета (необязательно)
      data: {
        token: token
      }
    };
    widget.pay('auth', options,
      {
        onSuccess: function (options) { // success
          //действие при успешной оплате
          if (options.data.token == token && paymentResult.success == true) {
            setcookie('carttoken', token, time() + 1000);
            $.redirectPost("/orders/checkout", { 'data': data, 'token': token, '__token': __token });
          }
        },
        onFail: function (reason, options) { // fail
          //действие при неуспешной оплате
          //console.log(reason,options);
          //$.redirectPost("/cart", {});
        },
        onComplete: function (paymentResult, options) { //Вызывается как только виджет получает от api.cloudpayments ответ с результатом транзакции.
          //					console.log(paymentResult,options);
          //например вызов вашей аналитики Facebook Pixel
          if (options.data.token == token && paymentResult.success == true) {
            setcookie('carttoken', token, time() + 1000);
            $.redirectPost("/orders/checkout", { 'data': data, 'token': token, '__token': __token });
          }
        }
      }
    )
  })
});


$(document).on('mod-cart-add', function () {
  $('#cart #ui-id-1.cart').trigger('click');
})


$(document).delegate('#deliveryCalendar .day .btn-delivery', wbapp.evClick, function (ev) {
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
    }, function (data) {
      $that.removeClass('wait');
      wbapp.render(tid, { 'result': data });
    })
  }
  ev.stopPropagation();
});


wbapp.on('mod-cart-add', function () {
  setTimeout(() => { $('#cart').addClass('show') });
})

$(document).delegate('#Details [name=date][type=hidden]', 'change', function (e) {
  e.stopPropagation();
  if (wbapp._session.user.id == undefined) return;
  let data = wbapp.postSync('/orders/get_date_dlvrs', { date: $(this).val() });
  if (data == null || data.result == undefined) return;
  if (data.result.length) {
    wbapp.storage('tmp.crossdelivery', data.result);
    $('#Details .cross-delivery p > span').html(data.freedate);
    $('#Details .cross-delivery').removeClass('d-none');
    $('#Details .cross-delivery p > span').off(wbapp.evClick);
    $('#Details .cross-delivery p > span').on(wbapp.evClick, function () {
      $('#Details [name=date]:not([type=hidden])').val(data.freedate);
      $('#Details [name=date][type=hidden]').trigger('change');
    });
  } else {
    $('#Details .cross-delivery').addClass('d-none');
  }
})
$('#Details [name=date][type=hidden]').trigger('change');

$.extend(
  {
    redirectPost: function (location, args) {
      var form = '';
      $.each(args, function (key, value) {
        value == undefined ? value = "" : value = value.split('"').join('\"');
        form += '<textarea style="display:none;" name="' + key + '">' + value + '</textarea>';
      });
      $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo($(document.body)).submit();
    }
  });