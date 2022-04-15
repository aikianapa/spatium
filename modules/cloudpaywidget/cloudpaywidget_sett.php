<html wb-allow="admin">
<h4 class="pb-3">Настройки CloudPayments Widget</h4>
<div class="formgroup row">
    <label class="form-control-label col-sm-4">Public ID</label>
    <div class="col-sm-8 mb-2">
        <input type="text" name="api_key" class="form-control" required>
        <small>Ключ API </small>
    </div>

    <label class="form-control-label col-sm-4">Private Key</label>
    <div class="col-sm-8 mb-2">
        <input type="text" name="prv_key" class="form-control">
        <small>Пароль для API</small>
    </div>

    <label class="form-control-label col-sm-4">Метод платежа</label>
    <div class="col-sm-8 mb-2">
        <select name="method" class="form-control wb-select2">
            <option value="charge">Одностадийный</option>
            <option value="auth">Двухстадийный</option>
        </select>
        <small>Метод платежа</small>
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

<div class="divider-text">Касса</div>

<div class="formgroup row">

    <label class="form-control-label col-sm-4">Модуль кассы (вкл/выкл) <meta wb="module=swico&name=kassa" class="form-control" /></label>
    <div class="col-sm-8 mb-2">
        &nbsp;
    </div>

    <label class="form-control-label col-sm-4">ИНН</label>
    <div class="col-sm-8 mb-2">
        <input type="text" name="inn" class="form-control">
        <small>ИНН привязанный к кассе</small>
    </div>

    <label class="form-control-label col-sm-4">Система налогообложения</label>
    <div class="col-sm-8 mb-2">
        <select name="taxation" class="form-control wb-select2">
            <option value="0">Общая система налогообложения</option>
            <option value="1">Упрощенная система налогообложения (Доход)</option>
            <option value="2">Упрощенная система налогообложения (Доход минус Расход)</option>
            <option value="3">Единый налог на вмененный доход</option>
            <option value="4">Единый сельскохозяйственный налог</option>
            <option value="5">Патентная система налогообложения</option>
        </select>
        <small>Система налогообложения</small>
    </div>
</div>

</html>