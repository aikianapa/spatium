<edit header="Верхняя картинка">
    <div class="alert alert-info">
        Смотри в /blocks/hero.php
    </div>
    <div>
        <wb-module wb="module=yonger&amp;mode=edit&amp;block=common.inc"></wb-module>
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
            <wb-module wb="module=filepicker" name="bkg" wb-path="/assets/images/backgrounds" wb-ext="webp,jpg,png,jpeg,svg"></wb-module>
        </div>
    </div>
</edit>
<view header="Обложка на главной">
    <section>
        <div id="HeroCarousel" class="carousel slide" data-ride="carousel" data-touch="true">
            <ol class="carousel-indicators">
                <wb-foreach wb="from=bkg&tpl=false">
                    <wb-var active="active" wb-if="'{{_idx}}'=='0'" else="" />
                    <li class="{{_var.active}}" data-target="#HeroCarousel" data-slide-to="{{_idx}}" aria-current="location"></li>
                </wb-foreach>
            </ol>
            <div class="carousel-inner">
                <wb-foreach wb="from=bkg&tpl=false">
                    <wb-var active="active" wb-if="'{{_idx}}'=='0'" else="" />
                    <div class="carousel-item wd-100v ht-100v {{_var.active}}" style="background:url({{img}});background-size:cover;background-position: 50% 50%;">
                        <div class="carousel-caption d-md-block text-center text-white">
                            <h1 class="text-white tx-light py-4 tx-30 tx-sm-50">
                                {{_parent.header}}
                            </h1>
                            <p class="pb-5 tx-16 tx-sm-20 text">
                                {{_parent.text}}
                            </p>
                            <a href="{{link}}" wb-if="'{{button}}' > ''" class="btn btn-{{color}} rounded-30 tx-light pd-x-40 pd-y-15 ">
                                {{_parent.button}}
                            </a>
                        </div>
                    </div>
                </wb-foreach>
            </div>
            <a class="carousel-control-prev" href="#HeroCarousel" data-slide="prev" role="button">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#HeroCarousel" data-slide="next" role="button">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


    </section>
</view>