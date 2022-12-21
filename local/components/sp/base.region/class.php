<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Loader;
use \Bitrix\Iblock\ElementTable;

class BaseRegion extends CBitrixComponent
{
    private $regionIB = 17;

    private function getRegionID()
    {
        $res = CIBlockElement::GetList(array(), [
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'ACTIVE' => 'Y',
            '!PROPERTY_REG' => false,
            'SECTION_ID' => $this->arParams["SECTION_ID"],
            'INCLUDE_SUBSECTIONS' => 'Y'
        ], ['PROPERTY_REG'], false, []);
        while ($ob = $res->Fetch()) {
            $this->arResult['REGIONS_ID'][$ob["PROPERTY_REG_VALUE"]] = $ob["PROPERTY_REG_VALUE"];
        }
    }

    private function getRegionInfo()
    {
        if (!empty($this->arResult['REGIONS_ID'])) {
            $this->arResult['REGIONS_INFO'] = ElementTable::getList([
                'filter' => ['IBLOCK_ID' => $this->regionIB, 'ACTIVE' => 'Y', 'ID' => $this->arResult['REGIONS_ID']],
                'select' => ['ID', 'NAME'],
                'order' => ['NAME' => 'ASC']
            ])->fetchAll();
        }
    }

    public function executeComponent()
    {
        Loader::includeModule('iblock');
        $this->getRegionID();
        $this->getRegionInfo();
        $this->includeComponentTemplate();
    }

}
