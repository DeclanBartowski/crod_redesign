<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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

<div class="shedule-box">
    <div class="items-inner-wrap">
        <div class="items-wrap">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="item-wrap" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="item-tile-shedule">
                        <? if (!empty($arItem['PROPERTIES']['SVG']['VALUE'])): ?>
                            <div class="tile-photo-wrap">
                                <div class="tile-photo">
                                    <img src="<?= CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE']) ?>" alt="">
                                </div>
                            </div>
                        <? endif; ?>
                        <div class="tile-info-wrap">
                            <div class="tile-title-wrap">
                                <div class="tile-title page-att-title"><span><?= $arItem['NAME'] ?></span></div>
                            </div>
                            <? if (!empty($arItem['PROPERTIES']['MUN_STEP']['VALUE'])): ?>
                                <div class="tile-info">
                                    <div class="tile-info-title"><?= GetMessage('MIN_STEP') ?></div>
                                    <p><?= $arItem['PROPERTIES']['MUN_STEP']['VALUE'] ?></p>
                                </div>
                            <? endif; ?>

                            <? if (!empty($arItem['PROPERTIES']['REG_STEP']['VALUE'])): ?>
                                <div class="tile-info">
                                    <div class="tile-info-title"><?= GetMessage('REG_STEP') ?></div>
                                    <p><?= $arItem['PROPERTIES']['REG_STEP']['VALUE'] ?></p>
                                </div>
                            <? endif; ?>

                            <? if (!empty($arItem['PROPERTIES']['FED_STEP']['VALUE'])): ?>
                                <div class="tile-info">
                                    <div class="tile-info-title"><?= GetMessage('ZAKL_STEP') ?></div>
                                    <p><?= $arItem['PROPERTIES']['FED_STEP']['VALUE'] ?></p>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>
