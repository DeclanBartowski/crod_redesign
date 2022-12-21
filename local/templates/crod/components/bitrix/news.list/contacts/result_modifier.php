<?php

foreach ($arResult['ITEMS']  as $arItem)
{
    $arResult['FULL_ITEMS'][$arItem['IBLOCK_SECTION_ID']][] = $arItem;

}
$arResult['ALL_SECTIONS'] = \Bitrix\Iblock\SectionTable::getList([
    'filter' => ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y'],
    'select' => ['ID', 'NAME','SORT'],
    'order' => ['SORT'  =>  'ASC']
])->fetchAll();
