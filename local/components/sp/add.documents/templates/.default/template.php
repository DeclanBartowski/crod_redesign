<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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
<form action="" id="submitForm" data-component="sp:add.documents" data-action="upload" data-="">
    <div class="filter-box">
        <h2 class="h2-title"><?= GetMessage('TITLE_BLOCK') ?></h2>
        <div class="frm-row row-3">
            <div class="frm-field">
                <select name="region" class="form-input form-select" required
                        data-placeholder="<?= GetMessage('REGION_TITLE') ?>">
                    <option selected disabled hidden value=""><?= GetMessage('REGION_TITLE') ?></option>
                    <? foreach ($arResult["REGION"] as $region): ?>
                        <option value="<?= $region['ID'] ?>"><?= $region['NAME'] ?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="frm-field">
                <select name="YEAR" class="form-input form-select" required
                        data-placeholder="<?= GetMessage('YEAR_TITLE') ?>">
                    <option selected disabled hidden value=""><?= GetMessage('YEAR_TITLE') ?></option>
                    <? foreach ($arResult["YEAR"]['MAIN'] as $year): ?>
                        <optgroup label="<?= $year['NAME'] ?>">
                            <? foreach ($arResult["YEAR"]['SUB'][$year['ID']] as $value): ?>
                                <option value="<?= $value['ID'] ?>"><?= $value['NAME'] ?></option>
                            <? endforeach; ?>
                        </optgroup>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="frm-field">
                <select name="SUBJECT" class="form-input form-select" required
                        data-placeholder="<?= GetMessage('SUBJECT') ?>">
                    <option selected disabled hidden value=""><?= GetMessage('SUBJECT') ?></option>
                    <? foreach ($arResult["SUBJECT"] as $subject): ?>
                        <option value="<?= $subject['ID'] ?>"><?= $subject['NAME'] ?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="tab-box js-tab-block active">

        <!--doc-list-box-->
        <div class="doc-list-box">
            <div class="items-wrap cstmaddRow">
                <div class="item-wrap cstmrow">
                    <div class="item-tile-doc-list ">
                        <div class="tile-title-wrap">
                            <div class="tile-title">
                                <input type="text" name="name[]" class="form-input"
                                       placeholder="<?= GetMessage('NAME_DOCUMENT') ?>">
                            </div>
                        </div>
                        <div class="tile-actions-wrap">
                            <div class="tile-action">
                                <div class="frm-field-file js-field-file">
                                    <input type="file" name="file[]" class="js-field-input"
                                           accept=".doc, .docx, .txt, .rtf, .xls, .xlsx, .pdf"
                                    >
                                    <a href="" class="btn button-second js-file-button">
                                                <span class="button-ico">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/attach.svg" alt="">
                                                </span>
                                        <span class="button-title" data-title="<?= GetMessage('CHOICE_DOC') ?>"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="tile-action">
                                <a href="javascript:void(0)" class="btn button-second" data-remove-row>
                                            <span class="button-ico">
                                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/trash.svg" alt="">
                                            </span>
                                    <span class="button-title"><?= GetMessage('DELETE_BTN') ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/doc-list-box-->

        <!--actions-buttons-box-->
        <div class="actions-buttons-box">
            <div class="frm-row">
                <div class="frm-field field-half">
                    <a href="javascript:void(0);" class="btn button-second" data-add-row>
                                <span class="button-ico">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/plus.svg" alt="">
                                </span>
                        <span class="button-title"><?= GetMessage('ADD_ROW') ?></span>
                    </a>
                </div>
                <div class="frm-field field-half" data-upload>
                    <a href="javascript:void(0);" class="btn button-border-att">
                        <span class="button-title"><?= GetMessage('PUBLISH_SITE') ?></span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</form>
<div id="copy" style="display: none">
    <div class="item-wrap cstmrow">
        <div class="item-tile-doc-list ">
            <div class="tile-title-wrap">
                <div class="tile-title">
                    <input type="text" name="name[]" class="form-input"
                           placeholder="<?= GetMessage('NAME_DOCUMENT') ?>">
                </div>
            </div>
            <div class="tile-actions-wrap">
                <div class="tile-action">
                    <div class="frm-field-file js-field-file">
                        <input type="file" name="file[]" class="js-field-input"
                               accept=".doc, .docx, .txt, .rtf, .xls, .xlsx, .pdf"
                        >
                        <a href="" class="btn button-second js-file-button">
                                                <span class="button-ico">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/attach.svg" alt="">
                                                </span>
                            <span class="button-title" data-title="<?= GetMessage('CHOICE_DOC') ?>"></span>
                        </a>
                    </div>
                </div>
                <div class="tile-action">
                    <a href="javascript:void(0)" class="btn button-second" data-remove-row>
                                            <span class="button-ico">
                                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/trash.svg" alt="">
                                            </span>
                        <span class="button-title"><?= GetMessage('DELETE_BTN') ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
