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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Заголовок модального окна</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Тут будет содержимое доставки.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

</html>