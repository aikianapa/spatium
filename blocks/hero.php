<edit header="Верхняя картинка">
    <div class="alert alert-info">
        Смотри в /blocks/hero.php
    </div>
    <div>
<wb-module wb="module=yonger&mode=edit&block=common.inc" />
    </div>
    <div class="form-group row">
        <label class="col-lg-3 form-control-label">Текст</label>
        <div class="col-lg-9">
            <textarea name="text" class="form-control" rows="auto" placeholder="Текст"></textarea>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-4">
            <label class="form-control-label">Кнопка</label>
            <input type="text" name="button" class="form-control" placeholder="Кнопка">
        </div>
        <div class="col-lg-4">
            <label class="form-control-label">Ссылка</label>
            <input type="text" name="link" class="form-control" placeholder="Ссылка">
        </div>
        <div class="col-lg-4">
            <label class="form-control-label">Цвет</label>
            <select name="color" class="form-control">
                <wb-foreach wb="render=server" wb-tpl="false" wb-json='["success","primary","secondary","danger","warning"]'>
                    <option value="{{_val}}">{{_val}}</option>
                </wb-foreach>
            </select>
        </div>
        <div class="col-12">
            <label class="form-control-label">Фоновое изображение</label>
            <wb-module wb="module=filepicker&mode=single" name="bkg" wb-path="/assets/images/backgrounds/" wb-ext="webp,jpg,png,jpeg,svg" />
        </div>
    </div>
</edit>

<view header>
<section>
    <div class="parallax d-flex" data-img="{{bkg.0.img}}">
        <div class="position-absolute d-block wd-100v ht-100v op-7 bg-black-8">&nbsp;</div>
        <div class="parallax-overlay row justify-content-center">
            <div class="col-sm-8 text-center text-center text-white">
                <img data-src="/assets/img/logo.svg" width="300" height="209" class="wd-300 px-4 pt-5 img-fluid animated hiding" data-animation="flipInY" data-delay="200">
                <h1 class="text-white tx-light py-4 tx-30 tx-sm-50 animated hiding" data-animation="bounceInDown" data-delay="0">
                {{header}}
                </h1>
                <p class="pb-5 tx-16 tx-sm-20 animated hiding text" data-animation="bounceInUp" data-delay="600">
                {{text}}
                </p>
                <a href="{{link}}" wb-if="button > ''" class="btn btn-{{color}} rounded-30 tx-light pd-x-40 pd-y-15 ">
                {{button}}
                </a>
            </div>
        </div>
    </div>
</section>
</view>