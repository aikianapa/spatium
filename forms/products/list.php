<html>
<div class="m-3" id="yongerSpace">
        <nav class="nav navbar navbar-expand-md col">
        <h3 class="tx-bold tx-spacing--2 order-1">Продукция</h3>
        <div class="ml-auto order-2 float-right">
        <a href="#" data-ajax="{'url':'/cms/ajax/form/{{_form}}/edit/_new','html':'#yongerSpace modals'}" class="btn btn-primary">
            <img src="/module/myicons/24/FFFFFF/item-select-plus-add.svg" width="24" height="24" /> Добавить
        </a>
        </div>
    </nav>
    
    <table class="table table-striped table-hover tx-15">
            <thead>
                <tr>
                    <td>Артикул</td>
                    <td>Наименование</td>
                    <td class="text-right">Действия</td>
                </tr>
            </thead>
            <tbody id="{{_form}}List">
                <wb-foreach wb="{'ajax':'/api/query/{{_form}}/',
                            'render':'server',
                            'bind':'cms.list.{{_form}}',
                            'sort':'date:d',
                            'size':'{{_sett.page_size}}',
                            'filter': {'_site':'{{_sett.site}}'}
                }">
                    <tr class="bg-transparent">
                        <td class="w-25">
                            {{articul}}
                        </td>
                        <td data-ajax="{'url':'/cms/ajax/form/{{_form}}/edit/{{_id}}','html':'#yongerSpace modals'}">
                            {{name}}
                        </td>
                        <td class="text-right">
                            <div class="custom-control custom-switch d-inline">
                                <input type="checkbox" class="custom-control-input" name="active"
                                    id="{{_form}}SwitchItemActive{{_idx}}"
                                    onchange="wbapp.save($(this),{'table':'{{_form}}','id':'{{_id}}','field':'active','silent':true})">
                                <label class="custom-control-label"
                                    for="{{_form}}SwitchItemActive{{_idx}}">&nbsp;</label>
                            </div>
                            <a href="javascript:"
                                data-ajax="{'url':'/cms/ajax/form/{{_form}}/edit/{{_id}}','update':'cms.list.{{_form}}','html':'#yongerSpace modals'}"
                                class=" d-inline"><img src="/module/myicons/24/323232/content-edit-pen.svg" width="24"
                                    height="24"></a>
                            <a href="javascript:"
                                data-ajax="{'url':'/ajax/rmitem/{{_form}}/{{_id}}','update':'cms.list.{{_form}}','html':'#yongerSpace modals'}"
                                class=" d-inline"><img src="/module/myicons/24/323232/trash-delete-bin.2.svg" width="24"
                                    height="24"></a>
                        </td>
                    </tr>
                </wb-foreach>
            </tbody>
        </table>
    <modals></modals>
</html>