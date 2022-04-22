<edit header="Блок Promo">
    <div>
        <wb-module wb="module=yonger&mode=edit&block=common.inc" />
    </div>

    <div class="form-group row">
        <label class="col-lg-4 form-control-label">Текст</label>
        <div class="col-lg-8">
            <textarea name="text" class="form-control" rows="auto" placeholder="Текст"></textarea>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-4">
            <label class="form-control-label">Кнопка</label>
            <input type="text" name="button" class="form-control" placeholder="Кнопка">
        </div>

        <div class="col-lg-4">
            <label class="form-control-label">Цвет</label>
            <select name="color" class="form-control">
                <wb-foreach wb="render=server&tpl=false" wb-json='["success","primary","secondary","danger","warning"]'>
                    <option value="{{_val}}">{{_val}}</option>
                </wb-foreach>
            </select>
        </div>
    </div>
    <div class="col-12">
        <label class="form-control-label">Фоновое изображение</label>
        <wb-module wb="module=filepicker&mode=single" name="bkg" wb-path="/assets/images/backgrounds/" wb-ext="webp,jpg,png,jpeg,svg" />
    </div>
</edit>

<view>
        <wb-var uspr="{{_sess.user.promo}}" wb-if="'{{_sess.user.promo}}'>' '" else='[]' />
        <wb-var bkg="{{bkg.0.img}}" />
        <section>
        <wb-foreach wb="{
                'ajax':'/api/v2/list/products',
                'tpl':'false',
                'rand':'true',
                'limit':'1',
                'filter' : {
                    'active':'on',
                    'category':'main',
                    'promoprice':{'$gt':'0'},
                    'id':{'$nin':{{_var.uspr}}}
                } 
            }">
            <div class="parallax d-flex ht-sm-50v" data-img="{{_var.bkg}}">
                <div class="position-absolute d-block wd-100v ht-100v op-7 bg-black-8">&nbsp;</div>
                <div class="parallax-overlay row justify-content-center">
                    <div class="col-sm-8 text-center text-center text-white">
                        <h1 class="text-white tx-light py-4 tx-50">
                            {{_parent.header}}
                        </h1>
                        <p class="tx-20">
                            {{_parent.text}}
                        </p>
                        <h6 class="text-white tx-light py-4 tx-20">{{name}} — <span class="tx-semibold">{{promoprice}}₽</span></h6>
                        <a href="javascript:void(0);" data-id="{{id}}" data-name="{{name}}" data-price="{{promoprice}}" data-image="{{_var.bkg}}" data-days="1" data-promo="1" data-discounts="{}" data-promo="1" data-link="/products/{{id}}/{{wbUrlOnly({{name}})}}" class="__mod-cart-add mod-cart-data btn btn-promo btn-{{_parent.color}}  rounded-30 tx-light pd-x-40 pd-y-15">
                            {{_parent.button}}
                            <img src="/module/myicons/shopping-cart.svg?size=26&stroke=FFFFFF" width="26" height="26">
                        </a>
                    </div>
                </div>
            </div>
        </wb-foreach>
    </section>
</view>

<edit-old header="Блок Promo">
    <div>
        <wb-module wb="module=yonger&mode=edit&block=common.inc" />
    </div>

    <div class="form-group row">
        <label class="col-lg-4 form-control-label">Текст</label>
        <div class="col-lg-8">
            <textarea name="text" class="form-control" rows="auto" placeholder="Текст"></textarea>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-lg-8">
            <label>Продукт</label>
            <select class="form-control" name="product">
                <wb-foreach wb="table=products&tpl=false" wb-filter="active=on&category=main">
                    <option value="{{id}}">{{name}}</option>
                </wb-foreach>
            </select>
        </div>
        <div class="col-lg-4">
            <label for="my-select">Дней</label>
            <input class="form-control" type="number" name="days">
        </div>
    </div>


    <div class="form-group row">
        <div class="col-lg-4">
            <label for="my-select">Промо-цена/день</label>
            <input class="form-control" type="number" name="price">
        </div>

        <div class="col-lg-4">
            <label class="form-control-label">Кнопка</label>
            <input type="text" name="button" class="form-control" placeholder="Кнопка">
        </div>

        <div class="col-lg-4">
            <label class="form-control-label">Цвет</label>
            <select name="color" class="form-control">
                <wb-foreach wb="render=server&tpl=false" wb-json='["success","primary","secondary","danger","warning"]'>
                    <option value="{{_val}}">{{_val}}</option>
                </wb-foreach>
            </select>
        </div>
        <div class="col-12">
            <label class="form-control-label">Фоновое изображение</label>
            <wb-module wb="module=filepicker&mode=single" name="bkg" wb-path="/assets/images/backgrounds/" wb-ext="webp,jpg,png,jpeg,svg" />
        </div>
    </div>

    <div class="alert alert-info">
        Смотри в /blocks/promo.php
    </div>
</edit-old>

<view-old>
    <section>
        <div class="parallax d-flex ht-sm-50v" data-img="{{bkg.0.img}}">
            <div class="position-absolute d-block wd-100v ht-100v op-7 bg-black-8">&nbsp;</div>
            <div class="parallax-overlay row justify-content-center">
                <div class="col-sm-8 text-center text-center text-white">
                    <h1 class="text-white tx-light py-4 tx-50">
                        {{header}}
                    </h1>
                    <p class="pb-4 tx-20">
                        {{text}}
                    </p>
                    <wb-data wb="table=products&item={{product}}">
                        <a href="javascript:void(0);" data-id="{{id}}" data-name="{{name}}" data-price="{{_parent.price}}" data-image="{{images.0.img}}" data-days="{{_parent.days}}" data-discounts="{}" data-promo="1" data-link="/products/{{id}}/{{wbUrlOnly({{name}})}}" class="mod-cart-add mod-cart-data btn btn-{{_parent.color}}  rounded-30 tx-light pd-x-40 pd-y-15">
                            {{_parent.button}}
                            <img src="/module/myicons/shopping-cart.svg?size=26&stroke=FFFFFF" width="26" height="26">
                        </a>
                    </wb-data>
                </div>
            </div>
        </div>
    </section>
</view-old>