<html>
<script wb-app remove>
wbapp.on('wb-render-done', function(data,target) {
    if (target == '#deliveryCalendar') {
        setTimeout(function() {
            $("#deliveryCalendar  .day.empty .product-icon").draggable();
            $("#deliveryCalendar").disableSelection();
            $("#deliveryCalendar .day.empty").droppable({
                drop: function(event, ui) {
                    let $day = $(event.target);
                    let $prd = $(ui.draggable);
                    let date_to = $day.data('date');
                    let date_from = $prd.parents('.day').data('date');
                    let prod = $prd.data('prod');
                    let dti = 'd'+str_replace('-','',date_to);
                    let dfi = 'd'+str_replace('-','',date_from);
                    wbapp.post('/cms/ajax/form/users/delivery_change',{'from':date_from,'to':date_to,'prod':prod},function(data){
                        wbapp.storage('cms.list.delivery',data);
                    })
                }
            });
        }, 0)
    }
})
</script>

<div class="myaccount-content">
    <h3>Мои доставки</h3>
    <ul class="list-group pd-b-50" id="deliveryCalendar" data-order="{{_var.order_id}}" unselectable="on">
        <wb-foreach wb="render=client&bind=cms.list.delivery" wb-ajax="/cms/ajax/form/users/delivery_list">
            <li class="list-group-item d-flex day {{status}}" data-date="{{date}}">
                {{#if status == 'empty'}}
                <div class="position-absolute t-5 r-5 btn-delivery z-index-10" title="Отложить доставку"
                    style="bottom:5px;right:5px;">
                    <img data-src="/module/myicons/delivery-truck-cancel.svg?size=24&stroke=dc3545">
                </div>
                {{/if}}
                {{#if status == 'deny'}}
                <div class="position-absolute t-5 r-5 btn-delivery z-index-10" title="Вернуть доставку"
                    style="bottom:5px;right:5px;">
                    <img data-src="/module/myicons/delivery-truck-checkmark.svg?size=24&stroke=10b759">
                </div>
                {{/if}}
                <div class="wd-60 mg-r-15" alt="">
                    <b class="d-block position-relative">{{n}}</b>
                    <span>{{d}} {{m}}</span>
                </div>
                <div class="row wd-100p">
                    {{#if status != 'deny'}}
                    <div class="col-sm-3 col-md-2">
                        <h6 class="tx-13 tx-inverse tx-semibold mg-b-0">Заказы:</h6>
                        {{#each orders, @index as i }}
                        <a href="javascript:void(0)" class="d-inline d-sm-block tx-13 text-muted"
                            data-ajax="{'url':'/cms/ajax/form/orders/view/{{id}}','html':'modal'}">
                            № {{number}}
                        </a>
                        {{/each}}
                    </div>
                    <div class="col-sm-9 col-md-10">
                        <h6 class="tx-13 tx-inverse tx-semibold mg-b-0">Продукты:</h6>
                        {{#each products, @index as i }}
                        <span class="d-block-inline tx-13 text-muted">
                            {{#if i !== 0}}, {{/if}}
                            {{name}} ({{qty}}шт.)
                        </span>
                        {{/each}}
                        <div>
                            {{#each products}}
                            <div class="avatar avatar-xl product-icon d-inline-block mr-1" data-prod="{{_id}}">
                                {{#if image !== ""}}
                                    <img src="/thumbc/100x100/src{{image}}" width="100" height="100" class="rounded" alt="{{name}}">
                                {{else}}
                                    <img data-src="/module/myicons/asian-food.1.svg?size=100&stroke=7987a1" width="100" height="100" class="rounded" alt="{{name}}">
                                {{/if}}
                                <span
                                    class="badge badge-success position-absolute rounded-circle tx-10 l-0 b-0">x{{qty}}</span>
                            </div>
                            {{/each}}
                        </div>
                    </div>
                    {{else}}
                    <div class="col">
                        На этот день доставка отменена
                    </div>
                    {{/if}}
                </div>
            </li>
        </wb-foreach>
    </ul>
</div>

<div class="alert alert-info">
<p>Если вы  хотите  перенести доставку  на другой день нажмите на значок <img data-src="/module/myicons/delivery-truck-checkmark.svg?size=24&stroke=dc3545"> и доставка сдвинется на следующий день. Чтобы вернуть отменённую доставку, нажмите на значёк <img data-src="/module/myicons/delivery-truck-checkmark.svg?size=24&stroke=10b759">.  Данную процедуру можно повторять неоднократно, пока доставка не попадет на нужный вам день.</p>


</div>


<tpl class="d-none">
    <div class="position-relative day {{status}}" data-date="{{date}}">
        <p class="text-center">
            <b>{{n}}</b>
            <br>
            <span>{{d}} {{m}}</span>
        </p>
        {{#if status == 'empty'}}
        <div class="position-absolute" title="Отложить доставку" style="bottom:5px;right:5px;">
            <i class="fa fa-close tx-danger"></i>
        </div>
        {{/if}}
        {{#if status == 'deny'}}
        <div class="position-absolute" title="Вернуть доставку" style="bottom:5px;right:5px;">
            <i class="fa fa-check tx-white"></i>
        </div>
        {{/if}}
    </div>
</tpl>


<div class="modal" tabindex="-1" id="modalRight">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">В этой доставке вы получите</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="shop-product-wrap grid row no-gutters mb-35" id="modalProdList">
                    <template>
                        {{#each result}}
                        {{#if active == "on"}}
                        <div class="col-lg-4 col-md-6 col-12">
                            <!--=======  Grid view product  =======-->

                            <div class="gf-product shop-grid-view-product">
                                <div class="image">
                                    <a href="{{link}}">
                                        <img data-src="/thumb/359x359/src/{{image}}" class="img-fluid" alt="{{name}}">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3 class="product-title"><a href="{{link}}">{{name}}</a></h3>
                                    <div class="price-box">
                                        <span class="sale-price">{{qty}} шт.</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{/if}}
                        {{/each}}
                    </template>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

</html>