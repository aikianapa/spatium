<edit header="Наша команда">
    <div class="alert alert-info">
        Смотри в /blocks/team.php
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

    <wb-multiinput name="team">
        <div class="col-md-4">
            <wb-module wb="module=filepicker&mode=single" name="image" wb-path="/assets/images/team/"
                wb-ext="webp,jpg,png,jpeg,svg" />
        </div>
        <div class="col-md-8">
            <div class="ml-3 form-group row">
                <div class="col-12">
                    <label class="form-control-label">Имя</label>
                    <input class="form-control" name="fullname" placeholder="Заголовок">
                </div>

                <div class="col-12">
                    <label class="form-control-label">Должность</label>
                    <input class="form-control" name="vocation" placeholder="Заголовок">
                </div>
            </div>
        </div>

    </wb-multiinput>

</edit>
<view>
    <section class="bg-white" id="team">
        <div class="content container">
            <div class="row pb-5">
                <div class="col-lg-8 offset-lg-2 text-center px-5">
                    <h2 class="tx-light py-4 tx-40">{{header}}</h2>
                    <p class="tx-16">{{text}}</p>
                </div>
            </div>

            <div class="card-columns d-none d-sm-block">
                <wb-foreach wb="from=team&tpl=false">
                    <div class="card bd-0 mx-1 animated hiding" data-animation="flipInY" data-delay="{{200*{{_ndx}}}}">
                        <img data-src="/thumbc/600x600/src/{{image.0.img}}" width="600" height="600"
                            class="rounded img-fluid" alt="{{fullname}}">
                        <div class="card-body">
                            <h5 class="card-title tx-20">{{fullname}}</h5>
                            <p class="card-text tx-12 tx-gray-600">{{vocation}}</p>
                        </div>
                    </div>
                </wb-foreach>
            </div>
        </div>


        <div class="d-sm-none">
            <div id="teamCaption" class="carousel slide" data-ride="carousel" data-keyboard="true" data-touch="true">
                <div class="carousel-inner">
                    <wb-foreach wb="from=team&tpl=false">
                        <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                        <div class="carousel-item {{_var.active}}">
                            <img data-src="/thumbc/600x600/src/{{image.0.img}}" width="600" height="600"
                                class="rounded img-fluid" alt="{{fullname}}">
                            <div class="carousel-caption pd-b-0">
                                <h5 class="tx-gray-900 tx-shadow-light tx-semibold">{{fullname}}</h5>
                                <p class="tx-gray-800 tx-shadow-light">{{vocation}}</p>
                            </div>
                        </div>
                    </wb-foreach>
                </div>
                <a class="carousel-control-prev" href="#teamCaption" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Предыдущий</span>
                </a>
                <a class="carousel-control-next" href="#teamCaption" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Следующий</span>
                </a>
            </div>

        </div>
    </section>

</view>