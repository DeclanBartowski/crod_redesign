<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$APPLICATION->AddChainItem(GetMessage('TITLE_FOLDER'), 'javascript:void(0)');
$APPLICATION->IncludeComponent(
    "sp:base.region",
    "",
    array(
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
    ),
    false
); ?>
