<html>
<div class="p-4">
    <form id="rep_orders">
        <div class="row tx-24">
            <div class="col">
                <div class="input-group">
                <div class="input-group-prepend">
                        <span class="input-group-text tx-18 tx-medium">Отчёт по заказам</span>
                    </div>
                    <input type="datepicker" name="date" class="form-control d-inline"
                        value='{{date("d.m.Y",strtotime({{date}}))}}' wb-module="module=datetimepicker"
                        data-ajax="{'url':'/orders/rep_orders','form':'#rep_orders','html':'.content-body'}">
                    <div class="input-group-append">
                        <span class="input-group-text cursor-pointer" onclick="wbapp.print('rep_orders')">
                            <svg class="mi mi-printer-print-button-circle" wb-module="myicons"></svg>
                        </span>
                        <span class="input-group-text cursor-pointer" onclick="$('[name=date]').trigger('change')">
                            <svg class="mi mi-refresh-loading-circle" wb-module="myicons"></svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <ul class="pt-3">
            <wb-foreach wb="from=result">
                <li class="list-group-item d-flex align-items-center">
                    <div class="w-25">
                        <h6 class="tx-13 tx-inverse tx-semibold mg-b-0">
                            <a href="{{link}}">
                                Заказ № {{number}} / {{wbDate("d.m.Y",{{date}})}}
                            </a>
                            <wb-data wb="table=users&item={{user}}">
                                <p class="tx-12">
                                    {{first_name}} {{last_name}}
                                    <nobr>{{wbPhoneFormat({{phone}})}}</nobr>
                                    <br>
                                    {{delivery_address}}
                                </p>
                            </wb-data>
                        </h6>
                        <wb-foreach wb="from=list">
                            <img data-src="/thumbc/80x80/src/{{image}}" class="img wd-50 ht-50 rounded-circle" alt="" wb-if="'{{active}}'=='on'">
                        </wb-foreach>

                    </div>
                    <div class="w-75">
                        <ul>
                            <wb-var tsum="0" />
                            <wb-foreach wb="from=list" __wb-filter="active=on">
                                <wb-var wb-if="'{{active}}'!=='on'" stroke='tx-danger stroke' else='' />
                                <li class="list-group-item d-flex align-items-center tx-11 p-1 {{_var.stroke}}">
                                    <span class="d-flex mr-10">{{name}}</span>
                                    <span class="ml-auto w-25 text-right">
                                        <div class="row">
                                            <div class="col-4 text-right">{{price}}₽</div>
                                            <div class="col-4 text-right">x&nbsp;{{qty}}шт.</div>
                                            <div class="col-4 text-right">{{qty * price}}₽</div>
                                        </div>
                                    </span>
                                </li>
                                <wb-var tsum="{{ _var.tsum*1 + {{qty*price}} }}" />
                            </wb-foreach>
                            <li class="list-group-item d-flex align-items-center tx-medium tx-11 p-1">
                                <span class="d-flex mr-10"></span>
                                <span class="ml-auto w-25 text-right">
                                    <div class="row">
                                        <div class="col-4 text-right">Итого:</div>
                                        <div class="col-4 text-right">&nbsp;&nbsp;{{total.qty}}шт.</div>
                                        <div class="col-4 text-right">{{_var.tsum}}₽</div>
                                    </div>
                                </span>
                            </li>
                        </ul>
                    </div>
                </li>
                <wb-empty>
                    <li class="list-unstyled alert alert-info">
                        Пусто
                    </li>
                </wb-empty>
            </wb-foreach>
        </ul>
        <p class="tx-bold">Всего заказов: {{count({{result}})}}</p>
    </form>

</div>

</html>