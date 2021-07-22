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
                <wb-foreach wb="from=list">
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
    </div>

</wb-data>