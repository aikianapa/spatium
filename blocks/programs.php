<edit header="Программа питания">
    <div class="alert alert-info">
        Смотри в /blocks/programs.php
    </div>
    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
        <div class="form-group row">
            <div class="col-12">
                <label class="form-control-label">Текст</label>
                <textarea name="text" class="form-control" rows="auto" placeholder="Текст"></textarea>
            </div>
        </div>
    </div>
</edit>

<view>

    <section class="bg-white" id="programs">
        <div class="content container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center px-5">
                    <h2 class="tx-semibold pb-4 tx-40">
                        {{header}}
                    </h2>
                    <p class="tx-16">
                        {{text}}
                    </p>
                </div>
            </div>
            <div id="programsList">
            <div class="card-columns pt-4">
            <wb-var prog="{'0':{'count':7,'name':'7 дней'},'1':{'count':14,'name':'14 дней'},'2':{'count':30,'name':'30 дней'}}" />
            <wb-foreach wb="{'table':'products',
                            'render':'server',
                            'limit':'3',
                            'minimal':'3',
                            'rand':true,
                            'filter': {'category':'main','active':'on'}
                }">
                <div class="card bd-0">
                    <wb-var days="{{_var.prog.{{_idx}}.count}}" />
                    <wb-var discount="{{discounts.{{_var.days}}}}" wb-if="'{{discounts.{{_var.days}}}}'>'0'" else="1" />
                    <figure class="img-caption pos-relative mg-b-0">
                        <a href="javascript:$.redirectPost('/products/{{id}}/{{wbUrlOnly({{name}})}}', { 'days':'{{_var.days}}' });">
                        <wb-var imgcnt="{{count({{images}})}}" />
                        <wb-var cicle="{{ceil({{_ndx}} / {{_var.imgcnt}})}}" />
                        <img data-src="{{images.{{_idx - (_var.cicle * _var.imgcnt - _var.imgcnt) }}.img}}" class="card-img-top object-cover" height="300"
                            alt="{{name}}">
                        <figcaption
                            class="pos-absolute a-0 wd-100p pd-20 d-flex flex-column justify-content-center bg-white-9 transition-base op-0">
                            <h6 class="tx-inverse tx-semibold mg-b-20">{{name}}</h6>
                            <div class="tx-inverse mg-b-0">{{text}}</div>
                        </figcaption>
                        </a>
                    </figure>

                    <div class="card-body text-center pb-0">
                        <h5 class="tx-semibold">{{_var.prog.{{_idx}}.name}}</h5>
                        <p>{{price * {{_var.days}} * {{_var.discount}} }} р.</p>
                    </div>
                    <div class="card-footer text-center bd-0 pt-0">
                    <a href="javascript:void(0);" data-id="{{id}}"
                            data-name="{{name}}" data-price="{{price}}"
                            data-image="{{images.0.img}}" data-days="{{_var.days}}"
                            data-discounts="{{json_encode({{discounts}})}}"
                            data-link="/products/{{id}}/{{wbUrlOnly({{name}})}}"
                            class="mod-cart-add mod-cart-data btn btn-success tx-semibold px-4 rounded-20">Заказать
                            <img src="/module/myicons/shopping-cart.svg?size=26&stroke=FFFFFF"></a>
                    </div>
                </div>
                </wb-foreach>
            </div>
            </div>
        </div>
    </section>
</view>