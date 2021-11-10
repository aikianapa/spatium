<html wb-allow="admin">
    <h4 class="pb-3">Настройки CloudPayments Widget</h4>
    <div class="formgroup row">
        <label class="form-control-label col-sm-4">Public ID</label>
        <div class="col-sm-8 mb-2">
            <input type="text" name="api_key" class="form-control" required>
            <small>Ключ API</small>
        </div>
        <label class="form-control-label col-sm-4">Валюта</label>
        <div class="col-sm-8 mb-2">
            <input type="text" name="currency" class="form-control" value="RUB" required>
            <small>Валюта платежа</small>
        </div>
        <label class="form-control-label col-sm-4">Описание платежа</label>
        <div class="col-sm-8 mb-2">
            <input type="text" name="description" class="form-control">
            <small>Описание платежа (необязательно)</small>
        </div>
        <label class="form-control-label col-sm-4">Идентификатор аккаунта</label>
        <div class="col-sm-8 mb-2">
            <input type="text" name="acc_id" class="form-control">
            <small>Идентификатор аккаунта (необязательно)</small>
        </div>
        <label class="form-control-label col-sm-4">Стиль виджета</label>
        <div class="col-sm-8 mb-2">
            <select name="skin" class="form-control wb-select2">
                <option value="classic">Классик</option>
                <option value="modern">Модерн</option>
                <option value="mini">Мини</option>
            </select>
            <small>Описание платежа (необязательно)</small>
        </div>

    </div>
</html>