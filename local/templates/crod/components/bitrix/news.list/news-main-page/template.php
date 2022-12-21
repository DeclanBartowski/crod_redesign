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
$colorCount = 0;
$color = [
    'color-blue',
    'color-green',
    'color-violet',
    'color-orange',
    'color-violet-second',
    'color-violet-third',
    'color-red',
    'color-green-second',
    'color-yellow-second',
    'color-blue-second',
    'color-violet-four',
];
?>
<div class="news-box section-main">
    <div class="title-inner-wrap">
        <h2 class="h1-title title-large"><?= $arResult['NAME'] ?></h2>
    </div>
    <div class="items-wrap">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            if(empty($color[$colorCount])) $colorCount = 0;

            ?>

            <div class="item-wrap" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="item-tile-new">
                            <span class="tile-head-wrap">
                                <span class="tile-ico <?=$color[$colorCount]?>">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/calendar.svg" alt="">
                                </span>
                                <span class="tile-date"><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></span>
                            </span>
                    <span class="tile-title-wrap">
                                <span class="tile-title h3-title"><?= $arItem['NAME'] ?></span>
                            </span>
                    <span class="tile-action-wrap">
                                <span class="btn-action-icon">
                                    <span class="button-title"><?= GetMessage('DETAIL_NEWS') ?></span>
                                    <span class="button-ico ico-large">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-button.svg" alt="">
                                    </span>
                                </span>
                            </span>
                </a>
            </div>

        <?
            $colorCount++;
        endforeach; ?>
    </div>
    <div class="action-inner-wrap">
        <a href="<?= $arResult['LIST_PAGE_URL'] ?>" class="btn button-border">
            <span class="button-title"><?= GetMessage('TEXT_ALL_NEWS') ?></span>
            <span class="button-ico ico-large">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-button.svg" alt="">
                        </span>
        </a>
    </div>
</div>
