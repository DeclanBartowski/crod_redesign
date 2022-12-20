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
<div class="objects-box">
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
                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="item-tile-object tile-border">
                        <? if (!empty($arItem['PROPERTIES']['SVG']['VALUE'])): ?>
                            <span class="tile-photo-wrap">
                                    <span class="tile-photo photo-contain">
                                        <img src="<?= CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE']) ?>" alt="">
                                    </span>
                                </span>
                        <? endif; ?>
                        <span class="tile-title h3-title"><?= $arItem['NAME'] ?></span>
                    </a>
                </div>
            <? endforeach; ?>
        </div>
        <div class="elm-photo photo-decor">
            <img src="<?= SITE_TEMPLATE_PATH ?>/img/object-decor.svg" alt="">
        </div>
    </div>
</div>
