<html>
<div class="m-3" id="yongerSpace">
    <nav class="nav navbar navbar-expand-md col">
        <h3 class="tx-bold tx-spacing--2 order-1">Продукция</h3>
        <div class="ml-auto order-2 float-right">
            <a href="#" data-ajax="{'url':'/cms/ajax/form/{{_form}}/edit/_new','html':'#yongerSpace modals'}"
                class="btn btn-primary">
                <img src="/module/myicons/24/FFFFFF/item-select-plus-add.svg" width="24" height="24" /> Добавить
            </a>
        </div>
    </nav>


    <div class="yonger-nested mb-1">
        <span class="bg-light">
            <div class="header p-2">
                <span class="row">
                    <div class="col-6">
                    <input class="form-control" type="search" placeholder="Поиск..."
                    data-ajax="{'target':'#{{_form}}List',
                    'filter_add':{'$or':[
                        { 'name': {'$like' : '$value'} }, 
                        { 'articul': {'$like' : '$value'} }
                    ]} }">
                    </div>
                    <div class="col-6">
                    <select name="category" class="form-control" placeholder="Категория" wb-tree="dict=menu-categories" 
                    data-ajax="{'target':'#{{_form}}List','filter_add':{ 'category': '$value' } }">
                        <option value="{{id}}">{{name}}</option>
                    </select>
                    </div>

                </span>
            </div>
        </span>


        <table class="table table-striped table-hover tx-15">
            <thead>
                <tr>
                    <td></td>
                    <td>Наименование</td>
                    <td>Артикул</td>
                    <td>Цена</td>
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
                        <td>
                            <div class="avatar">
                                <img data-src="/thumbc/50x50/src{{images.0.img}}" class="rounded">
                            </div>
                        </td>
                        <td class="cursor-pointer tx-medium w-50"
                            data-ajax="{'url':'/cms/ajax/form/{{_form}}/edit/{{_id}}','html':'#yongerSpace modals'}">
                            {{name}}
                            <div wb-tree="dict=menu-categories&branch={{category}}&children=false">
                                <span class="tx-10">{{name}}</span>
                            </div>
                        </td>
                        <td>
                            {{articul}}
                        </td>
                        <td>
                            <div>{{price}}</div>
                            <div class="tx-danger tx-11" wb-if="'{{promoprice}}'>''">{{promoprice}}</div>
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
                            <a href="javascript:" wb-disallow="content"
                                data-ajax="{'url':'/ajax/rmitem/{{_form}}/{{_id}}','update':'cms.list.{{_form}}','html':'#yongerSpace modals'}"
                                class=" d-inline"><img src="/module/myicons/24/323232/trash-delete-bin.2.svg" width="24"
                                    height="24"></a>
                        </td>
                    </tr>
                </wb-foreach>
            </tbody>
        </table>
    </div>
    <modals></modals>

</html>