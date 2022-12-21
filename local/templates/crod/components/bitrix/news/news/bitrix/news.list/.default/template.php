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
$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name, $component->arParams['AJAX_OPTION_ADDITIONAL']);
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
<div class="news-box section-inner">
    <div class="items-wrap ajax_append_content">
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
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="item-tile-new">
                            <span class="tile-head-wrap">
                                <span class="tile-ico <?=$color[$colorCount]?>">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/calendar.svg" alt="">
                                </span>
                                <span class="tile-date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
                            </span>
                    <span class="tile-title-wrap">
                                <span class="tile-title h3-title"><?= $arItem['NAME'] ?></span>
                        <span class="tile-action-wrap">
                                <span class="btn-action-icon">
                                    <span class="button-title"><?=GetMessage('MORE_DETAIL')?></span>
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

    <?if($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer<$arResult["NAV_RESULT"]->nEndPage):?>
        <div class="page-actions-box"  id="btn_<?=$bxajaxid?>">
            <?= $arResult["NAV_STRING"] ?>

            <div class="more-wrap">
                <a data-ajax-id="<?=$bxajaxid?>"
                   href="javascript:void(0)"
                   data-show-more="<?=$arResult["NAV_RESULT"]->NavNum?>"
                   data-next-page="<?=($arResult["NAV_RESULT"]->NavPageNomer + 1)?>"
                   data-max-page="<?=$arResult["NAV_RESULT"]->nEndPage?>" class="btn button-border">Показать еще</a>
            </div>
        </div>
    <?endif?>
</div>
