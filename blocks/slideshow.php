<edit header="Блок вертикальных табов">
    <div class="alert alert-info">
        Смотри в /blocks/slideshow.php
    </div>
    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
    </div>
    <div class="form-group row">
            <label class="col-sm-3 form-control-label">Фон блока</label>
            <div class="col-sm-9">
            <select name="color" class="form-control">
                <wb-foreach wb="render=server" wb-json='["success","primary","secondary","danger","warning"]'>
                    <option value="{{_val}}">{{_val}}</option>
                </wb-foreach>
            </select>
                
            </div>
        </div>
    </div>
    <div class="form-group row">
            <label class="col-lg-3 form-control-label">Текст</label>
            <div class="col-lg-9">
                <textarea name="text" class="form-control" rows="auto" placeholder="Текст"></textarea>
            </div>
    </div>
    <div class="col-12">
            <wb-module wb="module=filepicker" name="bkg" wb-path="/assets/images/slideshow/" wb-ext="webp,jpg,png,jpeg,svg" />
    </div>
</edit>
<view>
    <section>
            <div class="bg-{{color}} pb-5">
                <div class="content container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 text-center px-5">
                            <h2 class="tx-white tx-semibold py-4 tx-40">
                                {{header}}
                            </h2>
                            <p class="tx-white pb-4 tx-16">Отзывы реальных клиентов о доставке правильного питания на
                                неделю, вкусе самой еды, ее качестве и сервисе компании Spatim Detox. Узнай почему у нас
                                так вкусно!</p>
                        </div>
                    </div>
                    <div class="card-columns columns-6 columns-sm-3 pt-4 gallery">
                        <div class="card bd-0" data-src="/assets/img/tm1.webp">
                            <img data-src="/assets/img/tm1.webp" class="img-fluid">
                        </div>

                        <div class="card bd-0" data-src="/assets/img/tm2.webp">
                            <img data-src="/assets/img/tm2.webp" class="img-fluid">
                        </div>

                        <div class="card bd-0" data-src="/assets/img/tm3.webp">
                            <img data-src="/assets/img/tm3.webp" class="img-fluid">
                        </div>
                        <div class="card bd-0" data-src="/assets/img/tm4.webp">
                            <img data-src="/assets/img/tm4.webp" class="img-fluid">
                        </div>
                        <div class="card bd-0" data-src="/assets/img/tm5.webp">
                            <img data-src="/assets/img/tm5.webp" class="img-fluid">
                        </div>
                        <div class="card bd-0" data-src="/assets/img/tm6.webp">
                            <img data-src="/assets/img/tm6.webp" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>

</view>