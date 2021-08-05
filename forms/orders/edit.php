<html>
<div class="modal effect-scale show removable" id="modalPagesEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-5">
                    <h5>Заказ № {{id}}</h5>
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
                <div class="py-2">
                    <wb-foreach wb="from=delivery&render=client">
                        <wb-var wb-if="'{{status}}'!=='deny'" color='success' else='danger' />
                        <div class="d-flex-inline badge badge-{{_var.color}} mb-1 mr-2">
                                {{wbDate("d.m.Y",{{date}})}}
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

</html>