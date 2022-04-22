<edit header="Нижняя часть сайта">
    <div>
        <wb-module wb="module=yonger&mode=edit&block=common.inc" />
    </div>
    <div class="alert alert-info">
        Смотри в /blocks/footer.php
    </div>
</edit>
<view>
    <!--=============================================
	=            Footer         =
	=============================================-->
    <footer class="section bg-success">
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
                                <img data-src="/module/myicons/facebook-circle.svg?size=30&stroke=ffffff" width="30"
                                    height="30" alt="facebook">
                            </a>
                        </li>
                        <li class="list-inline-item ml-2" wb-if="'{{_sett.vkontakte}}'>''">
                            <a href="{{_sett.vkontakte}}" target="_blank">
                                <img data-src="/module/myicons/vk-vkontakte.svg?size=30&stroke=ffffff" width="30"
                                    height="30" alt="vkontakte">
                            </a>
                        </li>
                        <li class="list-inline-item ml-2" wb-if="'{{_sett.instagram}}'>''">
                            <a href="{{_sett.instagram}}" target="_blank">
                                <img data-src="/module/myicons/instagram-circle.svg?size=30&stroke=ffffff" width="30"
                                    height="30" alt="instagram">
                            </a>
                        </li>
                        <li class="list-inline-item ml-2" wb-if="'{{_sett.youtube}}'>''">
                            <a href="{{_sett.youtube}}" target="_blank">
                                <img data-src="/module/myicons/youtube-circle.svg?size=30&stroke=ffffff" width="30"
                                    height="30" alt="youtube">
                            </a>
                        </li>
                        <li class="list-inline-item" wb-if="'{{_sett.whatsapp}}'>''">
                            <a href="https://wa.me/{{wbDigitsOnly({{_sett.whatsapp}})}}" target="_blank">
                                <img data-src="/module/myicons/chat-messages-bubble-phone-call.svg?size=30&stroke=ffffff"
                                    width="30" height="30" alt="whatsapp">
                            </a>
                        </li>
                    </ul>
                    <script type="text/javascript">
                    var arrgetbtn = [];

                    arrgetbtn.push({
                        "title": "Whatsapp",
                        "icon": "fwidgethelp-whatsapp",
                        "link": "https://api.whatsapp.com/send/?phone=79182094593",
                        "target": "_blank",
                        "color": "#FFFFFF",
                        "background": "#5EC758"
                    });

                    arrgetbtn.push({
                        "title": "Instagram",
                        "icon": "fwidgethelp-instagram",
                        "link": "https://www.instagram.com/spatiumdetox/",
                        "target": "_blank",
                        "color": "#FFFFFF",
                        "background": "#FF0066"
                    });

                    arrgetbtn.push({
                        "title": "Kirill Goncharov",
                        "icon": "fwidgethelp-phone",
                        "link": "tel:+79182094593",
                        "target": "_blank",
                        "color": "#FFFFFF",
                        "background": "#0000ff"
                    });

                    var WidGetButtonOptions = {

                        id: "2e60a2e4e72969cfe8ada4a36c01d544",
                        iconopen: "fwidgethelp-commenting-o",
                        maintitle: "",
                        mainbackground: "#7a9f57",
                        maincolor: "rgb(255, 255, 255)",
                        pulse: "widgethelp_pulse",
                        fasize: "2",
                        direction: "top",
                        position: "leftbottom",
                        arrbtn: arrgetbtn
                    };

                    (async function() {
                        var script = document.createElement("script");
                        script.type = "text/javascript";
                        script.async = true;
                        script.src = "https://getbtn.com/widget/index.php?id=" + WidGetButtonOptions.id;
                        document.getElementsByTagName("head")[0].appendChild(script);
                        setTimeout(async () => {
                            if (document.querySelector('.widgethelptext')) {
                                document.querySelector('.widgethelptext').remove();
                            }
                        }, 1000);
                    })();
                    </script>


                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </footer>

    <modal></modal>
    <wb-snippet name="wbapp" />
  <wb-scripts src="main" trigger="ready">
                [
                  "/engine/lib/bootstrap/js/bootstrap.bundle.min.js",
                  "/engine/modules/yonger/tpl/assets/js/dashforge.js",
                  "/engine/modules/yonger/tpl/assets/js/yonger.js",
                  "/assets/js/jquery.appear.js",
                  "/assets/js/counters.js",
                  "/assets/js/spatium.js"
                ]
  </wb-scripts>
    <wb-module wb="module=cart" />
    <wb-module wb="module=cloudpaywidget" />
    <wb-module wb="module=yonger&mode=render&view=cart" />
    <!-- scroll to top  -->
    <a href="javascript:void(0)" class="scroll-top bg-white rounded-circle">
        <svg wb-module="myicons" class="mi mi-arrows-diagrams-03 size-50" stroke="{{_var.colorSuccess}}" width="50" height="50"></svg>
    </a>
    <!-- end of scroll to top -->
</view>