<edit header="Три блока на зелёном фоне">
  <div>
    <wb-module wb="module=yonger&amp;mode=edit&amp;block=common.inc"></wb-module>
  </div>
  <div>
    <wb-multiinput name="list">
      <div class="col-3">
        <input name="img" class="form-control" placeholder="Картинка ./assets/img/{имя}.svg">
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
      <ul class="adv list-unstyled">
        <wb-foreach wb="from=list&amp;tpl=false">
          <li>
            <div>
              <img src="./assets/img/%7B%7Bimg%7D%7D.svg" alt="">
              <p>{{text}}</p>
            </div>
          </li>
        </wb-foreach>
      </ul>
    </div>
  </section>
</view>