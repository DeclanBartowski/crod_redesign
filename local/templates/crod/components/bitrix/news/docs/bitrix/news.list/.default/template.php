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

?>
<div class="tabs-results-box cstm_pagen_ajax">
    <div class="items-inner-wrap">
        <div class="items-wrap ajax_append_content">

                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                        array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
            <div class="item-wrap">
                    <div class="item-tile-doc" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="tile-link-wrap">
                                    <span class="tile-photo photo-small">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/file-pdf.svg" alt="">
                                    </span>
                            <span class="tile-title-wrap">
                                        <span class="tile-info"><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></span>
                                        <span class="tile-title title-small"><?= $arItem['NAME'] ?></span>
                                    </span>
                        </a>
                    </div>

            </div>
                <? endforeach; ?>


        </div>
    </div>
</div>

<?if($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer<$arResult["NAV_RESULT"]->nEndPage):?>
    <div class="page-actions-box"  id="btn_<?=$bxajaxid?>">
        <?= $arResult["NAV_STRING"] ?>

        <div class="more-wrap">
            <a data-ajax-id="<?=$bxajaxid?>"
               href="javascript:void(0)"
               data-show-more-wrap="<?=$arResult["NAV_RESULT"]->NavNum?>"
               data-next-page="<?=($arResult["NAV_RESULT"]->NavPageNomer + 1)?>"
               data-max-page="<?=$arResult["NAV_RESULT"]->nEndPage?>" class="btn button-border"><?=GetMessage('LOAD_MORE')?></a>
        </div>
    </div>
<?endif?>

