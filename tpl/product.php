
<html lang="ru">
<head>
    <title>{{title}}</title>
</head>

<body>
    <wb-module wb="module=yonger&mode=render&view=header" />
    <wb-var wid="{{wbNewId()}}" />
    <wb-var product="{{_current}}" />
    <div class="mg-t-80">
        <wb-module wb="module=yonger&mode=render&view=product" />
    </div>
    <wb-module wb="module=yonger&mode=render&view=footer" />

</body>
</html>

