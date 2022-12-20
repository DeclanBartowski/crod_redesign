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

<div class="link-box">
    <div class="box-inner-wrap">
        <div class="title-inner-wrap">
            <h2 class="h1-title"><?= $arResult['NAME'] ?></h2>
            <div class="h3-title"><?= $arResult['PREVIEW_TEXT'] ?></div>
        </div>
        <? if (!empty($arResult['CODE'])): ?>
            <div class="action-inner-wrap">
                <a href="<?= $arResult['CODE'] ?>" target="_blank" class="btn button-border">
                    <span class="button-title"><?= GetMessage('LINK_MOVE') ?></span>
                    <span class="button-ico ico-large">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-button.svg" alt="">
                            </span>
                </a>
            </div>
        <? endif; ?>
    </div>
</div>
