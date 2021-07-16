<html>
<div class="modal fade effect-scale show removable" id="{{_form}}ModalEdit" data-backdrop="static" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-close wd-20" data-dismiss="modal" aria-label="Close"></i>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="active" id="{{_form}}SwitchItemActive"
                        onchange="$('#{{_form}}ValueItemActive').prop('checked',$(this).prop('checked'));">
                    <label class="custom-control-label" for="{{_form}}SwitchItemActive">Активирован</label>
                </div>


            </div>
            <div class="modal-body pd-20">

                <form id="{{_form}}EditForm" autocomplete="off">
                    <input type="checkbox" class="custom-control-input" name="active" id="{{_form}}ValueItemActive">
                    <input type="hidden" name="_id" class="form-control" readonly placeholder="Идентификатор">

                    <div class="form-group row">
                    <div class="input-group col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Артикул</span>
                            </div>
                            <input type="text" name="articul" class="form-control" placeholder="Артикул" required>
                        </div>
                        <div class="input-group col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Наименование</span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Наименование" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="input-group col-sm-6 col-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Вес</span>
                            </div>
                            <input type="number" name="weight" class="form-control" placeholder="Вес (гр.)">
                        </div>
                        <p class="d-block d-sm-none p-1" />
                        <div class="input-group col-sm-6 col-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Калорийность</span>
                            </div>
                            <input type="number" name="kcal" class="form-control" placeholder="Калорийность (ккал.)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <wb-module wb="{'module':'jodit'}" name="text" />
                        </div>
                    </div>
                    <div class="divider-text">Изображения</div>
                    <div class="form-group row">
                        <div class="col-12">
                            <wb-module wb="{'module':'filepicker'}" name="images" />
                        </div>
                    </div>
                    <div class="divider-text">Состав</div>
                    <wb-multiinput name="components">
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="c_name" placeholder="Наименование" />
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="c_weight" placeholder="Вес" />
                        </div>
                    </wb-multiinput>
                </form>
            </div>
            <div class="modal-footer pd-x-20 pd-b-20 pd-t-0 bd-t-0">
                <wb-include wb="{'form':'common_formsave.php'}" />
            </div>
        </div>
    </div>
</div>

</html>