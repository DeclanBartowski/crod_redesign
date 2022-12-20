<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}


foreach ($arResult['SECTIONS'] as $section)
{

    if(!empty($section['IBLOCK_SECTION_ID'])) {
        $arResult['COMBINE']['SUB'][$section['IBLOCK_SECTION_ID']][] = $section;
    } else {
        $arResult['COMBINE']['MAIN'][(int)$section['NAME']] = $section;
    }

}

krsort($arResult['COMBINE']['MAIN']);
