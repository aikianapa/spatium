<html>
<div class="myaccount-content">
    <h3>Мои заказы</h3>

    <div class="myaccount-table table-responsive text-center">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Номер</th>
                    <th>Name</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th>Сумма</th>
                    <th>Действие</th>
                </tr>
            </thead>

            <tbody>
                <wb-foreach wb="table=orders&sort=date:d&size=10&offset=-170" wb-filter="_creator={{_sess.user.id}}">
                <tr>
                    <td>{{id}}</td>
                    <td>Заказ</td>
                    <td>{{wbDate("d.m.Y",{{date}})}} - {{wbDate("d.m.Y",{{expired}})}}</td>
                    <td>
                        <svg wb-if="'{{active}}'=='on'" class="size-35 mi mi-checkmark-circle-1" wb-module="myicons" stroke="28a745"></svg>
                        <svg wb-if="'{{active}}'!=='on'" class="size-35 mi mi-delete-circle" wb-module="myicons" stroke="dc3545"></svg>
                    </td>
                    <td>{{total.sum}}</td>
                    <td><a data-ajax="{'url':'/cms/ajax/form/orders/view/{{id}}','html':'modal'}" class="btn">
                    <svg class="size-35 mi mi-eye-circle" wb-module="myicons" stroke="666666"></svg>
                    </a></td>
                </tr>
                </wb-foreach>
            </tbody>
        </table>
    </div>
</div>
</html>