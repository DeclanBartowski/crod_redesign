<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<?if(!empty($arResult["DETAIL_TEXT"])):?>
    <p><?=$arResult["~DETAIL_TEXT"]?></p>
<?else:?>
    <p><?=$arResult["~PREVIEW_TEXT"]?></p>
<?endif;?>
<?foreach($arResult["DISPLAY_PROPERTIES"] as $arPropFile):?>
    <?if($arPropFile["PROPERTY_TYPE"] == "F"):?>
        <?if(!empty($arPropFile["FILE_VALUE"][0])):?>
            <?foreach($arPropFile["FILE_VALUE"] as $arFile):?>
                <p>
                    <a href="<?=$arFile["SRC"]?>" class="mm_doc-link <?=$arFile["EXTENSION_CLASS"]?>">
                        <span><?=$arFile["NAME"]?> (<?=$arFile["EXTENSION"]?>, <?=$arFile["FILE_SIZE_BYTE"]?>)</span>
                    </a>
                </p>
            <?endforeach;?>
        <?else:?>
            <p>
                <a href="<?=$arPropFile["FILE_VALUE"]["SRC"]?>" class="mm_doc-link <?=$arPropFile["FILE_VALUE"]["EXTENSION_CLASS"]?>">
                    <span><?=$arPropFile["FILE_VALUE"]["NAME"]?> (<?=$arPropFile["FILE_VALUE"]["EXTENSION"]?>, <?=$arPropFile["FILE_VALUE"]["FILE_SIZE_BYTE"]?>)</span>
                </a>
            </p>
        <?endif;?>
    <?endif;?>
<?endforeach;?>
