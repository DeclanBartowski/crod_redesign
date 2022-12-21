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
<div class="new-box">
    <div class="title-outer-wrap">
        <div class="actions-inner-wrap">
            <div class="action-wrap">
                <a href="<?= $arResult["LIST_PAGE_URL"] ?>" class="btn button-back button-menu">
                                <span class="button-ico">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-back.svg" alt="">
                                </span>
                    <span class="button-title"><?= GetMessage('BACK_TO_LIST') ?></span>
                </a>
            </div>
            <div class="action-wrap">
                <div class="frm-select-wrap js-popup-wrap">
                    <a href="" class="btn-action-icon button-light btn-popup js-btn-toggle">
                                    <span class="button-ico">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/share.svg" alt="">
                                    </span>
                        <span class="button-title"><?=GetMessage('SHARE_TITLE')?></span>
                    </a>
                    <div class="popup-content-block js-popup-block">
                        <ul class="menu">
                            <li>
                                <a href="" class="btn-action-icon">
                                                <span class="button-ico btn button-border">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/copy.svg" alt="">
                                                </span>
                                    <span class="button-title"><?=GetMessage('COPY_LINK')?></span>
                                </a>
                            </li>
                            <li>
                                <a href="" class="btn-action-icon">
                                                <span class="button-ico btn button-border">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/ms-wa.svg" alt="">
                                                </span>
                                    <span class="button-title"><?=GetMessage('WA_SHARE')?></span>
                                </a>
                            </li>
                            <li>
                                <a href="" class="btn-action-icon">
                                                <span class="button-ico btn button-border">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/ms-tg.svg" alt="">
                                                </span>
                                    <span class="button-title"><?=GetMessage('TG_SHARE')?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="title-inner-wrap">
            <h1 class="h1-title"><?= $arResult['NAME'] ?></h1>
            <p><?= $arResult['PREVIEW_TEXT'] ?></p>
            <p class="text-light"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></p>
        </div>
    </div>


    <?= $arResult['DETAIL_TEXT'] ?>

    <? if (!empty($arResult["PROPERTIES"]['SLIDER']['VALUE'])): ?>
        <div class="gallery-slider-box">
            <div class="slider-wrap">
                <div class="slider">
                    <? foreach ($arResult["PROPERTIES"]['SLIDER']['VALUE'] as $keySlider => $valueSlider): ?>
                        <div class="sl-wrap">
                            <div class="elm-photo photo-cover">
                                <img src="<?= CFile::GetPath($valueSlider) ?>" alt="">
                            </div>
                            <? if (!empty($arResult["PROPERTIES"]['SLIDER']['DESCRIPTION'][$keySlider])): ?>
                                <div class="sl-title"><?= $arResult["PROPERTIES"]['SLIDER']['DESCRIPTION'][$keySlider] ?></div>
                            <? endif; ?>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    <? endif; ?>


    <? if (!empty($arResult['PROPERTIES']['TITLE']['VALUE'])): ?>
        <h2 class="h2-title"><?= $arResult['PROPERTIES']['TITLE']['VALUE'] ?></h2>
    <? endif; ?>
    <? if (!empty($arResult['PROPERTIES']['FIRST_COLUMN']['~VALUE']["TEXT"]) || !empty($arResult['PROPERTIES']['SECOND_COLUMN']['~VALUE']["TEXT"])): ?>
        <div class="text-columns-wrap">
            <div class="text-column">
                <?= $arResult['PROPERTIES']['FIRST_COLUMN']['~VALUE']["TEXT"] ?>
            </div>
            <div class="text-column">
                <?= $arResult['PROPERTIES']['SECOND_COLUMN']['~VALUE']["TEXT"] ?>
            </div>
        </div>
    <? endif; ?>

    <? if (!empty($arResult['PROPERTIES']['QUOTE']['~VALUE']["TEXT"])): ?>
        <blockquote class="bq-text">
            <?= $arResult['PROPERTIES']['QUOTE']['~VALUE']["TEXT"] ?>
        </blockquote>
    <? endif; ?>

    <div class="footer-outer-wrap">
        <div class="action-wrap">
            <a href="<?= $arResult["LIST_PAGE_URL"] ?>" class="btn button-border">
                            <span class="button-ico">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-back.svg" alt="">
                            </span>
                <span class="button-title"><?= GetMessage('BACK_TO_LIST') ?></span>
            </a>
        </div>
        <? if (!empty($arResult['AUTHOR'])): ?>
            <div class="info-wrap"><b><?= GetMessage('AUTHOR_TITLE') ?></b> <?= $arResult['AUTHOR'] ?></div>
        <? endif; ?>
    </div>
</div>
