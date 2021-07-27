<html>
<div class="p-2">
    <form id="rep_cook">
    <h3>
        Отчёт по кухне
        <input type="datepicker" name="date" class="form-control d-inline" value='{{date("d.m.Y",strtotime({{date}}))}}' 
        wb-module="module=datetimepicker"
        data-ajax="{'url':'/orders/rep_cook','form':'#rep_cook','html':'.content-body'}">
    </h3>
    </form>

<ul class="pt-3">
<wb-foreach wb="from=result">
    <li class="list-group-item d-flex align-items-center">
  <img data-src="/thumb/80x80/src/{{image}}" class="wd-80 rounded-circle mg-r-15" alt="">
  <div>
    <h6 class="tx-13 tx-inverse tx-semibold mg-b-0">
        <a href="{{link}}">
        {{name}}
        </a>
    </h6>
    <span class="d-block tx-11 text-muted">Количество: {{qty}}</span>
  </div>
</li>
</wb-foreach>
</ul>


</div>

</html>