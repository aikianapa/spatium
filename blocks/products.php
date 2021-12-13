<edit header="Слайдшоу продуктов на главной">
    <div class="alert alert-info">
        Смотри в /blocks/products.php
    </div>
    <div>
<wb-module wb="module=yonger&mode=edit&block=common.inc" />
    </div>
</edit>

<view>
    <section id="products" class="bg-gray-100">
        <div class="content container">
            <div id="productsCaptions" class="carousel slide" data-ride="carousel" data-keyboard="true"
                data-touch="true">
                <ol class="carousel-indicators">
                    <wb-foreach wb="table=products&sort=_created&tpl=false" wb-filter="category=main&active=on">
                        <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                        <li data-target="#productsCaptions" data-slide-to="{{_idx}}" class="{{_var.active}}">
                        </li>
                    </wb-foreach>
                </ol>
                <div class="carousel-inner">
                    <wb-foreach wb="table=products&sort=_created&tpl=false" wb-filter="category=main&active=on">
                        <wb-var product="{{_val}}" />
                        <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                        <div class="carousel-item {{_var.active}}">
                            <wb-var wid="{{wbNewId()}}" />
                            <wb-module wb="module=yonger&mode=render&view=product" />

                        </div>
                    </wb-foreach>
                </div>
                <a class="carousel-control-prev" href="#productsCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Предыдущий</span>
                </a>
                <a class="carousel-control-next" href="#productsCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Следующий</span>
                </a>
            </div>

        </div>
    </section>
</view>