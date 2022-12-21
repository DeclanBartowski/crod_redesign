<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

?>
<?if(!empty($arResult["REGIONS_INFO"])):?>
<div class="tabs-results-box">
    <div class="items-title-wrap">
        <a href="" class="item-tile-folder">
                        <span class="tile-ico">
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/folder.svg" alt="">
                        </span>
            <span class="tile-title"><?=GetMessage('TITLE_FOLDER')?></span>
        </a>
    </div>
    <div class="items-wrap items-small">
        <?foreach ($arResult["REGIONS_INFO"] as $region):?>
            <div class="item-wrap">
            <a href="/normative/<?=$arParams['SECTION_ID']?>/type/<?=$region['ID']?>/" class="item-tile-folder tile-small">
                            <span class="tile-ico">
                                <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/folder.svg" alt="">
                            </span>
                <span class="tile-title"><?=$region['NAME']?></span>
            </a>
        </div>
        <?endforeach;?>

    </div>
</div>
<?endif;?>
