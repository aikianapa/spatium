<edit header="Частые вопросы">
    <div class="alert alert-info">
        Смотри в /blocks/faq.php
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
    <div class="divider-text">Частые вопросы</div>
    <wb-multiinput name="tabs">
        <div class="col-12">
            <input type="text" class="form-control tx-semibold" name="title" placeholder="Вопрос">
        </div>

        <div class="col-12">
            <textarea name="text" class="form-control" rows="auto" placeholder="Ответ"></textarea>
        </div>
    </wb-multiinput>
</edit>
<view>



    <section id="faq">
        <div class="bg-gray-100">
            <div class="content container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center px-5 pb-5">
                        <h2 class="tx-light py-4 tx-40">
                            {{header}}
                        </h2>
                        <p class="tx-16">{{text}}</p>
                    </div>

                    <div class="col-lg-10 offset-lg-1 text-center px-5">
                        <div id="faq-accordion" class="collapsed">
                            <wb-foreach wb-from="tabs">
                            <h6 class="tx-20 tx-light py-4 pr-5">{{title}}</h6>
                            <div>{{text}}</div>
                            </wb-foreach>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</view>