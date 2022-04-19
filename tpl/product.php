<html lang="ru">
<head>
    <title>{{name}}</title>
</head>

<body>
    <wb-module wb="module=yonger&mode=render&view=header"  wb-if="'{{_route.params.ajax}}'==''" />
    <wb-var wid="{{wbNewId()}}" />
    <wb-var product="{{_current}}" />
    <wb-var class="mg-t-50" wb-if="'{{_route.params.ajax}}'=='' AND '{{_route.tpl}}'!=='product.php'" />
    <div class="{{_var.class}}">
        <wb-module wb="module=yonger&mode=render&view=product" />
    </div>
    <wb-module wb="module=yonger&mode=render&view=footer" wb-if="'{{_route.params.ajax}}'==''" />
</body>

</html>

