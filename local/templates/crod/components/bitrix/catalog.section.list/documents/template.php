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
<div class="tabs-slider-box js-tabs-nav">
    <div class="slider-inner-wrap">
        <div class="slider-wrap">
            <div class="slider">
                <?
                $active = false;
                foreach ($arResult['COMBINE']['MAIN'] as $key => $value):?>
                    <div class="sl-wrap"><a href="" data-tab="documents_<?= $key ?>"
                                            class="btn button-menu <? if (!$active): ?>active<? $active = true; endif; ?>"><?= $date = $key - 1; ?>
                            - <?= $key ?></a></div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>
<? foreach ($arResult['COMBINE']['MAIN'] as $key => $value): ?>

    <div class="tabs-results-box tab-light js-tab-block" data-tab="documents_<?= $key ?>">
        <div class="items-wrap items-columns">


            <? foreach ($arResult['COMBINE']['SUB'][$value['ID']] as $item): ?>

            <?
                \Bitrix\Main\Diag\Debug::dump($value['ID']);
                \Bitrix\Main\Diag\Debug::dump($item['ID']);

                ?>

                <div class="item-wrap">
                    <a href="" class="item-tile-folder <? if ($item['ELEMENT_CNT'] < 1): ?>tile-disabled<? endif; ?>">
                            <span class="tile-ico">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/folder.svg" alt="">
                            </span>
                        <span class="tile-title"><?= $item['NAME'] ?></span>
                    </a>
                </div>
            <? endforeach; ?>

        </div>
    </div>
<? endforeach; ?>
