<edit header="Яндекс карта">
    <div class="alert alert-info">
        Смотри в /blocks/map.php
    </div>
    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
    </div>
    <div class="form-group row">
            <div class="col-12">
                <label class="form-control-label">Текст</label>
                <textarea name="text" class="form-control" rows="auto" placeholder="Текст"></textarea>
            </div>
        </div>

<input  wb="module=yamap" name="geo">


    <div class="form-group row">
            <label class="col-3 form-control-label">Zoom</label>
            <div class="col">
            <input type="number" name="zoom" min="1" max="18" class="form-control" placeholder="Zoom (1-18)">
            </div>
    </div>

    <div class="form-group row">
            <label class="col-3 form-control-label">Высота</label>
            <div class="col">
                <input type="number" name="height" min="100" class="form-control" placeholder="Высота (px)">
            </div>
    </div>

    <div class="form-group row">
            <label class="col-3 form-control-label">Центр</label>
            <div class="col">
                <input type="text" name="center" class="form-control" placeholder="Координаты центра карты">
            </div>
    </div>

    <wb-multiinput name="geopos">
        <div class="col">
            <input class="form-control" type="text" name="name" placeholder="Название">
        </div>
        <div class="col">
            <input class="form-control" type="text" name="pos" placeholder="Координаты">
        </div>
        <div class="col-auto">
            <input type="checkbox" class="wd-20 ht-20 m-2" name="active" />
        </div>
    </wb-multiinput>

</edit>
<view>
<section>
<div class="row">
    <div class="px-5 col-12">
        <h2 class="tx-light py-4 tx-40"  wb-if="'{{header}}'>''">
            {{header}}
        </h2>
        <div class="tx-16 pb-3" wb-if="'{{text}}'>''">{{text}}</div>
    </div>
    <div class="col-12">
    <div wb="module=yamap" zoom="{{zoom}}" height="{{height}}px">
    <wb-foreach wb="from=geopos">
        <geopos value="{{pos}}" title="{{name}}" wb-if="'{{active}}'=='on'"></geopos>
    </wb-foreach>
</div>
</div>
</div>
</section>
</view>