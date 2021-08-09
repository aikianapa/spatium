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
                    <wb-foreach wb="from=delivery&render=server">
                        <wb-var wb-if="'{{status}}'!=='deny'" color='success' else='danger' />
                        <wb-var wb-if="'{{status}}'=='past'" color='secondary' />
                        <button type="button" class="day {{status}} btn btn-xs btn-{{_var.color}} mr-2 mb-2" data-date="{{date}}">
                        {{wbDate("d.m.Y",{{date}})}}
                        <i class="ml-2 fa fa-close text-danger" wb-if="'{{status}}'=='empty'"></i>
                        <i class="ml-2 fa fa-check text-success" wb-if="'{{status}}'=='deny'"></i>
                        </button>
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
                    <tbody>
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
<script>
    $modal = $('#modalOrdersEdit');
    $modal.delegate('button.day .fa','click',function(){
        let date = $(this).parent().data('date');
		var type = null;
		var $that = $(this).parents('.day');
		if ($that.hasClass('wait')) return;
		if ($that.hasClass('past')) return;
		if ($that.hasClass('empty')) type = 'empty';
		if ($that.hasClass('deny')) type = 'deny';

        wbapp.post('/cms/ajax/form/users/delivery_decline',{
            type: type,
            uid: '{{user}}',
            date: date
        },function(data){
            $that.removeClass('wait');
            wbapp.render('#deliveryCalendar',{'delivery':data});
        })
    })
</script>

</html>