<edit header="Программа питания">
    <div class="alert alert-info">
        Смотри в /blocks/programs.php
    </div>
    <div>
<wb-module wb="module=yonger&mode=edit&block=common.inc" />
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
                    <h2 class="tx-light pb-4 tx-40">
                        {{header}}
                    </h2>
                    <p class="tx-16">
                        {{text}}
                    </p>
                </div>
            </div>
            <div id="programsList">
            <div class="card-columns pt-4">
            <wb-foreach wb="{'table':'products',
                            'render':'server',
                            'tpl':'false',
                            'rand':true,
                            'filter': {'category':'main','active':'on'}
                }">
                <div class="card bd-0 mb-5">
                    <figure class="img-caption pos-relative mg-b-0">
                        <a href="javascript:$.redirectPost('/products/{{id}}/{{wbUrlOnly({{name}})}}', { 'days':'{{_var.days}}' });">
                        <wb-var imgcnt="{{count({{images}})}}" />
                        <wb-var cicle="{{ceil({{_ndx}} / {{_var.imgcnt}})}}" />
                        <img data-src="/thumbc/530x398/src/{{images.0.img}}" class="card-img-top object-cover" width="530" 
                            alt="{{name}}">
                        <h6 class="pos-absolute t-20 l-20 tx-white tx-shadow tx-semibold mg-b-20">{{name}}</h6>
                        <figcaption
                            class="pos-absolute a-0 wd-100p pd-20 d-flex flex-column tx-10 tx-md-14 justify-content-md-start bg-white-9 transition-base op-0">
                            <h6 class="tx-inverse tx-semibold mg-b-20">{{name}}</h6>
                            <div class="tx-inverse mg-b-0">{{text}}</div>
                        </figcaption>
                        </a>
                    </figure>
                    <div class="card-body text-center pb-0 tx-sm-12 tx-md-14">
                        <wb-var product="{{_val}}" />
                        <wb-include wb-tpl="price_table.php" />
                    </div>
                </div>
                </wb-foreach>
            </div>
            </div>
        </div>
    </section>
</view>