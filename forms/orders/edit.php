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
                <div>
                    <wb-data wb="table=users&item={{user}}">
                        <p>
                            <b>Клиент:</b> {{first_name}} {{last_name}}<br>
                            <b>Телефон:</b> {{wbPhoneFormat({{phone}})}}<br>
                            <b>Адрес:</b> {{delivery_address}}
                        </p>
                    </wb-data>
                </div>
                <div class="py-2" id="deliveryCalendar">
                    <wb-foreach wb="from=delivery&render=server&tpl=true">
                    <wb-var wb-if="'{{status}}'!=='deny'" color='success' else='danger' />
                        <wb-var wb-if="'{{status}}'=='past'" color='outline-secondary' />
                        <wb-var wb-if="'{{status}}'=='fail'" color='outline-warning' />
                        <wb-var wb-if="'{{status}}'=='ready'" color='outline-success' />
                        <wb-var wb-if="'{{deny}}'=='deny'" color='outline-danger' />
                    <div class="dropdown  d-inline">
                            <button type="button" wb-if="'{{status}}'!=='past'"
                                class="dropdown-toggle day {{status}} btn btn-xs btn-{{_var.color}} mr-2 mb-2"
                                data-date="{{date}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{wbDate("d.m.Y",{{date}})}}
                            </button>
                            <button type="button" wb-if="'{{status}}'=='past'"
                                class="day {{status}} btn btn-xs btn-{{_var.color}} mr-2 mb-2" data-date="{{date}}">
                                {{wbDate("d.m.Y",{{date}})}}
                            </button>

                            <div class="dropdown-menu"  wb-if="'{{status}}'!=='past'">
                                <a class="dropdown-item" wb-if="'{{status}}'=='empty'" href="#empty">
                                    <img src="/module/myicons/delivery-17.svg?size=24&stroke=dc3545">
                                    Сдвинуть доставку</a>
                                <a class="dropdown-item" wb-if="'{{status}}'=='deny'" href="#deny">
                                    <img src="/module/myicons/delivery-truck-fast.svg?size=24&stroke=10b759">
                                    Вернуть доставку</a>
                                <a class="dropdown-item" wb-if="'{{status}}'=='ready' OR '{{status}}'=='fail'" href="#toempty">
                                    <img src="/module/myicons/delivery-truck-fast.svg?size=24&stroke=10b759">
                                    Вернуть доставку</a>
                                <a class="dropdown-item"  wb-if="'{{status}}'=='empty'" href="#ready">
                                    <img src="/module/myicons/delivery-truck-checkmark.svg?size=24&stroke=10b759">
                                    Доставлено</a>
                                <a class="dropdown-item"  wb-if="'{{status}}'=='empty'" href="#fail">
                                    <img src="/module/myicons/delivery-truck-cancel.svg?size=24&stroke=ffc107">
                                    Срыв доставки</a>

                            </div>
                        </div>
                    </wb-foreach>
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