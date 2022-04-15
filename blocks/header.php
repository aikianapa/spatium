<edit header="Верхняя часть сайта">
    <div class="alert alert-info">
        Смотри в /blocks/header.php
    </div>
    <div>
        <wb-module wb="module=yonger&mode=edit&block=common.inc" />
    </div>
    <div class="divider-text">Меню сайта</div>
    <wb-multiinput name="sitemenu">
        <div class="col">
            <input class="form-control" type="text" name="label" placeholder="Пункт">
        </div>
        <div class="col">
            <input class="form-control" type="text" name="link" placeholder="Ссылка">
        </div>
        <div class="col-auto">
            <input type="checkbox" class="wd-20 ht-20 m-2" name="active" />
        </div>

    </wb-multiinput>

</edit>
<view>
    <!--wb-include wb-tpl="loader.php" /-->

<header  class="fixed-top">	
	<nav class="navbar navbar-expand-md position-fixed w-100" style="background-color: rgba(122, 159, 87, 0.9);">
		<div class="container flex-column">
			<div class="w-100 text-center pb-1">
				<div class="float-left text-left">
						<div class="p-3">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<img src="/assets/img/burger.svg" width="24" height="24" />
						</button>
					</div>
				</div>
				
				 <a class="d-inline-block m-0 navbar-brand" href="/"><img src="/assets/img/logo.svg" alt="" class="logo" height="40" width="148" /></a>

				<div class="float-right text-right">
					<div class="d-flex flex-row justify-content-end align-items-center" id="headsign">
						<div class="p-3">
							<a href="javascript:$('#cart').addClass('show');" class="my-2 my-sm-0">
								<img src="/assets/img/cart.svg" height="16" alt="Мои покупки">
							</a>
						</div>
						<div class="pt-2 pb-2 d-none d-md-block">
							<a href="/signin" class="btn btn-outline-secondary pt-1 pb-1">Вход</a>
						</div>
					</div>
				</div>
			</div>
			<div class="collapse navbar-collapse order-2 w-100" id="navbarNav" style="border-top:1px solid #F9E2C4;padding-top:10px;">		
				<wb-module wb="module=yonger&mode=render&view=sitemenu" />		
			</div>
		</div>
    </nav>
</header>	
	

</view>