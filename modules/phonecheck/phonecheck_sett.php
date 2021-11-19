<html wb-allow="admin">
    <h4 class="pb-3">Настройки SMStarget</h4>
    <div class="formgroup row">
        <label class="form-control-label col-sm-4">Логин</label>
        <div class="col-sm-8">
            <input type="text" name="login" class="form-control">
            <small>Имя пользователя в targetsms.ru</small>
        </div>
        <label class="form-control-label col-sm-4">Пароль</label>
        <div class="col-sm-8">
            <input type="text" name="pass" class="form-control">
            <small>Пароль в targetsms.ru</small>
        </div>
        <label class="form-control-label col-sm-4">Отправитель</label>
        <div class="col-sm-8">
            <input type="text" name="sender" class="form-control">
            <small>Имя отправителя зарегистрированного в targetsms.ru</small>
        </div>
        <label class="form-control-label col-sm-4">Текст авторизации</label>
        <div class="col-sm-8">
            <input type="text" name="text" class="form-control">
            <small>Короткий текст перед кодом</small>
        </div>
        <label class="form-control-label col-sm-4">Тестовый режим</label>
        <div class="col-sm-8">
            <wb-module wb="module=switch" name="testmode" />
            <small>SMS не отправляются</small>
        </div>
    </div>
</html>