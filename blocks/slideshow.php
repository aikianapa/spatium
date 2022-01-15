<edit header="Слайдшоу">
    <div class="alert alert-info">
        Смотри в /blocks/slideshow.php
    </div>
    <div>
<wb-module wb="module=yonger&mode=edit&block=common.inc" />
    </div>
    <div class="form-group row">
            <label class="col-sm-3 form-control-label">Фон блока</label>
            <div class="col-sm-9">
            <select name="color" class="form-control">
                <wb-foreach wb="render=server&tpl=false" wb-json='["success","primary","secondary","danger","warning"]'>
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
                            <h2 class="tx-white tx-light py-4 tx-40">
                                {{header}}
                            </h2>
                            <p class="tx-white pb-4 tx-16">{{text}}</p>
                        </div>
                    </div>
                    <div class="card-columns columns-6 columns-sm-3 pt-4 gallery">
                        <wb-foreach wb="from=bkg&tpl=false">
                        <div class="card bd-0 animated hiding" data-animation="flipInY" data-delay="{{200*{{_ndx}}}}" data-src="{{img}}">
                            <img data-src="{{img}}" class="img-fluid">
                        </div>
                        </wb-foreach>
                    </div>
                </div>
            </div>
        </section>

</view>