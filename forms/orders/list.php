<html>
<div class="m-3" id="yongerorders">
    <nav class="nav navbar navbar-expand-md col">
        <h3 class="tx-bold tx-spacing--2 order-1">{{_lang.orders}}</h3>

        <div class="ml-auto order-2 float-right">

            <div class="dropdown dropleft d-inline">
                <button class="btn btn-secondary dropdown-toggle mr-2" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/module/myicons/checklist-tasks-chechmark-square.svg?size=24&stroke=FFFFFF" />
                    Отчёты
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header tx-uppercase tx-12 tx-bold tx-inverse">Отчёты</h6>
                    <a data-ajax="{'url':'/orders/rep_cook','html':'.content-body'}" class="dropdown-item" href="#">Отчёт по кухне</a>
                    <a class="dropdown-item" href="#">Отчёт по заказам</a>
                    <a class="dropdown-item" href="#">Отчёт по клиентам</a>
                </div>
            </div>

            <!--a href="#" data-ajax="{'url':'/cms/ajax/form/orders/edit/_new','html':'#yongerorders modals'}"
                class="btn btn-primary">
                <img src="/module/myicons/item-select-plus-add.svg?size=24&stroke=FFFFFF" /> {{_lang.newQuote}}
            </a-->

        </div>

    </nav>

    <table class="table table-striped table-hover tx-15">
        <thead>
            <tr>
                <th>Дата</th>
                <th>Клиент</th>
                <th class="text-right">Кол-во</th>
                <th class="text-right">Сумма</th>
                <th class="text-center">Статус</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="ordersList">
            <wb-foreach wb="table=orders&sort=date:d&bind=cms.list.orders&size={{_sett.page_size}}"
                wb-filter="{'login':'{{_sess.user.login}}' }">
                <tr>
                    <td>{{wbDate("d.m.Y",{{date}})}} - {{wbDate("d.m.Y",{{expired}})}}</td>
                    <td><wb-data wb="table=users&item={{user}}">
                        {{first_name}} {{last_name}}<br>
                        <span class="tx-11">{{wbPhoneFormat({{phone}})}}</span>
                        <span class="tx-11">{{delivery_address}}</span>
                    </wb-data></td>
                    <td class="text-right">{{total.qty}}</td>
                    <td class="text-right">{{total.sum}}</td>
                    <td class="text-center">
                        <span class="badge badge-danger wd-10 ht-10 rounded-circle" wb-if="'{{active}}'==''"> </span>
                        <span class="badge badge-success wd-10 ht-10 rounded-circle" wb-if="'{{active}}'=='on'"> </span>
                    </td>
                    <td>
                        <a href="javascript:"
                            data-ajax="{'url':'/cms/ajax/form/orders/edit/{{id}}','html':'#yongerorders modals'}"
                            class="d-inline">
                            <img src="/module/myicons/content-edit-pen.svg?size=24&stroke=323232">
                        </a>
                        <a href="javascript:"
                            data-ajax="{'url':'/ajax/rmitem/orders/{{id}}','update':'cms.list.orders','html':'#yongerorders modals'}"
                            class="d-inline">
                            <img src="/module/myicons/trash-delete-bin.2.svg?size=24&stroke=323232" class="d-inline">
                        </a>
                    </td>
                </tr>
            </wb-foreach>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
            </tr>
        </tfoot>
    </table>


    <modals></modals>
</div>
<script wb-app>

</script>
<wb-lang>
    [ru]
    orders = Заказы
    search = Поиск
    newQuote = Новая заявка
    [en]
    orders = Orders
    search = Search
    newQuote = New quote
</wb-lang>

</html>