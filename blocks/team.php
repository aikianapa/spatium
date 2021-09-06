<edit header="Наша команда">
    <div class="alert alert-info">
        Смотри в /blocks/team.php
    </div>
    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
    </div>
    <div class="form-group row">
        <label class="col-lg-3 form-control-label">Текст</label>
        <div class="col-lg-9">
            <textarea name="text" class="form-control" rows="auto" placeholder="Текст"></textarea>
        </div>
    </div>

    <wb-multiinput name="team">
            <div class="col-lg-auto">
                <wb-module wb="module=filepicker&mode=single" name="image" wb-path="/assets/images/team/" wb-ext="webp,jpg,png,jpeg,svg" />
            </div>
            <div class="col-lg-8">
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



        <div class="card-columns">
            <wb-foreach wb-from="team">
            <div class="card bd-0 mx-1">
            <img data-src="/thumbc/600x600/src/{{image.0.img}}" width="600" class="rounded img-fluid" alt="{{fullname}}">
              <div class="card-body">
                <h5 class="card-title tx-20">{{fullname}}</h5>
                <p class="card-text tx-12 tx-gray-600">{{vocation}}</p>
              </div>
            </div>
            </wb-foreach>
          </div>
        </div>
    </section>

</view>