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
<div class="documents-box">
    <div class="title-inner-wrap">
        <h1 class="h1-title title-large"><?= GetMessage('TITLE_DOCUMENT_MAIN') ?></h1>
    </div>
    <div class="items-wrap">
        <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $arItem['FILE_ARRAY'] = CFile::GetFileArray($arItem['PROPERTIES']['FILE']['VALUE']);
            $arItem['FILE_ARRAY']['FORMAT_SIZE'] = CFile::FormatSize($arItem['FILE_ARRAY']['FILE_SIZE'], 1);
            $arItem['FILE_ARRAY']['FORMAT'] = \Bitrix\Main\IO\Path::getExtension($arItem['FILE_ARRAY']["SRC"]);
            ?>
            <div class="item-wrap" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="item-tile-doc">
                    <a href="<?=$arItem['FILE_ARRAY']['SRC']?>" class="tile-link-wrap">
                                <span class="tile-photo">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/file-pdf.svg" alt="">
                                </span>
                        <span class="tile-title-wrap">
                                    <span class="tile-title"><?= $arItem['NAME'] ?></span>
                                    <span class="tile-info"><?= $arItem['FILE_ARRAY']['FORMAT_SIZE'] ?>.<?= $arItem['FILE_ARRAY']['FORMAT'] ?></span>
                                </span>
                    </a>
                    <div class="tile-info-wrap">
                        <a href="<?=$arItem['FILE_ARRAY']['SRC']?>" class="btn-action-icon">
                            <span class="button-title"><?= GetMessage('DOWNLOAD_DOCUMENT_MAIN') ?></span>
                            <span class="button-ico">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/download.svg" alt="">
                                    </span>
                        </a>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
