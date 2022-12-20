<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}


if (count($arResult["SEARCH"]) > 0) {
    foreach ($arResult["SEARCH"] as $searchItem) {
        $arResult['ITEMS'][$searchItem['PARAM1']][] = $searchItem;
    }
    foreach ($arResult['ITEMS'] as $key => $searchItem) {
        switch ($key) {
            case 'news':

                foreach ($searchItem as $keyItem => $valueItem) {
                    if (!empty($valueItem["DATE_FROM"])) {
                        $arResult['ITEMS'][$key][$keyItem]['FORMAT_DATE'] = FormatDate('d f Y',
                            MakeTimeStamp($valueItem["DATE_FROM"]));
                    }
                }
                break;
            case 'subjects':
                $ids = array_filter(array_unique(array_column($arResult['ITEMS'][$key], 'ITEM_ID')));
                if (!empty($ids)) {

                    $res = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 9, 'ID' => $ids], false, false,
                        ['ID', 'NAME', 'PROPERTY_SVG']);
                    while ($ob = $res->Fetch()) {
                        $arResult['subjectsInfo'][$ob['ID']] = $ob;
                    }
                    foreach ($searchItem as $keyItem => $valueItem) {
                        if (!empty($arResult['subjectsInfo'][$valueItem['ITEM_ID']]['PROPERTY_SVG_VALUE'])) {
                            $arResult['ITEMS'][$key][$keyItem]['SVG'] = CFile::GetPath($arResult['subjectsInfo'][$valueItem['ITEM_ID']]['PROPERTY_SVG_VALUE']);
                        }
                    }
                }
                break;
            case 'documents':
                $ids = array_filter(array_unique(array_column($arResult['ITEMS'][$key], 'ITEM_ID')));
                if (!empty($ids)) {
                    $arFilter = array(
                        "IBLOCK_ID" => 27,
                        "PROPERTY_SUB" => $arResult['ID'],
                        "ACTIVE_DATE" => "Y",
                        "ACTIVE" => "Y"
                    );
                    $res = CIBlockElement::GetList([], [
                        "IBLOCK_ID" => 27,
                        'ID' => $ids
                    ], false, false, ['ID', 'NAME', 'PROPERTY_FILE', 'IBLOCK_ID']);
                    while ($ob = $res->Fetch()) {
                        if (!empty($ob['PROPERTY_FILE_VALUE'])) {
                            $ob['FILE_ARRAY'] = CFile::GetFileArray($ob['PROPERTY_FILE_VALUE']);
                            $ob['FILE_ARRAY']['FORMAT_SIZE'] = CFile::FormatSize($ob['FILE_ARRAY']['FILE_SIZE'], 1);
                            $ob['FILE_ARRAY']['FORMAT'] = \Bitrix\Main\IO\Path::getExtension($ob['FILE_ARRAY']["SRC"]);
                            $arResult['documents'][$ob['ID']] = $ob['FILE_ARRAY'];
                        }

                    }
                    foreach ($searchItem as $keyItem => $valueItem) {
                        if (!empty($arResult['documents'][$valueItem['ITEM_ID']])) {
                            $arResult['ITEMS'][$key][$keyItem]['FILE'] = $arResult['documents'][$valueItem['ITEM_ID']];
                        }
                    }
                }
                break;
        }

    }
}

