<script wb-app remove1>
    if (typeof wbapp.mod == "undefined") wbapp.mod = {};
  wbapp.loadScripts(["https://widget.cloudpayments.ru/bundles/cloudpayments"], 'cloudpayment', function () {
    wbapp.mod.cloudpaywidget = function(params = {}) {
    let widget = new cp.CloudPayments();
    var data = getCartData();
    let item = JSON.parse(data);
    let uid = wbapp._session.user.id;
    let sum = wbapp.storage('mod.cart.' + uid + '.total.sum') * 1;
    var token = md5(data + uid + time());
    let method: '{{method}}';
    method == '' ? method = 'charge' : null;
    var options = { //options
      publicId: '{{api_key}}', //id из личного кабинета
      description: '{{description}}', //назначение
      amount: sum, //сумма
      currency: '{{currency}}', //валюта
      accountId: '{{acc_id}}', //идентификатор плательщика (необязательно)
      invoiceId: '{{number}}', //номер заказа  (необязательно)
      skin: '{{skin}}', //дизайн виджета (необязательно)
      data: {
        token: token
      }
    };
    widget.pay(method, options,
      {
        onSuccess: function (options) { // success
          //действие при успешной оплате
          if (options.data.token == token) {
            setcookie('carttoken', token, time() + 1000);
            $.redirectPost("/orders/checkout", { 'data': data, 'token': token, '__token': __token, 'number': '{{number}}' });
            wbapp.storage('mod.cart.' + uid , null);
          }
        },
        onFail: function (reason, options) {
          //wbapp.toast("Ошибка","Платёж не удался. Попробуйте снова.",{'bgcolor':'danger'});
        },
        /*
        onComplete: function (paymentResult, options) { //Вызывается как только виджет получает от api.cloudpayments ответ с результатом транзакции.
          //					console.log(paymentResult,options);
          //например вызов вашей аналитики Facebook Pixel
          if (options.data.token == token && paymentResult.success == true) {
            setcookie('carttoken', token, time() + 1000);
            $.redirectPost("/orders/checkout", { 'data': data, 'token': token, '__token': __token, 'number': '{{number}}' });
            wbapp.storage('mod.cart.' + uid , null);
          }
        }
        */
      }
    )
    }
  })
</script>