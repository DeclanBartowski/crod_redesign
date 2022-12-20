<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}


$cp = $this->__component; // объект компонента

if (is_object($cp))
{
    $cp->arResult['TITLE'] = $arParams['TITLE'];

    if(!empty($arParams['COMMISION']))
    {
        $cp->arResult['ITEM'] = \Bitrix\Iblock\ElementTable::getList([
            'filter' => ['ID' => $arParams['COMMISION'], 'IBLOCK_ID' => 9],
            'select' => ['NAME','CODE']
        ])->fetch();
    }

    $cp->SetResultCacheKeys(array('ITEM','TITLE'));
}
