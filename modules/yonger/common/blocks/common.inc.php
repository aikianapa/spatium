<div class="pr-4 yonger-block-common">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group row">
                <label class="form-control-label col-md-5">{{_lang.name}}</label>
                <input type="text" class="form-control col-md-7" name="header" placeholder="{{_lang.name}}">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group row">
                <div class="col-12">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="active"
                            id="switchActive-{{_sess.order_id}}">
                        <label class="custom-control-label nobr"
                            for="switchActive-{{_sess.order_id}}">{{_lang.active}}</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="container"
                            id="switchContainer-{{_sess.order_id}}">
                        <label class="custom-control-label nobr"
                            for="switchContainer-{{_sess.order_id}}">{{_lang.container}}</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group row">
                <label class="form-control-label col-md-5">#id</label>
                <input type="text" class="form-control col-md-7" name="block_id" placeholder="id#">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group row">
                <label class="form-control-label col-md-5">.class</label>
                <input type="text" class="form-control col-md-7" name="block_class" placeholder=".class">
            </div>
        </div>

        <!--div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="form-control-label col-md-5">{{_lang.id}}</label>
                        <input type="text" class="form-control col-md-7" name="block_id" placeholder="{{_lang.id}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="form-control-label col-md-5">{{_lang.class}}</label>
                        <input type="text" class="form-control col-md-7" name="block_class"
                            placeholder="{{_lang.class}}">
                    </div>
                </div>
            </div>
        </div-->


    </div>
</div>


<wb-lang>
    [ru]
    name = "Название"
    id = "#ID"
    class = "Class"
    active = "Отображать блок"
    container = "В контейнере"
    template = Шаблон
</wb-lang>