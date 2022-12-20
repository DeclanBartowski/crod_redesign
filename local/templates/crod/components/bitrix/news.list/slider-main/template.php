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
<div class="top-slider-box">
    <div class="slider-wrap">
        <div class="slider">
            <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="sl-wrap" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="sl-info-wrap">
                        <? if (!empty($arItem['PROPERTIES']['DATE']['VALUE'])): ?>
                            <div class="sl-title h3-title"><?= $arItem['PROPERTIES']['DATE']['VALUE'] ?></div>
                        <? endif; ?>
                        <div class="h1-title title-max-large"><?= $arItem['NAME'] ?></div>
                        <? if (!empty($arItem['PREVIEW_TEXT'])): ?>
                            <div class="sl-title h3-title"><?= $arItem['PREVIEW_TEXT'] ?></div>
                        <? endif; ?>

                        <? if (!empty($arItem['PROPERTIES']['URL']['VALUE'])): ?>
                            <div class="sl-action">

                                <a href="<?= $arItem['PROPERTIES']['URL']['VALUE'] ?>"
                                    <? if (!empty($arItem['PROPERTIES']['TARGET']['VALUE'])): ?> target="_blank" <? endif; ?>
                                   class="btn button-light">
                                    <span class="button-title"><?= GetMessage('LINK_MOVE') ?></span>
                                    <span class="button-ico ico-large">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-button.svg" alt="">
                                        </span>
                                </a>
                            </div>
                        <? endif; ?>
                    </div>
                    <? if (!empty($arItem['PROPERTIES']['SVG']['VALUE'])): ?>
                        <div class="sl-photo-wrap">
                            <div class="elm-photo">
                                <img src="<?= CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE']) ?>" alt="">
                            </div>
                        </div>
                    <? endif; ?>
                </div>

            <? endforeach; ?>
        </div>
    </div>
</div>
