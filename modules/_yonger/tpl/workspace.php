<html>
<body wb-if='in_array({{_sess.user.role}},explode(",","{{_sett.modules.yonger.allow}}"))'>
    <wb-include wb="{'src':'/modules/yonger/tpl/ws_glob.php'}" wb-if=' "{{_route.subdomain}}" == "" OR "{{_sett.modules.yonger.standalone}}" == "on" ' />
    <wb-include wb="{'src':'/modules/yonger/tpl/ws_site.php'}" wb-if=' "{{_route.subdomain}}" > ""  AND "{{_sett.modules.yonger.standalone}}" !== "on" ' />
</body>
<body wb-if="'{{_sess.user.role}}' == 'user'">
    <wb-include wb="{'tpl':'cabinet.php'}" />
</body>
</html>