<?php

if(!empty($arResult['CREATED_BY']) && $arResult['CREATED_BY'] > 0) {
    $user = \Bitrix\Main\UserTable::getList([
        'filter' => ['ID' => $arResult['CREATED_BY']],
        'select' => ['NAME', 'LAST_NAME']
    ])->fetch();
    $arResult['AUTHOR'] = trim(sprintf('%s %s', $user['LAST_NAME'], $user['NAME']));
}
