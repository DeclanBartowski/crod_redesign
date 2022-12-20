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
<div class="links-box">
    <div class="box-inner-wrap">
        <div class="title-inner-wrap">
            <div class="title-wrap">
                <h2 class="h1-title title-large"><?= GetMessage('LINKS_TITLE') ?></h2>
                <div class="h3-title"><?= GetMessage('LINKS_TEXT') ?></div>
            </div>
            <div class="action-wrap">
                <a href="<?= $arResult['LIST_PAGE_URL'] ?>" class="btn button-border">
                    <span class="button-title"><?= GetMessage('LINK_MOVE') ?></span>
                    <span class="button-ico ico-large">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-button.svg" alt="">
                                </span>
                </a>
            </div>
        </div>
        <div class="items-inner-wrap">
            <div class="items-wrap">
                <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                        array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    $url = parse_url($arItem['PROPERTIES']['URL']['VALUE']);
                    ?>
                    <div class="item-wrap wrap0<?= ++$key ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="item-tile-link tile-color-yellow">
                            <div class="tile-title h3-title"><?= $arItem['NAME'] ?></div>
                            <div class="tile-action">
                                <a <? if (!empty($arItem['PROPERTIES']['TARGET']['VALUE'])): ?>target="<?= $arItem['PROPERTIES']['TARGET']['VALUE'] ?>"<? endif; ?>
                                   href="<?= $arItem['PROPERTIES']['URL']['VALUE'] ?>" class="btn-action-icon">
                                    <span class="button-title"><?= $url['host']; ?></span>
                                    <span class="button-ico">
                                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-link.svg" alt="">
                                            </span>
                                </a>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <div class="photo-inner-wrap">
            <div class="elm-photo">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/link-pic.svg" alt="">
            </div>
        </div>
    </div>
</div>
