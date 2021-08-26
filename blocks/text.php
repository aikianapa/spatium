<edit header="Страница оплаты заказа">
    <div class="alert alert-info">
        Смотри в /blocks/text.php
    </div>
    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
        <div class="form-group row">
        <div class="col-12">
            <label class="form-control-label">Текст</label>
            <wb-module wb="module=jodit" name="text" placeholder="Текст"/>
        </div>
    </div>

    </div>
</edit>
<view>
    <section>
        <div class="row">
            <div class="col-12 px-5">
                <h2 class="tx-semibold py-4 tx-40">
                    {{header}}
                </h2>
                <div class="pb-4 tx-16">
                    {{text}}
                </div>
            </div>
        </div>
    </section>
</view>