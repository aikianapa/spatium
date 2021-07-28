<wb-var auto="auto" wb-if='"{{_route.subdomain}}" == ""' />
<nav class="nav nav__list d-flex align-items-center">
    <a href="#settings" class="nav-link nav__item d-flex align-items-center mg-r-10"
        data-ajax="{'url':'/cms/settings/settings_ui','html':'.content-body'}" _var.auto>
        <div class="nav__icon d-flex align-items-center justify-content-center">
            <svg class="mi mi-settings.2" wb-module="myicons"></svg>
        </div>
        <span class='d-none d-lg-inline'>Настройки</span>
    </a>
    <a href="#users" class="nav-link nav__item d-flex align-items-center mg-r-10"
        data-ajax="{'url':'/cms/ajax/form/users/list_users/','html':'.content-body'}">
        <div class="nav__icon d-flex align-items-center justify-content-center">
            <svg class="mi mi-checkmark-sqaure.1" wb-module="myicons">
            </svg>
        </div>
        <span class='d-none d-lg-inline'>Пользователи</span>
    </a>
    <a href="#help" data-ajax="{'url':'/module/yonger/support','html':'.content-body'}"
        class="nav-link btn btn-sm btn-dashed nobr d-flex align-items-center mg-r-10">
        <div class="d-flex align-items-center justify-content-center">
            <svg class="mi mi-protection-06" wb-module="myicons"></svg>
        </div>
        <span class="mg-l-10 d-none d-md-inline">Поддержка</span>
    </a>
</nav>
<nav class="nav d-flex align-items-center">
    <a href="#" class="nav-link">
        <svg class="mi mi-search-loap" wb-module="myicons"></svg>
    </a>
    <a href="#" class="nav-link">
        <svg class="mi mi-bell-notification" wb-module="myicons"></svg>
    </a>
    <a href="#" data-toggle="dropdown" class="dropdown-link ml-4">
        <div class="d-flex align-items-center">
            <div class="avatar avatar-sm mg-r-8">
                <img data-src="/thumb/36x36/src/{{_sess.user.avatar[0].img}}" class="img rounded-circle" alt="" />
            </div>
            <div>
            <span class="tx-color-01 tx-semibold d-block lh--9">{{_sess.user.first_name}}</span>
            <span class="tx-gray-300 tx-10 d-block lh--9">{{_sess.user.role}}</span>
            </div>
            <span class="d-none d-md-inline"><svg class="mi mi-arrows-diagrams-08" wb-module="myicons"></svg></span>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-right tx-13">
        <a href="/workspace/profile" class="dropdown-item">
        <svg class="mi mi-user-circle.1" wb-module="myicons"></svg> Профиль
        </a>
        <div class="dropdown-divider"></div>
        <a href="/signout" class="dropdown-item">
        <svg class="mi mi-login-enter-arrow" wb-module="myicons"></svg> Выход
        </a>
    </div>
    
</nav>