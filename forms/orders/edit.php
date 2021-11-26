<html>
<div class="modal effect-scale show removable" id="modalOrdersEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-5">
                    <h5>Заказ № {{number}}</h5>
                </div>
                <i class="fa fa-close r-20 position-absolute cursor-pointer" data-dismiss="modal"
                    aria-label="Close"></i>
            </div>
            <div class="modal-body pd-20">
                <form  id="{{_form}}EditForm">
                <div>
                    <wb-data wb="table=users&item={{user}}">
                        <p>
                            <b>Клиент:</b> {{first_name}} {{last_name}}<br>
                            <b>Телефон:</b> {{wbPhoneFormat({{phone}})}}<br>
                            <b>Адрес:</b> {{delivery_address}}<br>
                        </p>
                    </wb-data>
                </div>

                <div class="row">
                    <label class="tx-bold col-auto">Оплачен</label>
                    <wb-module wb="module=switch" name="payed" class="col-1" />
                    <label class="tx-bold col-auto">Статус</label>
                    <div class="col-4">
                        <select class="form-control select2" name="active" wb-tree="item=status">
                            <option value="{{id}}" wb-if="'{{active}}'=='on'">{{name}}</option>
                        </select>
                    </div>
                    <div class="col-12 my-1">
                        <textarea class="form-control" name="notes" placeholder="Комментарии"></textarea>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="pro-thumbnail">Изображение</th>
                            <th class="pro-title">Наименование</th>
                            <th class="pro-price">Цена</th>
                            <th class="pro-quantity">Кол-во</th>
                            <th class="pro-quantity">Дней</th>
                            <th class="pro-subtotal">Всего</th>
                        </tr>
                    </thead>
                    <tbody id="orderList">
                        <wb-foreach wb="from=list&size=10">
                            <tr>
                                <td class="pro-thumbnail">
                                    <a href="{{link}}">
                                        <img data-src="/thumb/359x359/src/{{image}}" class="wd-70 ht-70" alt="{{name}}">
                                    </a>
                                </td>
                                <td class="pro-title"><a href="{{link}}">{{name}}</a></td>
                                <td class="pro-price"><span>{{price}}₽</span></td>
                                <td class="pro-quantity">{{qty}}</td>
                                <td class="pro-quantity">{{days}}</td>
                                <td class="pro-subtotal"><span>{{sum}}₽</span></td>
                            </tr>
                            </wb-module>
                    </tbody>
                </table>
                </form>
            </div>
            <div class="modal-footer pd-x-20 pd-b-20 pd-t-0 bd-t-0">
                <wb-include wb="{'form':'common_formsave.php'}" />
            </div>
        </div>
    </div>
</div>
<script wbapp>
var $modal = $('#modalOrdersEdit');
$modal.undelegate('button.day + .dropdown-menu a', wbapp.evClick);
$modal.delegate('button.day + .dropdown-menu a', wbapp.evClick, function() {
    let $btn = $(this).parent('.dropdown-menu').prev('button.day');
    let $that = $(this);
    let date = $btn.data('date');
    let type = substr($(this).attr('href'),1);
    let url;
    if (type == 'deny' || type == 'empty') {
        url = '/cms/ajax/form/users/delivery_decline';
    } else {
        if (type == 'toempty') type = 'empty';
        url = '/orders/set_status';
    }
    $that.addClass('wait');
    wbapp.post(url, {
        type: type,
        uid: '{{user}}',
        oid: '{{id}}',
        date: date
    }, function(data) {
        $that.removeClass('wait');
        wbapp.render('#deliveryCalendar', {
            'delivery': data
        });
    })
})

</script>

</html>