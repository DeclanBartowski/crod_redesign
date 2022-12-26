<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}


$cp = $this->__component; // объект компонента
if (is_object($cp)) {
    $cp->arResult['SUBJECT'] = CIBlockElement::GetByID($arParams["SUBJECT"])->GetNext();
    $arSection = CIBlockSection::GetNavChain(false, $arParams["SECTION"], ['NAME', 'SECTION_PAGE_URL'], true);
    $strSection = 'Результаты (';
    foreach ($arSection as $key => $value) {
        if ($key == 0) {
            $value['NAME'] = floatval($value['NAME']);
            $strSection .= --$value['NAME'] . '-' . ++$value['NAME'];
        } else {
            $strSection .= ' ' . $value['NAME'];
        }
    }
    $strSection .= ')';
    $cp->arResult['SECTION'] = $strSection;
    $cp->SetResultCacheKeys(array('SUBJECT', 'SECTION'));
}
