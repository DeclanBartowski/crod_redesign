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
$img_svg = CFile::GetPath($arResult['PROPERTIES']['SVG']['VALUE']);

?>

<!--top-lead-box-->
<div class="top-lead-box">
    <div class="box-inner-wrap">
        <div class="info-inner-wrap">
            <h1 class="h1-title title-max-large"><?= $arResult['NAME'] ?></h1>

            <? if (!empty($arResult['PROPERTIES']['MUN_STEP']['VALUE']) || !empty($arResult['PROPERTIES']['REG_STEP']['VALUE']) || !empty($arResult['PROPERTIES']['FED_STEP']['VALUE'])): ?>
                <div class="items-wrap">
                    <div class="item-wrap">
                        <div class="item-tile-event">
                            <div class="tile-title"><?= $arResult['PROPERTIES']['MUN_STEP']['NAME'] ?></div>
                            <div class="tile-info"><?= $arResult['PROPERTIES']['MUN_STEP']['VALUE'] ?></div>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-tile-event">
                            <div class="tile-title"><?= $arResult['PROPERTIES']['REG_STEP']['NAME'] ?></div>
                            <div class="tile-info"><?= $arResult['PROPERTIES']['REG_STEP']['VALUE'] ?></div>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-tile-event">
                            <div class="tile-title"><?= $arResult['PROPERTIES']['FED_STEP']['NAME'] ?></div>
                            <div class="tile-info"><?= $arResult['PROPERTIES']['FED_STEP']['VALUE'] ?></div>
                        </div>
                    </div>
                </div>
            <? endif; ?>
        </div>
        <div class="photo-inner-wrap">
            <div class="elm-photo">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/lead-pic.svg" alt="">
            </div>
        </div>
    </div>
</div>

<div class="expert-box">
    <div class="info-inner-wrap">
        <? if (!empty($arResult['EXPERT']['PREVIEW_PICTURE'])): ?>
            <div class="elm-photo">
                <img src="<?= $arResult['EXPERT']['PREVIEW_PICTURE'] ?>" alt="">
            </div>
        <? endif; ?>
        <div class="info-title-wrap">
            <div class="h1-title"><?=GetMessage('EXPERT_TITLE')?></div>
            <div class="h3-title title-large"><?= $arResult['NAME'] ?></div>
            <div class="h3-title"><?= $arResult['PREVIEW_TEXT'] ?></div>
        </div>
    </div>
    <div class="actions-inner-wrap">
        <div class="action-wrap">
            <a href="/commission_r/?id_sub=<?= $arResult['ID']; ?>" class="btn button-border">
                <span class="button-title"><?=GetMessage('SOSTAV_REG')?></span>
                <span class="button-ico ico-large">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-button.svg" alt="">
                            </span>
            </a>
        </div>
        <div class="action-wrap">
            <a href="/experts_m/?id_sub=<?= $arResult['ID']; ?>" class="btn button-second">
                <span class="button-title"><?=GetMessage('SOSTAV_KOM')?></span>
                <span class="button-ico ico-large">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-button.svg" alt="">
                            </span>
            </a>
        </div>
    </div>
</div>


<?if(!empty($arResult['SECTION_RESULT'])):?>
    <div class="tabs-slider-box js-tabs-nav">
        <h2 class="h1-title"><?=GetMessage('RESULT')?></h2>
        <div class="slider-inner-wrap">
            <div class="slider-wrap">
                <div class="slider">
                    <?
                    $active = false;
                    foreach ($arResult['SECTION_RESULT'] as $key => $value):?>

                    <?if(empty($value)) continue;?>

                        <div class="sl-wrap"><a href="" data-tab="result_<?= $key ?>"
                                                class="btn button-menu <? if (!$active):?>active<? $active = true; endif; ?>"><?=$date = $key - 1; ?>
                                - <?= $key ?></a></div>
                    <? endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    <? foreach ($arResult['SECTION_RESULT'] as $key => $value): ?>
        <div class="tabs-results-box js-tab-block" data-tab="result_<?= $key ?>">
            <ul class="menu">
                <? foreach ($value as $item): ?>
                    <li class="js-popup-wrap no-close">
                        <a href="/result/<?=$arResult['ID']?>/<?=$item['IBLOCK_SECTION_ID']?>/<?=$item['ID']?>/" class="js-btn-toggle"><?=$item['NAME']?></a>
                        <div class="popup-content-block js-popup-block">
                            <div class="items-wrap items-small">
                                <?foreach ($item["REGION"] as $region):?>
                                    <div class="item-wrap">
                                    <a href="/result/<?=$arResult['ID']?>/<?=$item['IBLOCK_SECTION_ID']?>/<?=$item['ID']?>/<?=$region['ID']?>/" class="item-tile-folder tile-small">
                                        <span class="tile-ico">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/folder.svg" alt="">
                                        </span>
                                        <span class="tile-title"><?=$region['NAME']?></span>
                                    </a>
                                </div>
                                <?endforeach;?>
                            </div>
                        </div>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    <? endforeach; ?>
