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
</html>