<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\PhoneNumber\Format;
use Bitrix\Main\PhoneNumber\Parser;
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
?>
<? foreach ($arResult['ALL_SECTIONS'] as $section): ?>
    <div class="title-box">
        <div class="title-wrap">
            <h2 class="h1-title"><?= $section['NAME'] ?></h2>
        </div>
    </div>

    <div class="contacts-box">
        <div class="items-wrap">
            <? foreach ($arResult['FULL_ITEMS'][$section['ID']] as $key => $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="item-wrap" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="item-tile-cnt">
                        <div class="cnt-title"><?=$arItem['NAME']?></div>
                        <div class="cnt-title title-att"><?=$arItem['PROPERTIES']['WORK']['VALUE']?> <br><?=$arItem['PROPERTIES']['PLACE']['VALUE']?></div>
                        <div class="cnt-link">
                            <?foreach ($arItem['PROPERTIES']['PHONE']['VALUE'] as $phone):?>
                                <?
                                ?>
                                <a href="tel:<?=str_replace(['(',')','-', ' '], '' , $phone)?>"><?=$phone?></a>
                            <?endforeach;?>
                        </div>
                        <div class="cnt-link">
                            <?foreach ($arItem['PROPERTIES']['MAIL']['VALUE'] as $mail):?>
                                <a href="mailto:<?=$mail?>"><?=$mail?></a>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
<? endforeach; ?>
