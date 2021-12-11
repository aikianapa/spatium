<div class="divider-text" wb-if='"{{_route.subdomain}}" > ""  AND "{{_sett.modules.yonger.standalone}}" !== "on"'>
    {{_route.subdomain}}</div>
<hr wb-if='"{{_route.subdomain}}" == "" AND "{{_sett.modules.yonger.standalone}}" !== "on"'>
<ul class="nav nav-aside" wb-if='"{{_route.subdomain}}" > "" OR "{{_sett.modules.yonger.standalone}}" == "on"'>
    <li wb-allow="admin manager">
        <div class="mg-y-20">Навигация</div>
    </li>

    <li wb-allow="admin" class="nav-item with-sub">
        <a href="#" data-ajax="{'url':'/cms/ajax/form/pages/list/','html':'.content-body'}" class="nav-link">
            <svg class="mi mi-browser-internet-web-network-window-app-icon" wb-module="myicons"></svg>
            <span>Страницы</span>
        </a>
    </li>

    <li wb-allow="admin" class="nav-item with-sub">
        <a href="#" data-ajax="{'url':'/cms/ajax/form/news/list/','html':'.content-body'}" class="nav-link">
            <svg class="mi mi-news-2-paper" wb-module="myicons"></svg>
            <span>Новости</span>
        </a>
    </li>

    <li wb-allow="admin" class="nav-item">
        <a href="#" data-ajax="{'url':'/cms/ajax/form/products/list/','html':'.content-body'}" class="nav-link">
            <svg class="mi mi-asian-food.1" wb-module="myicons"></svg>
            <span>Продукция</span>
        </a>
    </li>
    <li wb-allow="admin" class="nav-item">
        <a href="#" data-ajax="{'url':'/cms/ajax/form/orders/list/','html':'.content-body'}" auto class="nav-link">
            <svg class="mi mi-credit-card-basket" wb-module="myicons"></svg>
            <span>Заказы</span>
        </a>
    </li>
    <li wb-allow="admin manager" class="nav-item">
        <a href="#" data-ajax="{'url':'/cms/ajax/form/delivery/list/','html':'.content-body'}" class="nav-link">
            <svg class="mi mi-delivery-truck-fast" wb-module="myicons"></svg>
            <span>Доставки</span>
        </a>
    </li>
    <li wb-allow="admin" class="nav-item">
        <a href="#" data-ajax="{'url':'/cms/ajax/form/catalogs/list','html':'.content-body'}" class="nav-link">
            <svg class="mi mi-hierarchy-circle.1" wb-module="myicons"></svg>
            <span>Справочники</span>
        </a>
    </li>
    <!--
    <li class="nav-item">
        <a href="#" data-ajax="{'url':'/cms/ajax/form/comments/list/','html':'.content-body'}" class="nav-link">
            <svg class="mi mi-users-message-support-1" wb-module="myicons"></svg>
            <span>Коментарии</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" data-ajax="{'url':'/module/chat/','html':'.content-body'}" class="nav-link">
            <svg class="mi mi-chat-messages-bubble.14" wb-module="myicons"></svg>
            <span>Сообщения</span>
        </a>
    </li>
-->

    <li wb-allow="admin,manager">
        <div class="mg-y-20">Отчёты</div>
    </li>

    <li wb-allow="admin,manager" class="nav-item">
        <a href="#" data-ajax="{'url':'/orders/rep_cook','html':'.content-body'}" class="nav-link">
            <svg class="mi mi-knife-fork-restaurant-food" wb-module="myicons"></svg>
            <span>По кухне</span>
        </a>
    </li>

    <li wb-allow="admin,manager" class="nav-item">
        <a href="#" data-ajax="{'url':'/orders/rep_orders','html':'.content-body'}" class="nav-link">
            <svg class="mi mi-credit-card-basket" wb-module="myicons"></svg>
            <span>По заказам</span>
        </a>
    </li>

    <li wb-allow="admin,manager" class="nav-item">
        <a href="#" data-ajax="{'url':'/orders/rep_clients','html':'.content-body'}" class="nav-link">
            <svg class="mi mi-group-user.1" wb-module="myicons"></svg>
            <span>По клиентам</span>
        </a>
    </li>
</ul>
