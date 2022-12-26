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

$APPLICATION->AddChainItem(GetMessage('SUBJECT'), '/subjects/');

if(!empty($arResult['SUBJECT']))
{
    $APPLICATION->AddChainItem($arResult['SUBJECT']['NAME'], $arResult['SUBJECT']['DETAIL_PAGE_URL']);
}

$APPLICATION->AddChainItem($arResult['SECTION'], 'javascript:void(0)');
$APPLICATION->SetTitle($arResult['SECTION']);
$APPLICATION->SetPageProperty('title', $arResult['SECTION']);
