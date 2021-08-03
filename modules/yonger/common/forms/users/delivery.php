<html>
<div class="myaccount-content">
    <h3>Мои доставки</h3>
    <div class="d-block" id="deliveryCalendar" data-order="{{_var.order_id}}">
        <wb-foreach wb="render=client" wb-ajax="/cms/ajax/form/users/delivery_list">
            <div class="position-relative day {{status}}" data-date="{{date}}">
                <p class="text-center">
                    <b>{{n}}</b>
                    <br>
                    <span>{{d}} {{m}}</span>
                    {{ orders.lenth }}
                </p>
                <div class="position-absolute" data-tooltip="Отложить доставку" style="bottom:5px;right:5px;">
                    <i class="fa fa-close text-danger"></i>
                </div>
            </div>
        </wb-foreach>
    </div>
</div>

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