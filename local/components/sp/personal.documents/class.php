<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Loader;
use \Bitrix\Iblock\ElementTable;
use \Bitrix\Main\Context;


class PersonalDocuments extends CBitrixComponent
{
    private $ibRegion = 17;
    private $ibSubject = 9;
    private $ibYear = 27;
    private $ibFileResult = 27;


    private function getRegion()
    {
        $this->arResult['REGION'] = ElementTable::getList([
            'filter' => ['IBLOCK_ID' => $this->ibRegion],
            'select' => ['ID', 'NAME'],
            'order' => ['NAME' => 'ASC']
        ])->fetchAll();
    }

    private function getSubject()
    {
        $this->arResult['SUBJECT'] = ElementTable::getList([
            'filter' => ['IBLOCK_ID' => $this->ibSubject],
            'select' => ['ID', 'NAME'],
            'order' => ['NAME' => 'ASC']
        ])->fetchAll();
    }

    private function getYear()
    {
        $result = [];
        $allSections = \Bitrix\Iblock\SectionTable::getList([
            'filter' => ['IBLOCK_ID' => $this->ibYear],
            'select' => ['NAME', 'ID', 'IBLOCK_SECTION_ID']
        ])->fetchAll();

        foreach ($allSections as $section) {
            if (empty($section['IBLOCK_SECTION_ID'])) {
                $result['MAIN'][intval($section['NAME'])] = $section;
            } else {
                $result['SUB'][$section['IBLOCK_SECTION_ID']][] = $section;
            }
        }
        ksort($result['MAIN']);
        $this->arResult['YEAR'] = $result;
    }

    private function getDocumentUser()
    {
        $arSelect = array(
            "ID",
            "NAME",
            "CREATED_BY",
            'IBLOCK_SECTION_ID',
            'PROPERTY_REG',
            'PROPERTY_SUB',
            'PROPERTY_FILE',
            'PROPERTY_USER_RELISE',
            'ACTIVE'
        );
        $arFilter = array("IBLOCK_ID" => $this->ibFileResult, 'CREATED_BY' => $GLOBALS['USER']->GetID());

        if(!empty($this->arResult['REQUEST']['region'])) $arFilter['PROPERTY_REG'] = $this->arResult['REQUEST']['region'];
        if(!empty($this->arResult['REQUEST']['YEAR'])) $arFilter['SECTION_ID'] = $this->arResult['REQUEST']['YEAR'];
        if(!empty($this->arResult['REQUEST']['SUBJECT'])) $arFilter['PROPERTY_SUB'] = $this->arResult['REQUEST']['SUBJECT'];

        $res = \CIBlockElement::GetList(array('ID' => "DESC"), $arFilter, false, array("nPageSize" => 50), $arSelect);
        while ($ob = $res->Fetch()) {
            $this->arResult['ITEMS'][] = $ob;
        }
        $this->arResult['PAGINATION'] = $res->GetPageNavStringEx($navComponentObject, '', 'round');

    }


    public function getRequest(){
        $this->arResult['REQUEST'] = Context::getCurrent()->getRequest()->toArray();
    }


    public function executeComponent()
    {
        Loader::includeModule('iblock');
        $this->getRequest();
        $this->getDocumentUser();
        $this->getRegion();
        $this->getYear();
        $this->getSubject();

        $this->includeComponentTemplate();
    }

}
