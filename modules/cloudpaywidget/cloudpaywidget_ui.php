<script wb-app remove>
    if (typeof wbapp.mod == "undefined") wbapp.mod = {};
  wbapp.loadScripts(["https://widget.cloudpayments.ru/bundles/cloudpayments"], 'cloudpayment', function () {
    wbapp.mod.cloudpaywidget = function(params = {}) {
        let onSuccess, onFail, onComplete;
    params.onSuccess == undefined ? onSuccess = ()=>{} : onSuccess = params.onSuccess;
    params.onFail == undefined ? onFail = ()=>{} : onFail = params.onFail; 
    params.onComplete == undefined ? onComplete = ()=>{} : onComplete = params.onComplete;
    let widget = new cp.CloudPayments();
    //var iid = Object.keys(wbapp.storage('mod.cart'))[0];
    let data = getCartData();
    let item = JSON.parse(data);
    let uid = wbapp._session.user.id;
    let sum = wbapp.storage('mod.cart.' + uid + '.total.sum') * 1;
    let token = md5(data + uid + time());
    var options = { //options
      publicId: '{{api_key}}', //id из личного кабинета
      description: '{{description}}', //назначение
      amount: sum, //сумма
      currency: '{{currency}}', //валюта
      accountId: '{{acc_id}}', //идентификатор плательщика (необязательно)
      invoiceId: uid, //номер заказа  (необязательно)
      skin: '{{skin}}', //дизайн виджета (необязательно)
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
    }
  })
</script>