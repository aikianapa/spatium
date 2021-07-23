<wb-data wb="table=orders&item={{_var.order_id}}">
    <div class="cart-table table-responsive mb-40" wb-if="'{{_sess.user.id}}'=='{{_creator}}'">
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
                                <img data-src="/thumb/359x359/src/{{image}}" class="img-fluid" alt="{{name}}">
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
        <div class="p-3">
            <h3>График доставки</h3>
            <p>
                Если в какой-то из дней вы не можете получить заказ, кликните по этой дате на графике и доставка будет перенесена на более позднюю дату.
            </p>
        </div>
        <div class="d-block" id="deliveryCalendar" data-order="{{_var.order_id}}">
            <wb-foreach wb="from=delivery&render=client">
                <div class="day {{status}}" data-date="{{date}}">
                    <p class="text-center">
                        <b>{{n}}</b>
                        <br>
                        <span>{{d}} {{m}}</span>
                    </p>
                </div>
            </wb-foreach>
        </div>
    </div>
</wb-data>
<script>
    $.deliveryCalendar();
</script>