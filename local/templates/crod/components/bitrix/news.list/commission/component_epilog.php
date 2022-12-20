<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;

/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

$APPLICATION->AddChainItem('Предметы', '/subjects/');
if (!empty($arResult['ITEM'])) {
    $APPLICATION->AddChainItem($arResult['ITEM']['NAME'], '/subjects/' . $arResult['ITEM']['CODE'] . '/');
}
$APPLICATION->AddChainItem($arResult['TITLE'], 'javascript:void(0)');