<?endif;?>


<? if (!empty($arResult['METHOD_MATERIAL'])): ?>

    <div class="tabs-slider-box js-tabs-nav">
        <h2 class="h1-title"><?=GetMessage('METHOD_MATERIAL')?></h2>
        <div class="slider-inner-wrap">
            <div class="slider-wrap">
                <div class="slider">
                    <?
                    $active = false;
                    foreach ($arResult['METHOD_MATERIAL'] as $key => $value):?>
                        <div class="sl-wrap"><a href="" data-tab="method_material_<?= $key ?>"
                                                class="btn button-menu <? if (!$active):?>active<? $active = true; endif; ?>"><?=$date = $key - 1; ?>
                                - <?= $key ?></a></div>
                    <? endforeach; ?>

                </div>
            </div>
        </div>
    </div>

    <? foreach ($arResult['METHOD_MATERIAL'] as $key => $value): ?>
        <div class="tabs-results-box js-tab-block" data-tab="method_material_<?= $key ?>">
            <div class="items-wrap">
                <? foreach ($value as $item): ?>
                    <div class="item-wrap">
                        <div class="item-tile-doc">
                            <a href="<?=$item['LINK']?>" class="tile-link-wrap">
                                <span class="tile-photo">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/file-pdf.svg" alt="">
                                </span>
                                <span class="tile-title-wrap">
                                    <span class="tile-title title-small"><?=$item['NAME']?></span>
                                    <span class="tile-info"><?=$item['SIZE']?>.<?=$item['FORMAT']?></span>
                                </span>
                            </a>
                            <div class="tile-info-wrap info-clear">
                                <a href="<?=$item['LINK']?>" class="btn-action-icon">
                                    <span class="button-title">Скачать</span>
                                    <span class="button-ico">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/download.svg" alt="">
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    <? endforeach; ?>
<? endif; ?>



<div class="tabs-slider-box js-tabs-nav">
    <h2 class="h1-title"><?=GetMessage('TASKS')?></h2>
    <div class="slider-inner-wrap">
        <div class="slider-wrap">
            <div class="slider">
                <?
                $active = false;
                foreach ($arResult['RESULT'] as $key => $value):?>
                    <div class="sl-wrap"><a href="" data-tab="method_result_<?= $key ?>"
                                            class="btn button-menu <? if (!$active):?>active<? $active = true; endif; ?>"><?=$date = $key - 1; ?>
                            - <?= $key ?></a></div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>

<? foreach ($arResult['RESULT'] as $key => $value): ?>
    <div class="tabs-results-box js-tab-block" data-tab="method_result_<?= $key ?>">
        <div class="items-wrap">
            <? foreach ($value as $item): ?>
                <div class="item-wrap">
                    <div class="item-tile-doc">
                        <a href="<?=$item['LINK']?>" class="tile-link-wrap">
                                <span class="tile-photo">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/file-pdf.svg" alt="">
                                </span>
                            <span class="tile-title-wrap">
                                    <span class="tile-title title-small"><?=$item['NAME']?></span>
                                    <span class="tile-info"><?=$item['SIZE']?>.<?=$item['FORMAT']?></span>
                                </span>
                        </a>
                        <div class="tile-info-wrap info-clear">
                            <a href="<?=$item['LINK']?>" class="btn-action-icon">
                                <span class="button-title">Скачать</span>
                                <span class="button-ico">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/download.svg" alt="">
                                    </span>
                            </a>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
<? endforeach; ?>

