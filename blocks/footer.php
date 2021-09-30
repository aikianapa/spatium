<edit header="Нижняя часть сайта">
<div class="alert alert-info">
        Смотри в /blocks/footer.php
    </div>
</edit>
<view>
	<!--=============================================
	=            Footer         =
	=============================================-->
	<footer class="section bg-dark">
    <div class="container py-3">
      <div class="row align-items-center">
        <div class="col-6">

          <!-- Brand -->
          <p>
            <a href="/" class="footer-brand text-white">
              <img class="ht-80 img-fluid w-auto" src="/assets/img/logo.svg" alt="">
            </a>
          </p>
      
        </div>
        <div class="col-6">
          <!-- Links -->
          <ul class="list-unstyled list-inline text-md-right">
            <li class="list-inline-item mr-2">
              <a href="/rules" class="text-white">
                Правила
              </a>
            </li>
            <li class="list-inline-item mr-2">
              <a href="/privacy" class="text-white">
                Политика 
              </a>
            </li>
            <li class="list-inline-item">
              <a href="/contact" class="text-white">
                Контакты
              </a>
            </li>
          </ul>

        </div>
      </div> <!-- / .row -->
      <div class="row align-items-center">
        <div class="col-md tx-center tx-md-left">
          <p class="tx-white">
            <small>
              <span class="current-year">2021</span> Создано для Spatium Detox. 
            </small>
          </p>

        </div>
        <div class="col-md tx-center">
      
          <!-- Social links -->
          <ul class="list-inline list-unstyled text-md-right">
            <li class="list-inline-item" wb-if="'{{_sett.facebook}}'>''">
              <a href="{{_sett.facebook}}" target="_blank">
                <img data-src="/module/myicons/facebook-circle.svg?size=30&stroke=ffffff" width="30" height="30" alt="facebook">
              </a>
            </li>
            <li class="list-inline-item ml-2" wb-if="'{{_sett.vkontakte}}'>''">
              <a href="{{_sett.vkontakte}}" target="_blank">
                <img data-src="/module/myicons/vk-vkontakte.svg?size=30&stroke=ffffff" width="30" height="30" alt="vkontakte">
              </a>
            </li>
            <li class="list-inline-item ml-2" wb-if="'{{_sett.instagram}}'>''">
              <a href="{{_sett.instagram}}" target="_blank">
                <img data-src="/module/myicons/instagram-circle.svg?size=30&stroke=ffffff" width="30" height="30" alt="instagram">
              </a>
            </li>
            <li class="list-inline-item ml-2" wb-if="'{{_sett.youtube}}'>''">
              <a href="{{_sett.youtube}}" target="_blank">
                <img data-src="/module/myicons/youtube-circle.svg?size=30&stroke=ffffff" width="30" height="30" alt="youtube">
              </a>
            </li>
          </ul>

        </div>
      </div> <!-- / .row -->
    </div> <!-- / .container -->
  </footer>
  
  <modal></modal>
  <wb-module wb="module=cart" />
  <wb-module wb="module=yonger&mode=render&view=cart" />
  <!-- scroll to top  -->
	<a href="javascript:void(0)" class="scroll-top bg-white rounded-circle">
    <svg wb-module="myicons" class="mi mi-arrows-diagrams-03 size-50" stroke="10b759" width="50" height="50"></svg>
  </a>
	<!-- end of scroll to top -->
</view>