<html>
<div class="modal fade effect-scale show removable" id="{{_form}}ModalEdit" data-backdrop="static" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-close wd-20" data-dismiss="modal" aria-label="Close"></i>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="active" id="{{_form}}SwitchItemActive" onchange="$('#{{_form}}ValueItemActive').prop('checked',$(this).prop('checked'));">
                    <label class="custom-control-label" for="{{_form}}SwitchItemActive">Активирован</label>
                </div>


            </div>
            <div class="modal-body pd-20">

                <form id="{{_form}}EditForm" autocomplete="off">
                    <input type="checkbox" class="custom-control-input" name="active" id="{{_form}}ValueItemActive">
                    <input type="hidden" name="_id" class="form-control" readonly placeholder="Идентификатор">

                    <div class="form-group row">
                        <div class="input-group col-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Наименование</span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Наименование" required>
                        </div>
                    </div>


                    <!-- required bootstrap js -->
                    <ul class="nav nav-tabs mb-2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#main">Описание</a>
                        </li>
                        <wb-foreach wb-json='["пн","вт","ср", "чт","пт","сб","вс"]' wb-tpl="false">
                            <li class="nav-item d-none">
                                <a class="nav-link" data-toggle="tab" href="#{{wbTranslit({{_val}})}}">{{_val}}</a>
                            </li>
                        </wb-foreach>
                    </ul>

                    <div class="tab-content">
                        <div id="main" class="container tab-pane active">
                            <div class="form-group row">
                                <div class="input-group col-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Кат-я</span>
                                    </div>
                                    <select name="category" class="form-control" required wb-tree="dict=menu-categories">
                                        <option value="{{id}}">{{name}}</option>
                                    </select>
                                </div>
                                <div class="input-group col-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Артикул</span>
                                    </div>
                                    <input type="text" name="articul" class="form-control" placeholder="Артикул" required>
                                </div>
                                <div class="input-group col-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger tx-white">Промо ₽</span>
                                    </div>
                                    <input type="text" name="promoprice" class="form-control" placeholder="Цена ₽" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Цена ₽</span>
                                    </div>
                                    <input type="text" name="price" class="form-control" placeholder="Цена ₽" required>
                                </div>
                                <div class="input-group col-sm-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Вес</span>
                                    </div>
                                    <input type="number" name="weight" class="form-control" placeholder="Вес (гр.)">
                                </div>
                                <p class="d-block d-sm-none p-1" />
                                <div class="input-group col-sm-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Калорийность</span>
                                    </div>
                                    <input type="number" name="kcal" class="form-control" placeholder="Калорийность (ккал.)">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="input-group col-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Белки</span>
                                    </div>
                                    <input type="text" name="proteins" class="form-control" placeholder="Белки">
                                </div>
                                <div class="input-group col-sm-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Жиры</span>
                                    </div>
                                    <input type="number" name="fats" class="form-control" placeholder="Жиры">
                                </div>
                                <p class="d-block d-sm-none p-1"></p>
                                <div class="input-group col-sm-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Углеводы</span>
                                    </div>
                                    <input type="number" name="carbs" class="form-control" placeholder="Углеводы">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <wb-module wb="{'module':'editor'}" name="text" />
                                </div>
                            </div>
                            <!--
                            <div class="divider-text">Состав</div>
                            <wb-multiinput name="components">
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="c_name" placeholder="Наименование" />
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" type="text" name="c_weight" placeholder="Вес" />
                                </div>
                            </wb-multiinput>
                            -->
                            <div class="divider-text">Изображения</div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <wb-module wb="{'module':'filepicker'}" name="images" />
                                </div>
                            </div>
                        </div>

                        <wb-var meals="{{getMealsJson()}}" />
                        <wb-foreach wb-json='["пн","вт","ср", "чт","пт","сб","вс"]' wb-tpl="false" wb-parent="true">
                            <wb-var day="{{wbTranslit({{_val}})}}" />
                            <div id="{{_var.day}}" class="container tab-pane fade">

                                <ul class="nav nav-tabs mb-2">
                                    <wb-foreach wb-tpl="false" wb-from="_var.meals">
                                        <wb-var active="active" wb-if="'{{_idx}}'=='0'" else=""/>
                                        <li class="nav-item">
                                            <a data-toggle="tab" class="nav-link {{_var.active}}" href="#Panel_{{_var.day}}_{{_key}}">{{_val}}</a>
                                        </li>
                                    </wb-foreach>
                                </ul>
                                <div class="tab-content">
                                    <wb-foreach wb-tpl="false" wb-from="_var.meals" wb-parent="true">
                                        <wb-var active="active show" wb-if="'{{_idx}}'=='0'" else="" />
                                        <div class="container tab-pane {{_var.active}}" id="Panel_{{_var.day}}_{{_key}}">
                                            <wb-multiinput name="{{_var.day}}.{{_key}}">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="input-group col-12">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Наименование</span>
                                                            </div>
                                                            <input type="text" name="food" class="form-control" placeholder="Наименование">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="input-group col-sm-6">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Вес</span>
                                                            </div>
                                                            <input type="number" name="weight" class="form-control" placeholder="Вес (гр.)">
                                                        </div>
                                                        <p class="d-block d-sm-none p-1"></p>
                                                        <div class="input-group col-sm-6">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Калорийность</span>
                                                            </div>
                                                            <input type="number" name="kcal" class="form-control" placeholder="Калорийность (ккал.)">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="input-group col-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Белки</span>
                                                            </div>
                                                            <input type="text" name="proteins" class="form-control" placeholder="Белки">
                                                        </div>
                                                        <div class="input-group col-sm-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Жиры</span>
                                                            </div>
                                                            <input type="number" name="fats" class="form-control" placeholder="Жиры">
                                                        </div>
                                                        <p class="d-block d-sm-none p-1"></p>
                                                        <div class="input-group col-sm-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Углеводы</span>
                                                            </div>
                                                            <input type="number" name="carbs" class="form-control" placeholder="Углеводы">
                                                        </div>
                                                    </div>
                                                    <div class="divider-text">Описание</div>
                                                    <wb-module wb="{'module':'editor'}" name="descr" />
                                                </div>
                                            </wb-multiinput>

                                            <!--
                                    <div class="divider-text">Состав</div>
                                    <wb-multiinput name="components">
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="c_name"
                                                placeholder="Наименование" />
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control" type="text" name="c_weight" placeholder="Вес" />
                                        </div>
                                    </wb-multiinput>
-->
                                            <div class="divider-text">Изображения</div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <wb-module wb="{'module':'filepicker'}" name="{{_var.day}}.{{_key}}_images" />
                                                </div>
                                            </div>
                                        </div>
                                    </wb-foreach>
                                </div>
                            </div>
                        </wb-foreach>
                    </div>
                </form>
            </div>
            <div class="modal-footer pd-x-20 pd-b-20 pd-t-0 bd-t-0">
                <wb-include wb="{'form':'common_formsave.php'}" />
            </div>
        </div>
    </div>
</div>
<script>
    var $form = $('#{{_form}}EditForm');
    $form.find('[name=category]').off('change');
    $form.find('[name=category]').on('change', function() {
        if ($(this).val() == 'main') {
            $form.children('.nav-tabs').find('.nav-item:not(:first-child)').removeClass('d-none');
        } else {
            $form.children('.nav-tabs').find('.nav-item:not(:first-child)').addClass('d-none');
        }
    }).trigger('change');
</script>

</html>