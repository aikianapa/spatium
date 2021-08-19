<html>
<div class="p-4">
    <form id="rep_cook">
      <div class="row tx-24">
        <div class="col">
            <div class="input-group">
            <div class="input-group-prepend">
                        <span class="input-group-text tx-18 tx-medium">Отчёт по кухне</span>
                    </div>

                <input type="datepicker" name="date" class="form-control d-inline"
                    value='{{date("d.m.Y",strtotime({{date}}))}}' wb-module="module=datetimepicker"
                    data-ajax="{'url':'/orders/rep_cook','form':'#rep_cook','html':'.content-body'}">
                <div class="input-group-append">
                    <span class="input-group-text cursor-pointer" onclick="wbapp.print('rep_cook')">
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
                <img data-src="/thumbc/80x80/src/{{image}}" class="wd-80 rounded-circle mg-r-15" alt="">
                <div>
                    <h6 class="tx-13 tx-inverse tx-semibold mg-b-0">
                        <a href="{{link}}">
                            {{name}}
                        </a>
                    </h6>
                    <span class="d-block tx-11 text-muted">Количество: {{qty}}</span>
                </div>
            </li>
            <wb-empty>
                <li class="list-unstyled alert alert-info">
                    Пусто
                </li>
            </wb-empty>
        </wb-foreach>
    </ul>
    </form>

</div>

</html>