<edit header="Три блока на зелёном фоне">
  <div>
    <wb-module wb="module=yonger&amp;mode=edit&amp;block=common.inc"></wb-module>
  </div>
  <div>
    <wb-multiinput name="list">
      <div class="col-3">
        <input name="img" class="form-control" placeholder="Картинка /assets/img/{имя}.svg">
      </div>
      <div class="col-9">
        <input name="text" class="form-control" placeholder="Текст">
      </div>

    </wb-multiinput>
  </div>
</edit>

<view>
  <section class="bg-success">
    <div class="content container">
      <ul class="row list-unstyled pd-t-50">
        <wb-foreach wb="from=list&tpl=false">
          <li class="col-sm-6">
            <div class="media wd-sm-80p">
              <img data-src="/assets/img/{{img}}.svg" width="60" height="60" class="mg-r-20" alt="">
              <div class="media-body tx-18 tx-white pb-5">
                {{text}}
              </div>
            </div>
          </li>
        </wb-foreach>
      </ul>
    </div>
  </section>
</view>