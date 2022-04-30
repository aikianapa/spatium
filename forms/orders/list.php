<html>
<div class="m-3" id="yongerorders">
    <nav class="nav navbar navbar-expand-md col">
        <h3 class="tx-bold tx-spacing--2 order-1">{{_lang.orders}}</h3>

    </nav>


    <div class="yonger-nested mb-1">
        <span class="bg-light">
            <div class="header p-2">
                <span class="row">
                    <div class="col-sm-6">
                        <input class="form-control" type="search" placeholder="Поиск..." data-ajax="{'target':'#{{_form}}List',
                    'filter_add':{'$or':[
                        { 'number': {'$like' : '$value'} }, 
                        { 'phone': {'$like' : '$value'} }, 
                        { 'address': {'$like' : '$value'} }, 
                        { 'name': {'$like' : '$value'} }
                    ]} }">
                    </div>
                </span>
            </div>
        </span>
        <wb-data wb="table=catalogs&item=status&field=tree">
            <wb-var status="{{data}}" />
        </wb-data>

        <wb-foreach wb="from=_var.status&tpl=false">
            <div class="py-2 px-3 d-inline-block">
                <img data-src="/module/myicons/{{data.icon}}.svg?size=30&stroke={{substr({{data.color}},1,6)}}"> {{name}}
            </div>
        </wb-foreach>


        <table class="table table-striped table-hover tx-15">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>Дата</th>
                    <th>Клиент</th>
                    <th class="text-right">Кол-во</th>
                    <th class="text-right">Сумма</th>
                    <th class="text-center">Статус</th>
                    <th class="text-center">Оплата</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="ordersList">
                <wb-foreach wb="table=orders&sort=_created:d&bind=cms.list.orders&size={{_sett.page_size}}">
                    <tr>
                        <td>{{number}}</td>
                        <td>{{wbDate("d.m.Y",{{date}})}} - {{wbDate("d.m.Y",{{expired}})}}</td>
                        <td>
                            {{name}}<br>
                            <span class="tx-11">{{wbPhoneFormat({{phone}})}}</span>
                            <span class="tx-11">{{delivery_address}}</span>
                        </td>
                        <td class="text-right">{{total.qty}}</td>
                        <td class="text-right">{{total.sum}}</td>
                        <td class="text-center">
                            <img
                                data-src="/module/myicons/{{_var.status.{{active}}.data.icon}}.svg?size=30&stroke={{substr({{_var.status.{{active}}.data.color}},1,6)}}">
                        </td>
                        <td class="text-center">
                            <img wb-if="'{{payed}}' == ''"
                                data-src="/module/myicons/payments-finance-17.svg?size=30&stroke=dc3545">
                            <img wb-if="'{{payed}}' > ''"
                                data-src="/module/myicons/payments-finance-24.svg?size=30&stroke=28a745">
                        </td>
                        <td>
                            <a href="javascript:"
                                data-ajax="{'url':'/cms/ajax/form/orders/edit/{{id}}','html':'#yongerorders modals'}"
                                class="d-inline">
                                <img src="/module/myicons/content-edit-pen.svg?size=24&stroke=323232">
                            </a>
                            <a href="javascript:" wb-disallow="content"
                                data-ajax="{'url':'/ajax/rmitem/orders/{{id}}','update':'cms.list.orders','html':'#yongerorders modals'}"
                                class="d-inline">
                                <img src="/module/myicons/trash-delete-bin.2.svg?size=24&stroke=323232"
                                    class="d-inline">
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