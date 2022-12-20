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
<div class="tabs-results-box">
    <div class="items-wrap">
        <div class="item-wrap">
            <div class="item-tile-doc">
                <? if (!empty($arResult['DISPLAY_PROPERTIES']["FILE"]['VALUE'])): ?>
                    <a href="<?= $arResult['DISPLAY_PROPERTIES']["FILE"]["FILE_VALUE"]["SRC"] ?>" download=""
                       class="tile-link-wrap">
                                <span class="tile-photo">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/file-pdf.svg" alt="">
                                </span>
                        <span class="tile-title-wrap">
                                    <span class="tile-title title-small"><?= $arResult['DISPLAY_PROPERTIES']["FILE"]["FILE_VALUE"]["NAME"] ?></span>
                                    <span class="tile-info"><?= $arResult['DISPLAY_PROPERTIES']["FILE"]["FILE_VALUE"]["FILE_SIZE_BYTE"] ?>.<?= $arResult['DISPLAY_PROPERTIES']["FILE"]["FILE_VALUE"]["EXTENSION"] ?></span>
                                </span>
                    </a>
                    <div class="tile-info-wrap info-clear">
                        <a href="<?= $arResult['DISPLAY_PROPERTIES']["FILE"]["FILE_VALUE"]["SRC"] ?>" download=""
                           class="btn-action-icon">
                            <span class="button-title"><?= GetMessage('DOWNLOAD_DETAIL') ?></span>
                            <span class="button-ico">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/download.svg" alt="">
                                    </span>
                        </a>
                    </div>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>
