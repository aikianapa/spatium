<html>
<div class="modal effect-scale show removable" id="modalPagesEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <wb-var order_id="{{id}}" />
            <div class="modal-header">
                <div class="col-5">
                    <h5>Заказ № {{number}}</h5>
                </div>
                <i class="fa fa-close r-20 position-absolute cursor-pointer" data-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body pd-20">
                <wb-include wb-tpl="orderlist.php" />
            </div>
        </div>
    </div>
</div>
</html>