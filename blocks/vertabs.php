<edit header="Блок вертикальных табов">
    <div class="alert alert-info">
        Смотри в /blocks/vertabs.php
    </div>
    <div>
	<wb-module wb="module=yonger&mode=edit&block=common.inc" />
    </div>
    <div class="pr-2">
        <div class="form-group row">
            <label class="col-lg-3 form-control-label">Текст</label>
            <div class="col-lg-9">
                <textarea name="text" class="form-control" rows="auto" placeholder="Текст"></textarea>
            </div>
        </div>

        <wb-multiinput name="tabs">
            <div class="col-lg-auto">
                <wb-module wb="module=filepicker&mode=single" name="bkg" wb-path="/assets/images/backgrounds/" wb-ext="webp,jpg,png,jpeg,svg" />
            </div>
            <div class="col-lg-8">
                <div class="form-group row">
                <div class="col">
                    <label class="form-control-label">Заголовок</label>
                    <input type="text" class="form-control" name="title" placeholder="Заголовок">
                </div>
                </div>
                <div class="form-group row">
                <div class="col">
                    <textarea name="text" class="form-control" rows="auto" placeholder="Текст"></textarea>
                </div>
                </div>
            </div>

        </wb-multiinput>

    </div>
</edit>

<view>
      
    <section>
    <wb-var wid="{{wbNewId()}}" />
        <div class="content container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center px-5">
                    <h2 class="tx-light py-4 tx-40">
                        {{header}}
                    </h2>
                    <p class="pb-4 tx-16">{{text}}</p>
                </div>
            </div>
            
              <div class="row">
<div id="sliderPr" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
  <wb-foreach wb-from="tabs" wb-tpl="false">
    <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
    <div class="carousel-item {{_var.active}}">
        <div class="d-flex flex-sm-row flex-column align-items-center pl-lg-5">
            <div  class="p-5 mr-lg-5">
                <div class="tx-normal tx-20 tx-black pb-3">{{title}}</div>
                 <p class="tx-gray-500 tx-16 text-justify pb-0">{{text}}</p>
            </div>
            <div class="wrap-img p-0 p-sm-3 p-lg-0">
                <img src="{{bkg.0.img}}" height="400" loading="lazy" alt="{{title}}"/>
            </div>
        </div>
    </div>
  </wb-foreach>
  </div>
 <button class="carousel-control-prev" type="button" data-target="#sliderPr" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#sliderPr" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
    
</div>
                </div>
            </div>          
            
            <!--<div class="row">
                <div class="col-md-5">
                    <ul class="nav nav-tabs nav-vertical" role="tablist">
                        <li class="nav-item d-none"></li>
                        <wb-foreach wb-from="tabs" wb-tpl="false">
                            <li class="nav-item mb-2 b-0">
                                <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                                <a class="nav-link d-block ht-auto bg-white {{_var.active}} p-3" data-toggle="tab" href="#{{_var.wid}}-{{_idx}}">
                                    <div class="tx-normal tx-20 tx-black pb-3">{{title}}</div>
                                    <p class="tx-gray-500 tx-12 text-justify pb-0">
                                        {{text}}
                                    </p>
                                </a>
                            </li>
                        </wb-foreach>
                    </ul>
                </div>
                <div class="col-md-7">
                    <div class="tab-content ">
                        <wb-foreach wb-from="tabs" wb-tpl="false">
                        <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                        <div id="{{_var.wid}}-{{_idx}}" class="container tab-pane {{_var.active}} animated hiding" data-animation="fadeInLeft" data-delay="100">
                            <img data-src="{{bkg.0.img}}" class="img-fluid" />
                        </div>
                        </wb-foreach>
                    </div>
                </div>
            </div>-->
            


    </section>
</view>

