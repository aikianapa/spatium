<html>
<div class="p-4">
    <form id="rep_clients">
      <div class="row tx-24">
        <div class="col">
            <div class="input-group">
            <div class="input-group-prepend">
                        <span class="input-group-text tx-18 tx-medium">Отчёт по клиентам</span>
                    </div>

                <input type="datepicker" name="date" class="form-control d-inline"
                    value='{{date("d.m.Y",strtotime({{date}}))}}' wb-module="module=datetimepicker"
                    data-ajax="{'url':'/orders/rep_clients','form':'#rep_clients','html':'.content-body'}">
                <div class="input-group-append">
                    <span class="input-group-text cursor-pointer" onclick="wbapp.print('rep_clients')">
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
                                <p class="tx-12">
                                    {{user.first_name}} {{user.last_name}}
                                    <nobr>{{wbPhoneFormat({{user.phone}})}}</nobr>
                                    <br>
                                    {{user.delivery_address}}
                                </p>

                        </h6>
                        <wb-foreach wb="from=list">
                            <img data-src="/thumbc/80x80/src/{{image}}" class="img wd-50 ht-50 rounded-circle" alt="">
                        </wb-foreach>

                    </div>
                    <div class="w-75">
                        <ul>
                            <wb-var tsum="0" />
                            <wb-foreach wb="from=list">
                                <li class="list-group-item d-flex align-items-center tx-11 p-1">
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
    <p class="tx-bold">Всего клиентов: {{count({{result}})}}</p>
    </form>

</div>

</html>