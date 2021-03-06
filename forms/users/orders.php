<html>
<div class="myaccount-content">
    <h3>Мои заказы</h3>

    <div class="table-responsive text-center rounded bd-1">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="tx-center">Номер</th>
                    <th>Период</th>
                    <!--th class="tx-center">Статус</th-->
                    <th class="tx-right">Сумма</th>
                    <th class="tx-center">Оплачен</th>
                    <th class="tx-center">Детали</th>
                </tr>
            </thead>

            <tbody>
                <wb-foreach wb="table=orders&sort=date:d&size=10&offset=-170" wb-filter="_creator={{_sess.user.id}}">
                <tr>
                    <td class="tx-center">{{number}}</td>
                    <td>{{wbDate("d.m.Y",{{date}})}} - {{wbDate("d.m.Y",{{expired}})}}</td>
                    <!--td class="tx-center">
                        <svg wb-if="'{{active}}'=='on'" class="size-30 mi mi-checkmark-circle-1" wb-module="myicons" stroke="28a745"></svg>
                        <svg wb-if="'{{active}}'!=='on'" class="size-30 mi mi-delete-circle" wb-module="myicons" stroke="dc3545"></svg>
                    </td-->
                    <td class="tx-right">{{total.sum}}</td>
                    <td class="tx-left">
                        <div wb-if="'{{payed}}' == ''">
                            <img data-src="/module/myicons/payments-finance-17.svg?size=30&stroke=dc3545">
                            <span class="tx-12"> нет</span>
                        </div>
                        <div wb-if="'{{payed}}' > ''">
                        <img data-src="/module/myicons/payments-finance-24.svg?size=30&stroke=28a745">
                        <span class="tx-12"> да</span>
                        </div>
                    </td>
                    <td class="tx-center"><a href="javascript:void(0)" data-ajax="{'url':'/cms/ajax/form/orders/view/{{id}}','html':'modal'}" class="cursor-pointer">
                        <img src="/module/myicons/search-arrow-circle.svg?size=30&stroke=0168fa">
                    </a></td>
                </tr>
                </wb-foreach>
            </tbody>
        </table>
    </div>
</div>
</html>