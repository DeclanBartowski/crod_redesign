<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Loader;
use \Bitrix\Iblock\ElementTable;
use \Bitrix\Main\Context,
    Bitrix\Main\Engine\Contract\Controllerable;

class AddDocuments extends CBitrixComponent  implements Controllerable
{
    private $ibRegion = 17;
    private $ibSubject = 9;
    private $ibYear = 27;
    private $ibFileResult = 27;
    private $errors = [];
    private $data = [];


    public function configureActions()
    {
        return [
            'upload' => [ // Ajax-метод
                'prefilters' => [],
            ],
        ];
    }


    public function uploadAction()
    {
        Loader::includeModule('iblock');
        $requestData = Context::getCurrent()->getRequest()->toArray();
        if(!$GLOBALS['USER']->IsAuthorized())  $this->errors[] = GetMessage('NO_AUTH_USER');
        if(empty($requestData['region']))  $this->errors[] = GetMessage('REGION_CHOICE');
        if(empty($requestData['YEAR']))  $this->errors[] = GetMessage('YEAR_CHOICE');
        if(empty($requestData['SUBJECT']))  $this->errors[] = GetMessage('SUBJECT_CHOICE');
        $files = [];
        $file = Context::getCurrent()->getRequest()->getFile("file");
        if(!empty($file))
        {
            foreach ($file['name'] as $key => $value)
            {
                if(empty($value)) continue;
                $files[] = [
                    'name' => $file['name'][$key],
                    'type' => $file['type'][$key],
                    'tmp_name' => $file['tmp_name'][$key],
                    'error' => $file['error'][$key],
                    'size' => $file['size'][$key],
                ];
            }
        }

        if(count(array_filter($requestData['name'])) != count($files)) {
            $this->errors['file'] = GetMessage('REQUIRED_DOC');
        }

        if(count($files) < 1) {
            $this->errors['file'] = GetMessage('REQUIRED_DOC');
        }


        if(!empty($this->errors)) {
            throw new Exception(implode('<br>', $this->errors));
        }


        foreach ($files as $key => $value)
        {
            $el = new \CIBlockElement;
            $arLoadProductArray = Array(
                "CREATED_BY"    => $GLOBALS['USER']->GetID(),
                "IBLOCK_ID"      => $this->ibFileResult,
                'IBLOCK_SECTION_ID' => $requestData['YEAR'],
                "PROPERTY_VALUES"=> [
                    'FILE' => $value,
                    'REG' => $requestData['region'],
                    'SUB' => $requestData['SUBJECT'],
                ],
                "NAME"           => $requestData['name'][$key],
                "ACTIVE"         => "N",
            );
            $el->Add($arLoadProductArray);
        }

        return $requestData;
    }


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

    public function executeComponent()
    {
        Loader::includeModule('iblock');
        $this->getRegion();
        $this->getSubject();
        $this->getYear();
        $this->includeComponentTemplate();
    }

}
