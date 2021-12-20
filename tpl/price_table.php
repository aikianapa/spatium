<wb-var disc="{{getDiscounts()}}" />
<wb-foreach wb-from="_var.disc">
    <div class="row bd-b tx-normal">
        <wb-var discount="{{percent}}" wb-if="'{{percent}}'>'0'" else="1" />
        <div class="col tx-left nobr">{{name}}
            <div class="badge badge-warning" wb-if="'{{_var.discount}}'<'1'">
                -{{(1-{{_var.discount}})*100}}%
            </div>
        </div>
        <div class="col-auto tx-right">
            <a href="javascript:void(0);" data-id="{{_var.product.id}}" data-name="{{_var.product.name}}" data-price="{{_var.product.price}}" data-image="{{_var.product.images.0.img}}"
                data-days="{{_key}}" data-link="/products/{{_var.product.id}}/{{wbUrlOnly({{_var.product.name}})}}"
                class="mod-cart-add mod-cart-data">
                <span class="tx-success"> {{_var.product.price * {{_key}} * {{_var.discount}} }}₽</span>
                <img src="/module/myicons/shopping-cart.svg?size=24&stroke=10b759" width="24" height="24">
            </a>
        </div>
    </div>
</wb-foreach>