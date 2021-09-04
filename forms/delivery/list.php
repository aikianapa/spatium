<html>
<script wb-app remove>
wbapp.on('wb-render-done', function(data, target) {
    if (target == '#deliveryCalendar') {
        setTimeout(function() {
            $("#deliveryCalendar").disableSelection();
            $("#deliveryCalendar .day.empty .product-icon").draggable();
            $("#deliveryCalendar .day.empty").droppable({
                drop: function(event, ui) {
                    let $day = $(event.target);
                    let $prd = $(ui.draggable);
                    let date_to = $day.data('date');
                    let date_from = $prd.parents('.day').data('date');
                    let prod = $prd.data('prod');
                    let dti = 'd' + str_replace('-', '', date_to);
                    let dfi = 'd' + str_replace('-', '', date_from);

                        wbapp.post(
                            '/cms/ajax/form/users/delivery_change?uid={{_post.formdata.uid}}', {
                                'from': date_from,
                                'to': date_to,
                                'prod': prod
                            },
                            function(data) {
                                wbapp.storage('cms.list.delivery', data);
                            })

                }
            });
        }, 0);
    }
})
$('#rep_delivery_users').on('select2:select', function(e) {
    wbapp.ajax({
        'url': '/cms/ajax/form/delivery/list',
        'form': '#rep_delivery',
        'html': '.content-body'
    });
});

$(document).undelegate('#deliveryCalendar .day .btn-delivery', wbapp.evClick);
$(document).delegate('#deliveryCalendar .day .btn-delivery', wbapp.evClick, function(ev) {
    var type = null;
    var $that = $(this).parents('.day');
    if ($that.hasClass('wait')) return;
    if ($that.hasClass('past')) return;
    if ($that.hasClass('empty')) type = 'empty';
    if ($that.hasClass('deny')) type = 'deny';
    if (type) {
        $that.addClass('wait');
        var date = $that.data('date');
        var tid = '#deliveryCalendar';
        wbapp.post('/cms/ajax/form/users/delivery_decline?uid={{_req.formdata.uid}}', {
            type: type,
            date: date
        }, function(data) {
            $that.removeClass('wait');
            wbapp.render(tid, {
                'result': data
            });
        })
    }
    ev.stopPropagation();
});
</script>

<div class="p-3" wb-allow="manager admin">
    <form id="rep_delivery">
        <h3>Доставки</h3>
            <div class="input-group mb-2">
                <div class="col-4 col-sm-3 p-0 input-group-prepend">
                    <span class="w-100 input-group-text  bg-black-6 tx-white">Поиск...</span>
                </div>
                <div class="form-control p-0 m-0 bd-0">
                    <select id="rep_delivery_users" name="uid" wb-select2 placeholder="">
                        <wb-foreach wb="from=users">
                            <option value="{{id}}">{{first_name}} {{last_name}} {{phone}}</option>
                        </wb-foreach>
                    </select>
                </div>
            </div>

                <wb-data wb-if="'{{_post.formdata.uid}}'>''" wb="table=users&item={{_post.formdata.uid}}">

                    <div class="input-group mb-2">
                        <div class="col-4 col-sm-3 p-0 input-group-prepend">
                            <span class="w-100 input-group-text">Клиент</span>
                        </div>
                        <input class="form-control bg-white" type="text" value="{{first_name}} {{last_name}}" readonly>
                    </div>

                    <div class="input-group mb-2">
                        <div class="col-4 col-sm-3 p-0 input-group-prepend">
                            <span class="w-100 input-group-text">Телефон</span>
                        </div>
                        <input class="form-control bg-white" type="text" value="{{phone}}" readonly>
                    </div>

                    <div class="input-group mb-2">
                        <div class="col-4 col-sm-3 p-0 input-group-prepend">
                            <span class="w-100 input-group-text">Адрес</span>
                        </div>
                        <textarea class="form-control bg-white" type="text" name="delivery_address" readonly></textarea>
                    </div>
                </div>
            
        <div wb-if="'{{_post.formdata.uid}}' > ''" class="p-3">
            <ul class="list-group pd-b-50" id="deliveryCalendar" data-order="{{_var.order_id}}" unselectable="on">
                <wb-foreach wb="render=client&bind=cms.list.delivery"
                    wb-ajax="/cms/ajax/form/users/delivery_list?uid={{_post.formdata.uid}}">
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
                            <div class=" card p-1 tx-center">
                            <b class="d-block position-relative">{{n}}</b>
                            <span>{{d}} {{m}}</span>
                            </div>
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
                                        <img src="/thumbc/100x100/src{{image}}" class="rounded" alt="{{name}}">
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
    </form>
</div>

<style wb-module="scss">
#rep_delivery_users+.select2 .select2-selection--single {
    border-radius: 0 0.25rem 0.25rem 0 !important;
}

#deliveryCalendar {
    .day {
        border: 1px var(--light) solid;

        &.wait {
            opacity: 0.5;
            cursor: wait;
        }

        &.past {
            background-color: #ffffff;
        }

        &.empty {
            background-color: #f5ffdf;

            &.ui-droppable-hover {
                background-color: var(--light) !important;
                border: 1px var(--success) dashed;
                margin-bottom: 0;

            }
        }

        &.deny {
            background-color: #ffd4d4;
        }

        .btn-delivery {
            cursor: pointer;
        }

        .product-icon {
            &.ui-draggable-handle.ui-draggable-dragging {
                z-index: 99999;
                background-color: white;

                .badge {
                    display: none;
                }
            }

            img {
                border: 1px var(--gray) solid;
                cursor: move;

                &:hover {
                    box-shadow: 0px 0px 3px var(--success);
                    border: 1px var(--success) solid;
                }
            }
        }
    }
}
</style>

</html>