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
<form class="main-search-box" action="<?=$arResult['FORM_ACTION']?>">
    <div class="field-input">
        <div class="frm-field-search">
            <input type="text" name="q" class="form-input" value="<?=$arParams['REQUEST']?>" placeholder="<?=GetMessage('ENTER_TEXT')?>">
        </div>
    </div>
    <div class="field-button" >
        <button type="submit" class="btn button-border-att">
            <span class="butotn-title"><?=GetMessage('SEARCH_BTN')?></span>
            <span class="button-ico ico-large">
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/arrow-button-att.svg" alt="">
                        </span>
        </button>
    </div>
</form>
